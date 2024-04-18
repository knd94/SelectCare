<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Return an error response if not logged in
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

// Include the database connection file
include('db.php');

// Get the username from the session
$username = $_SESSION['username'];

// Check if a file was uploaded
if (!isset($_FILES['file'])) {
    echo json_encode(['success' => false, 'message' => 'No file uploaded']);
    exit();
}

$file = $_FILES['file'];

// Check for errors during file upload
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'message' => 'File upload failed']);
    exit();
}

// Define the target directory for profile pictures
$targetDirectory = 'profile_pictures/';

// Generate a unique filename for the uploaded file
$filename = uniqid('profile_pic_') . '_' . basename($file['name']);
$targetPath = $targetDirectory . $filename;

// Move the uploaded file to the target directory
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    // Update the user's profile picture path in the database
    $updateSql = "UPDATE carers SET profile_picture_path = '$targetPath' WHERE username = '$username'";
    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['success' => true, 'newProfilePicturePath' => $targetPath]);
    } else {
        // Error updating the database
        echo json_encode(['success' => false, 'message' => 'Error updating database']);
    }
} else {
    // File move failed
    echo json_encode(['success' => false, 'message' => 'Error moving uploaded file']);
}

$conn->close();
?>
