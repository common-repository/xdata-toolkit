<?php

include_once dirname( __FILE__ ) . '/../../models/DataSources.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
require_once("../../../../../wp-config.php");

QueryBuilderView();

function QueryBuilderView()
{
	$choice = "SelectDataSource";
	$queryInterfaceOptions['datasource'] = "";
			
	// Load CSS Files
	//$cssThreeURL	= plugins_url() . "/xdata-toolkit/css/styles.css";
	//$content 	.= '<LINK REL="StyleSheet" HREF="'.$cssThreeURL.'" TYPE="text/css" MEDIA="screen">';
	
	$content .= "<h4>Query Builder</h4>";
	
	$content .=	"";
	
	
	$content .=	'<table border="1" style="width: 100%">';
	$content .= 	'<thead>';
	$content .= 	'<tr bgcolor="silver">';
	$content .=	'<th style="width: 210px"><strong>Select Datasource</strong></th>';
	$content .=	'<th style="width: 210px"><strong>Select Table</strong></th>';
	$content .= 	'<th style="width: 210px"><strong>Select Fields</strong>&nbsp;(Hold Down <Cmd> or <CTL> key for multiple fields)</th>';
	$content .= 	'<th style="width: 210px"><strong>Selection Criterion</strong></th>';
	$content .= 	'<th style="width: 210px"><strong>Actions</strong></th>';	
	$content .=	'</tr>';
	$content .= 	'</thead>';
	$content .= 	'<tbody>';
	$content .= 	'<tr>';
	$content .= 	'<td style="width: 210px">';
	$fieldName 	=   'datasource';
	$style		= 'width: 190px; height: 250px';
	$size		= '10';
	//$content .= 	dataSourceSelectBox($fieldName,null,$style,$size);
	
	$Datasources 	= new DataSources();
	$dataSources	= $Datasources->getDBDataSources();		
									
	$content .=   	'<select name="selectDataSource" id="selectDataSource" size="'.$size.'" style="'.$style.'" onChange="selectDS()">';

	foreach($dataSources as $dataSource)
	{
			$content .= '<option value="'.$dataSource->ds_id.'" '.$selected.'>'.$dataSource->ds_identifier.'</option>';		
	}

	$content .= '</select>';
	
	
	$content .= 	'</td>';
	$content .=	'<td style="width: 210px">';
	$content .=   	'<select name="selectTablesDiv[]" id="selectTablesDiv" size="'.$size.'" style="'.$style.'" MULTIPLE="MULTIPLE" onChange="selectFieldsFromTable()">';
	$content .=	'</select>';
	$content .= 	'</td>';
	$content .=	'<td style="width: 210px">';
	$content .=   	'<select name="selectFieldsDiv" id="selectFieldsDiv" size="'.$size.'" style="'.$style.'" MULTIPLE="MULTIPLE" onChange="buildSQLQuery()">';
	$content .=	'</select>';
	$content .=	'</td>';
	$content .=	'<td style="width: 210px">';
	$content .=   	'<textarea name="whereClauseDiv" id="whereClauseDiv" style="width: 210px; height: 250px" onKeyUp="buildSQLQuery()"></textarea>';
	$content .=	'</td>';
	$content .=	'<td style="width: 210px">';
	//$content .=   	'<center><input type="button" name="Evaluate Query" value="Evaluate Query" onClick="ReviewSQLView()"></center>';
	
	$content .= '<strong>Query Interface Name (What you call your datasource)</strong><br/>';		
	$content .= '<input type="text" name="qi_name" id="qi_name" size="30" value="" onKeyUp="buildQIName()"><br/>';	
	$content .= '<strong>Global Variable (What you would reference in shortcodes)</strong><br/>';
	$content .= '<input type="text" name="qi_global_var" id="qi_global_var" size="30" value=""><br/>';		
	$content .= '<strong>Behavior Type</strong><br/>';
	$fieldName	= 'qi_behavior_type';
	$func		= "zeroOut()";
	$content .= behaviorTypeSelectBox($fieldName,null,null,null,$func);	
	$content .= '<br/><strong>Caching Frequency</strong><br/>';
	$content .= '<input type="text" name="qi_cache_freq" id="qi_cache_freq" size="30"><br/>';
	$content .= '<br/><strong>Transform</strong><br/>';	
	$fieldName	= 'qi_transform_id';			
	$content .= transformSelectBox($fieldName,null,null,null);		
	$content .= '<br/><input type="hidden" name="update" value="Save QueryInterface"/><input type="hidden" name="qi_ds_id" id="qi_ds_id"/><input type="hidden" name="qi_query" id="qi_query"/><br/>';
	$content .= '<input type="button" class="button-primary" name="Save QueryInterface" value="Save QueryInterface" onClick="saveNewQueryInterfaceFromQB()"/>';
			
	
	$content .=	'</td>';	
	$content .= 	'</tr>';
	$content .= 	'</tbody>';
	$content .=	'</table>';

	$content .=	'<table border="1" style="width: 100%">';
	$content .= 	'<thead>';
	$content .= 	'<tr bgcolor="silver">';
	$content .=	'<th ><strong>SQL Query</strong></th>';
	$content .=	'</tr>';
	$content .= 	'</thead>';
	$content .= 	'<tbody>';
	$content .= 	'<tr>';
	$content .=   	'<td><textarea name="sqlQuery" id="sqlQuery" style="width: 100%; height: 50px" ></textarea></td>';
	$content .=	'</tr>';
	$content .= 	'</tbody>';
	$content .= 	'</table>';
	
	$content .=	'<table border="1" style="width: 100%">';
	$content .= 	'<thead>';
	$content .= 	'<tr bgcolor="silver">';
	$content .=	'<th><strong>Query Results</strong></th>';
	$content .=	'</tr>';
	$content .= 	'</thead>';
	$content .= 	'<tbody>';
	$content .= 	'<tr>';
	$content .=   	'<td><div id="queryResults"></div></td>';
	$content .=	'</tr>';
	$content .= 	'<tbody>';
	$content .= 	'</table>';	
/*
	$content .= '<div class="submit">';
	$content .= '<input type="submit" name="queryBuilder" value="Select Table" /></div>';
	$content .= '</form>';
	$content .= '</div>';*/
	
	$DBresults = null;
	$sqlStatement = null;
	
	echo $content;

}

?>