<?php

include_once dirname( __FILE__ ) . '/../../models/Transforms.php';

// VIEW FOR SaveTransformsView

function SaveTransformsView($Transforms,$postedData,$transformID)
{

		$action 		= $postedData['update'];
		$transform_id 		= $postedData['e_transform_id'];
		$transform_name		= $postedData['e_transform_name'];
		$transform_file		= $postedData['e_transform_file'];
		
		$TransformsUpdate = new Transforms();
		$transform[] = null;
		
		$transform['transform_id']	= $transform_id;
		$transform['transform_name']	= $transform_name;
		$content .= '<div id="executedAction">';
		
		if($transform['transform_id'] == null)
		{
				if ($_FILES["e_transform_file"]["error"] > 0)
				{
				    $content .= "Error: " . $_FILES["e_transform_file"]["error"] . "<br />";
				}else
				{
						//$content .= "Upload: " . $_FILES["e_transform_file"]["name"] . "<br />";
						//$content .= "Type: " . $_FILES["e_transform_file"]["type"] . "<br />";
						//$content .= "Size: " . ($_FILES["e_transform_file"]["size"] / 1024) . " Kb<br />";
						//$content .= "Stored in: " . $_FILES["e_transform_file"]["tmp_name"];

						$transform['transform_file']   = $_FILES["e_transform_file"]["name"];

						// variables for the field and option names 
						$option2 = 'xdata_upload_dir';
					
						// Read in existing option's values from database
						$xud		= get_option($option2);
					
						$clientTransformsDir 	= "";
						if($xud == "")
						{
							$clientTransformsDir	= dirname( __FILE__ ) . "/../../transforms/client/";
						}else{
						        $clientTransformsDir	= dirname( __FILE__ ) . $xud;
						}						
						
						if (file_exists($clientTransformsDir . $_FILES["e_transform_file"]["name"]))
						{
						   $content .= $_FILES["e_transform_file"]["name"] . " already exists. ";
						} else
						{
						   move_uploaded_file($_FILES["e_transform_file"]["tmp_name"],$clientTransformsDir . $_FILES["e_transform_file"]["name"]);
						   $content .= $TransformsUpdate->insertTransforms($transform);						   						   
						}				
						
					  
				}
	
		}else{
				$transform['transform_file']	= $transform_file;				
				$content .= $TransformsUpdate->updateTransforms($transform,$transform_id);
		}

		$content .= '</div>';
		
		echo $content;
}

?>