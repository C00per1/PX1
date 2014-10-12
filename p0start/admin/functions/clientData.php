<?php
//require '../../vendor/autoload.php';

$p1 = new person();
$p1->first = $opened['first'];
$p1->dob = $opened['dob'];
$p1->gender = $opened['gender'];
$p1->annualInflation = $opened['cola']/100;
$p1->pia = $opened['pia'];
$result = $p1->mainData();
$lastItem = count($result) - 1;
$age = $p1->age();
$dob = $p1->dobParts();
$dobYear = $dob[0];
$indexedEarningsArray = $p1->piaCalculation($dobYear, unserialize($opened['annualEarnings']), unserialize($opened['annualEarningsYear']));
//$test = $p1->piaCalculation($dobYear);
//$indexedEarningsArray = unserialize($opened['annualEarnings']);

$myArray1 = array();
$myArray2 = array();
$myArray3 = array();
$myArray4 = array();
for($i = 0; $i < count($result); $i++) {
	if($result[$i][6] > 0 && $result[$i][2] <= 840 ) {
		if($i == (count($result) - 1)){
			array_push($myArray1, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode($result[$i][6])."}");
		} else {
			array_push($myArray1, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode($result[$i][6])."}, ");
		}
		if($dob[2] == 1 && $result[$i][2] == 745) {//TO DO
			array_push($myArray2, $result[$i]);
			//} elseif ($result[0][2] > 744) {
			//	array_push($myArray2, $result[0]);//TO DO
		} elseif ($dob[2] != 1 && $result[$i][2] == 745) {
			array_push($myArray2, $result[$i]);
		}
		if ($result[$i][2] == $opened['fullRetirementAgeMonths']) {
			array_push($myArray4, $result[$i]);
		}
		if ($result[$i][2] == 840) {
			array_push($myArray3, $result[$i]);
		}
	}
	if($result[0][6] > 0) {
		array_push($myArray2, $result[0]);
	}
}

function array_max_recursive(array $array) {
    $max = NULL;
    $stack = array($array);

    do {
        $current = array_pop($stack);
        foreach ($current as $value) {
            if (is_array($value)) {
                $stack[] = $value;
            } elseif (filter_var($value, FILTER_VALIDATE_INT) !== FALSE) {
                // max(NULL, 0) returns NULL, so cast it
                $max = (int) max($max, $value);
            }
        }

    } while (!empty($stack));

    return $max;
}

$maxLifetimeBenefits = array_max_recursive($result);

function array_multi_search($array, $input){
	
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array));  
 
    foreach($iterator as $id => $sub){
        $subArray = $iterator->getSubIterator();
            if(@strstr(strtolower($sub), strtolower($input))){
                $subArray = iterator_to_array($subArray);
                $outputArray[] = array_merge($subArray, array('Matched' => $id));
            }
    }
 
    return $outputArray;
}

$ageMaxLifetimeBenefits = array_multi_search($result, $maxLifetimeBenefits);

?>


