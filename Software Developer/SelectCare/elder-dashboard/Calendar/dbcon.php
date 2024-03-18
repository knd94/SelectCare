
<?php
$conn = new mysqli('localhost','root','Mb_active','calendar');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>