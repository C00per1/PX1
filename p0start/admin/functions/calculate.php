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

//Generate array
//input dob, lifeRemaining, annualInflation, pia, ageToFraMonths
function monthlyData($x, $y, $annualInflation, $pia, $ageToFraMonths, $ageToSixtyTwoBool, $dobYear, $dobMonth, $dobDay) {
	$lifeEx = explode('.', $y);
	$leYear = $lifeEx[0];
	$leMonth = round($lifeEx[1]*12/100);

	$today = date("Y-m-d");
	if ($ageToSixtyTwoBool == TRUE) {
		$newDobYear = $dobYear + 62;
		$today = date("Y-m-d", strtotime($newDobYear."-".$dobMonth."-".$dobDay));
	};

	$start = (new DateTime($today))->modify('first day of this month');
	$end = new DateTime();
	
	//TO DO: add months to end interval
	$end->add(new DateInterval('P'.$leYear.'Y'/*.$leMonth.'M'*/));
	$interval = DateInterval::createFromDateString('1 month');
	$period = new DatePeriod($start, $interval, $end);
	$array = array();
	$total = 0;
	$i = 0;
	$thisPia = $pia;
	//(date("d", $x == 1)) ? $ageToFraMonths += 1 : $ageToFraMonths;
	
	foreach ($period as $dt) {
		//$dateAdd = date_add($date, date_interval_create_from_date_string('1 month'));
		$i += 1;
		$dateIncrement = $dt->format("Y-m-t");
		$dateFormat = $dt->format("Y-m");
		$dateFormatYear = $dt->format("Y");
		$ageCalc = date_diff(date_create($dateIncrement), date_create($x));
		$ageFormat = $ageCalc->format('%Y-%m');
		$exAgeFormat = explode('-', $ageFormat);
		$ageMonths = $exAgeFormat[0] * 12 + $exAgeFormat[1];
		$ageToFraMonths -= 1;
		$piaAdjustment = piaAdjustment($ageToFraMonths, $ageMonths, $x);

		(date("m", strtotime($dateIncrement)) == 1) ? $z = 1 : $z = 0;
		$growth = ($z == 0) ? 0 : $annualInflation*$z*$thisPia;
		$thisPia += $growth;
		$adjustedPia = ($piaAdjustment == 0) ? 0 : $thisPia + ($thisPia * ($piaAdjustment/100));
		array_push($array, array($dateFormat, $ageFormat, $thisPia, $adjustedPia, $dateFormatYear, $ageToFraMonths, $piaAdjustment));
	};
	return $array;
};

function piaAdjustment($monthsToFra, $ageMonths, $x) {
	$year = date("Y", strtotime($x));
	if($monthsToFra > 0) {
		if($monthsToFra <= 36 && $monthsToFra > 0) {
			$reduction = $monthsToFra * (5/9);
		} elseif($monthsToFra > 36 && $ageMonths > 744) {
			$reduction = ($monthsToFra - 36) * (5/12) + 20.0;
		} else {
			$reduction = 0;
		}
		$adjustment = -$reduction;
	
	} elseif ($monthsToFra < 0) {
		if($year >= 1943) {
			$credit = $monthsToFra * (2/3);
			if($year >= 1943 && $year <= 1954 && $credit <= -32){
				$credit = -32;
			} elseif($year == 1955 & $credit <= (-30*(2/3))){
				$credit = (-30*(2/3));
			} elseif($year == 1956 & $credit <= (-29*(1/3))){
				$credit = (-29*(1/3));
			} elseif($year == 1957 & $credit <= -28){
				$credit = -28;
			} elseif($year == 1958 & $credit <= (-26*(2/3))){
				$credit = (-26*(2/3));
			} elseif($year == 1959 & $credit <= (-25*(1/3))){
				$credit = (-25*(1/3));
			} elseif($year >= 1960 && $credit <= -24) {
				$credit = -24;
			}
		} elseif($year == 1933 || $year == 1934) {
			$credit = $monthsToFra * (11/24);
			($credit <= -27.5) ? $credit = -27.5 : $credit;
		} elseif($year == 1935 || $year == 1936) {
			$credit = $monthsToFra * (1/2);
			($credit <= -30) ? $credit = -30 : $credit;
		} elseif($year == 1937 || $year == 1938) {
			$credit = $monthsToFra * (13/24);
			if($year == 1937 && $credit <= -32.5){
				$credit = -32.5;
			} elseif ($year == 1938 && $credit <= (-31*(5/12))) {
				$credit = (-31*(5/12));
			}
		} elseif($year == 1939 || $year == 1940) {
			$credit = $monthsToFra * (7/12);
			if($year == 1939 && $credit <= (-32*(2/3))){
				$credit = (-32*(2/3));
			} elseif ($year == 1940 && $credit <= -31.5) {
				$credit = -31.5;
			}
		} elseif($year == 1941 || $year == 1942) {
			$credit = $monthsToFra * (5/8);
			if($year == 1941 && $credit <= -32.5){
				$credit = -32.5;
			} elseif ($year == 1942 && $credit <= -31.25) {
				$credit = -31.25;
			}
		} else {
			$credit = 0;
		}
		$adjustment = -$credit;
	} else {
		$credit = 0;
		$adjustment = -$credit;
	}
	return $adjustment;
};

