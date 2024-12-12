<?php
session_start();

$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'guest';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

$profileImg = ''; 

if ($role != 'guest' && !empty($email)) {
   include 'db/db.php'; 

    $stmt = $conn->prepare("SELECT profile_img FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($profileImg);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $profileImg = 'assets/img/profile/' . $profileImg;
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
    <link rel="stylesheet" href="features/index/css/index.css">

</head>
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
            

                <!-- Navbar HTML -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="features/index/web/api/about-us.php">About</a>
                    </li>

                    <!-- Dynamically show based on user role -->
                    <?php if ($role == 'supplier'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="features/suppliers/web/api/snapfeed.php">Snapfeed</a>
                        </li>
                    <?php elseif ($role == 'customer'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="features/clients/web/api/snapfeed.php">Snapfeed</a>
                        </li>
                    <?php else: // For guests ?>
                        <li class="nav-item">
                            <a class="nav-link" href="authentication/web/api/login.php">Snapfeed</a>
                        </li>
                    <?php endif; ?>


                    
                </ul>

                <div class="d-flex ml-auto">
                    <?php if ($role != 'guest') { ?>
                        <div class="dropdown">
                            <button class="btn btn-theme dropdown-toggle" type=" button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo htmlspecialchars($profileImg); ?>" alt="Profile" class="profile-img">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="features/index/function/php/logout.php">Logout</a></li>
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

    <section class="news">
    <div class="container">
    <?php
require 'db/db.php';

// Fetch the latest news article from the database
$sql = "SELECT * FROM news ORDER BY date DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Format the date to be in the format "Month Day, Year"
    $formatted_date = date("F j, Y", strtotime($row['date']));

    echo "<div class='row align-items-center'>";
    
    // Left side with image
    echo "<div class='col-lg-6 col-md-12 mt-5'>";
    // Check if there is an image and display it
    if ($row['image']) {
        echo "<img src='assets/img/" . $row['image'] . "' alt='News Image' class='img-fluid news-img'>";
    } else {
        // If no image, display a placeholder or default image
        echo "<img src='assets/img/news.jpg' alt='Placeholder Image' class='img-fluid news-img'>";
    }
    echo "</div>";

    // Right side with text and button
    echo "<div class='col-lg-6 col-md-12 mt-5'>";
    echo "<h3>" . $row['heading'] . "</h3>";
    echo "<h5>News by | " . $row['uploader'] . " | " . $formatted_date . "</h5>";
    echo "<p>" . $row['context'] . "</p>";
    echo "<button class='btn'>Get Started</button>";
    echo "</div>";

    echo "</div>";
} else {
    echo "<p>No news available</p>";
}

$conn->close();
?>

    </div>
</section>


    <section class="top-supplier">
      <div class="container top3 mt-5">
          <div class="row text-center">
          <?php
require 'db/db.php';

$sql = "SELECT email_uploader, COUNT(email_uploader) AS email_count
        FROM appointment
        GROUP BY email_uploader
        ORDER BY email_count DESC
        LIMIT 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $email = $row['email_uploader'];

        $snapfeed_sql = "SELECT card_img 
                        FROM snapfeed 
                        WHERE email = '$email' 
                        ORDER BY created_at DESC 
                        LIMIT 1";
        $snapfeed_result = $conn->query($snapfeed_sql);
        $image = $snapfeed_result->num_rows > 0 ? $snapfeed_result->fetch_assoc()['card_img'] : 'No Image';

        $users_sql = "SELECT name FROM users WHERE email = '$email'";
        $users_result = $conn->query($users_sql);
        $name = $users_result->num_rows > 0 ? $users_result->fetch_assoc()['name'] : 'Unknown';

        $data[] = [
            'email' => $email,
            'image' => $image,
            'name' => $name
        ];
    }
}
?>

<section class="row text-center">
    <?php
    if (!empty($data)) {
        foreach ($data as $index => $row) {
            echo "<div class='col-md-4 photo-card'>";
            echo "<div class='photo-wrap'>";
            echo "<img src='assets/img/snapfeed/" . $row['image'] . "' alt='Photo " . ($index + 1) . "' class='img-fluid'>";
            echo "<button class='zoom-icon btn' data-bs-toggle='modal' data-bs-target='#imageModal' data-img-src='assets/img/top3/" . $row['image'] . "'><i class='fa-solid fa-up-right-and-down-left-from-center'></i></button>";
            echo "<div class='photographer-info'>";
            echo "<a href=''><img src='assets/img/profile/profile.jpg' alt='Photographer " . ($index + 1) . "' class='profile-pic'>";
            echo "<p class='photographer-name'>" . $row['name'] . "</p></a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No top photographers found</p>";
    }
    ?>
</section>

<?php $conn->close(); ?>

          </div>
      </div>
  </section>
  
  <!-- Modal for zoom -->
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-body">
                  <img src="" class="img-fluid full-screen-img" alt="Full Image">
              </div>
          </div>
      </div>
  </div>
  
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const section = document.querySelector('.top-supplier');
      const images = section.querySelectorAll('.photo-card img');
  
      const observer = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
              if (entry.isIntersecting) {
                  images.forEach(img => img.classList.add('in-view'));
              } else {
                  images.forEach(img => img.classList.remove('in-view'));
              }
          });
      }, {
          threshold: 0.1
      });
  
      observer.observe(section);
  });
  </script>
  

    </div>
    <section class="news-section sub-news">
      <div class="container mt-5">
        <div class="row justify-content-center mx-auto">
          <div class="col-lg-7 col-md-12 solo-img">
          <?php
            require 'db/db.php';
            $sql = "SELECT * FROM sub_news ORDER BY date DESC LIMIT 1"; 
            $result = $conn->query($sql);
            ?>

            <div class="news-item position-relative mb-2">
            <?php
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $formatted_date = date("M j, Y", strtotime($row['date']));
                echo "<img src='assets/img/sub-news/" . $row['img'] . "' class='img-fluid img-opacity-animation' style='height:66vh' alt='" . $row['title'] . "'>";
                echo "<div class='news-text position-absolute bottom-0 start-0 p-4 text-white'>";
                echo "<span class='news-date'>$formatted_date</span>";
                echo "<h3 class='news-title'>" . $row['title'] . "</h3>";
                echo "</div>";
            } else {
                echo "<p>No news available</p>";
            }
            ?>
            </div>
            <?php $conn->close(); ?>

          </div>
    
          <div class="col-lg-4 col-md-12 stacked-img">
          <?php
            require 'db/db.php';

            $sql = "SELECT * FROM sub_news ORDER BY date DESC LIMIT 2"; 
            $result = $conn->query($sql);
            ?>

            <div class="news-item position-relative mb-2">
            <?php
            if ($result->num_rows > 1) {
                $result->data_seek(1);
                $row = $result->fetch_assoc();
                $formatted_date = date("M j, Y", strtotime($row['date'])); 
                echo "<img src='assets/img/sub-news/" . $row['img'] . "' class='img-opacity-animation' alt='" . $row['title'] . "'>";
                echo "<div class='news-text position-absolute bottom-0 start-0 p-4 text-white'>";
                echo "<div class='stack-img'>";
                echo "<span class='news-date'>$formatted_date</span>";
                echo "<h3 class='news-title'>" . $row['title'] . "</h3>";
                echo "</div>";
                echo "</div>";
            } else {
                echo "<p>No second latest news available</p>";
            }
            ?>
