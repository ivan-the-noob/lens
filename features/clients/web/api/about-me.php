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
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="snapfeed.php">Snapfeed</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#supplier">Supplier</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#profile">Profile</a>
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
<?php
require '../../../../db/db.php';

// Default values
$profileImg = ''; 
$about_me = '';
$profession = '';
$latitude = '';
$longitude = '';
$age = '';
$name = 'Unknown User'; // Default name
$uploaderEmail = ''; // Initialize uploaderEmail variable
$location_text = ''; // Initialize location_text variable

// Fetch user data if email is provided
if (isset($_POST['uploader_email'])) {
    $uploaderEmail = $_POST['uploader_email'];

    // Check if email is empty
    if (empty($uploaderEmail)) {
        die("Uploader email is empty.");
    }

    // Prepare SQL to fetch user details, including location_text
    $sql = "SELECT u.name, u.profile_img, a.about_me, a.profession, a.latitude, a.longitude, a.age, a.location_text
            FROM about_me a 
            JOIN users u ON a.email = u.email 
            WHERE a.email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $uploaderEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user data is found, populate the variables
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = $user['name'];
        $profileImg = $user['profile_img'] ? '../../../../assets/img/profile/' . $user['profile_img'] : $profileImg;
        $about_me = $user['about_me'];
        $profession = $user['profession'];
        $latitude = $user['latitude'];
        $longitude = $user['longitude'];
        $age = $user['age'];
        $location_text = $user['location_text']; // Assign plain text location
    } else {
        echo "No data found for this user.";
    }

    // Clean up
    $stmt->close();
} else {
    echo "No email provided.";
}

$conn->close();
?>




<section class="supplier-profile">
        <div class="container mt-5">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="#"><button class="nav-link about-me highlight">About <?php echo htmlspecialchars($name); ?></button></a>
                </li>
                <li class="nav-item">
                    <a href="projects.php"><button class="nav-link">Projects</button></a>
                </li>
                <li class="nav-item">
                    <a href="calendar.php"><button class="nav-link calendar">Calendar</button></a>
                </li>
                <li class="nav-item">
                    <a href="contacts.php"><button class="nav-link contacts">Contacts</button></a>
                </li>
            </ul>
        </div>





<div class="about-me-section">
<div class="container mt-5">
    <div class="row">
      <div class="col-lg-5 col-md-12 mb-4">
  <div class="card text-center text-white h-100 about-me-container position-relative">
    <div class="card-body d-flex flex-column">
      <div id="slide-1" class="slider-content active">
        <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-imgs mx-auto">
        <h5 class="text-center"><?php echo htmlspecialchars($name); ?></h5> 
        <p class="text-start context"><?php echo nl2br(htmlspecialchars($about_me)); ?></p>
        <a href="#" class="btn mt-3 about-me-button">Hire me</a>
      </div>

      <div id="slide-2" class="slider-content">
        <p><strong>Location:</strong></p>
        <p><?php echo htmlspecialchars($location_text); ?></p>
        <div id="map" style="height: 300px; width: 100%;"></div>
      </div>

      <button id="prev-btn" class="btn btn-outline-primary position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%); display: none;">
        &lt;
      </button>

      <button id="next-btn" class="btn btn-outline-primary position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">
        &gt;
      </button>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    var currentSlide = 1;
    var totalSlides = 2; 

    var nextBtn = document.getElementById("next-btn");
    var prevBtn = document.getElementById("prev-btn");

    function updateButtons() {
      // Show/hide buttons based on current slide
      prevBtn.style.display = (currentSlide === 1) ? 'none' : 'block';
      nextBtn.style.display = (currentSlide === totalSlides) ? 'none' : 'block';
    }

    nextBtn.addEventListener("click", function() {
      // Hide current slide
      document.getElementById('slide-' + currentSlide).classList.remove('active');
      
      // Update current slide index
      currentSlide++;
      
      // Show next slide
      document.getElementById('slide-' + currentSlide).classList.add('active');
      updateButtons(); // Update button visibility
    });

    prevBtn.addEventListener("click", function() {
      // Hide current slide
      document.getElementById('slide-' + currentSlide).classList.remove('active');
      
      // Update current slide index
      currentSlide--;
      
      // Show previous slide
      document.getElementById('slide-' + currentSlide).classList.add('active');
      updateButtons(); // Update button visibility
    });

    // Initialize button visibility
    updateButtons();
  });
