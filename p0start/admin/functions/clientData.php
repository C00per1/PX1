<?php

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

?>