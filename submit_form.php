<?php
// Include the database connection file that also starts the session
include 'db.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Sanitize and escape the input data to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    // Create the SQL query to insert the contact data into the database
    $query = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    
    // Execute the query and check if it was successful
    if (mysqli_query($conn, $query)) {
        // Return a JSON response indicating success
        echo json_encode(["status" => "success", "message" => "Your message has been sent successfully."]);
    } else {
        // Return a JSON response indicating an error, including the error message
        echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
