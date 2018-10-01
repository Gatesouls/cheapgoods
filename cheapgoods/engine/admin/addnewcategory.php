<?php
//start a new session
session_start();
//connect to DBdriver class
require_once ('../../include/DBdriver.php');

//check if admin logged in
$obj = new DBdriver;
$obj->ifadminlogin();

//create short vars
$catname = $_POST['catname'];

//check if admin filled all of the form
if (!$catname) {
    echo "You have not entered the name of category";

} else {
    //insert values into DB
    $conn = $obj->db_connect();
    $query = "INSERT INTO categories VALUES ('0', '".$catname."')";
   $result =  $conn->query($query);


    if (!$result) {
        echo "Error: couldn't connect to database";
        exit;
    } else {
        echo "Category <strong>$catname</strong> has been susseccfully added<br>";
        echo '<a href="addnewcategory_form.php">Add another one <br>';
        echo '<a href="adminpage.php">Admin menu</a>';
    }
}

/**
 *
 * //connect to DB and insert new values
$query = "INSERT INTO categories VALUES ('0', '" . $catname . "')";
$result = mysqli_query($conn, $query);
 */
?>

