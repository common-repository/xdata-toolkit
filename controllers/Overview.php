<?php

include_once dirname( __FILE__ ) . '/../helpers/commonPageFunctions.php';

function overview()
{
	// Load CSS Files
	commonFunctions();
	global $wp_version;

	$functionImage 	= plugins_url() . "/xdata-toolkit/images/queryInterface.png";
	$arrowImage  	= plugins_url() . "/xdata-toolkit/images/arrowright.png";
	$arrowDownImage = plugins_url() . "/xdata-toolkit/images/arrowdown.png";	
	$baImage  	= plugins_url() . "/xdata-toolkit/images/buildAutomate.png";
	$content .= '<div style="height: 900px">';
	
	$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>XData Toolkit - Version 1.9 - Overview</h2>";
	$content .= "</div></div>";
	$content .= "<div>";
	$content .= "<div id='RegisterDataSourcePanel'>";
	$content .= "<div id='RegisterDataSourcePanelTitle' class='panelTitle'><label id='numberLabel'>1.</label><label class='titleText'><a href='".get_admin_url()."admin.php?page=ListDataSources'>Register a Data Source</a></label></div>";
	$content .= "<p id='RegisterDataSourceText' class='overviewPanelText'>";
	$content .= "The first step is to register a Data Source.  This can be anything from a MySQL database, RSS Feed or another XML source.  This registration defines from where Query Interfaces can retrieve data.";
	$content .= "</p>";
	$content .= "</div>";
	$content .= "<div id='firstArrow' class='arrowPanel'><img src='".$arrowImage."'/></div>";
	$content .= "<div id='CreateQueryInterfacePanel'>";
	$content .= "<div id='CreateQueryInterfacePanelTitle' class='panelTitle'><label id='numberLabel'>2.</label><label class='titleText'><a href='".get_admin_url()."admin.php?page=ListQueryInterfaces'>Create a Query Interface</a></label></div>";	
	$content .= "<p id='CreateQueryInterfaceText' class='overviewPanelText'>";
	$content .= "The second step is to create a Query Interface.  This can be defined by creating a simple SQL query or a call to an XPath Axis.  A query can also be dynamically defined using the XData Toolkit's Dynamic Query Interface Builder, which allows one to build queries step-by-step in one user friendly interface.";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "<div id='secondArrow' class='arrowPanel'><img src='".$arrowImage."'/></div>";	
	$content .= "<div id='CreateTransformStudioPanel'>";
	$content .= "<div id='CreateTransformStudioPanelTitle' class='panelTitle'><label id='numberLabel'>3.</label><label class='titleText'><a href='".get_admin_url()."admin.php?page=TransformStudio'>Create a Stylesheet</a></label></div>";		
	$content .= "<p id='CreateTransformStudioText' class='overviewPanelText'>";
	$content .= "The third step is to create a stylesheet (or Transform) in TransformStudio.  This allows one to easily change the styling of dynamically-driven database data using XML Stylesheet Language and XSL Transformations.";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "<div id='rightLineDown'>&nbsp;</div>";
	$content .= "<div id='lineAcross'>&nbsp;</div>";
	$content .= "<div id='leftLineDown'>&nbsp;</div>";	
	$content .= "<div id='arrowDown'><img src='".$arrowDownImage."'/></div>";		
	$content .= "<div id='CreateQuerySchedulePanel'>";
	$content .= "<div id='CreateQuerySchedulePanelTitle' class='panelTitle'><label id='numberLabel'>4.</label><label class='titleText'><a href='".get_admin_url()."admin.php?page=QuerySchedules'>Schedule a Query</a></label></div>";		
	$content .= "<p id='CreateQueryScheduleText' class='overviewPanelText'>";
	$content .= "The fourth optional step is to create a schedule for Query Interfaces.  This scheduling system allows one to 'cron' a query, essentially allowing better performance by scheduling off query requests that require more processing to be run at more optimal times. <strong><em>Only in Free Professional Plugin.  Requires separate XPerformance Server License.  Does not run in WordPress.</em></strong>";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "<div id='thirdArrow' class='arrowPanel'><img src='".$arrowImage."'/></div>";	
	$content .= "<div id='EmbedQueryInterfacePanel'>";
	$content .= "<div id='EmbedQueryInterfacePanelTitle' class='panelTitle'><label id='numberLabel'>5.</label><label class='titleText'>Embed a Query Interface</label></div>";			
	$content .= "<p id='EmbedQueryInterfaceText' class='overviewPanelText'>";
	$content .= "The fifth step is to embed a Query Interface into one's WordPress pages, posts or widgets.  For pages and posts, this is done via the page or post text editor's tools.  Four widgets are provided in the XData Toolkit.  Embed a Query Interface in one's theme using the predefined shortcode <strong>[xdataqueryinterface queryint=\"projectList3\" type=\"page\" linked_item=\"no\"]</strong>.";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "<div id='fourthArrow' class='arrowPanel'><img src='".$arrowImage."'/></div>";	
	$content .= "<div id='ViewEmbeddedContentPanel'>";
	$content .= "<div id='ViewEmbeddedContentPanelTitle' class='panelTitle'><label id='numberLabel'>6.</label><label class='titleText'>View Embedded Content</label></div>";			
	$content .= "<p id='ViewEmbeddedContentText' class='overviewPanelText'>";
	$content .= "The sixth step is to view the content.  After Query Interfaces are embedded into posts and pages, one may use and reuse this data across their WordPress site.";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "<div id='CreditsPanel'>";
	$content .= "<img src='".$baImage."' id='buildAutomateLogo' width='240'>";
	$content .= "<p id='CreditsText' class='overviewPanelText'>";
	$content .= "The XData Toolkit was developed by <a href='http://www.vaughnbullard.com' target='_newWin'>Vaughn Bullard</a>, CEO and Founder of <a href='http://www.buildautomate.com' target='_newWin'>build.Automate, Inc.</a>  This toolkit was developed as a result of needing an easier way of building customer requested external database-driven dashboards in WordPress.  This software is provided as-is and is flexible enough to be embedded on just about any WordPress installation.  Check version requirements before using.  Technical Support and Knowledgebase support licenses are available for a nominal charge.  Customizations of this product are available through <a href='http://www.buildautomate.com' target='_newWin'>build.Automate, Inc.</a>.  Additionally, training courses can be provided.";
	$content .= "</p>";	
	$content .= "</div>";
	$content .= "</div>";
	$content .= "</div>";	

	echo $content;
}

?>