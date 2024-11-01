<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

require_once("../../../../../wp-config.php");
require_once("../../../../../wp-admin/includes/plugin.php");

$tfn        = stripslashes(nl2br($_POST['transform_file_name']));
$tn         = stripslashes(nl2br($_POST['transform_name']));
$xsl        = stripslashes(nl2br($_POST['xsldata']));
$qi	    = $_POST['queryInterface'];

$badStuff   = array("<br />");
$goodStuff  = array("");
$xsldata    = str_replace($badStuff,$goodStuff,$xsl);

saveGenDoc($tfn,$tn,$xsldata,$qi);

function saveGenDoc($tfn,$tn,$xsldata,$qi)
{
	
	$content = "";
	$TransformsUpdate = new Transforms();
	$transform[] = null;
		
	$transform['transform_name']	= $tn;
        $transform['transform_file']    = $tfn;

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
	
        $file = $clientTransformsDir.$tfn;
        if(file_put_contents($file, $xsldata))
        {
	    $content .= $TransformsUpdate->insertTransforms($transform);
	    $content .= attachTransformToQI($qi);
            
        }else
        {
            $content .= "Unable to Save Document.";
        }

	echo $content;
}

function attachTransformToQI($qi)
{
	global $wpdb;
	
	$transforms_table_name 	= $wpdb->prefix . "xdata_transforms";
	$idName 		= "transform_id";
	$nID 			= getMaxID($transforms_table_name,$idName);
	
	$QueryInterfaces 	= new QueryInterfaces();
	$content		.= $QueryInterfaces->updateTransformToQueryInterface($qi,$nID);
	
	//return $content;
}

?>