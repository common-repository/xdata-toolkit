<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../models/DataSourceTypes.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR DataSourcesView

function DataSourcesView($datasources)
{

	// Load CSS Files
	//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';
	
        //$ssURL		= plugins_url() . "/xdata-toolkit/modules/Datasources/css/style.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$ssURL.'" TYPE="text/css" MEDIA="screen">';
	
	// Load JavaScript Functions
        $jsURL		= plugins_url() . "/xdata-toolkit/modules/Datasources/js/functions.js";
        $jsTestDBCURL		= plugins_url() . "/xdata-toolkit/modules/Datasources/js/testDatabaseConnection.js";	
        $content .= '<script src="'.$jsURL.'">';
        $content .= '</script>';
	$content .= '<script src="'.$jsTestDBCURL.'">';
	$content .= '</script>';
	
	// Pre-Defined Images
	$functionImage 	= plugins_url() . "/xdata-toolkit/images/dataSource.png";
	$editURL 	= plugins_url() . "/xdata-toolkit/modules/Datasources/EditDataSourcesView.php";
	$saveURL 	= plugins_url() . "/xdata-toolkit/modules/Datasources/SaveDataSourcesView.php";
	$registerURL 	= plugins_url() . "/xdata-toolkit/modules/Datasources/RegisterDataSourcesView.php";
	$deleteURL 	= plugins_url() . "/xdata-toolkit/modules/Datasources/DeleteDataSourcesView.php";
	$viewProfileURL = plugins_url() . "/xdata-toolkit/modules/Datasources/viewProfile.php";				
        $imageBaseURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/images/";	
	
	$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>XData Toolkit - Datasources</h2>";
	$content .= "</div></div>";
	
		$content .= '<div id="progressDiv"><img src="'.$imageBaseURL.'ajax-loader.gif" /></div>';			
	
		$content .= '<div id="tabvanilla" class="xdata-widget">';
		
		$content .= '<ul class="tabnav" class="xdata-widget">';
		$content .= '<li><a href="#panelOne">Datasources</a></li>';
		$content .= '<li><a href="#panelTwo">Edit Datasource</a></li>';
		$content .= '<li><a href="#panelThree">Datasource Profile</a></li>';
		$content .= '<li><a href="#panelFour">Datasource Source</a></li>';				
		$content .= '<li><a href="#panelFive" onClick="register()"><strong>+</strong></a></li>';				
		$content .= '</ul>';
				
		
		$content .= '<div id="panelOne" class="tabdiv">';
		
		$content .= '<script type="text/javascript">';
		$content .= 'function sort(colName)';
		$content .= '{';
		$content .= '	document.getElementById("sortBy").value = colName;';
		$content .= '	document.getElementById("update").value = "View";';		
		$content .= '	document.forms["myform"].submit();';
		$content .= '}';
		$content .= '</script>';		
	
		$content .= '<form method="post" id="myform" action="'. $_SERVER["REQUEST_URI"] . '">';
		$editDropDown = deleteEditListItem();
			
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= printListTableHeader();
		
		$content .= '<input type="hidden" name="sortBy" id="sortBy" value="ds_id"/>';
		$content .= '<input type="hidden" name="update" id="update" value=""/>';
		$content .= '<input type="hidden" name="itemToModify" id="itemToModify" value=""/>';
		$content .= '<input type="hidden" name="editURL" id="editURL" value="'.$editURL.'"/>';		
		$content .= '<input type="hidden" name="saveURL" id="saveURL" value="'.$saveURL.'"/>';
		$content .= '<input type="hidden" name="registerURL" id="registerURL" value="'.$registerURL.'"/>';
		$content .= '<input type="hidden" name="deleteURL" id="deleteURL" value="'.$deleteURL.'"/>';
		$content .= '<input type="hidden" name="viewProfileURL" id="viewProfileURL" value="'.$viewProfileURL.'"/>';
		$content .= '<input type="hidden" name="plugin_url" id="plugin_url" value="'.plugins_url().'"/>';		                
		
		$content .= '<thead><tr bgcolor="silver">';
		$content .= '<th></th>';
		
		$content .= "<th><a href='#' onClick='sort(\"ds_id\"); return false;'>ID</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"ds_identifier\"); return false;'>Name</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"ds_type\"); return false;'>Datasource Type</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"ds_username\"); return false;'>Username</a></th>";
		$content .= '<th>Password</th>';		
		$content .= "<th><a href='#' onClick='sort(\"ds_port\"); return false;'>Port</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"ds_host_url\"); return false;'>Datasource URL</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"ds_name\"); return false;'>Datasource Name</a></th>";				

		$content .= '</tr></thead><tbody>';		
		
		$DataSourceTypes	= new DataSourceTypes();
		$dataSourceTypes  = $DataSourceTypes->getDataSourceTypes();		
		$editImage	= plugins_url() . "/xdata-toolkit/images/edit.png";
		$viewImage	= plugins_url() . "/xdata-toolkit/images/view.png";
		
		foreach($datasources as $datasource){
			$content .= "<tr bgcolor='white' class='highlight'>";
			$content .= '<td style="width: 75px"><a href="#" onClick="edit('. $datasource->ds_id .'); return false;" alt="Edit">';
			
			$content .= '<img src="'.$editImage.'" alt="Edit"/></a>&nbsp;&nbsp;';
			$content .= '<a href="#" onClick="view(\''. $datasource->ds_id .'\'); return false;" alt="View"><img src="'.$viewImage.'" alt="View"/>';
			
			$content .= '</a></td>';
			$content .= "<td>" . $datasource->ds_id . "</td>";
			$content .= "<td style='width: 75px'>" . $datasource->ds_identifier . "</td>";
			
			$dstID 	  	= $datasource->ds_type;
			$dstID		= $dstID - 1;
			
			$datasourceType = $DataSourceTypes->getDataSourceType($dstID);
			$dst_name 	= $datasourceType->ds_type;			
			
			$content .= "<td>" . $dst_name . "</td>";
			$content .= "<td>" . $datasource->ds_username . "</td>";
			$hidden_pass = str_repeat("*",strlen($datasource->ds_password));
			$content .= "<td>" . $hidden_pass . "</td>";
			$content .= "<td align='right'>" . $datasource->ds_port . "</td>";
			
			if($dstID != 0)
			{
				$content .= "<td>";
				$content .= '<a href="#" onClick="viewSource('. $datasource->ds_id .'); return false;" alt="View Datasource Source">';
				$content .= $datasource->ds_host_url;
				$content .= "</a></td>";	
			}else{
				$content .= "<td>" . $datasource->ds_host_url . "</td>";
			}
			
			$content .= "<td>" . $datasource->ds_name . "</td>";
			$content .= "</tr>";
		}

		$content .= '</tbody></table>';
		$content .= '</form>';
		$content .= '</div>';		
		$content .= '<div id="panelTwo" class="tabdiv">';
		$content .= '</div>';
		$content .= '<div id="panelThree" class="tabdiv">';
		$content .= '</div>';
		$content .= '<div id="panelFour" class="tabdiv">';
		$content .= '<textarea name="viewSource" id="viewSource" class="lined" style="width:980px;height:500px" rows="100" cols="100"></textarea>';
		$content .= '</div>';
		$content .= '<div id="panelFive" class="tabdiv">';
		$content .= '</div>';		

		$content .= '</div>';		
		
		echo $content;
}

?>