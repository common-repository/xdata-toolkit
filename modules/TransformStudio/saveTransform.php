<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

require_once("../../../../../wp-config.php");
require_once("../../../../../wp-admin/includes/plugin.php");

$tfn        = stripslashes(nl2br($_POST['transform_file_name']));
$tn         = stripslashes(nl2br($_POST['transform_name']));
$xsl        = stripslashes(nl2br($_POST['xsldata']));

$badStuff   = array("<br />");
$goodStuff  = array("");
$xsldata    = str_replace($badStuff,$goodStuff,$xsl);

//echo "GOT HERE!";
saveDoc($tfn,$tn,$xsldata);

function saveDoc($tfn,$tn,$xsldata)
{
	
	$content = "";

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
            $content .= "Document Successfully Saved.";
        }else
        {
            $content .= "Unable to Save Document.";
        }

	echo $content;
}

?>