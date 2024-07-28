<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Circl - Responsive Admin Dashboard Template</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="assets/css/main.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body>
    <?php

include("db_config.php");


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM projects";
    $result = $conn->query($sql);


    $projects = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $projects[] = $row;
        }
    }

    $conn->close();
    ?>
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>

    <div class="page-container">
        <div class="page-header">
            <nav class="navbar navbar-expand-lg d-flex justify-content-between">
                <div class="" id="navbarNav">
                    <ul class="navbar-nav" id="leftNav">
                        <li class="nav-item">
                            <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Help</a>
                        </li>
                    </ul>
                </div>
                <div class="logo">
                    <a class="navbar-brand" href="index.html"></a>
                </div>
                <div class="" id="headerNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link search-dropdown" href="#" id="searchDropDown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i data-feather="search"></i></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-lg search-drop-menu"
                                aria-labelledby="searchDropDown">
                                <form>
                                    <input class="form-control" type="text" placeholder="Type something.."
                                        aria-label="Search">
                                </form>
                                <h6 class="dropdown-header">Recent Searches</h6>
                                <a class="dropdown-item" href="#">charts</a>
                                <a class="dropdown-item" href="#">new orders</a>
                                <a class="dropdown-item" href="#">file manager</a>
                                <a class="dropdown-item" href="#">new users</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link notifications-dropdown" href="#" id="notificationsDropDown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">3</a>
                            <div class="dropdown-menu dropdown-menu-end notif-drop-menu"
                                aria-labelledby="notificationsDropDown">
                                <h6 class="dropdown-header">Notifications</h6>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge bg-info text-white">
                                                <i class="fas fa-bullhorn"></i>
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p class="bold-notif-text">faucibus dolor in commodo lectus mattis</p>
                                            <small>19:00</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge bg-primary text-white">
                                                <i class="fas fa-bolt"></i>
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p class="bold-notif-text">faucibus dolor in commodo lectus mattis</p>
                                            <small>18:00</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge bg-success text-white">
                                                <i class="fas fa-at"></i>
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p>faucibus dolor in commodo lectus mattis</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge">
                                                <img src="assets/images/avatars/profile-image.png" alt="">
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p>faucibus dolor in commodo lectus mattis</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                                <a href="#">
                                    <div class="header-notif">
                                        <div class="notif-image">
                                            <span class="notification-badge">
                                                <img src="assets/images/avatars/profile-image.png" alt="">
                                            </span>
                                        </div>
                                        <div class="notif-text">
                                            <p>faucibus dolor in commodo lectus mattis</p>
                                            <small>yesterday</small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><img
                                    src="assets/images/avatars/profile-image.png" alt=""></a>
                            <div class="dropdown-menu dropdown-menu-end profile-drop-menu"
                                aria-labelledby="profileDropDown">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i>Profile</a>
                                <a class="dropdown-item" href="#"><i data-feather="inbox"></i>Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="edit"></i>Activities<span
                                        class="badge rounded-pill bg-success">12</span></a>
                                <a class="dropdown-item" href="#"><i data-feather="check-circle"></i>Tasks</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i>Settings</a>
                                <a class="dropdown-item" href="#"><i data-feather="unlock"></i>Lock</a>
                                <a class="dropdown-item" href="#"><i data-feather="log-out"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="page-sidebar">
            <ul class="list-unstyled accordion-menu">
                <li class="sidebar-title">
                    Main
                </li>
                <li >
                <a href="dashboard.html"><i data-feather="home"></i>Dashboard</a>
                </li>
                <li>
                <a href="Add-project.html"><i data-feather="home"></i>Add Project</a>
                </li>
                <li>
                <a href="Site-Progress.php"><i data-feather="home"></i>Site Progress</a>
                </li>
                <li class="active-page">
                <a href="Infra-progress.php"><i data-feather="home"></i>Infrastructure Progress</a>
                </li>
                <li>
                <a href="Est-Incurred.php"><i data-feather="home"></i>Estimated & Incurred</a>
                </li>
        <li>
          <a href="Data-Table.php"><i data-feather="home"></i>Data Table</a>
        </li>

            </ul>
        </div>
        <div class="page-content">
            <div class="main-wrapper">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form id="infrastructure-form" action="infrastructure.php" method="POST">
                                    <h5 class="card-title">Infrastructure Progress</h5>
                                    <div class="container">
                                        <div class="mb-4">
                                            <div class="col-2">
                                                <label for="select-project" class="form-label">Select Project</label>
                                                <select id="select-project" name="project_id" onchange="resetForm()"
                                                    class="form-select">
                                                    <option value="">--SELECT--</option>
                                                    <?php foreach ($projects as $project) { ?>
                                                        <option value="<?php echo $project['id']; ?>">
                                                            <?php echo $project['project_name']; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <span id="lastUpdated" style="font-weight: bold;"></span>
                                        </div>
                                    </div>

                                    <!-- Fields -->
                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="internalRoadsSelect" class="form-label me-2"
                                            style="width: 20%;">Internal Roads & Footpaths</label>
                                        <select id="internalRoadsSelect" name="internal_roads_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="internal_roads_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="internal_roads_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="waterSupplySelect" class="form-label me-2" style="width: 20%;">Water
                                            Supply</label>
                                        <select id="waterSupplySelect" name="water_supply_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="water_supply_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="water_supply_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="sewerageSelect" class="form-label me-2"
                                            style="width: 20%;">Sewerage</label>
                                        <select id="sewerageSelect" name="sewerage_select" class="form-select me-2"
                                            style="width: 20%;" required>
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="sewerage_percentage"
                                            placeholder="Percentage" style="width: 20%;" required>
                                        <input type="text" class="form-control" name="sewerage_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>


                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="stormWaterDrainsSelect" class="form-label me-2"
                                            style="width: 20%;">Storm Water Drains</label>
                                        <select id="stormWaterDrainsSelect" name="storm_water_drains_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="storm_water_drains_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="storm_water_drains_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="landscapingSelect" class="form-label me-2"
                                            style="width: 20%;">Landscaping</label>
                                        <select id="landscapingSelect" name="landscaping_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="landscaping_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="landscaping_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="streetLightingSelect" class="form-label me-2"
                                            style="width: 20%;">Street Lighting</label>
                                        <select id="streetLightingSelect" name="street_lighting_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="street_lighting_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="street_lighting_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="communityBuildingsSelect" class="form-label me-2"
                                            style="width: 20%;">Community Buildings</label>
                                        <select id="communityBuildingsSelect" name="community_buildings_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="community_buildings_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="community_buildings_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="sewageTreatmentSelect" class="form-label me-2"
                                            style="width: 20%;">Sewage Treatment</label>
                                        <select id="sewageTreatmentSelect" name="sewage_treatment_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="sewage_treatment_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="sewage_treatment_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="solidWasteManagementSelect" class="form-label me-2"
                                            style="width: 20%;">Solid Waste Management</label>
                                        <select id="solidWasteManagementSelect" name="solid_waste_management_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="solid_waste_management_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="solid_waste_management_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="waterConservationSelect" class="form-label me-2"
                                            style="width: 20%;">Water Conservation</label>
                                        <select id="waterConservationSelect" name="water_conservation_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="water_conservation_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="water_conservation_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="energyManagementSelect" class="form-label me-2"
                                            style="width: 20%;">Energy Management</label>
                                        <select id="energyManagementSelect" name="energy_management_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2"
                                            name="energy_management_percentage" placeholder="Percentage"
                                            style="width: 20%;">
                                        <input type="text" class="form-control" name="energy_management_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>


                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="fireProtectionSelect" class="form-label me-2"
                                            style="width: 20%;">Fire Protection</label>
                                        <select id="fireProtectionSelect" name="fire_protection_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="fire_protection_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="fire_protection_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>

                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="electricalRoomSelect" class="form-label me-2"
                                            style="width: 20%;">Electrical Meter Room, Sub-Station, Receiving
                                            Station</label>
                                        <select id="electricalRoomSelect" name="electrical_room_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="electrical_room_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="electrical_room_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>
                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="miscellaneousSelect" class="form-label me-2"
                                            style="width: 20%;">Miscellaneous</label>
                                        <select id="miscellaneousSelect" name="miscellaneous_select"
                                            class="form-select me-2" style="width: 20%;">
                                            <option value="No">No</option>
                                            <option value="Yes">Yes</option>

                                        </select>
                                        <input type="number" class="form-control me-2" name="miscellaneous_percentage"
                                            placeholder="Percentage" style="width: 20%;">
                                        <input type="text" class="form-control" name="miscellaneous_details"
                                            placeholder="Details (100 words max)" maxlength="100" style="width: 40%;">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- JavaScript to reset the form fields on project selection -->

    </div>


    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="assets/js/main.min.js"></script>

    <!-- <script>
    $('#select-project').on('change',function(){
      
      alert($(this).val());

    });
    $('#frm-site-progress').on('submit',function(e){
      e.preventDefault();
      

    })
  </script> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Function to reset the form fields
            window.resetForm = function () {
                $('#internalRoadsSelect').val('');
                $('input[name="internal_roads_percentage"]').val('');
                $('input[name="internal_roads_details"]').val('');

                $('#waterSupplySelect').val('');
                $('input[name="water_supply_percentage"]').val('');
                $('input[name="water_supply_details"]').val('');

                $('#sewerageSelect').val('');
                $('input[name="sewerage_percentage"]').val('');
                $('input[name="sewerage_details"]').val('');

                $('#stormWaterDrainsSelect').val('');
                $('input[name="storm_water_drains_percentage"]').val('');
                $('input[name="storm_water_drains_details"]').val('');

                $('#landscapingSelect').val('');
                $('input[name="landscaping_percentage"]').val('');
                $('input[name="landscaping_details"]').val('');

                $('#streetLightingSelect').val('');
                $('input[name="street_lighting_percentage"]').val('');
                $('input[name="street_lighting_details"]').val('');

                $('#communityBuildingsSelect').val('');
                $('input[name="community_buildings_percentage"]').val('');
                $('input[name="community_buildings_details"]').val('');

                $('#sewageTreatmentSelect').val('');
                $('input[name="sewage_treatment_percentage"]').val('');
                $('input[name="sewage_treatment_details"]').val('');

                $('#solidWasteManagementSelect').val('');
                $('input[name="solid_waste_management_percentage"]').val('');
                $('input[name="solid_waste_management_details"]').val('');

                $('#waterConservationSelect').val('');
                $('input[name="water_conservation_percentage"]').val('');
                $('input[name="water_conservation_details"]').val('');

                $('#energyManagementSelect').val('');
                $('input[name="energy_management_percentage"]').val('');
                $('input[name="energy_management_details"]').val('');

                $('#fireProtectionSelect').val('');
                $('input[name="fire_protection_percentage"]').val('');
                $('input[name="fire_protection_details"]').val('');

                $('#electricalRoomSelect').val('');
                $('input[name="electrical_room_percentage"]').val('');
                $('input[name="electrical_room_details"]').val('');

                $('#miscellaneousSelect').val('');
                $('input[name="miscellaneous_percentage"]').val('');
                $('input[name="miscellaneous_details"]').val('');

                $('#lastUpdated').text('');
            };
            // Change event for project selection
            $('#select-project').change(function () {
                var projectId = $(this).val();
                console.log('Selected Project ID:', projectId);

                if (projectId) {
                    $.ajax({
                        url: 'get_infra_progress.php',
                        type: 'POST',
                        data: { project_id: projectId },
                        dataType: 'json',
                        success: function (data) {
                            if (data) {
                                // Populate fields with data
                                $('#internalRoadsSelect').val(data.internal_roads_select);
                                $('input[name="internal_roads_percentage"]').val(data.internal_roads_percentage);
                                $('input[name="internal_roads_details"]').val(data.internal_roads_details);

                                $('#waterSupplySelect').val(data.water_supply_select);
                                $('input[name="water_supply_percentage"]').val(data.water_supply_percentage);
                                $('input[name="water_supply_details"]').val(data.water_supply_details);

                                $('#sewerageSelect').val(data.sewerage_select);
                                $('input[name="sewerage_percentage"]').val(data.sewerage_percentage);
                                $('input[name="sewerage_details"]').val(data.sewerage_details);

                                $('#stormWaterDrainsSelect').val(data.storm_water_drains_select);
                                $('input[name="storm_water_drains_percentage"]').val(data.storm_water_drains_percentage);
                                $('input[name="storm_water_drains_details"]').val(data.storm_water_drains_details);

                                $('#landscapingSelect').val(data.landscaping_select);
                                $('input[name="landscaping_percentage"]').val(data.landscaping_percentage);
                                $('input[name="landscaping_details"]').val(data.landscaping_details);

                                $('#streetLightingSelect').val(data.street_lighting_select);
                                $('input[name="street_lighting_percentage"]').val(data.street_lighting_percentage);
                                $('input[name="street_lighting_details"]').val(data.street_lighting_details);

                                $('#communityBuildingsSelect').val(data.community_buildings_select);
                                $('input[name="community_buildings_percentage"]').val(data.community_buildings_percentage);
                                $('input[name="community_buildings_details"]').val(data.community_buildings_details);

                                $('#sewageTreatmentSelect').val(data.sewage_treatment_select);
                                $('input[name="sewage_treatment_percentage"]').val(data.sewage_treatment_percentage);
                                $('input[name="sewage_treatment_details"]').val(data.sewage_treatment_details);

                                $('#solidWasteManagementSelect').val(data.solid_waste_management_select);
                                $('input[name="solid_waste_management_percentage"]').val(data.solid_waste_management_percentage);
                                $('input[name="solid_waste_management_details"]').val(data.solid_waste_management_details);

                                $('#waterConservationSelect').val(data.water_conservation_select);
                                $('input[name="water_conservation_percentage"]').val(data.water_conservation_percentage);
                                $('input[name="water_conservation_details"]').val(data.water_conservation_details);

                                $('#energyManagementSelect').val(data.energy_management_select);
                                $('input[name="energy_management_percentage"]').val(data.energy_management_percentage);
                                $('input[name="energy_management_details"]').val(data.energy_management_details);

                                $('#miscellaneousSelect').val(data.miscellaneous_select);
                                $('input[name="miscellaneous_percentage"]').val(data.miscellaneous_percentage);
                                $('input[name="miscellaneous_details"]').val(data.miscellaneous_details);
                                $('#fireProtectionSelect').val(data.fire_protection_select);
                                $('#electricalRoomSelect').val(data.electrical_room_select);
                                $('input[name="fire_protection_percentage"]').val(data.fire_protection_percentage);
                                $('input[name="fire_protection_details"]').val(data.fire_protection_details);
                                $('input[name="electrical_room_details"]').val(data.electrical_room_details);
                                $("input[name='electrical_room_percentage']").val(data.electrical_room_percentage);
                                $('#lastUpdated').text("Last Updated: " + data.last_updated);
                            } else {
                                resetForm();
                                $('.me-2').val('No');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                } else {
                    resetForm();
                }
            });

            // Submit event for the form
            $('#infrastructure-form').on('submit', function (event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    success: function (response) {
                        console.log('Form submitted successfully:', response);
                        alert('Form submitted successfully');
                    },
                    error: function (xhr, status, error) {
                        console.error('Error submitting form:', error);
                        alert('Error submitting form');
                    }
                });
            });
        });
    </script>


</body>

</html>