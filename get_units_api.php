<?php

include("db_config.php");

$conn = new mysqli($servername, $username, $password, $dbname);



function getUnitData($unitName, $projectId)
{
    $unitData = null;
    $sql = "SELECT * FROM `units` WHERE `project_id` ='$projectId' and `unit_no` = '$unitName'";
    $result = $GLOBALS['conn']->query($sql);

    if ($result->num_rows > 0) {
        $unitData = $result->fetch_assoc();

    }
    return $unitData;
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];

    $sql = "SELECT * FROM projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $unitData = array();
    if ($result->num_rows > 0) {
        $unitNumbers = array();
        while ($row = $result->fetch_assoc()) {
            $unitData = $row;
            $units = explode(',', $row['units']);
            foreach ($units as $unit) {
                $dataFromTbl = getUnitData(trim($unit), $unitData['id']);
                if(!is_null($dataFromTbl)){
                $unitNumbers[] = $dataFromTbl;
                }else{
                    $unitNumbers[]  = array('unit_no'=>trim($unit));
                }
            }
            $unitData['units'] = $unitNumbers;

        }

       
        $stmt->close();
       
        $conn->close();
        header('Content-Type: application/json');
        echo json_encode($unitData);
        exit; 
    } else {
        echo "No units found for the selected project";
    }
} else {
    echo "Project ID not provided";
}

$conn->close();
?>
