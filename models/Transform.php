<?php

class Transform {  
    public $transform_id;  
    public $transform_name;  
    public $transform_file;
    
    public function __construct($transform_id, $transform_name, $transform_file)
    {  
        $this->transform_id             = $transform_id;  
        $this->transform_name           = $transform_name;  
        $this->transform_file           = $transform_file;
    }
    
}

?>