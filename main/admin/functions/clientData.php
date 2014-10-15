<?php
//require '../../vendor/autoload.php';

$p1 = new person();
$p1->first = $opened['first'];
$p1->dob = $opened['dob'];
$p1->gender = $opened['gender'];
$p1->annualInflation = $opened['cola']/100;
$p1->pia = $opened['pia'];
$result = $p1->mainData();
$lifetimeBenefitsArray = $p1->variousLifetimeBenefits($result, $opened['fullRetirementAgeMonths']);
$lifetimeBenefitsSixtyTwoSeventyArray = $p1->lifetimeBenefitsSixtyTwoSeventy($result);
$lastItem = count($result) - 1;
$age = $p1->age();
$dob = $p1->dobParts();
$dobYear = $dob[0];

$calculatedPia = $p1->piaCalculation($dobYear, unserialize($opened['annualEarnings']), unserialize($opened['annualEarningsYear']));

if($opened['status'] == 1) {
	$p2 = new person();
	$p2->first = $opened['spouse_first'];
	$p2->dob = $opened['spouse_dob'];
	$p2->gender = $opened['spouse_gender'];
	$p2->annualInflation = $opened['cola']/100;
	$p2->pia = $opened['spouse_pia'];
	$spouseresult = $p2->mainData();
	$spouselifetimeBenefitsArray = $p2->variousLifetimeBenefits($spouseresult, $opened['spouse_fullRetirementAgeMonths']);
	$spouselifetimeBenefitsSixtyTwoSeventyArray = $p2->lifetimeBenefitsSixtyTwoSeventy($spouseresult);
	$spouselastItem = count($spouseresult) - 1;
	$spouseage = $p2->age();
	$spousedob = $p2->dobParts();
	$spousedobYear = $spousedob[0];
	
	$spousecalculatedPia = $p2->piaCalculation($spousedobYear, unserialize($opened['spouse_annualEarnings']), unserialize($opened['spouse_annualEarningsYear']));
}


?>


