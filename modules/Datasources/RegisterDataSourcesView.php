<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../models/DataSourceTypes.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

RegisterDataSourcesView();

function RegisterDataSourcesView()
{
	
	$content = '';

	// Load CSS Files
	//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';

	$functionImage 	= plugins_url() . "/xdata-toolkit/images/dataSource.png";		
	
	//$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>Register Data Source</h2>";
	//$content .= "</div></div>";

	$content .= '<table width="100%" border="1" class="widefat">';			
	$content .= '<script type="text/javascript">';
	$content .= 'function selectDataSourceType(ds_type_val)';
	$content .= '{';
	$content .= '	if(ds_type_val == 1){';
	$content .= '		document.getElementById("DSUsername").innerHTML = 	"Datasource Username";';
	$content .= '		document.getElementById("DSPassword").innerHTML = 	"Datasource Password";';
	$content .= '		document.getElementById("DSHostURL").innerHTML =  	"Datasource Host URL";';
	$content .= '		document.getElementById("DSNameLabel").innerHTML =     	"Datasource Name (Actual Database Name)";';
	$content .= '		document.getElementById("DSName").value =     		"";';						
	$content .= '	 }else{';
	$content .= '		document.getElementById("DSUsername").innerHTML = 	"HTTP AUTH Username";';
	$content .= '		document.getElementById("DSPassword").innerHTML = 	"HTTP AUTH Password";';
	$content .= '		document.getElementById("DSHostURL").innerHTML =  	"XML Source URL";';
	$content .= '		document.getElementById("DSNameLabel").innerHTML =     	"Datasource Name (Not Applicable for XML Source)";';
	$content .= '		document.getElementById("DSName").value =     		"Not Applicable";';									
	$content .= '	  }';
	$content .= '}';
	$content .= '</script>';

	$content .= '<input type="hidden" name="ds_id" id="ds_id" >';	
	$content .= '<thead><tr bgcolor="silver"><th>Setting</th><th>Value</th></tr></thead>';			
	$content .= '<tbody><tr><td>';
	$content .= '<strong>Datasource Identifier (What you call your datasource)</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_identifier" id="ds_identifier" size="30">';
	$content .= '</td></tr>';			
	$content .= '<tr><td>';			
	$content .= '<strong>Datasource Type</strong>';
	$content .= '</td>';			
	
	$content .= '<td>';		
	
	$fieldName	= 'ds_type';
	$content	.= dataSourceTypeSelectBox($fieldName,null,null,null);
	
	$content .= '</td>';				
	
	
	$content .= '</tr>';
	$content .= '<tr><td>';			
	$content .= '<strong id="DSUsername">Datasource Username</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_username" id="ds_username" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong id="DSPassword">Datasource Password</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_password" id="ds_password" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Datasource Port</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_port" id="ds_port" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong ID="DSHostURL">Datasource Host URL</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_host_url" id="ds_host_url" size="80">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong ID="DSNameLabel">Datasource Name (Actual Database Name)</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="ds_name" id="ds_name" size="80">';
	$content .= '</td></tr>';			
	$content .= '</tbody></table>';
	$content .= '<div class="submit">';
	$content .= '<input type="button" class="button-primary" name="testConnection" value="Test Connection" onClick="testDatabaseConnection()"/>'; //<input type="hidden" name="update" value="Save DataSource"><input type="submit" name="submit" id="sds" value="Save Data Source" disabled="disabled" /></div>';
	$content .= '<input type="hidden" name="update" value="Save DataSource"/>';
	$content .= '<input type="button" class="button-primary" name="Save DataSource" value="Save DataSource" onClick="saveNewDataSource()"/>';
	
	$content .= '</div>';	
	
	echo $content;
		


}
?>