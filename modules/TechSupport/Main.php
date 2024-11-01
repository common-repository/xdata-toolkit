<?php
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';

// Controller Class Defines Flow of Operation for Tech Support

function TechSupport()
{
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%">';		
	showTSView();
	echo '</div>';
	
}
function showTSView()
{		
	include_once dirname( __FILE__ ) . '/../../modules/TechSupport/TechSupportView.php';
	$content = TechSupportView();	
	
}
?>