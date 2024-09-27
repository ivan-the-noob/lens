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
                    <a class="nav-link" href="#snapfeed">Snapfeed</a>
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


    <section class="supplier-profile">
        <div class="container mt-5">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a href="#"><button class="nav-link about-me highlight">About Me</button></a>
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

        <?php
        include '../../../../db/db.php';
        if (!isset($_SESSION['email'])) {
            die('Email not found in session.');
        }

        $email = $_SESSION['email'];
        
        // Initialize variables to hold form data
        $profileImg = ''; // Default image
        $profession = '';
        $about_me = '';
        $age = '';
        $latitude = '';
        $longitude = '';
        
        // Prepare and execute SQL statement to retrieve existing data
        $stmt = $conn->prepare("SELECT profile_image, profession, about_me, age, latitude, longitude FROM about_me WHERE email = ?");
        if ($stmt === false) {
            die('Prepare failed: ' . $conn->error);
        }
        
        $stmt->bind_param('s', $email);
        
        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }
        
        $stmt->bind_result($profileImg, $profession, $about_me, $age, $latitude, $longitude);
        if (!$stmt->fetch()) {
            // Handle the case where no data is found
            $profileImg = 'default_image.jpg'; // Default image
            $profession = '';
            $about_me = '';
            $age = '';
            $latitude = '';
            $longitude = '';
        }
        
        $stmt->close();
        $conn->close();
        ?>

<div class="about-me-section">
    <div class="container mt-5 about-section">
        <div class="col-md-6 d-flex flex-column justify-content-center">
            <form enctype="multipart/form-data" method="POST" action="../../function/php/about-me.php" class="about-mes">
                <div class="mb-3">
                    <div class="d-flex justify-content-center mx-auto">
                        <?php if ($role != 'guest') { ?>
                            <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-imgs">
                        <?php } else { ?>
                            <img src="../../../assets/img/profile/profile.jpg" class="img-fluid rounded-circle input-profile mb-2" alt="Profile Picture">
                        <?php } ?>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <div class="form-check m-1 custom-checkbox">
                            <input class="form-check-input" type="checkbox" name="profession[]" id="photographer" value="photographer" 
                                <?php echo in_array('photographer', explode(',', $profession)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="photographer">Photographer</label>
                        </div>
                        <div class="form-check m-1 custom-checkbox">
                            <input class="form-check-input" type="checkbox" name="profession[]" id="videographer" value="videographer" 
                                <?php echo in_array('videographer', explode(',', $profession)) ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="videographer">Videographer</label>
                        </div>
                    </div>

                    <input class="form-control" type="file" name="profile_image" id="imageUpload" accept="image/*">
                </div>

                <div class="mb-3">
                    <textarea class="form-control" name="about_me" placeholder="About me"><?php echo htmlspecialchars($about_me); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="location">Pin Your Location</label>
                    <input id="location" name="location_text" class="form-control" type="text" placeholder="Search location">
                    <div id="map" style="width: 100%; height: 300px;"></div>
                    <input type="hidden" name="latitude" id="latitude" value="<?php echo htmlspecialchars($latitude); ?>">
                    <input type="hidden" name="longitude" id="longitude" value="<?php echo htmlspecialchars($longitude); ?>">
                </div>

                <div class="mb-3">
                    <input type="number" class="form-control" name="age" placeholder="Age" value="<?php echo htmlspecialchars($age); ?>">
                </div>

                <button type="submit" class="btn about-me-button">Save</button>
            </form>
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
    // Cavite, Philippines bounds
    var caviteBounds = {
        north: 14.48,
        south: 13.91,
        west: 120.70,
        east: 121.10
    };

    // Center the map on Cavite
    var caviteCenter = { lat: 14.2710, lng: 120.9050 };

    // Get latitude and longitude from hidden inputs
    var initialLat = parseFloat(document.getElementById('latitude').value) || caviteCenter.lat;
    var initialLng = parseFloat(document.getElementById('longitude').value) || caviteCenter.lng;

    // Initialize the map
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: initialLat, lng: initialLng },
        zoom: 17,
        restriction: {
            latLngBounds: caviteBounds,
            strictBounds: false
        }
    });

    // Initialize the marker
    var marker = new google.maps.Marker({
        position: { lat: initialLat, lng: initialLng },
        map: map,
        draggable: true // Make the marker draggable
    });

    // Initialize the Places Autocomplete service
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'), {
        bounds: caviteBounds,
        componentRestrictions: { country: 'ph' }
    });

    // When a user selects a place from the autocomplete suggestions
    autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            return;
        }

        // Check if the selected place is within the bounds of Cavite
        if (place.geometry.location.lat() < caviteBounds.south ||
            place.geometry.location.lat() > caviteBounds.north ||
            place.geometry.location.lng() < caviteBounds.west ||
            place.geometry.location.lng() > caviteBounds.east) {
            alert("Please select a location within Cavite, Philippines.");
            return;
        }

        // Set the map's center to the selected place
        map.setCenter(place.geometry.location);
        map.setZoom(17);

        // Move the marker to the selected place
        marker.setPosition(place.geometry.location);

        // Update the hidden latitude and longitude fields
        document.getElementById('latitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });

    // Update latitude and longitude when the marker is dragged
    marker.addListener('dragend', function(event) {
        var lat = event.latLng.lat();
        var lng = event.latLng.lng();

        // Check if the marker is within the Cavite bounds
        if (lat < caviteBounds.south || lat > caviteBounds.north ||
            lng < caviteBounds.west || lng > caviteBounds.east) {
            alert("Please place the marker within Cavite, Philippines.");
            marker.setPosition({ lat: initialLat, lng: initialLng }); // Reset to the initial position
            map.setCenter({ lat: initialLat, lng: initialLng });
        } else {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }
    });
}

// Initialize the map when the window loads
window.onload = initMap;
</script>
</body>
</html>
