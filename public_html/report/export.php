<?php
	require_once("../config.php");
	
	//connect to the db
	mysql_connect(DB_HOST, DB_USER, DB_PASS)or die("Cannot connect"); 
	mysql_select_db(DB_NAME)or die("cannot select DB");
	
	$select = "SELECT * FROM users";
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
	header("Content-Disposition: attachment; filename=vuact_landing_report.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";
?>