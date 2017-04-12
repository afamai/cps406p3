<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$password = mysqli_real_escape_string($conn, $_POST['password']);
$newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
$username = $_SESSION["username"];

$sql = "SELECT * FROM accounts WHERE Username='" . $username . "'";
$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else{
	$info = mysqli_fetch_row($result);
	if(!password_verify($password, $info[1]))
	{
		echo -1;
	}
	else 
	{
		$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

		$sql = "UPDATE accounts SET Password = '$newPassword' WHERE Username = '$username'";

		if (!mysqli_query($conn, $sql))
		{
			echo -1;
		}
		else
		{
			echo 1;
		}
	}
}
mysqli_close($conn);
die();
?>