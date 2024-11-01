<?php

include_once dirname( __FILE__ ) . '/../../helpers/functions.php';

function QueryRegistryView()
{
	$content = "<h2>XData Toolkit - Query Variable Registry</h2>";
	$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';	
	settings_fields( 'xdata-settings-group' );
	$option = 'xdata_query_variable_registry';

	if( isset($_POST[$option])  )
	{
		$opt_val = $_POST[ $option ];
		update_option( $option, $opt_val );
	
		add_filter('query_vars', 'parameter_queryvars' );
		//parameter_queryvars( $qvars );
	}


	$content .= "<h4>Query Variables</h4>";
	$content .= "<h5>Please enter a comma delimited list of query variables that you may use in URLs and Query Interfaces.  For more information, visit the Technical Support Knowledgebase.</h5>";	
	$content .= '<ul>';
	$xqvr	  = get_option($option);
	
	$content .= '<input type="text" size="50" name="xdata_query_variable_registry" value="'.$xqvr.'"/><br/><br/><br/>';
	$content .= '<input type="submit" class="button-primary" value="Save Changes" />';
	$content .= '</form>';
	
	$content .= "<h5>The following Query Variables are reserved variables that you may use as XData Shortcode API Parameters</h5>";
	$content .= '<textarea height="50" width="80" style="margin-top: 0px; margin-bottom: 3px; height: 425px; margin-left: 0px; margin-right: 0px; width: 673px; ">
Each of these variables are used in shortcode parameters as {X_$$ParameterName}.  For example, to use the [pagename] variable within your shortcode, use {X_$$pagename} as the shortcode parameter variable.  Similarly, you may use your pre-defined variables defined in the same manner; for example, {X_$$yourqueryvariable}.

    [page]
    [pagename]
    [error]
    [m]
    [p]
    [post_parent]
    [subpost]
    [subpost_id]
    [attachment]
    [attachment_id]
    [name]
    [static]
    [page_id]
    [second]
    [minute]
    [hour]
    [day]
    [monthnum]
    [year]
    [w]
    [category_name]
    [tag]
    [cat]
    [tag_id]
    [author_name]
    [feed]
    [tb]
    [paged]
    [comments_popup]
    [meta_key]
    [meta_value]
    [preview]
    [s]
    [sentence]
    [fields] 
    [category__in]
    [category__not_in]
    [category__and]
    [post__in]
    [post__not_in]
    [tag__in]
    [tag__not_in]
    [tag__and]
    [tag_slug__in]
    [tag_slug__and]
    [ignore_sticky_posts]
    [suppress_filters]
    [cache_results]
    [update_post_term_cache]
    [update_post_meta_cache]
    [post_type] 
    [posts_per_page]
    [nopaging]
    [comments_per_page]
    [no_found_rows]
    [order]
</textarea>';
	echo $content;

}

?>