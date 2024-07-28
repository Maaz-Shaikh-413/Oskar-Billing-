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
    <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet">

    <!-- FullCalendar CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.css" rel="stylesheet">

    <!-- jQuery (required for FullCalendar) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- FullCalendar JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.7.2/main.min.js"></script>

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

    include ("db_config.php");


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

    <style>
        td>.form-control {
            border-radius: 0px !important;
            min-width: 100px !important;
        }
    </style>
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
                <li>
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
                <li>
                    <a href="Est-Incurred.php"><i data-feather="home"></i>Estimated & Incurred</a>
                </li>
                <li class="active-page">
                    <a href="Data-Table.php"><i data-feather="home"></i>Data Table</a>
                </li>
            </ul>
        </div>
        <div class="page-content">
            <div class="main-wrapper">
                <div class="row">
                    <div class="col">
                        <div class="d-flex align-items-center mb-4">
                           
                            <div class="me-3">
                                <label for="select-project" class="form-label mb-0">Select Project</label>
                                <select id="select-project" name="project_id" class="form-select">
                                    <option value="">--SELECT--</option>
                                    <?php foreach ($projects as $project) { ?>
                                        <option value="<?php echo $project['id']; ?>">
                                            <?php echo $project['project_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="btn-group" role="group" aria-label="Action buttons">
                                <button type="button" data-fileName="Form 1 - Architect-2.docx"
                                    class="btn btn-danger btn-sm btn-download-doc me-2">
                                    Form 1
                                </button>
                                <button type="button" data-fileName="Form 2 - Engineer-2-2.docx"
                                    class="btn btn-danger btn-sm btn-download-doc me-2">
                                    Form 2
                                </button>
                                <button type="button" data-fileName="Form 3 - CA.xlsx"
                                    class="btn btn-danger btn-sm btn-download-doc me-2">
                                    Form 3 Sheet
                                </button>
                                <button type="button" data-fileName="Inventory Disclosure - Promoter Letterhead-2.docx"
                                    class="btn btn-danger btn-sm btn-download-doc">
                                    Inventory Sheet
                                </button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Project Details</h5>
                                <p>Fill in the project details below:</p>

                                <div class="table-responsive">
                                    <input type="hidden" id="project_id" name="project_id">
                                    <table id="tbl-units" class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Unit No</th>
                                                <th>Carpet Area</th>
                                                <th>Status</th>
                                                <th>Agreement Date</th>
                                                <th>Agreement Value</th>
                                                <th>Buyer Name</th>
                                                <th>Advance Received 2020-2021</th>
                                                <th>Advance Received 2021-2022</th>
                                                <th>Advance Received 2022-2023</th>
                                                <th>Advance Received 2023-2024</th>
                                                <th>Advance Received 2024-2025</th>
                                                <th>Total Received</th>
                                                <th>Balance</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Unit No</th>
                                                <th>Carpet Area</th>
                                                <th>Status</th>
                                                <th>Agreement Date</th>
                                                <th>Agreement Value</th>
                                                <th>Buyer Name</th>
                                                <th>Advance Received 2020-2021</th>
                                                <th>Advance Received 2021-2022</th>
                                                <th>Advance Received 2022-2023</th>
                                                <th>Advance Received 2023-2024</th>
                                                <th>Advance Received 2024-2025</th>
                                                <th>Total Received</th>
                                                <th>Balance</th>
                                                <th>Action</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                    <div class="text-right mt-3">
                                        <button type="button" id="btn-save-data" class="btn btn-primary">Save
                                            Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Add AFS -->
        <div class="modal fade" id="afsModal" tabindex="-1" aria-labelledby="afsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="afsModalLabel">Add AFS Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="afsModalForm">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Add SD -->
        <div class="modal fade" id="sdModal" tabindex="-1" aria-labelledby="sdModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="sdModalLabel">Add SD Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="sdModalForm">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
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
        <script src="assets/plugins/DataTables/datatables.min.js"></script>
        <script src="assets/js/main.min.js"></script>
        <script src="assets/js/pages/datatables.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {

                $('#select-project').change(function () {
                    var projectId = $(this).val();


                    $('#project_id').val(projectId);
                    console.log('Selected project ID:', projectId);


                    $('#tbl-units tbody').empty();


                    if (projectId) {

                        $.ajax({
                            url: 'get_units_api.php',
                            type: 'POST',
                            data: { project_id: projectId },
                            dataType: 'json',
                            success: function (response) {
                                console.log('Units fetched:', response);


                                var tableBody = $('#tbl-units tbody');
                                tableBody.empty(); // Clear existing rows

                                var units = response['units'];


                                units.forEach(function (unit) {

                                    var htmlRow = getHTMLCodeForRow(unit);
                                    tableBody.append(htmlRow);

                                });

                                // Display the last updated date

                                $('.btn-download-doc').click(function (e) {
                                    e.preventDefault();
                                    var documentName = $(this).data('filename');
                                    var unitName = $(this).data('unit-name');
                                    var projectId = $(this).data('project_id');
                                    var url = 'generate_doc.php?fileName=' + documentName + '&projectId=' + projectId + '&unitId=' + unitName;
                                    console.log(url);
                                    window.location.href = url;

                                });

                                /*
                                                                $('#tbl-units').on('click', '.btn-download-doc', function (e) {
                                                                    e.preventDefault();
                                                                    var $row = $(this).closest('tr');
                                                                    var elements = $row.find('input,select');
                                                                    var obj = {};
                                                                    elements.each(function () {
                                                                        var element = $(this);
                                                                        var name = element.attr('name').replace('[', '').replace(']', '');
                                                                        obj[name] = element.val();
                                                                    });
                                
                                                                    $.ajax({
                                                                        url: 'generate_doc.php',
                                                                        type: 'POST',
                                                                        data: JSON.stringify(obj),
                                                                        contentType: 'application/json',
                                                                        success: function (response) {
                                                                            window.location.href = response.download_url;
                                                                        },
                                                                        error: function (xhr, status, error) {
                                                                            console.error('Error generating document:', error);
                                                                        }
                                                                    });
                                                                });
                                
                                */
                            },

                            error: function (xhr, status, error) {
                                console.error('Error fetching unit numbers:', error);
                            }
                        });
                    }
                });

                function getHTMLCodeForRow(row) {
                    var projectId = $('#select-project').val();
                    var unit = row['unit_no'];
                    var carpet_area = row['carpet_area'];
                    var status = row['status'];
                    var agreement_date = row['agreement_date'];
                    var agreement_value = row['agreement_value'] == undefined ? 0 : parseFloat(row['agreement_value']);
                    var buyer_name = row['buyer_name'] == undefined ? '' : row['buyer_name'];
                    var advance_2020_2021 = row['advance_2020_2021'] == undefined ? 0 : parseFloat(row['advance_2020_2021']);
                    var advance_2021_2022 = row['advance_2021_2022'] == undefined ? 0 : parseFloat(row['advance_2021_2022']);
                    var advance_2022_2023 = row['advance_2022_2023'] == undefined ? 0 : parseFloat(row['advance_2022_2023']);
                    var advance_2023_2024 = row['advance_2023_2024'] == undefined ? 0 : parseFloat(row['advance_2023_2024']);
                    var advance_2024_2025 = row['advance_2024_2025'] == undefined ? 0 : parseFloat(row['advance_2024_2025']);

                    var totalReceived = (advance_2020_2021 + advance_2021_2022 + advance_2022_2023 + advance_2023_2024 + advance_2024_2025);
                    var balance = agreement_value - totalReceived;



                    return `<tr>
            <td><input class="form-control" value="${unit}" disabled type="text" name="unit_no[]" required></td>
            <td><input class="form-control" value="${carpet_area}" type="number" name="carpet_area[]" required></td>
            <td>
                <select class="form-control" name="status[]" value="${status}" required>
                    <option value="unsold">Unsold</option>
                    <option value="sold">Sold</option>
                    <option value="booked">Booked</option>
                </select>
            </td>
            <td><input class="form-control" type="date" name="agreement_date[]" value="${agreement_date}" required></td>
            <td><input class="form-control" type="number" name="agreement_value[]" value="${agreement_value}" required></td>
            <td><input class="form-control" type="text" name="buyer_name[]" value="${buyer_name}" required></td>
            <td><input class="form-control" type="number" name="advance_2020_2021[]" value="${advance_2020_2021}" required></td>
            <td><input class="form-control" type="number" name="advance_2021_2022[]"  value="${advance_2021_2022}" required></td>
            <td><input class="form-control" type="number" name="advance_2022_2023[]"  value="${advance_2022_2023}" required></td>
            <td><input class="form-control" type="number" name="advance_2023_2024[]"  value="${advance_2023_2024}" required></td>
            <td><input class="form-control" type="number" name="advance_2024_2025[]"  value="${advance_2024_2025}" required></td>
            <td><input class="form-control total-received" type="number" value="${totalReceived}"  name="total_received[]" readonly></td>
            <td><input class="form-control balance" type="number" name="balance[]" value="${balance}"  readonly></td>
            <td class="text-center">
                <div class="btn-group" role="group" aria-label="Action buttons">
                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                    <button type="button" class="btn btn-primary btn-sm add-afs-btn">Add AFS</button>
                    <button type="button" class="btn btn-info btn-sm add-sd-btn">Add SD</button>
                  
                </div>
            </td>
             <td class="text-center">
                
            </td>
        </tr>`;
                }



                $('#tbl-units').on('keyup', 'input[name^="advance_"], input[name="agreement_value[]"]', function () {
                    var $row = $(this).closest('tr');

                    var totalReceived = 0;
                    $row.find('input[name^="advance_"]').each(function () {
                        var value = parseFloat($(this).val()) || 0;
                        totalReceived += value;
                    });
                    $row.find('input[name="total_received[]"]').val(totalReceived);

                    var agreementValue = parseFloat($row.find('input[name="agreement_value[]"]').val()) || 0;
                    var balance = agreementValue - totalReceived;
                    $row.find('input[name="balance[]"]').val(balance);
                });


                $('#tbl-units').on('click', '.add-afs-btn', function () {
                    $('#afsModalForm').empty();
                    $('#afsModalForm').append(`
            <div class="mb-3">
                <label for="uploadDocuments" class="form-label">Upload Documents</label>
                <input type="file" class="form-control" id="uploadDocuments" name="afs[uploadDocuments][]" required>
            </div>
            <div class="mb-3">
                <label for="afsDeedNumber" class="form-label">AFS Deed Number</label>
                <input type="text" class="form-control" id="afsDeedNumber" name="afs[afsDeedNumber][]" required>
            </div>
        `);
                    $('#afsModal').modal('show');
                });


                $('#tbl-units').on('click', '.add-sd-btn', function () {
                    $('#sdModalForm').empty();
                    $('#sdModalForm').append(`
            <div class="mb-3">
                <label for="sdUploadDocuments" class="form-label">Upload SD Documents</label>
                <input type="file" class="form-control" id="sdUploadDocuments" name="sd[uploadDocuments][]" required>
            </div>
            <div class="mb-3">
                <label for="sdDeedNumber" class="form-label">SD Deed Number</label>
                <input type="text" class="form-control" id="sdDeedNumber" name="sd[sdDeedNumber][]" required>
            </div>
        `);
                    $('#sdModal').modal('show');
                });

                $('#tbl-units').on('click', '.delete-btn', function () {
                    $(this).closest('tr').remove();
                });

                $('#btn-save-data').click(function (e) {
                    e.preventDefault();

                    // var formData = $(this).serialize(); 
                    // console.log('Form data:', formData);
                    var table_rows = $('#tbl-units tbody tr');
                    var requestBody = [];
                    for (var i = 0; i < table_rows.length; i++) {
                        var row = table_rows[i];
                        var elements = $(row).find('input, select');
                        var obj = {};
                        for (var elemI = 0; elemI < elements.length; elemI++) {
                            var element = $(elements[elemI]);
                            var name = element.attr('name').replace('[', '').replace(']', '');
                            obj[name] = element.val();

                        }
                        requestBody.push(obj);

                    }

                    $.ajax({
                        url: 'save_units.php?project_id=' + $("#select-project").val(),
                        type: 'POST',
                        data: JSON.stringify(requestBody),
                        success: function (response) {
                            alert('Data saved successfully.');
                            console.log(response);
                        },
                        error: function (xhr, status, error) {
                            alert('Error saving data.');
                            console.error('Error:', error);
                        }
                    });
                });
            });
        </script>













</body>

</html>