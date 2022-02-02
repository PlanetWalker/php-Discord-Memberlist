<?php
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
         
            echo '
            <h1>Wrong Path!</h1>
            ';
           exit();
     }  

// Login Passwort
$password = "Kekse";

// SQL Database

$user = "dbuser";
$pass = "dbpass";
$host = "localhost";
$dbname = "dbname";

//https://discord.com/developers/applications/

$token = "Discordthoken";

?>