<?php
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM accounts WHERE ";
if(!empty($_POST["username"])){
	$sql .= "username='" . $_POST["username"] . "'";
	$input = "Username";
}
else if(!empty($_POST["email"])){
	$sql .= "email='" . $_POST["email"] . "'";
	$input = "Email";
}
else{
	mysqli_close($conn);
	die();
}

$result = mysqli_query($conn, $sql);
if (!$result)
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
else{
	if($result->num_rows > 0)
		echo $input . " not available";
	else
		echo "";
}
mysqli_close($conn);
?>