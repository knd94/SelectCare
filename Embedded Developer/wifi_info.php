<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$wifi_address = htmlspecialchars($_REQUEST['wifi_address']);
	$wifi_password = htmlspecialchars($_REQUEST['wifi_password']);
}
	
echo $wifi_address;
echo $wifi_password;

$server = "localhost";
$user = "matthew";
$password = "password";
$database = "clients";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

else {
	echo "Database Connected \n";
}

$select_wifi_address = "SELECT wifi_address FROM wifi_info";
$select_address_result = $conn->query($select_wifi_address);

if ($result->num_rows > 0) {
  while($row = $select_address_result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. 
    " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}

$insert_wifi = "INSERT INTO wifi_info(wifi_address, wifi_password)
VALUES ('$wifi_address', '$wifi_password')";
				
if ($conn->query($insert_wifi)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $insert_wifi . "<br>" . mysqli_error($conn);
}

$conn->close();


?>
