<?php echo $conditions_week[$i]->getSummary() ; ?><br><br>

<strong>Chance of <?php echo ($conditions_week[$i]->getPrecipitationProbability()) == 0 ? 'Precipitation' : ucfirst(strtolower(($conditions_week[$i]->getPrecipitationType()))) ; ?>: </strong><?php echo round($conditions_week[$i]->getPrecipitationProbability()*100).'%' ; ?><br>
<strong>Wind: </strong><?php echo round($conditions_week[$i]->getWindSpeed())." mph (".windDirection($conditions_week[$i]->getWindBearing()).")" ; ?><br>
<strong>Dew Point: </strong><?php echo round($conditions_week[$i]->getDewpoint()) ; ?><br>
<strong>Humidity: </strong><?php echo round($conditions_week[$i]->getHumidity()*100).'%' ; ?><br>
<strong>Sunrise: </strong><?php echo $conditions_week[$i]->getSunrise('g:ia') ; ?><br>
<strong>Sunset: </strong><?php echo $conditions_week[$i]->getSunset('g:ia') ; ?>
