
<?php
//start a new session
session_start();


//connect to DBdriver class
require_once ('../include/DBdriver.php');
//connect to html template
require_once ('template/page.php');
$obj = new DBdriver;

//create short vars
$item_id = $_GET['id'];

//main script
//$obj->display_cart_navbar();
echo $header;
$item = $obj->get_item_details($item_id);

$obj->item_description($item);

//set url for button "continue"
if (isset($item['catid'])) {
    $target='show_cat.php?catid='. ($item['catid']);
} else {$target = 'tomainpage';}
$obj->display_button('../catalog/show_cart.php?new='.$item_id, 'add-to-cart', 'Add to cart');
$obj->display_button($target, 'continue-shopping', 'continue-shopping');
echo $footer;