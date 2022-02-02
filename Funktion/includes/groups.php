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
                <th scope="col">Name</th>
                <th scope="col">Color</th>
                <th scope="col">Weight</th>
            </tr>
            <?php
                $tabelle = array();
                $sql = "SELECT `GroupID` FROM `Groups` ORDER BY `Groups`.`Weight` ASC";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    array_push($tabelle, $row);
                }
                $check = mysqli_num_rows($result);

                if ($check > 0) {
                    foreach ($tabelle as $row) {
                        $UID = $row['GroupID'];
                        $sql = "SELECT * FROM `Groups` WHERE `GroupID`='$UID'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        
                        // DATA
                        $name = $row['Name'];
                        $color = $row['Color'];
                        
                        $weight = $row['Weight'];

                        echo '
                        <tr>
                                <td>'.$UID.'</td>
                                <td>'.$name.'</td>
                                <td><span style="color:'.$color.';">'.$color.'</span></td>
                                <td>'.$weight.'</td>
                        </tr>
                        ';
                    }
                }
            ?>
        </tbody>
        </table>
