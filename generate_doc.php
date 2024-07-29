<?php

function getProjectDetails($projectId)
{
    include("db_config.php");


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `projects`  where `projects`.`id` = '$projectId'";
    $result = $conn->query($sql);

    $project = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = $row;
            break;
        }
    }

    $conn->close();

    return $project;
}

function getProjectCost($projectId)
{
    include("db_config.php");

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `project_costs` WHERE `project_costs`.`project_id` =  '$projectId' ORDER BY created_at DESC LIMIT 1";
    $result = $conn->query($sql);

    $project = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = $row;
            break;
        }
    }

    $conn->close();

    return $project;
}

function getSiteProgress($projectId)
{
    include("db_config.php");


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `site_progress` WHERE `project_id` =  '$projectId'";
    $result = $conn->query($sql);

    $project = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = $row;
            break;
        }
    }
    $conn->close();

    return $project;
}

function getInfrastructure($projectId)
{
    include("db_config.php");


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `infrastructure` WHERE `project_id` = '$projectId' ORDER BY last_updated DESC LIMIT 1";
    $result = $conn->query($sql);

    $project = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = $row;
            break;
        }
    }

    $conn->close();

    return $project;
}


function getUnitDetails($projectId)
{
    include("db_config.php");


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `units` WHERE  `project_id` = '$projectId'";
    $result = $conn->query($sql);

    $project = null;

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $project = $row;
            break;
        }
    }

    $conn->close();

    return $project;
}

function getValue($obj, $key)
{
    $value = '';
    // if (!is_null($obj) && isset($obj['excavation'])) {
    //     $message = str_replace('$PROMOTER_NAME', $siteProgress['excavation'], $message);
    // }

    if (!is_null($obj)  && key_exists($key, $obj)) {
        $value = $obj[$key];
    }
    return $value;
}


$requestFileName = $_GET['fileName'];
$requestProjectId = $_GET['projectId'];

if (!isset($requestProjectId) || !isset($requestFileName)) {
    echo "Check Request Params";
    return;
}


$project = getProjectDetails($requestProjectId);

if (is_null($project)) {
    echo "PROJECT IS NULL";
    return;
}

$project_costs = getProjectCost($requestProjectId);

// if (is_null($projectCost)) {
//     echo "PROJECT COST IS NULL";
//     return;
// }

$siteProgress = getSiteProgress($requestProjectId);


// if (is_null($projectCost)) {
//     echo "Site Progress IS NULL";
//     return;
// }

$infrastructure = getInfrastructure($requestProjectId);

// if (is_null($projectCost)) {
//     echo "Infrastructure IS NULL";
//     return;
// }

$units = getUnitDetails($requestProjectId);


// print_r($projectCost['planning_authority']);







$filePath = './assets/original-docs/' . $requestFileName;

$fileToSavePath = './assets/modified/';
$fileName = $requestFileName;
$fullPathToSave = $fileToSavePath . $fileName;
if (!file_exists($fileToSavePath)) {
    mkdir($fileToSavePath);
    // print_r('PATH CREATED ' . $fileToSavePath);
}




copy($filePath, $fullPathToSave);




