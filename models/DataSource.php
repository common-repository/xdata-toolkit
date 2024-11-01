<?php

class DataSource {  
    public $ds_id;  
    public $ds_identifier;  
    public $ds_type;
    public $ds_username;
    public $ds_password;
    public $ds_port;
    public $ds_host_url;
    public $ds_name;
  
    public function __construct($ds_id, $ds_identifier, $ds_type,$ds_username,$ds_password,
                                $ds_port,$ds_host_url,$ds_name)  
    {  
        $this->ds_id            = $ds_id;  
        $this->ds_identifier    = $ds_identifier;  
        $this->ds_type          = $ds_type;
        $this->ds_username      = $ds_username;
        $this->ds_password      = $ds_password;
        $this->ds_port          = $ds_port;
        $this->ds_host_url      = $ds_host_url;
        $this->ds_name          = $ds_name;
    }
    
}

?>