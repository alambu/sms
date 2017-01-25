<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
	<head>
		<base href="<?php echo base_url();?>"/>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Expanse Report</title>
		<meta name="robots" content="index, nofollow" />
		<link rel="shortcut icon" href="img/favicon.ico"  type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/reports_css/reports.css"/>
		<link rel="stylesheet" media="screen,projection" type="text/css" href="datepicker/jquery-ui.css" />
		<script src="datepicker/jquery-1.9.1.js"></script>
		<script src="datepicker/jquery-ui.js"></script>
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
		</script>
		<style type="text/css">
			.date{
				width:120px;
			}
			@media print {
				#bar{display:none;}
				#container th{border:1px solid #f1f1f1;}
			}
		</style>

	</head>
	<?php 
	$schoolProfile = $this->db->order_by("id","DESC")->limit(1)->get("sprofile")->row();
	?>
	<body>
		<div id="bar">
			<div class="barcon">
				<form>
					<select name="accnumber">
						<option value="">Account No</option>
						<?php 
							$sqlacc=$this->db->select('*')->from('account_cre')->get()->result();										
							foreach($sqlacc as $accidshow){
						?>
						<option value="<?php echo $accidshow->accountid?>" <?php if($accnumber == $accidshow->accountid){echo "SELECTED";}?>><?php echo $accidshow->acc_name.'('. $accidshow->accountid.')'?></option>
						<?php }?>
					</select>
					
					<select name="categoryid">
						<option value="">Expanse Category</option>
						<?php 
							$sqlaccs = $this->db->select('*')->from('expance_catg')->get()->result();										
							foreach($sqlaccs as $accidshows){
						?>
						<option value="<?php echo $accidshows->id ?>" <?php if($categoryid==$accidshows->id){echo "SELECTED";}?>><?php echo $accidshows->expance_type ?></option>
						<?php }?>
					</select>
					
					<select name="method"  id="method">
						<option value="">Method</option>
						<option value="1" <?php if(isset($method)):if($method == 1):echo "Selected";endif;endif; ?> >Cash</option>
						<option value="2" <?php if(isset($method)):if($method == 2):echo "Selected";endif;endif; ?> >Check</option>
					</select>
					
					<input type="text" name="sdate" class="date"   id="fromdate" placeholder="Start Date" value=""/>
					
					
					<input type="text" name="edate" class="date"  id="todate" placeholder="End Date" value=""/>
					
				
					<button type="button"  style="background:red;float:right;">Search</button>
				</form>
				
				<p align="right" style="float:right;width:10%;position:relative;top:-20px;">
					<a href="javaScript:window.print();" title="Print"><img src="img/print/print_big.png" style="position:absolute;margin-top:500px;margin-left:150px;height:80px;width:80px;"/></a>
				</p>
			</div>
		</div>
		<div id="container">
			<h2><?php  echo $schoolProfile->schoolN;?></h2>
			<h3>Expanse Report</h3>
			<h4><?php echo date("Y-m-d")."<b> To </b>".date("Y-m-d"); ?></h4>
			<?php echo $heading; ?>
			<table cellpadding="0">
			
				<thead>
					<tr>
						<th>SL.No</th>
						<th>Account No</th>
						<th>Category</th>
						<th>Invoice No</th>
						<th>Amount</th>
						<th>Date</th>
						<th>Expanse By</th>
					</tr>
				</thead>
				
				<tbody>
					
				</tbody>
				
				<tfoot>
					
				</tfoot>
				
			</table>
		</div>
	</body>
</html>