$zip_val = new ZipArchive;
if ($zip_val->open($fullPathToSave) == true) {

    $key_file_name = 'word/document.xml';
    if (strpos($requestFileName, '.xlsx') !== false) {
        $key_file_name = 'xl/sharedStrings.xml';
    }
    $message = $zip_val->getFromName($key_file_name);



    //project
    $message = str_replace('$client_name', getValue($project, 'client_name'), $message);
    $message = str_replace('$project_address', getValue($project, 'project_address'), $message);
    $message = str_replace('$maharera_number', getValue($project, 'maharera_number'), $message);
    $message = str_replace('$project_name', getValue($project, 'project_name'), $message);
    $message = str_replace('$architect_name', getValue($project, 'architect_name'), $message);
    $message = str_replace('$engineer_name', getValue($project, 'engineer_name'), $message);

    //project_cost
    $message = str_replace('$planning_authority', getValue($project_costs, 'planning_authority'), $message);
    $message = str_replace('$balance_incurred', getValue($project_costs, 'balance_incurred'), $message);
    $message = str_replace('$estimated_cost', getValue($project_costs, 'estimated_cost'), $message);
    $message = str_replace('$incurred_cost', getValue($project_costs, 'incurred_cost'), $message);



    //infrastructure
    $message = str_replace('$internal_roads_select', getValue($infrastructure, 'internal_roads_select'), $message);
    $message = str_replace('$internal_roads_percentage', getValue($infrastructure, 'internal_roads_percentage'), $message);
    $message = str_replace('$internal_roads_details', getValue($infrastructure, 'internal_roads_details'), $message);

    $message = str_replace('$water_supply_select', getValue($infrastructure, 'water_supply_select'), $message);
    $message = str_replace('$water_supply_percentage', getValue($infrastructure, 'water_supply_percentage'), $message);
    $message = str_replace('$water_supply_details', getValue($infrastructure, 'water_supply_details'), $message);

    $message = str_replace('$sewerage_select', getValue($infrastructure, 'sewerage_select'), $message);
    $message = str_replace('$sewerage_percentage', getValue($infrastructure, 'sewerage_percentage'), $message);
    $message = str_replace('$sewerage_details', getValue($infrastructure, 'sewerage_details'), $message);

    $message = str_replace('$storm_water_drains_select', getValue($infrastructure, 'storm_water_drains_select'), $message);
    $message = str_replace('$storm_water_drains_percentage', getValue($infrastructure, 'storm_water_drains_percentage'), $message);
    $message = str_replace('$storm_water_drains_details', getValue($infrastructure, 'storm_water_drains_details'), $message);

    $message = str_replace('$landscaping_select', getValue($infrastructure, 'landscaping_select'), $message);
    $message = str_replace('$landscaping_percentage', getValue($infrastructure, 'landscaping_percentage'), $message);
    $message = str_replace('$landscaping_details', getValue($infrastructure, 'landscaping_details'), $message);

    $message = str_replace('$street_lighting_select', getValue($infrastructure, 'street_lighting_select'), $message);
    $message = str_replace('$street_lighting_percentage', getValue($infrastructure, 'street_lighting_percentage'), $message);
    $message = str_replace('$street_lighting_details', getValue($infrastructure, 'street_lighting_details'), $message);

    $message = str_replace('$community_buildings_select', getValue($infrastructure, 'community_buildings_select'), $message);
    $message = str_replace('$community_buildings_percentage', getValue($infrastructure, 'community_buildings_percentage'), $message);
    $message = str_replace('$community_buildings_details', getValue($infrastructure, 'community_buildings_details'), $message);

    $message = str_replace('$sewage_treatment_select', getValue($infrastructure, 'sewage_treatment_select'), $message);
    $message = str_replace('$sewage_treatment_percentage', getValue($infrastructure, 'sewage_treatment_percentage'), $message);
    $message = str_replace('$sewage_treatment_details', getValue($infrastructure, 'sewage_treatment_details'), $message);

    $message = str_replace('$solid_waste_management_select', getValue($infrastructure, 'solid_waste_management_select'), $message);
    $message = str_replace('$solid_waste_management_percentage', getValue($infrastructure, 'solid_waste_management_percentage'), $message);
    $message = str_replace('$solid_waste_management_details', getValue($infrastructure, 'solid_waste_management_details'), $message);

    $message = str_replace('$water_conservation_select', getValue($infrastructure, 'water_conservation_select'), $message);
    $message = str_replace('$water_conservation_percentage', getValue($infrastructure, 'water_conservation_percentage'), $message);
    $message = str_replace('$water_conservation_details', getValue($infrastructure, 'water_conservation_details'), $message);

    $message = str_replace('$energy_management_select', getValue($infrastructure, 'energy_management_select'), $message);
    $message = str_replace('$energy_management_percentage', getValue($infrastructure, 'energy_management_percentage'), $message);
    $message = str_replace('$energy_management_details', getValue($infrastructure, 'energy_management_details'), $message);

    $message = str_replace('$fire_protection_select', getValue($infrastructure, 'fire_protection_select'), $message);
    $message = str_replace('$fire_protection_percentage', getValue($infrastructure, 'fire_protection_percentage'), $message);
    $message = str_replace('$fire_protection_details', getValue($infrastructure, 'fire_protection_details'), $message);

    $message = str_replace('$electrical_room_select', getValue($infrastructure, 'electrical_room_select'), $message);
    $message = str_replace('$electrical_room_percentage', getValue($infrastructure, 'electrical_room_percentage'), $message);
    $message = str_replace('$electrical_room_details', getValue($infrastructure, 'electrical_room_details'), $message);

    $message = str_replace('$miscellaneous_select', getValue($infrastructure, 'miscellaneous_select'), $message);
    $message = str_replace('$miscellaneous_percentage', getValue($infrastructure, 'miscellaneous_percentage'), $message);
    $message = str_replace('$miscellaneous_details', getValue($infrastructure, 'miscellaneous_details'), $message);

    //site_progress

    $message = str_replace('$excavation', getValue($siteProgress, 'excavation'), $message);
    $message = str_replace('$basements', getValue($siteProgress, 'basements'), $message);
    $message = str_replace('$podiums', getValue($siteProgress, 'podiums'), $message);
    $message = str_replace('$plinth', getValue($siteProgress, 'plinth'), $message);
    $message = str_replace('$stilt_floor', getValue($siteProgress, 'stilt_floor'), $message);
    $message = str_replace('$super_structure_slabs', getValue($siteProgress, 'super_structure_slabs'), $message);
    $message = str_replace('$internal_walls', getValue($siteProgress, 'internal_walls'), $message);
    $message = str_replace('$sanitary_fittings', getValue($siteProgress, 'sanitary_fittings'), $message);
    $message = str_replace('$staircases', getValue($siteProgress, 'staircases'), $message);
    $message = str_replace('$external_plumbing', getValue($siteProgress, 'external_plumbing'), $message);
    $message = str_replace('$fire_fighting_arrangements', getValue($siteProgress, 'fire_fighting_arrangements'), $message);


    //DataTable

    



    if (strpos($requestFileName, '.xlsx') !== false) {
        // $key_file_name = 'xl/sharedStrings.xml';
    }


    /*
    $message = str_replace('$unit_nos', getValue($units,'unit_nos'), $message);
    $message = str_replace('$carpet_areas', getValue($units,'carpet_areas'), $message);
    $message = str_replace('$statuses', getValue($units,'statuses'), $message);
    $message = str_replace('$agreement_dates', getValue($units,'agreement_dates'), $message);
    $message = str_replace('$agreement_values', getValue($units,'agreement_values'), $message);
    $message = str_replace('$buyer_names', getValue($units,'buyer_names'), $message);
    $message = str_replace('$advances_2020_2021', getValue($units,'advances_2020_2021'), $message);
    $message = str_replace('$advances_2021_2022', getValue($units,'advances_2021_2022'), $message);
    $message = str_replace('$advances_2022_2023', getValue($units,'advances_2022_2023'), $message);
    $message = str_replace('$advances_2023_2024', getValue($units,'advances_2023_2024'), $message);
    $message = str_replace('$advances_2024_2025', getValue($units,'advances_2024_2025'), $message);
    $message = str_replace('$total_received', getValue($units,'total_received'), $message);
    $message = str_replace('$balance', getValue($units,'balance'), $message);
   
    */

    $zip_val->addFromString($key_file_name, $message);
    $zip_val->close();
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="' . $project['project_name'] . '-' . $fileName . '"');
    header('Content-Length: ' . filesize($fullPathToSave));
    readfile($fullPathToSave);
    unlink($fullPathToSave);
    exit;
} else {
    echo "UNABLE To Unzip";
}
