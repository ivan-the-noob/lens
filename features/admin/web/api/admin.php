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
    <div class="navbar flex-column bg-white shadow-sm p-3 collapse d-md-flex" id="navbar">
        <div class="navbar-links">
            <a class="navbar-brand d-none d-md-block logo-container" href="#">
                <img src="../../../../assets/img/logo.png" alt="Logo">
            </a>
            <a href="#dashboard" class="navbar-highlight">
                <i class="fa-solid fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="#dashboard">
                <i class="fa-solid fa-tachometer-alt"></i>
                <span>Announcement</span>
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
                        <img src="../../../../assets/img/vet logo.png"
                            style="width: 40px; height: 40px; object-fit: cover;">
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="../../../users/web/api/logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="dashboard mt-4">
            <h3>Dashboard</h3>
            <div class="container total">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card total-users">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <i class="fas fa-user"></i>
                                    <h5>TOTAL USERS</h5>
                                </div>
                                <p>1000</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card new-users">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <i class="fas fa-plus"></i>
                                    <h5>NEW USERS</h5>
                                </div>
                                <p>1000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card total-suppliers">
                            <div class="card-body">
                                <div class="d-flex gap-2">
                                    <i class="fas fa-user"></i>
                                    <h5>TOTAL SUPPLIERS</h5>
                                </div>
                                <p>50</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2">
                <div class="card registration">
                    <div class="card-body">
                        <h5>SUPPLIERS REGISTRATION REQUEST</h5>
                        <div class="blank">

                        </div>
                        <div class="container">
                            <div class="row justify-content-center mt-1">
                                <div class="col-md-3">
                                    <div class="d-flex">
                                        <p>Name:</p>
                                        <p>Ivan Ablanida</p>
                                    </div>
                                    <div class="d-flex">
                                        <p>Service:</p>
                                        <p>Videographer</p>
                                    </div>
                                </div>
                                <div class="col-md-3 d-flex gap-1 align-items-center justify-content-center">
                                    <button class=" btn btn-primary">View</button>
                                    <button class="btn btn-success">Accept</button>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                                <hr class="mt-2 mb-2">

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>