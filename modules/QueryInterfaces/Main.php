<?php

include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';
// Controller Class Defines Flow of Operation for Query Interfaces

function ListQueryInterfaces()
{	
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%">';
	showQIView();
	echo '</div>';

	
}
function showQIView()
{
		$QueryInterfaces = new QueryInterfaces();
		
		$colName   = $_POST['sortBy'];		
		if($colName == null || $colName == "")
		{	$colName = "qi_id";}
		
		$queryInterfaces 	= $QueryInterfaces->getQueryInterfacesSorted($colName);
		
		include_once dirname( __FILE__ ) . '/../../modules/QueryInterfaces/QueryInterfacesView.php';
		$content = QueryInterfacesView($queryInterfaces);	
}

function receivePostQueryInterfaceData()
{
	$postData[] = null;
	
	$postData['update']		= $_POST['update'];
	$IDVal				= null;
	if($_POST['qi_id'])
	{
		$IDVal			= $_POST['qi_id'];
	}
	$postData['qi_id']		= $IDVal;	
	$postData['qi_name']		= $_POST['qi_name'];
	$postData['qi_global_var']	= $_POST['qi_global_var'];
	$postData['qi_behavior_type']	= $_POST['qi_behavior_type'];
	$postData['qi_cache_freq']	= $_POST['qi_cache_freq'];
	$postData['qi_transform_id']	= $_POST['qi_transform_id'];	
	$postData['qi_ds_id']		= $_POST['qi_ds_id'];
	$postData['qi_query']		= $_POST['qi_query'];
	
	return $postData;		
}
?>