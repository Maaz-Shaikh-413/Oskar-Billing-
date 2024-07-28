<?php
include("db_config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $project_id = intval($_POST['project_id']);
    $planning_authority = $_POST['planning_authority'];
    $balance_incurred = intval($_POST['balance_incurred']);
    $estimated_cost = intval($_POST['estimated_cost']);
    $incurred_cost = intval($_POST['incurred_cost']);

    // Check if project_id exists in project_costs table
    $checkProject = $conn->prepare("SELECT project_id FROM project_costs WHERE project_id = ?");
    $checkProject->bind_param("i", $project_id);
    $checkProject->execute();
    $result = $checkProject->get_result();

    if ($result->num_rows > 0) {
        // Update the existing record
        $stmt = $conn->prepare("UPDATE project_costs SET planning_authority = ?, balance_incurred = ?, estimated_cost = ?, incurred_cost = ?, updated_at = NOW() WHERE project_id = ?");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("siiii", $planning_authority, $balance_incurred, $estimated_cost, $incurred_cost, $project_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // Insert a new record
        $stmt = $conn->prepare("INSERT INTO project_costs (project_id, planning_authority, balance_incurred, estimated_cost, incurred_cost, updated_at) VALUES (?, ?, ?, ?, ?, NOW())");
        if (!$stmt) {
            die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
        }

        $stmt->bind_param("issii", $project_id, $planning_authority, $balance_incurred, $estimated_cost, $incurred_cost);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $checkProject->close();
}

$conn->close();
?>
