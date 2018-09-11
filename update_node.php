<?php
include("/home/library/www/html/modules/events/php/classroom.php");
use Drupal\node\Entity\Node;

//print_r($quickcodes); exit;

foreach ($quickcodes as $quickcode){
	//echo $building['name']; exit;
	
$query = \Drupal::entityQuery('node')
	->condition('type', 'building') 
    ->condition('status', 1)
    ->condition('field_name', $quickcode['name'], '=');
$nid = $query->execute();
	
foreach ($nid as $key => $val) {
    $nid = $val;
}
	
	switch($quickcode['department_id']){
		case 1:
        $cID = 9;
        break;
			
		case 2:
        $cID = 10;
        break;
			
		case 3:
        $cID = 11;
        break;
			
		case 4:
        $cID = 12;
        break;
			
		case 5:
        $cID = 13;
        break;
			
	}


$node = Node::load($nid);
	
$field_software_reference = array(
    'target_id' => $cID,
);
//$node->$field_campus_reference = $field_campus_reference;
	$node->set('field_campus_reference', $cID);
	
    
	try {
		$node->save();
		echo "save successful for: ". $building['name']. '<BR>';
	}
	catch (Exception $e) {
		echo "problem". '<BR>';
	}

	//$node->field_code_used_by[] = $user_id;


$node = "";
	
	
	
}

/*
	$node = Node::load($nid);     
    $node->field_campus_reference[] = $user_id;
    $node->save();
	
$data = "";
*/

?>