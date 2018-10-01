<?php
//start new session
session_start();

//connect to database
require_once '../../dbconnect.php';

//welcome user
if (isset($_SESSION['valid_user'])) {
    echo "Welcome to the log out page,<strong>" . $_SESSION['valid_user']."</strong><br>";
} else {
    header('location: auth.php');

}

//check if user logged in
$currentuser = $_SESSION['valid_user'];
$user_check_query =  "SELECT * FROM user WHERE username = '$currentuser'";
$result = mysqli_query($conn, $user_check_query);
if ($result) {
    echo "Database is available. Processing log out sequence <br>";
} else {
    echo "Error. There are problems with server. Please try to log out later";
}

//check if everything is ok and log user out
if (!$row = mysqli_fetch_assoc($result)) {
    echo "Can't log out. Couldn't find you in the database.";
} else {
    unset($_SESSION['valid_user']);
    session_destroy();
    echo "You have been successfully logged out<br>";
    echo '<a href="auth_form.php">Login page</a>';
    exit;
}