<?php

header('Content-Type: application/json');

$server = "localhost";
$user = "2229668";
$password = "Bioion01";
$database = "db2229668";


$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$entry = "SELECT * FROM button_state ORDER BY id DESC LIMIT 1";
$result = $conn->query($entry);

$light_array = array();


if ($result->num_rows > 0) {
    $state = $result->fetch_assoc();
    if ($state["id"] == 1){
	    $light_array['colour'] = $state["colour"];
	    $light_array['state'] = $state["state"];
	}
} else {
    echo "No entries found.";
}

$check_json = json_encode($light_array);

echo $check_json;

$conn->close();

?>
