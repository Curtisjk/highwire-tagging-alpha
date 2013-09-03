<?php
	$title = "Perform Maintenance";
	$url = "maintenance.php";
	include("templates/header.tpl.php");
  include_once("../config/config.php");

  //establish a database connection
  $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
  $link = mysql_select_db(DB_NAME);

  $delete = array ("", "Add Tag", "test", "<TEST DELETE>");

  //check connection
  if((!$con) || (!$link)){
       //connection error
    header('Location: error.php');
    exit();
  }

  $vid = $_GET["vid"];
?>

      <div class="container">
        <h1><?=$title?></h1>
        
        <table class="table table-striped">
        <thead>
          <tr>
            <th>String</th>
            <th>Rows Affected</th>
          </tr>
        </thead>
        <tbody>
          <?php

            $rowTotal = 0;
            //process the mysql result
            foreach($delete as $i)
            {
              $query = "DELETE FROM `".DB_NAME."`.`comment` WHERE `comment`.`comment` = '".$i."'";
              $result = mysql_query($query);
              $rows = mysql_affected_rows();
              $commentTotal += $rows;
          ?>
            <tr>
                <td><?=htmlspecialchars($i)?></td>
                <td><?=$rows?></td>
            </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
      <p><strong>Total affected rows: <?=$commentTotal?></strong>
      </div>

<?php
	include("templates/footer.tpl.php");

  //close the db connection
  mysql_close();
?>