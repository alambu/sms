<style>
.feeCtgcss {
	text-align:center;
	font-weight:bold;
	color:#B40404;
}	
</style>
<?php 
extract($_GET);
$stuinfo=$this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,rg.name,r.roll_no,rg.picture,sac.balance FROM re_admission r LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id LEFT JOIN student_account sac ON sac.stu_id = r.stu_id WHERE r.shiftid = '$sft' AND r.classid = '$cid' AND r.section = '$sec' AND r.roll_no = '$rol' AND r.syear='$yearck'")->row();
//echo "<pre>";
//print_r($stuinfo);
//echo "</pre>";
$data = array(
	"shiftid" => $sft,
	"classid" => $cid,
	"roll" 	  => $rol,
	"year" 	  => $yearck
);

$discount = $this->db->select("*")->from("schship")->where($data)->get()->row();

$waver=explode(",",$discount->discount);
$waverctg=explode(",",$discount->discount_ctg);

if(count($stuinfo)==0) { 
echo "<h3 style='text-align:left;' class='feeCtgcss'>Student Not Found</h3>";exit;
}

$nr=1;
$classfesql=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$cid' AND year='$yearck'")->result();


?>
<div class="row">
	<div class="col-md-8">
	</div>
	<div class="col-md-4">
<p style="font-size:20px;">Student Scholarship</p>
<p><img class="img-circle" src="img/student_section/registration_form/<?php echo $stuinfo->picture; ?>"  style="width:50px;height:50px;"/></p>
<p style="font-size:px;">Session: <b><?php echo $yearck; ?></b></p>
<p style="font-size:px;">Student Name: <b><?php echo $stuinfo->name; ?></b></p>
<p style="font-size:px;">Class Name: <b><?php echo $stuinfo->class_name; ?></b></p>
<p style="font-size:px;">Section: <b><?php echo $stuinfo->section_name; ?></b></p>
<p style="font-size:px;">Roll No: <b><?php echo $stuinfo->roll_no; ?></b></p>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>SI</th>
			<th>Category Name</th>
			<th>Amount</th>
			<th>Waver ( % ) </th>
		</tr>
	</thead>
	
	<tbody>
		
<?php 
//print_r($waver);
//print_r($waverctg);
$i=0;
foreach($classfesql as $clbillrow){
	$bilname=$this->accmodone->classfeecatg($clbillrow->feectgid);
	$exdiscount=0;
	
	if(in_array($clbillrow->feeid,$waverctg)){
		$exdiscount=$waver[$i];
		$i++;
	}
?>
	<tr>
		<td style="width:5%;"><?php echo $nr;?></td>
		
		<td style="width:25%;">
			<input type="hidden" name="feeidck[]" id="feeidck<?php echo $nr?>" value="<?php echo $clbillrow->feeid;?>"/>
			<span class="feeCtgcss"><?php echo $bilname->catg_type;?></span>
			<?php //echo $clbillrow->feeid; ?>
			<!--
			<input type="hidden" name="fctgid[]" value="<?php // echo $clbillrow->feectgid;?>" class="form-control"/>--->	
		
			<!--<input type="hidden" name="selctg[]" id="selectg<?php //echo $nr; ?>" value="" class="form-control"/>--->

		</td>

		<td style="width:35%;">
			<input type="text" name="amount[]" id="tamount<?php echo $nr?>"  class="form-control" value="<?php echo $clbillrow->amount;?>" readonly />
			<!---
			<input type="hidden" name="check_person[]" id="check_person<?php //echo $nr?>" onchange="boxdis(this.value,<?php //echo $nr?>)"  class="form-control" value=""/>--->
		</td>
		
		<td style="width:35%;">
			<input type="number" name="waver[]" id="" onkeypress="return isNumber(event)"  class="form-control" value="<?php echo $exdiscount; ?>" min="0" max="100"/>
		</td>
	</tr>		


<?php $nr++;}?>

	<tr>
		<td colspan="4">
			<button type="submit" name="schoolerShip" id="submitbtn" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-send"></span>  Submit</button>
		</td>
	</tr>
	</tbody>
</table>

<?php 

?>
