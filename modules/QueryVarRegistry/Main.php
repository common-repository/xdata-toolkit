<?php
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';

// Controller Class Defines Flow of Operation for Query Variable Registry

function QueryVarRegistry()
{
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%">';		
	showQVRView();
	echo '</div>';
	
}
function showQVRView()
{		
	include_once dirname( __FILE__ ) . '/../../modules/QueryVarRegistry/QueryRegistryView.php';
	$content = QueryRegistryView();	
	
}
?>