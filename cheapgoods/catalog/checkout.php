<?php
//start a new session
session_start();
//require the main class
require_once ('../include/DBdriver.php');
//connect to html template
require_once ('template/page.php');
//main script
$driver = new DBdriver;
//$driver->display_cart_navbar();
echo $header;

if ($_SESSION['cart'] && array_count_values($_SESSION['cart'])) {
    $driver->display_cart($_SESSION['cart'], false, 0);
    $driver->display_checkout_form();
} else {
    echo 'Your cart is empty';
    exit;
}
$driver->display_button('show_cart.php', 'continue-shopping', 'continue-shopping');
echo $footer;
?>