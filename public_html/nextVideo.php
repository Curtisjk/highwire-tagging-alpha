<?php
	//include the config files
	include_once("config/config.php");

	//increment watched flag
	$uid = $_COOKIE["uid"];
	$group = $_COOKIE["group"];
	$watched = $_COOKIE["watched"];

	//increment the watched flag
	$watched++;

	//resave the cookies (refreshing the expiry date)
	setcookie('uid', $uid, (time()+COOKIE_LENGTH));
	setcookie('group', $group, (time()+COOKIE_LENGTH));
	setcookie('watched', $watched, (time()+COOKIE_LENGTH));
	header( 'Location: tagging.php' ) ;
?>