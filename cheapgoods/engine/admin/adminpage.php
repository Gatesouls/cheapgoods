<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../../include/DBdriver.php');

//check if admin logged in
$obj = new DBdriver;
$obj->ifadminlogin();


//echo links
echo '<a href="addnewcategory_form.php">Add new category to database</a><br>';
echo '<a href="addnewitem_form.php">Add new item to database</a><br>';
echo '<a href="../../auth/admin_logout.php">Log out</a>';
?>