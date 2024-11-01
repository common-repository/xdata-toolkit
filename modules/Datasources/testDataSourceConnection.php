<?php

//include_once dirname( __FILE__ ) . '/../controllers/query/PerformQuery.php';
require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

$dsType                 = $_GET["ds_type"];
$ds_identifier          = $_GET['ds_identifier'];
$ds_username            = $_GET['ds_username'];
$ds_password            = $_GET['ds_password'];
$ds_port                = $_GET['ds_port'];
$ds_host_url            = $_GET['ds_host_url'];
$DSName                 = $_GET['DSName'];

    $content            = $dsType;
    $content            .= $ds_identifier;
    $content            .= $ds_username;
    $content            .= $ds_password;
    $content            .= $ds_port;
    $content            .= $ds_host_url;
    $content            .= $DSName;
        
    //Connection's Parameters
    $db_host= $ds_host_url.":".$ds_port; //"bui.buildautomate.com:3306";
    $db_name=$DSName; //"vaughnbu_orangehrm";
    $username=$ds_username; //"vaugh_orangeadmn";
    $password=$ds_password;//"Tx552233";

    $db_err   = connectToDBTest($db_host,$username,$password);
    echo $db_err;
    

function connectToDBTest($db_host,$username,$password)
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
/*
function testDataSourceConnection($dsType,$ds_identifier,$ds_username,$ds_password,$ds_port,$ds_host_url,$DSName)
{
    
$dsType                 = $_GET["ds_type"];
$ds_identifier          = $_GET['ds_identifier'];
$ds_username            = $_GET['ds_username'];
$ds_password            = $_GET['ds_password'];
$ds_port                = $_GET['ds_port'];
$ds_host_url            = $_GET['ds_host_url'];
$DSName                 = $_GET['DSName'];    
    
    $content        = $dsType;
    $content        .= ","+$ds_identifier;
    $content        .= ","+$ds_username;
    $content        .= ","+$ds_password;
    $content        .= ","+$ds_port;
    $content        .= ","+$ds_host_url;
    $content        .= ","+$DSName;    
    echo $content;
    
}*/

?>