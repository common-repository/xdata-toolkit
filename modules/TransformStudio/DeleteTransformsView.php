<?php

include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");
require_once("../../../../../wp-admin/includes/plugin.php");

// VIEW FOR DeleteTransformsView

$transformID = $_POST['e_transform_id'];
$transformFile = $_POST['e_transform_file'];
DeleteTransformsView($transformID,$transformFile);

function DeleteTransformsView($transformID,$transformFile)
{		
		$TransformsUpdate = new Transforms();
		$content .= $TransformsUpdate->deleteTransform($transformID);
	
		// variables for the field and option names 
		$option2 = 'xdata_upload_dir';
	
		// Read in existing option's values from database
		$xud		= get_option($option2);
	
		$clientTransformsDir 	= "";
		if($xud == "")
		{
			$clientTransformsDir	= dirname( __FILE__ ) . "/../../transforms/client/";
		}else{
			$clientTransformsDir	= dirname( __FILE__ ) . $xud;
		}										
		
		$tFile = $clientTransformsDir . $transformFile;
		
		if (file_exists($tFile))
		{
		   unlink($tFile);
		}		
		
		echo $content;
}

?>