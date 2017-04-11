<!-- CREATE TABLE votes (
	reportID INT,
	accUsername VARCHAR(25),
	val INT,
	PRIMARY KEY (reportID, accUsername)
) ENGINE=InnoDB; 

ALTER TABLE votes ADD CONSTRAINT vote_refs FOREIGN KEY (reportID) REFERENCES report (reportID);
ALTER TABLE votes ADD CONSTRAINT vote_refs2 FOREIGN KEY (accUsername) REFERENCES account (accUsername); -->

<?php
	$dbhost = 'localhost:3036';
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect("localhost", $dbuser, $dbpass, "CYPRESS");
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$reportID = mysqli_real_escape_string($conn, $_POST['username']);
	$accUsername = $_SESSION[""];
	$vote = mysqli_real_escape_string($conn, $_POST['username']);

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