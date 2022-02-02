<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mitgliederliste</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-4.4.1.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a class="navbar-brand" href="#">Mitgliederliste</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="control.php">Admin Pannel</a> </li>
        </ul>
      </div>
    </nav>
<div class="container">
    <div class="row">
      <div class="col-xl-4"></div>
      <div class="col-xl-4">
        <?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300); //300 seconds = 5 minutes. In case if your CURL is slow and is loading too much (Can be IPv6 problem)

error_reporting(E_ALL);
          include 'includes/config.php';
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
          $tabelle = array();
                $sql = "SELECT `MemberID` FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` ORDER BY `Groups`.`Weight` ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    array_push($tabelle, $row);
                }
                $check = mysqli_num_rows($result);

                if ($check > 0) {
                    foreach ($tabelle as $row) {
                        $UID = $row['MemberID'];
                        $sql = "SELECT * FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `MemberID`='$UID'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        // DATA

                        $parameters = $row['UserID'];
                        $url = $row['Avatar'];
                        $group = $row['Name'];
                        $color = $row['Color'];
                        $name = $row['Displayname'];
                        
                        echo '
                        <div class="row text-center">
                        <h1 class="center"><span style="color:'.$color.';">'.$group.'</span></h1><br>
                        <img src="https://cdn.discordapp.com/avatars/'.$parameters.'/'.$url.'?size=256" style="width: 256px; height: 256px;" class="rounded-circle img-fluid center" /><br>
                        </div>
                        <p class="center">'.$name.'</p><br>
                        ';
                    }
                }

?>
        </div>
      <div class="col-xl-4"></div>
    </div>
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
</body>
</html>