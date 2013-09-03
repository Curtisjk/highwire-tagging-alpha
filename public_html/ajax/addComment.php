<?php
	//include the database config here.
	require_once("../config/config.php");

	//declare the variables
	$sessionID = $comment = $result = NULL;
	
	//grab the variables from the form.
	if((isset($_REQUEST['sessionID'])) && (isset($_REQUEST['time'])) && (isset($_REQUEST['comment']))){
		//save them locally
		$sessionID = $_REQUEST['sessionID'];
		$comment = $_REQUEST['comment'];
		$videoTime = $_REQUEST['time'];

		//establish a database connection
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		$link = mysql_select_db(DB_NAME);

		//check connection
		if((!$con) || (!$link)){
		    //connection error
			$result["status"] = "DB Connection Error";
			exit();
		}

		//clean up the comment variable
		$safecomment = mysql_real_escape_string($comment);

		//create a query
		$query = "INSERT INTO `".DB_NAME."`.`comment` (`id`, `time` ,`session_id` ,`comment`) VALUES (NULL, '".$videoTime."', '".$sessionID."',  '".$safecomment."');";

		if (mysql_query($query)) {
		    $result["status"] = "Success";
		    $result["data"] = array(
				    				"sessionID" => $sessionID,
				    				"videoTime" => $videoTime,
				    				"comment" => $comment,
				    			);
		} else {
			$result["status"] = "DB Insert Error";
			exit();
		}

	} else {
		$result["status"] = "Form Error";
	}

	mysql_close();

	echo json_encode($result);
?>