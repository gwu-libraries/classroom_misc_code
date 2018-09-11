<?php
include("/home/library/www/html/modules/events/php/classroom.php");
use Drupal\node\Entity\Node;

$rooms = $room_capabilities; 
//print_r($rooms); exit;

//echo count($rooms); exit;

for ($x = 0; $x <= 500; $x++) {
//for ($x = 501; $x <= 1000; $x++) {
//for ($x = 1001; $x <= 1500; $x++) {
//for ($x = 1501; $x <= 2000; $x++) {
//for ($x = 2001; $x <= 2500; $x++) {
//for ($x = 2501; $x <= 3000; $x++) {
//for ($x = 3001; $x <= 3500; $x++) {
//for ($x = 3501; $x <= 4000; $x++) {

$roomID = $rooms[$x]['room_id'];
$capabilityID = $rooms[$x]['capability_id'];

	$query = \Drupal::entityQuery('node')
	->condition('type', 'capability') 
	->condition('status', 1)
	->condition('field_capability_id', $capabilityID, '=');
	$nid = $query->execute();

	foreach ($nid as $key1 => $val2) {
		$cID = $val2;
	}	

	$query = \Drupal::entityQuery('node')
	->condition('type', 'room') 
    ->condition('status', 1)
    ->condition('field_room_id', $roomID, '=');
$nid = $query->execute();
	
	foreach ($nid as $key2 => $val1) {
		$rID = $val1;
	}
	
//echo $rID; exit;
$node = Node::load($rID); 
//echo count($node->field_capability_reference);
print_r($node);
	exit;
	
//$node->field_capability_reference[] = $cID;

		try {
			$node->save();
			echo "save successful for: ". $x ." ". $roomID . " & ". $cID .'<BR>';
			//print_r($room)."<BR>";
			print "<HR>";
		}
		catch (Exception $e) {
			echo "problem". '<BR>';
		}

		//$node->field_code_used_by[] = $user_id;
//print_r($node);

	$room = "";



	//break;
	
}

/*
	$node = Node::load($nid);     
    $node->field_campus_reference[] = $user_id;
    $node->save();
	
$data = "";
*/

?>