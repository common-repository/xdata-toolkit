<?php

include_once("DataSourceType.php");

class DataSourceTypes {
	
	public function getDataSourceTypes()
	{
		global $wpdb;
		
		$dst_table_name = $wpdb->prefix . "xdata_ds_types";
		$queryIntSQL = "SELECT * from " . $dst_table_name;
		$results = $wpdb->get_results($queryIntSQL);
		
		$dataSourceTypes[] = null;
		$i = 0;
		
		foreach($results as $result){
			
			$dataSourceTypes[$i] 	= new DataSourceType($result->ds_type_id,$result->ds_type, $result->ds_desc);
			$i++;
		}		
		
		return $dataSourceTypes;
	}
	
	public function getDataSourceType($ds_type_id)
	{
		$dataSourceTypes = $this->getDataSourceTypes();
		return $dataSourceTypes[$ds_type_id];
	}
	
	public function deleteDataSourceTypes($ds_type_id)
	{
		global $wpdb;
		
		$dst_table_name = $wpdb->prefix . "xdata_ds_types";

		$insertSQL = "DELETE FROM " . $dst_table_name . " ";
		$insertSQL .= " WHERE ds_type_id = " . $ds_type_id;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			//$content .= '<div class="updated"><p><strong>';
			$content .= _e("Deleted Data Source Type.", "XDataToolkit");
			//$content .= '</strong></p></div>';
		}else{
			//$content .= '<div class="updated"><p><strong>';
			$content .= _e("DELETE Data Source Type - UNSUCCESSFUL.", "XDataToolkit");
			//$content .= "SQL is " . $insertSQL;
			//$content .= '</strong></p></div>';
		}			
		
	}
	public function updateDataSourceTypes($dataSourceType,$ds_type_id)
	{
		global $wpdb;
		
		$dst_table_name = $wpdb->prefix . "xdata_ds_types";

		$insertSQL = "UPDATE " . $dst_table_name . " ";
		$insertSQL .= "SET ds_type = '" .$dataSourceType['ds_type'] . "'" ;
		$insertSQL .= ", ds_desc = '" . $dataSourceType['ds_desc'] . "' ";
		$insertSQL .= " WHERE ds_type_id = " . $ds_type_id;

		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			//$content .= '<div class="updated"><p><strong>';
			$content .= _e("Updated Behavior Type.", "XDataToolkit");
			//$content .= '</strong></p></div>';
		}else{
			//$content .= '<div class="updated"><p><strong>';
			$content .= _e("Update Behavior Type - UNSUCCESSFUL.", "XDataToolkit");
			//$content .= "SQL is " . $insertSQL;
			//$content .= '</strong></p></div>';
		}		

		
		return $content;
	}	
	
	
}

?>