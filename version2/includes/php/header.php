<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminpannel</title>
        
    <!-- styles -->
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link href="<?php echo APPURL; ?>/includes/css/bootstrap-5.1.3/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo APPURL; ?>/includes/css/notification.css" rel="stylesheet" type="text/css">
    <link href="<?php echo APPURL; ?>/includes/css/core.css" rel="stylesheet" type="text/css">
    
    <!-- Scripts --> 
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/jquery-3.6.0/jquery.js"></script>
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/jquery-3.6.0/jquery.notifications-1.1.js"></script> 
    <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/notifications.js"></script>
</head>
<body>
    <header> 
      <!-- navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark"> <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent1">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"> <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> </li>
            <!-- content-->
            <li class="nav-item"> <a class="nav-link" href="/member/list">Memberlist</a> </li>
            <li class="nav-item"> <a class="nav-link" href="/logout">Logout</a> </li>
          </ul>
        </div>
      </nav>
</header>