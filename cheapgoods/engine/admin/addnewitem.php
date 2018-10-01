<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../../include/DBdriver.php');

//check if admin logged in
$obj = new DBdriver;
$obj->ifadminlogin();

//create short vars
$item_name = $_POST['item_name'];
$catid =  $_POST['catid'];
$item_description =  $_POST['item_description'];
$item_price =  $_POST['item_price'];

//validation (this is temp, change to mysqli::real_escape later
if (!get_magic_quotes_gpc()) {
    $item_name = addslashes($item_name);
    $item_description =  addslashes($item_description);
    $item_price =  addslashes($item_price);
}
//check if everything is filled
if (!$item_name || !$item_description || !$item_price || !$catid) {
    echo "You have not entered some information";
    exit;
}
//main script

//send query
$conn = $obj->db_connect();
$query = "INSERT INTO items VALUES ('0', '".$catid."', '".$item_name."', '".$item_description."', '".$item_price."')";
$result = $conn->query($query);
if (!$result) {
    echo 'Couldn\'t insert new item to Database ';
    exit;
} else {
    echo 'New item has been successfully added';

}

//get newly generated item_id from DB -- implement ib DBdriver.php class
$query2 = "SELECT item_id FROM categories WHERE item_name='".$item_name."' AND item_description='".$item_description."' ";
$result2 = $conn->query($query);
