<?php
//connect to database
require_once '../../dbconnect.php';

//create short vars
$username = $_POST['username'];
$userpassword = $_POST['userpassword'];
$userpassword2 = $_POST['userpassword2'];
$useremail = $_POST['useremail'];

//start new session
session_start();

//add slashes if this function doesn't work
if (!get_magic_quotes_gpc()) {
    $username = addslashes($username);
    $userpassword = addslashes($userpassword);
    $userpassword2 = addslashes($userpassword2);
    $useremail = addslashes($useremail);
}
//check if user has filled all forms
if (!$username || !$userpassword || !$userpassword2 || !$useremail) {
    echo "You have not entered some information.<br>";
    echo '<a href="signup_form.php">Try again</a>';
    exit;
}

//check if login is already taken
$login_check_query ="SELECT * FROM user WHERE username = '$username'";
$login_check_result = mysqli_query($conn, $login_check_query);
if ($row = mysqli_fetch_assoc($login_check_result)) {
    echo "This login is already taken. Choose another one.<br>";
    echo '<a href="signup_form.php">Try again</a>';
    exit;
}


//check if user's password match
if ($userpassword != $userpassword2) {
    echo 'Passwords dont match.';
    echo '<a href="signup_form.php">Try again</a>';
    exit;
}

//check if login and password have from 6 to 16 characters
if ((strlen($username)> 16) || (strlen($username) < 6)) {
    echo "Login must contain from 6 to 16 characters";
    echo '<a href="signup_form.php">Try again</a>';
    exit;
}
if ((strlen($userpassword) < 6) || (strlen($userpassword) > 16)) {
    echo "Password must contain from 6 to 16 characters";
    echo '<a href="signup_form.php">Try again</a>';
    exit;
} else {
   // $userpassword = sha1($userpassword);
}

$query = "INSERT into user VALUES ('".$username."', '".$userpassword."', '".$useremail."') ";
$result = mysqli_query($conn, $query);

if ($result) {
    $_SESSION['valid_user'] = $username;
    echo "You have been successfully signed up<br> ";
    echo '<a href=auth_form.php>Log in</a>';
    header('location:member.php');
} else {
    echo "Error: couldn't connect to database. Please try later";
    exit;
}