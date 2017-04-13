<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = $_SESSION['username'];
$sql = "SELECT * FROM votes WHERE accUsername = '$user'";
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
		$votes[] = array("id" => $row["reportID"], "user" => $user, "vote" => $row["val"]);
		$count++;
	}
}
if($count > 0)
{
	$reports = array("reports" => $votes);
	echo json_encode($votes);
}
else
{
	echo -1;
}
mysqli_close($conn);
die();
?>