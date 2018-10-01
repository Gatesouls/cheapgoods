<?php
//connect to database
require_once '../../dbconnect.php';
//create short vars
$forgotcode = $_POST['forgotcode'];
$useremail = $_POST['useremail'];

//functions
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Password recovery</title>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (isset($forgotcode)) {
    //compare forgotcode given by user and the one in the database
    $forgotcode_check_query= "SELECT * FROM user WHERE forgotcode='$forgotcode'";
    $result = mysqli_query($conn, $forgotcode_check_query);
    if ($result) {
        
            //send new password via email
            echo "New password has been sent to your email";
            $newpassword = generateRandomString();
            $to = $useremail;
            $subject = 'New password is set';
            $message = "Your new password is $newpassword. You can use it to login now";
            $headers = 'From: cheapgoods.ru';
            mail($to, $subject, $message, $headers);
            //update database
            $email_update_query = "UPDATE user SET password='$newpassword' WHERE email='$useremail'";
            $result2 = mysqli_query($conn, $email_update_query);


            //create a new forgotcode
            $newforgotcode = generateRandomString();
            $newforgotcode_query = "UPDATE user SET forgotcode='$newforgotcode' WHERE email='$useremail'";
            $result3 = mysqli_query($conn, $newforgotcode_query);
            exit;
        }
    } else {echo "Couldn't connect to the database";}
}
?>
<h1>Password recovery</h1>
<form action="forgot_activate.php" method="post">
    <p>Enter your email here:</p>
    <input type="email" name="useremail" placeholder="email@example.com"><br>
    <p>Enter the code from the email here:</p> <br>
    <input type="text" name="forgotcode"><br> <br>
    <input type="submit" name="Restore password">

</form>
</body>
</html>
