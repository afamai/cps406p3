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
	$sql = "INSERT INTO report (accUsername, reportDescript, reportLoc, reportType) 
	VALUES ('$accUsername', '$reportDescript', '$reportLoc', '$reportType')";
	$result = mysqli_query($conn, $sql);
	if (!$result)
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	else
	{
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysqli_query($conn, $sql);
		if (!$result)
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		else
		{
			$row = mysqli_fetch_array($result);
			$id = $row[0];
			$sql = "INSERT INTO votes (reportID, accUsername, val)
			VALUES ('$id', '$accUsername', 1)";
			$result = mysqli_query($conn, $sql);
			if (!$result)
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}
	}
	mysqli_close($conn);
	//header("Location: ../?page=reportSent");
	die();
?>
