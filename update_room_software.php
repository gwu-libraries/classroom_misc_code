<?php
//exit;
include("/home/library/www/html/modules/learningspaces/php/classroom.php");
use Drupal\node\Entity\Node;

$frequency = 0;
//$frequency = 1;
$rooms = $room_softwares; 
//print_r($rooms); exit;

$total = (count($rooms)-1);
//$_upper = 1;
$_upper = 400;
	
	if ($_POST['lower']==""){
		$lower = 0;
	} else {
		$lower = (($_POST['upper']-$lower) + 1);	
	}

	if ($_POST['upper']==""){
		$upper = $_upper;
	} else {
		
		if ($total >= ($_POST['upper'] + $_upper)){
		$upper = ($_POST['upper'] + $_upper);
		} else {
			$upper = $total;
		}
		
	}


	

for ($x = $lower; $x <= $upper; $x++) {

$roomID = $rooms[$x]['room_id'];
$softwareID = $rooms[$x]['software_id'];
	
	//print_r($rooms[$x]);
	//exit;
	
	$query = \Drupal::entityQuery('node')
	->condition('type', 'software') 
	->condition('status', 1)
	->condition('field_software_id', $softwareID, '=');
	$nid = $query->execute();

	foreach ($nid as $key1 => $val2) {
		$sID = $val2;
	}	
	//echo $sID; exit;

	$query = \Drupal::entityQuery('node')
	->condition('type', 'room') 
    ->condition('status', 1)
    ->condition('field_room_id', $roomID, '=');
$nid = $query->execute();
	
	foreach ($nid as $key2 => $val1) {
		$rID = $val1;
	}
	
//echo $rID; exit;
$node = \Drupal::entityManager()->getStorage('node')->load($rID); 
 
	//print_r($node->field_software_reference->getValue());
	//exit;
	//echo "<HR>";

	//exit;
	
	
$node->field_software_reference[] = $sID; //add an element to the software reference
	
		try {
			$node->save();
			//$nid = $node->id;
			echo "save successful for: ". $x ." ". $roomID . " & ". $sID .'<BR>';
			//print_r($room)."<BR>";
			echo  "<HR>";
		}
		catch (Exception $e) {
			echo "problem". '<BR>';
		}

//$node->field_code_used_by[] = $user_id;
//print_r($node);
	
	

	$node = "";

}



/*
	$node = Node::load($nid);     
    $node->field_campus_reference[] = $user_id;
    $node->save();
	
$data = "";
*/

?>

<form action="/learningspaces/update_room_software" method="post" id="formtopost" name="formtopost">
	<input type="text" id="lower" name="lower" value="<?php echo $lower; ?>">of
	<input type="text" id="upper" name="upper" value="<?php echo $upper; ?>">
</form>

<?php 

if ( ($upper==1) || ($frequency == 1) ){
			break;
		}

if ( ($lower<=$upper) && ($frequency == 0) ){
		
?>
<script> 

window.onload = function(e){ 
    document.getElementById("formtopost").submit();
}

</script>
<?php } 
/*
SELECT *
FROM rooms
INNER JOIN room_softwares ON rooms.id = room_softwares.room_id
WHERE rooms.id = 291
*/
?>