<?php

include_once dirname( __FILE__ ) . '/../../controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
require_once("../../../../../wp-config.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

loadParameters();

function loadParameters()
{
    global $wpdb;
    
    $stylesheet = $_POST['stylesheet'];
    $tfParams   = "xdata_".$stylesheet."_tf_params";
    
    $content = "";
    $parameters = "";
    
    if($_POST['name0'])
    {
       for($increment = 0; $increment <= 100; $increment++)
       {
         $i = $increment - 1;
         $nameVal    = "name".$i;
         $fieldVal   = "value".$i;
         
         if($_POST[$nameVal])
         {
             $parameters .= $_POST[$nameVal]."::".$_POST[$fieldVal].":::";
         }else
         {
        
         }
         
       }
       
       $delimiter=":::";  
       $idx = lastIndexOf($parameters,$delimiter);
       $tfParameters = substr($parameters,0,$idx);
       update_option( $tfParams, $tfParameters );       
        
    }else{
       $tfParameters = "";
       
       if($_POST['command'] == "Save"){
                update_option( $tfParams, $tfParameters );
       }else{
        
       }
    }
    
    $transformparameters = get_option($tfParams);    

    $content .= "<h3>Run-Time Parameters</h3>";
    $content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';
    $content .= "<p>Add run-time parameters by clicking the + button for each new parameter and entering a name/value pair.  Then, when finished, click 'Save'.  ";
    $content .= '</p>';
    $content .= '<input type="button" name="addParameterButton" id="addParameterButton" class="button-primary" value="+" onClick="addRow(\'parameterTable\')" style="font-weight:bold; align: right"/>';
    $content .= '<table id="parameterTable">';
    
    if($transformparameters != null)
    {
        $explodedParams = explode(":::",$transformparameters);
                    
        $i = 0;
        
        foreach($explodedParams as &$explodedParam)
        {
            $param = explode("::",$explodedParam);
            $params[$param[0]] = $param[1];
            $content .= '<tr><td><input type="checkbox" name="checkbox'.$i.'"/><td><input type="text" id="name'.$i.'" value="'.$param[0].'" size="10"/></td><td><input type="text" id="value'.$i.'" value="'.$param[1].'" size="10" onKeyUp="checkReturn()"/></td></tr>';
            $i++;
        }
    }
    
    $content .= '</table>';
    $content .= '<div>';
    $content .= '<input type="button" name="DeleteParameters" id="DeleteParameters" class="button-primary" value="Delete Selected Rows" onClick="deleteRow(\'parameterTable\')" style="font-weight:bold;align:right"/><br/><br/>';
    $content .= '<input type="button" name="SaveParameters" id="SaveParameters" class="button-primary" value="Save" onClick="saveParameters()" style="font-weight:bold;align:right"/>';
    $content .= '</div>';
    
    echo $content;
}
function lastIndexOf($string,$item)
{  
    $index=strpos(strrev($string),strrev($item));  
    if ($index){  
        $index=strlen($string)-strlen($item)-$index;  
        return $index;  
    }  
        else  
        return -1;  
} 
?>