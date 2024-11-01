<?php

require_once("../../../../../wp-config.php");

include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/functions.php';
// VIEW FOR EditTransformsView

$transformID = $_POST['itemToModify'];
//echo "Transform ID is ".$transformID;

EditTransformsView($transformID);

function EditTransformsView($transformID)
{
		$Transforms = new Transforms();
		$transforms = $Transforms->getTransforms();	
			
		$content .= '<table width="100%" border="1" class="wp-list-table widefat plugins">';
		$content .= '';

		$content .= '<thead><tr bgcolor="silver"><th>ID</th><th>Name</th><th>File</th></tr></thead><tbody>';
		
		foreach($transforms as $transform){
			if($transform->transform_id == $transformID)
			{
				$content .= "<tr bgcolor='white'>";
				$content .= "<td><input type='hidden' name='e_transform_id' id='e_transform_id' value='" . $transform->transform_id . "'/>". $transform->transform_id ."</td>";
				$content .= "<td><input type='text' size='15' name='e_transform_name' id='e_transform_name' value='" . $transform->transform_name . "'/></td>";				
				$content .= "<td><input type='text' size='15' name='e_transform_file' id='e_transform_file' value='" . $transform->transform_file . "'/></td>";

				$content .= "</tr>";
			}
		}
		$content .= '<tr><td colspan="3">';
		$content .= '<input type="hidden" name="update" value="Save Transform"/>';
		$content .= '<input type="button" class="button-primary" name="Save Transform" value="Save Transform" onClick="saveTransform()"/>';
		$content .= '<input type="button" class="button-primary" name="Delete Transform" value="Delete Transform" onClick="deleteTransform()"/>';
		$content .= '</td></tr>';		
		$content .= '</tbody></table>';
		
		echo $content;
}

?>