<?php
	//include the database config here.
	require_once("../config/config.php");

	//declare the variables
	$userID = $videoID = $expertise = $result = NULL;

	//grab the variables from the form.
	if((isset($_REQUEST['userID'])) && (isset($_REQUEST['videoID'])) && (isset($_REQUEST['expertise']))){
		//save them locally
		$userID = $_REQUEST['userID'];
		$videoID = $_REQUEST['videoID'];
		$expertise = $_REQUEST['expertise'];

		//establish a database connection
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		$link = mysql_select_db(DB_NAME);

		//check connection
		if((!$con) || (!$link)){
		    //connection error
			$result["status"] = "DB Connection Error";
			exit();
		}

		//create a query
		$query = "INSERT INTO `".DB_NAME."`.`session` (`id` ,`user_id`, `video_id`, `expertise` ,`datetime`) VALUES (NULL, '".$userID."', '".$videoID."', '".$expertise."',  CURRENT_TIMESTAMP);";

		if (mysql_query($query)) {
		    $result["status"] = "Success";
		    $result["data"] = array(
				"sessionID" => mysql_insert_id(),
				"userID" => $userID,
				"videoID" => $videoID,
			);
		} else {
			$result["status"] = "DB Insert Error";
			exit();
		}

	} else {
		$result["status"] = "Form Error";
	}
	//exit mysql
	mysql_close();

	//output the response
	echo json_encode($result);
?>