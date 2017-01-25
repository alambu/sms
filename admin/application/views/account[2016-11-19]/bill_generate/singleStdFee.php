<?php
	
	$shift = $this->input->get('shift');
	$class = $this->input->get('ch');
	$section = $this->input->get('section');
	$roll = $this->input->get('roll');
	$month = $this->input->get('month');
	extract($_GET);
	$y = date("Y");

	$getProfileInfo = $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,rg.name,r.roll_no,rg.picture,sac.balance FROM re_admission r LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id LEFT JOIN student_account sac ON sac.stu_id = r.stu_id WHERE r.shiftid = $shift AND r.classid = $ch AND r.section = $section AND r.roll_no = $roll ")->row();

$where = array(
		"stu_id" => $getProfileInfo->stu_id,
		"years"  => $y,
		"generate_status<"  => 3,
		"from_month >= " => $month,
		"to_month <= " => $month
	);

$billStatus = $this->db->select("*")->from("stu_bill")->where($where)->get()->num_rows();


if(!$getProfileInfo->stu_id):

	echo "<h3 style='color:red;'>".$getProfileInfo->stu_id."Invalid Roll No.Please provide valid roll no.</h3>";
elseif($billStatus):
	echo "<h3 style='color:red;'>Already bill generated for this month of this student.</h3>";
else:

?>


<!-- 
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">-->

				<div class="col-md-8"> 
<?php
	

	$yearck = date("Y-m-d"); 

	$nr = 1;
	$classfesql = $this->db->query("SELECT * FROM class_fee_sett WHERE classid='$class' AND year='$yearck'")->result();
?>
					<table class="table">
						<thead>
							<tr>
								<th>SI</th>
								<th>Category Name</th>
								<th>Amount</th>
							</tr>
						</thead>
						
						<tbody>
							
					<?php 

					foreach($classfesql as $clbillrow){
						$bilname = $this->accmodone->classfeecatg($clbillrow->feectgid);

					?>
						<tr>
							<td><?php echo $nr;?></td>
							
							<td>
								<input type="checkbox" name="feeidck[]" id="feeidck<?php echo $nr?>" value="<?php echo $clbillrow->feeid;?>" onclick="checkBoxFunction(<?php echo $nr ?>,0)"><span style="margin-left:15px;"><?php echo $bilname->catg_type;?></span>
								
								<input type="hidden" name="fctgid[]" value="<?php echo $clbillrow->feectgid;?>" class="form-control" />

							</td>

							<td>
								<input type="text" name="amount[]" id="tamount<?php echo $nr?>"  class="form-control" value="<?php echo $clbillrow->amount;?>" readonly style="" />
							</td>

						</tr>		


					<?php $nr++;}?>

						<tr>
							<td colspan="2" style="text-align: right;"> Total: </td>
							<td>
								<input type="text" name="totalAmount" readonly id="totalAmount"  class="form-control col-sm-4" value="0" style="" />

								<input type="hidden" id="rowValue" value="<?php echo $nr; ?>" />

							</td>
						</tr>
						<tr>
							<td colspan="3">
								<button type="submit" name="singleStudentBill" id="submitbillbtn" class="btn btn-primary" style="float:"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							</td>
						</tr>
					</tbody>
					</table>
				</div>
			
				<div class="col-md-4" style="border: 1px solid #d0d0d0;">
					<table>
						<tr>
							<td colspan="2">
								<img src="img/student_section/registration_form/<?php echo $getProfileInfo->picture ?>" class="img-circle" alt="<?php echo $getProfileInfo->name ?>" height="100" width="100" style="margin-left: 50%;" />
							</td>
						</tr>
						<tr>
							<td>Student ID :</td>
							<td>
								<?php echo $getProfileInfo->stu_id ?>
								<input type="hidden" name="proStu" value="<?php echo $getProfileInfo->stu_id ?>" />
							</td>
						</tr>
						<tr>
							<td>Student Name : </td>
							<td style="padding-left: 10px;">
								<?php echo $getProfileInfo->name ?>
							</td>
						</tr>
						<tr>
							<td>Shift :</td>
							<td><?php echo $getProfileInfo->shift_N ?></td>
						</tr>
						<tr>
							<td>Class :</td>
							<td><?php echo $getProfileInfo->class_name ?></td>
						</tr>
						<tr>
							<td>Section :</td>
							<td><?php echo $getProfileInfo->section_name ?></td>
						</tr>
						<tr>
							<td>Roll :</td>
							<td><?php echo $getProfileInfo->roll_no ?></td>
						</tr>
						<tr>
							<td>Balance :</td>
							<td><?php if($getProfileInfo->balance > 0):echo $getProfileInfo->balance;else:echo $getProfileInfo->balance." (Due) ";endif; ?></td>
						</tr>
					</table>
				</div>	
			<!-- </div>
		</div>
	</div>
</div> -->

<?php endif; ?>