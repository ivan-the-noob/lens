<?php

if (!isset($_SESSION['email'])) {
    header("Location: authentication/web/api/login.php");
    exit();
}

$email = $_SESSION['email'];
$role = $_SESSION['role']; 
$name = $_SESSION['name'];

require '../../../../db/db.php';

$sql = "SELECT id, img_title, card_img, card_text, email FROM snapfeed ORDER BY id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($result === FALSE) {
    echo "Error executing query: " . $conn->error;
    exit();
}

if ($result->num_rows > 0) {
    echo '<div class="row">';

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $imgTitle = $row['img_title'];
        $imgSrc = $row['card_img'];
        $cardText = $row['card_text'];
        $uploaderEmail = $row['email']; 

        echo '
        <div class="col-md-3 mb-3 gallery-item position-relative" id="gallery-item-' . $id . '">
            <img src="' . $imgSrc . '" class="img-fluid img-wh" alt="Image from Snapfeed" 
                 data-bs-toggle="modal" data-bs-target="#modal-' . $id . '"
                 data-img-src="' . htmlspecialchars($imgSrc) . '" 
                 data-img-title="' . htmlspecialchars($imgTitle) . '" 
                 data-img-text="' . htmlspecialchars($cardText) . '"
                 data-email="' . htmlspecialchars($uploaderEmail) . '"
                 data-modal-id="' . $id . '" 
                 onclick="updateModalContent(this)">
        </div>';

        // Modal structure
        echo '
        <div class="modal fade" id="modal-' . $id . '" tabindex="-1" aria-labelledby="modalLabel-' . $id . '" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img id="modal-main-img-' . $id . '" src="' . $imgSrc . '" class="img-fluid" alt="Image from Snapfeed">
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <p id="modal-main-title-' . $id . '" class="img-title">' . htmlspecialchars($imgTitle) . '</p>
                                <p id="modal-main-text-' . $id . '" class="card-text">' . htmlspecialchars($cardText) . '</p>
                               
                               <div class="container mt-auto comments">
                                    <div class="input-container d-flex align-items-center">
                                                <input type="text" class="form-control input-field" placeholder="Type something">
                                                <button class="btn send" type="button">
                                                        <i class="fas fa-paper-plane"></i> <!-- Send icon -->
                                                </button>
                                        <div class="like-container d-flex align-items-center">
                                            <button class="like-btn" type="button">
                                                <i class="fa-regular fa-heart"></i> <!-- Empty heart icon -->
                                            </button>
                                            <span class="like-count ms-2" id="hearts-counts">0</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                       <div class="row mt-3">
                            <div class="col-md-12">
                                <h5>Gallery of <span id="gallery-uploader-' . htmlspecialchars($uploaderEmail) . '">' . htmlspecialchars($uploaderEmail) . '</span></h5>
                                <div class="row" id="uploader-images-' . $id . '">';

                                // Fetch all images from the same uploader
                                $img_sql = "SELECT id, img_title, card_img, card_text FROM snapfeed WHERE email = ? ORDER BY id DESC";
                                $img_stmt = $conn->prepare($img_sql);
                                $img_stmt->bind_param("s", $uploaderEmail);
                                $img_stmt->execute();
                                $img_result = $img_stmt->get_result();

                                if ($img_result->num_rows > 0) {
                                    while ($img_row = $img_result->fetch_assoc()) {
                                        if ($img_row['card_img'] == $imgSrc) {
                                            continue; 
                                        }

                                        echo '
                                    <div class="col-md-4 mb-3 gallery-item" id="gallery-item-' . $img_row['id'] . '">
                                            <img id="additional-image-' . $img_row['id'] . '" src="' . htmlspecialchars($img_row['card_img']) . '" class="img-fluid modal-img" alt="Additional Image from Snapfeed" 
                                                data-img-src="' . htmlspecialchars($img_row['card_img']) . '" 
                                                data-img-title="' . htmlspecialchars($img_row['img_title']) . '" 
                                                data-img-text="' . htmlspecialchars($img_row['card_text']) . '"
                                                data-modal-id="' . $id . '" 
                                                onclick="updateModalContent(this)">
                                        </div>';
                                    }
                                }

                                echo '
                                                </div>
                                            </div>
                                        </div>                         
                                    </div>
                                </div>
                            </div>
                        </div>';
    }
}
?>

<script>
var previouslyHiddenGalleryItem = null;

function updateModalContent(imageElement) {
    // Get the ID of the modal from the clicked image
    var modalId = imageElement.getAttribute('data-modal-id');

    // Get new image details from the clicked image
    var newImgSrc = imageElement.getAttribute('data-img-src');
    var newImgTitle = imageElement.getAttribute('data-img-title');
    var newImgText = imageElement.getAttribute('data-img-text');
    var uploaderEmail = imageElement.getAttribute('data-email');

    // Get references to the modal elements that will be updated
    var modalImg = document.getElementById('modal-main-img-' + modalId);
    var modalTitle = document.getElementById('modal-main-title-' + modalId);
    var modalText = document.getElementById('modal-main-text-' + modalId);
    var modalEmail = document.getElementById('gallery-uploader-' + modalId);

    // Update modal content with the new image details
    if (modalImg) {
        modalImg.src = newImgSrc; // Swap the main modal image
    } else {
        console.error("Modal image not found for ID: " + modalId);
    }

    if (modalTitle) {
        modalTitle.textContent = newImgTitle; // Update the title
    } else {
        console.error("Modal title not found for ID: " + modalId);
    }

    if (modalText) {
        modalText.textContent = newImgText; // Update the text
    } else {
        console.error("Modal text not found for ID: " + modalId);
    }

    if (modalEmail) {
        modalEmail.textContent = uploaderEmail; // Update the uploader's email
    } else {
        console.error("Uploader email element not found for ID: " + modalId);
    }

    // Hide the current gallery item and show the previously hidden one
    var galleryItem = imageElement.parentElement;
    if (galleryItem) {
        galleryItem.style.display = 'none'; // Hide the clicked image's gallery item

        if (previouslyHiddenGalleryItem) {
            previouslyHiddenGalleryItem.style.display = 'block'; // Show the previously hidden item
        }
        previouslyHiddenGalleryItem = galleryItem; // Store the currently hidden item
    }

    // Optionally, if you want to clear the uploader gallery, uncomment the next lines
    // var uploaderGallery = document.getElementById('uploader-images-' + modalId);
    // uploaderGallery.innerHTML = ''; // Clear previous content
}

document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.like-btn');
    
    likeButtons.forEach(function(likeButton) {
        likeButton.addEventListener('click', function() {
            this.classList.toggle('active');

            // Change the icon based on active state
            const heartIcon = this.querySelector('i');
            const likeCountSpan = this.querySelector('.like-count');
            if (this.classList.contains('active')) {
                heartIcon.classList.remove('fa-regular', 'fa-heart'); // Remove empty heart
                heartIcon.classList.add('fa-solid', 'fa-heart'); // Add filled heart
                likeCountSpan.textContent = parseInt(likeCountSpan.textContent, 10) + 1; // Increase count
            } else {
                heartIcon.classList.remove('fa-solid', 'fa-heart'); // Remove filled heart
                heartIcon.classList.add('fa-regular', 'fa-heart'); // Add empty heart
                likeCountSpan.textContent = parseInt(likeCountSpan.textContent, 10) - 1; // Decrease count
            }
        });
    });
});
    
</script>
