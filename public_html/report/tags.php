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

  $vid = $_GET["vid"];
  $tags;

  if(isset($vid)){
    $query = "SELECT `session`.`user_id`, `session`.`video_id`, `comment`.`comment`, `comment`.`time` FROM `comment`,`session` WHERE `session`.`video_id` = '".$vid."' AND `session`.`id` = `comment`.`session_id` ORDER BY `session`.`user_id`, `comment`.`time`";
    $url = "csv/tagList.php?vid=".$vid;
    $title = "Tags for ".$vid;
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

      <?php
        if(isset($vid)){?>

          <hr/>
          <h2>Wordcloud</h2>
          <div id="canvas-container">
            <canvas id="canvas"></canvas>
          </div>

          <a href="#" id="downloadURL" download="wordcloud.png" class="btn btn-default btn-small"><span class="glyphicon glyphicon-download-alt"></span> Download Wordcloud</a>
      <?}?>

      <hr/>
      <h2>Summary</h2>
      
      <p><?=$commentTotal?> Tags.</p>

      </div> 

      </div>
      <?php
        if(isset($vid)){?>

          <script src="../js/jquery.js"></script>
          <script src="../js/wordcloud2/wordcloud2.js"></script>
          <script src="../js/wordfreq/wordfreq.js"></script>
          <script>
              //wordfreq stuff
              // Create an options object for initialization
              var list;
              var options = {
                workerUrl: '../js/wordfreq/wordfreq.worker.js' };

                var text = "<?=$tags?>";
              // Initialize and run process() function
              var wordfreq = WordFreq(options).process(text, function (newList) {
                // console.log the list returned in this callback.
                WordCloud(document.getElementById('canvas'), { 
                    list : newList,
                    minSize: 6,
                    weightFactor: 25,
                  } );
              });

              var dppx = window.devicePixelRatio;
              var canvas = $('#canvas');
              var canvasContainer = $('#canvasContainer');
              var width = 700;
              var height = width*0.65;
              console.log(height);

              var box = $('<div id="box" hidden />');
                canvasContainer.append(box);
                window.drawBox = function drawBox(item, dimension) {
                  if (!dimension) {
                    box.prop('hidden', true);

                    return;
                  }

                  box.prop('hidden', false);
                  box.css({
                    left: dimension.x / dppx + 'px',
                    top: dimension.y / dppx + 'px',
                    width: dimension.w / dppx + 'px',
                    height: dimension.h / dppx + 'px'
                  });
                };

                // Set the width and height
                  if (dppx !== 1) {
                    canvas.css({'width': width + 'px', 'height': height + 'px'});

                    width *= devicePixelRatio;
                    height *= devicePixelRatio;
                  } else {
                    canvas.css({'width': '', 'height': '' });
                  }

                  canvas.attr('width', width);
                  canvas.attr('height', height);

                $('#downloadURL').on('click', function save(evt) {
                  var url = document.getElementById("canvas").toDataURL();
                  if ('download' in document.createElement('a')) {
                    this.href = url;
                  } else {
                    evt.preventDefault();
                    alert('Please right click and choose "Save As..." to save the generated image.');
                    window.open(url, '_blank', 'width=500,height=300,menubar=yes');
                  }

                });
          </script>

      <?}?>


<?php
	include("templates/footer.tpl.php");

  //close the db connection
  mysql_close();
?>