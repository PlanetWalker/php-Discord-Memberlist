<?php
     if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           //exit();
     }   
?>

<table width="100%" border="1" class="text-center">
    <tbody>
    <tr>

                <th scope="col">ID</th>
                <th scope="col">Realname</th>
                <th scope="col">Displayname</th>
                <th scope="col">Group</th>
                <th scope="col">Avatar</th>
            </tr>
            <?php
                $tabelle = array();
                $sql = "SELECT `MemberID` FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` ORDER BY `Groups`.`Weight` ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    array_push($tabelle, $row);
                }
                $check = mysqli_num_rows($result);

                if ($check > 0) {
                    foreach ($tabelle as $row) {
                        $UID = $row['MemberID'];
                        $sql = "SELECT * FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `MemberID`='$UID'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        
                        // DATA
                        $discord = $row['Displayname'];
                        $group = $row['Name'];
                        
                        $userID = $row['UserID'];
                        $avatar = $row['Avatar'];
                        $color = $row['Color'];

                        echo '
                        <tr>
                                <td>'.$UID.'</td>
                                <td>'.$row['Username'].'</td>
                                <td>'.$discord.'</td>
                                <td><span style="color:'.$color.';">'.$group.'</span></td>
                                <td><img src="https://cdn.discordapp.com/avatars/'.$userID.'/'.$avatar.'?size=64" /></td>
                        </tr>
                        ';
                    }
                }
            ?>
        </tbody>
        </table>
