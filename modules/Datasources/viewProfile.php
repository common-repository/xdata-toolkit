<?php

require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
//include_once dirname( __FILE__ ) . '/../../models/QuerySchedules.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
//include_once dirname( __FILE__ ) . '/../models/DataSourceTypes.php';
// VIEW FOR EditDataSourcesView

$datasourceID = $_POST['itemToModify'];
//echo "Datasource ID is ".$datasourceID;

viewProfile($datasourceID);

function viewProfile($datasourceID)
{
		//echo "Datasource ID at EditDataSourcesView is ".$datasourceID;
		$DataSources	= new DataSources();
		$datasource	= $DataSources->getDataSourceById($datasourceID);

			// Load CSS Files
		//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
		//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';
		
		$functionImage 	= plugins_url() . "/xdata-toolkit/images/dataSource.png";
		$typeImage	= plugins_url() . "/xdata-toolkit/images/".returnImageTypeIcon($datasource->ds_type);
	
		$content .= '<form method="post" id="viewForm" action="'. $_SERVER["REQUEST_URI"] . '">';		
			
		$content .= "<h2>Data Source Profile - ".$datasource->ds_identifier."</h2>";			
		$content .= '<div id="dsTypeIcon"><img src="'.$typeImage.'" id="imageType"/></div>';
		$content .= '<div id="dsTitle">'. $datasource->ds_identifier .'</div>';
		
		$dstID 	  	= $datasource->ds_type;
		$dstID		= $dstID - 1;
		
		$content .= '<div id="dsURLHostDB">';
		
		if($dstID != 0)
		{
				$content .= "<a href='#' onClick='viewSource(\"". $datasourceID ."\"); return false;' alt='View Datasource Source'>";
				$content .= $datasource->ds_host_url . ':'.$datasource->ds_port.'://'.$datasource->ds_name;
				$content .= "</a>";
		}else{
				$content .= $datasource->ds_host_url . ':'.$datasource->ds_port.'://'.$datasource->ds_name;
		}
		$content .='</div>';		
		$content .= '<div id="dsUsername">'. $datasource->ds_username .'</div>';
		$content .= '<div>';
		

		
		$content .= '<div id="panelDependencies">';
		$content .= '<div id="panelTitle">Dependencies</div>';
		$content .= '<div id="panelBody">';
		$content .= '<h5>&nbsp;&nbsp;Query Interfaces</h5><ul>';
		$QueryInterfaces = new QueryInterfaces();
		$queryInterfaces  = $QueryInterfaces->findTiedQueryInterfaces($datasourceID);
		foreach($queryInterfaces as $queryInterface)
		{
				$content .= "<li>".$queryInterface->qi_name . "</li>";
		}
		$content .= '</ul>';
		$content .= '<h5>&nbsp;&nbsp;Transforms</h5><ul>';
		$Transforms = new Transforms();
		$transforms  = $Transforms->findTiedTransforms($datasourceID);
		foreach($transforms as $transform)
		{
				if($transform->transform_name == "No Transform")
				{}else{
						$content .= "<li>".$transform->transform_name . "</li>";
				}
		}
		$content .= '</ul>';		
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div id="panelPerformance">';
		$content .= '<div id="panelTitle">Performance</div>';
		$content .= '<div id="panelBody">Only available in professional version.</div>';
		$content .= '</div>';
		$content .= '<div id="panelSchedules">';
		$content .= '<div id="panelTitle">Query Schedules</div>';
		$content .= '<div id="panelBody">';
		
		
		$content .= 'Only available in professional version.';

		
		$content .= '</div>';
		$content .= '</div>';
		$content .= '<div id="panelLogging">';
		$content .= '<div id="panelTitle">Logging</div>';
		$content .= '<div id="panelBody">Only available in professional version.</div>';
		$content .= '</div>';
		

		$content .= '</div>';
			
		$content .= '</form>';
		
		echo $content;
}

function returnImageTypeIcon($imageType)
{
switch ($imageType) {
    case 1:
        return "mysql.png";
        break;
    case 2:
        return "text-xml.png";
        break;
    case 3:
        return "webservice.png";
        break;
    case 4:
        return "rss.png";
        break;
    case 5:
        return "text-csv.png";
        break;
}
}
?>