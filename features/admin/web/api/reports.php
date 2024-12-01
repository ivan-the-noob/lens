<?php 
session_start();
require '../../../../db/db.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';


$sql_customers = "SELECT * FROM reports WHERE role = 'customer'";
$result_customers = $conn->query($sql_customers);

// Fetch reports for suppliers
$sql_suppliers = "SELECT * FROM reports WHERE role = 'supplier'";
$result_suppliers = $conn->query($sql_suppliers);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Suppliers | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <!--Navigation Links-->
    <div class="navbar flex-column shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <h5>LENSFOLIOHUB</h5>
            <a href="admin.php">
                <span>Dashboard</span>
            </a>
            <a href="announcement.php">
                <span>Announcement</span>
            </a>
            <a href="registered-client.php">
                <span>Registered Client</span>
            </a>
            <a href="registered-supplier.php">
                <span>Registered Supplier</span>
            </a>
            <a href="#" class="navbar-highlight">
                <span>Registered Supplier</span>
            </a>
        </div>

    </div>
    </div>
    <!--Navigation Links End-->
    <div class="content flex-grow-1">
        <div class="header">
            <button class="navbar-toggler d-block d-md-none" type="button" onclick="toggleMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="stroke: black; fill: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>

            <!--Notification and Profile Admin-->
            <div class="profile-admin">
                <div class="dropdown">
                    <button class="" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../../../assets/img/profile/profile.jpg"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../../authentication/web/api/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        
            <div class="col-md-12 d-flex justify-content-center mx-auto">
            <div class="container supplier-reg">
                <?php 
                include '../../function/php/registered-supplier.php';
                ?>
            <div class="table-wrapper px-lg-5">
                <h2 class="text-center">Reports</h2>

                <div class="row">
                    <div class="col-md-12 report-table">
                        <h5 class="text-center">Clients</h5>
                        <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover table-remove-borders" style="background-color: #2A2E32; color: white;">
                                <thead class="thead-light" style="background-color: #2A2E32; color: white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Reporter Name</th>
                                        <th>Reporter Email</th>
                                        <th>Reported Name</th>
                                        <th>Reported Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result_customers->num_rows > 0) {
                                        while ($row = $result_customers->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $row['id'] . "</td>
                                                    <td>" . htmlspecialchars($row['reporter_name']) . "</td>
                                                    <td>" . htmlspecialchars($row['reporter_email']) . "</td>
                                                    <td>" . htmlspecialchars($row['reported_name']) . "</td>
                                                    <td>" . htmlspecialchars($row['reported_email']) . "</td>
                                                    <td>
                                                        <button class='btn btn-danger btn-sm'>Delete</button>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No reports found for customers.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12 report-table">
                        <h5 class="text-center">Suppliers</h5>
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover table-remove-borders" style="background-color: #2A2E32; color: white;">
                                <thead class="thead-light" style="background-color: #2A2E32; color: white;">
                                    <tr>
                                        <th>#</th>
                                        <th>Reporter Name</th>
                                        <th>Reporter Email</th>
                                        <th>Reported Name</th>
                                        <th>Reported Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result_suppliers->num_rows > 0) {
                                        while ($row = $result_suppliers->fetch_assoc()) {
                                            echo "<tr>
                                                    <td>" . $row['id'] . "</td>
                                                    <td>" . htmlspecialchars($row['reporter_name']) . "</td>
                                                    <td>" . htmlspecialchars($row['reporter_email']) . "</td>
                                                    <td>" . htmlspecialchars($row['reported_name']) . "</td>
                                                    <td>" . htmlspecialchars($row['reported_email']) . "</td>
                                                    <td>
                                                        <button class='btn btn-danger btn-sm'>Delete</button>
                                                    </td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No reports found for suppliers.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this supplier?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteForm" method="POST" action="../../function/php/delete-supplier.php">
                            <input type="hidden" name="id" id="deleteId">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        </div>
        <script src="../../function/script/supplier-deletion.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>