<?
function parse_vars($data){ //parse the variables for the page, **nick** for example
	$data = preg_replace("/\*\*nick\*\*/",get_user_info("user","current"), $data); //replace **nick** with the nick
	$data = preg_replace("/\*\*uid\*\*/",get_user_info("uid","current"), $data); //uid
	$data = preg_replace("/\*\*dob\*\*/",get_user_info("dob","current"), $data); //dob
	$data = preg_replace("/\*\*signupdate\*\*/",get_user_info("signupdate","current"), $data); //signup date
	$data = preg_replace("/\*\*lastlogin\*\*/",get_user_info("lastlogin","current"), $data); //last login
	$data = preg_replace("/\*\*picurl\*\*/",get_user_info("picurl","current"),$data);//picture url
	$data = preg_replace("/\*\*firstname\*\*/",get_user_info("firstname","current"),$data); //first name
	$data = preg_replace("/\*\*surname\*\*/",get_user_info("surname","current"),$data); //surname
	$data = preg_replace("/\*\*lastname\*\*/",get_user_info("surname","current"),$data); //surname/lastname - for people who use lastname
	$data = preg_replace("/\*\*friends\*\*/",get_friends("current"),$data); //get the list of friends
	$data = preg_replace("/\*\*pending\*\*/",get_pending(),$data); //get the list of pending requests
	$data = preg_replace("/\*\*inbox\*\*/",inbox(),$data); //get the inbox
	$data = preg_replace("/\*\*comments\*\*/",comments(),$data);//gets the comments inbox
	$data = preg_replace("/\*\*printemail\*\*/",reademail(),$data);//read and email in a page, the query string str must be attached
	$data = preg_replace("/\*\*maillist\*\*/",mail_list(),$data);//get the list of who to send stuff to
	return $data;
}

function parse_xml($url){
	$file = file_get_contents($url);
	$file = parse_vars($file);
	$xml = new SimpleXMLElement($file); //load the file
	echo '<html>
	<head>
		<title>';
	echo $xml->hidden->title; 
	echo '</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>';
	//TOP-specifics
	echo "<div align='center' class='title1'><h1>".$xml->top->title."</h1>";
	echo $xml->top->subtitle."</div>";

	//MAIN-specifics

//start side
	global $queryinfo;
	$side = file_get_contents($xml->main->side['url']);
	$side = parse_vars($side);
	$side = new SimpleXMLElement($side);
	if($side->userinfo->image){
		echo "<div class=\"userinfo\"><img src='".$side->userinfo->image['url']."' height='".$side->userinfo->image['height']."' width='".$side->userinfo->image['width']."' alt='".$side->userinfo->image['text']."'/></div>"; //put the display picture in place
	}

	echo "<div class='links'>";
	foreach($side->links->url as $url){
		echo "<a class='toplinks' href='".$url['link'].$queryinfo."'><b>".$url."</b></a><span class='colin'>1234</span>";
	}
	echo "</div>";
//end side
	echo "<div class='main' align='center'>";
	$html = $xml->main->content;
	$html = preg_replace("/\[/","<",$html);
	$html = preg_replace("/\]/",">",$html);
	echo $html;
	echo "</div>";
	
	//Bottom-Specifics
	echo "<div class='footer'>";
	echo $xml->bottom->footer;
	echo "</div>";
}

?>
