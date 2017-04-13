<?php
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$reportID = mysqli_real_escape_string($conn, $_POST['id']);
	$accUsername = $_SESSION["username"];
	$reportDescript = mysqli_real_escape_string($conn, $_POST['description']);
	$reportLoc = mysqli_real_escape_string($conn, $_POST['address']);
	$reportType = mysqli_real_escape_string($conn, $_POST['issue']);

	$sql = "UPDATE report SET reportDescript=$reportDescript, reportLoc=$reportLoc, 
	reportType=$reportType WHERE reportID = $reportID AND accUsername = $accUsername";
	if (!mysqli_query($conn, $sql))
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	die();
?>
