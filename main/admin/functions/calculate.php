
<?php

date_default_timezone_set('America/Chicago');

class person {
	
	public $first;
	public $last;
	public $dob;
	//public $lifeExpectancyYears;
	public $gender;
	public $pia;
	public $annualInflation;
	
	function mainData() {
		
		$age = $this->age();
		$monthsToDeath = $this->lifeExpectancy($this->gender);
		$ageDeath = $monthsToDeath + $age[1];
		
		$today = date("Y-m-d");
		$ageSixtyTwoOff = $this->monthsToSixtyTwo();
		$start = (new DateTime($today))->modify('first day of next month');
		/*if($ageSixtyTwoOff > 0) {
			$start = (new DateTime($today))->modify('first day of this month');
		} else {
			$start = (new DateTime($today))->modify('first day of this month');
			$start->sub(new DateInterval('P'.(-$ageSixtyTwoOff - 1).'M'));
		}*/
		
		$end = new DateTime();
		$end->add(new DateInterval('P'.$monthsToDeath.'M'));
		$interval = DateInterval::createFromDateString('1 month');
		$period = new DatePeriod($start, $interval, $end);
		$total = 0;
		//$i = 0;
		$myArray = array();
		$annualInflation = $this->annualInflation;
		$pia = $this->pia;
		
		foreach($period as $dt) {
			
			$dateIncrement = $dt->format("Y-m-t");
			$dateIncrementFormat = $dt->format("Y-m");
			$ageCalc = date_diff(date_create($dateIncrement), date_create($this->dob));
			$ageCalcFormat = $ageCalc->format("%Y-%m");
			$exAgeFormat = explode('-', $ageCalcFormat);
			$xAgeMonths = $exAgeFormat[0] * 12 + $exAgeFormat[1];

			$piaAdjustment = $this->piaAdjustment($xAgeMonths);
			(date("m", strtotime($dateIncrement)) == 1) ? $z = 1 : $z = 0;
			$growth = ($z == 0) ? 0 : bcmul($annualInflation, bcmul($pia, $z));
			$pia = bcadd($pia, $growth);
			$preGrowthPia = bcsub($pia, $growth);
			$adjustedPia = ($piaAdjustment == 0) ? 0 : bcadd($pia, bcmul($pia, $piaAdjustment));
			if($xAgeMonths == $this->findFullRetirementAgeMonths()) {
				$adjustedPia = $pia;
			}
			if($adjustedPia > 0) {
				$totalBenefit = $this->lifetimeBenefit($dt, $preGrowthPia, $piaAdjustment, $end);
			} else {
				$totalBenefit = 0;
			}
			//$i += 1;
			
			array_push($myArray, array($dateIncrementFormat, $ageCalcFormat, $xAgeMonths, round($piaAdjustment*100,2), $pia, $adjustedPia, $totalBenefit));
		}
		
		return $myArray;
		
	}

	//Calculate Lifetime Benefit By Start
	function lifetimeBenefit($dateStart, $pia, $piaAdjustment, $dateEnd) {
		
		$inflation = $this->annualInflation;
		$start = $dateStart;
		$end = $dateEnd;
		$iPia = $pia;
		$iPiaAdjustment = $piaAdjustment;
		$interval = DateInterval::createFromDateString('1 month');
		$iPeriod = new DatePeriod($start, $interval, $end);
		$total = 0;
		
		foreach($iPeriod as $idt) {
			$iDateIncrement = $idt->format("Y-m");
			(date("m", strtotime($iDateIncrement)) == 1) ? $z = 1 : $z = 0;
			$iGrowth = ($z == 0) ? 0 : $this->round_down(bcmul($annualInflation, bcmul($iPia, $z)),1);
			$iPia = bcadd($iPia, $iGrowth);
			$iBenefit = bcadd($iPia, bcmul($iPia, $iPiaAdjustment));
			$total = bcadd($total, $iBenefit);
		}
		return $total;
		
	}
	
