<?php

include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../models/QueryInterfaces.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR EditDataSourcesView

function EditTransformStudioView($transforms)
{
		
		$imageBaseURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/images/";

		$functionImage 	= plugins_url() . "/xdata-toolkit/images/transform.png";
		$editImage	= plugins_url() . "/xdata-toolkit/images/edit.png";
		$viewImage	= plugins_url() . "/xdata-toolkit/images/view.png";	

		$editURL 	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/EditTransformsView.php";
		$saveURL 	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/SaveTransformUpdateView.php";
		$genSSURL	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/genStylesheetView.php";
		$registerURL 	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/RegisterTransformsView.php";
		$deleteURL 	= plugins_url() . "/xdata-toolkit/modules/TransformStudio/DeleteTransformsView.php";
		$viewProfileURL = plugins_url() . "/xdata-toolkit/modules/TransformStudio/viewProfile.php";
		$parametersURL  = plugins_url() . "/xdata-toolkit/modules/TransformStudio/loadParameters.php";
		
		$content .= '<div id="functionTitleDiv"><div id="qsImage" class="functionImage"><img src="'.$functionImage.'"/></div><div id="qsTitle" class="functionTitle">';
		$content .= "<h2>XData Toolkit - TransformStudio</h2>";
		$content .= "</div></div>";

		$content .= '<div id="progressDiv"><img src="'.$imageBaseURL.'ajax-loader.gif" /></div>';		
		$content .= '<form method="post" id="myform" enctype="multipart/form-data" action="'. $_SERVER["REQUEST_URI"] . '">';
		$content .= '<input type="hidden" name="plugin_url" id="plugin_url" value="'.plugins_url().'"/>';
		$content .= '<input type="hidden" name="sortBy" id="sortBy" value="transform_id"/>';		
		$content .= '<input type="hidden" name="update" id="update" value=""/>';		
		$content .= '<input type="hidden" name="itemToModify" id="itemToModify" value=""/>';		
		$content .= '<input type="hidden" name="editURL" id="editURL" value="'.$editURL.'"/>';
		$content .= '<input type="hidden" name="genSSURL" id="genSSURL" value="'.$genSSURL.'"/>';				
		$content .= '<input type="hidden" name="saveURL" id="saveURL" value="'.$saveURL.'"/>';
		$content .= '<input type="hidden" name="registerURL" id="registerURL" value="'.$registerURL.'"/>';
		$content .= '<input type="hidden" name="deleteURL" id="deleteURL" value="'.$deleteURL.'"/>';
		$content .= '<input type="hidden" name="viewProfileURL" id="viewProfileURL" value="'.$viewProfileURL.'"/>';
		$content .= '<input type="hidden" name="parametersURL" id="parametersURL" value="'.$parametersURL.'"/>';		
		
		$content .= '<div id="tabvanilla" class="xdata-widget">';

		$content .= '<ul class="tabnav" class="xdata-widget">';
		$content .= '<li><a href="#transforms">Transforms</a></li>';
		$content .= '<li><a href="#transformRegistration">'.__('Edit Transform Registration','xdata-toolkit').'</a></li>';
		$content .= '<li><a href="#xmleditor">'.__('XML Source View','xdata-toolkit').'</a></li>';
		$content .= '<li><a href="#xsleditor">'.__('XSL Editor','xdata-toolkit').'</a></li>';		
		$content .= '<li><a href="#resultsview">'.__('Transform Results View','xdata-toolkit').'</a></li>';
		$content .= '<li><a href="#transformsource">'.__('TransformSource','xdata-toolkit').'</a></li>';
		$content .= '<li><a href="#registerTransform" onClick="register()"><strong>+</strong></a></li>';
		$content .= '</ul>';

		$content .= '<div id="transforms" class="tabdiv">';
		
		$editDropDown = deleteEditListItem();
			
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= '<thead><tr bgcolor="silver"><th></th>';
		$content .= "<th><a href='#' onClick='sort(\"transform_id\"); return false;'>".__('ID','xdata-toolkit')."</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"transform_name\"); return false;'>".__('Name','xdata-toolkit')."</a></th>";
		$content .= "<th><a href='#' onClick='sort(\"transform_file\"); return false;'>".__('File','xdata-toolkit')."</a></th>";		
		$content .= '</tr></thead><tbody>';
		
		$i = 1;
		
		foreach($transforms as $transform){
				$content .= "<tr bgcolor='white' id='row".$i."' class='highlight'>";
				$content .= '<td><a href="#" onClick="edit('. $transform->transform_id .'); return false;" alt="'.__('Edit Registration','xdata-toolkit').'">';
				$content .= '<img src="'.$editImage.'" alt="'.__('Edit Registration','xdata-toolkit').'"/></a>&nbsp;&nbsp;';
				$content .= '</a></td>';				
				$content .= "<td>" . $transform->transform_id . "</td>";
				$content .= "<td>" . $transform->transform_name . "</td>";
				$content .= "<td>";
				$content .= $transform->transform_file;
				$content .= "</td>";
				$content .= "</tr>";
				$i++;
		} 
		$content .= '</tbody></table>';
		
		$content .= '</div>';
		$content .= '<div id="transformRegistration" class="tabdiv">';
		$content .= '</div>';		
		$content .= '<div id="xmleditor" class="tabdiv">';
		

		$content .= '<select name="queryInterface" id="queryInterface">';
		
		$QueryInterfaces = new QueryInterfaces();		
		$queryInterfaces = $QueryInterfaces->getQueryInterfaces();
		if($queryInterfaces != null){
				foreach($queryInterfaces as $queryInterface)
				{
					$content .= '<option value="'.$queryInterface->qi_global_var.'">';
					$content .= $queryInterface->qi_global_var;
					$content .= '</option>';
				}
		}
		$content .= '</select>';
		$content .= '<input type="button" name="Load Query Interface" class="button-primary" id="loadQueryInterfaceButton" value="'.__('Load Query Interface','xdata-toolkit').'" onClick="getSourceDocuments()"/>';

		$content .= '<textarea name="xmldata" id="xmldata" class="lined" style="width:980px;height:500px"></textarea>';	
		
		$content .= '</div>';
		$content .= '<div id="xsleditor" class="tabdiv">';
		$content .= '<select name="insertFunction" id="insertFunction" >';
		$content .= '<option value="1">XML Declaration</option>';
		$content .= '<option value="2">xsl:stylesheet</option>';
		$content .= '<option value="3">xsl:template match</option>';
		$content .= '<option value="4">xsl:apply-templates</option>';
		$content .= '<option value="5">Alternating Row</option>';
		$content .= '<option value="6">xsl:choose</option>';
		$content .= '<option value="7">xsl:value-of select</option>';
		$content .= '<option value="8">xsl:comment</option>';
		$content .= '<option value="9">&amp;lt&#59;</option>';
		$content .= '<option value="10">&amp;gt&#59;</option>';		
		$content .= '</select>';
		
		$content .= '<input type="button" name="Insert Function" value="'.__('Insert','xdata-toolkit').'" onClick="insertFunc()">';

		$content .= '&nbsp;<font weight="bold">|</font>&nbsp;';
		$content .= '<input type="button" name="insertBold" value="B" style="font-weight: bold" onClick="insertMarkup(1)">';
		$content .= '<input type="button" name="insertItalic" value="i" style="font-weight: italics" onClick="insertMarkup(2)">';
		$content .= '<input type="button" name="insertLink" value="link" style="font-weight: underline" onClick="insertMarkup(3)">';
		$content .= '<input type="button" name="insertBlockQuote" value="b-quote" onClick="insertMarkup(4)">';
		$content .= '<input type="button" name="insertImage" value="img" onClick="insertMarkup(5)">';
		$content .= '<input type="button" name="insertUL" value="ul" onClick="insertMarkup(6)">';
		$content .= '<input type="button" name="insertOL" value="ol" onClick="insertMarkup(7)">';
		$content .= '<input type="button" name="insertLI" value="li" onClick="insertMarkup(8)">';
		$content .= '<input type="button" name="insertCode" value="code" onClick="insertMarkup(9)">';
		$content .= '<input type="button" name="insertMore" value="more" onClick="insertMarkup(10)">';
		$content .= '<input type="hidden" name="insertColor" id="insertColor" value="">';

		$content .= '&nbsp;<font weight="bold">|</font>&nbsp;';
		$content .= '<input type="button" name="transformXML" class="button-primary" value="'.__('Transform','xdata-toolkit').'" onClick="transformDoc()" style="font-weight:bold">';
		$content .= '&nbsp;<font weight="bold">|</font>&nbsp;';
		$content .= '<input type="hidden" id="transform_name" name="transform_name" value="countryDetail"/>';
		$content .= '<input type="hidden" id="transform_file_name" name="transform_file_name" value="countryDetailTransform.xsl"/>';
		$content .= '<input type="button" name="saveXSLDocument" class="button-primary" value="Save" onClick="saveTransformDocument()" style="font-weight:bold">';
		$content .= '&nbsp;<font weight="bold">|</font>&nbsp;';		
		$content .= '<input type="button" name="parameterButton" id="parameterButton" class="button-primary" value="Set Parameters" onClick="parameterDialog()" style="font-weight:bold"/>';				
		$content .= '<div id="colorSelector" style="width:22px;height:22px;background-color: #0000FF">';
		
		$content .= '<script>';
		
		$content .= "$('#colorSelector').ColorPicker({";
		$content .= "  flat: false,";
		$content .= "  color: '#0000ff',";
		$content .= "  onShow: function (colpkr) {";
		$content .= "  $(colpkr).fadeIn(100);";
		$content .= " return false;";
		$content .= "},";
		$content .= "onHide: function (colpkr,hex) { ";
		$content .= '  insertColor(document.getElementById("insertColor").value);';			
		$content .= "  $(colpkr).fadeOut(100);";
		$content .= " return false;";
		$content .= "},";
		$content .= "onChange: function (hsb, hex, rgb) {     ";
		$content .= "  $('#colorSelector').css('backgroundColor', '#' + hex);";
		$content .= '  document.getElementById("insertColor").value = "#" + hex;';
		$content .= "}";
		$content .= "});";	
		$content .= '</script>';
		
		$content .= '</div>';
		$content .= '<textarea name="xsldata" id="xsldata" class="lined" style="width:980px;height:500px" rows="100" cols="100"></textarea>';
		$content .= '<div id="parametersDiv" style="visibility:hidden"></div>';
		$content .= '</div>';
		
		
		$content .= '<div id="resultsview" name="transformedView" class="tabdiv">';

		$content .= '<div style="width:980px;height:500px"></div>';

		
		$content .= '</div>';
		
		$content .= '<div id="transformsource" class="tabdiv">';
		$content .= '<textarea name="resultsdata" id="resultsdata" class="lined" style="width:980px;height:500px" rows="100" cols="100"></textarea>';
		$content .= '</div>';
		$content .= '<div id="registerTransform" class="tabdiv">';
		$content .= '</div>';		
		
		$content .= '</div>';
		$content .= '</form>';
		echo $content;
}

?>