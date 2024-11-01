<?php

include_once dirname( __FILE__ ) . '/../controllers/query/PerformQuery.php';
require_once("../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../helpers/functions.php';

$queryInt       = $_GET["queryInt"];
$type           = $_GET['type'];
$page           = $_GET['page'];
$element        = $_GET['element'];
$linkedItem     = $_GET['linked_item'];
$viewSource     = $_GET['viewSource'];

performQueryToDB($queryInt,$type,$page,$element,$linkedItem,$viewSource);

function performQueryToDB($queryInt,$type,$page,$element,$linkedItem,$viewSource)
{
    
    $content        = getQueryResults($queryInt,$type,$page,$element,$linkedItem,$viewSource,null);
    echo $content;
    
}

?>