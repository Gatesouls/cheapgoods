<?php
echo '
<!DOCTYPE HTML>
<html>
<head>
<title>Authorization</title>
<meta charset="UTF-8">
</head>
<body>
<h1>Sign in</h1>
<form action="auth.php" method="post">
<p>Enter your login:</p>
<input type="text" name="username" placeholder="login"> <br>
<p>Enter your password:</p>
<input type="password" name="userpassword" placeholder="password"> <br>
<input type="submit" value="Sign in"> <br>
<a href="signup_form.php">Do not have an account? Create one </a> <br>
<a href="forgot_form.php">Forgot password?</a> <br>
</form>
</body>
</html>


    ';