<?php
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';

// Controller Class Defines Flow of Operation for Documentation

function Documentation()
{
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%;height:100%">';		
	showDocumentationView();
	echo '</div>';
	
}
function showDocumentationView()
{		
	include_once dirname( __FILE__ ) . '/../../modules/Documentation/DocumentationView.php';
	$content = DocumentationView();	
	
}
?>