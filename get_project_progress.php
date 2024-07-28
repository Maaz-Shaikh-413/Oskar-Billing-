<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['project_id'])) {
    $projectId = $_POST['project_id'];

    include("db_config.php");

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT excavation, basements, podiums, plinth, stilt_floor, super_structure_slabs, internal_walls, sanitary_fittings, staircases, external_plumbing, fire_fighting_arrangements, civil_works, updated_at FROM site_progress WHERE project_id = ?");
    $stmt->bind_param("i", $projectId);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    }

    $stmt->close();
    $conn->close();

    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No project ID provided']);
}
?>
