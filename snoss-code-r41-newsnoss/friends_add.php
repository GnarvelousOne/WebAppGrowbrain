<?
//$queryinfo is where the query information for non-cookie login is found
require 'require.php';
checkall(); //check for the cookie and check it's authenticity - and do the rest.

if($_POST['email'] || $_POST['uid']){
	$newfriend = new friend;
	if(email($_POST['email'])) $newfriend->email = secure($_POST['email']); //if it's the email sent, set it
	if($_POST['uid']) $newfriend->uid = secure($_POST['uid']); //if it's the uid sent, set it
	$newfriend->add();
	global $queryinfo;
	header("Location:main.php".$queryinfo);
}elseif($_GET['accept']){ //if the user accepts someone
	$uid = secure($_GET['accept']);
	$query = "UPDATE friends SET flag='ia' WHERE `from`='".$uid."' and `to`='".get_uid()."'";
	mysql_query($query);
	global $queryinfo;
	header("Location:friends_list.php".$queryinfo);
}elseif($_GET['reject']){
	$uid = secure($_GET['reject']);
	$query = "UPDATE friends SET flag='bl' WHERE `from`='".$uid."' and `to`='".get_uid()."'";
	mysql_query($query);
	global $queryinfo;
	header("Location:friends_list.php".$queryinfo);
}else{
	parse_xml("friends_add.xml");
}
?>
