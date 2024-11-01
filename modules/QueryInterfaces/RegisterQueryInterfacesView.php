<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

RegisterQueryInterfacesView();

function RegisterQueryInterfacesView()
{
	global $wpdb;
	
	$content = printQIJavaScript();

	// Load CSS Files
	//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';

	$functionImage 	= plugins_url() . "/xdata-toolkit/images/queryInterface.png";		
	
	//$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h4>Register Query Interface</h4>";
	//$content .= "</div></div>";

	$content .= '<table width="100%" border="1" class="widefat">';			
	$content .= '<form method="post" name="myform" action="'. $_SERVER["REQUEST_URI"] . '">';
	$content .= '<thead><tr bgcolor="silver"><th>Setting</th><th>Value</th></tr></thead>';			
	$content .= '<tbody><tr style="height: 30px"><td>';
	$content .= '<strong>Query Interface Name (What you call your datasource)</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="qi_name" id="qi_name" size="30" value="">';
	$content .= '</td></tr>';			
	$content .= '<tr style="height: 30px"><td>';			
	$content .= '<strong>Global Variable (What you would reference in shortcodes)</strong>';
	$content .= '</td>';			
					
	$content .= '<td>';		
									
	$content .= '<input type="text" name="qi_global_var" id="qi_global_var" size="30" value="" onKeyUp="buildQIName()">';	
	$content .= '</td>';				
		
	$content .= '</tr>';
	$content .= '<tr style="height: 30px"><td>';			
	$content .= '<strong>Behavior Type</strong>';
	$content .= '</td>';

	$content .= '<td>';
	$fieldName	= 'qi_behavior_type';
	$func		= "zeroOut()";
	$content .= behaviorTypeSelectBox($fieldName,null,null,null,$func);
	$content .= '</td>';	

	$content .= '</tr>';
	$content .= '<tr style="height: 30px"><td>';			
	$content .= '<strong>Caching Frequency</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="qi_cache_freq" id="qi_cache_freq" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr style="height: 30px">';
	$content .= '<td>';			
	$content .= '<strong>Transform</strong>';
	$content .= '</td>';

	/*$qi_tr_ID	= $queryInterface->qi_transform_id;
	
	$transform	= $Transforms->getTransform($qi_tr_ID);
	$tr_name	= $transform->transform_name;*/
	$fieldName	= 'qi_transform_id';
	
	$content .= '<td>';						
	$content .= transformSelectBox($fieldName,null,null,null);					
	/* $content .= '<select name="qi_transform_id">';
	
	
	foreach($transforms as $transform)
	{
			$selected = '';
			if($transform->transform_id == $qi_tr_ID){
					$selected = "selected";
			}
			$content .= '<option value="'.$transform->transform_id.'" '.$selected.'>'.$transform->transform_name.'</option>';								
			
	}
	$content .= "</select>"; */
	$content .= "</td>";

	$content .= '</tr>';
	$content .= '<tr style="height: 30px"><td>';			
	$content .= '<strong>Datasource</strong>';
	$content .= '</td>';

	$content .= '<td>';
	$fieldName	= 'qi_ds_id';
	//$style		= 'width: 300px; height: 300px';	
	$content .= 	dataSourceSelectBox($fieldName,null,null,null);

	//$dsID 	  	= $queryInterface->qi_ds_id;
	//$datasource 	= $DataSources->getDataSources($dstID);
	//$ds_name 	= $datasource->ds_identifier;			
									
	/*$content .= '<select name="qi_ds_id">';

	foreach($dataSources as $dataSource)
	{
			$selected = '';
			if($dsID == $dataSource->ds_id){
					$selected = "selected";
			}
			$content .= '<option value="'.$dataSource->ds_id.'" '.$selected.'>'.$dataSource->ds_identifier.'</option>';		
	}

	$content .= '</select>'; */
	$content .= '</td>';


	$content .= '</tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Query (SQL/XPath/XQuery)</strong>';
	$content .= '</td><td>';			
	$content .= '<textarea name="qi_query" id="qi_query" style="width: 600px;height:100px"></textarea>';
	$content .= '</td></tr>';
	
	$content .= '<tr><td colspan="2">';
	$content .= '<input type="hidden" name="update" value="Save QueryInterface"/>';
	$content .= '<input type="button" class="button-primary" name="Save QueryInterface" value="Save QueryInterface" onClick="saveNewQueryInterface()"/>';
	$content .= '</td></tr>';		
	
	$content .= '</tbody></table>';
	//$content .= '<div class="submit">';
	//$content .= '<input type="hidden" name="update" value="Save Query Interface"><input type="submit" name="submit" value="Save Query Interface" /></div>';
	//$content .= '</form>';
	//$content .= '</div>';
	

	
	echo $content;
		


}
?>