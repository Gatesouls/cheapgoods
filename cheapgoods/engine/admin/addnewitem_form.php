<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../../include/DBdriver.php');

//check if admin logged in
$obj = new DBdriver;
$obj->ifadminlogin();
$cat_array = $obj->get_categories();


echo '

<!doctype html>
<html>
<head>
    <title>Add new item - Admin menu</title>
    <meta charset="UTF-8">
</head>
<body>
<form action="addnewitem.php" method="post">
    <h1>Add new item</h1>
    <p>Enter name of item:</p> <br>
    <input type="text" name="item_name" placeholder="Item name"><br>
    <p>Select category of item:</p>
    <div style="margin-bottom: 25px;">
    <select name="catid">';
	   foreach ($cat_array as $row) {
	       echo '<option value="' . ($row['catid']) . '">' . ($row['catname']). '</option>';
}

echo '
    </select>
    </div> 
    <p>Enter description of item</p>
    <input type="text" name="item_description" placeholder="Description"> <br>
    <p>Enter price of item:</p> <br>
    <input type="number" name="item_price" placeholder="0.00"> <br>
    <input type="submit" value="Add">

</form>
</body>
</html>
    ';
/**
 * Old html form
 *  <select>
<option value="25">Hats</option>
<option value="39">Shoes</option>
</select>
 */
?>