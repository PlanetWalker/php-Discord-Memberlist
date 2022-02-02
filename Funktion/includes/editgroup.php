
        <div class="col-xl-4">
            <h2 class="text-center">Edit Group</h2>
<?php
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }
    // This happend if the user press submit
    if(isset($_POST['editGroup'])) {
        if(isset($_POST['group'])) {
            $groupID = intval(mysqli_real_escape_string($conn, $_POST['group']));
            
            $sqlName = true;
            if(isset($_POST['name']) && $_POST['name'] != "") {
                $groupName = mysqli_real_escape_string($conn, $_POST['name']);
                $sql = "UPDATE `Groups` SET `Name`='$groupName' WHERE `GroupID` = '$groupID';";
                $sqlName = mysqli_query($conn, $sql);
            }
            $sqlWeight = true;
            if(isset($_POST['weight'])) {
                $groupWeight = intval(mysqli_real_escape_string($conn, $_POST['weight']));
                $sql = "UPDATE `Groups` SET `Weight`='$groupWeight' WHERE `GroupID` = '$groupID';";
                $sqlWeight = mysqli_query($conn, $sql);
            }
            
            $groupColor = mysqli_real_escape_string($conn, $_POST['color']);
            $sql = "UPDATE `Groups` SET `Color`='$groupColor' WHERE `GroupID` = '$groupID';";
            $result = mysqli_query($conn, $sql);
            
            
            if($result && $sqlWeight && $sqlName) {
            echo '
            <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
                Das Gruppe wurde bearbeitet
            </div>
            ';
            
            }
            else
            echo '
            <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Oh no!</strong> Kritischer SQL Fehler! Kontaktiere den Webmaster
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
                    <label class="col-sm-2 control-label">Group</label>
                    <div class="col-sm-10">
                      <select name="group" class="form-control" required>
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
                <div class="form-group">
                    <label class="col-sm-2 control-label">Group.Name</label>
                    <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" placeholder="User">
                  <smallclass="form-text text-muted">So lassen für keine Veränderung</small> </div>
                        </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Color</label>
                    <div class="col-sm-10">
                  <input type="color" class="form-control" name="color" required>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Gewicht</label>
                    <div class="col-sm-10">
                  <input type="number" class="form-control" name="weight" placeholder="100">
                  <smallclass="form-text text-muted">So lassen für keine Veränderung</small> 
                        </div>
                    </div>
                <button name="editGroup" type="submit" class="btn btn-primary col-sm-10">Bearbeiten</button>
</form>
            </div>