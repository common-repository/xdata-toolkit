<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

//$urlToPass       = $_GET["urlToPass"];
$dataSource      = $_GET["urlToPass"];

//getDataSourceSource($urlToPass);
getDataSourceSource($dataSource);

function getDataSourceSource($dataSource)
{
    $DataSources = new DataSources();
    $datasource = $DataSources->getDataSourceById($dataSource);
    
    if($datasource->ds_username != "na" || $datasource->ds_username != null)
    {
            $un = $datasource->ds_username;
            
            $pw = $datasource->ds_password;
            $content .= $pw;
            $context = stream_context_create(array(
                'http' => array(
                    'header'  => "Authorization: Basic " . base64_encode("$un:$pw")
                )
            ));
            $url = $datasource->ds_host_url;
            
            $content = file_get_contents($url, false, $context);
    }else
     {
            $content .= file_get_contents($datasource->ds_host_url);	
     }

    if($download == "yes")
    {
        $filename       = $queryInt."_".date("Y-m-d_H-i",time());
        header("Content-type: application/xml");
        header("Content-disposition: xml" . date("Y-m-d") . ".xml");
        header("Content-disposition: filename=".$filename.".xml");
    }
    
    echo $content;
    
}

?>