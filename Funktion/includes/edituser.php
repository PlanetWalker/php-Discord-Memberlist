
        <div class="col-xl-4">
            <h2 class="text-center">Edit User</h2>
<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }
    // This happend if the user press submit
    if(isset($_POST['editMember'])) {
        if(isset($_POST['member'])) {
            $memberID = intval(mysqli_real_escape_string($conn, $_POST['member']));
            
            $groupID = intval(mysqli_real_escape_string($conn, $_POST['group']));
            
            $sqlGroup = "";
            if($groupID != 0) 
                $sqlGroup = "`GroupID`='$groupID'";
            
            $sqlDisplayname = "";
            if($_POST['displayname'] != "") {
                $displayname = mysqli_real_escape_string($conn, $_POST['displayname']);
                
                $sqlDisplayname = "`Displayname`='$displayname'";
            }
            
            if($sqlGroup && $sqlDisplayname != "")
            $sql = "UPDATE `Members` SET $sqlGroup, $sqlDisplayname WHERE `MemberID`='$memberID';";
                else
            $sql = "UPDATE `Members` SET $sqlGroup $sqlDisplayname WHERE `MemberID`='$memberID';";
            
            $result = mysqli_query($conn, $sql);
            if($result) {
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Teammitglied wurde bearbeitet
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
                      <select name="member" class="form-control" required>
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
                <div class="form-group">
                    <label class="col-sm-2 control-label">Displayname</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" name="displayname" placeholder="User">
                  <smallclass="form-text text-muted">So lassen für keine Veränderung</small> </div>
                        </div>
      <div class="form-group">
                    <label class="col-sm-2 control-label">Group</label>
                    <div class="col-sm-10">
                      <select name="group" class="form-control">
                            <option value="0"></option>
                            <?php 
                                $sql = "SELECT * FROM `Groups` ORDER BY `Groups`.`Weight` DESC;";
                                $result = mysqli_query($conn, $sql);
                                while($rows = mysqli_fetch_array($result)) {
                                        echo "<option value=".$rows['GroupID'].">".$rows['GroupID']."/".$rows['Name']."</option>";
                                }
                            ?>
                  </select>
                  <smallclass="form-text text-muted">So lassen für keine Veränderung</small>
                </div>
                </div>
                <button name="editMember" type="submit" class="btn btn-primary col-sm-10">Bearbeiten</button>
</form>
            </div>