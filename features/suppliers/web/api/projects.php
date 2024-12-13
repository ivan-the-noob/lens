<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: authentication/web/api/login.php");
        exit();
    }
    $email = $_SESSION['email'];
    $role = $_SESSION['role']; 

    $profileImg = ''; 

if ($role != 'guest' && !empty($email)) {
    require '../../../../db/db.php';

    $stmt = $conn->prepare("SELECT profile_img FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($profileImg);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $profileImg = '../../../../assets/img/profile/' . $profileImg;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/supplier-profile.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div id="preloader">
        <div class="line"></div>
        <div class="left"></div>
        <div class="right"></div>
    </div>

    <nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand d-none d-md-block logo" href="#">
            LENSFOLIOHUB
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                style="stroke: black; fill: none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Links (left) -->
            <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../.././../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../../../index/web/api/about-us.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Snapfeed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about-me.php">Profile</a>
                    </li>
                </ul>

            <!-- Profile dropdown (right) -->
            <div class="d-flex ms-auto">
                <?php if ($role != 'guest') { ?>
                    <div class="dropdown">
                        <button class="btn btn-theme dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-img">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="../../../index/function/php/logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <!-- User is not logged in, display a login link -->
                    <a href="authentication/web/api/login.php" class="btn btn-theme" type="button">Login</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>


    <section class="supplier-profile">
        <div class="container mt-5">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="about-me.php"><button class="nav-link about-me">About Me</button></a>
                </li>
                <li class="nav-item">
                    <a href="projects.php"><button class="nav-link highlight">Projects</button></a>
                </li>
                <li class="nav-item">
                    <a href="calendar.php"><button class="nav-link calendar">Calendar</button></a>
                </li>
                <li class="nav-item">
                    <a href="contacts.php"><button class="nav-link contacts">Contacts</button></a>
                </li>
            </ul>
        </div>

        <div class="about-me-section" style="display: none;">
            <div class="container mt-5 about-section">
                    <div class="col-md-8 d-flex flex-column justify-content-center">
                        <form enctype="multipart/form-data">
                            <div class="mb-3">

                                    <img src="../../../../assets/img/profile/profile.jpg" class="img-fluid rounded-circle mb-2" alt="Profile Picture">

                                <!-- Input field for image upload -->
                                <input class="form-control" type="file" id="imageUpload" accept="image/*" >
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" placeholder="Hi, I'm a photographer">Hey</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
            </div>
        </div>

        <div class="container mt-5">
            <!-- Buttons to toggle between Style 1 (Grid) and Style 2 (Carousel) -->
            <div class="text-center mb-3">
                <button id="style1" class="btn style-btn">Style 1 (Grid)</button>
                <button id="style2" class="btn style-btn">Style 2 (Carousel)</button>
            </div>
        
            <!-- Style 1: Grid Layout -->
            <div id="grid-layout" class="projects">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-1.jpg" class="img-fluid img-wh" alt="Image 1">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-2.jpg" class="img-fluid img-wh" alt="Image 2">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-3.jpg" class="img-fluid img-wh" alt="Image 3">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-4.jpg" class="img-fluid img-wh" alt="Image 4">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-5.jpg" class="img-fluid img-wh" alt="Image 5">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-6.jpg" class="img-fluid img-wh" alt="Image 6">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-7.jpg" class="img-fluid img-wh" alt="Image 7">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-8.jpg" class="img-fluid img-wh" alt="Image 8">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-9.jpg" class="img-fluid img-wh" alt="Image 9">
                    </div>
                    <div class="col-md-3 mb-3">
                        <img src="../../../../assets/img/snapfeed/gallery-10.jpg" class="img-fluid img-wh" alt="Image 10">
                    </div>
                </div>
            </div>
        
            <div id="carousel-layout" class="carousel-container">
                <div class="carousel-slider">
                    <img id="img1" src="../../../../assets/img/snapfeed/gallery-1.jpg" alt="Image 1" class="carousel-img">
                    <img id="img2" src="../../../../assets/img/snapfeed/gallery-2.jpg" alt="Image 2" class="carousel-img">
                    <img id="img3" src="../../../../assets/img/snapfeed/gallery-3.jpg" alt="Image 3" class="carousel-img">
                    <img id="img4" src="../../../../assets/img/snapfeed/gallery-4.jpg" alt="Image 4" class="carousel-img">
                    <img id="img5" src="../../../../assets/img/snapfeed/gallery-5.jpg" alt="Image 5" class="carousel-img">
                    <img id="img6" src="../../../../assets/img/snapfeed/gallery-6.jpg" alt="Image 6" class="carousel-img">
                    <img id="img1" src="../../../../assets/img/snapfeed/gallery-7.jpg" alt="Image 1" class="carousel-img">
                    <img id="img2" src="../../../../assets/img/snapfeed/gallery-8.jpg" alt="Image 2" class="carousel-img">
                    <img id="img3" src="../../../../assets/img/snapfeed/gallery-9.jpg" alt="Image 3" class="carousel-img">
                    <img id="img4" src="../../../../assets/img/snapfeed/gallery-10.jpg" alt="Image 4" class="carousel-img">
                </div>
                <div class="buttons">
                    <button class="prev" onclick="plusSlides(-1)">&#10094;</button>
                    <button class="next" onclick="plusSlides(1)">&#10095;</button>
                </div>
            </div>
    </section>

    <script>
        
    </script>
     
    <div class="wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250" style="margin-bottom: -5px;">
          <path fill="#FAF7F2" fill-opacity="1"
            d="M0,128L60,138.7C120,149,240,171,360,170.7C480,171,600,149,720,133.3C840,117,960,107,1080,112C1200,117,1320,139,1380,149.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
          </path>
        </svg>
      </div>


    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4">
                    <h5>About Photography News</h5>
                    <p>Stay updated with the latest news, trends, and innovations in the world of photography. Whether you're a professional or an enthusiast, our articles are designed to inspire and inform.</p>
                </div>
    
                <!-- Quick Links -->
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Latest News</a></li>
                        <li><a href="#">Photography Tips</a></li>
                        <li><a href="#">Camera Reviews</a></li>
                    </ul>
                </div>
    
                <!-- Contact Section -->
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: info@photographynews.com</p>
                    <p>Phone: +123 456 7890</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p>&copy; 2024 Photography News. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../../function/script/slider-img.js"></script>
    <script src="../../function/script/pre-loadall.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    


</body>
</html>
