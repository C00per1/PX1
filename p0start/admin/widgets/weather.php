<?php
include('config/forecast.io.php');

date_default_timezone_set('America/Chicago');

$api_key = 'ad9bee09864a4547614b512baec3b9f2';

//list($latitude, $longitude) = geoLocate($locationInput);

$latitude = '44.9833';
$longitude = '-93.2667';
$units = 'auto';  // Can be set to 'us', 'si', 'ca', 'uk' or 'auto' (see forecast.io API); default is auto
$lang = 'en'; // Can be set to 'en', 'de', 'pl', 'es', 'fr', 'it', 'tet' or 'x-pig-latin' (see forecast.io API); default is 'en'

$forecast = new ForecastIO($api_key);
/*
 * GET CURRENT CONDITIONS
 */
$condition = $forecast->getCurrentConditions($latitude, $longitude, $units, $lang);
/*
 * GET DAILY CONDITIONS FOR NEXT 7 DAYS
 */
$conditions_week = $forecast->getForecastWeek($latitude, $longitude);
/*
*foreach($conditions_week as $conditions) {
 * echo $conditions->getTime('l') . ': ' . $conditions->getMaxTemperature() . ' : ' . $conditions->getIcon() . '<br>';
}*/
/*
 * RETURN CONDITIONS ON HOURLY BASIS FOR TODAY
 */
$condition_hourly = $forecast->getForecastToday($latitude, $longitude);

?>

<div class="col-md-4 margin-top" style="padding-right: 5px; padding-left: 5px">
	<div id="dashboard-weather" class="panel panel-group panel-animated bg-grey border-grey animated fadeInUp">

		<div class="row" style="padding-top: 5px; padding-right: 5px">
			<div class="col-sm-4 col-md-offset-8">
				<label>Location:</label>
				<a href="#" id="inputZipCode" name="inputZipCode" class="pull-right" data-type="text" data-pk="1" data-url="/post" data-placement="right" data-title="Zip Code">55364</a>
			</div>
		</div>
		
	    <div class="panel-heading bg-red no-border">
	        <h3 class="text-center" style="line-height: 0px">Lake Minnetonka (MN)<?php echo $_POST['inputZipCode']; echo "<br><br>"; print_r($_POST['inputZipCode']); ?></h3>
	    </div><!--/panel-heading-->
	
	    <div class="panel-body text-center bordered-bottom border-transparent">
	    	<p class="text-lg">TODAY</p>
	        <p class="text-64"><?php echo round($condition->getTemperature()) ; ?>&deg;
	        	<canvas value="<?php echo $condition->getIcon() ; ?>" id="0" width="80" height="80"></canvas>
	        </p>
	    </div><!--/panel-body-->
	    
		<?php
		$a = array();
		for ($s = 0; $s <= 6; $s++) {
			$a[] = round($conditions_week[$s]->getMaxTemperature());
			$b[] = round($conditions_week[$s]->getMinTemperature());
		};

		$min = min(@$b);
		$max = max(@$a);
		
		for ($i = 1; $i <= 6; $i++) { ?>
			
		<a rel="popover" data-toggle="popover" data-trigger="hover" class="list-group-item db bg-ltgrey" data-html="true" data-container="body" title="Extended Outlook: <?php echo $conditions_week[$i]->getTime('l') ; ?>" data-placement="right" 
			data-content="<?php include('weatherExtended.php') ; ?>">
			<canvas class="pull-right" value="<?php echo $conditions_week[$i]->getIcon() ; ?>" id="<?php echo $i ; ?>" width="18" height="18"></canvas>
			<div class="pull-right" style="margin-left: 5px"><?php echo round($conditions_week[$i]->getMaxTemperature()) ; ?>&deg;</div>
			<?php echo $conditions_week[$i]->getTime('l') ; ?>
			<div class="progress" style="margin-top: 10px; margin-bottom: 5px">
			    <div class="progress-bar progress-bar-info" data-transitiongoal="<?php echo round($conditions_week[$i]->getMaxTemperature()) ; ?>" aria-valuemin="<?php echo $min ; ?>" aria-valuemax="<?php echo $max ; ?>"></div>
			</div>
		</a>
		
		<?php }; ?>
		
	</div>
</div>
