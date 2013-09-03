<?php
	//include the database config here.
	require_once("../config/config.php");

	$status = NULL;

	//start saving stuff
	if(isset($_REQUEST['email'])){
		//hash/salt the email
		$email = $_REQUEST['email'];
		$uid = $_REQUEST['uid'];
		$result = $_REQUEST['result'];
		$updates = $_REQUEST['updates'];

		//establish a database connection
		$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
		$link = mysql_select_db(DB_NAME);

		//check connection
		if((!$con) || (!$link)){
		    //connection error
			$status = "DB Connection Error";
			exit();
		}

		//create a query
		$query = "INSERT INTO `".DB_NAME."`.`email` (`id`, `uid`, `email`, `results`, `news` ,`timestamp`) VALUES (NULL, ".$uid.", AES_ENCRYPT('".$email."', '".AES."'), ".$result.", ".$updates.",  CURRENT_TIMESTAMP);";

		if (mysql_query($query)) {
		    $status = "Success";
		} else {
			$status = "DB Insert Error";
		}
		
		//exit mysql
		mysql_close();

	} else {
		$status = "Form Error";
	}

	//output the datas
	echo json_encode($status);
?>