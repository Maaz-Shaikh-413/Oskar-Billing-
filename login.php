<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Assuming you know the single user's credentials
    $username = 'Oskar'; // replace with your actual username
    $password = '1234'; // replace with the actual hashed password

    if ($user === $username && password_verify($pass, $password)) {
        $_SESSION['username'] = $user;
        echo "Login successful!";
        // Redirect or handle post-login logic here
    } else {
        echo "Invalid username or password.";
    }
}

$conn->close();
?>
