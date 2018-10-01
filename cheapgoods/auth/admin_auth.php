<?php
//start session
session_start();

//check if admin is already logged in
if (isset($_SESSION['admin'])) {
    header('Location: ../engine/admin/adminpage.php');
    exit;
}

//connect to database
require_once ('../../dbconnect.php');

//create short vars
$username = $_POST['username'];
$userpassword = $_POST['userpassword'];


//input data validation
if (!get_magic_quotes_gpc()) {
    $username = addslashes($username);
    $userpassword = addslashes($userpassword);
}

//check if user has filled all forms
if (empty($username) || empty($userpassword)) {
    echo "You have not entered login or password";
    exit;
} else {
    $userpassword = sha1($userpassword);

}

//send query and try to log in the user
$query = "SELECT * FROM admin WHERE username='".$username."' AND password='".$userpassword."'";
$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Couldn't connect to database. Please try later";
    exit;
}

if (!$row = mysqli_fetch_assoc($result)) {
    echo "Login or password is incorrect";
    exit;
} else {
    echo "You have been successfully logged in<br>";
    $_SESSION['admin'] = $username;
    header('location:../engine/admin/adminpage.php');
}

