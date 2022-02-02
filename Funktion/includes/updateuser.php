
        <div class="col-xl-4">
            <h2 class="text-center">Update User</h2>
<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }
    // This happend if the user press submit
    if(isset($_POST['updateMember'])) {
        if(isset($_POST['member'])) {
            $member = intval(mysqli_real_escape_string($conn, $_POST['member']));
            
            $sql = "SELECT * FROM `Members` WHERE `MemberID`='$member';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            
            // -----------------------------------------------------------------
            
            try {
            
            $userID = $row['UserID'];
            
            $userObjekt = $discord->user->getUser(['user.id' => intval($userID)]);
            $user = get_object_vars($userObjekt);
            
            $avatar = $user['avatar'];
                                                   
            if(@getimagesize('https://cdn.discordapp.com/avatars/'.$userID.'/'.$avatar.'.gif')) // ob das bild gif ist
                
              $avatar = $avatar .".gif"; 
            else
              $avatar = $avatar .".png";                                                 
    
            $realname = $user['username']; 
            
            // -----------------------------------------------------------------
                
            $sql = "UPDATE `Members` SET `Avatar`='$avatar', `Username`='$realname' WHERE `MemberID`='$member';";
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
            
            
            if($result) {
                
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Teammitglied wurde neu geladen
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
                        
                      <select name="member" class="form-control">
                            <!-- <option value="1">Default</option> -->
                            <?php 
                                $sql = "SELECT * FROM `Members` WHERE `MemberID`;";
                                $result = mysqli_query($conn, $sql);
                                while($rows = mysqli_fetch_array($result)) {
                                        echo "<option value=".$rows['MemberID'].">".$rows['MemberID']."/".$rows['Username']."</option>";
                                }
                            ?>
                  </select>
                   </div>
              </div>
                <button name="updateMember" type="submit" class="btn btn-primary col-sm-10" <?php echo ($dconn) ? '':'disabled'; ?>>Update</button>
</form>
            </div>
          