<?php

include_once("QueryInterface.php");
include_once dirname( __FILE__ ) . '/../helpers/functions.php';

class QueryInterfaces {
	
	public function getQueryInterfaces()
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";
		$queryIntSQL = "SELECT * from " . $qi_table_name;
		$results = $wpdb->get_results($queryIntSQL);
		
		//$queryInterfaces[] = null;
		//$i = 0;
		
		foreach($results as $result){
			
			$queryInterfaces[$result->qi_id] 	= new QueryInterface($result->qi_id,
							  $result->qi_name,
							  $result->qi_global_var,
							  $result->qi_behavior_type,
							  $result->qi_cache_freq,
							  $result->qi_transform_id,
							  $result->qi_ds_id,
							  $result->qi_query);
			//$i++;
		}		
		
		return $queryInterfaces;
	}
	
	public function getQueryInterface($qi_id)
	{
		$queryInterfaces = $this->getQueryInterfaces();
		return $queryInterfaces[$qi_id];
	}
	
	public function getQueryInterfaceById($qi_id)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";
		$queryIntSQL = "SELECT * from " . $qi_table_name . " WHERE qi_id = " . $qi_id;
		$results = $wpdb->get_results($queryIntSQL);
		
		$queryInterface = null;

		foreach($results as $result){
			
			$queryInterface 	= new QueryInterface($result->qi_id,
							  $result->qi_name,
							  $result->qi_global_var,
							  $result->qi_behavior_type,
							  $result->qi_cache_freq,
							  $result->qi_transform_id,
							  $result->qi_ds_id,
							  $result->qi_query);
			
		}		
		
		return $queryInterface;
		
	}		
	
	public function deleteQueryInterfaces($qi_id)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";

		$insertSQL = "DELETE FROM " . $qi_table_name . " ";
		$insertSQL .= " WHERE qi_id = " . $qi_id;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Deleted Query Interface.", "XDataToolkit");
		}else{
			$content .= _e("DELETE Query Interface - UNSUCCESSFUL.", "XDataToolkit");
		}			
		
	}
	
	public function getQueryInterfacesSorted($colName)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";
		$queryIntSQL = "SELECT * from " . $qi_table_name. " ORDER BY ".$colName;
		$results = $wpdb->get_results($queryIntSQL);
		
		$queryInterfaces[] = null;
		$i = 0;
		
		foreach($results as $result){
			
			$queryInterfaces[$i] 	= new QueryInterface($result->qi_id,
							  $result->qi_name,
							  $result->qi_global_var,
							  $result->qi_behavior_type,
							  $result->qi_cache_freq,
							  $result->qi_transform_id,
							  $result->qi_ds_id,
							  $result->qi_query);
			$i++;
		}		
		
		return $queryInterfaces;
	}		
	
	public function findQueryInterface($ds_id)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";

		$selectSQL = "SELECT * FROM " . $qi_table_name . " ";
		$selectSQL .= " WHERE qi_ds_id = " . $ds_id;
		
		$found = false;
		
		if($results = $wpdb->query( $wpdb->prepare($selectSQL)))
		{
			$found = true;
		}else{	
			$found = false;
		}
		
		return $found;
		
	}	
	
	public function findTiedQueryInterfaces($ds_id)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";

		$selectSQL = "SELECT * ";
		$selectSQL .= "FROM ".$qi_table_name . " ";
		$selectSQL .= "WHERE qi_ds_id = ".$ds_id;		
		
		$results = $wpdb->get_results($selectSQL);
		
		$queryInterfaces[] = null;
		$i = 0;
		
		foreach($results as $result){
			
			$queryInterfaces[$i] 	= new QueryInterface($result->qi_id,
							  $result->qi_name,
							  $result->qi_global_var,
							  $result->qi_behavior_type,
							  $result->qi_cache_freq,
							  $result->qi_transform_id,
							  $result->qi_ds_id,
							  $result->qi_query);
			$i++;
		}		
		
		return $queryInterfaces;
		
	}
	
	public function updateQueryInterfaces($queryInterface,$qi_id)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";

		$insertSQL = "UPDATE " . $qi_table_name . " ";
		$insertSQL .= "SET qi_name = '" .$queryInterface['qi_name'] . "'" ;
		$insertSQL .= ", qi_global_var = '" . $queryInterface['qi_global_var'] . "' " ;
		$insertSQL .= ", qi_behavior_type = " . $queryInterface['qi_behavior_type'] . " " ;
		$insertSQL .= ", qi_cache_freq = " . $queryInterface['qi_cache_freq'] . " " ;
		$insertSQL .= ", qi_transform_id = " . $queryInterface['qi_transform_id'] . " " ;
		$insertSQL .= ", qi_ds_id = " . $queryInterface['qi_ds_id'] . " " ;
		$insertSQL .= ", qi_query = '" . $queryInterface['qi_query'] . "' " ;		
		$insertSQL .= " WHERE qi_id = " . $qi_id;

		$content .= $insertSQL;
		$content .= "-----";
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Updated Query Interface.", "XDataToolkit");
		}else{
			$content .= _e("Update Query Interface - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;
	}
	function updateTransformToQueryInterface($qi_name,$transformID)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";

		$insertSQL = "UPDATE " . $qi_table_name . " SET ";
		$insertSQL .= "qi_transform_id = " . $transformID . " " ;
		$insertSQL .= " WHERE qi_global_var = '" . $qi_name . "'";

		$content .= $insertSQL;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Updated Query Interface.", "XDataToolkit");
		}else{
			$content .= _e("Update Query Interface - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;		
		
	}
	
	public function insertQueryInterfaces($queryInterface)
	{
		global $wpdb;
		
		$qi_table_name = $wpdb->prefix . "xdata_query_ints";
		
		
		$idName			= "qi_id";
		$id	= getNextInsertID($qi_table_name,$idName);		

		$insertSQL = "INSERT INTO " . $qi_table_name . " (qi_id,qi_name,qi_global_var,qi_behavior_type,qi_cache_freq,qi_transform_id,qi_ds_id,qi_query) ";
		$insertSQL .= "VALUES (".$id.",'". $queryInterface['qi_name'] . "','" . $queryInterface['qi_global_var'] . "',";
		$insertSQL .= " ".$queryInterface['qi_behavior_type'] . ", " . $queryInterface['qi_cache_freq'] . "," . $queryInterface['qi_transform_id'] . ", ";
		$insertSQL .= " ".$queryInterface['qi_ds_id'] . ",'" . $queryInterface['qi_query'] . "'";
		$insertSQL .= ")";
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Saved New Query Interface.", "XDataToolkit");
		}else{
			$content .= _e("Save New Query Interface - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;		
		
	}	
	
	
	
}

?>