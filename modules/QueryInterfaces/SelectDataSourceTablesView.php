<?php
include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

SelectTableView();

function SelectTableView()
{
	global $wpdb;
	
	$datasourceID = $_POST['ds_id'];

	$DataSourcesQuery	= new DataSources();
	$results		= $DataSourcesQuery->getDataSourceTables($datasourceID);
	$datasource		= $DataSourcesQuery->getDataSource($datasourceID);		
		
	while ($row = mysql_fetch_assoc($results)) {

		$ncols = @mysql_num_fields ($results);
			
		if ($ncols == 0)
		{
		    $content .= "Query has no result set<br/>";
		}
		for ($i = 0; $i < $ncols; $i++)
		{
		    $col_info = mysql_fetch_field ($results, $i);
		    $content .= "<option value='". $row[$col_info->name] ."'>" . $row[$col_info->name] . "</option>";
		}							
	}

	echo $content;
		
	$DBresults = null;
	$sqlStatement = null;
	$queryIntSQL = null;
	$results = null;
			

}

?>