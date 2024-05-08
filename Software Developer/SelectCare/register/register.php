<?php
/*
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$password = $_POST['pass'];

$conn = new mysqli($localhost, $Bioionbioion012001, $Bioion01, $db2229668);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into elder_reg(firstName, lastName, username, pass)
    values(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $username, $pass);
    $stmt->execute();
    echo "registration successfull";
    $stmt->close();
    $conn->close();
}*/


error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "2229668";
$password = "Bioion01";
$dbname = "db2229668";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $username = $_POST['username'];
    $password = $_POST['pass'];

    $stmt = $conn->prepare("INSERT INTO elder_reg (firstName, lastName, username, pass) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $firstName, $lastName, $username, $password);

    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>
