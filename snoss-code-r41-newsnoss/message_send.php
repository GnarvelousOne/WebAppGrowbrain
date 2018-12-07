<?
//$queryinfo is where the query information for non-cookie login is found
require 'require.php';
checkall(); //check for the cookie and check it's authenticity - and do the rest.
if($_POST['to'] && $_POST['subject'] && $_POST['message'] && $_POST['type']){
	global $dateformat, $timeformat, $queryinfo;
	if($_POST['to'] == "mtap"){//check if it's a message to all people
		
		$query = "SELECT * FROM friends WHERE (`to`='".get_uid()."' AND `flag`='ia') OR (`from`='".get_uid()."' AND `flag`='ia')"; //get the friends
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$result = mysql_query($query);
		while($row = mysql_fetch_array($result)){
			if($row['to'] == get_uid()){ //sort out which is which to make sure the right frienduid is outputted
				$message = new message;
				$message->to = $row['from'];
				$message->subject = secure($_POST['subject']);
				$message->message = secure($_POST['message']);
				$message->flags = secure($_POST['type']);
				$message->code = randstring();
				$message->date = date($dateformat);
				$message->time = date($timeformat);
				$message->post();
			}else{
				$message = new message;
				$message->to = $row['to'];
				$message->subject = secure($_POST['subject']);
				$message->message = secure($_POST['message']);
				$message->flags = secure($_POST['type']);
				$message->code = randstring();
				$message->date = date($dateformat);
				$message->time = date($timeformat);
				$message->post();
			}
				$message = new message;
				$message->to = get_uid();
				$message->subject = secure($_POST['subject']);
				$message->message = secure($_POST['message']);
				$message->flags = secure($_POST['type']);
				$message->code = randstring();
				$message->date = date($dateformat);
				$message->time = date($timeformat);
				$message->post();
	
		}
		header("Location:main.php".$queryinfo);	
	
	}
	}else{
	$message = new message;
	$message->to = secure($_POST['to']);
	$message->subject = secure($_POST['subject']);
	$message->message = secure($_POST['message']);
	$message->flags = secure($_POST['type']);
	$message->code = randstring();
	$message->date = date($dateformat);
	$message->time = date($timeformat);
	$message->post();
	
	header("Location:main.php".$queryinfo);
	}
}else{
	parse_xml("message_send.xml");
}
mysql_close();
?>
