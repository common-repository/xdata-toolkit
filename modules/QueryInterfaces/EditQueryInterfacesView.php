<?php

include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR EditQueryInterfacesView
require_once("../../../../../wp-config.php");
$qiID = $_POST['itemToModify'];
EditQueryInterfacesView($qiID);

function EditQueryInterfacesView($qiID)
{

	// Load CSS Files
	//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';

	$functionImage 	= plugins_url() . "/xdata-toolkit/images/queryInterface.png";		

		$content .= printQIJavaScript();
		$QueryInterfaces = new QueryInterfaces();
		$queryInterface  = $QueryInterfaces->getQueryInterfaceById($qiID);
		
		$content .= "<h2>Edit Query Interface - ".$queryInterface->qi_name."</h2>";
		//$content .= '<form method="post" id="myform" action="'. $_SERVER["REQUEST_URI"] . '">';		
			
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= '';

		$content .= '<thead><tr bgcolor="silver"><th>ID</th><th>Name</th><th>Global Variable</th><th>Behavior Type</th><th>Caching Frequency</th><th>Transform</th><th>Data Source</th></tr></thead><tbody>';
		

		
		
		//if($queryInterface){

				$content .= "<tr bgcolor='white'>";
				$content .= "<td><input type='hidden' name='qi_id' id='qi_id' value='" . $queryInterface->qi_id . "'/>". $queryInterface->qi_id ."</td>";
				$content .= "<td><input type='text' size='15' name='qi_name' id='qi_name' value='" . $queryInterface->qi_name . "'/></td>";				
				$content .= "<td><input type='text' size='15' name='qi_global_var' id='qi_global_var' value='" . $queryInterface->qi_global_var . "'/></td>";
				
				$qiID 	  	= $queryInterface->qi_behavior_type;
				//$behaviorType 	= $BehaviorTypes->getBehaviorType($qiID);
				//$bt_name 	= $behaviorType->bt_name;
				
				$content .= '<td>';
				$fieldName	= 'qi_behavior_type';
				$func		= "zeroOut()";
				$content .= behaviorTypeSelectBox($fieldName,$qiID,null,null,$func);				

				$content .= '</td>';				
				
				$content .= "<td><input type='text' size='6' name='qi_cache_freq' id='qi_cache_freq' value='" . $queryInterface->qi_cache_freq . "'/></td>";
				
				$qi_tr_ID	= $queryInterface->qi_transform_id;
				
				$content .= '<td>';										
				$fieldName	= 'qi_transform_id';
				$content	.= transformSelectBox($fieldName,$qi_tr_ID,null,null);
				$content .= "</td>";
				
				$content .= '<td>';
				$dsID 	  	= $queryInterface->qi_ds_id;
				$fieldName = "qi_ds_id";
				$content .= 	dataSourceSelectBox($fieldName,$dsID,null,null);
				$content .= '</td>';				
				
				$content .= "</tr>";
				$content .= "<tr>";
				$content .= "<td>Query</td>";
				$content .= "<td colspan='6'>";
				$content .= '<textarea name="qi_query" id="qi_query" style="width:961px;height:300 px">';
				$content .= $queryInterface->qi_query;
				$content .= "</textarea>";
				$content .= "</td>";				

				$content .= "</tr>";
		// }
		//$content .= '<tr><td colspan="7"><input type="hidden" name="update" value="Save Query Interface"/><input type="submit" name="submit" value="Save Query Interface"/></td></tr>';
		$content .= '<tr><td colspan="2">';
		$content .= '<input type="hidden" name="update" value="Save QueryInterface"/>';
		$content .= '<input type="button" class="button-primary" name="Save QueryInterface" value="Save QueryInterface" onClick="saveQueryInterface()"/>';
		$content .= '<input type="button" class="button-primary" name="Delete QueryInterface" value="Delete QueryInterface" onClick="deleteQI()"/>';
		$content .= '</td></tr>';		
		$content .= '</tbody></table>';
		//$content .= '</form>';
		
		echo $content;
}

?>