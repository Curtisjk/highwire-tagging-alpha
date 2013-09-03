<?php
	$title = "Videos";
	$url = "videos.php";
	include("templates/header.tpl.php");
  include_once("../config/config.php");
  include_once("../config/videos.php");

  //establish a database connection
  $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
  $link = mysql_select_db(DB_NAME);

  //check connection
  if((!$con) || (!$link)){
    //connection error
    header('Location: error.php');
    exit();
  }

  //select video stats
  $query = "SELECT `session`.`video_id`, COUNT(`comment`.`comment`) AS `comments`, COUNT(DISTINCT `session`.`id`) as `sessions` FROM `session`, `comment` WHERE `comment`.`session_id` = `session`.`id` GROUP BY `session`.`video_id`";
  $result = mysql_query($query);
?>

      <div class="container">
        <h1>Videos</h1>
        
        <table class="table table-striped">
        <thead>
          <tr>
            <th>Video ID</th>
            <th>Title</th>
            <th>Comments</th>
            <th>Sessions</th>
          </tr>
        </thead>
        <tbody>
          <?php

            $commentTotal = $sessionTotal = 0;
            //process the mysql result
            while ($row = mysql_fetch_array($result))
            {
              $commentTotal += $row['comments'];
              $sessionTotal += $row['sessions'];
          ?>
            <tr>
                <td><a href="tags.php?vid=<?=$row['video_id']?>"><?=$row['video_id']?></a></td>
                <td><?php
                  $title = NULL;
                  foreach($videos as $vid){
                    if($vid['id'] == $row['video_id']){
                      $title = $vid['name']; 
                      break;
                    }
                  }
                  if($title != NULL){
                    echo $title;
                  } else {
                    echo "Cannot find title in videos.php";
                  }
                  ?></td>
                <td><?=$row['comments']?></td>
                <td><?=$row['sessions']?></td>
            </tr>
          <?php
            }
          ?>
        </tbody>
      </table>

      <p><a href="csv/videoList.php" class="btn btn-default btn-small"><span class="glyphicon glyphicon-download-alt"></span> Download as CSV</a></p>

      <hr/>
      <h2>Summary</h2>
      <p><?=$commentTotal?> Tags from <?=$sessionTotal?> sessions. Average <?=number_format(($commentTotal / $sessionTotal), 2, '.', '')?> comments per session.</p>

      </div>

<?php
	include("templates/footer.tpl.php");

  //close the db connection
  mysql_close();
?>