	// Calculate Lifetime Benefit at Various Ages
	// Taking output from mainData function
	function variousLifetimeBenefits($result, $fraMonths) {
	
		$earliestLifetimeBenefitsArray = array();
		$latestLifetimeBenefitsArray = array();
		$fraLifetimeBenefitsArray = array();
		
		$maxLifetimeBenefits = $this->array_max_recursive($result);
		$ageMaxLifetimeBenefits = $this->array_multi_search($result, $maxLifetimeBenefits);
	
		for($i = 0; $i < count($result); $i++) {
			if($result[$i][6] > 0 && $result[$i][2] <= 840 ) {
				if($i == (count($result) - 1)){
					array_push($lifetimeBenefitsSixtyTwoSeventy, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode($result[$i][6])."}");
				} else {
					array_push($lifetimeBenefitsSixtyTwoSeventy, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode($result[$i][6])."}, ");
				}
				if($dob[2] == 1 && $result[$i][2] == 745) {//TO DO
					array_push($earliestLifetimeBenefitsArray, $result[$i]);
					//} elseif ($result[0][2] > 744) {
					//	array_push($myArray2, $result[0]);//TO DO
				} elseif ($dob[2] != 1 && $result[$i][2] == 745) {
					array_push($earliestLifetimeBenefitsArray, $result[$i]);
				}
				if ($result[$i][2] == $fraMonths) {
					array_push($fraLifetimeBenefitsArray, $result[$i]);
				}
				if ($result[$i][2] == 840) {
					array_push($latestLifetimeBenefitsArray, $result[$i]);
				}
			}
			if($result[0][6] > 0) {
				array_push($earliestLifetimeBenefitsArray, $result[0]);
			}
		}
		return array($earliestLifetimeBenefitsArray, $fraLifetimeBenefitsArray, $latestLifetimeBenefitsArray, $ageMaxLifetimeBenefits);
		
	}

