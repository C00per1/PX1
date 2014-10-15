<?php
include_once('functions/clientData.php');
if(isset($message)) { echo $message; };
?>
<div class="row" style="margin-top: 50px">
	
	<?php include('template/sidebar.php'); ?>
	
	<div id="fixedContent" class="margin-top col-xs-10 col-sm-10">
		<div class="container-fluid">
			<h1>Client Overview Married</h1>
		</div><!-- END container -->
		<div class="container-fluid" style=margin: 10px; padding: 10px">
			<div class="row">
				<div class="col-md-5" style="margin-left: 30px; margin-right: 0px; margin-top: 10px; margin-bottom: 10px">
					<table class="table table-hover">
						
						<thead>
							<th></th>
							<th data-field="id"><?php echo $opened['fullname']; ?></th>
							<th data-field="id"><?php echo $opened['fullnameSpouse']; ?></th>
						</thead>
						
						<tbody>
							
							<tr>
								<td>
									<p><strong>Date of Birth:</strong></p>
								</td>
								<td>
									<p><?php echo $opened['dob']; ?></p>
								</td>
								<td>
									<p><?php echo $opened['spouse_dob']; ?></p>
								</td>
							</tr>
							
							<tr>
								<td>
									<p><strong>Current Age:</strong></p>
								</td>
								<td>
									<p><?php echo $result[0][1]; ?></p>
								</td>
								<td>
									<p><?php echo $spouseresult[0][1]; ?></p>
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
								<td>
									<p><?php
										if(($opened['spouse_fullRetirementAgeMonths'] % 12) == 0) {
											$spouseremainder = '';
										} else {
											$spouseremainder = "-".round($opened['spouse_fullRetirementAgeMonths'] % 12);
										};
										echo floor(($opened['spouse_fullRetirementAgeMonths']/12)).$spouseremainder;
										
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
								<td>
									<p><?php echo $spouseresult[$spouselastItem][1]; ?></p>
								</td>
							</tr>
						</tbody><!-- END tbody -->
					</table><!-- END table -->
				</div><!-- END col-md-5 -->
				<div class="col-md-6 pull-right" style="margin: 10px;">
					<div class="panel-group piacalc" id="accordion" style="margin-bottom: 10px">
						<div class="panel panel-default">
					    	<div class="panel-heading piacalc active-panel">
					      		<h4 class="panel-title">
					      			<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Quick Calculation</a>
		        				</h4><!-- END panel-title -->
		        			</div><!-- END panel-heading -->
		        			<div id="collapseOne" class="panel-collapse collapse in">
		        				<div class="panel-body piacalc">
									<form class="form-inline" action="?page=client&id=<?php echo $opened['id']; ?>" method="post" role="form">
										<div class="form-group col-md-3">
											<div class="input-group">
												<label for="client_pia">Client PIA</label>
												<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client PIA" data-db="clients-pia" type="number" name="pia" id="pia" value="<?php echo $opened['pia']; ?>" placeholder="PIA" autocomplete="off" />
											</div><!-- END input-group -->
										</div><!-- END form-group -->
										<div class="form-group col-md-3">
											<div class="input-group">
												<label for="spouse_pia">Spouse PIA</label>
												<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Spouse PIA" data-db="clients-spouse_pia" type="number" name="spouse_pia" id="spouse_pia" value="<?php echo $opened['spouse_pia']; ?>" placeholder="PIA" autocomplete="off" />
											</div><!-- END input-group -->
										</div><!-- END form-group -->
										<div class="form-group col-md-3">
											<label for="cola">COLA:</label>
											<div class="input-group">
												<input class="form-control blur-save" data-id="<?php echo $opened['id'] ; ?>" data-label="Client COLA" data-db="clients-cola" type="number" name="cola" id="cola" value="<?php echo $opened['cola']; ?>" placeholder="COLA" autocomplete="off" />
											</div><!-- END input-group -->
										</div><!-- END form-group -->
										<div class="form-group col-md-3" style="margin-top: 35px">
										    <a href="?page=client&id=<?php echo $opened['id']; ?>" class="well well-sm">
										        <i class="glyphicon glyphicon-chevron-right"></i> Go
										    </a>
										</div><!-- END form-group -->
									</form><!-- END form -->
								</div><!-- END panel-body -->
							</div><!-- END panel-collapse -->
						</div><!-- END panel-default -->
						
						<div class="panel panel-default piacalc">
					    	<div class="panel-heading piacalc">
					      		<h4 class="panel-title">
					      			<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Advanced Calculation</a>
		        				</h4>
		        			</div><!-- END panel-heading -->
		        			<div id="collapseTwo" class="panel-collapse collapse">
		        				<div class="panel-body piacalc">
									<div class="col-md-3">
										<a href="?page=annualEarnings&id=<?php echo $opened['id']; ?>" style="margin-top: 15px" class="btn btn-success btn-md" data-target="#calcPia" style="text-align: center">Edit Earnings</a>
									</div>
		
									<div class="col-md-9">
										<h4 style="font-variant: small-caps">&nbsp;&nbsp;Results</h4>
										<ul>
											<li>
												<p><strong>Primary Insurance Amount (PIA): </strong>$<?php echo $calculatedPia[0]; ?></p>
											</li>
											<li>
												<p><strong>Years of Substantial Earnings: </strong><?php echo $calculatedPia[1]; ?></p>
											</li>
										</ul>
									</div>
								</div>
							</div><!-- END panel-body -->
						</div><!-- END panel-collapse -->
					</div><!-- END panel-default -->	
				</div><!-- END col-md column -->
		
			</div><!-- END row -->
		</div><!-- END container -->
		<div class="container-fluid" style="margin: 10px; padding: 10px">
			<div class="row">
				<div class="col-md-12" style="margin-left: 10px">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist" id="mytab">
						<li class="active"><a href="#client-overview" role="tab" data-toggle="tab"><?php echo $opened['first']; ?></a></li>
						<li><a href="#spouse-overview" role="tab" data-toggle="tab"><?php echo $opened['spouse_first']; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="client-overview">
							<div class="col-md-6">
								<h3 style="font-variant: small-caps">If You Started Taking Benefits...</h3>
						
								<h4><i class="fa fa-close" style="color: red"></i> Earliest:</h4>
								<p>...at age <u><?php echo $lifetimeBenefitsArray[0][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($lifetimeBenefitsArray[0][0][6]); ?></u></p>
								
								<h4><i class="fa fa-close" style="color: red"></i> FRA:</h4>
								<p>...at age <u><?php echo $lifetimeBenefitsArray[1][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($lifetimeBenefitsArray[1][0][6]); ?></u></p>
					
								<h4><i class="fa fa-close" style="color: red"></i> Latest:</h4>
								<p>...at age <u><?php echo $lifetimeBenefitsArray[2][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($lifetimeBenefitsArray[2][0][6]); ?></u></p>
					
								<h4><i class="fa fa-check" style="color: green"></i> Maximum:</h4>
								<p>...at age <u><?php echo $lifetimeBenefitsArray[3][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($lifetimeBenefitsArray[3][0][6]); ?></u></p>
							</div>
							<div class="col-md-6">
								<div id="chartContainer2" class="fushionCharts" style="padding: 10px"></div>
							</div>
						</div><!-- END tab-pane -->
						<div class="tab-pane" id="spouse-overview">
							<div class="col-md-6">
								<h3 style="font-variant: small-caps">If You Started Taking Benefits...</h3>
						
								<h4><i class="fa fa-close" style="color: red"></i> Earliest:</h4>
								<p>...at age <u><?php echo $spouselifetimeBenefitsArray[0][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($spouselifetimeBenefitsArray[0][0][6]); ?></u></p>
								
								<h4><i class="fa fa-close" style="color: red"></i> FRA:</h4>
								<p>...at age <u><?php echo $spouselifetimeBenefitsArray[1][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($spouselifetimeBenefitsArray[1][0][6]); ?></u></p>
					
								<h4><i class="fa fa-close" style="color: red"></i> Latest:</h4>
								<p>...at age <u><?php echo $spouselifetimeBenefitsArray[2][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($spouselifetimeBenefitsArray[2][0][6]); ?></u></p>
					
								<h4><i class="fa fa-check" style="color: green"></i> Maximum:</h4>
								<p>...at age <u><?php echo $spouselifetimeBenefitsArray[3][0][1]; ?></u> you'll receive lifetime benefits of <u><?php echo '$'.number_format($spouselifetimeBenefitsArray[3][0][6]); ?></u></p>
							</div>
							<div class="col-md-6">
								<div id="chartContainer3" class="fushionCharts" style="padding: 10px"></div>
							</div>
						</div><!-- END tab-pane -->
					</div><!-- END tab-content -->
				</div><!-- END col-md-5 -->
			</div>
		</div>
		<div class="container-fluid" style="margin: 10px; padding: 10px">
			<div class="row">
				<div class="col-md-12">
					<div id="chartContainer" class="fushionCharts" style="margin: 0 45px"></div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row" style="margin-top: 2%">
				<div class="col-md-12">
					<!-- Nav tabs -->
					<ul id="tableTabs" class="nav nav-tabs" role="tablist" style="padding: 0 15px">
					  <li class="active"><a href="#annualTable" role="tab" data-toggle="tab">Client Annual View</a></li>
					  <li><a href="#monthlyTable" role="tab" data-toggle="tab">Client Monthly View</a></li>
					  <li><a href="#spouseannualTable" role="tab" data-toggle="tab">Spouse Annual View</a></li>
					  <li><a href="#spousemonthlyTable" role="tab" data-toggle="tab">Spouse Monthly View</a></li>
					</ul>
					<div id="tableTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="annualTable">
							<div class="col-md-12">
								<table class="table table-hover color-hover">
									<thead>
										<th style="padding-left: 15px">Election Age</th>
										<th>Year</th>
										<th>PIA Before Adjustment</th>
										<th>Adjustment to PIA</th>
										<th>Monthly Benefit</th>
										<th>Lifetime Total</th>
									</thead>
									<tbody>
									<?php  
									for($i = 0; $i <= count($result); $i+=12) {
										$resultYearEx = explode('-', $result[$i][0]);
										$resultAgeEx = explode('-', $result[$i][1]);
										$end = date("Y", $result[$lastItem][0]);
										if($result[$i][5] > 0) {
										?>
											
										<tr>
											<td style="padding-left: 15px"><?php echo $resultAgeEx[0] ; ?></td>
											<td><?php echo $resultYearEx[0] ; ?></td>
											<td>$<?php echo number_format(floor($result[$i][4])) ; ?></td>
											<td><?php echo '$'.number_format(round($result[$i][4])) ; ?></td>
											<td><?php echo '$'.number_format(round($result[$i][5])) ; ?></td>
											<td>$<?php echo number_format(floor($result[$i][6])) ; ?></td>
										</tr>
									<?php } } ; ?>
						
									</tbody>
								</table>
							</div><!-- END col-md column -->
						</div>
					
						<div class="tab-pane fade" id="monthlyTable">
							<div class="col-md-12">
								<table class="table table-hover color-hover">
									
									<thead>
										<th style="padding-left: 15px">Election Age</th>
										<th>Year-Month</th>
										<th>PIA Before Adjustment</th>
										<th>Adjustment to PIA</th>
										<th>Monthly Benefit</th>
										<th>Lifetime Total</th>
									</thead><!-- END thead -->
									<tbody>
						
									<?php for($i = 0; $i < count($result); $i++) { 
										if($result[$i][5] > 0 && $result[$i][2] <= 840) {?>
										<tr>
											<td style="padding-left: 15px"><?php echo $result[$i][1] ; ?></td>
										    <td><?php echo $result[$i][0] ; ?></td>
										    <td>$<?php echo number_format(floor($result[$i][4])) ; ?></td>
										    <td><?php echo $result[$i][3].'%' ; ?></td>
										    <td>$<?php echo number_format(floor($result[$i][5])) ; ?></td>
										    <td>$<?php echo number_format(floor($result[$i][6])) ; ?></td>
										</tr>
									<?php } } ?>
									</tbody><!-- END tbody -->
								</table><!-- END table -->
							</div><!-- END col-md-12 column -->
						</div><!-- END tab-pane -->
						
						<div class="tab-pane fade" id="spouseannualTable">
							<div class="col-md-12">
								<table class="table table-hover color-hover">
									<thead>
										<th style="padding-left: 15px">Election Age</th>
										<th>Year</th>
										<th>PIA Before Adjustment</th>
										<th>Adjustment to PIA</th>
										<th>Monthly Benefit</th>
										<th>Lifetime Total</th>
									</thead>
									<tbody>
									<?php  
									for($i = 0; $i <= count($result); $i+=12) {
										$spouseresultYearEx = explode('-', $spouseresult[$i][0]);
										$spouseresultAgeEx = explode('-', $spouseresult[$i][1]);
										$spouseend = date("Y", $spouseresult[$spouselastItem][0]);
										if($spouseresult[$i][5] > 0) {
										?>
											
										<tr>
											<td style="padding-left: 15px"><?php echo $spouseresultAgeEx[0] ; ?></td>
											<td><?php echo $spouseresultYearEx[0] ; ?></td>
											<td>$<?php echo number_format(floor($spouseresult[$i][4])) ; ?></td>
											<td><?php echo '$'.number_format(round($spouseresult[$i][4])) ; ?></td>
											<td><?php echo '$'.number_format(round($spouseresult[$i][5])) ; ?></td>
											<td>$<?php echo number_format(floor($spouseresult[$i][6])) ; ?></td>
										</tr>
									<?php } } ; ?>
						
									</tbody>
								</table>
							</div><!-- END col-md column -->
						</div>
					
						<div class="tab-pane fade" id="spousemonthlyTable">
							<div class="col-md-12">
								<table class="table table-hover color-hover">
									
									<thead>
										<th style="padding-left: 15px">Election Age</th>
										<th>Year-Month</th>
										<th>PIA Before Adjustment</th>
										<th>Adjustment to PIA</th>
										<th>Monthly Benefit</th>
										<th>Lifetime Total</th>
									</thead><!-- END thead -->
									<tbody>
						
									<?php for($i = 0; $i < count($spouseresult); $i++) { 
										if($spouseresult[$i][5] > 0 && $spouseresult[$i][2] <= 840) {?>
										<tr>
											<td style="padding-left: 15px"><?php echo $spouseresult[$i][1] ; ?></td>
										    <td><?php echo $spouseresult[$i][0] ; ?></td>
										    <td>$<?php echo number_format(floor($spouseresult[$i][4])) ; ?></td>
										    <td><?php echo $spouseresult[$i][3].'%' ; ?></td>
										    <td>$<?php echo number_format(floor($spouseresult[$i][5])) ; ?></td>
										    <td>$<?php echo number_format(floor($spouseresult[$i][6])) ; ?></td>
										</tr>
									<?php } } ?>
									</tbody><!-- END tbody -->
								</table><!-- END table -->
							</div><!-- END col-md-12 column -->
						</div><!-- END tab-pane -->
					</div><!-- END tab-content -->
				</div><!-- END col-md-12 -->
			</div><!-- END row -->
		</div><!-- END container -->
	</div><!-- END fixed-content -->

<?php include('widgets/stickyButtons.php'); ?>

<input type="hidden" name="submitted" value="1" />
<input type="hidden" name="openedid" value="<?php echo $opened['id']; ?>" />
</div> <!-- END row -->
<script>
	 FusionCharts.ready(function(){
	    var lbmonthlyChart = new FusionCharts({
	      type: "column2d",
	      renderAt: "chartContainer",
	      width: "100%",
	      height: "600",
	      dataFormat: "json",
	      dataSource: {
	       "chart": {
	          //"caption": "Getting the Most Out of Social Security",
	          //"subCaption": "Lifetime Benefits by Election Age",
	          "caption": "Lifetime Benefits by Election Age",
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
	          "bgColor": "#ffffff",
	          "canvasBgAlpha": "0",
	          "setAdaptiveYMin": "1",
	          "theme": "zune",
	          "labelDisplay": "rotate",
	          "slantLabels": "1",
	          "labelStep": "5",
	          "showValues": "0"
	       },
	       "data": [<?php for($i = 0; $i < count($lifetimeBenefitsSixtyTwoSeventyArray); $i++) { echo $lifetimeBenefitsSixtyTwoSeventyArray[$i]; } ?>]
	 	}
	  });
	  var lbKeyAgesChart = new FusionCharts({
	      type: "bar2d",
	      renderAt: "chartContainer2",
	      width: "100%",
	      height: "300",
	      dataFormat: "json",
	      dataSource: {
	       "chart": {
	          //"caption": "?php echo $opened['first']; ?>'s SNAPSHOT",
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
	          "bgColor": "#ffffff",
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
	       			'value': <?php echo json_encode($lifetimeBenefitsArray[0][0][6]); ?>
	       		},
	       		{
	       			'label': 'FRA:',
	       			'value': <?php echo json_encode($lifetimeBenefitsArray[1][0][6]); ?>
	       		},
	       		{
	       			'label': 'Latest:',
	       			'value': <?php echo json_encode($lifetimeBenefitsArray[2][0][6]); ?>
	       		},
	       		{
	       			'label': 'Maximum:',
	       			'value': <?php echo json_encode($lifetimeBenefitsArray[3][0][6]); ?>,
	       			'color': '#00ff00'
	       		}
	       ]
	 	}
	  });
 	var splbKeyAgesChart = new FusionCharts({
	      type: "bar2d",
	      renderAt: "chartContainer3",
	      width: "100%",
	      height: "300",
	      dataFormat: "json",
	      dataSource: {
	       "chart": {
	          //"caption": "?php// echo $opened['spouse_first']; ?>//'s SNAPSHOT",
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
	          "bgColor": "#ffffff",
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
	       			'value': <?php echo json_encode($spouselifetimeBenefitsArray[0][0][6]); ?>
	       		},
	       		{
	       			'label': 'FRA:',
	       			'value': <?php echo json_encode($spouselifetimeBenefitsArray[1][0][6]); ?>
	       		},
	       		{
	       			'label': 'Latest:',
	       			'value': <?php echo json_encode($spouselifetimeBenefitsArray[2][0][6]); ?>
	       		},
	       		{
	       			'label': 'Maximum:',
	       			'value': <?php echo json_encode($spouselifetimeBenefitsArray[3][0][6]); ?>,
	       			'color': '#00ff00'
	       		}
	       ]
	 	}
	  });
	  lbmonthlyChart.render("chartContainer");
	  
	  lbKeyAgesChart.render("chartContainer2");
	  
	  splbKeyAgesChart.render("chartContainer3");
	});
</script>

