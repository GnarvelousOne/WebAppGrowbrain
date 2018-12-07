<?
#error_reporting(0);
function err($code){ //error code resolution
	$errorarray = array(
		1 => 'Unable to Connect to MySQL Server',
		2 => 'Unable to Select MySQL Database',
		3 => 'Emails do not match',
		4 => 'Passwords do not match',
		5 => 'Unable to send email',
		6 => 'Signup code incorrect',
		7 => 'Keyword Incorrect, There may be a hacker....',
		8 => 'Bad Email Address or Password',
		9 => 'Unable to send cookie',
		10 => 'Incorrect IP Address',
		11 => 'You are too young, you must be 14 years of age to join Snoss',
		12 => 'The email address that you supplied is not an email address');
	exit($errorarray[$code]);
}

function connect(){ //automatically connect to the selected server and database
	global $mysql_server,$mysql_username,$mysql_password,$mysql_database;
	@mysql_connect($mysql_server,$mysql_username,$mysql_password) or err(1);
	@mysql_select_db($mysql_database) or err(2);
}

function checklogin($email,$password,$type){//check to see if the login is correct
	$query = "SELECT * FROM useri WHERE email='".$email."' AND password='".md5($password)."'"; //md5 the password and check it
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)){
		setip($row['uid']); //set the new IP
		setinfo($row['uid'],$email,$password,$type); //set the info
	$check = $row['uid'];
	}

	if($check == "") err(8);
}

function nextkeyword($uid,$password){//get the next key word to pass around
	$code = randstring();
	$query = "UPDATE useri SET `data`='".$code."' WHERE `uid`='".$uid."'";
	mysql_query($query);
	return $code;
}

function randstring(){ //generate a random string with the date
	$str = date("Yismwyhd").rand();
	return $str;
}

function checkkey($data,$type){ //check wether the keyword is correct
	list($uid,$keyword,$email) = split(":",$data);
	$query = "SELECT * FROM useri WHERE data='".$keyword."' AND uid='".$uid."'";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		checkip($row['uid'],$row['ip']);
		setinfo($uid,$email,$row['password'],$type);
	}else{
		err(7);
	}
}

function checkall(){//check the cookie
	if(isset($_COOKIE['snoss'])){
		checkkey($_COOKIE['snoss'],"c");//checks the keyword and bounces a new one out
	}elseif($_GET['uid'] && $_GET['kw']){
		$fakecookie = $_GET['uid'].":".$_GET['kw'].":unknown";
		checkkey($fakecookie,"q");
	}else{
		header("Location:login.php");
	}
}

function checkip($uid,$ip){
	$query = "SELECT ip FROM useri WHERE uid='".$uid."'";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result)){
		if($_SERVER['REMOTE_ADDR'] != $row['ip']){ //if the ip doesn't match the db throw error
			err(10);
		}
	}
}

function setip($uid){ //update the IP of the confirmed uid
	$query = "UPDATE useri SET ip='".$_SERVER['REMOTE_ADDR']."' WHERE uid='".$uid."'"; 
	mysql_query($query);
}

function secure($str){ //whitelist of what is allowed, anything else is replace with " "
	$str = preg_replace("/[^a-z0-9A-Z#.,:\!?\/@+=-\[\]_]/", " ", $str); //do not add ^ to the list, it messes it up
	return $str;
}
?>
