<?php


include("db_config.php");

$conn = new mysqli($servername, $username, $password, $dbname);

function isUnitPresent($unitName, $projectId)
{
    $unitData = null;
    $sql = "SELECT * FROM `units` WHERE `project_id` ='$projectId' and `unit_no` = '$unitName'";
    $result = $GLOBALS['conn']->query($sql);

    if ($result->num_rows > 0) {
        $unitData = $result->fetch_assoc();

    }
    return $unitData;
}


$requestBody = file_get_contents('php://input');

// print_r($requestBody);
$requestBody = json_decode($requestBody, true);
// print_r($requestBody);


// error_log(print_r($unit, true));

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
foreach ($requestBody as $unit) {

    // print_r($unit);
    $project_id = $_GET['project_id'];

    $unit_nos = $unit['unit_no'];
    // print_r($unit_nos);
    $carpet_areas = $unit['carpet_area'];
    $statuses = $unit['status'];
    $agreement_dates = $unit['agreement_date'];
    $agreement_values = $unit['agreement_value'];
    $buyer_names = $unit['buyer_name'];
    $advances_2020_2021 = $unit['advance_2020_2021'];
    $advances_2021_2022 = $unit['advance_2021_2022'];
    $advances_2022_2023 = $unit['advance_2022_2023'];
    $advances_2023_2024 = $unit['advance_2023_2024'];
    $advances_2024_2025 = $unit['advance_2024_2025'];
    // $afs_details = $unit['afs'] ?? [];
    // $sd_details = $unit['sd'] ?? [];


    // if (!isset($unit_nos)) {
    //     print_r("No unit data provided.");
    //     continue;
    // }
    $total_received = $advances_2020_2021 + $advances_2021_2022 + $advances_2022_2023 + $advances_2023_2024 + $advances_2024_2025;
    $balance = $agreement_values - $total_received;
    // print_r($buyer_names);

    $unitData = isUnitPresent( $unit_nos,$project_id);
    
    $unitId = null;
    if (is_null($unitData)) {
        $stmt = $conn->prepare("INSERT INTO units (project_id, unit_no, carpet_area, status, agreement_date, agreement_value, buyer_name, advance_2020_2021, advance_2021_2022, advance_2022_2023, advance_2023_2024, advance_2024_2025, total_received, balance, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

        $stmt->bind_param("issssssdddddds", $project_id, $unit_nos, $carpet_areas, $statuses, $agreement_dates, $agreement_values, $buyer_names, $advances_2020_2021, $advances_2021_2022, $advances_2022_2023, $advances_2023_2024, $advances_2024_2025, $total_received, $balance);
        $stmt->execute();
        $unitId = $stmt->insert_id;
        $stmt->close();
    } else {
        $unitId = $unitData['id'];
        $sql = "UPDATE `units` SET `carpet_area`='$carpet_areas',`status`='$statuses',`agreement_date`='$agreement_dates',`agreement_value`='$agreement_values',`buyer_name`='$buyer_names',`advance_2020_2021`='$advances_2020_2021',`advance_2021_2022`='$advances_2021_2022',`advance_2022_2023`='$advances_2022_2023',`advance_2023_2024`='$advances_2023_2024',`advance_2024_2025`='$advances_2024_2025',`total_received`='$total_received',`balance`='$balance'  WHERE `id` = '$unitId'";
        // print_r($sql);
        $conn->query($sql);


    }
    // print_r($stmt);

    if (isset($unitId)) {
        
        // print_r($stmt);

        // if (!empty($afs_details[$i])) {
        //     $afs_deed_number = $afs_details[$i]['afs_deed_number'] ?? '';
        //     $upload_documents = $afs_details[$i]['upload_documents'] ?? '';

        //     $stmt_afs = $conn->prepare("INSERT INTO afs (unit_id, afs_deed_number, upload_documents, created_at, updated_at)
        //                                  VALUES (?, ?, ?, NOW(), NOW())");
        //     $stmt_afs->bind_param("iss", $unit_id, $afs_deed_number, $upload_documents);
        //     $stmt_afs->execute();
        // }

        // if (!empty($sd_details[$i])) {
        //     $sd_deed_number = $sd_details[$i]['sd_deed_number'] ?? '';
        //     $upload_documents = $sd_details[$i]['upload_documents'] ?? '';

        //     $stmt_sd = $conn->prepare("INSERT INTO sd (unit_id, sd_deed_number, upload_documents, created_at, updated_at)
        //                                 VALUES (?, ?, ?, NOW(), NOW())");
        //     $stmt_sd->bind_param("iss", $unit_id, $sd_deed_number, $upload_documents);
        //     $stmt_sd->execute();
        // }

    } else {
        echo "Error: " . $stmt->error;
    }

}


$conn->close();
echo "Data saved successfully.";
?>