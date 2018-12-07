<?
class message{
	var $to,$subject,$message,$flags,$code,$date,$time;
		
	function post(){
		$query =  "INSERT INTO `email` ( `to` , `from` , `subject` , `message` , `flag` , `str` , `date` , `time` ) VALUES ('".$this->to."', '".get_uid()."', '".$this->subject."', '".$this->message."', '".$this->flags."', '".$this->code."', '".$this->date."', '".$this->time."');";
		mysql_query($query);		
	}

}
function inbox(){
	error_reporting(0);
	$query = "SELECT * FROM `email` WHERE `to`='".get_uid()."' AND (`flag`='ia' OR `flag`='op') ORDER BY date,time";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$end .= "[table class='msgs'][tr][td][i]Subject[/i][/td][td][i]From[/i][/td][td][i]Date and Time[/i][/td][/tr]";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($row['subject']==""){
			$subject="No Subject";
			}else{
			$subject=$row['subject'];
			}
			global $queryinfo;
			$end .= "[tr][td][a href='inbox.php".$queryinfo."str=".$row['str']."']".$subject."[/a][/td][td]".get_user_info("user",$row['from'])."[/td][td]".$row['date']." ".$row['time']."[/tr]";
		}
		$end .= "[/table]";
	}else{
		$end = "You have no mail in your inbox";
	}
	return $end;
}

function comments(){
	error_reporting(0);
	$query = "SELECT * FROM `email` WHERE `to`='".get_uid()."' AND (`flag`='ca' OR `flag`='cp') ORDER BY date,time";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$end .= "[table class='msgs'][tr][td][i]Subject[/i][/td][td][i]Message[/i][/td][td][i]From[/i][/td][td][i]Date and Time[/i][/td][/tr]";
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			$end .= "[tr][td]".$row['subject']."[/td][td]".$row['message']."[/td][td]".get_user_info("user",$row['from'])."[/td][td]".$row['date'].$row['time']."[/tr]";
		}
		$end .= "[/table]";
	}else{
		$end = "You have no comments";
	}
	return $end;
}

function reademail(){

if($_GET['str']){
	$str = secure($_GET['str']);
	$query = "SELECT * FROM email WHERE str='".$str."'";
	$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($row['subject']==""){
			$subject="No Subject";
			}else{
			$subject=$row['subject'];
			}
			$emailend .= "[u]Subject:[/u] ".$subject;
			$emailend .= "[br/][u]From:[/u] ".get_user_info("user",$row['from']);
			$emailend .= "[br/][u]Message:[/u] ".$row['message'];
		}
}
return $emailend;
}
function mail_list(){

$query = "SELECT * FROM friends WHERE (`to`='".get_uid()."' AND `flag`='ia') OR (`from`='".get_uid()."' AND `flag`='ia')"; //get the friends
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$result = mysql_query($query);
		$fend .= "[select name=\"to\"]";
		while($row = mysql_fetch_array($result)){
			if($row['to'] == get_uid()){ //sort out which is which to make sure the right frienduid is outputted
				$uid = $row['from'];
			}else{
				$uid = $row['to'];
			}
			$fend .= "[option value=\"".$uid."\"]".get_user_info("user",$uid)." (".get_user_info("firstname",$uid)." ".get_user_info("surname",$uid).")[/option]";
	
		}
		$fend .= "[option value=\"mtap\"]Message To All[/option]";
		$fend .= "[/select]";
	}
return $fend;
}

?>
