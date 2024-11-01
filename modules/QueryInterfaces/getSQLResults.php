<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

ReviewSQLView();

function ReviewSQLView()
{
	global $wpdb;

	$queryInterfaceOptions['datasource'] 	= $_POST['ds_id'];
	$queryInterfaceOptions['sqlQuery']	= $_POST['sqlQuery'];
	$content .= stripslashes($queryInterfaceOptions['sqlQuery']) . "<br/>";
	
	$datasources_table_name = $wpdb->prefix . "xdata_datasources";
	$sqlStatement = 'SELECT * FROM ' . $datasources_table_name .' WHERE ds_id = '.$queryInterfaceOptions['datasource'];
	
	$DBresults = $wpdb->get_results($sqlStatement);
		
	//Connection's Parameters
	$db_host= ""; 
	$db_name=""; 
	$username=""; 
	$password="";
	$db_friendly_name = "";
		
	foreach($DBresults as $k=>$i){
		$db_host	= $i->ds_host_url . ":" . $i->ds_port;
		$db_name 	= $i->ds_name;
		$username	= $i->ds_username;
		$password	= decode5t($i->ds_password);
		$db_friendly_name = $i->ds_identifier;
	}
			
	$databaseConnection = mysql_connect($db_host, $username, $password);
	mysql_select_db($db_name,$databaseConnection);				
		
	$queryStripped = stripslashes($queryInterfaceOptions['sqlQuery']);			
	$results     = mysql_query($queryStripped);		
	
	if($results)
	{
		$content .= '<table width="100%" border="1" class="widefat">';
		$content .= '<tr>';
		for($i=0; $i < $nFields; $i++)
		{
			$content .= '<th><font size="-3">';
			$content .= $tablefields[$i];
			$content .= '</font></th>';			
		}
		$content .= '</tr>';
		
		while ($row = mysql_fetch_assoc($results)) {
	
			$ncols = @mysql_num_fields ($results);
			
			$content .= '<tr>';
			
			if ($ncols == 0)
			    $content .= "<td>Query has no result set</td>\n";
	
			for ($i = 0; $i < $ncols; $i++)
			{
			    $col_info = mysql_fetch_field ($results, $i);
			    $content .= "<td>" . $row[$col_info->name] . "</td>\n";
			}
			
			$content .= '</tr>';
		}
		$content .= '</table>';	
		
	}else
	{
		$content .= "No Query Results";
	}


	echo $content;
	
	$DBresults = null;
	$sqlStatement = null;
	$queryIntSQL = null;
	$results = null;
	

}

?>