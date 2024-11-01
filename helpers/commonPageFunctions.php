<?php


function commonFunctions()
{
	// Load CSS Files
	
	global $wp_version;
	$cssThreeURL = null;
	
	if($wp_version < 3.3){
		$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles-3.2.1.css";
	}
	if($wp_version >= 3.3){
		$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles-3.3.css";
	}
		
		$jsURL		= plugins_url() . "/xdata-toolkit/modules/TransformStudio/js/transformStudio.js";
		$dfURL		= plugins_url() . "/xdata-toolkit/modules/TransformStudio/js/diskFunctions.js";
		$laURL		= plugins_url() . "/xdata-toolkit/modules/TransformStudio/js/jquery-linedtextarea.js";
		$ssURL		= plugins_url() . "/xdata-toolkit/modules/TransformStudio/css/style.css";
		$lassURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/css/jquery-linedtextarea.css";
		$cpcssURL 	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/colorpicker/css/colorpicker.css";		
		$cpURL		= plugins_url() . "/xdata-toolkit/modules/TransformStudio/colorpicker/js/colorpicker.js";
		
		$content .= '<LINK REL="StyleSheet" HREF="'.$cpcssURL.'" TYPE="text/css" MEDIA="screen">';		
		$content .= '<LINK REL="StyleSheet" HREF="'.$ssURL.'" TYPE="text/css" MEDIA="screen">';
		$content .= '<LINK REL="StyleSheet" HREF="'.$lassURL.'" TYPE="text/css" MEDIA="screen">';		

		$content .= '<script src="'.$jsURL.'">';
		$content .= '</script>';
		$content .= '<script src="'.$dfURL.'">';
		$content .= '</script>';		
		$content .= '<script src="'.$cpURL.'">';
		$content .= '</script>';
		$content .= '<script src="'.$laURL.'">';
		$content .= '</script>';	

		// Load CSS Files
		//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
		$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';	
	
		$functionImage 	= plugins_url() . "/xdata-toolkit/images/transform.png";
		$editImage	= plugins_url() . "/xdata-toolkit/images/edit.png";
		$viewImage	= plugins_url() . "/xdata-toolkit/images/view.png";	
	
	
        echo $content;
}
?>