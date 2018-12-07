<?
function get_friends($uid){
	if($uid == current) $uid = get_uid();
	$query = "SELECT * FROM friends WHERE (`to`='".$uid."' AND `flag`='ia') OR (`from`='".$uid."' AND `flag`='ia')";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		$result = mysql_query($query);
		$end = "[table border=1][tr][td]User ID[/td][td]Nick[/td][/tr]";
		while($row = mysql_fetch_array($result)){
			if($row['to'] == $uid){ //sort out which is which to make sure the right frienduid is outputted
				$frienduid = $row['from'];
			}else{
				$frienduid = $row['to'];
			}
			$end .= "[tr][td]".$frienduid."[/td][td]".get_user_info("user",$frienduid)."[/td][/tr]";
		}
		$end .= "[/table]";
		return $end;
	}else{
		global $friend_list_none;
		return $friend_list_none;
	}
}

class friend{
	var $email,$uid;

	function add(){
		if($uid > 0){ //if the value is the uid
			$this->addtotable(); //add straight to table
		}else{
			$query = "SELECT * FROM useri WHERE email='".$this->email."'"; //check if the email address is already attached to a user
			$result = mysql_query($query);
			if($row = mysql_fetch_array($result)){ //if the email is registered
				$this->uid = $row['uid']; //recover the uid
				$this->addtotable(); //add it to table		
			}else{//if the email isn't registered
				$this->uid = $this->email; //set the uid as the email
				$this->addtotable(); //add it to the table

				$email = new email; //send a new email to the email address
				$email->to = $this->email;
				global $friend_add_email_subject,$server,$friend_add_email_message_1,$directory; 
				$firstname = get_user_info("firstname","current"); //get this user's name for the email
				$email->subject = $firstname.$friend_add_email_subject;
				$email->message = $firstname.$friend_add_email_message_1.$server.$directory."signup.php?email=".$this->email."'>Click me!</a>\n";
				$email->from = "snoss@".$server;
				$email->send();
			}
			
		}


	}
	
	function addtotable(){
		$query = "INSERT INTO friends (`to`, `from`, `flag`) VALUES ('".$this->uid."','".get_uid()."','op')"; //add the outward pensing request for the other user to accept/reject
		mysql_query($query);
	}
}//end class friend

?>
