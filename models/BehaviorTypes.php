<?php

include_once("BehaviorType.php");

class BehaviorTypes {
	
	public function getBehaviorTypes()
	{
		global $wpdb;
		
		$bt_table_name = $wpdb->prefix . "xdata_behavior_types";
		$queryIntSQL = "SELECT * from " . $bt_table_name;
		$results = $wpdb->get_results($queryIntSQL);
		
		//$behaviorTypes[] = null;
		//$i = 0;
		
		foreach($results as $result){
			
			$behaviorTypes[$result->bt_id] 	= new BehaviorType($result->bt_id,
							  $result->bt_name);
			//$i++;
		}		
		
		return $behaviorTypes;
	}
	
	public function getBehaviorType($bt_id)
	{
		$behaviorTypes = $this->getBehaviorTypes();
		return $behaviorTypes[$bt_id];
	}
	
	public function deleteBehaviorTypes($bt_id)
	{
		global $wpdb;
		
		$bt_table_name = $wpdb->prefix . "xdata_behavior_types";

		$insertSQL = "DELETE FROM " . $bt_table_name . " ";
		$insertSQL .= " WHERE bt_id = " . $bt_id;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= '<div class="updated"><p><strong>';
			$content .= _e("Deleted Behavior Type.", "XDataToolkit");
			$content .= '</strong></p></div>';
		}else{
			$content .= '<div class="updated"><p><strong>';
			$content .= _e("DELETE Behavior Type - UNSUCCESSFUL.", "XDataToolkit");
			$content .= "SQL is " . $insertSQL;
			$content .= '</strong></p></div>';
		}			
		
	}
	public function updateBehaviorTypes($behaviorType,$bt_id)
	{
		global $wpdb;
		
		$bt_table_name = $wpdb->prefix . "xdata_behavior_types";

		$insertSQL = "UPDATE " . $bt_table_name . " ";
		$insertSQL .= "SET bt_name = '" .$behaviorType['bt_name'] . "'" ;	
		$insertSQL .= " WHERE bt_id = " . $bt_id;

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