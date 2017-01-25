<?php
	error_reporting(0);
	if(isset($_POST['search'])):
		extract($_POST);

		$allTrans = $this->accmodone->studentAllTransID( $studentid );
		$mainLedgerHistory = $this->accmodone->mainLedgerStudentHistory( $allTrans );

		$studentBill = $this->accmodone->studentAllBill( $studentid );

		$totalHistory = array_merge( $mainLedgerHistory,$studentBill );
		$totalHistoryInfo = $this->accmodone->array_orderby($totalHistory,"e_date");
		// echo "<pre>";
		// print_r($totalHistoryInfo);exit;

	
	endif;
	
?>

<style type="text/css">
	table thead tr,tfoot tr{background: #ecf0f1;}
</style>

<aside class="right-side">
    <section class="content-header">
        <h1>Student Ledger<small> Control panel</small></h1>
        
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Student Ledger</li>
        </ol>
    </section>

    <section>
        <div class="container-fluid">
			
			<div class="row" style="margin-top:10px;margin-bottom:5px;">
            	<div class="col-md-offset-4 col-md-4">
				    <form action="" method="post">
					    <div class="input-group">
					      <input type="text" class="form-control" placeholder="Student ID" name="studentid">
					      <span class="input-group-btn">
					        <button class="btn btn-primary" type="submit" name="search">Search</button>
					      </span>
					    </div>
					</form>
  				</div>
			</div>

			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<div class="panel panel-default">
						<div class="panel-body"></div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<table class="table">
								<thead>
									<tr>
										<th>SI</th>
										<th>Transaction No</th>
										<th>Invoice No</th>
										<th>Purpose</th>
										<th>Month</th>
										<th>Year</th>
										<th>Transaction Date</th>
										<th>Debit</th>
										<th>Credit</th>
									</tr>
								</thead>
								<tbody>

								<?php
									$si = 0;
									$credit = 0;
									$debit = 0;
									$tTrans = 0;
									$tInvoice = 0;
									foreach($totalHistoryInfo as $history):
										$si++;

										if($history['trans_type']):
											$tTrans++;
										else:
											$tInvoice++;
										endif;

								?>

									<tr>
										<td><?php echo $si ?></td>
										<td><?php echo $history['trans_id'] ?></td>
										<td><?php echo $history['invoice_no'] ?></td>
										<td>
											<?php
												if($history['trans_type'] == 5):$tStatus = "Advanced Payment";
													$class = "label label-info";
												elseif($history['trans_type'] == 2):$tStatus = "Bill Payment";
													$class = "label label-success";
												else:
													$tStatus = "Bill Generate";
													$class = "label label-primary";
												endif;
											?>
											<span class="<?php echo $class ?>"><?php echo $tStatus ?></span>
										</td>
										<td><?php if($history['trans_type']):echo $this->accmodone->getMonthName($history['month']);else:echo $this->accmodone->getMonthName($history['from_month']) .'-'. $this->accmodone->getMonthName($history['to_month']);endif; ?></td>
										<td><?php if($history['trans_type']):echo $history['year'];else:echo $history['years'];endif; ?></td>
										<td><?php echo $history['e_date'] ?></td>
										<td>
											<?php
												
												if(!$history['trans_type']):echo $history['total_bill'];$debit += $history['total_bill'];
												endif;
											?>
										</td>
										<td>
											<?php
												
												if($history['trans_type'] == 5):echo $history['credit'];
													$credit += $history['credit'];
												elseif($history['trans_type'] == 2):
													echo $history['credit'];
													$credit += $history['credit'];
												endif;
											?>
										</td>
									</tr>

									<?php
										endforeach;
									?>

								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>Total Bill : <?php echo $tInvoice ?></th>
										<th>Payment Transaction : <?php echo $tTrans ?></th>
										<th>Total Amount : <?php echo $debit ?></th>
										<th>Total Paid : <?php echo $credit ?></th>
										<th>Due/Deposit : <?php echo $credit - $debit ?></th>
										<th></th>
										<th><?php echo $debit ?></th>
										<th><?php echo $credit ?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
</aside>