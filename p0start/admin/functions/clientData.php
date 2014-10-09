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

<script>
	 FusionCharts.ready(function(){
	    var monthlyChart = new FusionCharts({
	      type: "column2d",
	      renderAt: "chartContainer",
	      width: "100%",
	      height: "600",
	      dataFormat: "json",
	      dataSource: {
	       "chart": {
	          "caption": "Getting the Most Out of Social Security",
	          "subCaption": "Lifetime Benefits by Election Age",
	          "xAxisName": "Starting Age (Year-Month)",
	          "yAxisName": "Lifetime Benefits ($)",
	          "xAxisNamePadding": "15",
	          "yAxisNamePadding": "15",
	          "canvasPadding": "10",
	          "captionPadding": "30",
	          "alignCaptionWithCanvas": "0",
	          "captionFontSize": "20",
	          "subcaptionFontSize": "16",
	          "xAxisNameFontSize": "16",
	          "yAxisNameFontSize": "16",
	          "baseFontSize": "16",
	          "numberPrefix": "$",
	          "bgColor": "#B5C5C9",
	          "canvasBgAlpha": "0",
	          "setAdaptiveYMin": "1",
	          "theme": "zune",
	          "labelDisplay": "rotate",
	          "slantLabels": "1",
	          "labelStep": "4",
	          "showValues": "0"
	       },
	       "data": [<?php for($i = 0; $i < count($myArray1); $i++) { echo $myArray1[$i]; } ?>]
	 	}
	  });
	  
	  var secsChart = new FusionCharts({
	      type: "bar2d",
	      renderAt: "chartContainer2",
	      width: "100%",
	      height: "375",
	      dataFormat: "json",
	      dataSource: {
	       "chart": {
	          "caption": "SNAPSHOT",
	          //"subCaption": "Lifetime Benefits at Key Ages",
	          //"xAxisName": "Starting Age",
	          //"yAxisName": "Lifetime Benefits ($)",
	          "xAxisNamePadding": "15",
	          "yAxisNamePadding": "15",
	          "canvasPadding": "10",
	          "captionPadding": "5",
	          "alignCaptionWithCanvas": "0",
	          "captionFontSize": "20",
	          "subcaptionFontSize": "16",
	          "xAxisNameFontSize": "16",
	          "yAxisNameFontSize": "18",
	          "baseFontSize": "16",
	          "valueFontSize": "16",
	          "numberPrefix": "$",
	          "bgColor": "#B5C5C9",
	          "canvasBgAlpha": "0",
	          "setAdaptiveYMin": "1",
	          "theme": "zune",
	          "labelDisplay": "rotate",
	          "slantLabels": "0",
	          "labelStep": "1",
	          "showValues": "1"
	       },
	       "data": [
	       		{
	       			'label': 'Earliest:',
	       			'value': <?php echo json_encode($myArray2[0][6]); ?>
	       		},
	       		{
	       			'label': 'FRA:',
	       			'value': <?php echo json_encode($myArray4[0][6]); ?>
	       		},
	       		{
	       			'label': 'Latest:',
	       			'value': <?php echo json_encode($myArray3[0][6]); ?>
	       		},
	       		{
	       			'label': 'Maximum:',
	       			'value': <?php echo json_encode($ageMaxLifetimeBenefits[0][6]); ?>,
	       			'color': '#00ff00'
	       		}
	       ]
	 	}
	  });
	  monthlyChart.render("chartContainer");
	  
	  secsChart.render("chartContainer2");
	});
 
</script>
