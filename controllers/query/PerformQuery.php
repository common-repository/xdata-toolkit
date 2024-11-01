<?php
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

function getQueryResults($queryInt,$type,$page,$element,$linkedItem,$viewSource,$transformparameters)
{	
	$content = '';
	$atts['queryint']	= $queryInt;
	$atts['type']		= $type;
	$atts['linked_item']	= $linkedItem;
	$atts['viewSource']	= $viewSource;
	$atts['transformparameters'] = $transformparameters;

	return returnQuery($atts,$content,null);	
}
function performQuery($atts,$content)
{
	global $wp_query;
	
	extract(shortcode_atts(array('show' => 'form'), $atts));
	$returnedContent = returnQuery($atts,$content,$wp_query);
	
	return $returnedContent;	
}
function selectDataSource($dataSourceID)
{
	global $wpdb;

	$datasources_table_name = $wpdb->prefix . "xdata_datasources";
	$queryints_table_name = $wpdb->prefix . "xdata_query_ints";
	

	
	$sqlStatement = "SELECT DISTINCT ".$datasources_table_name.".ds_id AS DS_ID, ";
	$sqlStatement .= $datasources_table_name.".ds_identifier AS DS_IDENTIFIER, ";
	$sqlStatement .= $datasources_table_name.".ds_type AS DS_TYPE, ";
	$sqlStatement .= $datasources_table_name.".ds_username AS DS_USERNAME, ";
	$sqlStatement .= $datasources_table_name.".ds_password AS DS_PASSWORD, ";
	$sqlStatement .= $datasources_table_name.".ds_port AS DS_PORT, ";
	$sqlStatement .= $datasources_table_name.".ds_host_url AS DS_HOST_URL, ";
	$sqlStatement .= $datasources_table_name.".ds_name AS DS_NAME, ";
	$sqlStatement .= $queryints_table_name.".qi_behavior_type AS DS_BEHAVIOR_TYPE, ";
	$sqlStatement .= $queryints_table_name.".qi_transform_id AS DS_TRANSFORM_ID,";
	$sqlStatement .= $queryints_table_name.".qi_query AS DS_QUERY ";
	$sqlStatement .= "FROM ".$datasources_table_name.", ".$queryints_table_name." ";
	$sqlStatement .= "WHERE ".$queryints_table_name.".qi_global_var = '" . $query . "' AND (".$datasources_table_name.".ds_id = ".$queryints_table_name.".qi_ds_id)";
	
	$dataSourceToQuery[] = null;		
	$DBresults = $wpdb->get_results($sqlStatement); 

	foreach($DBresults as $k=>$i){
		$dataSourceToQuery['ds_id']		= $i->DS_ID;
		$dataSourceToQuery['username'] 		= $i->DS_USERNAME;
		$dataSourceToQuery['password'] 		= decode5t($i->DS_PASSWORD);
		$dataSourceToQuery['db_host'] 		= $i->DS_HOST_URL . ":" . $i->DS_PORT;
		$dataSourceToQuery['db_name'] 		= $i->DS_NAME;
		$dataSourceToQuery['behaviorType'] 	= $i->DS_BEHAVIOR_TYPE;
		$dataSourceToQuery['queryIntSQL'] 	= $i->DS_QUERY;
		$dataSourceToQuery['transformID']	= $i->DS_TRANSFORM_ID;
		$dataSourceToQuery['dsType']		= $i->DS_TYPE;
		$dataSourceToQuery['dsHostURL']		= $i->DS_HOST_URL;
	}
	
	return $dataSourceToQuery;	
	
}
function selectQueryInterface($query)
{
		global $wpdb;

		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$queryints_table_name = $wpdb->prefix . "xdata_query_ints";
		
		$sqlStatement = "SELECT DISTINCT ".$datasources_table_name.".ds_id AS DS_ID, ";
		$sqlStatement .= $datasources_table_name.".ds_identifier AS DS_IDENTIFIER, ";
		$sqlStatement .= $datasources_table_name.".ds_type AS DS_TYPE, ";
		$sqlStatement .= $datasources_table_name.".ds_username AS DS_USERNAME, ";
		$sqlStatement .= $datasources_table_name.".ds_password AS DS_PASSWORD, ";
		$sqlStatement .= $datasources_table_name.".ds_port AS DS_PORT, ";
		$sqlStatement .= $datasources_table_name.".ds_host_url AS DS_HOST_URL, ";
		$sqlStatement .= $datasources_table_name.".ds_name AS DS_NAME, ";
		$sqlStatement .= $queryints_table_name.".qi_behavior_type AS DS_BEHAVIOR_TYPE, ";
		$sqlStatement .= $queryints_table_name.".qi_transform_id AS DS_TRANSFORM_ID,";
		$sqlStatement .= $queryints_table_name.".qi_query AS DS_QUERY ";
		$sqlStatement .= "FROM ".$datasources_table_name.", ".$queryints_table_name." ";
		$sqlStatement .= "WHERE ".$queryints_table_name.".qi_global_var = '" . $query . "' AND (".$datasources_table_name.".ds_id = ".$queryints_table_name.".qi_ds_id)";
		
		$dataSourceToQuery[] = null;		
		$DBresults = $wpdb->get_results($sqlStatement); 
	
		foreach($DBresults as $k=>$i){
			$dataSourceToQuery['ds_id']		= $i->DS_ID;
			$dataSourceToQuery['username'] 		= $i->DS_USERNAME;
			$dataSourceToQuery['password'] 		= decode5t($i->DS_PASSWORD);
			$dataSourceToQuery['db_host'] 		= $i->DS_HOST_URL . ":" . $i->DS_PORT;
			$dataSourceToQuery['db_name'] 		= $i->DS_NAME;
			$dataSourceToQuery['behaviorType'] 	= $i->DS_BEHAVIOR_TYPE;
			$dataSourceToQuery['queryIntSQL'] 	= $i->DS_QUERY;
			$dataSourceToQuery['transformID']	= $i->DS_TRANSFORM_ID;
			$dataSourceToQuery['dsType']		= $i->DS_TYPE;
			$dataSourceToQuery['dsHostURL']		= $i->DS_HOST_URL;
		}
		
		return $dataSourceToQuery;
}
function getTransformFile($transformID)
{
	$Transforms	= new Transforms();
			
	$transform	= $Transforms->getTransform($transformID);
	$trFile		= $transform->transform_file;
	return $trFile;
}
function getXMLHeader(){
	return "<?xml version=\"1.0\"?>\n<results>\n";
}
function returnQuery($atts, $content,$wp_query){

	global $wpdb;
	global $wp_query;

	$content = "";			

	$query 		= $atts['queryint'];
	$type		= $atts['type'];
	$page 		= $atts['page'];
	$element 	= $atts['element'];
	$linkedItem	= $atts['linked_item'];
	$viewSource	= $atts['viewSource'];
	$transformparameters = $atts['transformparameters'];
	
	$parameters	= false;
	
	if($transformparameters != null)
	{
		$parameters = true;
		$explodedParams = explode(":::",$transformparameters);
		
		foreach($explodedParams as &$explodedParam)
		{
			// CHECK TO ENSURE THAT WE ARE CASTING TO STRING, AS WE WILL NOT KNOW IF OR WHEN WE WILL RECEIVE A NON-STRING VALUE
			
			$param = explode("::",$explodedParam);
			// Find $$ variable for passed-in query variables
			$paramValue = (string) $param[1];
			
			if (strpos($paramValue, '$$') == true )
			{
				$paramValue = trim($paramValue);
				$leng = strlen($paramValue);
				$secLength = $leng - 1;
				//$content .= "PARAM VALUE LENGTH is ".$leng."<br/>";
				//$content .= "Second VALUE LENGTH is ".$secLength."<br/>";
				$strMod = substr($paramValue,5,-1);
				//$content .= "STR value is ".$strMod."<br/>";
				$paramValue = (string) $wp_query->query_vars[$strMod];
				//$content .= "PARAM value is ".$paramValue."<br/>";
			}
			$params[$param[0]] = $paramValue;
		}
	}
	
	
	//$elem   = $wp_query->query_vars["bgcolor"];
	//$content .= "BGCOLOR is ". $elem."<br/>";
	//$content .= "Page ID is ".$wp_query->query_vars["page_id"]."<br/>";
	//$content .= "<textarea height='50' width='80'>";
	//$text = print_r ($wp_query->query_vars,true);
	//$content .= $text."</textarea>";
	
	if($type == "list")
	{
		
	}else
	 {
		$page 		= $_GET['page'];
		$element	= $_GET['element']; 
	 }
	
	if($query == null || $type == null)
	{  $content .= "NO XDATA QUERY INTERFACE DATA"; }else{
		
		$dataSourceToQuery 	= selectQueryInterface($query);
		
		if($dataSourceToQuery['dsType'] == 2 || $dataSourceToQuery['dsType'] == 3){

			$xml = "";

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

			
			$result = $xmlRetrieved;

			$transformID		= $dataSourceToQuery['transformID'];		
			$trFile			= getTransformFile($transformID);
			
			if($viewSource == "yes")
			{
				$content .= $result;
			}else{
				$content .= processXML($result,$trFile,$parameters,$params);
			}			
		}else{
		
			$username 		= $dataSourceToQuery['username'];
			$password 		= $dataSourceToQuery['password'];
			$db_host 		= $dataSourceToQuery['db_host'];
			$db_name 		= $dataSourceToQuery['db_name'];
			$behaviorType		= $dataSourceToQuery['behaviorType'];
			$queryIntSQL 		= $dataSourceToQuery['queryIntSQL'];
			$transformID		= $dataSourceToQuery['transformID'];		
			
			$clauseToAdd = "";
			$linkToAdd= "";
	
			if($linkedItem == null){
				
			}else{
				if($type == "list")
				{
					//$elementToFind 	= $_GET['name'];
					//$element       	= $_GET['element'];
					$linkToAdd	= "?page_id=".$page."&element=".$element."^";
				}else
				{
					if($_GET['element'])
					{
						$elemarray=explode("^", $element);
						$element1 	= $elemarray[0];
						$elementToFind 	= $elemarray[1];
						
						$paren		= "'";
						if(checkValueType($elementToFind))
						{	$paren  = ""; }
						
						$clauseToAdd 	= " WHERE " . $element1 . " = '" .$elementToFind. "'";
						$queryIntSQL   .= $clauseToAdd;
					}
				}
			}
	
			$databaseConnection = mysql_connect($db_host, $username, $password);
			$queryIntSQL = trim($queryIntSQL);
			
			$i = 0;
			if(strpos($queryIntSQL,'$$'))
			{
				// CHECK SQL QUERY FOR $$ QUERY VARIABLES			
				do
				{
					$pos 	= strpos($queryIntSQL,'$$');
					$endDelim =  array('}');
					$secPos = 0;
					$queryLength = strlen($queryIntSQL);
					$foundParam = substr($queryIntSQL,$pos,$queryLength);
					
					foreach ($endDelim as $delim)
					{
					    if (strpos($foundParam, $delim))
					    {
						$secPos = strpos($foundParam,$delim);
						
					    }
					}
					
					$str = substr($queryIntSQL,$pos+2,$secPos-2);
					$replacedValue = $wp_query->query_vars[$str];
					$firstPart = substr($queryIntSQL,0,$pos-3);

					$endPart = substr($foundParam,$secPos+1,$queryLength);
					$queryIntSQL = $firstPart . $replacedValue . $endPart;
					
				}while(strpos($queryIntSQL, '$$') == true );
			}	
			
			mysql_select_db($db_name,$databaseConnection);				
			$results     	= mysql_query($queryIntSQL);
			$trFile		= getTransformFile($transformID);
			$xml	  	= getXMLHeader();
				
			// Print Table or Not?	
			$printTable = false;
			if($trFile == "No Transform" || $trFile == null)
			{	$printTable = true;		}
			
			if($viewSource == "yes")
			{	$printTable = false;		}
			
			if($printTable)
			{	$content .= "<table>\n";	}
			
				while ($row = mysql_fetch_assoc($results)) {
			
					$ncols = @mysql_num_fields ($results);
					$xml .= "\t<result>\n";
					if($printTable){$content .= "<tr>";}
					
					if ($ncols == 0)
					    $content .= "Query has no result set<br/>";
					for ($i = 0; $i < $ncols; $i++)
					{
					    $col_info = mysql_fetch_field ($results, $i);
					    $xml .= "\t\t<". $col_info->name .">\n\t\t\t" . $row[$col_info->name] . "\n\t\t</" . $col_info->name . ">\n";
		
					    if($printTable){$content .= '<td>';}
					    if($linkedItem == "yes"){
						$url = $linkToAdd . $row[$col_info->name];
						if($printTable){$content .= '<a href="'.$url. '">' . $row[$col_info->name] . '</a>';}
					    }else{
						if($printTable){	$content .= $row[$col_info->name];	}
					    }
					    if($printTable){		$content .= '</td>';			}
					}				
					if($printTable){		$content .= "</tr>";			}
					
					$xml .= "\t</result>\n";				
				}
				$xml 	 .= "</results>";
				
				if($printTable)
				{	$content .= "</table>";			}
				mysql_free_result($results);
				
				if($viewSource == "yes")
				{	$content .= $xml;
				}else{	$content .= processXML($xml,$trFile,$parameters,$params);	}				
		}
		
	}

			
		
	$databaseConnection 	= null;
	$queryIntSQL 		= null;	

	return $content;
}
function checkValueType($value)
{
	if(is_int($value))
	{	return true;	}else
	{	return false;	}
	
}

function processXML($xml,$trFile,$parameters,$params)
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
	
	$transformFile 			= $clientTransformsDir . $trFile;

	if($trFile == "No Transform" or $trFile == null)
	{}else
	{
		$xp 			= new XsltProcessor();

		$xsl 			= new DomDocument;
		$xsl->load($transformFile);
		  
		$xp->importStylesheet($xsl);
		
		if($parameters)
		{
			$xp->setParameter('', $params);
		}

		if ($html = $xp->transformToXML(new SimpleXMLElement($xml))) {
		    $content 		.= $html;
		} else {
		    trigger_error('XSL transformation failed.', E_USER_ERROR);
		} 
		
		$xp 			= null;
		$xsl 			= null;
		$html 			= null;
		$transform 		= null;			
	}
	return $content;
}
function connectToDB($db_host,$username,$password)
{
    $link = mysql_connect($db_host, $username, $password);
    $db_conn    = false;
    
    if(!$link)
    {
        $db_conn = false;
    }else
    {
        $db_conn = true;
    }
    return $db_conn;
}

?>