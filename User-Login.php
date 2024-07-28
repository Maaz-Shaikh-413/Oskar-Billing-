<?php
// Database connection
include("db_config.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Retrieve user data
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start a session and store user info
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['username'] = $username;
            echo "Login successful!";
            // Redirect to a protected page
            header("Location: dashboard.html");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    $stmt->close();
}
$conn->close();
?>
