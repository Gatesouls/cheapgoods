<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../../include/DBdriver.php');

//check if admin logged
$obj = new DBdriver;
$obj->ifadminlogin();

//echo html form
echo '

<!doctype html>
<html>
<head>
    <title>Add new category - Admin menu</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="addnewcategory.php" method="post">
    <h1>Add new category</h1>
    <p>Enter name of new category:</p> <br>
    <input type="text" name="catname" placeholder="Category name">
    <input type="submit" value="Add">

</form>
</body>
</html>
    ';
?>