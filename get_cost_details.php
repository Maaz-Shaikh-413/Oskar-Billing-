<?php
    include("db_config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = intval($_POST['project_id']);

    $stmt = $conn->prepare("SELECT planning_authority, balance_incurred, estimated_cost, incurred_cost, updated_at FROM project_costs WHERE project_id = ?");
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $projectDetails = $result->fetch_assoc();
        echo json_encode($projectDetails);
    } else {
        echo json_encode(["error" => "No details found for the selected project"]);
    }

    $stmt->close();
}

$conn->close();
?>
