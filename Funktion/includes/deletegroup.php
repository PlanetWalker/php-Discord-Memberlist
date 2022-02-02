
        <div class="col-xl-4">
            <h2 class="text-center">Delete Group</h2>
<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }
    // This happend if the user press submit
    if(isset($_POST['deleteGroup'])) {
        if(isset($_POST['group']) && isset($_POST['confirm'])) {
            $group = intval(mysqli_real_escape_string($conn, $_POST['group']));
            
            $sql = "DELETE FROM `Groups` WHERE `GroupID`='$group'";
            
            $result = mysqli_query($conn, $sql);
            if($result) {
                
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Teammitglied wurde gelöscht
            </div>
            ';
                
            }
            else
            echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Oh no!</strong> SQL Fehler! Kontaktiere den Webmaster
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
                    <label class="col-sm-2 control-label">Discord</label>
                    <div class="col-sm-10">
                        
                      <select name="group" class="form-control">
                            <!-- <option value="1">Default</option> -->
                            <?php 
                                $sql = "SELECT * FROM `Groups`;";
                                $result = mysqli_query($conn, $sql);
                                while($rows = mysqli_fetch_array($result)) {
                                        echo "<option value=".$rows['GroupID'].">".$rows['GroupID']."/".$rows['Name']."</option>";
                                }
                            ?>
                  </select>
                   </div>
              </div>
                
                <div class="form-check">
                    <div class="col-sm-10">
                  <input type="checkbox" class="form-check-input" name="confirm">
                  <label class="form-check-label" >Confirm</label>
                   </div>
                </div>
                <button name="deleteGroup" type="submit" class="btn btn-primary col-sm-10">Löschen</button>
</form>
            </div>
          