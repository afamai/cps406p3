<?php
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$fname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lname = mysqli_real_escape_string($conn, $_POST["lastname"]);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO accounts (Username, Password, Firstname, Lastname, Phone, Email) 
VALUES ('$username', '$password', '$fname', '$lname', '$phone', '$email')";

if (!mysqli_query($conn, $sql))
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
header("Location: ../?page=registrationComplete.html");
die();
?>