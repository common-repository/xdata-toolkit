<?php

require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
//include_once dirname( __FILE__ ) . '/../models/DataSourceTypes.php';
// VIEW FOR EditDataSourcesView

$datasourceID = $_POST['itemToModify'];
//echo "Datasource ID is ".$datasourceID;

EditDataSourcesView($datasourceID);

function EditDataSourcesView($datasourceID)
{
		//echo "Datasource ID at EditDataSourcesView is ".$datasourceID;
		$DataSources	= new DataSources();
		$datasource	= $DataSources->getDataSourceById($datasourceID);

			// Load CSS Files
		//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
		//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';
		
		$functionImage 	= plugins_url() . "/xdata-toolkit/images/dataSource.png";		
			
		//$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
		//$content .= "<h2>XData Toolkit - Edit Data Source</h2>";
		//$content .= "</div></div>";
	
		$content .= '<form method="post" id="editForm" action="'. $_SERVER["REQUEST_URI"] . '">';		
			
		$content .= "<h2>Editing Data Source - ".$datasource->ds_identifier."</h2>";			
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= '';
		$content .= '<thead><tr bgcolor="silver">';
		$content .= '<th>Setting</th>';
		$content .= '<th>Value</th>';
		$content .= '</tr></thead><tbody>';
				

		$content .= "<tr>";
		$content .= "<tr><td>ID</td><td><input type='hidden' name='ds_id' id='ds_id' value='" . $datasource->ds_id . "'/>". $datasource->ds_id ."</td></tr>";
		$content .= "<tr><td>Name</td><td><input type='text' size='30' name='ds_identifier' id='ds_identifier' value='" . $datasource->ds_identifier . "'/></td></tr>";
		$content .= '<tr><td>Datasource Type</td><td>';
				
		$dstID 	  	= $datasource->ds_type;
		$fieldName	= 'ds_type';
				
		$content	.= dataSourceTypeSelectBox($fieldName,$dstID,null,null);

		$content .= '</td></tr>';				

		$content .= "<tr><td>Username</td><td><input type='text' size='30' name='ds_username' id='ds_username' value='" . $datasource->ds_username . "'/></td></tr>";
		$content .= "<tr><td>Password</td><td><input type='text' size='30' name='ds_password' id='ds_password' value='" . $datasource->ds_password . "'/></td></tr>";
		$content .= "<tr><td>Port</td><td><input type='text' size='6' name='ds_port' id='ds_port' value='" . $datasource->ds_port . "'/></td></tr>";
		$content .= "<tr><td>Datasource URL</td><td><input type='text' size='30' name='ds_host_url' id='ds_host_url' value='" . $datasource->ds_host_url . "'/></td></tr>";		
		$content .= "<tr><td>Datasource Name</td><td><input type='text' size='30' name='ds_name' id='ds_name' value='" . $datasource->ds_name . "'/></td></tr>";

		$content .= '<tr><td colspan="2">';
		$content .= '<input type="hidden" name="update" value="Save DataSource"/>';
		$content .= '<input type="button" class="button-primary" name="Save DataSource" value="Save DataSource" onClick="saveDataSource()"/>';
		$content .= '<input type="button" class="button-primary" name="Delete DataSource" value="Delete DataSource" onClick="deleteDS()"/>';
		$content .= '</td></tr>';
		$content .= '</tbody></table>';
		$content .= '</form>';
		
		echo $content;
}

?>