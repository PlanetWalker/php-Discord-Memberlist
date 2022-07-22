<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mitgliederliste</title>
<!-- styles -->
<link href="<?php echo APPURL; ?>/includes/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo APPURL; ?>/includes/css/bootstrap-5.1.3/bootstrap.css" rel="stylesheet" type="text/css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a class="navbar-brand" href="#">Mitgliederliste</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent1">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
            <li class="nav-item"> <a class="nav-link" href="/">Admin Pannel</a> </li>
        </ul>
      </div>
    </nav>
<div class="container">
    <div class="row">
      <div class="col-xl-4"></div>
      <div class="col-xl-4">
        <?php 

                // Create connection
                $db = app_db();
                $tabelle = array();
                $result = $db->query("SELECT `MemberID` FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `Deleted` = false  ORDER BY `Groups`.`Weight` ASC");
                while ($row = mysqli_fetch_array($result)) {
                    array_push($tabelle, $row);
                }
                $check = mysqli_num_rows($result);

                if ($check > 0) {
                    foreach ($tabelle as $row) {
                        $UID = $row['MemberID'];
                        $result = $db->query("SELECT * FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `MemberID`='$UID'");
                        $row = mysqli_fetch_assoc($result);
                        // DATA

                        $parameters = $row['DiscordID'];
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
    <!-- Scripts --> 
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/jquery-3.6.0/jquery.js"></script>
</body>
</html>