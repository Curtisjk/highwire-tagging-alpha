<?php
	$title = "Maintenance";
	$url = "maintenance.php";
	include("templates/header.tpl.php");
?>

      <div class="container">
        <h1>Maintenance</h1>
        <p>Use this page to remove tags that have somehow made their way into the database such as empty tags ("") or the default text ("Add Tag"). These actions will be applied to all videos, not just those that are active.</p>

        <p>Warning: This cannot be undone!</p>
        
        <a href="maintenance_perform.php" class="btn btn-default">Perform Maintenance</a>
      </div>

<?php
	include("templates/footer.tpl.php");
?>