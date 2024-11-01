<?php

include_once dirname( __FILE__ ) . '/../../models/Transforms.php';
include_once dirname( __FILE__ ) . '/../../helpers/commonPageFunctions.php';
// Controller Class Defines Flow of Operation for Transforms

function TransformStudio()
{
	commonFunctions();
	echo '<div class="xdatatable" style="width: 95%">';

	if (isset($_POST['update'])) {
		$action = $_POST['update'];
		$transformID   = $_POST['itemToModify'];
		$postedData[]	= null;
		$postedData	= receivePostTransformStudioData();
	
		if($action == "Save Transform")
		{
			$Transforms = new Transforms();
			$transforms = $Transforms->getTransforms();
			
			include_once dirname( __FILE__ ) . '/../../modules/TransformStudio/SaveTransformsView.php';
			$content = SaveTransformsView($transforms,$postedData,$transformID);
			
			
		}
	}else{

	}
	showTransformsView();		
	echo '</div>';

	
}
function showTransformsView()
{
		$Transforms = new Transforms();
		
		$colName   = $_POST['sortBy'];		
		if($colName == null || $colName == "")
		{	$colName = "transform_id";}
		
		$transforms 	= $Transforms->getTransformsSorted($colName);
		
		include_once dirname( __FILE__ ) . '/../../modules/TransformStudio/EditTransformStudioView.php';
		$content = EditTransformStudioView($transforms);	
	
}
function receivePostTransformStudioData()
{
	$postData[] = null;
	
	$postData['update']		= $_POST['update'];
	$IDVal				= null;
	if($_POST['e_transform_id'])
	{
		$IDVal			= $_POST['e_transform_id'];
	}
	$postData['e_transform_id']	= $IDVal;		
	$postData['e_transform_name']	= $_POST['e_transform_name'];
	$postData['e_transform_file']	= $_POST['e_transform_file'];
		
	return $postData;		
}
?>