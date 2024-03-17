<?php

// This script 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	//$colour = htmlspecialchars($_REQUEST['colour']);
	//$state = htmlspecialchars($_REQUEST['state']);
	$colour = 'green';
	$state = 'off';
}

$server = "localhost";
$user = "matthew";
$password = "password";
$database = "light_state";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

else {
	echo "Database Connected \n";
}
echo "Updating....";

$insert_state = "UPDATE button_state SET colour = '$colour', 
                  state = '$state' WHERE id = 1";

if ($conn->query($insert_state) === TRUE) {
  echo "State Updated\n";
} else {
  echo "Error: " . $insert_state . "<br>" . $conn->error;
	}
  
$conn->close();


?>
