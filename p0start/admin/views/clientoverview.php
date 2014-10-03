<div class="container">
	
	<h3>Client Overview</h3>
	<?php
	$z = $opened['gender'];
	$a = $opened['age'];
	$lifeRemaining = lifeExpectancy($z, $a);
	$exLifeRemaining = explode('.', $lifeRemaining);
	$lifeRemainingY = $exLifeRemaining[0];
	$lifeRemainingM = round($exLifeRemaining[1]*12/100);
	$ageDeath = $lifeRemaining + $a;
	$leMonths = $lifeRemainingY*12 + $lifeRemainingM;
	
	$x = date("Y-m-d", strtotime($opened['dob']));
	$exdob = explode('-', $x);
	
	$today = date("Y-m-d");
	$start = (new DateTime($today))->modify('first day of this month');

	$ageCurrent = date_diff($start, date_create($x));
	$ageCurrentFormat = $ageCurrent->format('%y-%m');
	$exCurrentAge = explode('-', $ageCurrentFormat);
	$ageCurrentMonths = $exCurrentAge[0] * 12 + $exCurrentAge[1];
	$fraMonths = $opened[fullRetirementAgeMonths];
	$ageToFraMonths = $fraMonths - $ageCurrentMonths;
	$ageSixtyTwoBoolean = ageGreaterSixtyTwo($ageCurrentMonths);
	
	$annualInflation = $opened['cola']/100;
	$pia = $opened['pia'];
	$result = monthlyData($x, $lifeRemaining, $annualInflation, $pia, $ageToFraMonths, $ageSixtyTwoBoolean, $exdob[0], $exdob[1], $exdob[2]);
	$lastItem = count($result) - 1;
	

	//echo '<pre>';
	//print_r($ageSixtyTwoBoolean);
	//echo strtotime($opened['dob']);
	//print_r($a);
	//print_r($result);
	//echo '</pre>';
	?>

	<?php if(isset($message)) { echo $message; } ?>
	
</div><!-- END container -->

<div class="row" style="margin-top: 2%">
	<div class="col-md-4 col-md-offset-1">
		
		<table class="table table-hover">
			
			<thead>
				<th></th>
				<th data-field="id"><?php echo $opened['fullname']; ?></th>
			</thead>
			
			<tbody>
				
				<tr>
					<td>
						<p><strong>Date of Birth:</strong></p>
					</td>
					<td>
						<p><?php echo $opened['dob']; ?></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Current Age:</strong></p>
					</td>
					<td>
						<p><?php echo $result[0][1]; ?></p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Full Retirement Age:</strong></p>
					</td>
					<td>
						<p><?php
							if(($opened['fullRetirementAgeMonths'] % 12) == 0) {
								$remainder = '';
							} else {
								$remainder = "-".round($opened['fullRetirementAgeMonths'] % 12);
							};
							echo floor(($opened['fullRetirementAgeMonths']/12)).$remainder;
							
							?>
						</p>
					</td>
				</tr>
				
				<tr>
					<td>
						<p><strong>Life Expectancy:</strong></p>
					</td>
					<td>
						<p><?php echo $result[$lastItem][1]; ?></p>
					</td>
				</tr>

			</tbody>
			
		</table><!-- END table -->
		<div class="row">
			<form class="form-inline" style="margin-left: 10px" action="?page=clientoverview&id=<?php echo $opened['id']; ?>" method="post" role="form">
				<div class="form-group col-md-4">
					<label for="pia">PIA:</label>
					<div class="input-group">
						<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client PIA" data-db="clients-pia" type="number" name="pia" id="pia" value="<?php echo $opened['pia']; ?>" placeholder="PIA" autocomplete="off" />
					</div>
				</div>
	
				<div class="form-group col-md-4">
					<label for="cola">COLA:</label>
					<div class="input-group">
						<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client COLA" data-db="clients-cola" type="number" name="cola" id="cola" value="<?php echo $opened['cola']; ?>" placeholder="COLA" autocomplete="off" />
					</div>
				</div>
				
				<div class="form-group col-md-4" style="margin-top: 35px">
				    <a href="?page=clientoverview&id=<?php echo $opened['id']; ?>" class="well well-sm">
				        <i class="glyphicon glyphicon-chevron-right"></i> Go
				    </a>
				</div>
			</form>
		</div>
	
	</div><!-- END col-md column -->
	<div class="col-md-4 col-md-offset-1">
		<h3>Monthly View:</h3>
		<?php // content="text/plain; charset=utf-8"
			require_once ('config/jqgraph/src/jpgraph-3.5.0b1/jpgraph.php');
			require_once ('config/jqgraph/src/jpgraph-3.5.0b1/jpgraph_line.php');
			
			$datay1 = array(20,15,23,15);
			$datay2 = array(12,9,42,8);
			$datay3 = array(5,17,32,24);
			
			// Setup the graph
			$graph = new Graph(300,250);
			$graph->SetScale("textlin");
			
			$theme_class=new UniversalTheme;
			
			$graph->SetTheme($theme_class);
			$graph->img->SetAntiAliasing(false);
			$graph->title->Set('Filled Y-grid');
			$graph->SetBox(false);
			
			$graph->img->SetAntiAliasing();
			
			$graph->yaxis->HideZeroLabel();
			$graph->yaxis->HideLine(false);
			$graph->yaxis->HideTicks(false,false);
			
			$graph->xgrid->Show();
			$graph->xgrid->SetLineStyle("solid");
			$graph->xaxis->SetTickLabels(array('A','B','C','D'));
			$graph->xgrid->SetColor('#E3E3E3');
			
			// Create the first line
			$p1 = new LinePlot($datay1);
			$graph->Add($p1);
			$p1->SetColor("#6495ED");
			$p1->SetLegend('Line 1');
			
			// Create the second line
			$p2 = new LinePlot($datay2);
			$graph->Add($p2);
			$p2->SetColor("#B22222");
			$p2->SetLegend('Line 2');
			
			// Create the third line
			$p3 = new LinePlot($datay3);
			$graph->Add($p3);
			$p3->SetColor("#FF1493");
			$p3->SetLegend('Line 3');
			
			$graph->legend->SetFrameWeight(1);
			
			// Output line
			
			
		?>
		<div><?php $graph->Stroke() ; ?></div>
	</div>
