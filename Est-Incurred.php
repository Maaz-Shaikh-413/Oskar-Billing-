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
    <!-- <style>
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
</style> -->

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
        <li>
          <a href="Infra-progress.php"><i data-feather="home"></i>Infrastructure Progress</a>
        </li>
        <li class="active-page">
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
                                <div class="mb-4">
                                    <div class="col-2">
                                        <label for="select-project" class="form-label">Select Project</label>
                                        <select id="select-project" name="project_id" class="form-select">
                                            <option value="">--SELECT--</option>
                                            <?php foreach ($projects as $project) { ?>
                                                <option value="<?php echo $project['id']; ?>">
                                                    <?php echo $project['project_name']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <div id="last-updated" style="font-weight:bold;"></div><br>

                                <h5 class="card-title">Project Details Form</h5>
                                <form id="projectForm" action="cost.php" method="POST">
                                    <!-- Hidden input to store the selected project ID -->
                                    <input type="hidden" id="hiddenProjectId" name="project_id" value="">

                                    <div class="mb-3">
                                        <label for="planningAuthority" class="form-label">Planning Authority</label>
                                        <input type="text" class="form-control" id="planningAuthority"
                                            name="planning_authority" required>
                                    </div>
                                  
                                    <div class="mb-3">
                                        <label for="estimatedCost" class="form-label">Estimated Cost</label>
                                        <input type="number" class="form-control" id="estimatedCost"
                                            name="estimated_cost" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="incurredCost" class="form-label">Incurred Cost</label>
                                        <input type="number" class="form-control" id="incurredCost" name="incurred_cost"
                                            required>
                                    </div>
                                      <div class="mb-3">
                                        <label for="balanceIncurred" class="form-label">Balance Incurred</label>
                                        <input type="number" class="form-control" id="balanceIncurred"
                                            name="balance_incurred" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 <script>
            function calculateBalance() {
                var estimatedCost = parseFloat(document.getElementById('estimatedCost').value) || 0;
                var incurredCost = parseFloat(document.getElementById('incurredCost').value) || 0;
                var balanceIncurred = estimatedCost - incurredCost;

               
                document.getElementById('balanceIncurred').value = Math.round(balanceIncurred);
            }

            document.getElementById('select-project').addEventListener('change', function () {
                var projectId = this.value;
                document.getElementById('projectForm').reset();

                console.log("Selected project ID:", projectId);

                if (projectId) {
                  
                    document.getElementById('hiddenProjectId').value = projectId;

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'get_cost_details.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);

                            console.log("Project details received:", response);

                            if (response.error) {
                                document.getElementById('last-updated').innerText = "Error: " + response.error;
                            } else {
                                document.getElementById('planningAuthority').value = response.planning_authority;
                                document.getElementById('estimatedCost').value = response.estimated_cost;
                                document.getElementById('incurredCost').value = response.incurred_cost;
                                document.getElementById('balanceIncurred').value = response.balance_incurred; // Set initial value
                                document.getElementById('last-updated').innerText = "Last Updated: " + response.updated_at;

                               
                                calculateBalance();
                            }
                        } else {
                            document.getElementById('last-updated').innerText = "Error fetching data";
                        }
                    };

                    xhr.onerror = function () {
                        document.getElementById('last-updated').innerText = "Request failed";
                    };

                    xhr.send('project_id=' + projectId);
                } else {
                    document.getElementById('last-updated').innerText = "";
                    document.getElementById('hiddenProjectId').value = ""; 
                }
            });
            document.getElementById('projectForm').addEventListener('submit', function (event) {
                event.preventDefault(); 

                var formData = new FormData(this);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'cost.php', true);
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        
                        console.log("Form submitted successfully:", xhr.responseText);

                      
                        alert("Form submitted successfully!");
                    } else {

                        console.error("Form submission failed:", xhr.status, xhr.statusText);

                        alert("Form submission failed. Please try again.");
                    }
                };

                xhr.onerror = function () {
                    console.error("Request failed");

                    alert("Request failed. Please try again.");
                };

                xhr.send(formData);
            });

            window.onload = function () {
                document.getElementById('estimatedCost').addEventListener('input', calculateBalance);
                document.getElementById('incurredCost').addEventListener('input', calculateBalance);
            };
        </script>


    </div>



    </div>

    <!-- Javascripts -->
    <script src="assets/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="assets/js/main.min.js"></script>

</body>

</html>