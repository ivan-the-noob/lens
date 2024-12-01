<?php
require '../../../../db/db.php';

$query = "SELECT id, name, email, last_login FROM users WHERE role = 'customer'";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>
