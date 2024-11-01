<?php

include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../models/BehaviorTypes.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR QueryInterfacesView

function QueryInterfacesView($queryInterfaces)
{
	// Load JavaScript Functions
        $jsURL		= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/js/functions.js";
        $content .= '<script src="'.$jsURL.'">';
        $content .= '</script>';

	$functionImage 	= plugins_url() . "/xdata-toolkit/images/queryInterface.png";		
	
	$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>XData Toolkit - QueryStudio</h2>";
	$content .= "</div></div>";	
	
	// Pre-Defined Images
	$functionImage 			= plugins_url() . "/xdata-toolkit/images/dataSource.png";
	$editURL 			= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/EditQueryInterfacesView.php";
	$saveURL 			= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/SaveQueryInterfacesView.php";
	$registerURL 			= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/RegisterQueryInterfacesView.php";
	$deleteURL 			= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/DeleteQueryInterfacesView.php";
	$queryBuilderURL		= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/QueryBuilderView.php";
	$selectDataSourceTablesURL	= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/SelectDataSourceTablesView.php";  
	$selectFieldsURL		= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/SelectFieldsView.php";
	$reviewSQLURL			= plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/getSQLResults.php";	
	
	$viewProfileURL = plugins_url() . "/xdata-toolkit/modules/QueryInterfaces/viewProfile.php";
	
		$editImage	= plugins_url() . "/xdata-toolkit/images/edit.png";
		$viewImage	= plugins_url() . "/xdata-toolkit/images/view.png";
		$downloadImage  = plugins_url() . "/xdata-toolkit/images/download.png";
		
        //$imageBaseURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/images/";	
	
		$content .= '<form method="post" id="myform" action="'. $_SERVER["REQUEST_URI"] . '">';	
		$content .= '<div id="progressDiv"><img src="'.$imageBaseURL.'ajax-loader.gif" /></div>';			
	
		$content .= '<div id="tabvanilla" class="xdata-widget">';
		
		$content .= '<ul class="tabnav" class="xdata-widget">';
		$content .= '<li><a href="#panelOne">Query Interfaces</a></li>';
		$content .= '<li><a href="#panelTwo">Edit Query Interface</a></li>';
		$content .= '<li><a href="#panelThree" onClick="queryBuilder()">Dynamic Query Interface Builder</a></li>';
		$content .= '<li><a href="#panelFour">View Query Interface</a></li>';		
		$content .= '<li><a href="#panelFive" onClick="register()"><strong>+</strong></a></li>';				
		$content .= '</ul>';
	

		
		$content .= '<input type="hidden" name="sortBy" id="sortBy" value="qi_id"/>';
		$content .= '<input type="hidden" name="update" id="update" value=""/>';
		$content .= '<input type="hidden" name="itemToModify" id="itemToModify" value=""/>';
		$content .= '<input type="hidden" name="editURL" id="editURL" value="'.$editURL.'"/>';		
		$content .= '<input type="hidden" name="saveURL" id="saveURL" value="'.$saveURL.'"/>';
		$content .= '<input type="hidden" name="registerURL" id="registerURL" value="'.$registerURL.'"/>';
		$content .= '<input type="hidden" name="deleteURL" id="deleteURL" value="'.$deleteURL.'"/>';
		$content .= '<input type="hidden" name="plugin_url" id="plugin_url" value="'.plugins_url().'"/>';		
		$content .= '<input type="hidden" name="queryBuilderURL" id="queryBuilderURL" value="'.$queryBuilderURL.'"/>';
		$content .= '<input type="hidden" name="selectDataSourceTablesURL" id="selectDataSourceTablesURL" value="'.$selectDataSourceTablesURL.'"/>';  
		$content .= '<input type="hidden" name="selectFieldsURL" id="selectFieldsURL" value="'.$selectFieldsURL.'"/>';
		$content .= '<input type="hidden" name="reviewSQLURL" id="reviewSQLURL" value="'.$reviewSQLURL.'"/>';
		$content .= '<input type="hidden" name="viewProfileURL" id="viewProfileURL" value="'.$viewProfileURL.'"/>';		
		$content .= '<div id="panelOne" class="tabdiv">';		
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= '<thead><tr bgcolor="silver"><th></th>';
		
		$content .= "<th><a href='#' onClick='sort(\"qi_id\"); return false;'>ID</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_name\"); return false;'>Name</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_global_var\"); return false;'>Global Variable</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_behavior_type\"); return false;'>Behavior Type</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_cache_freq\"); return false;'>Caching Frequency</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_transform_id\"); return false;'>Transform</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"qi_ds_id\"); return false;'>Data Source</a></th>";
		
		$content .= '<th>Query</th></tr></thead><tbody>';
		
		
		$BehaviorTypes	= new BehaviorTypes();
		$behaviorTypes  = $BehaviorTypes->getBehaviorTypes();
		
		$DataSources	= new DataSources();
		$dataSources	= $DataSources->getDataSources();
		
		$Transforms	= new Transforms();
		$transforms	= $Transforms->getTransforms();
		
		foreach($queryInterfaces as $queryInterface){
			$content .= "<tr bgcolor='white' class='highlight'>";
			$content .= '<td style="width: 75px"><a href="#" onClick="edit('. $queryInterface->qi_id .'); return false;" alt="Edit">';
			
			$content .= '<img src="'.$editImage.'" alt="Edit"/></a>&nbsp;&nbsp;';
			$content .= '<a href="#" onClick="view(\''. $queryInterface->qi_global_var .'\'); return false;" alt="View"><img src="'.$viewImage.'" alt="View"/></a>&nbsp;&nbsp;';
			$content .= '<a href="#" onClick="downloadFile(\''. $queryInterface->qi_global_var .'\'); return false;" alt="Download"><img src="'.$downloadImage.'" alt="View"/></a>';			
			$content .= '</td>';
			$content .= "<td>" . $queryInterface->qi_id . "</td>";
			$content .= "<td>" . $queryInterface->qi_name . "</td>";
			$content .= "<td>" . $queryInterface->qi_global_var . "</td>";
			
			$qiID 	  	= $queryInterface->qi_behavior_type;
			$behaviorType 	= $BehaviorTypes->getBehaviorType($qiID);
			$bt_name 	= $behaviorType->bt_name;
			
			$content .= "<td>" . $bt_name . "</td>";
			
			$content .= "<td>" . $queryInterface->qi_cache_freq . "</td>";
			
			$qi_tr_ID	= $queryInterface->qi_transform_id;
			//$qi_tr_ID	= $qi_tr_ID - 1;
			
			$transform	= $Transforms->getTransform($qi_tr_ID);
			$tr_name	= $transform->transform_name;
			//if($tr_name == null){
				//$tr_name = "No Transform";
			//}
			$content .= "<td>" . $tr_name . "</td>";
			
			$dsID		= $queryInterface->qi_ds_id;
			$ds_name	= dataSourceSelected($dsID);
			$content .= "<td>" . $ds_name . "</td>";
			$content .= "<td>" . $queryInterface->qi_query . "</td>";
			$content .= "</tr>";
		} 
		$content .= '</tbody></table>';
		$content .= '</div>';
		$content .= '<div id="panelTwo" class="tabdiv">';				
		$content .= '</div>';
		$content .= '<div id="panelThree" class="tabdiv">';
		$content .= '</div>';
		$content .= '<div id="panelFour" class="tabdiv">';
		$content .= '<textarea name="viewSource" id="viewSource" class="lined" style="width:980px;height:500px" rows="100" cols="100"></textarea>';
		//$content .= '<iframe id="viewSource" width="1000" height="700" style="width: 1000px;height: 700px"></iframe>';		
		$content .= '</div>';
		$content .= '<div id="panelFive" class="tabdiv">';
		$content .= '</div>';
		$content .= '</form>';		
		echo $content;
}

?>