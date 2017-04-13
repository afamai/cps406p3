<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = $_SESSION['username'];
$sql = "SELECT reportDate, reportDescript, reportLoc, reportStatus, reportType, reportVotes
		FROM reports
		WHERE accUsername = '$user'";
$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else
{
	echo $result->num_rows;
	while($row = mysqli_fetch_array($result));
	{
	}
}

mysqli_close($conn);
die();
?>