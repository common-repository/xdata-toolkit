<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
// VIEW FOR DeleteDataSourcesView

require_once("../../../../../wp-config.php");
// VIEW FOR SaveDataSourcesView

$datasourceID = $_POST['ds_id'];
DeleteDataSourcesView($datasourceID);

function DeleteDataSourcesView($datasourceID)
{
		$delete		= false;
		
		// CHECK TO SEE IF THERE ARE ANY QUERY INTERFACES WITH THE SELECTED DATASOURCE, IF YES, TELL 'EM NO DICE, NO DELETE
		
		$QueryInterfaces 		= new QueryInterfaces();
		$hasQueryInterface 		= $QueryInterfaces->findQueryInterface($datasourceID);
		
		$content = "";

		$DataSourcesUpdate = new DataSources();
		
		if($hasQueryInterface){
				$content  = "<h4>ERR 104:  This Datasource has Query Interfaces using this Datasource as a resource.";
				$content .= "  Please delete the Query Interfaces or reassign to another Datasource.</h4>";
		}else{
				// IF THERE ARE NO QUERY INTERFACES TIED TO THE SELECTE DATABASE JUST DELETE
				
				$content .= $DataSourcesUpdate->deleteDataSource($datasourceID);				
		}			
		
		echo $content;
}

?>