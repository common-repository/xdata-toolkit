<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

$queryInt       = $_GET["queryInt"];

checkTransformNames($queryInt);


function checkTransformNames($queryInt)
{
    global $wpdb;
    
    $content = "";
    
    //$querycache_table_name = $wpdb->prefix . "xdata_datasources";
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
    
    $content = "";
    $db_hostO = "";
    $db_nameO = "";
    $usernameO = "";
    $passwordO = "";
    $db_hostO = "";
    $queryIntSQLO = "";
    $behaviorTypeO = "";
    $transformID = "";
    
    $DBresults = $wpdb->get_results($sqlStatement); 

    foreach($DBresults as $k=>$i){
            $transformID	= $i->DS_TRANSFORM_ID;
    }
    
    $Transforms = new Transforms();
    $transforms = $Transforms->getTransforms();
    $Transform = $Transforms->getTransform($transformID);
    
    $transformFileName = $Transform->transform_file;
    $transform_name =    $Transform->transform_name;
    
    echo $transformFileName . "^" . $transform_name;
}

?>