</div>
<?php $conn->close(); ?>

    

<?php
require 'db/db.php';

$sql = "SELECT * FROM sub_news ORDER BY date DESC LIMIT 3"; 
$result = $conn->query($sql);
?>

<div class="news-item position-relative">
  <?php
  if ($result->num_rows > 2) {
    $result->data_seek(2);
    $row = $result->fetch_assoc();
    $formatted_date = date("M j, Y", strtotime($row['date'])); 
    echo "<img src='assets/img/sub-news/" . $row['img'] . "' class='img-opacity-animation' alt='" . $row['title'] . "'>";
    echo "<div class='news-text position-absolute bottom-0 start-0 p-4 text-white'>";
    echo "<div class='stack-img'>";
    echo "<span class='news-date'>$formatted_date</span>";
    echo "<h3 class='news-title'>" . $row['title'] . "</h3>";
    echo "</div>";
    echo "</div>";
  } else {
    echo "<p>No third latest news available</p>";
  }
  ?>
</div>
<?php $conn->close(); ?>

          </div>
        </div>
      </div>
    </section>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const section = document.querySelector('.sub-news');
          const soloImg = section.querySelector('.solo-img');
          const stackedImg = section.querySelector('.stacked-img');
      
          const observer = new IntersectionObserver((entries) => {
              entries.forEach(entry => {
                  if (entry.isIntersecting) {
                      soloImg.classList.add('animate-left');
                      stackedImg.classList.add('animate-right');
                  } else {

                      soloImg.classList.remove('animate-left');
                      stackedImg.classList.remove('animate-right');
                  }
              });
          }, {
              threshold: 0.1 
          });
      
          observer.observe(section);
      });
      </script>
      
      
    
    <div class="wave">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250" style="margin-bottom: -5px;">
        <path fill="#a67b5b" fill-opacity="1"
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
    
  
  <script>
   document.querySelectorAll('.zoom-icon').forEach(function (btn) {
  btn.addEventListener('click', function () {
    const imgSrc = this.getAttribute('data-img-src');
    const modalImg = document.querySelector('.full-screen-img');
    modalImg.src = imgSrc; // Set the modal image source to the clicked image
  });
});


  </script>

    
    <script src="features/clients/function/script/pre-load.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

</body>
</html>
