<?php
// Connect to the database using the db.php file, which starts the session and includes the database connection
include 'db.php';

// Check if the form was submitted and the signup data is in the session
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['signup_data'])) {
    $username = $_SESSION['signup_data']['username'];
    $email = $_SESSION['signup_data']['email'];
    $password = $_SESSION['signup_data']['password'];

    // Calculate the quiz result
    $quiz_result = array_sum([$_POST['q1'], $_POST['q2'], $_POST['q3'], $_POST['q4'], $_POST['q5']]);

    // Determine profile image and name based on quiz result
    $profile_img = "default.jpg";
    $profile_name = "Unknown";
    if ($quiz_result <= 7) {
        $profile_img = "profile1.png";
        $profile_name = "Web Warrior";
    } elseif ($quiz_result <= 12) {
        $profile_img = "profile2.png";
        $profile_name = "Code Ninja";
    } else {
        $profile_img = "profile3.png";
        $profile_name = "Escape Artist";
    }

    // Set default proficiency
    $proficiency = "Beginner";

    // Insert user into the database
    $query = "INSERT INTO users (username, email, password, profile_img, proficiency, profile_name) VALUES ('$username', '$email', '$password', '$profile_img', '$proficiency', '$profile_name')";

    // Check if the query was successful
    if (mysqli_query($conn, $query)) {
        // Get the user ID
        $user_id = mysqli_insert_id($conn);

        // Set the user session including the user ID and proficiency
        $_SESSION['user_id'] = $user_id;
        $_SESSION['proficiency'] = 'Beginner';

        // Clear signup data from session
        unset($_SESSION['signup_data']);

        // Redirect to profile page
        header('Location: profile.php');
        exit();
    } else {
        // Display an error message if the query fails
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Redirect to the signup page if the form was not submitted
    header('Location: signup.php');
    exit();
}

// Close the database connection
mysqli_close($conn);
?>