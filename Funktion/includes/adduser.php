
        <div class="col-xl-4">
            <h2 class="text-center">Add User</h2>
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
    if(isset($_POST['addMember'])) {
        if(isset($_POST['discord']['id'])) {
            $userID = mysqli_real_escape_string($conn, $_POST['discord']['id']);
            
            $groupID = mysqli_real_escape_string($conn, $_POST['group']);
            
            // -----------------------------------------------------------------
            
            try {
            
            $userObjekt = $discord->user->getUser(['user.id' => intval($userID)]);
            $user = get_object_vars($userObjekt);
            
            $avatar = strval($user['avatar']);
            if(@getimagesize('https://cdn.discordapp.com/avatars/'.$userID.'/'.$avatar.'.gif'))  // ob das bild gif ist
                
              $avatar = $avatar . ".gif";  
         else
              $avatar =  $avatar . ".png";  
                
                
            $realname = $user['username']; 
            
            // -----------------------------------------------------------------
            
            if(isset($_POST['displayname']) && $_POST['displayname'] != "")
                $displayName = mysqli_real_escape_string($conn, $_POST['displayname']);
                else
               $displayName = $user['username']; 
                
            $sql = "INSERT INTO `Members`(`UserID`, `Displayname`, `GroupID`, `Avatar`, `Username` ) 
            VALUES ('$userID', '$displayName','$groupID','$avatar','$realname');";
            
            $result = mysqli_query($conn, $sql);
                
            } catch (Exception $ex) {
            $result = false;
                
            echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Oh no!</strong> Benutzer exsistiert nicht oder 
            Discord Fehler dann Kontaktiere den Webmaster
            </div>
            ';  
            }
            
            if($result)
                
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Teammitglied <strong>'.$realname.'</strong> wurde hinzugefügt
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
                    <label class="col-sm-2 control-label">User.ID*</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" name="discord[id]" placeholder="000000000000000000" required>
                        </div>
              </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Displayname</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" name="displayname" placeholder="User">
                  <smallclass="form-text text-muted">Muss nicht gesetzt werden</small> </div>
                        </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Group</label>
                    <div class="col-sm-10">
                      <select name="group" class="form-control" required>
                            <!-- <option value="1">Default</option> -->
                            <?php 
                                $sql = "SELECT * FROM `Groups` ORDER BY `Groups`.`Weight` DESC;";
                                $result = mysqli_query($conn, $sql);
                                while($rows = mysqli_fetch_array($result)) {
                                        echo "<option value=".$rows['GroupID'].">".$rows['GroupID']."/".$rows['Name']."</option>";
                                }
                            ?>
                  </select>
                </div>
                </div>
                <button name="addMember" type="submit" class="btn btn-primary col-sm-10" <?php echo ($dconn) ? '':'disabled'; ?>>Hinzufügen</button>
</form>
            </div>
          