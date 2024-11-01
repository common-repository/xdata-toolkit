<?php

class QueryInterface {  
    public $qi_id;  
    public $qi_name;  
    public $qi_global_var;
    public $qi_behavior_type;  
    public $qi_cache_freq;  
    public $qi_transform_id;
    public $qi_ds_id;  
    public $qi_query;  
    
    public function __construct($qi_id, $qi_name, $qi_global_var,$qi_behavior_type,$qi_cache_freq,$qi_transform_id,$qi_ds_id,$qi_query)
    {  
        $this->qi_id                    = $qi_id;  
        $this->qi_name                  = $qi_name;  
        $this->qi_global_var            = $qi_global_var;
        $this->qi_behavior_type         = $qi_behavior_type;
        $this->qi_cache_freq            = $qi_cache_freq;
        $this->qi_transform_id          = $qi_transform_id;
        $this->qi_ds_id                 = $qi_ds_id;
        $this->qi_query                 = $qi_query;
    }
    
}

?>