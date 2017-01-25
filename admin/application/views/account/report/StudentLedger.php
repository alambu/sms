<?php
	error_reporting(0);
	if(isset($_POST['search'])):
		extract($_POST);
		$history=$this->db->query("select * from student_ledger where stu_id='$studentid' order by e_date asc")->result();

	
	endif;
	
?>

<style type="text/css">
	table thead tr,tfoot tr{background: #ecf0f1;}
</style>

<aside class="right-side">
    <section class="content-header">
        <h1>Student Ledger<small> Control panel</small></h1>
		<?php 
       
		?>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Student Ledger</li>
        </ol>
    </section>

    <section>
        <div class="container-fluid">
			<?php extract($_POST); ?>
			<div class="row" style="margin-top:10px;margin-bottom:5px;">
            	<div class="col-md-offset-4 col-md-4">
				    <form action="" method="post">
					    <div class="input-group">
					      <input type="text" class="form-control" placeholder="Student ID" value="<?php echo $studentid; ?>" name="studentid">
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
							<table id="example" class="table">
								<thead>
									<tr>
										<th>SI</th>
										<th>Invoice Date</th>
										<th>Bill Invoice</th>
										<th>Purpose</th>
										<th>Trunsaction ID</th>
										<th>Bill Amount</th>
										<th>Payment</th>
										<th>Present Due</th>
									</tr>
								</thead>
								<tbody>

								<?php
								$si = 0;
								$credit = 0;
								$debit = 0;
								$presentdue = 0;
								foreach($history as $value):
								$si++;
								if($value->trans_id<1){
									$perpus="<span class='label label-info'>Bill Generate</span>";
								}	
								else {
									$perpus="<label class='label label-success'>Bill Collection</span>";
								}
								$credit+=$value->credit;
								$debit+=$value->debit;
								$presentdue=$debit-$credit;
								
								?>
								<tr>
									<td><?php echo $si;?></td>
									<td><a href="javascript:void(0);"><?php echo date("Y-m-d",strtotime($value->e_date)); ?></a></td>
									<td><a href="javascript:void(0);"><?php echo $value->invoice_no; ?></a></td>
									<td><?php echo $perpus; ?></td>
									<td><?php echo $value->trans_id; ?></td>
									<td><?php echo $value->debit; ?></td>
									<td><?php echo $value->credit; ?></td>
									<td><?php echo number_format($presentdue,2); ?></td>
								</tr>
								<?php
								endforeach;
								?>

								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th></th>
										<th>Total Bill : <?php echo number_format($debit,2); ?></th>
										<th>Total Paid : <?php echo number_format($credit,2); ?></th>
										<th>Due/Deposit : <?php echo number_format($debit - $credit,2); ?></th>
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