<?php

include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
// VIEW FOR SaveQueryInterfacesView
require_once("../../../../../wp-config.php");

SaveQueryInterfacesView();

function SaveQueryInterfacesView()
{

		$action 		= $_POST['update'];
		$qi_id 			= $_POST['qi_id'];
		$qi_name		= $_POST['qi_name'];
		$qi_global_var		= $_POST['qi_global_var'];
		$qi_behavior_type	= $_POST['qi_behavior_type'];
		$qi_cache_freq		= $_POST['qi_cache_freq'];
		$qi_transform_id	= $_POST['qi_transform_id'];
		$qi_ds_id		= $_POST['qi_ds_id'];
		$qi_query		= $_POST['qi_query'];
		
		$QueryInterfacesUpdate = new QueryInterfaces();
		$queryInterface[] = null;
		
		$queryInterface['qi_id']		= $qi_id;
		$queryInterface['qi_name']		= $qi_name;
		$queryInterface['qi_global_var']	= $qi_global_var;
		$queryInterface['qi_behavior_type']	= $qi_behavior_type;
		$queryInterface['qi_cache_freq']	= $qi_cache_freq;
		$queryInterface['qi_transform_id']	= $qi_transform_id;
		$queryInterface['qi_ds_id']		= $qi_ds_id;
		$queryInterface['qi_query']		= $qi_query;
		
		if($queryInterface['qi_id'] == null)
		{
				$content .= $QueryInterfacesUpdate->insertQueryInterfaces($queryInterface);		
		}else{
				$content .= $QueryInterfacesUpdate->updateQueryInterfaces($queryInterface,$qi_id);
		}		
		
		echo $content;
}

?>