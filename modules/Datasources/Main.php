<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';
// Controller Class Defines Flow of Operation for DataSources

function ListDataSources()
{
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%">';		
	showView();
	echo '</div>';
	
}
function showView()
{
	$DataSources = new DataSources();
		
	$colName   = $_POST['sortBy'];		
	if($colName == null || $colName == "")
	{	$colName = "ds_id";}
		
	$datasources 	= $DataSources->getDataSourcesSorted($colName);
		
	include_once dirname( __FILE__ ) . '/../../modules/Datasources/DataSourcesView.php';
	$content = DataSourcesView($datasources);	
	
}
?>