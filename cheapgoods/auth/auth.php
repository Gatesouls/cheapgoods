<?php
//start a new session
session_start();
//connect to database
require_once '../../dbconnect.php';

//create short vars
$username = $_POST['username'];
$userpassword = $_POST['userpassword'];

//check if user has entered login AND password
if (!$username || !$userpassword ) {
        echo "You have not entered login or password <br>";
        echo '<a href="auth_form.php">Try again</a>';
        exit;
}

//check if magic quotes dont work
if (!get_magic_quotes_gpc()) {
    $username = addslashes($username);
    $userpassword = addslashes($userpassword);
}

$userpassword = sha1($userpassword);
//SQL query that checks if there is a pair of login and password provided by user
$query = "SELECT * FROM user WHERE username='$username' AND password='$userpassword'";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: couldn't connect to the database. Please try later.";
    exit;
}
if (!$row = mysqli_fetch_assoc($result)) {
    echo "Your login or password is incorrect<br>";
    echo '<a href="auth_form.php">Try again</a>';
    exit;
} else {
    echo "you have been successfully logged in as $username<br>";
    echo '<a href="member.php">Private menu</a><br>';
    echo '<a href="changepwd.php">Change password</a><br>';
    echo '<a href="logout.php">Log out</a>';
    $_SESSION['valid_user'] = $username;
    header('location:member.php');
}
