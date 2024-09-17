<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../css/supplier.css">

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
                <ul class="navbar-nav">
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
                <div class="d-flex ml-auto">
                    <a href="features/users/web/api/login.php" class="btn-theme" type="button">Login</a>
                </div>
            </div>
        </div>
    </nav>
    
<div class="container ">
    <!-- Search Bar Section -->
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-6 col-sm-8 col-10">
              <div class="search-container">
                  <div class="search-bar">
                      <div class="position-relative" style="margin: auto; ">
                          <input type="text" class="form-control search-bars" placeholder="Search" aria-label="Search" style="padding-right: 40px;">
                          
                      </div>
                      <!-- Filter Buttons -->
                      <div class="filter-buttons d-flex flex-column">
                          <div class="btn-group-vertical" role="group" aria-label="Filter options">
                              <button type="button" class="btn search-button name">Name</button>
                              <button type="button" class="btn search-button">Location</button>
                              <button type="button" class="btn search-button">Category</button>
                              <button type="button" class="btn search-button pricing">Pricing</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
  
    <h4>Recent Searches</h4>
    <div class="recent-searches row">
      <div class="col-md-5">
        <div class="card">
            <div class="row ">
              <div class="top"></div>
                <div class="col-md-4">
                    <img src="../../../assets/img/profile/profile.jpg" class="img-fluid profile" alt="Photographer">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-title"><strong>Name:</strong> Photographer</p>
                        <p class="card-text"><strong>Location:</strong> Sydney</p>
                        <p class="card-text"><strong>Profession:</strong> Photographer</p>
                        <p class="card-text"><strong>Age:</strong> 30</p>
                        <div class="card-rating justify-content-end">
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">★</span>
                            <span class="star">☆</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  
      
      
      <!-- Add more cards here for additional searches -->
    </div>
  </div>

    
    
    


     
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

    
    <script src="../../function/script/pre-loadall.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

</body>
</html>
