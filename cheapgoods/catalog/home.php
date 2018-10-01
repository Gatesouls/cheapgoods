<?php
//start a new session
session_start();
//connect to DBdriver class
require_once ('../include/DBdriver.php');
//connect to html template
require_once ('template/page.php');
echo $header;
$object = new DBdriver;
//$object->display_cart_navbar();
$categories=$object->get_categories();
$object->display_categories($categories);
echo $footer;




?>