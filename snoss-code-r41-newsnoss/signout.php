<?
if(isset($_COOKIE['snoss'])){
	setcookie("snoss","",time()-10);
}
header("Location:login.php");
?>
