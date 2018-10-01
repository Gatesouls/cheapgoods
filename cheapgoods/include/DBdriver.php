<?php
class DBdriver {

    //methods

    //connect to Database
    //it's not good to store info about DB connection here. Will be removed in future updates.
    function db_connect()
    {
        $result = new mysqli('$dbhost', '$dbusername', '$dbpassword', '$dbname');
        if (!$result)
            return false;

        return $result;
    }

    //check if admin logged in
    function ifadminlogin () {
        if (isset($_SESSION['admin'])) {
        return;
        } else {
            header('location:../../index.php');
            exit;
        }
    }

    //makes an OK array from DB results
    function db_result_to_array($result)
    {
        $res_array = array();

        for ($count = 0; $row = $result->fetch_assoc(); $count++)
            $res_array[$count] = $row;

        return $res_array;
    }
    //displays links to categories
    function display_categories($cat_array)
    {
        if (!is_array($cat_array)) {
            echo "No categories for now<br />";
            return;
        }
        echo "<ul>";
        foreach ($cat_array as $row) {
            $url = "show_cat.php?catid=" . ($row['catid']);
            $title = $row['catname'];
            echo "<li>";
            $this->do_html_url($url, $title);
            echo "</li>";
        }
        echo "</ul>";
        echo "<hr />";
    }

    function do_html_url($url, $name)
    {

        ?>
        <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br/>
        <?php
    }
    //gets categories from DB
    function get_categories()
    {

        $conn = $this->db_connect();
        $query = 'select catid, catname from categories';
        $result = @$conn->query($query);
        if (!$result) {
            return false;
        }
        $num_cats = $result->num_rows;
        if ($num_cats == 0) {
            return false;
        }
        $result = $this->db_result_to_array($result);
        return $result;
    }

