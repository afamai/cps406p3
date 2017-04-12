<!-- CREATE TABLE report (
    reportID INT PRIMARY KEY AUTO_INCREMENT,
    accUsername VARCHAR(25) NOT NULL,
    reportDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    reportDescript VARCHAR(300) NOT NULL,
    reportLoc VARCHAR(25) NOT NULL,
    reportStatus SMALLINT NOT NULL DEFAULT 0,
    reportType ENUM('Utility Failure', 'Potholes', 'Vandalism', 'Eroded Streets', 'Flooded Streets', 'Tree Collapse', 'Mould and Spore Growth', 'Garbage/other road Blocking Object') NOT NULL,
    reportVotes INT NOT NULL DEFAULT 1
) ENGINE=InnoDB;

ALTER TABLE report ADD CONSTRAINT report_refs FOREIGN KEY (accUsername) REFERENCES account (accUsername); -->

<?php
	$dbuser = 'root';
	$dbpass = '';
	$conn = mysqli_connect("localhost", $dbuser, $dbpass, "CYPRESS");
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$reportID = mysqli_real_escape_string($conn, $_POST['username']);
	$accUsername = $_SESSION["username"];

	$sql = "DELETE FROM report WHERE ID = $reportID AND accUsername = $accUsername";
	if (!mysqli_query($conn, $sql))
	{
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
	die();
?>