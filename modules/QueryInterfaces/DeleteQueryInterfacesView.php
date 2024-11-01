<?php

include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
// VIEW FOR DeleteQueryInterfacesView
require_once("../../../../../wp-config.php");
// VIEW FOR SaveDataSourcesView

$qiID = $_POST['qi_id'];
DeleteQueryInterfacesView($qiID);

function DeleteQueryInterfacesView($qiID)
{		
		$QueryInterfacesUpdate = new QueryInterfaces();
		$content .= $QueryInterfacesUpdate->deleteQueryInterfaces($qiID);
		
		echo $content;
}

?>