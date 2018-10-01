<?php
//start a new session
session_start();

//check if admin is already logged in
if (isset($_SESSION['admin'])) {
    header('Location: ../engine/admin/adminpage.php');
    exit;
}

echo '
<!doctype html>
<html>
<head>
    <title>Admin - sign in</title>
<meta charset="UTF-8">
</head>
<body>
<h1>Sign in</h1>
<form action="admin_auth.php" method="post">
    <p>Enter your login</p> <br>
    <input type="text" name="username" placeholder="Login"> <br>
    <p>Enter your password</p> <br>
    <input type="password" name="userpassword" placeholder="Password"> <br>
    <input type="submit" value="Sign in">
</form>
</body>
</html>
';
?>