</script>

<style>
  /* Styling for the slider */
  .slider-content {
    display: none;
  }
  
  .slider-content.active {
    display: block;
  }
</style>



      <!-- Small Cards (Right) -->
      <div class="col-lg-7 col-md-12">
        <div class="row h-100">
          <!-- Small Card 1 -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Profession</h5>
                <p>  <?php 
                    // Handle professions if available
                    $professionsArray = explode(',', $profession); 
                    echo !empty($professionsArray) ? implode(', ', array_map('htmlspecialchars', $professionsArray)) : 'None'; 
                    ?></p>
              </div>
            </div>
          </div>

          <!-- Small Card 2 -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Works</h5>
                <a href="#" class="btn btn-link">More</a>
              </div>
            </div>
          </div>

          <!-- Small Card 3 -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Review</h5>
                <a href="#" class="btn btn-link">More</a>
              </div>
            </div>
          </div>

          <!-- Small Card 4 -->
          <div class="col-md-6 mb-4">
            <div class="card h-100 text-center">
              <div class="card-body">
                <h5 class="card-title">Age</h5>
                <p><strong></strong> <?php echo htmlspecialchars($age); ?> Year's Old</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="container mt-5 about-section">
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <div class="mb-1">
                <div class="d-flex justify-content-center mx-auto">
                    <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-imgs">
                </div>
            </div>

            <!-- Display the user's name after the profile image -->
            <div class="mb-3">
                <div class="d-flex justify-content-center">
                    <h3 class=""><?php echo htmlspecialchars($name); ?></h3> 
                </div>
                <p class="text-center"><?php echo htmlspecialchars($uploaderEmail); ?></p>
            </div>

            <div class="mb-3">
                <p><strong>Profession:</strong></p>
                <p>  <?php 
                    // Handle professions if available
                    $professionsArray = explode(',', $profession); 
                    echo !empty($professionsArray) ? implode(', ', array_map('htmlspecialchars', $professionsArray)) : 'None'; 
                    ?></p>
            </div>

          

            <div class="mb-3">
                <p><strong>About Me:</strong></p>
                <p><?php echo nl2br(htmlspecialchars($about_me)); ?></p>
            </div>

       

            <div class="mb-3">
                <p><strong>Location:</strong> 
                <p><?php echo htmlspecialchars($location_text); ?></p>
                    <div id="map" style="height: 200px; width: 100%;"></div>
                </p>
            </div>

            <div class="mb-3">
                <p><strong>Age:</strong> <?php echo htmlspecialchars($age); ?></p>
            </div>
        </div>
    </div>
</div>


         
    </section>

     
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
    



    <script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDmgygVeipMUsrtGeZPZ9UzXRmcVdheIqw&libraries=places&callback=initMap" async defer>
</script>
    <script>
      function initMap() {
    // Fixed coordinates based on user data
    var fixedLat = <?php echo htmlspecialchars($latitude); ?>;
    var fixedLng = <?php echo htmlspecialchars($longitude); ?>;

    // Cavite, Philippines bounds
    var caviteBounds = {
        north: 14.48,
        south: 13.91,
        west: 120.70,
        east: 121.10
    };

    // Initialize the map with restrictions and disabled controls
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: fixedLat, lng: fixedLng },
        zoom: 17,
        restriction: {
            latLngBounds: caviteBounds,
            strictBounds: false // Ensures that users can move within Cavite bounds
        },
        // Disable map controls like dragging, zooming, etc.
        disableDefaultUI: true, // Disables all default controls like zoom, map type selector
        zoomControl: false,     // Disables zoom control
        draggable: false,       // Disables map dragging
        scrollwheel: false,     // Disables zooming using scroll
        disableDoubleClickZoom: true, // Disables double click to zoom
        gestureHandling: 'none' // Prevents all user gestures (dragging, zooming)
    });

    // Initialize the marker without the draggable option
    var marker = new google.maps.Marker({
        position: { lat: fixedLat, lng: fixedLng },
        map: map
        // No draggable option, marker is fixed
    });
}

// Initialize the map when the window loads
window.onload = initMap;



</script>
</body>
</html>
