<?php
/*
Plugin Name: XData Toolkit
Version: 1.9
Description: The XData Toolkit is an XML/XSLT transformation engine that allows one to retrieve data from multiple datasources such as MySQL databases, XML, RSS Feeds and REST-based Web Services.  This toolkit is a powerful way to build your WordPress sites faster and more dynamically.  Integrate scores of different data sources into your site without the need for custom coding and style it using XML standards-based XSL Transformation.  Build queries online with the Dynamic Query Interface Builder.  Create stylesheets without expensive development tools!  Use the run-time parameters feature to create different versions of the same Query Interface.  Query Variables Registry allow you to use name, value pairs in your URL and use them as global variables.
Author: build.Automate, Inc.
Author URI: http://www.buildautomate.com/en
Plugin URI: http://www.buildautomate.com/en/open-source/xdata-toolkit/
License: GNU GPL v3 or later

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
register_activation_hook(__FILE__,'xdata_install');
register_deactivation_hook(__FILE__,'xdata_uninstall');
include_once dirname( __FILE__ ) . '/controllers/query/PerformQuery.php';
include_once dirname( __FILE__ ) . '/helpers/installer.php';

if (!class_exists("XDataToolkit")) {
	class XDataToolkit {
		var $adminOptionsName = "XDataToolkitAdminOptions";
		
		function XDataToolkit() { //constructor
								
		}
		function init() {
			$this->getAdminOptions();

		}
	
} //End Class XDataToolkit

if (class_exists("XDataToolkit")) {
	$xdataplugin = new XDataToolkit();
}

//Initialize the admin panel
if (!function_exists("XDataToolkit_ap")) {
	function XDataToolkit_ap() {
		global $xdataplugin;
		if (!isset($xdataplugin)) {
			return;
		}
		add_action('admin_menu', 'xdata_create_menu');		
		
	}	
}

include_once dirname( __FILE__ ) . '/helpers/functions.php';

function xdata_create_menu()
{
	//create new top-level menu
	
	add_menu_page('XData Toolkit',   'XData Toolkit ', 		'administrator', 'XDataToolkit', 'overview', 'http://buildautomate.com/favicon.ico',3 );
	add_submenu_page('XDataToolkit', 'Data Sources', 		'Data Sources', 		'administrator', 'ListDataSources',		'ListDataSources');
	add_submenu_page('XDataToolkit', 'QueryStudio', 		'QueryStudio', 			'administrator', 'ListQueryInterfaces', 	'ListQueryInterfaces');
	add_submenu_page('XDataToolkit', 'TransformStudio', 		'TransformStudio', 		'administrator', 'TransformStudio', 		'TransformStudio');
	add_submenu_page('XDataToolkit', 'Query Variables', 		'Query Variables', 		'administrator', 'QueryVarRegistry', 		'QueryVarRegistry');	
	add_submenu_page('XDataToolkit', 'Settings', 			'Settings', 			'administrator', 'XDataSettings', 		'XDataSettings');		
	add_submenu_page('XDataToolkit', 'Documentation', 		'Documentation', 		'administrator', 'Documentation', 		'Documentation');	
	add_submenu_page('XDataToolkit', 'Tech Support', 		'Tech Support', 		'administrator', 'TechSupport', 		'TechSupport');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
	add_action( 'admin_init', 'loadTranslation' );
}


function loadTranslation() {
	load_plugin_textdomain( 'xdata-toolkit', false, 'xdata-toolkit/languages' );
}

function register_mysettings() {
	//register XData Toolkit settings

	register_setting( 'xdata-settings-group', 'xdata_upload_dir' );
	register_setting( 'xdata-settings-group', 'license_name' );
	register_setting( 'xdata-settings-group', 'license_email' );
	register_setting( 'xdata-settings-group', 'license_phone' );
	register_setting( 'xdata-settings-group', 'license_server' );
	register_setting( 'xdata-settings-group', 'license' );
	register_setting( 'xdata-settings-group', 'xdata_query_variable_registry' );
	
}
// LOAD CONTROLLERS
include_once dirname( __FILE__ ) . '/controllers/Overview.php';
include_once dirname( __FILE__ ) . '/controllers/Settings.php';

// LOAD MODULES
include_once dirname( __FILE__ ) . '/modules/TransformStudio/Main.php';
include_once dirname( __FILE__ ) . '/modules/QueryInterfaces/Main.php';
include_once dirname( __FILE__ ) . '/modules/Datasources/Main.php';
include_once dirname( __FILE__ ) . '/modules/QueryVarRegistry/Main.php';
include_once dirname( __FILE__ ) . '/modules/TechSupport/Main.php';
include_once dirname( __FILE__ ) . '/modules/Documentation/Main.php';

// TinyMCE Editor Plugin
include_once dirname( __FILE__ ) . '/editor/config.php';

//Actions and Filters	
if (isset($xdataplugin)) {
	//Actions
	add_action('admin_menu', 'xdata_create_menu');	
	add_action('activate_XDataToolkit-plugin/XDataToolkit-plugin.php',  array(&$xdataplugin, 'init'));
	//Filters & Buttons
	add_filter('media_buttons_context', 'plugin_media_button', 0);
	add_filter('query_vars', 'parameter_queryvars' );
	//Shortcodes
	add_shortcode('xdataqueryinterface','performQuery');	
}


}
?>