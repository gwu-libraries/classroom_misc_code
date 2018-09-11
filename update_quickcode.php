<?php
include("/home/library/www/html/modules/events/php/classroom.php");
use Drupal\node\Entity\Node;

//print_r($quickcodes); exit;

$rooms = $quickcodes;

foreach ($rooms as $room){

$softwareIDs = explode(";",$rooms['software_ids']);

		$query = \Drupal::entityQuery('node')
		->condition('type', 'quick_code') 
		->condition('status', 1)
		->condition('field_quick_code_id', $room['id'], '=');
		$nid = $query->execute();

		foreach ($nid as $key => $val1) {
		$qID = $val1;
		}

	
		$query = \Drupal::entityQuery('node')
		->condition('type', 'department') 
		->condition('status', 1)
		->condition('field_department_id', $room['department_id'], '=');
		$nid = $query->execute();

		foreach ($nid as $key => $val2) {
		$dID = $val2;
		}


	
	foreach ($softwareIDs as $softID){
	$query = \Drupal::entityQuery('node')
	->condition('type', 'software') 
	->condition('status', 1)
	->condition('field_software_id', $softwareID, '=');
	$nid = $query->execute();

		foreach ($nid as $key => $val3) {
		$sIDs[] = $val3;
		}


	}
	
	$quickCodeNode = Node::load($qID);

	$quickCodeNode->field_department_reference[] = $dID;

	   foreach($sIDs as $sID){
		$quickCodeNode->field_software_reference[] = $sID;
		}

		try {
			$quickCodeNode->save();
			echo "save successful for: ". $rooms['name']. '<BR>';
			print "<HR>";
		}
		catch (Exception $e) {
			echo "problem". '<BR>';
		}

	$quickCodeNode = "";
	$sIDs="";

}

?>