<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}

// Get the username from the session
$username = $_SESSION['username'];

// Include the database connection file
include('db.php');

// Retrieve user's profile picture path from the database
$sql = "SELECT profile_picture_path FROM carers WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $profilePicturePath = $row['profile_picture_path'];
} else {
    // Default path if no profile picture is found
    $profilePicturePath = "profile_pictures/default_profile_picture.png";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carer Dashboard</title>
    <link rel="stylesheet" type="text/css" href="carer_Dashboard.css">
    <script>
        function handleFileChange() {
            var fileInput = document.getElementById("fileInput");
            var newProfilePic = document.getElementById("newProfilePic");

            var file = fileInput.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                newProfilePic.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }

        function changeProfilePicture() {
            var fileInput = document.getElementById("fileInput");
            var newProfilePic = document.getElementById("newProfilePic");

            var formData = new FormData();
            formData.append('file', fileInput.files[0]);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'uploadProfilePicture.php', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Update the profile picture on success
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById("profile-pic").src = response.newProfilePicturePath;
                        alert("Profile picture changed successfully!");
                    } else {
                        alert("Failed to change profile picture.");
                    }
                }
            };

            xhr.send(formData);
        }
    </script>
</head>
<body>

    <div id="header">
        <img id="profile-pic" src="<?php echo $profilePicturePath; ?>" alt="Profile Picture" width="50" height="50">
        Welcome, <?php echo $username; ?>
    </div>

    <div id="welcome-message">
        <h2>Welcome, <?php echo $username; ?>!</h2>
    </div>

    <a href="Bookings.php" id="bookings-btn">Go to Bookings</a>

    <div>
        <img id="newProfilePic" alt="New Profile Picture" width="50" height="50">
        <br>
        <input type="file" id="fileInput" onchange="handleFileChange()">
        <br>
        <button onclick="changeProfilePicture()">Change Profile Picture</button>
    </div>

</body>
</html>
