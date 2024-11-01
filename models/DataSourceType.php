<?php

class DataSourceType {  
    public $ds_type_id;  
    public $ds_type;
    public $ds_desc;
    
    public function __construct($ds_type_id, $ds_type, $ds_desc)
    {  
        $this->ds_type_id               = $ds_type_id;  
        $this->ds_type                  = $ds_type;
        $this->ds_desc                  = $ds_desc;
    }
    
}

?>