<?php

function updateSupportLicense()
{
	settings_fields('xdata-settings-group');
        
	// Read in existing option's values from database
        $option1 = 'license_name';
        $option2 = 'license_email';
        $option3 = 'license_phone';
        $option4 = 'license_server';
        $option5 = 'license';
        
	if( isset($_POST['name'])  )
	{
		$opt_val = $_POST[ 'name' ];
		update_option( $option1, $opt_val );
	}        
	if( isset($_POST['email'])  )
	{
		$opt_val = $_POST[ 'email' ];
		update_option( $option2, $opt_val ); 
	}
	if( isset($_POST['phone'])  )
	{
		$opt_val = $_POST[ 'phone' ];
		update_option( $option3, $opt_val ); 
	}
	if( isset($_POST['licensedServer'])  )
	{
		$opt_val = $_POST[ 'licensedServer' ];
		update_option( $option4, $opt_val );           
	}
	if( isset($_POST['supportLicense'])  )
	{
		$opt_val = $_POST[ 'supportLicense' ];
		update_option( $option5, $opt_val );           
	}                        
        
	$licenseName    = get_option($option1);
        $licenseEmail   = get_option($option2);
        $licensePhone   = get_option($option3);
        $licenseServer  = get_option($option4);
        $license        = get_option($option5);
        
	$content = "<h2>XData Toolkit - Support License</h2>";
	$content .= '<table width="100%" border="1" class="widefat">';		
	$content .= '<thead><tr bgcolor="silver"><th>Setting</th><th>Value</th></tr></thead>';			
	$content .= '<tbody><tr><td>';
	$content .= '<strong>License Point-Of-Contact</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="name" id="name" value="'.$licenseName.'" size="30">';
	$content .= '</td></tr>';			
	$content .= '<tr><td>';			
	$content .= '<strong>License E-Mail</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="email" id="email" value="'.$licenseEmail.'" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>License Contact Phone</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="phone" id="phone" value="'.$licensePhone.'" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Licensed Server</strong>';
	$content .= '</td><td>';			
	$content .= '<input type="text" name="licensedServer" id="licensedServer" value="'.$licenseServer.'" size="30">';
	$content .= '</td></tr>';
	$content .= '<tr><td>';			
	$content .= '<strong>Support License</strong>';
	$content .= '</td><td>';			
	$content .= '<textarea name="supportLicense" id="supportLicense" style="width: 300px;height: 300px">'.$license.'</textarea>';
	$content .= '</td></tr>';

	$content .= '</tbody></table>';
	$content .= '<div class="submit">';
	$content .= '<input type="hidden" name="update" value="Save DataSource"/>';
	$content .= '<input type="button" class="button-primary" name="Update" value="Update Support License" onClick="updateSupportLicense()"/>';
	$content .= '<input type="button" class="button-primary" name="Get Support License" value="Get Support License" onClick="purchaseSupportLicense()"/>';
	
	$content .= '</div>';	
	return $content;    
}

?>