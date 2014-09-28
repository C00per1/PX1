<?php

function selected($value1, $value2, $return) {
	
	if($value1 == $value2) {
		
		echo $return;
		
	}
	
};					

function get_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
};

function UNUSEDgeoLocate($addr) {
  $geoapi = "http://maps.googleapis.com/maps/api/geocode/json";
  $params = 'address='.str_replace(" ", "+", $addr).'&sensor=false';
  $response = file_get_contents("$geoapi?$params");
  $json = json_decode($response);
  return array(
    $json->results[0]->geometry->location->lat,
    $json->results[0]->geometry->location->lng
  );
};

function windDirection($windBearing) {
	if ($windBearing < 11.25) {
		$dir = "N";
	} 	elseif ($windBearing >= 11.25 && $windBearing < 33.75) {
		$dir = "NNE";
	}	elseif ($windBearing >= 33.75 && $windBearing < 56.25) {
		$dir = "NE";
	}	elseif ($windBearing >= 56.25 && $windBearing < 78.75) {
		$dir = "ENE";
	}	elseif ($windBearing >= 78.75 && $windBearing < 101.25) {
		$dir = "E";
	}	elseif ($windBearing >= 101.25 && $windBearing < 123.75) {
		$dir = "ESE";
	}	elseif ($windBearing >= 123.75 && $windBearing < 146.25) {
		$dir = "SE";
	}	elseif ($windBearing >= 146.25 && $windBearing < 168.75) {
		$dir = "SSE";
	}	elseif ($windBearing >= 168.75 && $windBearing < 191.25) {
		$dir = "S";
	}	elseif ($windBearing >= 191.25 && $windBearing < 213.75) {
		$dir = "SSW";
	}	elseif ($windBearing >= 213.75 && $windBearing < 236.25) {
		$dir = "SW";
	}	elseif ($windBearing >= 236.25 && $windBearing < 258.75) {
		$dir = "WSW";
	}	elseif ($windBearing >= 258.75 && $windBearing < 281.25) {
		$dir = "W";
	}	elseif ($windBearing >= 281.25 && $windBearing < 303.75) {
		$dir = "WNW";
	}	elseif ($windBearing >= 303.75 && $windBearing < 326.25) {
		$dir = "NW";
	}	elseif ($windBearing >= 326.25 && $windBearing < 348.75) {
		$dir = "NNW";
	} else {
		$dir = "N";
	}
	return $dir;
};

?>