	//Find lifetime benefits each age 62 to 70
	function lifetimeBenefitsSixtyTwoSeventy($result) {
		$lifetimeBenefitsSixtyTwoSeventy = array();
		for($i = 0; $i < count($result); $i++) {
			if($result[$i][6] > 0 && $result[$i][2] <= 840 ) {
				if($i == (count($result) - 1)){
					array_push($lifetimeBenefitsSixtyTwoSeventy, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode(floor($result[$i][6]))."}");
				} else {
					array_push($lifetimeBenefitsSixtyTwoSeventy, "{'label': ".json_encode($result[$i][1]).", 'value': ".json_encode(floor($result[$i][6]))."}, ");
				}
			}
		}
		return $lifetimeBenefitsSixtyTwoSeventy;
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
	
	//Calculate PIA
	function piaCalculation($dobYear, $earningsArray, $yearsArray) {
		
		$ageSixtyIndexYear = $dobYear + 60;
		$indexedWageBase = $this->averageIndexedEarnings($ageSixtyIndexYear);
		$indexedEarningsArray = array();
		$substantialEarningsArray = array();
		
		for($i = 0; $i < count($earningsArray); $i++) {
			if(preg_match("/^[0-9,]+$/", $earningsArray[$i])) $earnings = str_replace(',', '', $earningsArray[$i]);
			
			$natIndexedEarnings = $this->averageIndexedEarnings($yearsArray[$i]);
			
			$substantialEarnings = $this->piaSubEarningsConstants($yearsArray[$i], $earnings);
			array_push($substantialEarningsArray, $substantialEarnings);
			
			if($earnings > 0) {
				if($yearsArray[$i] < $ageSixtyIndexYear) {
					$aIndex = $indexedWageBase / $natIndexedEarnings;
					$indexedEarnings = $aIndex * $earnings; 
				} elseif($yearsArray[$i] >= $ageSixtyIndexYear) {
					$indexedEarnings = $earnings;
				}
			} elseif($earnings  <= 0) {
				$indexedEarnings = 0;
			}
			array_push($indexedEarningsArray, $indexedEarnings);
		}
		
		$sumYearsSubstantialEarnings = array_sum($substantialEarningsArray);
		
		$bendPointPercentageFirst = $this->bendPointPercentageFirst($sumYearsSubstantialEarnings);
		
		rsort($indexedEarningsArray, SORT_ASC);
		
		for($w = 0; $w < 35; $w++){
			$totalIndexedEarnings += $indexedEarningsArray[$w];
		}
		$averageIndexedEarnings = floor($totalIndexedEarnings / 420);
		
		$bendPoints = $this->bendPoints($ageSixtyIndexYear + 2);
		
		$firstBend = $bendPoints[0];
		$secondBend = $bendPoints[1] - $bendPoints[0];
		
		$piaPartOne = ($averageIndexedEarnings >= $firstBend) ? $firstBend * $bendPointPercentageFirst : $averageIndexedEarnings * $bendPointPercentageFirst;
		if($averageIndexedEarnings >= $secondBend) {
			$piaPartTwo = $secondBend * 0.32;
		} else {
			$piaPartTwo = ($averageIndexedEarnings - $firstBend) * 0.32;
		}
		
		$pia = $this->round_down($piaPartOne + $piaPartTwo);
		
		return array($pia, $sumYearsSubstantialEarnings, $bendPointPercentageFirst, $averageIndexedEarnings);
		
	}

	//Find pertage applied to first bend point
	function bendPointPercentageFirst($subYears) {
		
		if($subYears >= 30) {
			$percent = 0.90;
		} elseif($subYears == 29) {
			$percent = 0.85;
		} elseif($subYears == 28) {
			$percent = 0.80;
		} elseif($subYears == 27) {
			$percent = 0.75;
		} elseif($subYears == 26) {
			$percent = 0.70;
		} elseif($subYears == 25) {
			$percent = 0.65;
		} elseif($subYears == 24) {
			$percent = 0.60;
		} elseif($subYears == 23) {
			$percent = 0.55;
		} elseif($subYears == 22) {
			$percent = 0.50;
		} elseif($subYears == 21) {
			$percent = 0.45;
		} elseif($subYears <= 20 && $subYears >= 1) {
			$percent = 0.40;
		} else {
			$percent = 0.0;
		}
		
		return $percent;
		
	}

	//Round float down to next tenth of a percent
	function round_down($number, $precision = 2) {
		
	    $fig = (int) str_pad('1', $precision, '0');
		
	    return (floor($number * $fig) / $fig);
	}
	
	//Calculate PIA adjustment
	function piaAdjustment($passedAgeMonths) {

		$monthsToFra = $this->findFullRetirementAgeMonths() - $passedAgeMonths;
		$year = date("Y", strtotime($this->dob));
		if($monthsToFra > 0) {
			if($monthsToFra <= 36 && $monthsToFra > 0) {
				$reduction = $monthsToFra * (5/9)/100;
			} elseif($monthsToFra > 36 && $passedAgeMonths > 744) {
				$reduction = ($monthsToFra - 36) * (5/12)/100 + 0.20;
			} else {
				$reduction = 0;
			}
			$adjustment = -$reduction;
		
		} elseif ($monthsToFra < 0) {
			if($year >= 1943) {
				$credit = $monthsToFra * (2/3)/100;
				if($year >= 1943 && $year <= 1954 && $credit <= -0.32){
					$credit = -0.32;
				} elseif($year == 1955 & $credit <= -(30*(2/3)/100)){
					$credit = -(30*(2/3)/100);
				} elseif($year == 1956 & $credit <= -(29*(1/3)/100)){
					$credit = -(29*(1/3)/100);
				} elseif($year == 1957 & $credit <= -0.28){
					$credit = -0.28;
				} elseif($year == 1958 & $credit <= -(26*(2/3)/100)){
					$credit = (-26*(2/3)/100);
				} elseif($year == 1959 & $credit <= -(25*(1/3)/100)){
					$credit = (-25*(1/3)/100);
				} elseif($year >= 1960 && $credit <= -0.24) {
					$credit = -0.24;
				}
			} elseif($year == 1933 || $year == 1934) {
				$credit = $monthsToFra * (11/24)/100;
				($credit <= -0.275) ? $credit = -0.275 : $credit;
			} elseif($year == 1935 || $year == 1936) {
				$credit = $monthsToFra * (1/2)/100;
				($credit <= -0.30) ? $credit = -0.30 : $credit;
			} elseif($year == 1937 || $year == 1938) {
				$credit = $monthsToFra * (13/24)/100;
				if($year == 1937 && $credit <= -0.325){
					$credit = -0.325;
				} elseif ($year == 1938 && $credit <= -(31*(5/12)/100)) {
					$credit = -(31*(5/12)/100);
				}
			} elseif($year == 1939 || $year == 1940) {
				$credit = $monthsToFra * (7/12)/100;
				if($year == 1939 && $credit <= -(32*(2/3)/100)){
					$credit = -(32*(2/3)/100);
				} elseif ($year == 1940 && $credit <= -0.315) {
					$credit = -0.315;
				}
			} elseif($year == 1941 || $year == 1942) {
				$credit = $monthsToFra * (5/8)/100;
				if($year == 1941 && $credit <= -0.325){
					$credit = -0.325;
				} elseif ($year == 1942 && $credit <= -0.3125) {
					$credit = -0.3125;
				}
			} else {
				$credit = 0;
			}
			$adjustment = -$credit;
		} else {
			$credit = 0;
			$adjustment = $credit;
		}
		
		return $adjustment;
	}
	
	//DOB parts
	function dobParts() {
		
		$dob = $this->dob;
		$date = date('Y-m-d', strtotime($dob));
		$dobParts = explode('-', $date);
		$dobYear = $dobParts[0];
		$dobMonth = $dobParts[1];
		$dobDay = $dobParts[2];
		/*if($dobDay == 1) {
			$dobMonth -= 1;
			if($dobMonth == 1) {
				$dobYear -= 1;
			}
		}*/
		
		return array($dobYear, $dobMonth, $dobDay);
	}
	
	//Calculate age; takes dob YYYY-MM-DD; returns array(age in years, age in months)
	function age() {
		
		$year_diff = '';
		
		$ageArray = array();
		$dateParts = $this->dobParts();
		
		$year_diff = date('Y') - $dateParts[0];
		$month_diff = date('m') - $dateParts[1];
		$day_diff = date('d') - $dateParts[2];
		($day_diff < 0 || $month_diff < 0) ? $year_diff-- : $year_diff;
		
		$age_months = $year_diff * 12 + $month_diff;
		$ageArray = array($year_diff, $age_months);
		
		return $ageArray;
	}
	
	function monthsToSixtyTwo () {
		
		$ageMonths = $this->age();
		$ageSixtyTwo = 744 - $ageMonths[1];
		
		return $ageSixtyTwo;
	}
	
	//Substancial Earnings
	function piaSubEarningsConstants($year, $earnings) {
		
		$substantialEarningsArray = array(
			1951 => 900,
			1952 => 900,
			1953 => 900,
			1954 => 900,
			1955 => 1050,
			1956 => 1050,
			1957 => 1050,
			1958 => 1050,
			1959 => 1200,
			1960 => 1200,
			1961 => 1200,
			1962 => 1200,
			1963 => 1200,
			1964 => 1200,
			1965 => 1200,
			1966 => 1650,
			1967 => 1650,
			1968 => 1950,
			1969 => 1950,
			1970 => 1950,
			1971 => 1950,
			1972 => 2250,
			1973 => 2700,
			1974 => 3300,
			1975 => 3525,
			1976 => 3825,
			1977 => 4125,
			1978 => 4425,
			1979 => 4725,
			1980 => 5100,
			1981 => 5550,
			1982 => 6075,
			1983 => 6675,
			1984 => 7050,
			1985 => 7425,
			1986 => 7875,
			1987 => 8175,
			1988 => 8400,
			1989 => 8925,
			1990 => 9525,
			1991 => 9900,
			1992 => 10350,
			1993 => 10725,
			1994 => 11250,
			1995 => 11325,
			1996 => 11625,
			1997 => 12150,
			1998 => 12675,
			1999 => 13425,
			2000 => 14175,
			2001 => 14925,
			2002 => 15750,
			2003 => 16125,
			2004 => 16275,
			2005 => 16725,
			2006 => 17475,
			2007 => 18150,
			2008 => 18975,
			2009 => 19800,
			2010 => 19800,
			2011 => 19800,
			2012 => 20475,
			2013 => 21075
		);
		if($year <= 2013) {
			if($substantialEarningsArray[$year] <= $earnings) {
				$subEarnings = 1;
			} else {
				$subEarnings = 0;
			}
		} elseif ($year > 2013 && $earnings >= 10000) {
			$subEarnings = 1;
		} else {
			$subEarnings = 0;
		}
		
		return $subEarnings;
		
	}

	function averageIndexedEarnings($year) {
		
		$nationalAverageIndexedEarningsArray = array(
			1951 => 2799.16,
			1952 => 2973.32,
			1953 => 3139.44,
			1954 => 3155.64,
			1955 => 3301.44,
			1956 => 3532.36,
			1957 => 3641.72,
			1958 => 3673.80,
			1959 => 3855.80,
			1960 => 4007.12,
			1961 => 4086.76,
			1962 => 4291.40,
			1963 => 4396.64,
			1964 => 4576.32,
			1965 => 4658.72,
			1966 => 4938.36,
			1967 => 5213.44,
			1968 => 5571.76,
			1969 => 5893.76,
			1970 => 6186.24,
			1971 => 6497.08,
			1972 => 7133.80,
			1973 => 7580.16,
			1974 => 8030.76,
			1975 => 8630.92,
			1976 => 9226.48,
			1977 => 9779.44,
			1978 => 10556.03,
			1979 => 11479.46,
			1980 => 12513.46,
			1981 => 13773.10,
			1982 => 14531.34,
			1983 => 15239.24,
			1984 => 16135.07,
			1985 => 16822.51,
			1986 => 17321.82,
			1987 => 18426.51,
			1988 => 19334.04,
			1989 => 20099.55,
			1990 => 21027.98,
			1991 => 21811.60,
			1992 => 22935.42,
			1993 => 23132.67,
			1994 => 23753.53,
			1995 => 24705.66,
			1996 => 25913.90,
			1997 => 27426.00,
			1998 => 28861.44,
			1999 => 30469.84,
			2000 => 32154.82,
			2001 => 32921.92,
			2002 => 33252.09,
			2003 => 34064.95,
			2004 => 35648.55,
			2005 => 36952.94,
			2006 => 38651.41,
			2007 => 40405.48,
			2008 => 41334.97,
			2009 => 40711.61,
			2010 => 41673.83,
			2011 => 42979.61,
			2012 => 42979.61,
			2013 => 42979.61
		);
		if($year <= 2013){
			return $nationalAverageIndexedEarningsArray[$year];
		} elseif($year > 2013) {
			return 43000;
		}
	}

	function bendPoints($year) {
		
		$bendPointsArray = array(
		
			1979 => array(198, 1085),
			1980 => array(194, 1171),
			1981 => array(211, 1274),
			1982 => array(230, 1388),
			1983 => array(254, 1528),
			1984 => array(267, 1612),
			1985 => array(280, 1691),
			1986 => array(297, 1790),
			1987 => array(310, 1866),
			1988 => array(319, 1922),
			1989 => array(339, 2044),
			1990 => array(356, 2145),
			1991 => array(370, 2230),
			1992 => array(387, 2333),
			1993 => array(401, 2420),
			1994 => array(422, 2545),
			1995 => array(426, 2567),
			1996 => array(437, 2635),
			1997 => array(455, 2741),
			1998 => array(477, 2875),
			1999 => array(505, 3043),
			2000 => array(531, 3202),
			2001 => array(561, 3381),
			2002 => array(592, 3567),
			2003 => array(606, 3653),
			2004 => array(612, 3689),
			2005 => array(627, 3779),
			2006 => array(656, 3955),
			2007 => array(680, 4100),
			2008 => array(711, 4288),
			2009 => array(744, 4483),
			2010 => array(761, 4586),
			2011 => array(749, 4517),
			2012 => array(767, 4624),
			2013 => array(791, 4768)
			
		);
			
		if($year <= 2013){
			return $bendPointsArray[$year];
		} elseif($year > 2013) {
			return array(791, 4768);
		}
		
	}
		
	//Client FRA by YOB
	function findFullRetirementAgeMonths() {
		
		$year = '';
		$dateParts = $this->dobParts();
		$year = $dateParts[0];
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
	}	
	
	//Calculate life expectancy
	function lifeExpectancy($gender) {
		
		$a = $this->age()[0];
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
		
		$yearsToDeath = $v[$this->gender];
		
		return round($yearsToDeath*12);
	}
}



/*
//class Calculate {
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
	}
	
	//Generate array
	//input dob, lifeRemaining, annualInflation, pia, ageToFraMonths
	function monthlyData($x, $y, $annualInflation, $pia, $ageToFraMonths, $ageToSixtyTwoBool, $dobYear, $dobMonth, $dobDay) {
		$lifeEx = explode('.', $y);
		$leYear = $lifeEx[0];
		$leMonth = round($lifeEx[1]*12/100);
	
		$today = date("Y-m-d");
		//if ($ageToSixtyTwoBool == TRUE) {
		//	$newDobYear = $dobYear + 62;
		//	$today = date("Y-m-d", strtotime($newDobYear."-".$dobMonth."-".$dobDay));
		//};
	
		$start = (new DateTime($today))->modify('first day of this month');
		$end = new DateTime();
		
		//TO DO: add months to end interval
		$end->add(new DateInterval('P'.$leYear.'Y'//.$leMonth.'M'//));
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
	}
	
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
	}
	
	function ageGreaterSixtyTwo ($ageCurrentMonths) {
		if($ageCurrentMonths > 744) {
			$ageSixtyTwoBool = TRUE;
		} else {
			$ageSixtyTwoBool = FALSE;
		}
		return $ageSixtyTwoBool;
	}
	
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
	}
//};
*/
?>
