<?php
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$reportID = mysqli_real_escape_string($conn, $_POST['id']);
	$accUsername = $_SESSION["username"];

	$sql = "DELETE FROM report WHERE ID = $reportID AND accUsername = $accUsername";
	if (!mysqli_query($conn, $sql))
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	die();
?>
