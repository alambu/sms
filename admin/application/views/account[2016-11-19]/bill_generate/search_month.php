
<?php 

$id = $this->input->get('ch');
$sm = $this->input->get('sm');
$tm = $this->input->get('tm');

if( ($id!='')  && ($sm <= $tm) ){
	$yearck=date('Y');
	$sqlquery = $this->db->query("SELECT * FROM re_admission WHERE classid='$id' AND syear='$yearck'");

	$sqlquery_bill = $this->db->query("SELECT * FROM stu_bill WHERE classid='$id' AND years='$yearck'");

	$torow = $sqlquery->num_rows();
	$sql_billrow = $sqlquery_bill->num_rows();
?>


<div class="row">
  <div class="col-sm-offset-4 col-sm-4" style="margin-top: 20px;border: 1px solid green;">
  
<?php
  
  $cktsql_com = $this->db->query("SELECT * FROM stu_bill WHERE classid='$id' AND from_month = '$sm' AND to_month = '$tm' AND years = '$yearck' and generate_status<3 order by id DESC");
  
  $cktsql_row = $cktsql_com->num_rows();
  $tofinal = $torow - $cktsql_row;
	  
?>
	
	<p>Total Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $torow;?></p>

	<p>Generate Student&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $cktsql_row?></p>

	<p>In-complete Generate&nbsp;&nbsp; : <?php echo $torow-$cktsql_row; ?></p>
  
  </div>
</div>
<hr/>

<?php 
if($tofinal):
	$nr=1;
	$classfesql=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$id' AND year='$yearck'")->result();
?>
<table class="table">
	<thead>
		<tr>
			<th>SI</th>
			<th>Category Name</th>
			<th>Amount</th>
			<th>Total Amount</th>
		</tr>
	</thead>
	
	<tbody>
		
<?php 

foreach($classfesql as $clbillrow){
	$bilname=$this->accmodone->classfeecatg($clbillrow->feectgid);

?>
	<tr>
		<td><?php echo $nr;?></td>
		
		<td>
			<input type="checkbox" name="feeidck[]" id="feeidck<?php echo $nr?>" value="<?php echo $clbillrow->feeid;?>" onclick="checkfun(<?php echo $nr?>)"><span style="margin-left:15px;"><?php echo $bilname->catg_type;?></span>
			
			<input type="hidden" name="fctgid[]" value="<?php echo $clbillrow->feectgid;?>" class="form-control" />	
		
			<input type="hidden" name="selctg[]" id="selectg<?php echo $nr?>" value="" class="form-control" />

		</td>

		<td>
			<input type="text" name="amount[]" id="tamount<?php echo $nr?>"  class="form-control" value="<?php echo $clbillrow->amount;?>" readonly />

			<input type="hidden" name="check_person[]" id="check_person<?php echo $nr?>" onchange="boxdis(this.value,<?php echo $nr?>)"  class="form-control" value=""/>
		</td>

		<td>
			<input type="text" name="finamount[]" id="finamount<?php echo $nr?>"  class="form-control" value="" readonly />
		</td>
	</tr>		


<?php $nr++;}?>

	<tr>
		<td colspan="3" style="text-align: right;"> Aproximate Total: </td>
		<td>
			<input type="text" name="totalAmount" id="totalAmount" readonly  class="form-control col-sm-4" value="" style="float: right;" />
			<input type="hidden" name="tonr" id="tonr" value="<?php echo $nr?>"/>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<button type="submit" name="submit" id="submitbill" class="btn btn-primary" onclick="return confirm('Are Your Sure Generate?');" style="float: right;"><span class="glyphicon glyphicon-send"></span>  Submit</button>
		</td>
	</tr>
</tbody>
</table>

<?php 
	else:
		echo '<br/><h3 style="color:red;text-align:center;">All Student bill generated for this month.Pls select another month.</h3>';
	endif;
}else{
	echo '<br/><br/><h3 style="color:red;text-align:center;">Invalid class selection or month selection.</h3>';
}
?>
