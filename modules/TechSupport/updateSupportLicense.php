<?php

require_once("../../../../../wp-config.php");
require_once("../../../../../wp-admin/includes/plugin.php");
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
include_once dirname( __FILE__ ) . '/../../modules/TechSupport/license.php';

$content .= updateSupportLicense();
echo $content;

?>