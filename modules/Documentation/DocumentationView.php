<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR DocumentationView

function DocumentationView()
{
        $ssURL		= plugins_url() . "/xdata-toolkit/modules/Documentation/css/style.css";
	$content 	.= '<LINK REL="StyleSheet" HREF="'.$ssURL.'" TYPE="text/css" MEDIA="screen">';
	
	// Load JavaScript Functions
        $jsURL		= plugins_url() . "/xdata-toolkit/modules/Documentation/js/functions.js";
        $jsTestDBCURL		= plugins_url() . "/xdata-toolkit/modules/Documentation/js/testDatabaseConnection.js";
	
        $content .= '<script src="'.$jsURL.'">';
        $content .= '</script>';
	$content .= '<script src="'.$jsTestDBCURL.'">';
	$content .= '</script>';
	
	// Pre-Defined Images
	$functionImage 	= plugins_url() . "/xdata-toolkit/images/documentation.png";

	$gsrURL 	= "http://www.buildautomate.com/helpdesk/open.php";
	$insHelpURL	= "http://www.buildautomate.com/alexander/documentation/installation";
	$dsHelpURL	= "http://www.buildautomate.com/alexander/documentation/datasources";
	$qsHelpURL	= "http://www.buildautomate.com/alexander/documentation/querystudio";
	$tsHelpURL	= "http://www.buildautomate.com/alexander/documentation/transformstudio";
	$qiHelpURL	= "http://www.buildautomate.com/alexander/documentation/query-interfaces";
	$qvHelpURL	= "http://www.buildautomate.com/alexander/documentation/query-variable-registry-api";
	$sptHelpURL	= "http://www.buildautomate.com/alexander/documentation/technical-support";
	
	$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>XData Toolkit - Documentation Topics</h2>";
	$content .= "</div></div>";
	
		$content .= '<div id="progressDiv"><img src="'.$imageBaseURL.'ajax-loader.gif" /></div>';			
	
		$content .= '<div id="tabvanilla" class="xdata-widget">';
		
		$content .= '<ul class="tabnav" class="xdata-widget">';
		$content .= '<li><a href="#panelOne">Installation</a></li>';
		$content .= '<li><a href="#panelTwo">Data Sources</a></li>';
		$content .= '<li><a href="#panelThree">Query Studio</a></li>';
		$content .= '<li><a href="#panelFour">TransformStudio</a></li>';
		$content .= '<li><a href="#panelFive">Query Interfaces</a></li>';
		$content .= '<li><a href="#panelSix">Query Variables</a></li>';
		$content .= '<li><a href="#panelSeven">Tech Support</a></li>';
		$content .= '</ul>';
				
		
		$content .= '<div id="panelOne" class="tabdiv">';
		
		$content .= '<iframe src="'.$insHelpURL.'" id="insWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelTwo" class="tabdiv">';
		
		$content .= '<iframe src="'.$dsHelpURL.'" id="dsWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelThree" class="tabdiv">';
		
		$content .= '<iframe src="'.$qsHelpURL.'" id="qsWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelFour" class="tabdiv">';
		
		$content .= '<iframe src="'.$tsHelpURL.'" id="tsWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelFive" class="tabdiv">';
		
		$content .= '<iframe src="'.$qiHelpURL.'" id="qiWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelSix" class="tabdiv">';
		
		$content .= '<iframe src="'.$qvHelpURL.'" id="qvWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		$content .= '<div id="panelSeven" class="tabdiv">';
		
		$content .= '<iframe src="'.$sptHelpURL.'" id="sptWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';		
		
		
		
		
	
		$content .= '</div>';
		$content .= '</form>';				
		
		echo $content;
}

?>