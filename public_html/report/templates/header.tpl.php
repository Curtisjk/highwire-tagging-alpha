<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar.css" rel="stylesheet">

  </head>

  <body>

    <div class="container">

      <!-- Static navbar -->
      <div class="navbar">
        <div class="container">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Tagging Study</a>
          <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
              <li <?if($url == "videos.php"){echo "class=\"active\"";}?>><a href="videos.php">Videos</a></li>
              <li <?if($url == "tags.php"){echo "class=\"active\"";}?>><a href="tags.php">Tags</a></li>
              <li <?if($url == "maintenance.php"){echo "class=\"active\"";}?>><a href="maintenance.php">Maintenance</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
