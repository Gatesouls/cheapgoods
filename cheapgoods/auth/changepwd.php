<?php
//create a new session
session_start();
//HTML starting code down below
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Change password</title>
    <meta charset="UTF-8">
</head>
<body>

<?php
//create short vars
$oldpassword = $_POST['oldpassword'];
$newpassword = $_POST['newpassword'];
$newpassword2 = $_POST['newpassword2'];

//connect to database
require_once '../../dbconnect.php';

//check if logged in
if (!isset($_SESSION['valid_user'])) {
    header('location: auth_form.php');
} else {
    $currentuser = $_SESSION['valid_user'];
}
//Get login from database
$user_auth_query = "SELECT * FROM user WHERE username='$currentuser'";
$result = mysqli_query($conn, $user_auth_query);
if (!$result) {
    echo "Error: couldn't connect to database<br>";
    exit;
}
if (!$row = mysqli_fetch_assoc($result)) {
    echo "Error: couldn't find you in database";
    exit;
}
//welcome user
//echo "Hello, <strong> $currentuser</strong>. If you want to change your password, fill the form down below<br>";
//echo '<a href="member.php">Back to private menu</a><br>';

//check if at least one of typeboxes is filled (then it would mean that user really wants to change password)
if (isset($oldpassword) || isset($newpassword) || isset($newpassword2)) {
//check if user has filled all of the forms
    if (!$oldpassword || !$newpassword || !$newpassword2) {
        echo "You have not entered some of the information<br>";
        echo '<a href="changepwd.php">Retry</a>';
        exit;
    }
    //check if new passwords match
    if ($newpassword != $newpassword2) {
        echo "New Passwords don't match. <br>";
        echo '<a href="changepwd.php">Retry</a>';
        exit;
    }

    //check if old password is correct
    $oldpassword_encrypted = sha1($oldpassword);
    $oldpassword_check_query = "SELECT * FROM user WHERE username='$currentuser' AND password='$oldpassword_encrypted'";
    $oldpassword_check_result = mysqli_query($conn, $oldpassword_check_query);
    if (!$oldpassword_check_result) {
        echo "Error: couldn't connect to database. Please try later<br>";
        exit;
    }
    if (!$row2 = mysqli_fetch_assoc($oldpassword_check_result)) {
        echo "Your old password is incorrect<br>";
        echo '<a href="changepwd.php">Retry</a>';
        exit;
    } else {
        //update password in database
        $newpassword_encrypted = sha1($newpassword);
        $password_update_query = "UPDATE user SET password='$newpassword_encrypted' WHERE username='$currentuser'";
        $password_update_result = mysqli_query($conn, $password_update_query);
        if (!$password_update_result) {
            echo "Couldn't connect to database to update password";
            exit;
        } else {
            echo "Your password has been successfully changed!<br>";
            echo '<a href="member.php">Back to Private menu</a>';
            exit;
        }



    }

}
?>
<a href="member.php">Back to private menu</a>
<p>Welcome, <strong><?php echo $currentuser; ?></strong>. If you want to change your password, fill the form down below</p>
<form action="changepwd.php" method="post">
    <br>
    <p>Enter your previous password:</p>
    <input type="password" name="oldpassword" placeholder="Old password">
    <p>Enter your new password:</p>
    <input type="password" name="newpassword" placeholder="New password">
    <p>Enter your new password again:</p>
    <input type="password" name="newpassword2" placeholder="New password again"><br> <br>
    <input type="submit" value="Change password">
</form>


</body>
</html>
