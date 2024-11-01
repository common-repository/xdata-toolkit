<?php

global $xdata_db_version;
$xdata_db_version = "1.7";

function xdata_install() {
   global $wpdb;
   global $xdata_db_version;

   $dstypes_table_name = $wpdb->prefix . "xdata_ds_types";
      
   $sql = "CREATE TABLE " . $dstypes_table_name . " (
        ds_type_id INT NOT NULL AUTO_INCREMENT,
        ds_type VARCHAR(45) NULL ,
        ds_desc VARCHAR(45) NULL ,
        PRIMARY KEY (ds_type_id)
   );";

   $sql = $sql . 'INSERT INTO '.$dstypes_table_name.' (ds_type,ds_desc) VALUES ("MySQL","MySQL Database");';
   $sql = $sql . 'INSERT INTO '.$dstypes_table_name.' (ds_type,ds_desc) VALUES ("XML","An XML source from an FTP or HTTP Location.");';
   $sql = $sql . 'INSERT INTO '.$dstypes_table_name.' (ds_type,ds_desc) VALUES ("RSS","A RSS Feed.");';   
   
   $datasources_table_name = $wpdb->prefix . "xdata_datasources";    
   $sql = $sql . "CREATE TABLE " . $datasources_table_name . " (
        ds_id INT NOT NULL AUTO_INCREMENT ,
        ds_identifier VARCHAR(45) NULL ,
        ds_type INT NULL ,
        ds_username VARCHAR(45) NULL ,
        ds_password VARCHAR(45) NULL ,
        ds_port INT NULL ,
        ds_host_url VARCHAR(200) NULL ,
        ds_name VARCHAR(45) NULL ,
            PRIMARY KEY (ds_id) 
   );";
   
   $behaviortypes_table_name = $wpdb->prefix . "xdata_behavior_types";    
   $sql = $sql . "CREATE TABLE " . $behaviortypes_table_name . " (
        bt_id INT NOT NULL AUTO_INCREMENT,
        bt_name VARCHAR(45) NULL ,
            PRIMARY KEY (bt_id)
   );";
   
   $sql = $sql . 'INSERT INTO '.$behaviortypes_table_name.' (bt_name) VALUES ("Dynamic");';
   $sql = $sql . 'INSERT INTO '.$behaviortypes_table_name.' (bt_name) VALUES ("Cached");';      

   $transforms_table_name = $wpdb->prefix . "xdata_transforms";    
   $sql = $sql . "CREATE TABLE " . $transforms_table_name . " (   
        transform_id INT NOT NULL AUTO_INCREMENT ,
        transform_name VARCHAR(45) NULL ,
        transform_file VARCHAR(45) NULL ,
            PRIMARY KEY (transform_id)
   );";
   $sql = $sql . 'INSERT INTO '.$transforms_table_name.' (transform_id,transform_name,transform_file) VALUES (0,"No Transform","NoTransform.xsl");';
   
   $queryints_table_name = $wpdb->prefix . "xdata_query_ints";    
   $sql = $sql . "CREATE TABLE " . $queryints_table_name . " (
        qi_id INT NOT NULL AUTO_INCREMENT ,
        qi_name VARCHAR(45) NULL ,
        qi_global_var VARCHAR(45) NULL ,
        qi_behavior_type INT NULL ,
        qi_cache_freq INT NULL ,
        qi_transform_id INT NULL ,
        qi_ds_id INT NULL ,
        qi_query VARCHAR(65000) NULL ,
        PRIMARY KEY (qi_id) 
   );";
   
   $querycache_table_name = $wpdb->prefix . "xdata_query_interface_cache";    
   $sql = $sql . "CREATE TABLE " . $querycache_table_name . " (   
        qc_id INT NOT NULL AUTO_INCREMENT,    
        qi_id INT NULL ,
        qc_last_cache_date DATETIME NULL ,
        qc_next_cache_date DATETIME NULL ,
        qc_query_results LONGTEXT NULL ,
        PRIMARY KEY (qc_id) 
   );";
   
   $queryschedules_table_name = $wpdb->prefix . "xdata_query_schedules";
   $sql = $sql . "CREATE TABLE " . $queryschedules_table_name . " (
                qs_id INT NOT NULL AUTO_INCREMENT,
                qs_name VARCHAR(45) NULL ,
                qs_description LONGTEXT NULL ,
                qs_qi_id INT NULL ,
                qs_cycle INT NULL ,
                qs_start_date DATETIME NULL ,
                qs_end_date DATETIME NULL ,
                qs_last_run_date DATETIME NULL ,
                qs_next_run_date DATETIME NULL ,
                qs_success_id INT NULL ,
                PRIMARY KEY (qs_id) 
   );";   
   
   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
 
   add_option("xdata_db_version", $xdata_db_version);
}

function xdata_uninstall() {
   global $wpdb;
   global $xdata_db_version;
/*
   $querycache_table_name = $wpdb->prefix . "xdata_query_interface_cache";    
   $dropsql = "DROP TABLE IF EXISTS " . $querycache_table_name;   
   $wpdb->query($dropsql);
   
   $queryints_table_name = $wpdb->prefix . "xdata_query_ints";    
   $dropsql = "DROP TABLE IF EXISTS " . $queryints_table_name;
   $wpdb->query($dropsql);   

   $transforms_table_name = $wpdb->prefix . "xdata_transforms";    
   $dropsql = "DROP TABLE IF EXISTS " . $transforms_table_name;
   $wpdb->query($dropsql);
*/
   $behaviortypes_table_name = $wpdb->prefix . "xdata_behavior_types";    
   $dropsql = "DROP TABLE IF EXISTS " . $behaviortypes_table_name;
   $wpdb->query($dropsql);
/*
   $datasources_table_name = $wpdb->prefix . "xdata_datasources";    
   $dropsql = "DROP TABLE IF EXISTS " . $datasources_table_name;
   $wpdb->query($dropsql);
*/
   $dstypes_table_name = $wpdb->prefix . "xdata_ds_types";    
   $dropsql = "DROP TABLE IF EXISTS " . $dstypes_table_name;
   $wpdb->query($dropsql);   

   //require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

 
}


?>