<?
require 'require.php';
if(isset($_COOKIE['snoss'])){ //if cookies are already set
	checkkey($_COOKIE['snoss'],"c");//checks the keyword and bounces a new one out
	header("Location:main.php");	
}elseif($_POST['email'] && $_POST['password'] && $_POST['cookie']){ //if the username and password is submitted
	if($_POST['cookie'] == "y"){
		$type="c";
	}else{
		$type="q";
	}
	checklogin($_POST['email'],$_POST['password'],$type); //check if the login information is correct
	global $queryinfo;
	header("Location:main.php".$queryinfo);	
}
?>
<html>
	<head>
		<title>Snoss Login</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div align="center" class="login">
			<br/><br/><br/><br/>
			<h1>Snoss Login</h1>	
			<form method="POST">
				Email Address: <input type="text" name="email"><br />
				<span class="colin">1234</span>Password: <input type="password" name="password"><br />
				Use Cookies: <input type="radio" name="cookie" value="y" checked="checked" />
				Don't use Cookies: <input type="radio" name="cookie" value="n" /> <br />
				<input type="submit" value="Login"><br />
			</form>
			Missing out? <a href="signup.php">Signup</a> free!<br />
		</div>
	</body>
</html>

