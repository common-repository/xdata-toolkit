<?php

include_once("Transform.php");

class Transforms {
	
	public function getTransforms()
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		$queryIntSQL = "SELECT * from " . $transforms_table_name;
		$results = $wpdb->get_results($queryIntSQL);
		
		//$transforms[] = null;
		//$i = 0;
		
		foreach($results as $result){
			
			$transforms[$result->transform_id] 	= new Transform($result->transform_id,
									$result->transform_name,
									$result->transform_file);
			//$i++;
		}		
		
		return $transforms;
	}
	
	public function getTransform($transform_id)
	{
		$transforms = $this->getTransforms();
		return $transforms[$transform_id];
	}
	public function getTransformById($transformID)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		$queryIntSQL = "SELECT * from " . $transforms_table_name . " WHERE transform_id = " . $transformID;
		$results = $wpdb->get_results($queryIntSQL);
		
		$transform = null;

		foreach($results as $result){
			
			$transform 	= new Transform($result->transform_id,
							  $result->transform_name,
							  $result->transform_file);
		}		
		
		return $transform;
		
	}	
	public function selectTransforms($transform_id)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		$queryIntSQL = "SELECT * from " . $transforms_table_name. " WHERE transform_id = ". $transform_id;
		$results = $wpdb->get_results($queryIntSQL);
		
		$transform = null;
		$i = 0;
		
		foreach($results as $result){
			
			$transform[$i] 	= new Transform($result->transform_id,
							  $result->transform_name,
							  $result->transform_file);
			$i++;
		}		
		
		return $transform;		
	}
	public function getTransformsSorted($colName)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		$queryIntSQL = "SELECT * from " . $transforms_table_name. " ORDER BY ".$colName;
		$results = $wpdb->get_results($queryIntSQL);
		
		$transforms[] = null;
		$i = 0;
		
		foreach($results as $result){
			
			$transforms[$i] 	= new Transform($result->transform_id,
							  $result->transform_name,
							  $result->transform_file);
			$i++;
		}		
		
		return $transforms;
	}		
	
	public function findTiedTransforms($datasourceID)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		
		$queryIntSQL = "SELECT * FROM ".$transforms_table_name."  WHERE transform_id IN ";
		$queryIntSQL .= "(SELECT qi_transform_id FROM wp_xdata_query_ints WHERE wp_xdata_query_ints.qi_ds_id = ".$datasourceID.")";		
		
		$results = $wpdb->get_results($queryIntSQL);
		
		$transforms[] = null;
		$i = 0;
		
		foreach($results as $result){
			
			$transforms[$i] 	= new Transform($result->transform_id,
							  $result->transform_name,
							  $result->transform_file);
			$i++;
		}		
		
		return $transforms;
	}	
	
	public function selectTransform($transform_id)
	{
		$transforms 	= $this->selectTransforms($transform_id);
		return $transforms[0];
	}
	public function deleteTransform($transform_id)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";

		$insertSQL = "DELETE FROM " . $transforms_table_name . " ";
		$insertSQL .= " WHERE transform_id = " . $transform_id;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Deleted Transform.", "XDataToolkit");
		}else{
			$content .= _e("DELETE Transform - UNSUCCESSFUL.", "XDataToolkit");
		}			
		
	}
	public function updateTransforms($transform,$transform_id)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";

		$insertSQL = "UPDATE " . $transforms_table_name . " ";
		$insertSQL .= "SET transform_name = '" .$transform['transform_name'] . "'" ;
		$insertSQL .= ", transform_file = '" . $transform['transform_file'] . "' " ;
		$insertSQL .= " WHERE transform_id = " . $transform_id;

		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Updated Transform.", "XDataToolkit");
		}else{
			$content .= _e("Update Transform - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;
	}	
	
	public function insertTransforms($transform)
	{
		global $wpdb;
		
		$transforms_table_name = $wpdb->prefix . "xdata_transforms";
		
		$tablename 	= "xdata_transforms";
		$idName		= "transform_id";
		$lastID		= getNextInsertID($transforms_table_name,$idName);
		
		$insertSQL = "INSERT INTO " . $transforms_table_name . " (transform_id,transform_name,transform_file) ";
		$insertSQL .= "VALUES (" . $lastID .  ",'". $transform['transform_name'] . "' , '" . $transform['transform_file'] . "' ";
		$insertSQL .= ")";

		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Saved Transform.", "XDataToolkit");
		}else{
			$content .= _e("Save Transform - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;		
		
	}	
	
	
}

?>