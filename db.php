<?php
// Start the session if it has not started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Create a connection to the database or die and display an error if the connection is not successful
$conn = mysqli_connect(
    'localhost', // name of the server
    'id22319355_admin', // username
    '(Pleasekeepthissafe24)', // password
    'id22319355_code_escape' // name of the database
) or die(mysqli_error($conn));
?>