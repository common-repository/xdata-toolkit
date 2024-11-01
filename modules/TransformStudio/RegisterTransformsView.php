<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

RegisterTransformsView();

function RegisterTransformsView()
{
	global $wpdb;
			
	$content = '';

	$content .= "<h2>Register Transform</h2>";
	$content .= '<form method="post" name="myRegisterTransformsForm" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';
	$content .= '<table width="100%" border="1" class="widefat">';			
	
	$content .= '<input type="hidden" name="e_transform_id" size="30" value="">';
	$content .= '<thead><tr bgcolor="silver"><th>Setting</th><th>Value</th></tr></thead>';			
	$content .= '<tbody><tr><td>';
	$content .= '<strong>Transform Name</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="e_transform_name" size="30" value="">';
	$content .= '</td></tr>';			
	$content .= '<tr><td>';			
	$content .= '<strong>Transform File</strong>';
	$content .= '</td>';			
					
	$content .= '<td>';		
	$content .= '<input type="file" name="e_transform_file" id="e_transform_file" />';								
	$content .= '</td>';				
		
	$content .= '</tr>';			
	$content .= '</tbody></table>';
	$content .= '<div class="submit">';
	$content .= '<input type="hidden" name="update" value="Save Transform"/>';
	$content .= '<input type="button" class="button-primary" name="Save Transform" value="Save Transform" onClick="saveNewTransform()"/>';

	$content .= '</div>';		
	$content .= '</form>';
	
	echo $content;
}
?>