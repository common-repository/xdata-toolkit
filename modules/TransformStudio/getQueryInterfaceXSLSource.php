<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");
require_once("../../../../../wp-admin/includes/plugin.php");

$queryInt       = $_GET["queryInt"];

getQueryInterfaceXSL($queryInt);

function getQueryInterfaceXSL($queryInt)
{
        $content = "";
        global $wpdb;
        
        $sqlStatement = "SELECT DISTINCT wp_xdata_datasources.ds_id AS DS_ID, ";
        $sqlStatement .= "wp_xdata_datasources.ds_identifier AS DS_IDENTIFIER, ";
        $sqlStatement .= "wp_xdata_datasources.ds_type AS DS_TYPE, ";
        $sqlStatement .= "wp_xdata_datasources.ds_username AS DS_USERNAME, ";
        $sqlStatement .= "wp_xdata_datasources.ds_password AS DS_PASSWORD, ";
        $sqlStatement .= "wp_xdata_datasources.ds_port AS DS_PORT, ";
        $sqlStatement .= "wp_xdata_datasources.ds_host_url AS DS_HOST_URL, ";
        $sqlStatement .= "wp_xdata_datasources.ds_name AS DS_NAME, ";
        $sqlStatement .= "wp_xdata_query_ints.qi_behavior_type AS DS_BEHAVIOR_TYPE, ";
        $sqlStatement .= "wp_xdata_query_ints.qi_transform_id AS DS_TRANSFORM_ID,";
        $sqlStatement .= "wp_xdata_query_ints.qi_query AS DS_QUERY ";
        $sqlStatement .= "FROM wp_xdata_datasources, wp_xdata_query_ints ";
        $sqlStatement .= "WHERE wp_xdata_query_ints.qi_global_var = '" . $queryInt . "' AND (wp_xdata_datasources.ds_id = wp_xdata_query_ints.qi_ds_id)";
        
        $DBresults = $wpdb->get_results($sqlStatement); 

        foreach($DBresults as $k=>$i){
                $transformID	= $i->DS_TRANSFORM_ID;
        }    
    
        if($transformID == 0)
        {
            $content = "";
            
        }else
        {   
            $transforms_table_name = $wpdb->prefix . "xdata_transforms";
            $queryIntSQL = "SELECT * from " . $transforms_table_name. " WHERE transform_id = ".$transformID;
            
            $DBresults = $wpdb->get_results($queryIntSQL); 
    
            foreach($DBresults as $k=>$i){
                    $transformFile	= $i->transform_file;
            }                

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
            
            
            $fileToGet  = $clientTransformsDir.$transformFile;
            $content .= file_get_contents($fileToGet);
            
        }
        
    echo $content;
    
}

?>