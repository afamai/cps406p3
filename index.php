<?php
$content = 'home.php';
if(!empty($_GET['page']))
{
	$tmp = basename($_GET['page']);
	if(file_exists("views/$tmp.html"))
	{
		$content = $tmp . ".html";
	}
	else if(file_exists("views/$tmp.php"))
	{
		$content = $tmp . ".php";
	}
}
if($content == "profile.html" || $content == "changePic.html" || $content == "changeInfo.html" || $content == "changePassword.html" || $content == "deleteAccount.html")
{
	include('layouts/profile.php');
}
else
{
	include('layouts/default.php');
}
?>	