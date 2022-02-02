
        <div class="col-xl-4">
            <h2 class="text-center">Add Group</h2>
<?php
    
        
    include __DIR__.'/../vendor/autoload.php';
    use RestCord\DiscordClient;
            
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }
    // This happend if the user press submit
    if(isset($_POST['addGroup'])) {
        if(isset($_POST['group'])) {
            $groupname = mysqli_real_escape_string($conn, $_POST['group']['Groupname']);
            $color = mysqli_real_escape_string($conn, $_POST['group']['Color']);
            $weight = mysqli_real_escape_string($conn, $_POST['group']['Weight']);
            
             
                
            $sql = "INSERT INTO `Groups`(`Name`, `Color`, `Weight`) VALUES ('$groupname', '$color', '$weight');";
            
            $result = mysqli_query($conn, $sql);
                
            
            if($result)
                
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Teammitglied <strong>'.$groupname.'</strong> wurde hinzugefügt
            </div>
            ';
            else
            echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Oh no!</strong> SQL Abfragenfehler! Kontaktiere den Webmaster
            </div>
            ';          
            
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
                    <label class="col-sm-2 control-label">Group.Name*</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" name="group[Groupname]" placeholder="Group xyz" required>
                        </div>
              </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                  <input type="color" class="form-control" name="group[Color]" required>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gewicht</label>
                    <div class="col-sm-10">
                  <input type="number" class="form-control" name="group[Weight]" placeholder="100" required>
                        </div>
                    </div>
                <button name="addGroup" type="submit" class="btn btn-primary col-sm-10">Hinzufügen</button>
                    
</form>
            </div>
          