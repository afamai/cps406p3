<?php
	session_start();
	$conn = mysqli_connect("localhost", 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$accUsername = $_SESSION["username"];
	$reportDescript = mysqli_real_escape_string($conn, $_POST["description"]);
	$reportLoc = mysqli_real_escape_string($conn, $_POST['address']);
	$reportType = mysqli_real_escape_string($conn, $_POST['issue']);
	$sql = "INSERT INTO reports (accUsername, reportDescript, reportLoc, reportType) 
	VALUES ('$accUsername', '$reportDescript', '$reportLoc', '$reportType')";
	if (!mysqli_query($conn, $sql))
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	header("Location: ../?page=reportSent");
	die();
?>
