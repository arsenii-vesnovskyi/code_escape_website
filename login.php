<?php
// Include the database connection file
include 'db.php';

// Check if the form is submitted via POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the email and password from the POST request, escaping special characters to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to fetch user data from the database based on the provided email
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query returned any result
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the user data as an array
        $user = mysqli_fetch_assoc($result);

        // Verify the password by comparing it with the stored password
        if ($password === $user['password']) {
            // Set session variables with user ID and proficiency level
            $_SESSION['user_id'] = $user['iduser'];
            $_SESSION['proficiency'] = $user['proficiency'];

            // Redirect to the profile page
            header('Location: profile.php');
            exit();
        } else {
            // Display an error message for invalid email or password
            echo "Invalid email or password.";
        }
    } else {
        // Display an error message for invalid email or password
        echo "Invalid email or password.";
    }
}

// Closing the database connection
mysqli_close($conn);
?>