	        <!-- weather.php -->
	        <li class="list-group-item" href="#">
	        	<canvas class="pull-right" value="<?php echo $conditions_week[2]->getIcon() ; ?>" id="two" width="16" height="16"></canvas>
	            <div class="list-group-item-text pull-right"><?php echo round($conditions_week[2]->getMaxTemperature()) ; ?>&deg;</div>
	            <div class="panel-collapse "></div>
	            <?php echo /*'<strong>'.*/$conditions_week[2]->getTime('l')/*.'</strong>'.'  -  ' ; ?><?php echo ' '.$conditions_week[2]->getSummary()*/ ; ?>
	        </li>
	        <li class="list-group-item" href="#">
	        	<canvas class="pull-right" value="<?php echo $conditions_week[3]->getIcon() ; ?>" id="three" width="16" height="16"></canvas>
	            <div class="list-group-item-text pull-right"><?php echo round($conditions_week[3]->getMaxTemperature()) ; ?>&deg;</div>
	            <?php echo /*'<strong>'.*/$conditions_week[3]->getTime('l')/*.'</strong>'.'  -  ' ; ?><?php echo ' '.$conditions_week[3]->getSummary()*/ ; ?>
	        </li>
	        <li class="list-group-item" href="#">
	        	<canvas class="pull-right" value="<?php echo $conditions_week[4]->getIcon() ; ?>" id="four" width="16" height="16"></canvas>
	            <div class="list-group-item-text pull-right"><?php echo round($conditions_week[4]->getMaxTemperature()) ; ?>&deg;</div>
	            <?php echo /*'<strong>'.*/$conditions_week[4]->getTime('l')/*.'</strong>'.'  -  ' ; ?><?php echo ' '.$conditions_week[4]->getSummary()*/ ; ?>
	        </li>
	        <li class="list-group-item" href="#">
	        	<canvas class="pull-right" value="<?php echo $conditions_week[5]->getIcon() ; ?>" id="five" width="16" height="16"></canvas>
	            <div class="list-group-item-text pull-right"><?php echo round($conditions_week[5]->getMaxTemperature()) ; ?>&deg;</div>
	            <?php echo /*'<strong>'.*/$conditions_week[5]->getTime('l')/*.'</strong>'.'  -  ' ; ?><?php echo ' '.$conditions_week[5]->getSummary()*/ ; ?>
	        </li>
	        <li class="list-group-item" href="#">
	        	<canvas class="pull-right" value="<?php echo $conditions_week[6]->getIcon() ; ?>" id="six" width="16" height="16"></canvas>
	            <div class="list-group-item-text pull-right"><?php echo round($conditions_week[6]->getMaxTemperature()) ; ?>&deg;</div>
	            <?php echo /*'<strong>'.*/$conditions_week[6]->getTime('l')/*.'</strong>'.'  -  ' ; ?><?php echo ' '.$conditions_week[6]->getSummary()*/ ; ?>
	        </li>
	        
	    <a rel="popover" data-toggle="popover" data-trigger="hover" class="list-group-item bg-ltgrey" data-container="body" title="Extended Outlook: <?php echo $conditions_week[1]->getTime('l') ; ?>" data-placement="right" data-content="<?php echo $conditions_week[1]->getSummary() ; ?>">
			<canvas class="pull-right" value="<?php echo $conditions_week[1]->getIcon() ; ?>" id="1" width="18" height="18"></canvas>
			<div class="pull-right"><?php echo round($conditions_week[1]->getMaxTemperature()) ; ?>&deg;</div>
			<?php echo $conditions_week[1]->getTime('l') ; ?>
		</a>
	        
	        
	    <div class="panel-group bg-grey" id="accordion">
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseOne">
        					<canvas class="pull-right" value="<?php echo $conditions_week[1]->getIcon() ; ?>" id="one" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[1]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[1]->getTime('l') ; ?>
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseOne" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[1]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseTwo">
        					<canvas class="pull-right" value="<?php echo $conditions_week[2]->getIcon() ; ?>" id="two" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[2]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[2]->getTime('l') ; ?>
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseTwo" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[2]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseThree">
        					<canvas class="pull-right" value="<?php echo $conditions_week[3]->getIcon() ; ?>" id="three" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[3]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[3]->getTime('l') ; ?>
            			
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseThree" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[3]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseFour">
        					<canvas class="pull-right" value="<?php echo $conditions_week[4]->getIcon() ; ?>" id="four" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[4]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[4]->getTime('l') ; ?>
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseFour" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[4]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseFive">
        					<canvas class="pull-right" value="<?php echo $conditions_week[5]->getIcon() ; ?>" id="five" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[5]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[5]->getTime('l') ; ?>
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseFive" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[5]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        <div class="panel panel-default">
	        	<div class="panel-heading">
        			<div class="panel-title">
    					<a data-toggle="collapse" data-parent"#accordion" href="#collapseSix">
        					<canvas class="pull-right" value="<?php echo $conditions_week[6]->getIcon() ; ?>" id="six" width="18" height="18"></canvas>
            				<div class="list-group-item-text pull-right"><?php echo round($conditions_week[6]->getMaxTemperature()) ; ?>&deg;</div>
            				<?php echo $conditions_week[6]->getTime('l') ; ?>
        				</a>
        			</div>
        		</div>
	            
	            <div id="collapseSix" class="panel-collapse collapse">
	            	<div class="panel-body">
	            		<?php echo $conditions_week[6]->getSummary() ; ?>
	            	</div>
	            </div>
	        </div>
	        
	        <div class="col-sm-1 col-sm-offset-1">
	    	<a class="dropdown-toggle" data-toggle="dropdown">
	    		<i class="fa fa-chevron-circle-down"></i>
	    	</a>
    	</div>

    	<div class="col-sm-4">
			<div class="input-group" id="panelZipcode">
    			<input type="text" class="form-control input-sm" id="inputZipCode"/>
	    		<span class="input-group-btn">
		    		<button type="button" class="btn btn-default btn-sm" onclick="codeAddress()" id="inputButtonGeocode" title="geocodeSubmit">
		    			<i class="fa fa-chevron-circle-right"></i>
		    		</button>
	    		</span>
    		</div>
    	</div>
	        
