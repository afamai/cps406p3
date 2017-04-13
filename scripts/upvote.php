<?php
	session_start();
	$conn = mysqli_connect('localhost', 'root', '', 'CYPRESS');
	if (mysqli_connect_errno()) {
	    die('Connection failed');
	}

	$reportID = mysqli_real_escape_string($conn, $_GET['id']);
	$accUsername = $_SESSION["username"];
	$vote = mysqli_real_escape_string($conn, $_GET['vote']);

	$sql = "SELECT COUNT(reportID) FROM report WHERE reportID = $reportID AND accUsername = $accUsername";

	if (!mysqli_query($conn, $sql))
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	} else {
		$result = mysqli_query($conn, $sql);
		if ($result <= 1) {
			$upvote_sql = "INSERT INTO votes (reportID, accUsername, val) 
				VALUES ($reportID, $accUsername, $vote)";
			$update_sql = "UPDATE report SET reportVotes = reportVotes + $vote 
				WHERE reportID = $reportID AND accUsername = $accUsername;"
			if (!mysqli_query($conn, $upvote_sql) and !mysqli_query($conn, $update_sql))
			{
			    echo "Error: " . $upvote_sql . $update_sql "<br>" . mysqli_error($conn);
			}

		}
	}
	mysqli_close($conn);
	die();
?>
