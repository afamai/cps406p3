<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "CYPRESS");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$password = mysqli_real_escape_string($conn, $_POST['password']);
$reason = mysqli_real_escape_string($conn, $_POST['reason']);
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
	else{
		
		$sql = "INSERT INTO deleted (Username, Password, Firstname, Lastname, Phone, Email, Reason) VALUES ('$info[0]', '$info[1]', '$info[2]', '$info[3]', '$info[4]', '$info[5]', '$reason')";
		
		if (!mysqli_query($conn, $sql))
		{
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		else
		{
			$sql = "DELETE FROM accounts WHERE Username = '$username';";

			if (!mysqli_query($conn, $sql))
			{
				echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			else
			{
				$sql = "DELETE FROM reports WHERE accUsername = '$username';";
				if (!mysqli_query($conn, $sql))
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				else{
					echo 1;
				}
			}
		}
	}
}
mysqli_close($conn);
die();
?>