    //get category name by category ID from DB
    function get_category_name ($catid)
    {
        $catid = intval($catid);
        $conn = $this->db_connect();
        $query = "SELECT catname FROM categories WHERE catid = '".$catid."'";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        $num_cats = $result->num_rows;
        if ($num_cats == 0) {
            return false;
        }
        $row = $result->fetch_object();
        return $row->catname;
    }
    //get items from DB
    function get_items($catid)
    {
        $conn = $this->db_connect();
        $query = "SELECT * FROM items WHERE catid= '".$catid."'";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }
        $num_cats = $result->num_rows;
        if ($num_cats == 0) {
            return false;
        }
        $result = $this->db_result_to_array($result);
        return $result;
    }

    function get_item_details($item_id)
    {
        $conn = $this->db_connect();
        $query = "SELECT * FROM items WHERE item_id=".$item_id;
        $result = @$conn->query($query);
        if (!$result) {
            return false;
        }

        $num_items = $result->num_rows;
        if ($num_items == 0) {
            return false;
        }
        //old: $result = $this->db_result_to_array($result);
        $result= $result->fetch_assoc();
        return $result;

    }

    function get_item_details2($item_id)
    { //copied from book
        if (!$item_id || $item_id='') {
            return false;
        }
        $conn = $this->db_connect();
        $query = "SELECT * FROM items WHERE item_id=".$item_id;
        $result = @$conn->query($query);
        if (!$result) {
            return false;
        }

        $result = @$result->fetch_assoc();
        return $result;

    }



    function display_items($items_array)
    {
        if (!is_array($items_array)) {
            echo 'No available items in Database right now. Please try later';
        } else {
            echo '<table width=\"100%\" border=0>';
            foreach ($items_array as $row) {
            $url = 'show_item.php?id=' . ($row['item_id']);
            echo '<tr><td>';
            if (@file_exists('../images/'. ($row['item_id']). '.png' )) {
               //old version -> $title = '<img src=\'images/'.($row['item_id']).'.png\' border=0 height=160 width=100/>';
                $title =  '<img src="../images/' . ($row['item_id']). '.png" border=0 height=160 width=140/>';
                $this->do_html_url($url, $title);

            } else {
                echo 'no picture found';
            }
            echo "</td><td>";
            $title = ($row['item_name']);
            $this->do_html_url($url, $title);
                echo '$' . ($row['item_price']);
                echo "</td></tr>";
            }
            echo '</table>';
        }
            echo '</hr>';
    }
    function item_description ($item)
    {
        if (!is_array($item)) {
            echo 'Not an array';

        } else {

            echo '<table width="100%" border="0"><tr>';

                if (@file_exists('../images/'.($item['item_id']).'.png')) {
                    //old version -> $title = '<img src=\'images/'.($row['item_id']).'.png\' border=0 height=160 width=100/>';
                    echo '<td><img src="../images/' . ($item['item_id']) . '.png" border=0 height=160 width=140/></td>';
                }
                echo '<td><ul>';
                echo '<li><b>Name:</b>' . ($item['item_name']). '</li>';
                echo '<li><b>Description</b>:'.($item['item_description']) . '</li>';
                echo '<li><b>Price</b>: $' . ($item['item_price']). '</li>';
                echo '</ul></td>';

            echo '</tr></table>';
            }



        }


    function item_description2($item) {
        // Copied from book
        if (is_array($item)) {
            echo "<table><tr>";
            // ������� ����������� �������, ���� ��� �������
            if (@file_exists('../images/'.($item['item_id']).'.png')) {
                $size = GetImageSize('../images/'.$item['item_id'].'.png');
                if($size[0] > 0 && $size[1] > 0)
                    echo '<td><img src=\'../images/'.$item['item_id'].'.png\' border=0 '.$size[3].'></td>';
            }
            echo "<td><ul>";
            echo "<li><b>Name:&nbsp;</b>";
            echo $item['item_name'];
            echo "</li>";
            echo "<li><b>Price:&nbsp;</b>";
            echo number_format($item['item_price'], 2);
            echo "</li><li><b>Description:&nbsp;</b>";
            echo $item['item_description'];
            echo "</li></ul></td></tr></table>";
        } else
            echo "Not an array.";
        echo "<hr />";
    }




    function display_button($target, $image, $alt)
    {
        echo '
        <div style="text-align:center">
    <a href="'.$target.'"><img src="../images/html/' . $image . '.gif" alt="' . $alt . '" border=0 height=50 width=135></a>
        </div>
        ';
    }
    function display_cart_navbar ()
    {
        if (!$_SESSION['items']) {
            $_SESSION['items'] = 0;
        }
        if (!$_SESSION['total_price']) {
            $_SESSION['total_price'] = 0.00;
        }

echo '<table width="100%" border=0 cellspacing=0 bgcolor="#cccccc">
    <tr>
      <td rowspan=2>
      <a href="home.php">
        <img src="" alt="My web-site"
          border=0 align="left" valign="bottom" height=55 width=325>
          </a>
      </td>
      <td align="right" valign="bottom">
        <p>Total items:'.$_SESSION['items'].' </p> </td>
        
<td align="right" rowspan=2 width=135 >
   '.'<a href="show_cart.php"><img src="../images/html/view-cart.gif" alt="View Cart"> </a>'.'
    
</td>
</tr>
<tr>
    <td align="right" valign="top">
         <p>Total price:'.number_format($_SESSION['total_price'],2).'</p>
        
    </td>
</tr>
</table>


';
    }

    function calculate_price($cart) {

        $price = 0.00;
        if (is_array($cart)) {
            $conn = $this->db_connect();
            foreach ($cart as $item_id => $qty) {
                $query = "SELECT item_price FROM items WHERE item_id=".$item_id;
                $result = $conn->query($query);
                if ($result) {
                    $item = $result->fetch_object();
                    $item_price = $item->item_price;
                    $price += $item_price*$qty;
                }
            }

        }
        return $price;
    }

    function calculate_items($cart) {

        $items = 0;
        if (is_array($cart)) {
            foreach($cart as $item_id => $qty) {
                $items += $qty;
            }
        }
        return $items;
    }

    function display_cart($cart, $change=true, $images=1)
    {
        //displays elements  in shopping cart. Allows change of quantities if $change=true
        echo '
        <table border="0" width="75%" cellspacing="0" align="center">
        <form action="show_cart.php" method="post">
        <tr>
        <th colspan=" '.(1+$images).' " bgcolor="white">Product</th>
        <th bgcolor="white">Price</th>
        <th bgcolor="white">Quantity</th>
        <th bgcolor="white">Total</th>
        </tr>';
        //display each element as rows of table
        foreach ($cart as $item_id => $qty) {
            $item = $this->get_item_details($item_id);
            echo '<tr>';
            if ($images == true) {
                echo '<td align="left">';
                if (file_exists('../images/' . $item_id . '.png')) {
                    $size = GetImageSize('../images/' . $item_id . '.png');
                    if ($size[0] > 0 && $size[1] > 0) {
                        echo '<img src="../images/' . $item_id . '.png" style="border: 1px solid black" width="' . ($size[0] / 3) . '" height="' . ($size[1] / 3) . '"/>';
                    } else {
                        echo '&nbsp;';
                    }
                    echo '</td>';
                }
            }

                echo '<td align="left">'.
                    '<a href="../catalog/show_item.php?id='. $item_id.'">'.($item['item_name']).'</a></td>'.
                    '<td align="center">$'. number_format(($item['item_price']), 2). '</td>'.
                    '<td align="center">';
                //if $change=true, display quantities in text input fields
                if ($change == true) {
                    echo '<input type="number" name="'. $item_id. '" value="' .$qty. '"size="3">';
                } else {
                    echo $qty;
                }
                echo '</td>' .
                    '<td align="center">$' . number_format($item['item_price']*$qty,2) . '</td>'.
                    "</tr>\n";




        }
        //echo total qty and total price row
        echo '<tr>'.
            '<th colspan="' . (2+$images). '" bgcolor="gray">&nbsp;</th>'.
            '<th align="center" bgcolor="gray">' .$_SESSION['items'] . '</th>'.
            '<th align="center" bgcolor="gray">$'.
            number_format($_SESSION['total_price'],2). '</th>' . '</tr>';
        //show buttons
        if ($change == true) {
            //show button "Save"
            echo '<tr>' .
                '<td colspan="' . (2 + $images) . '">&nbsp;</td>' .
                '<td align="center">' .
                '<input type="hidden" name="save" value="true">' .
                '<input type="image" src="../images/html/save-changes.gif" border="0" alt="Save Changes">' .
                '</td>' .
                '<td>&nbsp;</td>' . '</tr>';


            echo '</form></table>';

            //show button "Empty shopping cart
            echo '<table width="75%" border="0" cellspacing="0" align="center">
            <form action="show_cart.php" method="post">';
            echo '<tr>' .
                '<td colspan="' . (2 + $images) . '">&nbsp;</td>' .
                '<td align="center">' .
                '<input type="hidden" name="empty" value="true">' .
                '<input type="image" src="../images/html/empty.gif" border="0" alt="Empty shopping cart">' .
                '</td>' .
                '<td>&nbsp;</td>' . '</tr>';
            echo '</form></table>';
        } else {
            echo '</form></table>';
        }
    }


    //checkout form display function
    function display_checkout_form() {

        echo '
        <br />
        <div>
        <table border=0 width="75%" cellspacing = 0 style="margin-left: 125px">
            <form action="purchase.php" method="post">
                <tr>
                    <th colspan=2 bgcolor="#cccccc">Some information about you</th>
                </tr>
                <tr>
                    <td>Firstname</td>
                    <td><input type="text" name="firstname" value="" maxlength=40 size=40></td>
                </tr>
                <tr>
                    <td>Lastname</td>
                    <td><input type="text" name="lastname" value="" maxlength=40 size=40></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="address" value="" maxlength=80 size=40></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input type="text" name="city" value="" maxlength=40 size=40></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><input type="text" name="state" value="" maxlength=40 size=40></td>
                </tr>
                <tr>
                    <td>Shipping index</td>
                    <td><input type="text" name="shipping_index" value="" maxlength=10 size=40></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><input type="text" name="country" value="" maxlength=40 size=40></td>
                </tr>
  
                <tr>
                    <td colspan=2 align="center">
                        <b>Click "Purchase" button to confirm the purchase or "Continue shopping" to add new items.</b>
                        <div style="text-align:center">
                        <input type="image" src="../images/html/purchase.gif" border=0 height=50 width=135>
                        </div>
                           
                    </td>
                </tr>
            </form>
        </table>
        </div>
        <hr />
       ';
    }
    function insert_order ($firstname, $lastname, $address, $city, $state, $shipping_index, $country)
    {
        $partial = 'PARTIAL';
        $conn = $this->db_connect();

        //turn autocommit off
        $conn->autocommit(FALSE);
        //insert customers' shipping address
        $query = "SELECT customerid FROM customers WHERE firstname='".$firstname."' AND lastname='".$lastname."' AND address='".$address."' AND city='".$city."' AND state='".$state."' AND shipping_index='".$shipping_index."' AND country='".$country."'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $customer = $result->fetch_object();
            $customerid = $customer->customerid;
        } else {
            $query = "INSERT INTO customers VALUES ('', '".$firstname."', '".$lastname."', '', '', '', '".$address."', '".$city."', '".$state."', '".$shipping_index."', '".$country."')";
            $result= $conn->query($query);
            if (!$result) {
                return false;
            }
        }
        $customerid= $conn->insert_id;
        $date = date('Y-m-d');


        $query="INSERT INTO orders VALUES ('', '".$customerid."', '".$_SESSION['total_price']."', '".$date."', '".$partial."', '".$firstname."', '".$lastname."', '".$address."', '".$city."', '".$state."', '".$shipping_index."', '".$country."')";
        $result = $conn->query($query);
        if (!$result) {
            return false;
        }

        $query = "SELECT orderid FROM orders WHERE customerid='".$customerid."' AND order_date='".$date."' AND order_status='".$partial."' AND ship_name='".$firstname."' AND ship_lastname='".$lastname."' AND ship_address='".$address."'AND ship_city='".$city."' AND ship_state='".$state."' AND shipping_index='".$shipping_index."' AND ship_country='".$country."'";
        $result=$conn->query($query);
        if ($result->num_rows > 0) {
            $order = $result->fetch_object();
            $orderid = $order->orderid;
        } else {
            return false;
        }

        //insert each item from the ordered
        foreach($_SESSION['cart'] as $item_id => $quantity) {
            $detail = $this->get_item_details($item_id);
            $query = "DELETE FROM order_items WHERE orderid='".$orderid."' AND item_id='".$item_id."'";
            $result = $conn->query($query);
            $query = "INSERT INTO order_items VALUES ('".$orderid."', '".$item_id."', '".$detail['item_price']."', '".$quantity."')";
            $result = $conn->query($query);
            if (!$result) {
                return false;
            }
        }
        //end of transaction
        $conn->commit();
        $conn->autocommit(TRUE);
        return $orderid;
    }


} //end of class DBdriver

?>
