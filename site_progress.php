<?php
    include("db_config.php");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function sanitize_data($data) {
    return htmlspecialchars(trim($data));
}

function convert_to_int($data) {
    return !empty($data) ? (int)$data : 0;
}

$updated_at = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $project_id = sanitize_data($_POST['project_id']);
    $excavation = convert_to_int($_POST['excavation']);
    $basements = convert_to_int($_POST['basements']);
    $podiums = convert_to_int($_POST['podiums']);
    $plinth = convert_to_int($_POST['plinth']);
    $stilt_floor = convert_to_int($_POST['stilt_floor']);
    $super_structure_slabs = convert_to_int($_POST['super_structure_slabs']);
    $internal_walls = convert_to_int($_POST['internal_walls']);
    $sanitary_fittings = convert_to_int($_POST['sanitary_fittings']);
    $staircases = convert_to_int($_POST['staircases']);
    $external_plumbing = convert_to_int($_POST['external_plumbing']);
    $fire_fighting_arrangements = convert_to_int($_POST['fire_fighting_arrangements']);
    $civil_works = convert_to_int($_POST['civil_works']);
    $total_percentage = convert_to_int($_POST['total_percentage']);

    $sql = "INSERT INTO site_progress (project_id, excavation, basements, podiums, plinth, stilt_floor, super_structure_slabs, internal_walls, sanitary_fittings, staircases, external_plumbing, fire_fighting_arrangements, civil_works, total_percentage)
            VALUES ('$project_id', '$excavation', '$basements', '$podiums', '$plinth', '$stilt_floor', '$super_structure_slabs', '$internal_walls', '$sanitary_fittings', '$staircases', '$external_plumbing', '$fire_fighting_arrangements', '$civil_works', '$total_percentage')
            ON DUPLICATE KEY UPDATE excavation = '$excavation', basements = '$basements', podiums = '$podiums', plinth = '$plinth', stilt_floor = '$stilt_floor', super_structure_slabs = '$super_structure_slabs', internal_walls = '$internal_walls', sanitary_fittings = '$sanitary_fittings', staircases = '$staircases', external_plumbing = '$external_plumbing', fire_fighting_arrangements = '$fire_fighting_arrangements', civil_works = '$civil_works', total_percentage = '$total_percentage', updated_at = CURRENT_TIMESTAMP";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if (!empty($project_id)) {
    $sql = "SELECT updated_at FROM site_progress WHERE project_id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $project_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $updated_at = $row['updated_at'];
    }

    $stmt->close();
}

$conn->close();
?>