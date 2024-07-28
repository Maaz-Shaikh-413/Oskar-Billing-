<?php
// Database connection
include("db_config.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signup'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into the database
    $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $hashed_password);
    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
