<?php

header("Location: https://mi-linux.wlv.ac.uk/~2229668/select_care/website_files/elderdashboard.html");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$colour = 'green';
	$state = 'off';
}

$server = "localhost";
$user = "2229668";
$password = "Bioion01";
$database = "db2229668";


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
