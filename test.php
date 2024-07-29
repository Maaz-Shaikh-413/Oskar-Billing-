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


// print_r($projectCost['planning_authority']);


require_once 'PHPWord/src/PhpWord/Autoloader.php'; // Adjust the path as needed
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// // Creating the new document...
// $phpWord = new \PhpOffice\PhpWord\PhpWord();


$phpWord = IOFactory::load('assets/original-docs/new-inventory-doc.docx'); // Path to your existing document

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
        foreach ($units as $unit) {
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
    '$client_name' => getValue($project, 'client_name'),
    '$project_address' => getValue($project, 'project_address'),
    '$maharera_number' => getValue($project, 'maharera_number'),
    '$project_name' => getValue($project, 'project_name'),
    '$architect_name' => getValue($project, 'architect_name'),
    '$engineer_name' => getValue($project, 'engineer_name'),
    '$planning_authority' => getValue($project_costs, 'planning_authority'),
    '$balance_incurred' => getValue($project_costs, 'balance_incurred'),
    '$estimated_cost' => getValue($project_costs, 'estimated_cost'),
    '$incurred_cost' => getValue($project_costs, 'incurred_cost'),
    '$internal_roads_select' => getValue($infrastructure, 'internal_roads_select'),
    '$internal_roads_percentage' => getValue($infrastructure, 'internal_roads_percentage'),
    '$internal_roads_details' => getValue($infrastructure, 'internal_roads_details'),
    '$water_supply_select' => getValue($infrastructure, 'water_supply_select'),
    '$water_supply_percentage' => getValue($infrastructure, 'water_supply_percentage'),
    '$water_supply_details' => getValue($infrastructure, 'water_supply_details'),
    '$sewerage_select' => getValue($infrastructure, 'sewerage_select'),
    '$sewerage_percentage' => getValue($infrastructure, 'sewerage_percentage'),
    '$sewerage_details' => getValue($infrastructure, 'sewerage_details'),
    '$storm_water_drains_select' => getValue($infrastructure, 'storm_water_drains_select'),
    '$storm_water_drains_percentage' => getValue($infrastructure, 'storm_water_drains_percentage'),
    '$storm_water_drains_details' => getValue($infrastructure, 'storm_water_drains_details'),
    '$landscaping_select' => getValue($infrastructure, 'landscaping_select'),
    '$landscaping_percentage' => getValue($infrastructure, 'landscaping_percentage'),
    '$landscaping_details' => getValue($infrastructure, 'landscaping_details'),
    '$street_lighting_select' => getValue($infrastructure, 'street_lighting_select'),
    '$street_lighting_percentage' => getValue($infrastructure, 'street_lighting_percentage'),
    '$street_lighting_details' => getValue($infrastructure, 'street_lighting_details'),
    '$community_buildings_select' => getValue($infrastructure, 'community_buildings_select'),
    '$community_buildings_percentage' => getValue($infrastructure, 'community_buildings_percentage'),
    '$community_buildings_details' => getValue($infrastructure, 'community_buildings_details'),
    '$sewage_treatment_select' => getValue($infrastructure, 'sewage_treatment_select'),
    '$sewage_treatment_percentage' => getValue($infrastructure, 'sewage_treatment_percentage'),
    '$sewage_treatment_details' => getValue($infrastructure, 'sewage_treatment_details'),
    '$solid_waste_management_select' => getValue($infrastructure, 'solid_waste_management_select'),
    '$solid_waste_management_percentage' => getValue($infrastructure, 'solid_waste_management_percentage'),
    '$solid_waste_management_details' => getValue($infrastructure, 'solid_waste_management_details'),
    '$water_conservation_select' => getValue($infrastructure, 'water_conservation_select'),
    '$water_conservation_percentage' => getValue($infrastructure, 'water_conservation_percentage'),
    '$water_conservation_details' => getValue($infrastructure, 'water_conservation_details'),
    '$energy_management_select' => getValue($infrastructure, 'energy_management_select'),
    '$energy_management_percentage' => getValue($infrastructure, 'energy_management_percentage'),
    '$energy_management_details' => getValue($infrastructure, 'energy_management_details'),
    '$fire_protection_select' => getValue($infrastructure, 'fire_protection_select'),
    '$fire_protection_percentage' => getValue($infrastructure, 'fire_protection_percentage'),
    '$fire_protection_details' => getValue($infrastructure, 'fire_protection_details'),
    '$electrical_room_select' => getValue($infrastructure, 'electrical_room_select'),
    '$electrical_room_percentage' => getValue($infrastructure, 'electrical_room_percentage'),
    '$electrical_room_details' => getValue($infrastructure, 'electrical_room_details'),
    '$miscellaneous_select' => getValue($infrastructure, 'miscellaneous_select'),
    '$miscellaneous_percentage' => getValue($infrastructure, 'miscellaneous_percentage'),
    '$miscellaneous_details' => getValue($infrastructure, 'miscellaneous_details'),
    '$excavation' => getValue($siteProgress, 'excavation'),
    '$basements' => getValue($siteProgress, 'basements'),
    '$podiums' => getValue($siteProgress, 'podiums'),
    '$plinth' => getValue($siteProgress, 'plinth'),
    '$stilt_floor' => getValue($siteProgress, 'stilt_floor'),
    '$super_structure_slabs' => getValue($siteProgress, 'super_structure_slabs'),
    '$internal_walls' => getValue($siteProgress, 'internal_walls'),
    '$sanitary_fittings' => getValue($siteProgress, 'sanitary_fittings'),
    '$staircases' => getValue($siteProgress, 'staircases'),
    '$external_plumbing' => getValue($siteProgress, 'external_plumbing'),
    '$fire_fighting_arrangements' => getValue($siteProgress, 'fire_fighting_arrangements'),
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
$phpWord->save('modified_document.docx', 'Word2007', true);

// Output success message
echo "Document modified successfully: modified_document.docx";
