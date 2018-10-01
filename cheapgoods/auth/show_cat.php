<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../include/DBdriver.php');
$obj = new DBdriver;

//create short vars
$catid = $_GET['catid'];
$name = $obj->get_category_name($catid);

//get info about items from DB
$item_array = $obj->get_items($catid);
$obj->display_items($item_array);
