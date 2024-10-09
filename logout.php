<?php
// Start or resume the session
session_start();
// Unset all of the session variables
session_unset();
// Destroy the session
session_destroy();
// Redirect to the logged out version of the home page
header('Location: index.html');
// Exit the script
exit();
?>
