<?php
// Connect to the database and start the session
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not logged in
    header('Location: login.php');
    exit();
}

// Get the user ID from the session initialized in login.php or signup.php
$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT username, profile_img, proficiency, profile_name FROM users WHERE iduser = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Fetch the user data as an array
    $user = mysqli_fetch_assoc($result);
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for character encoding and viewport settings -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title of the page -->
    <title>CodeEscape - Profile</title>

    <!-- Linking Google Fonts that we have found for our website -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Linking external CSS stylesheet -->
    <link rel="stylesheet" href="styles.css">

    <!-- Defining local CSS to style the elements which are different from the external stylesheet, but have the same names -->
    <style>
        /* Styling the body section */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-image: url('https://i.gifer.com/xK.gif');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <!-- Navigation bar with logo and links -->
        <nav class="navbar">
            <div class="logo">
                <!-- Website Logo linking to the logged in version of the homepage -->
                <a href="index_logged_in.html">CodeEscape</a>
            </div>
            <!-- Navigation links for different sections of the website -->
            <ul class="nav-links">
                <li><a href="index_logged_in.html">Home</a></li>
                <li><a href="games_page_logged_in.php">Games</a></li>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="about_us_logged_in.html">About</a></li>
                <li><a href="contact_us_logged_in.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Profile Section -->
    <section class="profile">
        <!-- Heading for the Profile Section -->
        <h2>My Profile</h2>
        <!-- Profile Content -->
        <div class="profile-content">
            <!-- Displaying the user profile image, username, archetype, and experience from the database -->
            <img src="assets/profiles/<?php echo $user['profile_img']; ?>" alt="Profile Image">
            <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
            <p><strong>Archetype:</strong> <?php echo $user['profile_name']; ?></p>
            <p><strong>Experience:</strong> <?php echo $user['proficiency']; ?></p>
            <!-- Logout Button -->
            <form action="logout.php" method="post">
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 CodeEscape. All rights reserved.</p>
    </footer>
</body>
</html>
