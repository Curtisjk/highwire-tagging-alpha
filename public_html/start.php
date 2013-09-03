<?php
	include_once("config/config.php");
	include_once("config/videos.php");

	//generate a new uid and assign a group
	
	//establish a database connection
	$con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
	$link = mysql_select_db(DB_NAME);

	//check connection
	if((!$con) || (!$link)){
	     //connection error
		header('Location: error.php');
		exit();
	}

	//create new user
	$query = "INSERT INTO `".DB_NAME."`.`user` (`id`,`group`,`timestamp`) VALUES (NULL, NULL, CURRENT_TIMESTAMP);";
	mysql_query($query);

	$uid = mysql_insert_id();
	

	//set the group
	$group = ($uid % count($videos)) + 1;
	$query = "UPDATE  `".DB_NAME."`.`user` SET  `group` =  '".$group."' WHERE  `user`.`id` = ".$uid.";";

	mysql_query($query);
	mysql_close();

	//save uid and group to cookies
	setcookie('uid', $uid, (time()+COOKIE_LENGTH));
	setcookie('group', $group, (time()+COOKIE_LENGTH));
	setcookie('watched', 0, (time()+COOKIE_LENGTH));

	//redirect to the tagging page
	header('Location: tagging.php');
?>