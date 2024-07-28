<?php
    include("db_config.php");
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
    $sql = "SELECT internal_roads_select, internal_roads_percentage, internal_roads_details, 
            water_supply_select, water_supply_percentage, water_supply_details, 
            sewerage_select, sewerage_percentage, sewerage_details, 
            storm_water_drains_select, storm_water_drains_percentage, storm_water_drains_details, 
            landscaping_select, landscaping_percentage, landscaping_details, 
            street_lighting_select, street_lighting_percentage, street_lighting_details, 
            community_buildings_select, community_buildings_percentage, community_buildings_details, 
            sewage_treatment_select, sewage_treatment_percentage, sewage_treatment_details, 
            solid_waste_management_select, solid_waste_management_percentage, solid_waste_management_details, 
            water_conservation_select, water_conservation_percentage, water_conservation_details, 
            energy_management_select, energy_management_percentage, energy_management_details, fire_protection_select,fire_protection_percentage,
            fire_protection_details,electrical_room_select,electrical_room_percentage,electrical_room_details,
            miscellaneous_select, miscellaneous_percentage, miscellaneous_details, 
            last_updated 
            FROM infrastructure WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    echo json_encode($data);
}

$conn->close();
?>
