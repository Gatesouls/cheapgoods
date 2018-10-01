<?php
//start a new session
session_start();

//connect to DBdriver class
require_once ('../include/DBdriver.php');

//connect to html template
require_once ('template/page.php');




//main script
$object = new DBdriver;
@$new = $_GET['new'];
if ($new) {
    // an new element has been chosen
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
        $_SESSION['items'] = 0;
        $_SESSION['total_price'] =0.00;
    }

    if (isset($_SESSION['cart'][$new])) {
        $_SESSION['cart'][$new]++;
    } else {
        $_SESSION['cart'][$new] = 1;
    }

    $_SESSION['items'] = $object->calculate_items($_SESSION['cart']);
    $_SESSION['total_price'] = $object->calculate_price($_SESSION['cart']);

}

if (isset($_POST['save'])) {
    foreach ($_SESSION['cart'] as $item_id => $qty) {
        if ($_POST[$item_id] == '0') {
            unset($_SESSION['cart'][$item_id]);
        } else {
            $_SESSION['cart'][$item_id] = $_POST[$item_id];
        }
    }

    $_SESSION['total_price'] = $object->calculate_price($_SESSION['cart']);
    $_SESSION['items'] = $object->calculate_items($_SESSION['cart']);
}elseif (isset($_POST['empty']))  {
    unset($_SESSION['cart']);
    unset($_SESSION['total_price']);
    unset($_SESSION['items']);
}


//$object->display_cart_navbar();
echo $header;

if (($_SESSION['cart']) && (array_count_values($_SESSION['cart']))) {
    $object->display_cart($_SESSION['cart']);
} else {
    echo "<p>Your shopping cart is empty</p><hr />";
}

$target = "home.php";

if ($new) {
    $details = $object->get_item_details($new);
    if ($details['catid']) {
        $target = "show_cat.php?catid=".($details['catid']);
    }
}
$object->display_button($target, "continue-shopping", "Continue-shopping");



$object->display_button("checkout.php", "go-to-checkout", "Go to Checkout");

echo $footer;

