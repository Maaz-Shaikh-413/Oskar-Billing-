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
<style>
     <style>
    #last-updated {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        padding: 10px;
        border: 1px solid #ccc;
        background-color: #f9f9f9;
        margin-top: 20px;
        width: fit-content;
        border-radius: 5px;
    }
</style>
</style>
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
              <a class="nav-link search-dropdown" href="#" id="searchDropDown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i data-feather="search"></i></a>
              <div class="dropdown-menu dropdown-menu-end dropdown-lg search-drop-menu"
                aria-labelledby="searchDropDown">
                <form>
                  <input class="form-control" type="text" placeholder="Type something.." aria-label="Search">
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
              <div class="dropdown-menu dropdown-menu-end notif-drop-menu" aria-labelledby="notificationsDropDown">
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
              <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><img src="assets/images/avatars/profile-image.png" alt=""></a>
              <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
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
        <li class="active-page">
          <a href="Site-Progress.php"><i data-feather="home"></i>Site Progress</a>
        </li>
        <li>
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
                <!-- <form id="frm-site-progress" method="POST"> -->
                <form action="site_progress.php" method="POST">
                  <div class="mb-4">
                  <div class="col-2">
                    <label for="select-project" class="form-label">Select Project</label>
                    <select id="select-project" name="project_id" class="form-select">
                    <option value="">--SELECT--</option>
                          <?php foreach ($projects as $project) { 
                            
                            ?>
                            
                            <option value="<?php echo $project['id']; ?>"><?php echo $project['project_name']; ?></option>
                          <?php } ?>
                            
                    </select>
                  </div>
                 </div>    
                 <div class="mb-3" id="last-updated" style="font-weight: bold;"></div>
                
                  <div class="mb-3 d-flex align-items-center">
                    <label for="excavationRange" class="form-label me-2" style="width: 25%;">Excavation</label>
                    <input type="range" class="form-range" id="excavationRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="excavationInput.value = excavationRange.value" name="excavation">
                    <input type="number" id="excavationInput" min="0" max="100" step="1" value="0"
                      oninput="excavationRange.value = excavationInput.value" class="form-control ms-2"
                      style="width: 20%;" name="excavation">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="basementsRange" class="form-label me-2" style="width: 25%;">Basements (if any)</label>
                    <input type="range" class="form-range" id="basementsRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="basementsInput.value = basementsRange.value" name="basements">
                    <input type="number" id="basementsInput" min="0" max="100" step="1" value="0"
                      oninput="basementsRange.value = basementsInput.value" class="form-control ms-2"
                      style="width: 20%;" name="basements">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="podiumsRange" class="form-label me-2" style="width: 25%;">Podiums (if any)</label>
                    <input type="range" class="form-range" id="podiumsRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="podiumsInput.value = podiumsRange.value" name="podiums">
                    <input type="number" id="podiumsInput" min="0" max="100" step="1" value="0"
                      oninput="podiumsRange.value = podiumsInput.value" class="form-control ms-2" style="width: 20%;"
                      name="podiums">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="plinthRange" class="form-label me-2" style="width: 25%;">Plinth</label>
                    <input type="range" class="form-range" id="plinthRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="plinthInput.value = plinthRange.value" name="plinth">
                    <input type="number" id="plinthInput" min="0" max="100" step="1" value="0"
                      oninput="plinthRange.value = plinthInput.value" class="form-control ms-2" style="width: 20%;"
                      name="plinth">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="stiltFloorRange" class="form-label me-2" style="width: 25%;">Stilt Floor</label>
                    <input type="range" class="form-range" id="stiltFloorRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="stiltFloorInput.value = stiltFloorRange.value" name="stilt_floor">
                    <input type="number" id="stiltFloorInput" min="0" max="100" step="1" value="0"
                      oninput="stiltFloorRange.value = stiltFloorInput.value" class="form-control ms-2"
                      style="width: 20%;" name="stilt_floor">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="superStructureSlabsRange" class="form-label me-2" style="width: 25%;">Super Structure
                      Slabs</label>
                    <input type="range" class="form-range" id="superStructureSlabsRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="superStructureSlabsInput.value = superStructureSlabsRange.value"
                      name="super_structure_slabs">
                    <input type="number" id="superStructureSlabsInput" min="0" max="100" step="1" value="0"
                      oninput="superStructureSlabsRange.value = superStructureSlabsInput.value"
                      class="form-control ms-2" style="width: 20%;" name="super_structure_slabs">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="internalWallsRange" class="form-label me-2" style="width: 25%;">Internal Walls</label>
                    <input type="range" class="form-range" id="internalWallsRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="internalWallsInput.value = internalWallsRange.value"
                      name="internal_walls">
                    <input type="number" id="internalWallsInput" min="0" max="100" step="1" value="0"
                      oninput="internalWallsRange.value = internalWallsInput.value" class="form-control ms-2"
                      style="width: 20%;" name="internal_walls">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="sanitaryFittingsRange" class="form-label me-2" style="width: 25%;">Sanitary
                      Fittings</label>
                    <input type="range" class="form-range" id="sanitaryFittingsRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="sanitaryFittingsInput.value = sanitaryFittingsRange.value"
                      name="sanitary_fittings">
                    <input type="number" id="sanitaryFittingsInput" min="0" max="100" step="1" value="0"
                      oninput="sanitaryFittingsRange.value = sanitaryFittingsInput.value" class="form-control ms-2"
                      style="width: 20%;" name="sanitary_fittings">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="staircasesRange" class="form-label me-2" style="width: 25%;">Staircases</label>
                    <input type="range" class="form-range" id="staircasesRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="staircasesInput.value = staircasesRange.value" name="staircases">
                    <input type="number" id="staircasesInput" min="0" max="100" step="1" value="0"
                      oninput="staircasesRange.value = staircasesInput.value" class="form-control ms-2"
                      style="width: 20%;" name="staircases">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="externalPlumbingRange" class="form-label me-2" style="width: 25%;">External
                      Plumbing</label>
                    <input type="range" class="form-range" id="externalPlumbingRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="externalPlumbingInput.value = externalPlumbingRange.value"
                      name="external_plumbing">
                    <input type="number" id="externalPlumbingInput" min="0" max="100" step="1" value="0"
                      oninput="externalPlumbingRange.value = externalPlumbingInput.value" class="form-control ms-2"
                      style="width: 20%;" name="external_plumbing">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="fireFightingArrangementsRange" class="form-label me-2" style="width: 25%;">Fire Fighting
                      Arrangements</label>
                    <input type="range" class="form-range" id="fireFightingArrangementsRange" min="0" max="100" step="1"
                      style="width: 55%;"
                      oninput="fireFightingArrangementsInput.value = fireFightingArrangementsRange.value"
                      name="fire_fighting_arrangements">
                    <input type="number" id="fireFightingArrangementsInput" min="0" max="100" step="1" value="0"
                      oninput="fireFightingArrangementsRange.value = fireFightingArrangementsInput.value"
                      class="form-control ms-2" style="width: 20%;" name="fire_fighting_arrangements">
                  </div>

                  <div class="mb-3 d-flex align-items-center">
                    <label for="civilWorksRange" class="form-label me-2" style="width: 25%;">Civil Works</label>
                    <input type="range" class="form-range" id="civilWorksRange" min="0" max="100" step="1"
                      style="width: 55%;" oninput="civilWorksInput.value = civilWorksRange.value" name="civil_works">
                    <input type="number" id="civilWorksInput" min="0" max="100" step="1" value="0"
                      oninput="civilWorksRange.value = civilWorksInput.value" class="form-control ms-2"
                      style="width: 20%;" name="civil_works">
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
                  
                </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>



    
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


  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script>
    $(document).ready(function () {
      // Handle project selection change
      $('#select-project').change(function () {
        var projectId = $(this).val();
        console.log("Selected Project ID:", projectId);

        if (projectId) {
          $.ajax({
            url: 'get_project_progress.php',
            type: 'POST',
            data: { project_id: projectId },
            dataType: 'json',
            success: function (data) {
              console.log("Response Data:", data);
              if (data && Object.keys(data).length > 0) {
                // Populate fields with the received data
                $('#excavationRange').val(data.excavation || 0);
                $('#excavationInput').val(data.excavation || 0);
                $('#basementsRange').val(data.basements || 0);
                $('#basementsInput').val(data.basements || 0);
                $('#podiumsRange').val(data.podiums || 0);
                $('#podiumsInput').val(data.podiums || 0);
                $('#plinthRange').val(data.plinth || 0);
                $('#plinthInput').val(data.plinth || 0);
                $('#stiltFloorRange').val(data.stilt_floor || 0);
                $('#stiltFloorInput').val(data.stilt_floor || 0);
                $('#superStructureSlabsRange').val(data.super_structure_slabs || 0);
                $('#superStructureSlabsInput').val(data.super_structure_slabs || 0);
                $('#internalWallsRange').val(data.internal_walls || 0);
                $('#internalWallsInput').val(data.internal_walls || 0);
                $('#sanitaryFittingsRange').val(data.sanitary_fittings || 0);
                $('#sanitaryFittingsInput').val(data.sanitary_fittings || 0);
                $('#staircasesRange').val(data.staircases || 0);
                $('#staircasesInput').val(data.staircases || 0);
                $('#externalPlumbingRange').val(data.external_plumbing || 0);
                $('#externalPlumbingInput').val(data.external_plumbing || 0);
                $('#fireFightingArrangementsRange').val(data.fire_fighting_arrangements || 0);
                $('#fireFightingArrangementsInput').val(data.fire_fighting_arrangements || 0);
                $('#civilWorksRange').val(data.civil_works || 0);
                $('#civilWorksInput').val(data.civil_works || 0);

                // Show last updated date
                $('#last-updated').text('Last Updated: ' + data.updated_at);
              } else {
                // Reset fields if no data is found
                resetFormFields();
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.error("AJAX Error:", textStatus, errorThrown);
              resetFormFields();
            }
          });
        } else {
          // Reset all fields if no project is selected
          resetFormFields();
        }
      });

      function resetFormFields() {
        $('input[type="range"]').val(0);
        $('input[type="number"]').val(0);
        $('#last-updated').text(''); // Clear last updated text
      }

      // Handle form submission
      $('form').on('submit', function (event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'site_progress.php', true);
        xhr.onload = function () {
          if (xhr.status === 200) {
            // Handle successful form submission response
            console.log("Form submitted successfully:", xhr.responseText);

            // Display success message
            alert("Form submitted successfully!");

            // Reset form fields
            resetFormFields();
          } else {
            // Handle error
            console.error("Form submission failed:", xhr.status, xhr.statusText);

            // Display error message
            alert("Form submission failed. Please try again.");
          }
        };

        xhr.onerror = function () {
          console.error("Request failed");

          // Display error message
          alert("Request failed. Please try again.");
        };

        xhr.send(formData);
      });
    });
  </script>


  </script>
</body>

</html>