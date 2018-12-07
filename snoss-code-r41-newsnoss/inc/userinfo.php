<?
function setinfo($uid,$email,$password,$type){//set the information in a cookie
	if(isset($_COOKIE['snoss'])) setcookie("snoss","",time()-10);
	if($type == "c"){	
		if(!(setcookie("snoss",$uid.":". nextkeyword($uid,$password).":".$email,time()+360000))){
			err(9);
		}
		global $queryinfo;
		$queryinfo="?";
	}else{//send it through the query string thing
		global $queryinfo;
		$queryinfo = "?uid=".$uid."&kw=".nextkeyword($uid,$password)."&";
	}
}

function get_uid(){ //get the current uid of the user
	if(isset($_COOKIE['snoss'])){
		list($uid,$keyword,$email) = split(":",$_COOKIE['snoss']);
	}else{
		$uid = $_GET['uid'];
	}
	return $uid;
}

function get_user_info($value,$uid){ //get information from the db about user
//set $uid to current to have this one
	if($uid == "current"){ 
		$uid = get_uid();
	}

	$query = "SELECT ".$value." FROM useri WHERE uid='".$uid."'";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){
		$returnvalue = $row[$value];
	}
	return $returnvalue;
}

function get_pending(){
	$uid = get_uid();

	$query = "SELECT * FROM friends WHERE (`to`='".$uid."' AND `flag`='op')";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$result = mysql_query($query);
		$end = "[table border=1][tr][td]User ID[/td][td]Nick[/td][td]Action[/td][/tr]";
		while($row = mysql_fetch_array($result)){
			if($row['to'] == $uid){ //sort out which is which to make sure the right frienduid is outputted
				$frienduid = $row['from'];
			}else{
				$frienduid = $row['to'];
			}
			global $queryinfo;
			$end .= "[tr][td]".$frienduid."[/td][td]".get_user_info("user",$frienduid)."[/td][td][a href='friends_add.php".$queryinfo."accept=".$frienduid."']Accept[/a] / [a href='friends_add.php".$queryinfo."reject=".$frienduid."']Reject[/a][/td][/tr]";
		}
		$end .= "[/table]";
		return $end;
	}else{
		return "You have no Pending Requests";
	}
}

?>
