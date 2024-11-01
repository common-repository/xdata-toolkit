<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

$queryInt       = $_GET["queryInt"];
$type           = $_GET['type'];
$page           = $_GET['page'];
$element        = $_GET['element'];
$linkedItem     = $_GET['linked_item'];
$viewSource     = $_GET['viewSource'];
$download       = $_GET['download'];

queryDB($queryInt,$type,$page,$element,$linkedItem,$viewSource,$download);

function queryDB($queryInt,$type,$page,$element,$linkedItem,$viewSource,$download)
{
    
    $content        = getQueryResults($queryInt,$type,$page,$element,$linkedItem,$viewSource,null);
    
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