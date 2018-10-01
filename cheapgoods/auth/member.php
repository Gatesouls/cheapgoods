<?php
//this file is temporary

//start new session
session_start();

//check if logged in
if (isset($_SESSION['valid_user'])) {
    echo "Welcome to the private menu, <strong>" . $_SESSION['valid_user'] . "</strong> <br>";
    echo '<a href="changepwd.php">Change password</a><br>';
    echo '<a href="logout.php">Log out</a><br>';

} elseif (isset($_SESSION['admin'])) {
    echo "Welcome, admin";

} else  {
    echo "You cannot view this page. Please log in<br>";
    echo '<a href="auth_form.php">Log in</a>';
    exit;
}
