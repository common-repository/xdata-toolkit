<?php

//include_once("DataSource.php");
include_once dirname( __FILE__ ) . '/../models/DataSource.php';
include_once dirname( __FILE__ ) . '/../helpers/functions.php';

class DataSources {
	
	public function getDataSources()
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$queryIntSQL = "SELECT * from " . $datasources_table_name;
		$results = $wpdb->get_results($queryIntSQL);
		
		//$datasources[] = null;
		//$i = 0;
		
		foreach($results as $result){
			
			$datasources[$result->ds_id] 	= new DataSource($result->ds_id,
							  $result->ds_identifier,
							  $result->ds_type,
							  $result->ds_username,
							  decode5t($result->ds_password),
							  $result->ds_port,
							  $result->ds_host_url,
							  $result->ds_name);
		}		
		
		return $datasources;
	}
	
	public function getDBDataSources()
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$queryIntSQL = "SELECT * from " . $datasources_table_name." WHERE ds_type = 1";
		$results = $wpdb->get_results($queryIntSQL);
		
		//$datasources[] = null;
		//$i = 0;
		
		foreach($results as $result){
			
			$datasources[$result->ds_id] 	= new DataSource($result->ds_id,
							  $result->ds_identifier,
							  $result->ds_type,
							  $result->ds_username,
							  decode5t($result->ds_password),
							  $result->ds_port,
							  $result->ds_host_url,
							  $result->ds_name);
		}		
		
		return $datasources;
	}	
	
	public function getDataSourcesSorted($colName)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$queryIntSQL = "SELECT * from " . $datasources_table_name. " ORDER BY ".$colName;
		$results = $wpdb->get_results($queryIntSQL);
		
		$datasources[] = null;
		$i = 0;
		//echo 'Went through DataSources Model Class<br/>';
		foreach($results as $result){
			
			$datasources[$i] 	= new DataSource($result->ds_id,
							  $result->ds_identifier,
							  $result->ds_type,
							  $result->ds_username,
							  decode5t($result->ds_password),
							  $result->ds_port,
							  $result->ds_host_url,
							  $result->ds_name);
			$i++;
		}		
		
		return $datasources;
	}	
	
	public function getDataSource($ds_id)
	{
		$ds_id = $ds_id - 1;
		$dataSources = $this->getDataSources();
		return $dataSources[$ds_id];
	}
	
	public function getDataSourceTables($ds_id)
	{
		global $wpdb;	
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$sqlStatement = 'SELECT * FROM ' . $datasources_table_name .' WHERE ds_id = '.$ds_id;
	
		$DBresults = $wpdb->get_results($sqlStatement);
		
		//Connection's Parameters Initialization
		$db_host= "";
		$db_name=""; 
		$username="";
		$password="";
		$db_friendly_name = "";
		
		foreach($DBresults as $k=>$i){
			$db_host	= $i->ds_host_url . ":" . $i->ds_port;
			$db_name 	= $i->ds_name;
			$username	= $i->ds_username;
			$password	= decode5t($i->ds_password);
			$db_friendly_name = $i->ds_identifier;
		}
		
		$databaseConnection = mysql_connect($db_host, $username, $password);

		mysql_select_db($db_name,$databaseConnection);				
						
		$queryIntSQL = 'SHOW TABLES';
		
		$results     = mysql_query($queryIntSQL);
		
		return $results;	
		
	}
	public function getDataSourceById($datasourceID)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$queryIntSQL = "SELECT * from " . $datasources_table_name . " WHERE ds_id = " . $datasourceID;
		$results = $wpdb->get_results($queryIntSQL);
		
		$datasource = null;

		foreach($results as $result){
			
			$datasource	 	= new DataSource($result->ds_id,
							  $result->ds_identifier,
							  $result->ds_type,
							  $result->ds_username,
							  decode5t($result->ds_password),
							  $result->ds_port,
							  $result->ds_host_url,
							  $result->ds_name);
			
		}		
		
		return $datasource;
		
	}

	public function getTableFields($datasourceID,$tablename)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$sqlStatement = 'SELECT * FROM ' . $datasources_table_name .' WHERE ds_id = '.$datasourceID;
	
		$DBresults = $wpdb->get_results($sqlStatement);
		
		//Connection's Parameters
		$db_host= ""; 
		$db_name=""; 
		$username=""; 
		$password="";
		$db_friendly_name = "";
		
		foreach($DBresults as $k=>$i){
			$db_host	= $i->ds_host_url . ":" . $i->ds_port;
			$db_name 	= $i->ds_name;
			$username	= $i->ds_username;
			$password	= decode5t($i->ds_password);
			$db_friendly_name = $i->ds_identifier;
		}
			
		$databaseConnection = mysql_connect($db_host, $username, $password);

		mysql_select_db($db_name,$databaseConnection);				
						
		$tablename 	= 				
		$queryIntSQL = 'SHOW FIELDS FROM ' . $tablename ;
		
		$results     = mysql_query($queryIntSQL);
		
		return $results;
		
	}
	public function getNumberColumns($results)
	{
		$ncols = @mysql_num_fields ($results);
		return $ncols;
	}
	
	public function getDataSourceTableFields()
	{
		
		$queryIntSQL = 'SHOW FIELDS FROM ' . $queryInterfaceOptions['table'] ;		
	}
	
	public function deleteDataSource($ds_id)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";

		$insertSQL = "DELETE FROM " . $datasources_table_name . " ";
		$insertSQL .= " WHERE ds_id = " . $ds_id;
		
		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Deleted Data Source.", "XDataToolkit");
		}else{
			$content .= _e("DELETE Data Source - UNSUCCESSFUL.", "XDataToolkit");
		}			
		
	}
	
	public function insertDataSources($datasource)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		
		$idName			= "ds_id";
		$id	= getNextInsertID($datasources_table_name,$idName);

		$insertSQL = "INSERT INTO " . $datasources_table_name . " (ds_id,ds_identifier,ds_type,ds_username,ds_password,ds_port,ds_host_url,ds_name) ";
		$insertSQL .= "VALUES (".$id.",'". $datasource['ds_identifier'] . "'," . $datasource['ds_type'] . ",";
		$insertSQL .= "'".$datasource['ds_username'] . "','" . encode5t($datasource['ds_password']) . "'," . $datasource['ds_port'] . ", ";
		$insertSQL .= "'".$datasource['ds_host_url'] . "','" . $datasource['ds_name'] . "'";
		$insertSQL .= ")";

		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Saved New Data Source.", "XDataToolkit");
		}else{
			$content .= _e("Save New Data Source - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;		
		
	}
	
	public function updateDataSources($datasource,$ds_id)
	{
		global $wpdb;
		
		$datasources_table_name = $wpdb->prefix . "xdata_datasources";
		$password		= encode5t($datasource['ds_password']);

		$insertSQL = "UPDATE " . $datasources_table_name . " ";
		$insertSQL .= "SET ds_identifier = '" .$datasource['ds_identifier'] . "'" ;
		$insertSQL .= ", ds_type = " . $datasource['ds_type'] . "" ;
		$insertSQL .= ", ds_username = '" . $datasource['ds_username'] . "'" ;
		$insertSQL .= ", ds_password = '" . $password . "'" ;
		$insertSQL .= ", ds_port = " .$datasource['ds_port'] . " " ;
		$insertSQL .= ", ds_host_url = '" . $datasource['ds_host_url'] . "'" ;
		$insertSQL .= ", ds_name = '" . $datasource['ds_name'] . "'" ;
		$insertSQL .= " WHERE ds_id = " . $ds_id;

		if($results = $wpdb->query( $wpdb->prepare($insertSQL)))
		{
			$content .= _e("Updated Data Source.", "XDataToolkit");
		}else{
			$content .= _e("Update Data Source - UNSUCCESSFUL.", "XDataToolkit");
		}		

		
		return $content;
	}
	
}

?>