<?php
// Connect to the database using the db.php file, which starts the session and includes the database connection
include 'db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Initialize error message
    $error = '';

    // Server-side email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    }

    // Server-side username validation
    if (strlen($username) > 15) {
        $error = 'Username must be 15 characters or less';
    }

    // Server-side password validation
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-+=]).{8,}$/';
    if (!$error && !preg_match($passwordPattern, $password)) {
        $error = 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.';
    }
    
    // Check for existing username and display error message if found
    if (!$error) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error = 'Username is already taken';
        }
    }

    // Check for existing email and display error message if found
    if (!$error) {
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $error = 'Email is already registered';
        }
    }

    // Redirect to signup page with error message if validation fails
    if ($error) {
        $_SESSION['signup_error'] = $error;
        header('Location: signup.php');
        exit();
    }

    // Save user data in session and proceed to quiz if validation passes
    $_SESSION['signup_data'] = [
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];
    
    // Redirect to quiz page
    header('Location: signup_quiz.html');
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
    <title>CodeEscape - Sign Up</title>

    <!-- Linking Google Fonts that we have found for our website -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Linking external CSS stylesheet -->
    <link rel="stylesheet" href="styles.css">

    <!-- Linking external JavaScript file for the sign up -->
    <script src="signup.js" defer></script>

    <!-- Here we define local CSS for the elements that should be different in the signup page as compared to the global CSS -->
    <style>
        /* CSS for the body */
        body {
            background-image: url('https://images.squarespace-cdn.com/content/v1/56cc7dba37013b9fc4340d85/1587156146748-8C81A5PY1DTV2OA787RV/s-synthwave-and-retrowave-illustration-premium-wallpaper.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #fff;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* CSS for the header */
        header {
            background-color: ;
            /*color: #fff;*/
            padding: 20px 50px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        /* CSS for the navbar */
        .navbar .logo a {
            /*color: #fff;*/
            text-decoration: none;
            font-size: 24px;
            font-family: 'Press Start 2P', cursive;
        }

        /* CSS for the navbar links */
        .nav-links a {
            /*color: #fff;*/
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s ease;
        }

        /* CSS for the navbar links on hover */
        .nav-links a:hover {
            color: #61dafb;
        }

        /* CSS for the signup section */
        .signup form {
            display: flex;
            flex-direction: column;
            align-items: center;
            /*background-color: #282c34;*/
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            width: 100%;
        }

    </style>
</head>
<body>
    <!-- Header section of the page -->
    <header>
        <!-- Navigation bar with logo and links -->
        <nav class="navbar">
            <div class="logo">
                <!-- Logo linking to the homepage -->
                <a href="index.html">CodeEscape</a>
            </div>
            <!-- Navigation links for different sections of the website -->
            <!-- My Profile page is not available for users that are not logged in -->
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="games_page_logged_out.html">Games</a></li>
                <li><a href="about_us_logged_out.html">About</a></li>
                <li><a href="contact_us_logged_out.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Section for Sign Up -->
    <section class="signup">
        <!-- Image for the Sign Up section -->
        <img class="signup-image" src="https://i.gifer.com/EmUH.gif" alt="Signup Image">
        <!-- Heading for the Sign Up section -->
        <h2 class="glowing-text">Sign Up</h2>
        <!-- Paragraph for the Sign Up section -->
        <p>Start your Code Escape Adventure Today!</p>
        <!-- PHP code to display error message if sign up fails -->
        <?php
        if (isset($_SESSION['signup_error'])) {
            echo '<p style="color: red;">' . $_SESSION['signup_error'] . '</p>';
            unset($_SESSION['signup_error']);
        }
        ?>
        <!-- Actual form for the sign up, which will trigger signup.php upon submission-->
        <form id="signup-form" action="signup.php" method="POST">
            <!-- Input fields for the sign up form -->
            <input type="text" name="username" placeholder="Username" maxlength="15" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <!-- Button to submit the form -->
            <button type="submit">Sign Up</button>
        </form>
    </section>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2024 CodeEscape. All rights reserved.</p>
    </footer>
    
</body>
</html>