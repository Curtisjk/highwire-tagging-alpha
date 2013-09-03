<?php
	require_once("../../config/config.php");
	
	//connect to the db
	mysql_connect(DB_HOST, DB_USER, DB_PASS)or die("Cannot connect"); 
	mysql_select_db(DB_NAME)or die("cannot select DB");
	
	if(isset($_GET['vid'])){
		$select = "SELECT `session`.`user_id`, `session`.`video_id`, `comment`.`comment`, `comment`.`time` FROM `comment`,`session` WHERE `session`.`video_id` = '".$_GET['vid']."' AND `session`.`id` = `comment`.`session_id` ORDER BY `session`.`user_id`, `comment`.`time`";
	} else {
		$select = "SELECT `session`.`user_id`, `session`.`video_id`, `comment`.`comment`, `comment`.`time` FROM `comment`,`session` WHERE `session`.`id` = `comment`.`session_id` ORDER BY `session`.`user_id`, `comment`.`time`";
	}
	
	$export = mysql_query ( $select ) or die ( "Sql error : " . mysql_error( ) );
	$fields = mysql_num_fields ( $export );

	for ( $i = 0; $i < $fields; $i++ )
	{
		$header .= mysql_field_name( $export , $i ) . "\t";
	}

	while( $row = mysql_fetch_row( $export ) )
	{
		$line = '';
		foreach( $row as $value )
		{                                            
			if ( ( !isset( $value ) ) || ( $value == "" ) )
			{
				$value = "\t";
			}
			else
			{
				$value = str_replace( '"' , '""' , $value );
				$value = '"' . $value . '"' . "\t";
			}
			$line .= $value;
		}
		$data .= trim( $line ) . "\n";
	}
	$data = str_replace( "\r" , "" , $data );

	if ( $data == "" )
	{
		$data = "\n(0) Records Found!\n";                        
	}

	header("Content-type: application/octet-stream");
	if(isset($_GET['vid'])){
		$filename = "tagList-".$_GET['vid'];
	} else {
		$filename = "tagList-all";
	}
	header("Content-Disposition: attachment; filename=".$filename.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";
?>