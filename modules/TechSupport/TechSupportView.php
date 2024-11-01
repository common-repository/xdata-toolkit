<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
include_once dirname( __FILE__ ) . '/../../modules/TechSupport/license.php';
// VIEW FOR TechSupportView

function TechSupportView()
{
        $ssURL		= plugins_url() . "/xdata-toolkit/modules/TechSupport/css/style.css";
	$content 	.= '<LINK REL="StyleSheet" HREF="'.$ssURL.'" TYPE="text/css" MEDIA="screen">';
	
	// Load JavaScript Functions
        $jsURL		= plugins_url() . "/xdata-toolkit/modules/TechSupport/js/functions.js";
        $jsTestDBCURL		= plugins_url() . "/xdata-toolkit/modules/TechSupport/js/testDatabaseConnection.js";
	
        $content .= '<script src="'.$jsURL.'">';
        $content .= '</script>';
	$content .= '<script src="'.$jsTestDBCURL.'">';
	$content .= '</script>';
	
	// Pre-Defined Images
	$functionImage 	= plugins_url() . "/xdata-toolkit/images/techsupport.png";
	$vjbImage 	= plugins_url() . "/xdata-toolkit/images/vjb.jpg";
	
	$editURL 	= plugins_url() . "/xdata-toolkit/modules/TechSupport/EditTechSupportView.php";
	$saveURL 	= plugins_url() . "/xdata-toolkit/modules/TechSupport/SaveTechSupportView.php";
	$registerURL 	= plugins_url() . "/xdata-toolkit/modules/TechSupport/RegisterTechSupportView.php";
	$deleteURL 	= plugins_url() . "/xdata-toolkit/modules/TechSupport/DeleteTechSupportView.php";
	$gsrURL 	= "http://www.buildautomate.com/helpdesk/open.php";
	
	$viewProfileURL = plugins_url() . "/xdata-toolkit/modules/TechSupport/viewProfile.php";
	$updateSupportLicenseURL = plugins_url() . "/xdata-toolkit/modules/TechSupport/updateSupportLicense.php";
        $imageBaseURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/images/";	
	
	$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
	$content .= "<h2>XData Toolkit - Technical Support & Knowledgebase</h2>";
	$content .= "</div></div>";
	
		$content .= '<div id="progressDiv"><img src="'.$imageBaseURL.'ajax-loader.gif" /></div>';			
	
		$content .= '<div id="tabvanilla" class="xdata-widget">';
		
		$content .= '<ul class="tabnav" class="xdata-widget">';
		$content .= '<li><a href="#panelFive">Generate Support Request</a></li>';
		$content .= '<li><a href="#panelOne">Technical Support</a></li>';
		//$content .= '<li><a href="#panelTwo">Knowledgebase</a></li>';
		$content .= '<li><a href="#panelThree">Support License Configuration</a></li>';
		$content .= '<li><a href="#panelFour">Limitations</a></li>';
		
		$content .= '</ul>';
		
	
				
		$content .= '<div id="panelFive" class="tabdiv">';

	        $content .= '<form method="post" name="generateSupportRequestform" enctype="multipart/form-data" target="helpdeskWin" action="'. $gsrURL . '">';
		$content .= '<input type="hidden" name="updateSupportLicenseURL" id="updateSupportLicenseURL" value="'.$updateSupportLicenseURL.'"/>';
		$content .= '<input type="hidden" name="exportURL" id="exportURL" value="'.$exportURL.'"/>';
		$content .= '<input type="hidden" name="exportGetURL" id="exportGetURL" value="'.$exportGetURL.'"/>';		
	
	$content .= '<table width="100%" border="1" class="widefat">';		
	$content .= '<thead><tr bgcolor="silver"><th colspan="2">Support Request</th></tr></thead>';			
	$content .= '<tbody><tr><td>';
	$content .= '<strong>Subject</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="subject" id="subject" value="" size="35">';
	$content .= '</td></tr>';			
	$content .= '<tr><td>';			
	$content .= '<strong>Help Topic</strong>';
	$content .= '</td><td>';			
	$content .= '<select name="topicId"><option value="" selected="">Select One</option><option value="2">Billing</option><option value="3">Consulting</option><option value="4">Stylesheet Customization</option><option value="1">Support</option><option value="0">General Inquiry</option></select>';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Message</strong>';
	$content .= '</td><td>';			
	$content .= '<textarea name="message" id="message" style="width: 278px;height: 300px"></textarea>';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Attachments</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="file" name="attachment"> (Only .doc,.pdf,.jpg,.png)';
	$content .= '</td></tr>';
	$content .= '</tbody></table>';
	
            	
	
	$content .= '<div class="submit">';
	$content .= '<input type="hidden" name="update" value="Generate Support Request"/>';
	$content .= '<input type="hidden" name="submit_x" id="submit_x" value="Open Ticket"/>';
	$content .= '<input type="hidden" name="gsrURL" id="gsrURL" value="'.$gsrURL.'"/>';		
	$content .= '<input type="button" class="button-primary" name="Generate Support Request" value="Generate Support Request" onClick="generateSupportRequest()"/>';

		$content .= '</div>';
		$content .= '</div>';
		
		$content .= '<div id="panelOne" class="tabdiv">';
		
		$content .= '<iframe src="http://www.buildautomate.com/helpdesk/" id="helpdeskWin" width="100" height="600" style="width: 1000px;height: 600px"></iframe>';	
		$content .= '</div>';
		
		//$content .= '<div id="panelTwo" class="tabdiv">';

		//$content .= '<iframe src="http://buildautomate.com/alexander/" width="1000" height="600" style="width: 1000px;height: 600px"></iframe>';		
		//$content .= '</div>';

		
		$content .= '<div id="panelThree" class="tabdiv">';

		$content .= updateSupportLicense();
		$content .= '</div>';
		
		$content .= '<div id="panelFour" class="tabdiv">';
		
		$content .= "<h4>Limitations</h4>";
		$content .= "<div id='vjbImage'><img src='".$vjbImage."'></div>";
		$content .= "<div id='vjbShadowBox'>&nbsp;</div>";
		$content .= '<p id="limitationsText">Currently there are limitations to this WordPress plugin, but not a thing malevolent, guaranteed.  The limitations are in the software because time and other resources are limited.  This software is certainly customizable by you the WordPress developer.  However, I do have versions of the plugin that can be customized to your specific needs for any database server.  Due to this, I have purposefully limited the software so that you A) can develop the plugin further for your use, B) contact me to customize it for you or your company or C) expand upon it by building additional modules.<br/><br/>  I and my company, build.Automate are always available for consulting contracts.  A support license will guarantee you access to forums, knowledgebase, software and database hotfixes and a technical support ticketing contact.  You can reach me and my company at the following points-of-contact below:</p>';
		$content .= '<div id="pocs">';
		$content .= '<ul>';
		$content .= '<li><a href="http://www.buildautomate.com" target="_newWin">build.Automate</a></li>';
		$content .= '<li><a href="http://www.vaughnbullard.com" target="_newWin">Vaughn Bullard</a></li>';
		$content .= '</ul>';
		
		$content .= '</div>';		
		$content .= '</div>';				
		

		
		
	
		$content .= '</div>';
	$content .= '</form>';				
		
		echo $content;
}

?>