<?php
//start a new session
session_start();

//check if user already logged in
if (isset($_SESSION['valid_user'])) {
    header('location:member.php');
    exit;
}

echo '
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Signin - Cheapgoods</title>

    <!-- Bootstrap core CSS -->
    <link href="..//dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="..//dist/css/signin_custom.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="auth.php" method="post">
    <img class="mb-4" src="../../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Enter your login" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="userpassword" id="inputPassword" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
    
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <label>
        <a href="signup_form.php">Dont have an account? Create one</a>
        </label>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
';