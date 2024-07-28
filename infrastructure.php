<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("db_config.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function checkIfProjectExists($project_id)
{
    $infra = null;
    $sql = "SELECT * FROM `infrastructure` WHERE project_id ='$project_id'";
    $result = $GLOBALS['conn']->query($sql);

    if ($result->num_rows > 0) {
        $infra = $result->fetch_assoc();

    }
    return $infra;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize input
    $project_id = $conn->real_escape_string($_POST['project_id']);
    $internal_roads_select = $conn->real_escape_string($_POST['internal_roads_select']);
    $internal_roads_percentage = !empty($_POST['internal_roads_percentage']) ? (int) $_POST['internal_roads_percentage'] : 0; // Default to 0
    $internal_roads_details = $conn->real_escape_string($_POST['internal_roads_details']);

    $water_supply_select = $conn->real_escape_string($_POST['water_supply_select']);
    $water_supply_percentage = !empty($_POST['water_supply_percentage']) ? (int) $_POST['water_supply_percentage'] : 0; // Default to 0
    $water_supply_details = $conn->real_escape_string($_POST['water_supply_details']);

    $sewerage_select = $conn->real_escape_string($_POST['sewerage_select']);
    $sewerage_percentage = !empty($_POST['sewerage_percentage']) ? (int) $_POST['sewerage_percentage'] : 0; // Default to 0
    $sewerage_details = $conn->real_escape_string($_POST['sewerage_details']);

    $storm_water_drains_select = $conn->real_escape_string($_POST['storm_water_drains_select']);
    $storm_water_drains_percentage = !empty($_POST['storm_water_drains_percentage']) ? (int) $_POST['storm_water_drains_percentage'] : 0; // Default to 0
    $storm_water_drains_details = $conn->real_escape_string($_POST['storm_water_drains_details']);

    $landscaping_select = $conn->real_escape_string($_POST['landscaping_select']);
    $landscaping_percentage = !empty($_POST['landscaping_percentage']) ? (int) $_POST['landscaping_percentage'] : 0; // Default to 0
    $landscaping_details = $conn->real_escape_string($_POST['landscaping_details']);

    $street_lighting_select = $conn->real_escape_string($_POST['street_lighting_select']);
    $street_lighting_percentage = !empty($_POST['street_lighting_percentage']) ? (int) $_POST['street_lighting_percentage'] : 0; // Default to 0
    $street_lighting_details = $conn->real_escape_string($_POST['street_lighting_details']);

    $community_buildings_select = $conn->real_escape_string($_POST['community_buildings_select']);
    $community_buildings_percentage = !empty($_POST['community_buildings_percentage']) ? (int) $_POST['community_buildings_percentage'] : 0; // Default to 0
    $community_buildings_details = $conn->real_escape_string($_POST['community_buildings_details']);

    $sewage_treatment_select = $conn->real_escape_string($_POST['sewage_treatment_select']);
    $sewage_treatment_percentage = !empty($_POST['sewage_treatment_percentage']) ? (int) $_POST['sewage_treatment_percentage'] : 0; // Default to 0
    $sewage_treatment_details = $conn->real_escape_string($_POST['sewage_treatment_details']);

    $solid_waste_management_select = $conn->real_escape_string($_POST['solid_waste_management_select']);
    $solid_waste_management_percentage = !empty($_POST['solid_waste_management_percentage']) ? (int) $_POST['solid_waste_management_percentage'] : 0; // Default to 0
    $solid_waste_management_details = $conn->real_escape_string($_POST['solid_waste_management_details']);

    $water_conservation_select = $conn->real_escape_string($_POST['water_conservation_select']);
    $water_conservation_percentage = !empty($_POST['water_conservation_percentage']) ? (int) $_POST['water_conservation_percentage'] : 0; // Default to 0
    $water_conservation_details = $conn->real_escape_string($_POST['water_conservation_details']);

    $energy_management_select = $conn->real_escape_string($_POST['energy_management_select']);
    $energy_management_percentage = !empty($_POST['energy_management_percentage']) ? (int) $_POST['energy_management_percentage'] : 0; // Default to 0
    $energy_management_details = $conn->real_escape_string($_POST['energy_management_details']);

    $fire_protection_select = $conn->real_escape_string($_POST['fire_protection_select']);
    $fire_protection_percentage = !empty($_POST['fire_protection_percentage']) ? (int) $_POST['fire_protection_percentage'] : 0;
    $fire_protection_details = $conn->real_escape_string($_POST['fire_protection_details']);

    $electrical_room_select = $conn->real_escape_string($_POST['electrical_room_select']);
    $electrical_room_percentage = !empty($_POST['electrical_room_percentage']) ? (int) $_POST['electrical_room_percentage'] : 0;
    $electrical_room_details = $conn->real_escape_string($_POST['electrical_room_details']);

    $miscellaneous_select = $conn->real_escape_string($_POST['miscellaneous_select']);
    $miscellaneous_percentage = !empty($_POST['miscellaneous_percentage']) ? (int) $_POST['miscellaneous_percentage'] : 0; // Default to 0
    $miscellaneous_details = $conn->real_escape_string($_POST['miscellaneous_details']);


    $infra = checkIfProjectExists($project_id);

    if (is_null($infra)) {

        // Prepare and execute the SQL statement
        $sql = "INSERT INTO infrastructure (project_id, internal_roads_select, internal_roads_percentage, internal_roads_details, 
            water_supply_select, water_supply_percentage, water_supply_details, 
            sewerage_select, sewerage_percentage, sewerage_details, 
            storm_water_drains_select, storm_water_drains_percentage, storm_water_drains_details, 
            landscaping_select, landscaping_percentage, landscaping_details, 
            street_lighting_select, street_lighting_percentage, street_lighting_details, 
            community_buildings_select, community_buildings_percentage, community_buildings_details, 
            sewage_treatment_select, sewage_treatment_percentage, sewage_treatment_details, 
            solid_waste_management_select, solid_waste_management_percentage, solid_waste_management_details, 
            water_conservation_select, water_conservation_percentage, water_conservation_details, 
            energy_management_select, energy_management_percentage, energy_management_details, 
            miscellaneous_select, miscellaneous_percentage, miscellaneous_details,
            fire_protection_select, fire_protection_percentage, fire_protection_details, 
            electrical_room_select, electrical_room_percentage, electrical_room_details) 
            VALUES ('$project_id', '$internal_roads_select', '$internal_roads_percentage', '$internal_roads_details', 
                    '$water_supply_select', '$water_supply_percentage', '$water_supply_details', 
                    '$sewerage_select', '$sewerage_percentage', '$sewerage_details', 
                    '$storm_water_drains_select', '$storm_water_drains_percentage', '$storm_water_drains_details', 
                    '$landscaping_select', '$landscaping_percentage', '$landscaping_details', 
                    '$street_lighting_select', '$street_lighting_percentage', '$street_lighting_details', 
                    '$community_buildings_select', '$community_buildings_percentage', '$community_buildings_details', 
                    '$sewage_treatment_select', '$sewage_treatment_percentage', '$sewage_treatment_details', 
                    '$solid_waste_management_select', '$solid_waste_management_percentage', '$solid_waste_management_details', 
                    '$water_conservation_select', '$water_conservation_percentage', '$water_conservation_details', 
                    '$energy_management_select', '$energy_management_percentage', '$energy_management_details', 
                    '$miscellaneous_select', '$miscellaneous_percentage', '$miscellaneous_details',
                    '$fire_protection_select', '$fire_protection_percentage', '$fire_protection_details',
                    '$electrical_room_select', '$electrical_room_percentage', '$electrical_room_details')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $infraId =$infra['id'];
        $sql = "UPDATE `infrastructure` SET `internal_roads_select`='$internal_roads_select',
            `internal_roads_percentage`='$internal_roads_percentage',`internal_roads_details`='$internal_roads_details',`water_supply_select`='$water_supply_select',
            `water_supply_percentage`='$water_supply_percentage',`water_supply_details`='$water_supply_details',`sewerage_select`='$sewerage_select',
            `sewerage_percentage`='$sewerage_percentage',`sewerage_details`='$sewerage_details',`storm_water_drains_select`='$storm_water_drains_select',
            `storm_water_drains_percentage`='$storm_water_drains_percentage',`storm_water_drains_details`='$storm_water_drains_details',
            `landscaping_select`='$landscaping_select',`landscaping_percentage`='$landscaping_percentage',`landscaping_details`='$landscaping_details',
            `street_lighting_select`='$street_lighting_select',`street_lighting_percentage`='$street_lighting_percentage',
            `street_lighting_details`='$street_lighting_details',`community_buildings_select`='$community_buildings_select',
            `community_buildings_percentage`='$community_buildings_percentage',`community_buildings_details`='$community_buildings_details',
            `sewage_treatment_select`='$sewage_treatment_select',`sewage_treatment_percentage`='$sewage_treatment_percentage',
            `sewage_treatment_details`='$sewage_treatment_details',`solid_waste_management_select`='$solid_waste_management_select',
            `solid_waste_management_percentage`='$solid_waste_management_percentage',`solid_waste_management_details`='$solid_waste_management_details',
            `water_conservation_select`='$water_conservation_select',`water_conservation_percentage`='$water_conservation_percentage',
            `water_conservation_details`='$water_conservation_details',`energy_management_select`='$energy_management_select',
            `energy_management_percentage`='$energy_management_percentage',`energy_management_details`='$energy_management_details',
            `miscellaneous_select`='$miscellaneous_select',`miscellaneous_percentage`='$miscellaneous_percentage',
            `miscellaneous_details`='$miscellaneous_details',`fire_protection_select`='$fire_protection_select',`fire_protection_percentage`='$fire_protection_percentage',`fire_protection_details`='$fire_protection_details',
            `electrical_room_select`='$electrical_room_select',`electrical_room_percentage`='$electrical_room_percentage',
            `electrical_room_details`='$electrical_room_details' WHERE `id`='$infraId'";
    $conn->query($sql);
    }
}
$conn->close();
?>