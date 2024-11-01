<?php

function XDataSettings()
{
	$content = "<h2>XData Toolkit - Settings</h2>";
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	
	settings_fields( 'xdata-settings-group' );
	$option2 = 'xdata_upload_dir';

	// Read in existing option's values from database
	$xud		= get_option($option2);

	if( isset($_POST['xdata_upload_dir'])  )
	{
		$opt_val = $_POST[ 'xdata_upload_dir' ];
		update_option( $option2, $opt_val );	
	}

	$content .= "<h4>Upload Directory For Stylesheets</h4>";
	$content .= "<h5>** WordPress User (User under which WordPress daemon runs) must have read/write access to this directory.  Must be relative to the TransformStudio directory.</h5>";	
	$content .= '<ul>';
	$xud	  = get_option('xdata_upload_dir');
	$content .= '<input type="text" size="50" name="xdata_upload_dir" value="'.$xud.'"/><br/><br/><br/>';
	$content .= '<input type="submit" class="button-primary" value="Save Changes" />';
	$content .= '</form>';
	echo $content;

}

?>