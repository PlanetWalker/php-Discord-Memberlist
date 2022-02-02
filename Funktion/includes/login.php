
<div class="col-xl-4"></div>
        <div class="col-xl-4">
<?php
     if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }       
    if (isset($_POST['login'])) {
        if(isset($_POST['password']) && $_POST['password'] == $password) {
          $_SESSION['UID'] = 42;
            
            echo '
            <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Willkommen!</strong> Du hast dich Erfolgreich eingeloggt 
            </div>
            <div class="spinner-border" role="status"> <span class="sr-only">Loading...</span> </div>
      
            ';  
            
           header("Refresh:5");
           exit();
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Oh no!</strong> Überprüfe deine Eingaben!
            </div>
            ';  
        }
    }
    
    ?>

            <form href="#" method="POST">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Passwort*</label>
                    <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" placeholder="*********">
                  </div>
              
              </div>
                <button name="login" type="submit" class="btn btn-primary col-sm-10">Login</button> 
</form>
</div>
<div class="col-xl-4"></div>
          