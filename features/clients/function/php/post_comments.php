<?php
require '../../../../db/db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $id = $_POST['id'];
    $comments = $_POST['comments'];

    // Validate inputs (optional but recommended)
    if (empty($id) || empty($comments)) {
        die("ID and comments cannot be empty.");
    }

    // Prepare the SQL statement to append the new comment
    // First, fetch the existing comments
    $stmtFetch = $conn->prepare("SELECT comments FROM snapfeed WHERE id = ?");
    $stmtFetch->bind_param("i", $id); // "i" means integer for id

    // Execute the fetch statement
    $stmtFetch->execute();
    $result = $stmtFetch->get_result();
    $existingComments = '';

    // Check if there are existing comments
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingComments = $row['comments'];
    }

    // Append the new comment to the existing comments
    if (!empty($existingComments)) {
        $existingComments .= ', "' . $comments . '"'; // Append new comment with a comma
    } else {
        $existingComments = '"' . $comments . '"'; // First comment
    }

    // Prepare the SQL statement to update the comments
    $stmtUpdate = $conn->prepare("UPDATE snapfeed SET comments = ? WHERE id = ?");
    $stmtUpdate->bind_param("si", $existingComments, $id); // "si" means string for comments and integer for id

    // Execute the update statement
    if ($stmtUpdate->execute()) {
        // Output JavaScript to log the ID and comments to the console
        echo '<script>
                console.log("ID: ' . htmlspecialchars($id) . '");
                console.log("Comments: ' . htmlspecialchars($existingComments) . '");
              </script>';
        
        // Optionally, redirect or provide feedback
        echo '<script>
                alert("Comment posted successfully");
                window.location.href = "your_redirect_page.php"; // Redirect after showing the console log
              </script>';
        exit;
    } else {
        // Handle the error
        echo '<script>
                console.error("Error: Could not post comment. ' . htmlspecialchars($stmtUpdate->error) . '");
              </script>';
    }

    // Close the statements
    $stmtFetch->close();
    $stmtUpdate->close();
}

// Close the database connection
$conn->close();
?>
