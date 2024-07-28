<?php
    include("db_config.php");


$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $project_id = $_POST['project_id'];
    $unit_no = $_POST['unit_no'];
    $carpet_area = $_POST['carpet_area'];
    $status = $_POST['status'];
    $agreement_date = $_POST['agreement_date'];
    $agreement_value = $_POST['agreement_value'];
    $buyer_name = $_POST['buyer_name'];
    $advance_2020_2021 = $_POST['advance_2020_2021'];
    $advance_2021_2022 = $_POST['advance_2021_2022'];
    $advance_2022_2023 = $_POST['advance_2022_2023'];
    $advance_2023_2024 = $_POST['advance_2023_2024'];
    $advance_2024_2025 = $_POST['advance_2024_2025'];
    $total_received = $_POST['total_received'];
    $balance = $_POST['balance'];

    $sql = "INSERT INTO project_units (project_id, unit_no, carpet_area, status, agreement_date, agreement_value, buyer_name, advance_2020_2021, advance_2021_2022, advance_2022_2023, advance_2023_2024, advance_2024_2025, total_received, balance) VALUES ('$project_id', '$unit_no', '$carpet_area', '$status', '$agreement_date', '$agreement_value', '$buyer_name', '$advance_2020_2021', '$advance_2021_2022', '$advance_2022_2023', '$advance_2023_2024', '$advance_2024_2025', '$total_received', '$balance')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
