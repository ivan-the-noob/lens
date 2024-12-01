<?php 
session_start();
require '../../../../db/db.php';

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$totalClientsQuery = "SELECT COUNT(*) AS total_clients FROM users WHERE role = 'customer'";
$totalClientsResult = $conn->query($totalClientsQuery);
$totalClients = $totalClientsResult->fetch_assoc()['total_clients'];

$newUsersQuery = "SELECT COUNT(*) AS new_users_this_week FROM users WHERE (role = 'customer' OR role = 'supplier') AND YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
$newUsersResult = $conn->query($newUsersQuery);
$newUsers = $newUsersResult->fetch_assoc()['new_users_this_week']; 

$totalSuppliersQuery = "SELECT COUNT(*) AS total_suppliers FROM users WHERE role = 'supplier'";
$totalSuppliersResult = $conn->query($totalSuppliersQuery);
$totalSuppliers = $totalSuppliersResult->fetch_assoc()['total_suppliers'];

$supplierData = array_fill(0, 12, 0); 
$clientData = array_fill(0, 12, 0); 


$supplierData = array_fill(0, 12, 0); 
$customerData = array_fill(0, 12, 0); 


$sql = "SELECT MONTH(created_at) AS month, COUNT(*) AS user_count, role 
        FROM users 
        WHERE role IN ('customer', 'supplier') 
        GROUP BY MONTH(created_at), role
        ORDER BY MONTH(created_at)";
$result = $conn->query($sql);


while ($row = $result->fetch_assoc()) {
    if ($row['role'] === 'supplier') {
        $supplierData[$row['month'] - 1] = $row['user_count']; 
    } elseif ($row['role'] === 'customer') {
        $customerData[$row['month'] - 1] = $row['user_count']; 
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Admin</title>
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
            <a href="#" class="navbar-highlight">
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
            <a href="reports.php">
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
        <div class="dashboard mt-4">
            <h3>Dashboard</h3>
            <div class="container total">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card total-users">
                            <div class="card-body d-flex userss">  
                                <div class="d-flex gap-2">
                                    <i class="fas fa-user d-flex align-items-center"></i>
                                </div>
                                <div class="total-number">
                                    <p class="total-num"><?php echo $totalClients; ?></p>
                                    <p class="total-title">Client Users</p>
                                </div>
                            </div>
                            <div class="line"><hr></div>
                            <div class="card-body d-flex plus-users">  
                                <div class="d-flex gap-2">
                                <i class="fas fa-plus d-flex align-items-center"></i>
                                </div>
                                <div class="total-number">
                                    <p class="total-num"><?php echo $newUsers; ?></p>
                                    <p class="total-title">New Users</p>
                                </div>
                            </div> 
                            <div class="line"><hr></div>  
                            <div class="card-body d-flex plus-users">  
                                <div class="d-flex gap-2">
                                <i class="fas fa-box d-flex align-items-center"></i>
                                </div>
                                <div class="total-number">
                                    <p class="total-num"><?php echo $totalSuppliers; ?></p>
                                    <p class="total-title">Total Suppliers</p>
                                </div>
                            </div>                   
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="chart-container">
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('salesChart').getContext('2d');

    var supplierData = <?php echo json_encode($supplierData); ?>;
    var clientData = <?php echo json_encode($clientData); ?>;

    var chartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: 'Supplier Users',
                data: supplierData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
            },
            {
                label: 'Client Users',
                data: clientData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)', 
                borderColor: 'rgba(255, 99, 132, 1)', 
                borderWidth: 2,
                fill: true,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 1)'
            }
        ]
    };

    var salesChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 500, 
                    ticks: {
                        color: 'white', 
                        callback: function(value) {
                            return value + ' users';
                        }
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)' 
                    }
                },
                x: {
                    ticks: {
                        color: 'white' 
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += context.raw + ' users';
                            return label;
                        }
                    },
                    bodyColor: 'white', 
                    titleColor: 'white', 
                    backgroundColor: 'rgba(0, 0, 0, 0.7)' 
                },
                legend: {
                    labels: {
                        color: 'white' 
                    }
                }
            }
        }
    });
});
                        </script>
                        <h5 class="chart-title">Monthly Sales</h5>
                        <canvas id="salesChart"></canvas>
                    </div>
                    </div>         
                </div>
            </div>
        
            <div class="col-md-12 d-flex justify-content-center mx-auto">
            <div class="container supplier-reg">
                <h5>SUPPLIERS REGISTRATION REQUEST</h5>
                <?php 
                    include '../../function/php/supplier-req.php';
                ?>
                <div class="table-wrapper px-lg-5">
                <table class="table table-hover table-remove-borders" style="background-color: #2A2E32; color: white;">
                    <thead class="thead-light" style="background-color: #2A2E32; color: white;">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($user = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $user['id']; ?></td>
                                    <td><?php echo $user['name']; ?></td>
                                    <td><?php echo $user['email']; ?></td>
                                    <td class="d-flex gap-1 justify-content-center">
                                    <form method="POST" action="../../function/php/supplier-req.php" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" name="accept" class="btn btn-success">Accept</button>
                                    </form>
                                    <form method="POST" action="../../function/php/supplier-req.php" style="display:inline;">
                                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">No inactive suppliers found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
            </div>
        </div>


        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>