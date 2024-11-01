<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

SelectFieldsView();

function SelectFieldsView() 
{
	global $wpdb;

	$datasourceID 	= $_POST['ds_id'];
	$tablename  	= $_POST['tablename'];
	$content 	= $tablename;
	
	$tables 	= $pieces = explode(",", $tablename);
	
	foreach ($tables as $table)
	{
		
		$modTable = str_replace(",","", $table);
		
		$content .= $modTable;
		$DataSourcesQuery	= new DataSources();
		$results		= $DataSourcesQuery->getTableFields($datasourceID,$modTable);
			
		while ($row = mysql_fetch_assoc($results))
		{
			$ncols = @mysql_num_fields ($results);

			for ($i = 0; $i < $ncols; $i++)
			{
			    $col_info = mysql_fetch_field ($results, $i);
			    if($i == 0)
			    {
				$content .= "<option value='".$table.".". $row[$col_info->name] . "'>".$table."." . $row[$col_info->name] . "</option>\n";
			    }
			}							
		}
		mysql_free_result ($results);
		$DataSourcesQuery = null;
		$row = null;
		$ncols = null;
		$datasource = null;
		$results = null;		
	}
	echo $content;
		


}

?>
