<?php

include_once dirname( __FILE__ ) . '/../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../models/DataSourceTypes.php';
include_once dirname( __FILE__ ) . '/../models/BehaviorTypes.php';
include_once dirname( __FILE__ ) . '/../models/Transforms.php';

function deleteEditListItem()
{
	$content .= '<script type="text/javascript">';
	$content .= 'function deleteEdit()';
	$content .= '{';
	$content .= '	var checked = false;';
	$content .= '	var update = document.getElementsByName("update")[0];';
	$content .= '	var updateValue = update.options.selectedIndex;';
	$content .= '	var updV = update.options[updateValue].value;';
	$content .= '	if(updV == "Add New") { checked = true; document.forms["myform"].submit(); }';
	$content .= '	var radios = document.getElementsByName("itemToModify");';

	$content .= '   if(radios)';
	$content .= '   {';
	$content .= '     for (var index=0; index < radios.length; index++)';
	$content .= '     {';
	$content .= '		if(radios[index].checked)';
	$content .= '		{';
	$content .= '			checked = true;';
	$content .= '			document.forms["myform"].submit();';
	$content .= '		}';
	$content .= '	  }';
	$content .= '   }';

	
	$content .= '   if(!checked){  alert("You have not selected an item to modify"); }';
	$content .= '}';
	$content .= '</script>';
	
	$content .= '<select name="update" id="update">';
	$content .= '<option value="Add New">Add New</option>';
	$content .= '<option value="Delete">Delete</option>';
	$content .= '<option value="Edit">Edit</option>';
	$content .= '</select>';
	$content .= '<input type="button" name="editItem" value="Apply" onClick="deleteEdit()"/>';
	
	return $content;
	
}
function behaviorTypeSelectBox($fieldName,$idx,$style,$size,$func)
{
	$BehaviorTypes	= new BehaviorTypes();
	$behaviorTypes  = $BehaviorTypes->getBehaviorTypes();	

	$styleToShow    = "";
	$sizeToShow     = "";
	if($style != null)
	{
		$styleToShow = ' style="'.$style.'"';
	}
	if($size != null)
	{
		$sizeToShow = ' size="'.$size.'"';
	}	
	
	$content .= '<select name="'.$fieldName.'" id="'.$fieldName.'" '.$styleToShow.' '.$sizeToShow.' onchange="'.$func.'">';
	
	if($behaviorTypes != null){
	foreach($behaviorTypes as $bType)
	{
		$selected = '';
		if($bType->bt_id == $idx){
				$selected = "selected";
		}		
		
		$content .= '<option value="'.$bType->bt_id.'" '.$selected.'>'.$bType->bt_name.'</option>';		
	}
	}
	$content .= '</select>';
	
	return $content;
}

function transformSelectBox($fieldName,$idx,$style,$size)
{
	$Transforms	= new Transforms();
	$transforms	= $Transforms->getTransforms();		
					
	$styleToShow    = "";
	$sizeToShow     = "";
	if($style != null)
	{
		$styleToShow = ' style="'.$style.'"';
	}
	if($size != null)
	{
		$sizeToShow = ' size="'.$size.'"';
	}	
	
	$content .= '<select name="'.$fieldName.'" id="'.$fieldName.'" '.$styleToShow.' '.$sizeToShow.'>';
	
	if($transforms != null){
		foreach($transforms as $transform)
		{
				$selected = '';
				if($transform->transform_id == $idx){
						$selected = "selected";
				}
				$content .= '<option value="'.$transform->transform_id.'" '.$selected.'>'.$transform->transform_name.'</option>';								
				
		}
	}
	$content .= "</select>";
	
	return $content;
}
function dataSourceSelected($idx)
{
	$DataSources	= new DataSources();
	$dataSources	= $DataSources->getDataSources();	
	
	$content 	= '';
	if($dataSources != null){
		foreach($dataSources as $dataSource)
		{
				if($idx == $dataSource->ds_id){
						$content .= $dataSource->ds_identifier;
				}
		}
	}
	return $content;
	
}
function dataSourceSelectBox($fieldName,$idx,$style,$size)
{
	$DataSources	= new DataSources();
	$dataSources	= $DataSources->getDataSources();	
	
	$styleToShow    = "";
	$sizeToShow     = "";
	if($style != null)
	{
		$styleToShow = ' style="'.$style.'"';
	}
	if($size != null)
	{
		$sizeToShow = ' size="'.$size.'"';
	}	
	
	$content .= '<select name="'.$fieldName.'" id="'.$fieldName.'" '.$styleToShow.' '.$sizeToShow.'>';

	if($dataSources != null)
	{
		foreach($dataSources as $dataSource)
		{
			$selected = '';
			if($idx == $dataSource->ds_id){
					$selected = "selected";
			}
			$content .= '<option value="'.$dataSource->ds_id.'" '.$selected.'>'.$dataSource->ds_identifier.'</option>';		
		}
	}
	$content .= '</select>';
	
	return $content;
	
}

