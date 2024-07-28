<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include("db_config.php");


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['project_id'])) {
    $project_id = intval($_POST['project_id']); 
        error_log("Received project ID: " . $project_id);

   
    $sql = "SELECT updated_at FROM project_costs WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Prepare failed: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        $row = $result->fetch_assoc();
        $updated_at = $row['updated_at'];

        if ($updated_at === NULL) {
            $response = ['updated_at' => 'No updates found'];
        } else {
            $response = ['updated_at' => $updated_at];
        }

        $stmt->close();
        
        $conn->close();

        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $stmt->close();
        
        $conn->close();
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Project ID does not exist in project_costs.']);
        exit;
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Project ID not provided']);
    exit;
}
?>
