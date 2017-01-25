<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
				<style>
					table tr td input {
						text-align:center;
					}
					.badge.badge-success {
						background-color: #00a651;
						color: #ffffff;
					}
				</style>
				<script>
					
				
				</script>
                <section class="content-header">
                    <h1>
                        Attendance Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

<script>
$("document").ready(function(){
	
	$("#attendance_edit").submit(function(e) {
	e.preventDefault();
	
	var formData = new FormData(this);

	$.ajax({  
		 type: "POST",  
		 url: "index.php/student_submit/attendance_edit",  
		 data: formData,
		 async: false,
		 cache: false,
		 contentType: false,
		 processData: false,
		 beforeSend:function(){
			 document.getElementById('attendance_submit').disabled = "disabled";	
			 document.getElementById('attendance_submit').innerHTML = 'Saveing---';
		 },
		 success: function(data) {
			 if(data==1)
			 {
				 alert('Data Save Successfully');
				 window.location="index.php/student_section/attendance";
			 }
			 else { 
			 alert(data);
			 document.getElementById('attendance_submit').innerHTML = 'Save';
             document.getElementById('attendance_submit').disabled = false;
			 }
		 }
	}); 
	//return false;
	});
		
		
});

</script>				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					
					
					<?php
						//print_r($_POST);
						if(isset($_POST['submit'])){
							$cls_name=$this->input->post('class_name');
							$shift=$this->input->post('shift');
							$section=$this->input->post('section');
							$date=date("Y-m-d");
							$ses=date("Y");
							
							$chk_aten=$this->student->attendanc_exist_chk($shift,$cls_name,$section,$date);
							$chk_aten=1;
							if($chk_aten>0){
								
							$select=$this->student->section_wise_student($ses,$shift,$cls_name,$section);
							?>
							<div class="box">
								<div class="box-header">
									<br/>
									<center>
										<p style="line-height:10px;"><b>Shift:</b>
										<?php echo $this->student->shift_info($shift)->shift_N; ?>
										</p>
										<p style="line-height:10px;"><b>Class Name:</b><?php echo $this->bsetting->get_class_name($cls_name)->class_name; ?></p>
										<p style="line-height:10px;"><b>Section:</b><?php echo $this->bsetting->ge_section($section)->section_name; ?></p>
										<p style="line-height:10px;"><b>Date:</b> <span class="badge badge-success"><?php echo $date; ?></span></p>
									</center>
								</div>
								<div class="box-body">
							<form action="student_submit/attendance" method="post" id="attendance_edit">
								<div class="row">
									<div class="col-md-12">
										<table id="" class="table table-bordered table-condensed table-striped">
											<thead>
												<tr>
													<th>
													
													<input type="hidden" name="cls_name" value="<?php echo $cls_name; ?>"/>
													<input type="hidden" name="section" value="<?php echo $section; ?>"/>
													<input type="hidden" name="shift" value="<?php echo $shift; ?>"/>
													
													ID
													
													</th>
													<th>Name</th>
													<th>Roll</th>
													<th>Picture</th>
													<th>
													
														Attendance
													
													</th>
											
										
												
												</tr>
											</thead>
											<tbody>
												
												<?php
													$present=$this->student->daily_attendance_edit_sheet($shift,$cls_name,$section,$date);
													$stu_id=explode(",",$present->stu_id);
													$roll_no=explode(",",$present->roll_no);
													
													foreach($select as $value) {
														
												?>
												<tr>
													<td>
													
													<input type="hidden" value="<?php echo trim($value->stu_id)."/".trim($value->roll_no); ?>" name="stu_id[]" class="form-control" readonly="readonly"/>
													<?php  echo $value->stu_id; ?>
													</td>
													<td><?php echo $value->name; ?>
													</td>
													<td><?php echo $value->roll_no; ?></td>
													<td><img src="img/student_section/registration_form/<?php echo $value->picture; ?>" class="img-responsive img-thumbnail" style="height:50px;width:50px;"/></td>
													<td><input type="checkbox" name="chk_box[]" <?php if(in_array($value->stu_id,$stu_id)){ echo "checked"; } else{  } ?> value="<?php echo trim($value->stu_id)."/".trim($value->roll_no); ?>" /> </td>
													<input type="hidden" name="e_date" value="<?php echo $value->e_date; ?>"/>
													<input type="hidden" name="e_user" value="<?php echo $value->e_user; ?>"/>
												</tr>
													<?php  } ?>
											</tbody>
											
												</table>
											</div>
										</div>
									</div>
								
								</div>
								
								<div class="row" style="margin-top:10px;">
									<div class="col-md-12">
										<center>
												<button type="submit" name="submit_edit" onclick="return confirm_reset();" class="btn btn-primary" id="attendance_submit">Save</button>
												&nbsp;&nbsp;
												<a href="student_section/attendance">
												<button type="button"  class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span> Back</button>
												</a>
										</center>
										
									</div>
									
								</div>
							</form>
						<?php }	else {
							?>
							
							<a href="student_section/attendance"><button class="btn btn-danger btn btn-block">Please Saved Data Go to Save <span class="glyphicon glyphicon-backward"></span></button></a>
							
						<?php 	
						} } ?>
						
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->