$cardinalDirections = array(
  'N' => array(0, 5.6),
  'NbE' => array(5.7, 16.8),
  'NNE' => array(16.9, 28.1),
  'NEbN' => array(28.2, 39.3),
  'NE' => array(39.4, 50.6),
  'NEbE' => array(50.7, 61.8),
  'ENE' => array(61.9, 73.1),
  'EbN' => array(73.2, 84.3),
  'E' => array(84.4, 95.6),
  'EbS' => array(95.7, 106.8),
  'ESE' => array(106.8, 118.1),
  'SEbE' => array(118.2, 129.3),
  'SE' => array(129.34, 140.6),
  'SEbS' => array(140.7, 151.8),
  'SSE' => array(151.9, 163.1),
  'SbE' => array(163.2, 174.3),
  'S' => array(174.4, 185.5),
  'SbW' => array(185.6, 196.8),
  'SSW' => array(196.9, 208.1),
  'SWbS' => array(208.2, 219.3),
  'SW' => array(219.4, 230.6),
  'SWbW' => array(230.7, 241.8),
  'WSW' => array(241.9, 253.1),
  'WbS' => array(253.2, 264.3),
  'W' => array(264.4, 275.6),
  'WbN' => array(275.7, 286.8),
  'WNW' => array(286.9, 298.1),
  'NWbW' => array(298.2, 309.3),
  'NW' => array(309.34, 320.6),
  'NWbN' => array(320.7, 331.8),
  'NNW' => array(331.9, 343.1),
  'NbW' => array(343.2, 354.2),
  'N' => array(354.3, 360)
);

foreach ($cardinalDirections as $dir => $angles) {
  if ($bearing >= $angles[0] && $bearing < $angles[1]) {
    $direction = $dir;
    break;
  }
}

