<base href="<?php echo base_url() ?>" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>

<?php
	$w = '1';
	if(isset($_POST['submitsearch'])):
		extract($_POST);
		$data = array();
		
		// search by only account no
		if($accnumber):$data['accountid'] = $accnumber;endif;
		if($categoryid):$data['trans_catg'] = $categoryid;endif;
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
		$data = array();
	endif;
?>

<style type="text/css">
	#repoHead{
		border: 1px solid black !important;
		width: 300px;
		margin-left: 40%;
		padding: 5px;
		margin-top: 10px;
		margin-bottom: 15px;
		font-weight: bold;
	}

	@media print{
		
		#printHeading{
			display: none;
		}

		#entryBtn{
			display: none;
		}
		
		#resultRepo{
			border: none !important;
			width: 100% !important;
		}
	}

</style>

<?php
	$this->load->view("account/report/successFail");
?>

<div class="panel panel-success" id="printHeading" >
<div class="panel-body">
<form class="form-horizontal" role="form" action="" method="post">
	<div class="form-group">
		
		<div class="col-sm-2">   						
			<select class="form-control" name="accnumber" disabled readonly >
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
			<select class="form-control" name="categoryid" disabled readonly>
				<option value="">Income Category</option>
				<?php 
					$sqlaccs = $this->db->select('*')->from('income_catg')->get()->result();										
					foreach($sqlaccs as $accidshows){
				?>
				<option value="<?php echo $accidshows->id ?>" <?php if($categoryid==$accidshows->id){echo "SELECTED";}?>><?php echo $accidshows->income_type ?></option>
				<?php }?>
			</select>
		</div>	
								
		<div class="col-sm-2" style="width: 140px;">
			<select name="method"  class="form-control" id="method" disabled readonly>
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

		<div class="col-sm-1" style="width: 120px;" >
			<input type="text" name="sdate"  class="form-control" id="sdate" placeholder="Start Date" value="<?php if($sdate):echo $sdate;endif ?>" disabled readonly />
		</div>
								
		<div class="col-sm-1" style="width: 120px;" >
			<input type="text" name="edate"  class="form-control" id="edate" placeholder="End Date" value="<?php if($edate):echo $edate;endif ?>" disabled readonly />
		</div>
								
		<div class="col-sm-1">
			<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
		</div>

		<div class="col-sm-1">
			<input type="button" class="btn btn-danger" id = "printRepo"  class="form-control" value="Print" onclick="window.print()" />
		</div>
	</div>
</form>
</div>
</div>

<?php
	if(isset($_POST['submitsearch'])):

		$schoolInfo = $this->accmodone->schoolInfo();

?>

<div class="panel panel-default" id="resultRepo">
<div class="panel-body">
	
	<h3 style="text-align: center;">
		<?php echo $schoolInfo->schoolN ?>
	</h3>
	
	<b style="margin-left: 45%;">
		<?php if($month != ''):echo "Monthly Report";else:echo "Custom Report";endif; ?>
	</b><br/>
	
	<b style="margin-left: 45%;">Income Report</b><br/>

	<table id="repoHead">
		<tr>
			<td>Month :</td>
			<td><?php echo $this->accmodone->getMonthName($month); ?></td>
			<td>Year :</td>
			<td><?php echo $year ?></td>
		</tr>
	</table>
	
<?php
	$feeCatg = $this->db->get("fee_catg")->result();
?>

