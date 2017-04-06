<?php
$content = 'home.html';
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
if($content == "report.html")
{
	include('layouts/reportLayout.php');
}
else
{
	include('layouts/default.php');
}
?>	