<?php
	$title = "Tags";
	$url = "tags.php";
	include("templates/header.tpl.php");
  include_once("../config/config.php");

  //establish a database connection
  $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
  $link = mysql_select_db(DB_NAME);

  //check connection
  if((!$con) || (!$link)){
       //connection error
    header('Location: error.php');
    exit();
  }

  $tags = $vid = NULL;

  if(isset($_GET["vid"])){
    $query = "SELECT `session`.`user_id`, `session`.`video_id`, `comment`.`comment`, `comment`.`time` FROM `comment`,`session` WHERE `session`.`video_id` = '".$_GET["vid"]."' AND `session`.`id` = `comment`.`session_id` ORDER BY `session`.`user_id`, `comment`.`time`";
    $url = "csv/tagList.php?vid=".$_GET["vid"];
    $title = "Tags for ".$_GET["vid"];
  } else {
    $query = "SELECT `session`.`user_id`, `session`.`video_id`, `comment`.`comment`, `comment`.`time` FROM `comment`,`session` WHERE `session`.`id` = `comment`.`session_id` ORDER BY `session`.`user_id`, `comment`.`time`";
    $url = "csv/tagList.php";
    $title = "All Tags";
  }

  $result = mysql_query($query);
?>

      <div class="container">

        <h1><?=$title?></h1>

        <table class="table table-striped">
        <thead>
          <tr>
            <th>User ID</th>
            <th>Video ID</th>
            <th>Tag</th>
            <th>Time</th>
          </tr>
        </thead>
        <tbody>
          <?php

            $commentTotal = 0;
            $tags = NULL;
            //process the mysql result
            while ($row = mysql_fetch_array($result))
            {
              $tags = $tags.$row['comment'].",";
              $commentTotal++;
          ?>
            <tr>
                <td><?=$row['user_id']?></td>
                <td><?=$row['video_id']?></td>
                <td><?=$row['comment']?></td>
                <td><?=$row['time']?></td>
            </tr>
          <?php
            }
          ?>
        </tbody>
      </table>
      
      <p><a href="<?=$url?>" class="btn btn-default btn-small"><span class="glyphicon glyphicon-download-alt"></span> Download as CSV</a></p>

      <hr/>
      <h2>Summary</h2>
      
      <p><?=$commentTotal?> Tags.</p>

      </div> 

      </div>

<?php
	include("templates/footer.tpl.php");

  //close the db connection
  mysql_close();
?>