//$products = array (//0, 360);
//    array(0, 5.6) => "N"
/*
    "NbE" => array(5.7, 16.8),
    "NNE" => array(16.9, 28.1),
    "NEbN" => array(28.2, 39.3),
    "NE" => array(39.4, 50.6),
    "NEbE" => array(50.7, 61.8),
    "ENE" => array(61.9, 73.1),
    "EbN" => array(73.2, 84.3),
    "E" => array(84.4, 95.6),
    "EbS" => array(95.7, 106.8),
    "ESE" => array(106.8, 118.1),
    "SEbE" => array(118.2, 129.3),
    "SE" => array(129.34, 140.6),
    "SEbS" => array(140.7, 151.8),
    "SSE" => array(151.9, 163.1),
    "SbE" => array(163.2, 174.3),
    "S" => array(174.4, 185.5),
    "SbW" => array(185.6, 196.8),
    "SSW" => array(196.9, 208.1),
    "SWbS" => array(208.2, 219.3),
    "SW" => array(219.4, 230.6),
    "SWbW" => array(230.7, 241.8),
    "WSW" => array(241.9, 253.1),
    "WbS" => array(253.2, 264.3),
    "W" => array(264.4, 275.6),
    "WbN" => array(275.7, 286.8),
    "WNW" => array(286.9, 298.1),
    "NWbW" => array(298.2, 309.3),
    "NW" => array(309.34, 320.6),
    "NWbN" => array(320.7, 331.8),
    "NNW" => array(331.9, 343.1),
    "NbW" => array(343.2, 354.3),
    "N" => array(354.34, 360)

);
*/
	        
//var wIcon = wElement.split('/').join("");
				/*
				var a = new Skycons({color: "#ecf0f1"});
																 if (wElement == "partly-cloudy-day" ) {
									console.log($(this).attr('id'), wElement);
																		 a.set(Skycons.PARTLY_CLOUDY_DAY);
									a.play();
								} else if (wElement == "clear-night"){
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("clear-night", Skycons.CLEAR_NIGHT);
									a.play();
								} else if (wElement == "clear-day") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("clear-day", Skycons.CLEAR_DAY);
									a.play();
								} else if (wElement == "partly-cloudy-day") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("partly-cloudy-night", Skycons.PARTLY_CLOUDY_NIGHT);
									a.play();
								} else if (wElement == "cloudy") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("cloudy", Skycons.PARTLY_CLOUDY);
									a.play();
								} else if (wElement == "rain") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("rain", Skycons.RAIN);
									a.play();
								} else if (wElement == "sleet") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("sleet", Skycons.PARTLY_SLEET);
									a.play();		
								} else if (wElement == "snow") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("snow", Skycons.PARTLY_SNOW);
									a.play();			
								} else if (wElement == "wind") {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("wind", Skycons.PARTLY_WIND);
									a.play();
								} else {
									console.log($(this).attr('id'), wElement);
									//var a = new Skycons({color: "#ecf0f1"});
									a.set("fog", Skycons.PARTLY_FOG);
									a.play();
								};*/
								
/*a.set("clear-day", Skycons.CLEAR_DAY), a.set("partly-cloudy-day", Skycons.PARTLY_CLOUDY_DAY), a.set("wind", Skycons.WIND), a.set("wind2", Skycons.WIND), a.set("snow", Skycons.SNOW), a.set("cloudy", Skycons.CLOUDY), a.set("fog", Skycons.FOG), a.set("rain", Skycons.RAIN), a.play()
		*/
		

#accordion {
}

#one {
}

#collapseOne {
}

#two {
}

#collapseTwo {
}

#three {
}

#collapseThree {
}

#four {
}

#collapseFour {
}

#five {
}

#collapseFive {
}

#six {
}

#collapseSix {
}

.panel-group {
}

.bg-grey {
}

.panel {
}

.panel-default {
}

.panel-heading {
}

.panel-title {
}

.panel-title > a {
}

.pull-right {
}

.list-group-item-text {
}

.panel-collapse {
}

.collapse {
}

.panel-body {
}

		$(function () {
		
		    $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=world-population-density.json&callback=?', function (data) {
		
		        // Initiate the chart
		        $('#mapX').highcharts('Map', {
		
		            title : {
		                text : 'Zoom in on country by double click'
		            },
		
		            mapNavigation: {
		                enabled: true,
		                enableDoubleClickZoomTo: true
		            },
		
		            colorAxis: {
		                min: 1,
		                max: 1000,
		                type: 'logarithmic'
		            },
		
		            series : [{
		                data : data,
		                mapData: Highcharts.maps['custom/world'],
		                joinBy: ['iso-a2', 'code'],
		                name: 'Population density',
		                states: {
		                    hover: {
		                        color: '#BADA55'
		                    }
		                },
		                tooltip: {
		                    valueSuffix: '/mi²'
		                }
		            }]
		        });
		    });
		});
		

		/*
		$("#console-screenLeap").hide();
		
		$("#btn-screenLeap").click(function() {
			
			$("#console-screenLeap").toggle();
			
		});
		*/