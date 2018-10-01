<?php
//start a new session
session_start();
//require the main class
require_once ('../include/DBdriver.php');
//connect to html template
require_once ('template/page.php');

//main script

//create short vars
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address =  $_POST['address'];
$city =  $_POST['city'];
$state = $_POST['state'];
$shipping_index = $_POST['shipping_index'];
$country = $_POST['country'];

$driver = new DBdriver;
echo $header;
//check if form filled
if ($_SESSION['cart'] && $firstname && $lastname && $address && $city && $state && $shipping_index && $country) {
    //check if possible to insert into DB
    if ($driver->insert_order($firstname, $lastname, $address, $city, $state, $shipping_index, $country) != false) {
        $driver->display_cart($_SESSION['cart'], false, 0);
        echo 'Operation successful';
        $driver->display_button('home.php', 'continue-shopping', 'Continue shopping');
    } else {
        echo 'Unable to save your info. Please, try again later';
        $driver->display_button('checkout.php', 'back', 'Back');
    }

} else {
    echo 'You didn\'t fill all of the fields';
    $driver->display_button('checkout.php', 'back', 'Back');
}
echo $footer;
?>