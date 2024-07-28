<?php
include("db_config.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $unit_id = $_POST['unit_id'];

    $sql = "DELETE FROM project_units WHERE id = '$unit_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
