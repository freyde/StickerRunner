<?php
// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "stickerrunner";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the data
$name = $_POST['name'];
$email = $_POST['email'];
$image = $_FILES['image']['tmp_name'];

// Read the image file
$imageData = file_get_contents($image);

// Escape special characters in the image data
$imageData = $conn->real_escape_string($imageData);

// Insert the data into the "custom" table
$sql = "INSERT INTO custom (name, email, image) VALUES ('$name', '$email', '$imageData')";

if ($conn->query($sql) === TRUE) {
    echo "Image uploaded successfully.";
} else {
    echo "Error uploading image: " . $conn->error;
}

// Close the connection
$conn->close();
?>
