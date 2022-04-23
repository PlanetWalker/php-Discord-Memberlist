<main>
    <h1 class="text-center title">Admin Panel - Memberlist</h1>
  <div class="container">
    <!-- search -->
    <table id="search" width="100%" border="1" class="table-dark table-striped mt-2">
            <thead class="text-center">
              <tr>
                <th scope="col">
                ID</th>
                <th scope="col">Discord ID</th>
                <th scope="col">Realname</th>
                <th scope="col">Displayname</th>
                <th scope="col">Global</th>
              </tr>
            </thead>
            <tbody class="text-center">
              <tr>
                <td class="p-1"><input type="text" id="search_id" placeholder="Enter search id" class="form-control input-sm searchbox-dark"></td>
                <td class="p-1"><input type="text" id="search_discordid" placeholder="Enter search discordid" class="form-control input-sm searchbox-dark"></td>
                <td class="p-1"><input type="text" id="search_realname" placeholder="Enter search realname" class="form-control input-sm searchbox-dark"></td>
                <td class="p-1"><input type="text" id="search_displayname" placeholder="Enter search displayname" class="form-control input-sm searchbox-dark"></td>
                <td class="p-1"><input type="text" id="search_all" placeholder="Enter search in table" class="form-control input-sm searchbox-dark"></td>
              </tr>
            </tbody>
          </table>
          <!-- Add new user -->
          <table id="search" width="100%" border="1" class="table-dark table-striped mt-2">
            <thead class="text-center">
              <tr>
                <th scope="col">Discord ID</th>
                <th scope="col">Displayname</th>
                <th scope="col">Group</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="text-center">
                
            <form id="addMember">
              <tr>
                <td class="p-1"><input type="text" name="discordid" placeholder="000000000000000000" class="form-control input-sm searchbox-dark" required></td>
                <td class="p-1"><input type="text" name="displayname" placeholder="User" class="form-control input-sm searchbox-dark"></td>
                <td class="p-1">
                    <select name="group" class="form-control searchbox-dark" required>
                            <!-- <option value="1">Default</option> -->
                            <?php 
                              $db = app_db();
                                $result = $db->query("SELECT * FROM `Groups` ORDER BY `Groups`.`Weight` DESC;"); // LIMIT 10
                                while($rows = mysqli_fetch_array($result)) {
                                        echo "<option value=".$rows['GroupID'].">".$rows['Name']."</option>";
                                }
                            ?>
                  </select>
                  </td>
                  <td class="p-1"><input id="submit" type="submit" class="btn btn-sm btn-success" value="Hinzufügen"></td>
                  
                </tr>
              </form>
            </tbody>
          </table>
          <!-- Member Content -->
          <table id="membertable" width="100%" border="1" class="table-dark table-striped mt-2">
            <thead class="text-center">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Discord Id</th>
                <th scope="col">Realname</th>
                <th scope="col">Displayname</th>
                <th scope="col">Group</th>
                <th scope="col">Avatar</th>
              </tr>
            </thead> 
            <tbody>
                <?php 
                    include(ROOTPATH. "/includes/php/dep/memberlist/table.php");
                ?>
            </tbody>
          </table>
        </div>
          <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/jquery-3.6.0/jquery.tabledit.min.js"></script> 
          <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/memberlist/tabledit.js"></script> 
          <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/memberlist/search.js"></script> 
          <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/memberlist/add.js"></script> 
          <script type="text/javascript" src="<?php echo APPURL; ?>/includes/js/replaceHistroy.js"></script> 
</main>