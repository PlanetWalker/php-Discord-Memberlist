<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// When the user has a session. directs to the dashboard
if (isset($_SESSION['user'])) {
    header("Location: /");
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- icons -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo APPURL; ?>/includes/css/bootstrap-5.1.3/bootstrap.css">
    <!-- design -->
    <link rel="stylesheet" href="<?php echo APPURL; ?>/includes/css/login/login.css">
    <!-- scrips -->
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/jquery-3.6.0/jquery.js"></script>
    <!-- login ajax -->
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/login/login.js"></script>
</head>

<body id="header">

<div class="container">
    <div class="row">
        <div class="center nottobig">
            <div class="col-sm-12 col-md-10 col-md-offset-1">
                <center>
                    <h1 style="color: #1b1e21;  font-weight: bold">LOGIN</h1><br>
                    <h3 id="info" style="color: #1b1e21;"></h3><br>
                </center>
                <form id="login">
                    <div class="form-group input-group">
                        <i class="fas fa-user"></i>
                        <input class="form-control" type="text" name="username" placeholder="username" id="username"/>
                    </div>
                    <div class="form-group input-group">
                        <i class="fas fa-lock"></i>
                        <input class="form-control" type="password" name="password" id="password" placeholder="password"/>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="button" class="btn btn-sm btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
