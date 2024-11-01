<?php

class BehaviorType {  
    public $bt_id;  
    public $bt_name;  
    
    public function __construct($bt_id, $bt_name)
    {  
        $this->bt_id                    = $bt_id;  
        $this->bt_name                  = $bt_name;  
    }
    
}

?>