<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

require_once("../../../../../wp-config.php");

$queryInterface = $_POST['queryInterface'];

generateStylesheet($queryInterface);

function generateStylesheet($queryInterface)
{
	
	$content = "";
        
        $type       = "page";
        $page       = "";
        $element    = "";
        $linkedItem = "no";
        $viewSource = "yes";
        
	$dataSourceToQuery = selectQueryInterface($queryInterface);
	
	if($dataSourceToQuery['dsType'] == 2 || $dataSourceToQuery['dsType'] == 3) {
		//$xmlRetrieved = file_get_contents($dataSourceToQuery['dsHostURL']);
		$xml = "";
		//$xml = loadXml($xmlRetrieved);
		if($dataSourceToQuery['dsType'] == 2 ){
			
			if($dataSourceToQuery['username'] != "na" || $dataSourceToQuery['username'] != null)
			{
				$un = $dataSourceToQuery['username'];
				$pw = $dataSourceToQuery['password'];
				$context = stream_context_create(array(
				    'http' => array(
					'header'  => "Authorization: Basic " . base64_encode("$un:$pw")
				    )
				));
				$url = $dataSourceToQuery['dsHostURL'];
				$xmlRetrieved = file_get_contents($url, false, $context);
			}else
			 {
				$xmlRetrieved = file_get_contents($dataSourceToQuery['dsHostURL']);	
			 }

			//$xmlRetrieved = file_get_contents($dataSourceToQuery['dsHostURL']);
			$xml = new SimpleXMLElement($xmlRetrieved);
			$xpath =	$dataSourceToQuery['queryIntSQL']; 
			$result = $xml->xpath($xpath);
		}else{
		}
	}else{
		$queryXML = getQueryResults($queryInterface,$type,$page,$element,$linkedItem,$viewSource,null);
		$xml = new SimpleXMLElement($queryXML);
		$result = $xml->xpath('//results/result[1]');

	}
	if($dataSourceToQuery['dsType'] == 3) {
		$lt = "&amp;lt&#59;";
$content .= '<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/rss/channel">
        <div>
              <xsl:apply-templates select="//rss/channel/item"/>
        </div>
    </xsl:template>
    
    <xsl:template match="//rss/channel/item">
                  <xsl:variable name="aLink">
                    <xsl:value-of select="link"/>
                  </xsl:variable>

	<xsl:choose>
		<xsl:when test="position() '.$lt.'= 5">

                  <h3><a href="{$aLink}" target="newWin"><xsl:value-of select="title"/></a></h3><br/>
                  <ul>
                     <font size="-3"><xsl:value-of select="pubDate"/></font><br/>
                     <xsl:value-of select="description" disable-output-escaping="yes"/><br/>
                  </ul>
                  <br/><br/>
                </xsl:when>
	</xsl:choose>

    </xsl:template>          
</xsl:stylesheet>
';
		
		}else{
        $childElements[] = null;
        $i=0;
        foreach ($result as $child) {
            foreach($child as $childElem){
                $childElements[$i] = $childElem->getName();
                $i++;
            }
            
        }         
        
        $content .= '<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    
    <xsl:template match="/">
        <div>
            <table style="width:95%">
              <tr>
';
        foreach($childElements as $childElement)
        {
            $content .= '&#9;&#9;<th><strong>'.$childElement.'</strong></th>&#13;&#10;';
        }

                $content .= '
              </tr>                
              <xsl:apply-templates select="//results"/>
            </table>
        </div>
    </xsl:template>
    
    <xsl:template match="//results/result">
      <tr>
';        
        foreach($childElements as $childElement)
        {
            $content .= '&#9;&#9;<td><xsl:value-of select="'.$childElement.'"/></td>&#13;&#10;';
        }        
        
        $content .= '
      </tr>
    </xsl:template>          
</xsl:stylesheet>';
	}
	$dataSourceToQuery = null;
	echo $content;
}

?>