<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Class</th>
		<?php
			foreach($feeCatg as $feeC):
		?>

			<th><?php echo $feeC->catg_type ?></th>
	
		<?php
			endforeach;
		?>
			<th>Total</th>				
		</tr>
	</thead>

	<tbody>
	<?php
		$feeSubTotal = $this->db->select("*")->from("main_ledger m")->join("stu_bill","m.invoice_no = stu_bill.invoice_no","left")->where("m.trans_type","2")->where("m.month",$month)->where("m.year",$year)->get()->result();
			// echo $this->db->last_query();
		$classInfo = $this->db->get("class_catg")->result();
		$total = 0;

		foreach($classInfo as $clsInfo):
			$subTotal = 0;
		
		$data = array(
			"classid" => $clsInfo->classid,
			"year"    => $year
		);
		$classFee = $this->db->select("GROUP_CONCAT(feeid) as feeid,GROUP_CONCAT(feectgid) as feectgid,GROUP_CONCAT(amount) as amount")->from("class_fee_sett")->where($data)->get()->row();
		$amount = explode(",", $classFee->amount);
		$totalFeeid = explode(",", $classFee->feeid);
		$totalFeectgid = explode(",", $classFee->feectgid);

		$classFeeArray = explode(",",$classFee->feectgid);
?>
		<tr>
			<td><?php echo $clsInfo->class_name ?></td>
			<?php
			foreach($feeCatg as $rowFee):
				$bill = 0;
				foreach($feeSubTotal as $feeTotal):
					
					$billFee = explode(",", $feeTotal->fee_catg);
					$result = array_intersect($totalFeeid, $billFee);
					$allKeys = array_keys($result);

					if($feeTotal->classid == $clsInfo->classid):
						for($k = 0;$k < count($allKeys);$k++):
							if($totalFeectgid[$allKeys[$k]] == $rowFee->feectgid):
								$bill += $amount[$allKeys[$k]]*($feeTotal->to_month - $feeTotal->from_month + 1);
							endif;
						endfor;
					endif;
				endforeach;
		?>

			<td><?php echo $bill;$subTotal += $bill; ?></td>
	
		<?php
			endforeach;
		?>
			<td><?php echo $subTotal;$total += $subTotal; ?></td>
		</tr>
	<?php
		endforeach;

		// get extra income
		$extraIncome = $this->accmodone->extraIncomeRepo($month,$year);

		foreach($extraIncome as $xtInc):
	
	?>

		<tr>
			<td><?php echo $xtInc->income_type ?></td>
			<td colspan="<?php echo count($feeCatg); ?>"></td>
			<td><?php echo $xtInc->amount;$total += $xtInc->amount; ?></td>
		</tr>

	<?php
		endforeach;
	?>

		<tr>
			<td>Total :</td>
			<td colspan="<?php echo count($feeCatg); ?>"></td>
			<td><?php echo $total; ?></td>
		</tr>

	</tbody>
</table>

<?php
	
	$m = $month - 1;

	if( $m ==0 ):$m = 12;$year = $year - 1;endif;

	$handCash = $this->accmodone->incHandCash( $m,$year );
	$bankBalance = $this->accmodone->incBankBalance( $m,$year );
?>

<table class="table table-bordered table-striped" style="width: 250px;float: right;">
	<tr>
		<td>Total Income :</td>
		<td style="text-align: right;"><?php echo $total?$total:0; ?></td>
	</tr>
	<tr>
		<td>Hand Cash :</td>
		<td style="text-align: right;"><?php echo $handCash?$handCash:0; ?></td>
	</tr>
	<tr>
		<td>Bank Balance :</td>
		<td style="text-align: right;"><?php echo $bankBalance?$bankBalance:0; ?></td>
	</tr>
	<tr>
		<td>In Total :</td>
		<td style="text-align: right;"><?php $inTotal = $total + $handCash + $bankBalance;echo $inTotal?$inTotal:0; ?></td>
	</tr>
</table>

<form action="accountReport/monthlyClosing" method="post">
	
	<input type="hidden" name="total" value="<?php echo $inTotal; ?>" />
	<input type="hidden" name="month" value="<?php echo $month; ?>" />
	<input type="hidden" name="year" value="<?php echo $year; ?>" />
	
	<button type="submit" name="monthClosing" id="entryBtn" class="btn btn-primary" style="position: relative;top: 150px;left: 600px;" onclick="return confirm('Are Sure to close this month accounting ?');" >Month Closing</button>
</form>


</div>
</div>

<?php
	endif;
?>