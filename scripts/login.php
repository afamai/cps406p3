<?php
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$sql = "SELECT * FROM accounts WHERE Username='" . $username . "'";
$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
if($result->num_rows != 1)
	echo "-1";
else{
	$info = mysqli_fetch_row($result);
	if(password_verify($password, $info[1]))
	{
		session_start();
		$_SESSION["username"] = $username;
		echo "1"
	}
	else 
		echo "-1";
}

mysqli_close($conn);
die();
?>