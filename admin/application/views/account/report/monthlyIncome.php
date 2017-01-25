<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Income Report</title>
		<meta name="robots" content="index, nofollow" />
		<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/reports_css/reports.css"/>
		<script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>
		<!---<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" language="javascript" src="js/bootstrap-datepicker.min.js"></script>-------->
		
		<script type="text/javascript">
		
			$(function(){
			var pickerOpts = {
					dateFormat: $.datepicker.ATOM
				};
			
			var pickerOpts1 = {
				dateFormat: $.datepicker.ATOM
				};	
				
				$("#fromdate").datepicker(pickerOpts);
				$("#todate").datepicker(pickerOpts1);
			});
			
			/* $("document").ready(function(){
			alert('asdfas');
			$("#dob").datepicker({format: 'yyyy-mm-dd'
			});
			}); */
			
			$("document").ready(function(){
				alert('adsf');
				document.write("asdfasf");
			});
	
		</script>
		<style type="text/css">
			.date{
				width:150px;
			}
			@media print {
				#bar{display:none;}
				#container th{border:1px solid #f1f1f1;}
			}
		</style>

	</head>
	<?php 
	extract($_POST);
	$transtype=array(
	1=>"bank_opening",
	2=>"student bill collection",
	3=>"income",
	4=>"expanse",
	5=>"student bill collection",
	6=>"cash to bank",
	7=>"bank to cash"
	);
	$schoolProfile = $this->db->order_by("id","DESC")->limit(1)->get("sprofile")->row();
	?>
	<body>
		<div id="bar">
			<div class="barcon">
				<form action="accountReport/monthlyIncomeReport" method="post">
					<select name="accnumber">
						<?php 
							$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
							foreach($sqlacc as $accidshow){
						?>
						<option <?php if($accnumber==$accidshow->accountid){ echo "selected"; } ?> value="<?php echo $accidshow->accountid?>" <?php if($accnumber == $accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
						<?php }?>
					</select>
					
					<select name="categoryid">
						<option <?php if($categoryid=='') { echo "selected"; } ?> value="" >All Category</option>
						<option <?php if($categoryid=='0'){ echo "selected"; } ?> value="0">Bill Collection</option>
						<?php 
							$sqlaccs = $this->db->select('*')->from('income_catg')->get()->result();										
							foreach($sqlaccs as $accidshows){
						?>
						<option value="<?php echo $accidshows->id ?>" <?php if($categoryid==$accidshows->id){echo "SELECTED";}?>><?php echo $accidshows->income_type ?></option>
						<?php }?>
					</select>
					
					
					<input type="date" name="sdate" class="date" placeholder="Start" value="<?php  if(!isset($_POST['submit'])) { echo date("Y-m-d"); } else { echo $sdate; }  ?>"   id="dob" placeholder="Start Date" value=""/>
					
					
					<input type="date" name="edate" class="date" value="<?php  if(!isset($_POST['submit'])) { echo date("Y-m-d"); } else { echo $edate; }  ?>"  id="todate" placeholder="End" value=""/>
					
				
					<button type="submit" name="submit"  style="background:red;float:right;">Search</button>
				</form>
				
				<p align="right" style="float:right;width:10%;position:relative;top:-20px;">
					<a href="javaScript:window.print();" title="Print"><img src="img/print/print_big.png" style="position:absolute;margin-top:500px;margin-left:150px;height:80px;width:80px;"/></a>
				</p>
			</div>
		</div>
		<?php 
		extract($_POST);
		//print_r($_POST);
		if(isset($_POST['submit'])) {
			if($categoryid==''){
				$info=$this->db->query("select l.*,a.acc_name from main_ledger l,account_cre a where l.trans_type in(1,2,3) and a.accountid=l.accountid and date(l.e_date) between '$sdate' and '$edate' and l.accountid='$accnumber'")->result();
			}
			elseif($categoryid==0){
				$info=$this->db->query("select l.*,a.acc_name from main_ledger l,account_cre a where l.trans_type in(2) and a.accountid=l.accountid and date(l.e_date) between '$sdate' and '$edate' and l.accountid='$accnumber'")->result();
			}
			else {
				$info=$this->db->query("select l.*,a.acc_name from main_ledger l,account_cre a where l.trans_type in(1,2,3) and a.accountid=l.accountid and date(l.e_date) between '$sdate' and '$edate' and trans_catg='$categoryid' and l.accountid='$accnumber'")->result();
			}
			
		}
		
		else {
			$date=date("Y-m-d");
			$info=$this->db->query("select l.*,a.acc_name from main_ledger l,account_cre a where l.trans_type in(1,2,3) and a.accountid=l.accountid and date(l.e_date) between '$date' and '$date'")->result();
		}
		?>
		<div id="container">
			<h2><?php  echo $schoolProfile->schoolN;?></h2>
			<h3>Income Report</h3>
			<h4>
				<?php 
				if(isset($_POST['submit'])) 
				{
				echo $sdate."<b> To </b>".$edate;  
				} ?>
			</h4>
			<?php echo $heading; ?>
			<table cellpadding="0">
			
				<thead>
					<tr>
						<th>SL.No</th>
						<th>Account No</th>
						<th>Category</th>
						<th>Invoice No</th>
						<th>Date</th>
						<th>Amount</th>
					</tr>
				</thead>
				
				<tbody>
					<?php
					$i=1;
					$total=0;
					foreach($info as $value): 
					$ctg=$transtype[$value->trans_type];
					if($value->trans_catg!=''){
					$ctg=$this->db->query("select income_type from income_catg where id='$value->trans_catg'")->row()->income_type;	
					}
					$total+=$value->debit;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $value->acc_name; ?></td>
						<td><?php echo $ctg; ?></td>
						<td><?php echo $value->invoice_no; ?></td>
						<td><?php echo date("Y-m-d",strtotime($value->e_date)); ?></td>
						<td><?php echo number_format($value->debit,2); ?></td>
					</tr>
					<?php $i++; endforeach; ?>
				</tbody>
				
				<tfoot>
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total</th>
						<th><?php echo number_format($total,2);?> Tk</th>
					</tr>
				</tfoot>
				
			</table>
		</div>
	</body>
</html>

