<!DOCTYPE html>
<html>
<link href='http://fonts.googleapis.com/css?family=Roboto:700italic,700,400' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/bootstrap-theme.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/angular.min.js"></script>
<head lang="en">
    <META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>NEiT CRM - Login</title>
</head>

<body bgcolor="#f2f2f2">

    <div class="panel panel-info centrato">  <div class="panel-heading crecolor"><img src="images/NEiT.CRM.png" class="crecolor"></div>

        <div class="panel-body logins" align="center">
            <?php
                require('php/login.php');
            ?>
            <form method="POST" onsubmit="index.php">
                <input type="text" name="utente" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <input type="submit" name="submit" class="btnlogin" value="Login">
            </form>
        </div>
    </div>

</body>
</html>