<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

require_once("../../../../../wp-config.php");

$xml        = stripslashes(nl2br(urldecode($_POST['xmldata'])));
$xsl        = stripslashes(nl2br(urldecode($_POST['xsldata'])));
$stylesheet = $_POST['stylesheet'];

$badStuff   = array("<br />");
$goodStuff  = array("");
$xsldata    = str_replace($badStuff,$goodStuff,$xsl);
$xmldata    = str_replace($badStuff,$goodStuff,$xml);

//echo "GOT HERE!";
transformDoc($xmldata,$xsldata,$stylesheet);

function transformDoc($xmldata,$xsldata,$stylesheet)
{
	
	$content = "";

        $xp = new XsltProcessor();

        // create a DOM document and load the XSL stylesheet
        $xsl = new SimpleXMLElement($xsldata);

        // import the XSL styelsheet into the XSLT process
          
        $xp->importStylesheet($xsl);
	
	$tfParams   = "xdata_".$stylesheet."_tf_params";
    
	$transformparameters = get_option($tfParams);
	
	$parameters	= false;
	
	if($transformparameters != null)
	{
		$parameters = true;
		$explodedParams = explode(":::",$transformparameters);
		
		foreach($explodedParams as &$explodedParam)
		{
			$param = explode("::",$explodedParam);
			$params[$param[0]] = $param[1];
		}
	}
	
	if($parameters)
	{
		$xp->setParameter('', $params);
	}	
          
        $xml_doc = new DomDocument;
        $xml_doc->loadXml($xmldata);	  

        // transform the XML into HTML using the XSL file
        if ($html = $xp->transformToXML($xml_doc)) {
            $content .= $html;
        } else {
            $xslTransformFail = __('XSLTransformFail','xdata-toolkit');
            trigger_error($xslTransformFail, E_USER_ERROR);
        } // if
        
        $xp = null;
        $xsl = null;
        $html = null;
        $transform = null;		


	echo $content;
}

?>