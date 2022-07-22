<?php
header('Content-Type: application/json');

$db = app_db();

// Create a array with the group id
$result = $db->query("SELECT `GroupID` FROM `Groups` ORDER BY `Groups`.`Weight` ASC"); // LIMIT 10

$check = mysqli_num_rows($result);
// Check if there a result
if ($check > 0) {
  // Push to the array
  $grouparray = array();
  while ($row = mysqli_fetch_array($result)) {
    array_push($grouparray, $row);
  }

  // Create a array that schould pushed back
  // OLD - $groupInfoArray = array();
  $groupResult[0] = 'Select:';
  foreach ($grouparray as $row) {
    // Get all infos each group
    $GID = $row['GroupID'];
    $result = $db->query("SELECT * FROM `Groups` WHERE `GroupID`='$GID' LIMIT 1");
    // Get as a row all infos
    $row = mysqli_fetch_assoc($result);

    // DATA
    $name = $row['Name'];
    // OLD - $color = $row['Color'];
    // OLD - $weight = $row['Weight'];
    $groupResult[$GID] = $name;
    // OLD - array_push($groupInfoArray, array('GroupID' => $GID, 'Name' => $name, 'Color' => $color, 'Weight' => intval($weight)));
  }
  // OLD - echo json_encode($groupInfoArray);
  echo json_encode($groupResult);
} else {
  echo json_encode([1 => 'Error', 2 => 'Error', 3 => 'Error']);
}

die();