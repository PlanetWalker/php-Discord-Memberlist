<?php
$db = app_db();

// Create a array with the member id
$result = $db->query("SELECT `MemberID` FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `Deleted` = false ORDER BY `Groups`.`Weight` ASC"); // LIMIT 10
// Check if the result not null
$check = mysqli_num_rows($result);
if ($check > 0) {
    // Push to the array
    $memberarray = array();
    while ($row = mysqli_fetch_array($result)) {
        array_push($memberarray, $row);
    }
    
    // Send to the table
    foreach ($memberarray as $row) {
        // Get the Member ID
        $MID = $row['MemberID'];
        // Select all from the memberid
        $result = $db->query("SELECT `MemberID`, `DiscordID`, `Username`, `Displayname`, `Avatar`, `Groups`.`Name` 'GroupName', `Groups`.`Color` 'GroupColor' FROM `Members` JOIN `Groups` ON `Groups`.`GroupID`=`Members`.`GroupID` WHERE `MemberID`='".$MID."' LIMIT 1");
        // get the array from the member
        $row = mysqli_fetch_assoc($result);
        
        // get data from array
        $displayName = $row['Displayname'];
        $groupName = $row['GroupName'];
        $userName = $row['Username'];
                        
        $discordID = $row['DiscordID'];
        $avatar = $row['Avatar'];
        // OLD - $groupColor = $row['GroupColor'];  
        // && <td class="p-1"><span style="color:'.$groupColor.';">'.$groupName.'</span></td>
        
        // send the Infos
        echo '
            <tr id="'.$MID.'">
                <td class="p-1">'.$MID.'</td>
                <td class="p-1">'.$discordID.'</td>
                <td class="p-1">'.$userName.'</td>
                <td class="p-1">'.$displayName.'</td>
                <td class="p-1">'.$groupName.'</td>
                <td class="p-1 text-center"><img class="thumbnail zoom" src="https://cdn.discordapp.com/avatars/'.$discordID.'/'.$avatar.'?size=64" /></td>
            </tr>
        ';
    }
}
?>