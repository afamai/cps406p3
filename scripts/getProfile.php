<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$user = $_SESSION['username'];
$sql = "SELECT Firstname, Lastname, Phone, Email
		FROM accounts
		WHERE Username = '$user'";
$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$row = mysqli_fetch_array($result);
$profile = array('firstname' => $row['Firstname'], 'lastname' => $row['Lastname'], 'phone' => $row['Phone'], 'email' => $row['Email']);

echo json_encode($profile);

mysqli_close($conn);
die();
?>