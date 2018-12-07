<?

class user{ //class to add new user
	var $nick,$firstname,$surname,$day,$month,$year,$email,$email2,$password,$password2,$thedate,$code,$dob;

	function add(){
		global $server,$directory,$signup_email_message_1,$signup_email_message_2,$signup_email_message_3; //get the global vars

		checkage($this->day,$this->month,$this->year);
		$this->dob = $this->day."/".$this->month."/".$this->year;
		if(!(email($this->email))) err(12); //check if the email is real
		if($this->email!=$this->email2) err(3); //checks that emails match
		if($this->password!=$this->password2) err(4); //checks that passwords match
		$this->password = md5($this->password); //MD5 encrypt the password for the database

		$this->uid = nextuid(); //get the next user id to use it for this user

		$email = new email; //send an email for conformation of email address
		$email->to = $this->email;
		$email->subject	= $signup_email_subject;
		$email->message = $signup_email_message_1.$this->firstname.$signup_email_message_2.$server.$directory."signup.php?confirm=".$this->code."&uid=".$this->uid.$signup_email_message_3;//these strings can be found in strings.php
		$email->from = "snoss@".$server;
		$email->send();
		$query = "UPDATE friends SET `to`='".$this->uid."' WHERE `to`='".$this->email."'"; //set any things already in the table with the email as uid to the new uid.
		mysql_query($query);

		$query = "INSERT INTO `useri` (`user`, `password`, `uid`, `email`, `dob`, `signupdate`, `lastlogin`, `picurl`, `firstname`, `surname`, `signupstring`) VALUES ('".$this->nick."', '".$this->password."', '".$this->uid."', '".$this->email."', '".$this->dob."', '".$this->thedate."', '', '', '".$this->firstname."', '".$this->surname."', '".$this->code."')";	//query to add all information of the new user to the table

		mysql_query($query); //send query to database - actualy adds it	

	}
}

function nextuid(){
	$query = "SELECT * FROM useri ORDER BY uid";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){ //get results for the query
		$uid = $row['uid'];	//keep getting each uid - the last one will be the biggest
	}
	$newuid = $uid+1;//add one to the highest one already in there - gives the next uid
	return $newuid; //returns the value
}

function confirm($uid,$code){//confirm the email address to the database
	$query = "UPDATE useri SET signupstring='true' WHERE uid=".$uid." AND signupstring='".$code."'";
	$result = mysql_query($query) or err(6);
	header("Location:login.php");
}

function checkage($day, $month, $year){
	global $age_requirement;
	if((date("Y") - $year) < $age_requirement) { //check years
		err(11);//get lost function :)
	}
	if((date("Y") - $year) == 14){ //if years = 14....
		if((date("m") - $month) < 0){ //check months
			err(11);//get lost function :)
		}else if(((date("m") - $month) == 0) && ((date("d") - $day) < 0)){ //check months then days
			err(11);//get lost function :)
		}
	}
	return 1;
}

?>
