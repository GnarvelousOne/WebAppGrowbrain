<?
function email($email) //check if an email address is true (well, basically)
{
	if(preg_match("/@/",$email) && preg_match("/./",$email)){
		return true;
	}else{
		return false;
	}
}


class email{ //send new email
	var $to,$subject,$message,$from;

	function send(){
		$headers = "From: ".$this->from."\n\n";
		echo $this->subject."<br />".$this->message."<br />"; //for testing on non-emailing server	
		@mail($this->to,$this->subject,$this->message,$this->headers);// or err(5);

	}
}
?>
