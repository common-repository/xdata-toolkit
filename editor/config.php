<?php

function plugin_media_button($context) {
	
	$plugin_media_button = ' %s' . '<a href="'.plugins_url().'/xdata-toolkit/editor/editor-plugin.js.php?type=wp_myplugin&TB_iframe=true" title="Add An XData Query Interface" class="thickbox" alt="Add Query Interface">';
        $plugin_media_button .= '<img src="'.plugins_url().'/xdata-toolkit/editor/images/dbadd-small.png" border="0">';
        $plugin_media_button .= '</a>';
	return sprintf($context, $plugin_media_button);
}

?>