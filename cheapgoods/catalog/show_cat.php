<?php
//start a new session
session_start();
//connect to DBdriver class
require_once ('../include/DBdriver.php');
//connect to html template
require_once ('template/page.php');



//create short vars
$catid = $_GET['catid'];
//main script
$obj = new DBdriver;
//$obj->display_cart_navbar();
echo $header;
$cat_array =$obj->get_items($catid);
$obj->display_items($cat_array);
$target = 'home.php';
$obj->display_button($target, 'continue-shopping', 'continue-shopping');
echo $footer;