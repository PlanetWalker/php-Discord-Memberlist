<?php
    
        
    include ROOTPATH.'/protected/discord.php';
    $discord = discordCreate(discord_token());
    $db = app_db();

    // This happend if the user press submit
        if(isset($_POST['discordid'])) {
            $discordID = $db->CleanDBData($_POST['discordid']);
            
            $groupID = intval($db->CleanDBData($_POST['group']));
            
            // -----------------------------------------------------------------
            
			// Fetsch user realname and avatar
            try {
            
            $userObjekt = $discord->user->getUser(['user.id' => intval($discordID)]);
            $user = get_object_vars($userObjekt);
            
            $avatar = strval($user['avatar']);
            if(@getimagesize('https://cdn.discordapp.com/avatars/'.$discordID.'/'.$avatar.'.gif'))  // ob das bild gif ist
                
              $avatar = $avatar . ".gif";  
         else
              $avatar =  $avatar . ".png";  
                
                
            $realname = $user['username']; 
            
            // -----------------------------------------------------------------
            
            if(isset($_POST['displayname']) && $_POST['displayname'] != "")
                $displayName = $db->CleanDBData($_POST['displayname']);
            else
				$displayName = "";
               //$displayName = $user['username']; 
                
            $result = $db->query("INSERT INTO `Members`(`DiscordID`, `Displayname`, `GroupID`, `Avatar`, `Username`, `Deleted` ) 
            VALUES ('$discordID', '$displayName','$groupID','$avatar','$realname', false);");
            
            
                
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
    
    ?>