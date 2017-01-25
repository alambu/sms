<script>

function routine_not_group_create_edit(did)
{
	    document.getElementById('routine_not_group_submit_edit'+did).innerHTML = 'Updateing----';
		document.getElementById('routine_not_group_submit_edit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/routine_submit/routine_not_group_create_edit",
            $("#routine_not_group_create_edit"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Update Successfully');
				  document.getElementById('routine_not_group_submit_edit'+did).disabled = false;
			  }	
			  else {
				alert(data);
				document.getElementById('routine_not_group_submit_edit'+did).disabled = false;
			  }
			  document.getElementById('routine_not_group_submit_edit'+did).innerHTML = 'Update';
		});
		return false; 
}


function routine_group_create_edit(did)
{
		document.getElementById('routine_group_submit'+did).innerHTML = 'Updateing----';
		document.getElementById('routine_group_submit'+did).disabled = 'disabled';
	  	$.post(
            "index.php/routine_submit/routine_group_create_edit",
            $("#routine_group_create_edit"+did).serialize(),
            function(data){
              if(data==1)
			  {   alert('Update Successfully');
				  document.getElementById('routine_group_submit'+did).disabled = false;
			  }	
			  else {
				alert(data);
				document.getElementById('routine_group_submit'+did).disabled = false;
			  }
			  document.getElementById('routine_group_submit'+did).innerHTML = 'Update';
		});
		return false; 
} 

function group_select(sv,did)
{
	//alert(sv);
	if(sv==0)
	{
		document.getElementById("group_title_"+did).style.display="none";
		document.getElementById("com_title_"+did).style.display="block";
	}
	else if(sv==1) 
	{
		document.getElementById("com_title_"+did).style.display="none";
		document.getElementById("group_title_"+did).style.display="block";
	}
	else if(sv=='')
	{
		
		document.getElementById("group_title_"+did).style.display="none";
		document.getElementById("com_title_"+did).style.display="none";
	}
}
</script>

