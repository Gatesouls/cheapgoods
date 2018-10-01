<?php
//start a new session
session_start();
//connect to database
require_once ('../../dbconnect.php');



//check if admin is logged in
if (isset($_SESSION['admin'])) {
    echo "Welcome," . $_SESSION['admin'] . "<br>";
    //log out the admin
    $username = $_SESSION['admin'];
    $query = "SELECT * FROM admin WHERE username='".$username."'  ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        echo "Couldn't connect to database. Please try later";
        exit;
    } else {
        if (!$row = mysqli_fetch_assoc($result)) {
            echo "Error";
            exit;

        } else {
            unset($_SESSION['admin']);
            session_destroy();
            echo 'You have been logged out';
            header('location:../index.php');
            exit;
        }
    }

} else {
    echo "You are not logged in";
    header('location: ../index.php');
}