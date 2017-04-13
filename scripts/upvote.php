<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$reportID = mysqli_real_escape_string($conn, $_GET['id']);
	$accUsername = $_SESSION["username"];
	$vote = mysqli_real_escape_string($conn, $_GET['vote']);

	$sql = "UPDATE votes SET val = $vote WHERE reportID = $reportID AND accUsername = '$accUsername'";
	$result = mysqli_query($conn, $sql);
	if (!$result)
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	} else {
		$sql = "UPDATE reports SET reportVotes = reportVotes + $vote WHERE reportID = $reportID AND accUsername = '$accUsername'";
		$result = mysqli_query($conn, $sql);
		if (!$result)
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
	die();
?>