<style>
.panel-heading a:after {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: black;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}
table tr:hover{
	background:lightblue;
}
table tr:hover {
	background:lightblue !important;
}
</style>
	<?php 
	
	extract($_GET);
	$w=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls);
	$section=$this->bsetting->section_info($cls);
	$teacher=$this->employee->all_teacher();
	$subject=$this->bsetting->class_wise_subject($cls);
	$cls_period=$this->routine->class_period($w);
	$total_period=$cls_period->maxclass;
	$w1=array('year'=>$year,'shiftid'=>$sft,'shidule_id>='=>$cls_period->shidule_id);
	$shidule=$this->routine->shift_shidule($w1);
	$days=array('1'=>'Satarday','2'=>'Sunday','3'=>'Monday','4'=>'Tuesday','5'=>'Wednsday','6'=>'Thusday','7'=>'Friday');
	//print_r($section);exit;
	?>
	<div class="panel-group" id="accordion2">
		<?php $i=1; foreach($section as $value){  
		//echo $value->sectionid;
		$where=array('years'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$value->sectionid);	
		$group=$this->student->group_detact_test($value->sectionid);
		$cls_teacher=$this->routine->class_teacher($where);
		$cls_tech_info=$this->db->query("select * from empee where empid='$cls_teacher->empid'")->row();
		
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
			  <h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion1" href="#sec_edit<?php echo $i; ?>">
				 <span class="glyphicon glyphicon-hand-right"></span>  Section:- <?php echo $value->section_name; ?></a>
			  </h4>
			</div>
			
			<div id="sec_edit<?php echo $i; ?>" class="panel-collapse collapse">
				
				<div class="panel-body">
				<!-------Identify Class Group start--------->
				<?php if($group=='') {  ?>
				<!-------Identify Class Group end----------->
				<?php 
				$j=1;
				foreach($days as $dkey=>$dvalue) { 
				$rw=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$value->sectionid,'day'=>$dkey);
				//print_r($rw);
				$routine=$this->routine->class_routine_report($rw);
				$tperiod=$total_period;
				?>
					<form action="routine_submit/routine_not_group_create_edit" method="post" id="routine_not_group_create_edit<?php echo $j.$dkey.$value->sectionid; ?>" onsubmit="return routine_not_group_create_edit(<?php echo $j.$dkey.$value->sectionid; ?>);">
					
					    <table class="table table-condensed table-striped">
							
							<tr>
								<td colspan="4">
									<center style="font-weight:bold;font-size:18px;"><span class="label label-success"><?php echo $dvalue; ?></span></center>
									<input type="hidden" name="total_period" value="<?php echo $tperiod; ?>"/>
									<input type="hidden" name="year" value="<?php echo $year; ?>"/>
									<input type="hidden" name="shift" value="<?php echo $sft; ?>"/>
									<input type="hidden" name="cls" value="<?php echo $cls; ?>"/>
									<input type="hidden" name="day" value="<?php echo $dkey; ?>"/>
									<input type="hidden" name="section" value="<?php echo $value->sectionid; ?>"/>
								</td>
							</tr>
							<?php if(count($routine)>1) { ?>
							<tr class="success">
								<th>Number Of Period</th>
								<th>Period</th>
								<th>Subject</th>
								<th>Teacher</th>
							</tr>
							<?php 
							 	
				
							$k=1; foreach($routine as $svalue)  {
							if($svalue->period_title>0) {
							?>
							<tr>
								<td>
									<?php echo $k." th"; ?>
									<input type="hidden" name="routine_id[]" value="<?php echo $svalue->routineid?>"/>
								</td>
								
								<td style="color:#3C8DBC;font-weight:bold;">
									
									<?php echo date("g:i:A",strtotime($svalue->stime)); ?>  &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;  <?php echo date("g:i:A",strtotime($svalue->etime)); ?>
								</td>
								
								<td>
									<select name="subject[]" class="form-control" style="display:<?php echo $display;?>;">
										<option value="">Select Subject</option>
										<?php foreach($subject as $subvalue) { ?>
										<option <?php if($subvalue->subjid==$svalue->subjid) { echo "selected"; } ?> value="<?php echo $subvalue->subjid; ?>"><?php echo $subvalue->sub_name; ?></option>
										<?php } ?>
									</select>
									<input type="hidden" name="period_title[]" value="<?php echo $svalue->period_title; ?>"/>
								</td>
								
								<td>
									<select name="teacher[]" class="form-control" style="display:<?php echo $display;?>;">
										
										<?php if($k==1) { ?> 
										<option value="<?php echo $cls_teacher->empid; ?>"><?php echo $cls_tech_info->name."( ".$cls_tech_info->nickN." )"; ?></option> <?php  }  else {  ?>
										<?php if($svalue->teacherid=='') { echo "<option value=''>Select Teacher</option>"; } ?>
										<?php foreach($teacher as $tvalue) 
										{ 
										?>
										<option <?php if($tvalue->empid==$svalue->teacherid) { echo "selected"; } ?> value="<?php echo $tvalue->empid; ?>"><?php echo $tvalue->name." ( ".$tvalue->nickN." )"; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</td>
							</tr>
							<?php $k++; }  else { ?>
							<tr>
								<td><?php if($svalue->period_title>0){ echo $k." th"; } ?></td>
								<td style="color:#3C8DBC;font-weight:bold;">
									
									<?php echo date("g:i:A",strtotime($svalue->stime)); ?>  &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;  <?php echo date("g:i:A",strtotime($svalue->etime)); ?>
									<input type="hidden" name="period_title[]" value="<?php echo $svalue->period_title; ?>"/>
									<input type="hidden" name="routine_id[]" value="<?php echo $svalue->routineid?>"/>
								</td>
								<td colspan="2"><center><b>----------------------------------------Break--------------------------------------</b></center></td>
							</tr>
							<?php } } ?>
							<tr><td colspan="4"><center><button type="submit" name="submit" class="btn btn-primary btn-sm" id="routine_not_group_submit_edit<?php echo $j.$dkey.$value->sectionid; ?>">Update</button></center></td></tr>
							<?php } else { echo "<tr><td colspan='4'><center><h5>Routine Not Found</h5></center></td></tr>"; }  ?>
					    </table>
						
					</form>	
					
				<?php   } 
				}
				
				
				else {
				?> 
				<!-----group wise Routine start----->

						<?php 
						foreach($days as $dkey=>$dvalue) {
						$rw=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$value->sectionid,'day'=>$dkey);
						$routine=$this->routine->class_routine_report($rw);
						$tperiod=count($routine);
						?>
						<form action="routine_submit/routine_group_create_edit" method="post" id="routine_group_create_edit<?php echo $i.$dkey.$value->sectionid; ?>" onsubmit="return routine_group_create_edit(<?php echo $i.$dkey.$value->sectionid; ?>);">
						<table class="table table-condensed table-striped">	
							
							<tr><td colspan="3">
								<center style="font-weight:bold;font-size:18px;"><span class="label label-success"><?php echo $dvalue; ?></span></center>
								<input type="hidden" name="day" value="<?php echo $dkey; ?>"/>
								<input type="hidden" name="total_period" value="<?php echo $tperiod; ?>"/>
								<input type="hidden" name="year" value="<?php echo $year; ?>"/>
								<input type="hidden" name="shift" value="<?php echo $sft; ?>"/>
								<input type="hidden" name="cls" value="<?php echo $cls; ?>"/>
								<input type="hidden" name="section" value="<?php echo $value->sectionid; ?>"/>
								
								</td>
							</tr>
							<tr class="success">
								<th style="width:20%;">Number Of Period</th>
								<th style="width:20%;">Period</th>
								<th style="width:60%;">Period Title</th>
							</tr>
							<?php 
							$j=1; foreach($routine as $svalue) {
							//echo count($routine);
							if($svalue->period_title>0){
							?>
							<tr>
								<td style="width:20%;"><?php echo $j." th"; ?>
								<input type="hidden" name="shidule_id[]" value="<?php echo $svalue->shidule_id;?>"/>
								<input type="hidden" name="period_title[]" value="<?php echo $svalue->period_title;?>"/>
								<input type="hidden" name="routineid[]" value="<?php echo $svalue->routineid;?>"/>
								<?php $group_info=$this->bsetting->group_explode_array($group); ?>
								<input type="hidden" name="total_group" value="<?php echo count($group_info); ?>"/>
								</td>
								
								<td style="color:#3C8DBC;font-weight:bold;width:20%;">
									<?php echo date("g:i:A",strtotime($svalue->stime)); ?>  &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;  <?php echo date("g:i:A",strtotime($svalue->etime)); ?>
								</td>
								
								<td style="width:60%;">
									<table class="table table-condensed" style="width:100%;">
										<tr>
											<td colspan="2">
													<?php //echo $break; ?>
													<select name="grp_title[]" class="form-control" onchange="group_select(this.value,<?php echo $i.$j.$dkey; ?>);">
														<?php if($svalue->groupid==0) { ?>
														<option value="0">Combine</option>
														<option value="1">Group</option>
														<?php } else { ?>
														<option value="1">Group</option>
														<option value="0">Combine</option>
														<?php } ?>
													</select>
											</td>
										</tr>
										<?php  if($svalue->groupid==0) { $com_dis='block'; $grp_dis='none'; }  else  { $com_dis='none'; $grp_dis='block'; }?>
										<tr id="com_title_<?php echo $i.$j.$dkey; ?>" style="display:<?php  echo $com_dis; ?>;">
											<td>
												<?php // echo $break; ?>
												<select name="subject_com[]" class="form-control">
													<option value="">Select Subject</option>
													<?php foreach($subject as $subvalue) { ?>
													<option <?php if($subvalue->subjid==$svalue->subjid) { echo "selected"; } ?> value="<?php echo $subvalue->subjid; ?>"><?php echo $subvalue->sub_name; ?></option>
													<?php } ?>
												</select>
											</td>
											
											<td>
												
												<select name="teacher_com[]" class="form-control" style="display:<?php echo $display;?>;">
													<?php if(($j==1) && ($dkey<7)) { ?> 
													<option  value="<?php echo $cls_teacher->empid; ?>"><?php echo $cls_tech_info->name."( ".$cls_tech_info->nickN." )"; ?></option> <?php  }  else { ?>
													<option  value="">Select Teacher</option>
													<?php foreach($teacher as $tvalue) { ?>
													<option <?php if($tvalue->empid==$svalue->teacherid) { echo "selected"; } ?> value="<?php echo $tvalue->empid; ?>"><?php echo $tvalue->name." ( ".$tvalue->nickN." )"; ?></option>
													<?php } ?>
													<?php } ?>
												</select>
											</td>
										</tr>
										
										<tr id="group_title_<?php echo $i.$j.$dkey; ?>" style="display:<?php  echo $grp_dis; ?>;">
											<td colspan="2">
												<input type="hidden" name="total_group" value="<?php echo count($group_info); ?>"/>
												<table class="table table-condensed" style="width:100%;">
													<tr>
														<td>Group</td>
														<td>Subject</td>
														<td>Teacher</td>
													</tr>
													<?php 
													$m=0;
													if($svalue->groupid!=0)
													{	
													$group_info=$this->bsetting->group_explode_array($svalue->groupid);
													}
													else 
													{
													$group_info=$this->bsetting->group_explode_array($group);	
													}
												
													$subject_info=$this->routine->subject_explode_array($svalue->subjid);  
													$teacher_info=$this->routine->teacher_explode_array($svalue->teacherid);
													foreach($group_info as $gvalue) { 
													?>
													<tr>
														<td>
															
															<select name="group[]" class="form-control">
																<option value="<?php echo $gvalue; ?>">
																<?php echo $this->db->select("*")->from("group_setup")->where("groupid",$gvalue)->get()->row()->group_name; ?></option>
															</select>
															
														</td>
														
														<td>
															<select name="subject_grp[]" class="form-control">
																<option value=''>Select Subject</option>
																<?php foreach($subject as $subvalue) { ?>
																<option <?php if($svalue->groupid!=0) { if($subject_info[$m]==$subvalue->subjid){ echo "selected"; } } ?> value="<?php echo $subvalue->subjid; ?>"><?php echo $subvalue->sub_name; ?></option>
																<?php } ?>
															</select>
														</td>
														
														<td>
															<select name="teacher_grp[]" class="form-control">
																<option value=''>Select Teacher</option>
																<?php foreach($teacher as $tvalue) { ?>
																<option <?php if($svalue->groupid!=0) { if($teacher_info[$m]==$tvalue->empid){ echo "selected"; } } ?> value="<?php echo $tvalue->empid; ?>"><?php echo $tvalue->name." ( ".$tvalue->nickN." )"; ?></option>
																<?php } ?>
															</select>
														</td>
														
													</tr>
													<?php $m++; } ?>
												</table>
											</td>
										</tr>
										
									</table>
									
									
								</td>
								
							</tr>
							
							<?php $j++; } else { ?>  
							<tr>
								<td></td>
								<td style="color:#3C8DBC;font-weight:bold;width:20%;">
									
									<?php echo date("g:i:A",strtotime($svalue->stime)); ?>  &nbsp;&nbsp;<span class="glyphicon glyphicon-arrow-right"></span>&nbsp;&nbsp;  <?php echo date("g:i:A",strtotime($svalue->etime)); ?>
								</td>
								
								<td>
									<input type="hidden" name="shidule_id[]" value="<?php echo $svalue->shidule_id?>"/>
									<input type="hidden" name="routineid[]" value="<?php echo $svalue->routineid?>"/>
									<b>------------------------------------------Break Period---------------------------------------------------</b>
								</td>
							</tr>
							<?php } } ?>
							<tr><td colspan="3"><center><button type="submit" name="submit_<?php echo $i.$dkey.$value->sectionid; ?>" class="btn btn-primary btn-sm" id="routine_group_submit<?php echo $i.$dkey.$value->sectionid; ?>">Update</button></center></td></tr>
							
						</table>
						</form>	
					<?php } ?>
					
				
				<!-----group wise Routine end------->
				
				
				<?php
				}
				?>
				  
				</div>
				  
			</div>
		</div>
		<?php $i++; } ?>
	</div>
	