<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mitgliederliste</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
<?php
    session_start();
    
        
            include __DIR__.'/vendor/autoload.php';
            use RestCord\DiscordClient;
    
    if (isset($_SESSION['UID']) && $_SESSION['UID'] == 42)
    $logged = true;
    else
    $logged = false;
    ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a class="navbar-brand" href="#">Admin Pannel</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="memberlist.php">Memberliste</a> </li>
            <?php if($logged) echo '<li class="nav-item"> <a class="nav-link" href="logout.php">Logout</a> </li>' ?>
        </ul>
      </div>
    </nav>
  <h1 class="text-center">Mitgliederliste</h1>
<div class="container">
      <div class="row">
<?php
  
    include 'includes/config.php';
            
    if ($logged) {
    ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

        error_reporting(E_ALL);        
        
        
    // Create discord connection
    try {
    
    $discord = new DiscordClient(['token' => $token]);
    $discord->oauth2->getCurrentApplicationInformation(['user.id']); // Test
    $dconn = true;
    } catch (Exception $ex) {
        $dconn = false;
        echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Discord</strong> sendet: Kritischer Fehler  
            </div>
            ';
    }
    if (!$dconn) {
        $dconn = false;
        echo'
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Discord Connection failed: </strong> einige Funktionen sind Deaktiviert!
            </div>
            ';
    }
    // Create connection
    $conn = new mysqli($host, $user, $pass, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die('
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Connection failed: </strong> '. $conn->connect_error.'
            </div>
            ');
        exit();
    }
    
    include 'includes/adduser.php';
    include 'includes/edituser.php';
    include 'includes/deleteuser.php';
    include 'includes/updateuser.php';
    } else {
        
    include 'includes/login.php';
    #include 'logout.php'; // because of dw
    #include 'memberlist.php'; // because of dw
    }
    ?>
    
            
            </div>
    
    <hr>
      <div class="row">
          <?php 
          
    if ($logged) {
    include 'includes/addgroup.php';
    include 'includes/editgroup.php';
    include 'includes/deletegroup.php';
    }
          ?>
</div>
    <hr>
      <div class="row">
          <?php 
          
    if ($logged) {
    include 'includes/groups.php';
    }
          ?>
</div>
    <hr/>
      <div class="row">
          <?php 
          
    if ($logged) {
    include 'includes/users.php';
    }
          ?>
</div>
        <hr>
</div>
    <hr>
       <div class="row">
          <div class="text-center col-lg-6 offset-lg-3">
             <h4>Footer </h4>
             <p>Copyright &copy; 2021 &middot; All Rights Reserved &middot; <a href="#" >My Website</a></p>
          </div>
       </div>
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.4.1.js"></script>
<script src="js/replaceHistroy.js"></script>
</body>
</html>
<!-- The website show well! -->