</div>

<div class="row" style="margin-top: 1%">
	<div class="col-md-4 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Year</th>
				<th>Age</th>
				<th>PIA</th>
			</thead>
			<tbody>
				<?php  
				for($i = 0; $i <= count($result); $i+=12) {
					$resultYearEx = explode('-', $result[$i][0]);
					$resultAgeEx = explode('-', $result[$i][1]);
					$end = date("Y", $result[$lastItem][0]);
					?>
					
				<tr>
					<td><?php echo $resultYearEx[0] ; ?></td>
					<td><?php echo $resultAgeEx[0] ; ?></td>
					<td><?php echo '$'.number_format(round($result[$i][2])) ; ?></td>
				</tr>
				<?php } ; ?>

			</tbody>
		</table>
	</div><!-- END col-md column -->
	
	<div class="col-md-5 col-md-offset-1">
		<table class="table table-hover color-hover">
			<thead>
				<th>Date</th>
				<th>Age</th>
				<!--<th>Months<br>to FRA</th>-->
				<th>PIA</th>
				<th>PIA<br>Adjustment</th>
				<th>Monthly<br>Benefit</th>
			</thead>
			<tbody>

				<?php for($i = 0; $i < count($result); $i++) { ?>
				<tr>
				    <td><?php echo $result[$i][0] ; ?></td>
				    <td><?php echo $result[$i][1] ; ?></td>
				    <!--<td><?php// echo $result[$i][5] ; ?></td>-->
				    <td>$<?php echo number_format(floor($result[$i][2])) ; ?></td>
				    <td><?php echo round($result[$i][6],1).'%' ; ?></td>
				    <td>$<?php echo number_format(floor($result[$i][3])) ; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div><!-- END col-md column -->

</div>

<span class="pull-right stickyButton">
    <a href="?page=clients&id=<?php echo $opened['id']; ?>" class="well well-sm">
        <i class="glyphicon glyphicon-chevron-left"></i> Back
    </a>
</span><!-- /top-link-block -->

<input type="hidden" name="submitted" value="1" />
<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
