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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/snapfeed.css">

</head>

<style>
      
        
</style>
<body>
    <div id="preloader">
        <div class="line"></div>
        <div class="left"></div>
        <div class="right"></div>
    </div>

    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <a class="navbar-brand d-none d-md-block logo" href="#">
                LENSFOLIOHUB
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    style="stroke: black; fill: none;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
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
                <div class="d-flex ml-auto">
                    <?php if ($role != 'guest') { ?>
                        <div class="dropdown">
                            <button class="btn btn-theme dropdown-toggle" type=" button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-img">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="../../../index/function/php/logout.php">Logout</a></li>
                            </ul>
                            </div>
                        <?php } else { ?>
                        <!-- User is not logged in, display a login link -->
                        <a href="authentication/web/api/login.php" class="btn-theme" type="button">Login</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="text-box">
        POWER TO THE CREATORS
    </div>
    <div class="container">
        <!-- Card Section -->
        <div class="row">
            <div class="col-md-8 mb-3 justify-content-center align-items-center mx-auto">
            <form action="../../function/php/snapfeed.php" method="POST" enctype="multipart/form-data">
    <div class="card">
        <div class="row no-gutters">
            <!-- Left Section: Image -->
            <div class="col-md-6">
                <!-- This is where the chosen image will be previewed -->
                <img id="preview-img" src="../../../../assets/img/snapfeed/gallery-1.jpg" class="card-img show-input" alt="Selected Image">
            </div>
            <!-- Right Section: Profile Picture, Name, and Description -->
            <div class="col-md-6 d-flex">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 section-name">
                        <!-- Image for profile picture -->
                        <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-img rounded-circle">
                        
                        <!-- Use the session variable for the card title -->
                        <h5 class="card-title mb-0">
                            <?php 
                                echo isset($_SESSION['name']) ? $_SESSION['name'] : 'Unknown User'; 
                            ?>
                        </h5>
                    </div>

                    <input type="file" id="card_img" name="card_img" accept="image/*" required onchange="previewCardImage(event)" class="file-input mt-2">
                    <input type="text" id="img_title" name="img_title" class="form-control mt-2" required placeholder="Image Title">
                    <textarea id="card_text" name="card_text" rows="4" class="mt-3" required placeholder="Input Photo Caption"></textarea>
                    <input type="submit" value="Submit" class="submit-project mt-2">
                </div>
            </div>
        </div>
    </div>
</form>

<!-- JavaScript for Image Preview -->
<script>
function previewCardImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('preview-img');
        output.src = reader.result;  // Set the selected image as the source of the <img> tag
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

            </div>
        </div> 
</div>
    
        <!-- Image Section -->
        <section class="gallery-img mt-5">
            <div class="row disp_img">
                <?php
                    include '../../function/php/display_snapfeed.php'; 
                ?>
            </div>
        </section>
    
    </div>
</div>
     
    <div class="wave">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250" style="margin-bottom: -5px; background-color: #F3E7DB;">
          <path fill="#FAF7F2" fill-opacity="1"
            d="M0,128L60,138.7C120,149,240,171,360,170.7C480,171,600,149,720,133.3C840,117,960,107,1080,112C1200,117,1320,139,1380,149.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
          </path>
        </svg>
      </div>
<footer class="footer mb-0">
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


    

    
    <script src="../../function/script/pre-loadall.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

</body>

</html>
