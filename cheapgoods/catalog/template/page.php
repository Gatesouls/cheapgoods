<?php
if (!$_SESSION['items']) {
    $_SESSION['items'] = 0;
}
if (!$_SESSION['total_price']) {
    $_SESSION['total_price'] = 0.00;
}

$header = '
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
     <link href="../dist/css/starter-template.css" rel="stylesheet">
    <style>
        #starterid {
           width: 1000px;
            margin-top: 70px;
            margin-right: auto;
            margin-left: auto;
            
        }
        .makered {
        color: white;
        }
        .marginup {
        color: white;
        margin-top: -15px;
        margin-right: -15px;
        }
        #greenbutton {
        
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php">Cheapgoods</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
          
            
        </ul>
        <div style="height:50px">
        <table  border=0 cellspacing=0 >
    <tr>
      
      <td align="right" valign="bottom">
        <p class="makered">Total items:'.$_SESSION['items'].' </p> </td>
        
<td align="right" rowspan=2 width=135 >
<a href="show_cart.php"><button class="btn btn-outline-success my-2 my-sm-0" type="button" id="greenbutton">View Cart</button></a>
   '.'
    
</td>
</tr>
<tr>
    <td align="right" valign="top">
         <p class="marginup">Total price:'.number_format($_SESSION['total_price'],2).'</p>
        
    </td>
</tr>
</table>
        </div>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template" id="starterid">
    ';
$footer = '
    </div>

</main><!-- /.container -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write(\'<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>\')</script>
<script src="../dist/js/popper.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>
';
?>