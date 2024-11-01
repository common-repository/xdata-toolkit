<?php

include_once dirname( __FILE__ ) . '/../models/QueryInterfaces.php';
require_once("../../../../wp-config.php");
//include_once dirname( __FILE__ ) . '/../helpers/functions.php';

getInterfaces();
//returnInterface();

function getInterfaces()
{
    $QueryInterfaces = new QueryInterfaces();		
    $queryInterfaces = $QueryInterfaces->getQueryInterfaces();
    $content            .= '<h3 class="media-title" style="background-color: #EEEEEE">Choose Query Interface</h3>';    
    //$content            .= '<div id="media-items">';
    $content            .= '<div style="background-color: silver">';
    $content            .= '<div id="queryInterfaceSelectorBox">';
    $content            .= '<form method="GET" name="selectForm">';
    
    $content            .= printPluginJavaScript();
    $content            .= '<p align="justify">';
    $content            .= '<select name="queryInterface" style="width:200px;height:200px" size="10" onChange="loadXMLDoc()">';
    foreach($queryInterfaces as $queryInterface){
            $content .= '<option value="'.$queryInterface->qi_global_var .'">' . $queryInterface->qi_global_var .'</option>';
    }
    $content            .= '</select>';
    $content            .= '<br/>';
    $content            .= '<input type="button" name="Select Query Interface" value="Select Query Interface" onClick="selectQueryInterface()">';
    $content            .= '<input type="hidden" name="plugin_url" id="plugin_url" value="'.plugins_url().'"/>';

    $content            .= '</p>';
    $content            .= '</div>';
    $content            .= '<div id="queryInterfaceOptionsBox"  style="position: absolute; top: 50; right:80">';
    $content            .= '<h3 class="media-title">Choose Options</h3>';
    $content            .= '<input type="checkbox" name="linked_item" id="linked_item">Linked Page?<br/>';
    $content            .= 'Name of Element: <input type="text" size="20" name="element_name" id="element_name"/><br/>';
    $content            .= 'Page To Link To: <input type="text" size="20" name="page" id="page"/><br/>';    
    $content            .= '</div>';
    $content            .= '</div>';    
    $content            .= '<div id="queryInterfaceResultsBox">';
    $content            .= '<h3 class="media-title">Query Results</h3>';
    $content            .= '<p id="queryResults">No Query Interface Selected</p>';
    $content            .= '</div>';    
    //$content            .= '</div>';
    $content            .= '</form>';    
    
    echo $content;
}

function printPluginJavaScript()
{
        
    $content .= '<script src="editor-behavior.js">';
    $content .= '</script>';            
    echo $content;
    
}

?>