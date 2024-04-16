<?php 

echo "PHP Start\n";

if ($_SERVER['CONTENT_TYPE'] === 'application/json') {
    $light_state = file_get_contents('php://input');
    if (empty($light_state)) {
      echo "State is empty \n";
} 
else {
    echo "PHP JSON = ", $light_state, "\n";
  }
}

$state_decode = json_decode($light_state, true);

echo "Decoded PHP JSON = ", $state_decode, "\n";

foreach($state_decode as $key => $value){
  echo "Key = ", $key, " Value = ", $value, "\n";
  if ($key == 'colour'){
    $colour = $value;
  }
  else if($key == 'state'){
    $state = $value;
  }
}
echo "Colour = ", $colour, "\n";
echo "State = ", $state, "\n";

$server = "localhost";
$user = "1808558";
$password = "220xiv";
$database = "db1808558";

$conn = new mysqli($server, $user, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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

echo "PHP Ends\n";

?>
