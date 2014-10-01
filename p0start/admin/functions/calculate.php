<?php
//Client FRA by YOB
function findFullRetirementAgeMonths($year) {
	if($year <= 1937) {
		$clientFRA = 65*12;
	} elseif($year == 1938) {
		$clientFRA = 65*12+2;
	} elseif($year == 1939) {
		$clientFRA = 65*12+4;
	} elseif($year == 1940) {
		$clientFRA = 65*12+6;
	} elseif($year == 1941) {
		$clientFRA = 65*12+8;
	} elseif($year == 1942) {
		$clientFRA = 65*12+10;
	} elseif($year >= 1943 && $year <= 1954) {
		$clientFRA = 66*12;
	} elseif($year == 1955) {
		$clientFRA = 66*12+2;
	} elseif($year == 1956) {
		$clientFRA = 66*12+4;
	} elseif($year == 1957) {
		$clientFRA = 66*12+6;
	} elseif($year == 1958) {
		$clientFRA = 66*12+8;
	} elseif($year == 1959) {
		$clientFRA = 66*12+10;
	} else {
		$clientFRA = 67*12;
	}
	return $clientFRA;
};

//Generate array of date, age, income
function monthlyData($x, $y, $annualInflation, $pia) {
	//$dob = $x;
	$today = date("Y-m-d");
	$start = (new DateTime($today))->modify('first day of this month');
	$end = new DateTime();
	$end->add(new DateInterval('P'.$y.'Y'));
	$interval = DateInterval::createFromDateString('1 month');
	$period = new DatePeriod($start, $interval, $end);
	$array = array();
	$total = 0;
	$i = 0;
	$thisPia = $pia;
	
	foreach ($period as $dt) {
		//$dateAdd = date_add($date, date_interval_create_from_date_string('1 month'));
		$i += 1;
		$dateIncrement = $dt->format("Y-m-t");
		$dateFormat = $dt->format("Y-m");
		$ageCalc = date_diff(date_create($dateIncrement), date_create($x));
		$ageFormat = $ageCalc->format('%Y-%m');

		(date("m", strtotime($dateIncrement)) == 1) ? $z = 1 : $z = 0;
		$growth = ($z == 0) ? 0 : $annualInflation*$z*$thisPia;
		$thisPia += $growth;
		$total += $thisPia;
		array_push($array, array($dateFormat, $ageFormat, $thisPia, $total));
	};
	return $array;
};
//Count # of elements in array
function arrayCount($a) {
	$c = count($a);
	return $c;
};

function lifeExpectancy() {
	
};

?>