function ageGreaterSixtyTwo ($ageCurrentMonths) {
	if($ageCurrentMonths > 744) {
		$ageSixtyTwoBool = TRUE;
	} else {
		$ageSixtyTwoBool = FALSE;
	}
	return $ageSixtyTwoBool;
};

function lifeExpectancy($gender, $a) {
	if ( $a == 0 ) { $v = array(75.9, 80.81);
	} elseif ( $a == 1 ) { $v = array(75.43, 80.28);
	} elseif ( $a == 2 ) { $v = array(74.46, 79.31);
	} elseif ( $a == 3 ) { $v = array(73.48, 78.32);
	} elseif ( $a == 4 ) { $v = array(72.5, 77.34);
	} elseif ( $a == 5 ) { $v = array(71.51, 76.35);
	} elseif ( $a == 6 ) { $v = array(70.53, 75.36);
	} elseif ( $a == 7 ) { $v = array(69.54, 74.37);
	} elseif ( $a == 8 ) { $v = array(68.55, 73.38);
	} elseif ( $a == 9 ) { $v = array(67.55, 72.39);
	} elseif ( $a == 10 ) { $v = array(66.56, 71.39);
	} elseif ( $a == 11 ) { $v = array(65.57, 70.4);
	} elseif ( $a == 12 ) { $v = array(64.57, 69.41);
	} elseif ( $a == 13 ) { $v = array(63.58, 68.41);
	} elseif ( $a == 14 ) { $v = array(62.6, 67.42);
	} elseif ( $a == 15 ) { $v = array(61.62, 66.44);
	} elseif ( $a == 16 ) { $v = array(60.64, 65.45);
	} elseif ( $a == 17 ) { $v = array(59.68, 64.47);
	} elseif ( $a == 18 ) { $v = array(58.72, 63.49);
	} elseif ( $a == 19 ) { $v = array(57.77, 62.51);
	} elseif ( $a == 20 ) { $v = array(56.83, 61.53);
	} elseif ( $a == 21 ) { $v = array(55.89, 60.56);
	} elseif ( $a == 22 ) { $v = array(54.96, 59.58);
	} elseif ( $a == 23 ) { $v = array(54.03, 58.61);
	} elseif ( $a == 24 ) { $v = array(53.11, 57.64);
	} elseif ( $a == 25 ) { $v = array(52.18, 56.67);
	} elseif ( $a == 26 ) { $v = array(51.25, 55.7);
	} elseif ( $a == 27 ) { $v = array(50.32, 54.73);
	} elseif ( $a == 28 ) { $v = array(49.39, 53.76);
	} elseif ( $a == 29 ) { $v = array(48.45, 52.79);
	} elseif ( $a == 30 ) { $v = array(47.52, 51.82);
	} elseif ( $a == 31 ) { $v = array(46.59, 50.86);
	} elseif ( $a == 32 ) { $v = array(45.65, 49.89);
	} elseif ( $a == 33 ) { $v = array(44.72, 48.93);
	} elseif ( $a == 34 ) { $v = array(43.79, 47.97);
	} elseif ( $a == 35 ) { $v = array(42.86, 47.01);
	} elseif ( $a == 36 ) { $v = array(41.93, 46.05);
	} elseif ( $a == 37 ) { $v = array(41, 45.09);
	} elseif ( $a == 38 ) { $v = array(40.07, 44.14);
	} elseif ( $a == 39 ) { $v = array(39.15, 43.19);
	} elseif ( $a == 40 ) { $v = array(38.23, 42.24);
	} elseif ( $a == 41 ) { $v = array(37.31, 41.29);
	} elseif ( $a == 42 ) { $v = array(36.4, 40.35);
	} elseif ( $a == 43 ) { $v = array(35.5, 39.42);
	} elseif ( $a == 44 ) { $v = array(34.6, 38.49);
	} elseif ( $a == 45 ) { $v = array(33.7, 37.56);
	} elseif ( $a == 46 ) { $v = array(32.82, 36.64);
	} elseif ( $a == 47 ) { $v = array(31.94, 35.73);
	} elseif ( $a == 48 ) { $v = array(31.06, 34.82);
	} elseif ( $a == 49 ) { $v = array(30.2, 33.92);
	} elseif ( $a == 50 ) { $v = array(29.35, 33.02);
	} elseif ( $a == 51 ) { $v = array(28.5, 32.13);
	} elseif ( $a == 52 ) { $v = array(27.66, 31.24);
	} elseif ( $a == 53 ) { $v = array(26.84, 30.36);
	} elseif ( $a == 54 ) { $v = array(26.02, 29.48);
	} elseif ( $a == 55 ) { $v = array(25.21, 28.6);
	} elseif ( $a == 56 ) { $v = array(24.41, 27.73);
	} elseif ( $a == 57 ) { $v = array(23.61, 26.87);
	} elseif ( $a == 58 ) { $v = array(22.82, 26);
	} elseif ( $a == 59 ) { $v = array(22.04, 25.15);
	} elseif ( $a == 60 ) { $v = array(21.27, 24.3);
	} elseif ( $a == 61 ) { $v = array(20.5, 23.46);
	} elseif ( $a == 62 ) { $v = array(19.74, 22.63);
	} elseif ( $a == 63 ) { $v = array(18.99, 21.81);
	} elseif ( $a == 64 ) { $v = array(18.24, 20.99);
	} elseif ( $a == 65 ) { $v = array(17.51, 20.19);
	} elseif ( $a == 66 ) { $v = array(16.79, 19.39);
	} elseif ( $a == 67 ) { $v = array(16.08, 18.61);
	} elseif ( $a == 68 ) { $v = array(15.39, 17.84);
	} elseif ( $a == 69 ) { $v = array(14.7, 17.08);
	} elseif ( $a == 70 ) { $v = array(14.03, 16.33);
	} elseif ( $a == 71 ) { $v = array(13.37, 15.59);
	} elseif ( $a == 72 ) { $v = array(12.72, 14.87);
	} elseif ( $a == 73 ) { $v = array(12.09, 14.16);
	} elseif ( $a == 74 ) { $v = array(11.47, 13.47);
	} elseif ( $a == 75 ) { $v = array(10.87, 12.79);
	} elseif ( $a == 76 ) { $v = array(10.28, 12.13);
	} elseif ( $a == 77 ) { $v = array(9.71, 11.48);
	} elseif ( $a == 78 ) { $v = array(9.16, 10.86);
	} elseif ( $a == 79 ) { $v = array(8.62, 10.24);
	} elseif ( $a == 80 ) { $v = array(8.1, 9.65);
	} elseif ( $a == 81 ) { $v = array(7.6, 9.07);
	} elseif ( $a == 82 ) { $v = array(7.12, 8.51);
	} elseif ( $a == 83 ) { $v = array(6.66, 7.97);
	} elseif ( $a == 84 ) { $v = array(6.22, 7.45);
	} elseif ( $a == 85 ) { $v = array(5.8, 6.95);
	} elseif ( $a == 86 ) { $v = array(5.4, 6.48);
	} elseif ( $a == 87 ) { $v = array(5.02, 6.03);
	} elseif ( $a == 88 ) { $v = array(4.66, 5.61);
	} elseif ( $a == 89 ) { $v = array(4.33, 5.22);
	} elseif ( $a == 90 ) { $v = array(4.02, 4.85);
	} elseif ( $a == 91 ) { $v = array(3.73, 4.5);
	} elseif ( $a == 92 ) { $v = array(3.46, 4.19);
	} elseif ( $a == 93 ) { $v = array(3.22, 3.89);
	} elseif ( $a == 94 ) { $v = array(3, 3.63);
	} elseif ( $a == 95 ) { $v = array(2.81, 3.39);
	} elseif ( $a == 96 ) { $v = array(2.64, 3.18);
	} elseif ( $a == 97 ) { $v = array(2.49, 2.98);
	} elseif ( $a == 98 ) { $v = array(2.36, 2.81);
	} elseif ( $a == 99 ) { $v = array(2.24, 2.65);
	} elseif ( $a == 100 ) { $v = array(2.12, 2.49);
	} elseif ( $a == 101 ) { $v = array(2.01, 2.35);
	} elseif ( $a == 102 ) { $v = array(1.9, 2.21);
	} elseif ( $a == 103 ) { $v = array(1.8, 2.07);
	} elseif ( $a == 104 ) { $v = array(1.7, 1.94);
	} elseif ( $a == 105 ) { $v = array(1.6, 1.82);
	} elseif ( $a == 106 ) { $v = array(1.51, 1.7);
	} elseif ( $a == 107 ) { $v = array(1.42, 1.59);
	} elseif ( $a == 108 ) { $v = array(1.34, 1.48);
	} elseif ( $a == 109 ) { $v = array(1.26, 1.38);
	} elseif ( $a == 110 ) { $v = array(1.18, 1.28);
	} elseif ( $a == 111 ) { $v = array(1.11, 1.19);
	} elseif ( $a == 112 ) { $v = array(1.03, 1.1);
	} elseif ( $a == 113 ) { $v = array(0.97, 1.02);
	} elseif ( $a == 114 ) { $v = array(0.9, 0.94);
	} elseif ( $a == 115 ) { $v = array(0.84, 0.87);
	} elseif ( $a == 116 ) { $v = array(0.78, 0.79);
	} elseif ( $a == 117 ) { $v = array(0.72, 0.73);
	} elseif ( $a == 118 ) { $v = array(0.67, 0.67);
	} else { $v = array(0.61, 0.61);
	};
	return $v[$gender];
};

?>