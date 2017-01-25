<?php
	$w = '1';
	if(isset($_POST['submitsearch'])):
		extract($_POST);
		$data = array();
		
		// search by only account no
		if($accnumber):$data['accountid'] = $accnumber;endif;
		
		if($categoryid):
			$data['trans_type'] = 4;
			$data['trans_catg'] = $categoryid;
		endif;
		
		if($inCategoryid):
			$data['trans_type'] = 3;
			$data['trans_catg'] = $inCategoryid;
		endif;

		if($method):$data['trans_method'] = $method;endif;
		
		if($month):$data['month'] = $month;endif;
		
		if($year):$data['year'] = $year;endif;
		
		if($sdate && !($edate)):
			$w = "date(e_date) BETWEEN date('".$sdate."') AND date('".date("Y-m-d")."')";
		elseif($edate && !($sdate)):
			$w = "date(e_date) BETWEEN date('".date("Y-m-d")."') AND date('".$edate."')";
		elseif($sdate && $edate):
			$w = "date(e_date) BETWEEN date('".$sdate."') AND date('".$edate."')";
		endif;

	else:
		$data = array( "year" => date("Y") );
	endif;
?>
<aside class="right-side"> 

<section class="content-header">
    <h1>School General Ledger
        <small>Control panel</small>
        </h1>
        
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
</section>

<section class="content">
	<div class="container-fluid">
		<div class="box">
			<div class="box-body">
				<div class="panel panel-success">
				<div class="panel-body">
<form class="form-horizontal" role="form" action="" method="post">
	<div class="form-group">
		
		<div class="col-sm-2">   						
			<select class="form-control" name="accnumber" >
				<option value="">Account No</option>
				<?php 
					$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
					foreach($sqlacc as $accidshow){
				?>
				<option value="<?php echo $accidshow->accountid?>" <?php if($accnumber == $accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
				<?php }?>
			</select>
		</div>

		<div class="col-sm-2">   						
			<select class="form-control" name="inCategoryid">
				<option value="">Income Category</option>
				<?php 
					$sqlaccs=$this->db->select('*')->from('income_catg')->get()->result();										
					foreach($sqlaccs as $accidshows){
				?>
				<option value="<?php echo $accidshows->id ?>" <?php if($inCategoryid == $accidshows->id){echo "SELECTED";}?>><?php echo $accidshows->income_type?></option>
				<?php }?>
			</select>
		</div>

		<div class="col-sm-3">   						
			<select class="form-control" name="categoryid">
				<option value="">Expanse Category</option>
				<?php 
					$sqlaccs=$this->db->select('*')->from('expance_catg')->get()->result();										
					foreach($sqlaccs as $accidshows){
				?>
				<option value="<?php echo $accidshows->id ?>" <?php if($categoryid==$accidshows->id){echo "SELECTED";}?>><?php echo $accidshows->expance_type?></option>
				<?php }?>
			</select>
		</div>
								
		<div class="col-sm-2" style="width: 130px;">
			<select name="method"  class="form-control" id="method">
				<option value="">Method</option>
				<option value="1" <?php if(isset($method)):if($method == 1):echo "Selected";endif;endif; ?> >Cash</option>
				<option value="2" <?php if(isset($method)):if($method == 2):echo "Selected";endif;endif; ?> >Check</option>
			</select>
		</div>

		<div class="col-sm-2" style="width: 140px;">
			<select name="month"  class="form-control" id="month">
				<option value="">Month</option>
			<?php
				for($j = 1;$j <= 12;$j++):
					$monthNm = $this->accmodone->getMonthName($j);
			?>
				<option value="<?php echo $j ?>" <?php if($month):if($j == $month):echo "Selected";endif;endif; ?> ><?php echo $monthNm ?></option>
			<?php endfor; ?>
			</select>
		</div>

		<div class="col-sm-1" style="width: 110px;">
			<select name="year" class="form-control" id="year">
				<option value="">Year</option>
			
			<?php
				for($i = 2015;$i <= date("Y")+1;$i++):
			?>
			
				<option value="<?php echo $i ?>" <?php if(isset($year)):if($year == $i):echo "Selected";endif;endif; ?> ><?php echo $i ?></option>
			
			<?php endfor; ?>
			</select>
		</div>

		<div class="col-sm-1" style="width: 120px;margin-top: 8px;">
			<input type="text" name="sdate"  class="form-control" id="sdate" placeholder="Start Date" value="<?php if($sdate):echo $sdate;endif ?>"/>
		</div>
								
		<div class="col-sm-1" style="width: 120px;margin-top: 8px;">
			<input type="text" name="edate"  class="form-control" id="edate" placeholder="End Date" value="<?php if($edate):echo $edate;endif ?>"/>
		</div>
								
		<div class="col-sm-1" style="margin-top: 8px;">
			<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
		</div>
	</div>
</form>
</div>
</div>

<div class="panel panel-success">
	<div class="panel-body">
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>SI</th>
			<th>Account No</th>
			<th>Transaction No</th>										
			<th>Invoice No</th>										
			<th>Purpose</th>
			<th>Method</th>			
			<th>Check No</th>					
			<th>Refference</th>
			<th>Month</th>			
			<th>Year</th>		
			<th>Debit</th>		
			<th>Credit</th>		
			<th>Balance</th>		
			<th>Transaction Date</th>				
		</tr>
	</thead>

	<tbody>

<?php
	$si = 0;

	$mainState = $this->accmodone->mainLedgerStatement( $data,$w );

	foreach($mainState as $inSt):
		$si++;

		// get transaction purpose
		if($inSt->trans_type == 1):$purpose = "Bank Opening";
		elseif($inSt->trans_type == 2):$purpose = "Student Bill Collection";
		elseif($inSt->trans_type == 3):
			$purpose = $this->accmodone->incomeTransactionType($inSt->trans_catg);
		elseif($inSt->trans_type == 4):
			$purpose = $this->accmodone->expanseTransactionType($inSt->trans_catg);
		elseif($inSt->trans_type == 5):
			$purpose = "Advanced Payment";
		endif;

		// transaction method
		if($inSt->trans_method == 1):$method = "Cash";
		elseif($inSt->trans_method == 2):$method = "Check";
		endif;

		// get month name
		$month = $this->accmodone->getMonthName($inSt->month);

?>

		<tr>
			<td><?php echo $si ?></td>
			<td><?php echo $inSt->accountid ?></td>
			<td><?php echo $inSt->trans_id ?></td>
			<td><?php echo $inSt->invoice_no ?></td>
			<td><?php echo $purpose ?></td>
			<td><?php echo $method ?></td>
			<td><?php if($inSt->check_no):echo $inSt->check_no;endif; ?></td>
			<td><?php if($inSt->pay_person):echo $inSt->pay_person;endif; ?></td>
			<td><?php echo $month; ?></td>
			<td><?php echo $inSt->year ?></td>
			<td><?php if($inSt->credit > 0):echo $inSt->credit;endif; ?></td>
			<td><?php if($inSt->debit > 0):echo $inSt->debit;endif; ?></td>
			<td><?php echo $inSt->balance ?></td>
			<td><?php echo $inSt->e_date ?></td>
		</tr>
<?php
	endforeach;
?>
	</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</section>
</aside>