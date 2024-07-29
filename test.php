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

    $project = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($project,$row);
            
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


// $requestFileName = $_GET['fileName'];
$requestProjectId = $_GET['projectId'];

// if (!isset($requestProjectId) || !isset($requestFileName)) {
//     echo "Check Request Params";
//     return;
// }
// $requestProjectId = 8;


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


// print_r($units);


require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// // Creating the new document...
// $phpWord = new \PhpOffice\PhpWord\PhpWord();


$phpWord = IOFactory::load('assets/original-docs/Form 1 - Architect-2.docx'); // Path to your existing document

// Define the tokens and their replacements
$replacements = [
    '$TABLE_ALL_UNITS' => function ($section) {
        // Create a new table
        $table = $section->addTable();

        $table->addRow();
        $table->addCell(2000)->addText('Sr. no');
        $table->addCell(2000)->addText('Floor/Wing');
        $table->addCell(2000)->addText('Flat no. / shop no. / office no. / Plot no./Row House no. etc.');

        $table->addCell(2000)->addText('Unit Carpet Area (Sq. Meter)');
        $table->addCell(2000)->addText('Sold/Booked/Unsold Reserved / Rehab/ Mortgaged/ Not for sale');
        $table->addCell(2000)->addText('Registration date of Subregistrar');
        $srIndex = 1;
        
        // echo "UNITS";
        // print_r($GLOBALS['units'] );
        foreach ($GLOBALS['units'] as $unit) {
            
            $table->addRow();
            $table->addCell(2000)->addText($srIndex);
            $table->addCell(2000)->addText('Floor/Wing');
            $table->addCell(2000)->addText($unit['unit_no']);

            $table->addCell(2000)->addText($unit['carpet_area']);
            $table->addCell(2000)->addText($unit['status']);
            $table->addCell(2000)->addText($unit['agreement_date']);
            $srIndex++;
            
        }
    },
    '$client_name' => getValue($GLOBALS['project'], 'client_name'),
    '$project_address' => getValue($GLOBALS['project'], 'project_address'),
    '$maharera_number' => 'THIS IS MAHARERANUMBER',
    '$project_name' => getValue($GLOBALS['project'], 'project_name'),
    '$architect_name' => getValue($GLOBALS['project'], 'architect_name'),
    '$engineer_name' => getValue($GLOBALS['project'], 'engineer_name'),
    '$planning_authority' => getValue($GLOBALS['project_costs'], 'planning_authority'),
    '$balance_incurred' => getValue($GLOBALS['project_costs'], 'balance_incurred'),
    '$estimated_cost' => getValue($GLOBALS['project_costs'], 'estimated_cost'),
    '$incurred_cost' => getValue($GLOBALS['project_costs'], 'incurred_cost'),
    '$internal_roads_select' => getValue($GLOBALS['infrastructure'], 'internal_roads_select'),
    '$internal_roads_percentage' => getValue($GLOBALS['infrastructure'], 'internal_roads_percentage'),
    '$internal_roads_details' => getValue($GLOBALS['infrastructure'], 'internal_roads_details'),
    '$water_supply_select' => getValue($GLOBALS['infrastructure'], 'water_supply_select'),
    '$water_supply_percentage' => getValue($GLOBALS['infrastructure'], 'water_supply_percentage'),
    '$water_supply_details' => getValue($GLOBALS['infrastructure'], 'water_supply_details'),
    '$sewerage_select' => getValue($GLOBALS['infrastructure'], 'sewerage_select'),
    '$sewerage_percentage' => getValue($GLOBALS['infrastructure'], 'sewerage_percentage'),
    '$sewerage_details' => getValue($GLOBALS['infrastructure'], 'sewerage_details'),
    '$storm_water_drains_select' => getValue($GLOBALS['infrastructure'], 'storm_water_drains_select'),
    '$storm_water_drains_percentage' => getValue($GLOBALS['infrastructure'], 'storm_water_drains_percentage'),
    '$storm_water_drains_details' => getValue($GLOBALS['infrastructure'], 'storm_water_drains_details'),
    '$landscaping_select' => getValue($GLOBALS['infrastructure'], 'landscaping_select'),
    '$landscaping_percentage' => getValue($GLOBALS['infrastructure'], 'landscaping_percentage'),
    '$landscaping_details' => getValue($GLOBALS['infrastructure'], 'landscaping_details'),
    '$street_lighting_select' => getValue($GLOBALS['infrastructure'], 'street_lighting_select'),
    '$street_lighting_percentage' => getValue($GLOBALS['infrastructure'], 'street_lighting_percentage'),
    '$street_lighting_details' => getValue($GLOBALS['infrastructure'], 'street_lighting_details'),
    '$community_buildings_select' => getValue($GLOBALS['infrastructure'], 'community_buildings_select'),
    '$community_buildings_percentage' => getValue($GLOBALS['infrastructure'], 'community_buildings_percentage'),
    '$community_buildings_details' => getValue($GLOBALS['infrastructure'], 'community_buildings_details'),
    '$sewage_treatment_select' => getValue($GLOBALS['infrastructure'], 'sewage_treatment_select'),
    '$sewage_treatment_percentage' => getValue($GLOBALS['infrastructure'], 'sewage_treatment_percentage'),
    '$sewage_treatment_details' => getValue($GLOBALS['infrastructure'], 'sewage_treatment_details'),
    '$solid_waste_management_select' => getValue($GLOBALS['infrastructure'], 'solid_waste_management_select'),
    '$solid_waste_management_percentage' => getValue($GLOBALS['infrastructure'], 'solid_waste_management_percentage'),
    '$solid_waste_management_details' => getValue($GLOBALS['infrastructure'], 'solid_waste_management_details'),
    '$water_conservation_select' => getValue($GLOBALS['infrastructure'], 'water_conservation_select'),
    '$water_conservation_percentage' => getValue($GLOBALS['infrastructure'], 'water_conservation_percentage'),
    '$water_conservation_details' => getValue($GLOBALS['infrastructure'], 'water_conservation_details'),
    '$energy_management_select' => getValue($GLOBALS['infrastructure'], 'energy_management_select'),
    '$energy_management_percentage' => getValue($GLOBALS['infrastructure'], 'energy_management_percentage'),
    '$energy_management_details' => getValue($GLOBALS['infrastructure'], 'energy_management_details'),
    '$fire_protection_select' => getValue($GLOBALS['infrastructure'], 'fire_protection_select'),
    '$fire_protection_percentage' => getValue($GLOBALS['infrastructure'], 'fire_protection_percentage'),
    '$fire_protection_details' => getValue($GLOBALS['infrastructure'], 'fire_protection_details'),
    '$electrical_room_select' => getValue($GLOBALS['infrastructure'], 'electrical_room_select'),
    '$electrical_room_percentage' => getValue($GLOBALS['infrastructure'], 'electrical_room_percentage'),
    '$electrical_room_details' => getValue($GLOBALS['infrastructure'], 'electrical_room_details'),
    '$miscellaneous_select' => getValue($GLOBALS['infrastructure'], 'miscellaneous_select'),
    '$miscellaneous_percentage' => getValue($GLOBALS['infrastructure'], 'miscellaneous_percentage'),
    '$miscellaneous_details' => getValue($GLOBALS['infrastructure'], 'miscellaneous_details'),
    '$excavation' => getValue($GLOBALS['siteProgress'], 'excavation'),
    '$basements' => getValue($GLOBALS['siteProgress'], 'basements'),
    '$podiums' => getValue($GLOBALS['siteProgress'], 'podiums'),
    '$plinth' => getValue($GLOBALS['siteProgress'], 'plinth'),
    '$stilt_floor' => getValue($GLOBALS['siteProgress'], 'stilt_floor'),
    '$super_structure_slabs' => getValue($GLOBALS['siteProgress'], 'super_structure_slabs'),
    '$internal_walls' => getValue($GLOBALS['siteProgress'], 'internal_walls'),
    '$sanitary_fittings' => getValue($GLOBALS['siteProgress'], 'sanitary_fittings'),
    '$staircases' => getValue($GLOBALS['siteProgress'], 'staircases'),
    '$external_plumbing' => getValue($GLOBALS['siteProgress'], 'external_plumbing'),
    '$fire_fighting_arrangements' => getValue($GLOBALS['siteProgress'], 'fire_fighting_arrangements'),
];

// Iterate through each section to find and replace tokens
$sections = $phpWord->getSections();

foreach ($sections as $section) {
    foreach ($section->getElements() as $element) {
        // Check if the element has text
        if (method_exists($element, 'getText')) {
            $text = $element->getText();

            // Check if the text matches any token
            foreach ($replacements as $token => $replacement) {
                if ($text === $token) {
                    if (is_callable($replacement)) {
                        // If the replacement is a callable (for the table)
                        $section->removeElement($element);
                        $replacement($section);
                    } else {
                        // Otherwise, replace with the text
                        $element->setText($replacement);
                    }
                }
            }
        }
    }
}

// Save the modified document

// Save the document temporarily
$tempFile = 'tempdir/temp_document.docx';
$phpWord->save($tempFile, 'Word2007');



$zip_val = new ZipArchive;
if ($zip_val->open($tempFile) == true) {

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
    header('Content-Length: ' . filesize($tempFile));
    readfile($tempFile);
    unlink($tempFile);
    exit;
} else {
    echo "UNABLE To Unzip";
}

