<?
require 'inc/functions.php';
require 'inc/signup.php';
require 'inc/strings.php';
global $dateformat;

if($_POST['nick'] && $_POST['firstname'] && $_POST['surname'] && $_POST['d'] && $_POST['o'] && $_POST['b'] && $_POST['password'] && $_POST['password2'] && $_POST['email'] && $_POST['email2']){ //if all of the information is posted
	$newuser = new user;
	$newuser->nick = secure($_POST['nick']);
	$newuser->firstname = secure($_POST['firstname']);
	$newuser->surname = secure($_POST['surname']);
	$newuser->day = secure($_POST['d']);
	$newuser->month = secure($_POST['o']);
	$newuser->year = secure($_POST['b']);
	$newuser->password = secure($_POST['password']);
	$newuser->password2 = secure($_POST['password2']);
	$newuser->email = secure($_POST['email']);
	$newuser->email2 = secure($_POST['email2']);
	$newuser->thedate = date($dateformat);
	$newuser->code = randstring()
;
	$newuser->add();
}elseif($_GET['confirm'] && $_GET['uid']){
	confirm($_GET['uid'], $_GET['confirm']); //confirm to the database that the email address is correct
}else{ //else, print out the form
	global $signup_htmlpage_1,$signup_htmlpage_2,$signup_htmlpage_3;	
}
?>
<html>
	<head>
		<title>Snoss Signup</title>
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div align="center" class="signupform">
			<br/><br/>
			<h1>Snoss Signup</h1>
		<form method="POST">
			<span class="colin">123456789.</span>Nick: <input type="text" name="nick"><br />
			<span class="colin">12345</span>Firstname: <input type="text" name="firstname"><br />
			<span class="colin">123456</span>Surname: <input type="text" name="surname"><br />
			DOB (DD/MM/YYYY): 
			<select name="d">
				<option value="01">01</option>
				<option value="02">02</option>
				<option value="03">03</option>
				<option value="04">04</option>
				<option value="05">05</option>
				<option value="06">06</option>
				<option value="07">07</option>
				<option value="08">08</option>
				<option value="09">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
			</select>
			<select name="o">
				<option value="01">January</option>
				<option value="02">February</option>
				<option value="03">March</option>
				<option value="04">April</option>
				<option value="05">May</option>
				<option value="06">June</option>
				<option value="07">July</option>
				<option value="08">August</option>
				<option value="09">September</option>
				<option value="10">October</option>
				<option value="11">November</option>
				<option value="12">December</option>
			</select>
			<input type="text" name="b" size="2"><br />
			<span class="colin">12345.</span>Password: <input type="password" name="password"><br />
			<span class="colin">'</span>Password Again: <input type="password" name="password2"><br />
			<span class="colin">12345678.'</span>Email: <input type="text" name="email" value="<? echo $_GET['email']; ?>"><br />
			<span class="colin">1234'</span>Email Again: <input type="text" name="email2" value="<? echo $_GET['email']; ?>">
			<br /><input type="submit" value="Signup"><br />
		</form>
		<a href="login.php">Login</a> if you already have an account
		</div>		
	</body>
</html>
