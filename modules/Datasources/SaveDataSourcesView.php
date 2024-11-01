<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
require_once("../../../../../wp-config.php");
// VIEW FOR SaveDataSourcesView

$datasourceID = $_POST['ds_id'];
$postedData	= receivePostDataSourceFromAJAXData();

SaveDataSourcesView($postedData,$datasourceID);

function SaveDataSourcesView($postedData,$datasourceID)
{
		$DataSources	= new DataSources();
		//$datasource	= $DataSources->getDataSource($datasourceID);		

		//$content = "<h2>XData Toolkit - Save Data Source</h2>";

		$action 		= $postedData['update'];
		$ds_id 			= $postedData['ds_id'];
		$ds_identifier		= $postedData['ds_identifier'];
		
		$ds_type		= $postedData['ds_type'];

		$ds_username		= $postedData['ds_username'];
		$ds_password		= $postedData['ds_password'];
		$ds_host_url		= $postedData['ds_host_url'];
		$ds_name		= $postedData['ds_name'];
		$ds_port		= $postedData['ds_port'];
		
		//echoPostedData($postedData);
		
		$DataSourcesUpdate = new DataSources();
		$datasource[] = null;
		
		$datasource['ds_id']		= $ds_id;
		$datasource['ds_identifier']	= $ds_identifier;
		$datasource['ds_type']		= $ds_type;
		$datasource['ds_username']	= $ds_username;
		$datasource['ds_password']	= $ds_password;
		$datasource['ds_port']		= $ds_port;
		$datasource['ds_host_url']	= $ds_host_url;
		$datasource['ds_name']		= $ds_name;
		//echo "GOT HERE";
		
		if($datasource['ds_id'] == null)
		{
				//echo "<h5>Got To INSERT Data Sources</h5>";
				$content .= $DataSourcesUpdate->insertDataSources($datasource);

		}else{
				//echo "<h5>Got To UPDATE Data Sources</h5>";				
				$content .= $DataSourcesUpdate->updateDataSources($datasource,$ds_id);
				
		}
		
		//$DataSources = new DataSources();		
		//$dataSources = $DataSourcesUpdate->getDataSources();		
		
		//include_once dirname( __FILE__ ) . '/../views/DataSourcesView.php';
		//$content = DataSourcesView($dataSources);		
		
		echo $content;
}
function receivePostDataSourceFromAJAXData()
{
	$postData[] = null;
	
	$postData['update']		= $_POST['update'];
	$IDVal				= null;
	if($_POST['ds_id'])
	{
		$IDVal			= $_POST['ds_id'];
	}
	$postData['ds_id']		= $IDVal;
	$postData['ds_identifier']	= $_POST['ds_identifier'];
	$postData['ds_type']		= $_POST['ds_type'];
	$postData['ds_username']	= $_POST['ds_username'];
	$postData['ds_password']	= $_POST['ds_password'];
	$postData['ds_host_url']	= $_POST['ds_host_url'];
	$postData['ds_port']		= $_POST['ds_port'];
	$postData['ds_name']		= $_POST['ds_name'];
		
	return $postData;		
}
function echoPostedData($postedData)
{
		echo "Update is " . $postedData['update'] . "<br/>";
		echo "DS_ID is " . $postedData['ds_id']. "<br/>";
		echo "DS_IDENTIFIER is " . $postedData['ds_identifier']. "<br/>";
		
		echo "DS_TYPE is " . $postedData['ds_type']. "<br/>";

		echo "DS_USERNAME is " . $postedData['ds_username']. "<br/>";
		echo "DS_PASSWORD is " . $postedData['ds_password']. "<br/>";
		echo "DS_HOST_URL is " . $postedData['ds_host_url']. "<br/>";
		echo "DS_NAME is " . $postedData['ds_name']. "<br/>";
		echo "DS_PORT is " . $postedData['ds_port']. "<br/>";
		
		echo $postedData;
}
?>