<!-- CREATE TABLE reports (
    reportID INT PRIMARY KEY AUTO_INCREMENT,
    accUsername VARCHAR(30) NOT NULL,
    reportDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reportDescript VARCHAR(200) NOT NULL,
    reportLoc VARCHAR(25) NOT NULL,
    reportStatus SMALLINT NOT NULL DEFAULT 0,
    reportType ENUM('Utility Failure', 'Potholes', 'Vandalism', 'Eroded Streets', 'Flooded Streets', 'Tree Collapse', 'Mould and Spore Growth', 'Garbage or Other Road Blocking Object') NOT NULL,
    reportVotes INT NOT NULL DEFAULT 1
) ENGINE=InnoDB;

ALTER TABLE report ADD CONSTRAINT report_refs FOREIGN KEY (accUsername) REFERENCES accounts (accUsername); -->

<?php
	session_start();
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect("localhost", $dbuser, $dbpass, "CYPRESS");
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
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