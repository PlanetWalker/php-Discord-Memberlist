
<?php 
/*
if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
  echo '<h1>Wrong Path!</h1>';
  exit();
}
*/
header('Content-Type: application/json');
$db = app_db();

$input = filter_input_array(INPUT_POST);

if (mysqli_connect_errno()) {
  echo json_encode(array('mysqli' => 'Failed to connect to MySQL: ' . mysqli_connect_error()));
  exit;
}

if ($input['action'] == 'edit') {
  $db->query("UPDATE `Members` SET `DiscordID`='".$input['discordid']."', `Displayname`='".$input['displayname']."', `GroupID`='".$input['group']."' WHERE `MemberID`='" . $input['id'] . "' LIMIT 1;");
} else if ($input['action'] == 'delete') {
  $db->query("UPDATE `Members` SET `Deleted`=true WHERE `MemberID`='" . $input['id'] . "' LIMIT 1;");
} else if ($input['action'] == 'restore') {
  $db->query("UPDATE `Members` SET `Deleted`=false WHERE `MemberID`='" . $input['id'] . "' LIMIT 1;");
}


// RETURN OUTPUT
echo json_encode($input);
?>