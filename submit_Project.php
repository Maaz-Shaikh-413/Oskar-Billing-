<?php
    include("db_config.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$client_name = $_POST['client_name'];
$project_name = $_POST['project_name'];
$architect_name = $_POST['architect_name'];
$engineer_name = $_POST['engineer_name'];
$contact_number = $_POST['contact_number'];
$maharera_number = $_POST['maharera_number'];
$registration_date = $_POST['registration_date'];
$expiry_date = $_POST['expiry_date'];
$units = $_POST['units'];
$project_address = $_POST['project_address'];

$stmt = $conn->prepare("INSERT INTO projects (client_name, project_name, architect_name, engineer_name, contact_number, maharera_number, registration_date, expiry_date, units, project_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $client_name, $project_name, $architect_name, $engineer_name, $contact_number, $maharera_number, $registration_date, $expiry_date, $units, $project_address);



if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
