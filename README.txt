=== Plugin Name ===
Contributors: vaughnbullard
Donate link: http://www.buildautomate.com/en/xdata-toolkit/support/
Tags: XML, XSLT, MySQL, SQL, REST, Web Service, RSS, Feed, Database, Transform
Requires at least: 3.2.1
Tested up to: 3.3
Stable tag: 1.6

The XData Toolkit is an XML/XSLT transformation engine and Database Toolkit that uses many sources including MySQL, XML, RSS Feeds and Web Services.

== Description ==

The XData Toolkit is an XML/XSLT transformation engine and Database Toolkit that allows one to retrieve data from multiple datasources such as MySQL databases, XML, RSS Feeds and REST-based
Web Services.  This toolkit is a powerful way to build your WordPress sites faster and more dynamically.  Integrate scores of different data sources into your site without
the need for custom coding and style it using XML standards-based XSL Transformation.  Build queries online with the Dynamic Query Interface Builder.
Create stylesheets without expensive development tools!  Use the run-time parameters feature to create different versions of the same Query Interface.

Version 1.7 and 1.8 introduces dynamic variables and the Query Variable Registry.  You are now able to pass name/value pairs within your WordPress URL and use them dynamically as parameters in transformations and SQL queries.  Use the name/value pairs within other plugins as well.
Version 1.9 introduces Documentation and streamlined technical support.

Version 
Documentation and Installation Site

http://www.buildautomate.com/alexander/documentation

Demo Site

http://www.buildautomate.com/xdatademo

buildAutomate.com

http://www.buildautomate.com

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `xdata-toolkit.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin
3. Configure the plugin according to the installation instructions provided at http://www.buildautomate.com/alexander/documentation

== Screenshots ==

1. XData Toolkit Datasources Registry
2. XData Toolkit Dynamic Query Interface Builder
3. XData Toolkit TransformStudio
4. XData Toolkit TransformStudio - Inline Transform Results (View Before Publish)
5. XData Toolkit Technical Support - Built-in Ticketing Support
6. XData Toolkit Technical Support - Forums, Documentation and Knowledgebase
7. XData Toolkit Technical Support - Generate Support Request
8. XData Toolkit Page View
9. XData Toolkit Widget View
10. XData Toolkit Transform Studio - Run-Time XSL Parameters
11. XData Toolkit Page/Post Editor - Transform Parameters embedded within XDataQueryInterface Shortcode
12. XData Toolkit Documentation Module - Embedded Rich Media Experience for Documentation

== Changelog ==

= 1.6.1 =
* Fixed bug in the SaveTransformsView.php file that prevented uploading of Transforms
* Fix Versioning Issue with XData Simple Widget

= 1.6.2 =
* Fixed size bug in the installer.php file which prevented creation of the wp_xdata_query_ints table (Thanks to Fabre Lambeau for identification)

= 1.7 =
* New Feature Added - Run-Time Parameters within TransformStudio
* New Feature Added - Page/Post Editor - Embed Run-Time Parameters in XDataQueryInterface Shortcode - Visit http://www.buildautomate.com/alexander/documentation site for more information on how to use transformparameters attribute within the XDataQueryInterface shortcode
* Improvements to HTTP Basic AUTH - Made necessary changes throughout the codebase to fix missing elements and simple overloading of methods
* Improvements to Stylesheet Generation
* Clerical Changes to XData Simple Widget 
* Improvements in overall codebase to speed things up
* SQL Query Parameters - Due to unforeseen circumstances, this feature was put off to next minor release of 1.8.  More focus was placed on reliability and user experience of TransformStudio's new Run-Time Parameters feature.
* Change to Donate link within XDataToolkit plugin descriptor
* Added Service Features to Tech Support Module's Generate Support Request

= 1.8 =
* New Feature Added - Query Variable Registry Module - Pass Name/Value Pairs in the URL within WordPress
* New Feature Added - Query Variable Application Programming Interface (API)
* New Feature Added - Dynamic SQL Queries
* Modification to Transform Parameters Shortcode attribute, was X_$$transformparametername, modified to now {X_$$transformparametername}
* Refactoring of code in various modules

= 1.9 =
* Added New Documentation Module - embeds all Alexander Documentation into the XData Toolkit, including rich
* Took out Knowledgebase link, as it is in the New Documentation Module
* Refocused Technical Support feature to be more efficient
