<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Unbenanntes Dokument</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.tabledit.js"></script>
</head>
<body>
<!-- https://www.phpzag.com/create-live-editable-table-with-jquery-php-and-mysql/ -->
<div class="container" style="min-height:500px;">
  <div class=''>
    <table id="data_table" class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Gender</th>
          <th>Age</th>
          <th>Designation</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody>
        <?php
        #include "live_edit.php";
        $user = "0";
        $pass = "0";
        $host = "0";
        $dbname = "0";
        $conn = new mysqli( $host, $user, $pass, $dbname );

        $sql_query = "SELECT id, name, gender, address, designation, age FROM developers LIMIT 10";
        $resultset = mysqli_query( $conn, $sql_query )or die( "database error:" . mysqli_error( $conn ) );
        while ( $developer = mysqli_fetch_assoc( $resultset ) ) {
          ?>
        <tr id="<?php echo $developer ['id']; ?>">
          <td><?php echo $developer ['id']; ?></td>
          <td><?php echo $developer ['name']; ?></td>
          <td><?php echo $developer ['gender']; ?></td>
          <td><?php echo $developer ['age']; ?></td>
          <td><?php echo $developer ['designation']; ?></td>
          <td><?php echo $developer ['address']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<script src="custom_table_edit.js"></script>
</body>
</html>