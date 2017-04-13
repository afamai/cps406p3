<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = $_SESSION['username'];
$sql = "SELECT reportID, reportDate, reportDescript, reportLoc, reportStatus, reportType, reportVotes
		FROM report
		WHERE accUsername = '$user'";
$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else
{
	$count = 0;
	while($row = mysqli_fetch_array($result))
	{
		$reports[] = array("id" => $row["reportID"], "user" => $user, "date" => $row["reportDate"], "description" => $row["reportDescript"], 
		"location" => $row["reportLoc"], "status" => $row["reportStatus"], "type" => $row["reportType"], "votes" => $row["reportVotes"]);
		$count++;
	}
}
if($count > 0)
{
	$reports = array("reports" => $reports);
	echo json_encode($reports);
}
else
{
	echo -1;
}
mysqli_close($conn);
die();
?>