<?php
header('Location:catalog/home.php');
/**
//start a new session
session_start();
//connect to DBdriver class
require_once ('include/DBdriver.php');
//connect to html template
require_once ('include/mainpage.inc.php');
$object = new DBdriver;
echo $header;
$object->display_cart_navbar();
$categories=$object->get_categories();
$object->display_categories($categories);
echo $footer;




?>
**/