function dataSourceTypeSelectBox($fieldName,$idx,$style,$size)
{
	$DataSourceTypes	= new DataSourceTypes();
	$dataSourceTypes  = $DataSourceTypes->getDataSourceTypes();					
	
	$styleToShow    = "";
	$sizeToShow     = "";
	if($style != null)
	{
		$styleToShow = ' style="'.$style.'"';
	}
	if($size != null)
	{
		$sizeToShow = ' size="'.$size.'"';
	}	
	
	$content .= '<select name="'.$fieldName.'" id="'.$fieldName.'" '.$styleToShow.' '.$sizeToShow.'>';
							
	if($dataSourceTypes != null){								
	foreach($dataSourceTypes as $dataSourceType)
	{
			$selected = '';
			if($idx == $dataSourceType->ds_type_id){
					$selected = "selected";
			}
			$content .= '<option value="'.$dataSourceType->ds_type_id.'" '.$selected.'>'.$dataSourceType->ds_type.'</option>';		
	}
	}
	$content .= '</select>';	
	
	return $content;
}

function printListTableHeader()
{
	
	$content = '<table width="80%" border="1" class="wp-list-table widefat plugins" cellspacing="0">';
	return $content;
}

function getNextInsertID($tablename,$idName)
{
	global $wpdb;
		
		$rowStatusSQL 	= "SELECT MAX(".$idName.") as max_id FROM ".$tablename;

		$lastResults 		= $wpdb->get_results( $wpdb->prepare($rowStatusSQL));

		$lastID 		= null;
		
		foreach($lastResults as $lastresult){
			$lastID 	= $lastresult->max_id;
		}		

		$lastID++;
		
	return intval($lastID);
}
function getMaxID($tablename,$idName)
{
	global $wpdb;
		
		$rowStatusSQL 	= "SELECT MAX(".$idName.") as max_id FROM ".$tablename;

		$lastResults 		= $wpdb->get_results( $wpdb->prepare($rowStatusSQL));

		$lastID 		= null;
		
		foreach($lastResults as $lastresult){
			$lastID 	= $lastresult->max_id;
		}		

		
	return intval($lastID);
}
function printQIJavaScript()
{
	$content .= '<script type="text/javascript">';
	$content .= 'function zeroOut()';
	$content .= '{';
	$content .= '	var qi = document.getElementsByName("qi_behavior_type")[0];';
	$content .= '	var qiValue = qi.options.selectedIndex;';
	$content .= '	var qiV = qi.options[qiValue].value;';

	$content .= '	var queryInterface = document.getElementsByName("qi_behavior_type");';	
	$content .= '   if(qiV == 1)';
	$content .= '   {';
	$content .= '     document.getElementById("qi_cache_freq").value = 0;';
	$content .= '   }else{';
	$content .= ' 	   if(document.getElementById("qi_cache_freq").value <= 60){';
	$content .= '		alert("Please Change Your Caching Frequency to something greater than 60 Seconds");';
	$content .= '      }';
	$content .= '   }';

	$content .= '}';
	$content .= '</script>';	
	
	
	return $content;
	
}

//function to encrypt the string
function encode5t($str)
{
  for($i=0; $i<5;$i++)
  {
    $str=strrev(base64_encode($str)); //apply base64 first and then reverse the string
  }
  return $str;
}

//function to decrypt the string
function decode5t($str)
{
  for($i=0; $i<5;$i++)
  {
    $str=base64_decode(strrev($str)); //apply base64 first and then reverse the string}
  }
  return $str;
}

function getRSSasXML($xml)
{
	echo "got here";
	
}

function parameter_queryvars( $qvars )
{
	$option = 'xdata_query_variable_registry';
	$xqvr	  = get_option($option);	

	$explodedVars = explode(",",$xqvr);
	
	foreach($explodedVars as &$explodedVar)
	{
		array_push($qvars,$explodedVar);
	}	
	
	return $qvars;
}

?>