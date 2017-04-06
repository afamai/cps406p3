<?php
include("includes/head.html");
include("includes/header.html");
$action = 'about';
if(!empty($_GET['action']))
{
	$tmp = basename($_GET['action']);
	if(file_exists("pages/$tmp.html"))
	{
		$action = $tmp;
	}
}
include("pages/$action.html");
include("includes/footer.html");
?>