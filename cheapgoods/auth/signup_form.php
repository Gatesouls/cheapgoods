<?php
echo '
<!DOCTYPE HTML>
<html>
<head>
    <title>Sign up</title>
    <meta charset="UTF-8">
</head>
<body>
<h1>Sign up</h1>
<form action="signup.php" method="post">
    <p>Enter your login:</p>
    <input type="text" name="username" placeholder="login"> <br>
    <p>Enter your password:</p>
    <input type="password" name="userpassword" placeholder="password"> <br>
    <p>Enter your password again:</p>
    <input type="password" name="userpassword2" placeholder="password"> <br>
    <p>Enter your e-mail:</p>
    <input type="email" name="useremail"> <br> <br>
    <input type="submit" value="Sign up">
</form>
</body>
</html>
    ';