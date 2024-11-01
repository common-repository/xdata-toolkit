<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

RegisterTransformsView();

function RegisterTransformsView()
{
	global $wpdb;
			
	$content = '';

	$content .= "<h2>Register Transform - Generate Stylesheet</h2>";
	$content .= '<form method="post" name="myRegisterTransformsForm" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';
	$content .= '<table width="100%" border="1" class="widefat">';			
	
	$content .= '<input type="hidden" name="g_transform_id" size="30" value="">';
	$content .= '<thead><tr bgcolor="silver"><th>Setting</th><th>Value</th></tr></thead>';			
	$content .= '<tbody><tr><td>';
	$content .= '<strong>Transform Name</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="g_transform_name" id="g_transform_name" size="30" value="" onKeyUp="buildFileName()">';
	$content .= '</td></tr>';
	$content .= '<tbody><tr><td>';
	$content .= '<strong>Transform File Name (Include .xsl extension)</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="g_transform_file_name" id="g_transform_file_name" size="30" value="">';
	$content .= '</td></tr>';		
	$content .= '<tr><td>';			
	$content .= '<strong>Query Interface/XML Source from which to generate stylesheet:</strong>';
	$content .= '</td>';
	$content .= '<td>';
	$content .= '<select name="g_queryInterface" id="g_queryInterface">';
		
	$QueryInterfaces = new QueryInterfaces();		
	$queryInterfaces = $QueryInterfaces->getQueryInterfaces();
		
	foreach($queryInterfaces as $queryInterface)
	{
		$content .= '<option value="'.$queryInterface->qi_global_var.'">';
		$content .= $queryInterface->qi_global_var;
		$content .= '</option>';
	}
	$content .= '</select>';
	$content .= '<input type="button" class="button-primary" name="Generate Stylesheet" value="Generate Stylesheet" onClick="genStylesheet()"/>';
	$content .= '<input type="button" class="button-primary" name="Save Stylesheet" value="Save Stylesheet" onClick="saveGenTransformDoc()"/>';			
	$content .= '</td>';		
	$content .= '</tr>';	
	$content .= '<tr>';				
	$content .= '<td colspan="2">';
	$content .= '<textarea name="g_xsldata" id="g_xsldata" class="lined" style="width:960px;height:500px" rows="100" cols="90"></textarea>';
	$content .= '<script>';
	$content .= '$(function() {';
	$content .= '	$(".lined").linedtextarea(';
	$content .= '		{selectedLine: 1}';
	$content .= '	);';
	$content .= '});';
	$content .= '</script>	';
	$content .= '</td>';				
		
	$content .= '</tr>';			
	$content .= '</tbody></table>';		
	$content .= '</form>';
	
	echo $content;
}
?>