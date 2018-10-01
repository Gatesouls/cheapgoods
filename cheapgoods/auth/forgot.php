<?php
//create short vars
$useremail = $_POST['useremail'];

//connect to database
require_once '../../dbconnect.php';
//random string generation function
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//check if the user's email is in database
$email_check_query = "SELECT * FROM user WHERE email='$useremail'";
$email_check_result = mysqli_query($conn, $email_check_query);
if ($email_check_result) {

   if (!$row = mysqli_fetch_assoc($email_check_result)) {
       echo "This email was not found in our database";
   } else {
       //generate a new forgotcode in database
       $newforgotcode= generateRandomString();

       //Insert new forgotcode into database
       $forgotcode_query = "INSERT INTO user (forgotcode) VALUE '$newforgotcode' WHERE email='$useremail'";

       //send an email to user
       $to = $useremail;
       $subject = 'Password recovery';
       $message = "Hi. Looks like, someone wants to change password to your account.
        If it was not you, just ignore this message. 
        Otherwise, paste the following code into form using this link. Code: $newforgotcode. 
        Link: http://xn--80aaf4abyr4c.xn--p1ai/training/cheapgoods/auth/forgot_activate.php";
       $headers = 'From: cheapgoods.ru';
        mail($to, $subject, $message, $headers);
        echo "We have sent instructions on how to recover your password. Check your email"''
   }
} else {
    echo "Server is not accessible at the moment. Please try later";
}