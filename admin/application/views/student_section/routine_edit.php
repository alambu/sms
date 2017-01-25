<aside class="right-side">      <!---rightbar start here --->
       <section class="content-header">
                    <h1>
                        Class Routine
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					
												<?php 
							if(isset($_GET['shift'])){
								extract($_GET);
								//$y=date("Y");
								$routine=$this->db->query("select a.*,b.maxclass,b.classid from
								routine a,class_period b where a.classid='$class_name' and a.section='$section' and a.shiftid='$shift'and b.classid='$class_name' and a.year='$year'")->result();
								
								$subject=$this->db->query("select * from subject_class where classid='$class_name'")->result();
								
								$teacher=$this->db->query("select a.name,a.empid,a.emptypeid,b.type,b.emptypeid from empee a,emp_type b where a.emptypeid=b.emptypeid and b.type='Teacher'")->result();
								
								$cls_teacher=$this->db->query("select a.empid,b.name from class_tehsett a,empee b where a.years='$year' and a.shiftid='$shift' and a.classid='$class_name' and a.section='$section' and a.empid=b.empid")->row();
							}	
						?>

<script type="text/javascript">
function  time_valid() {
						
	var cls,st,et,i,stv,etv;
	
	cls=document.getElementById("max_cls").value;
	
	for(i=1;i<=cls;i++){
		if(i==1) {
			
			st=document.getElementById(i).value;
			et=document.getElementById(i+parseInt(1)).value;
			
			if(st>=et) {
				document.getElementById("time_error").innerHTML="Invalid Time";
				document.getElementById(i+parseInt(1)).value="";
				document.getElementById(i+parseInt(1)).focus();
				
				return false;
			}
			document.getElementById("time_error").innerHTML="";
		}
		else if(i==2) {
			document.getElementById("time_error").innerHTML="";
			stv=document.getElementById(i).value;
			etv=document.getElementById(i+parseInt(1)).value;
			if(stv>etv) {
				document.getElementById("time_error").innerHTML="Invalid Time";
				document.getElementById(i+parseInt(1)).value="";
				document.getElementById(i+parseInt(1)).focus();
				return false;
			}
			document.getElementById("time_error").innerHTML="";
		}
		else {
			if(i%2==0){
				document.getElementById("time_error").innerHTML="";
				stv=document.getElementById(i).value;
				etv=document.getElementById(i+parseInt(1)).value;
				if(etv<stv){
					document.getElementById("time_error").innerHTML="Invalid Time";
					etv=document.getElementById(i+parseInt(1)).value="";
					etv=document.getElementById(i+parseInt(1)).focus();
					return false;
				}
			}
			else {
				document.getElementById("time_error").innerHTML="";
				stv=document.getElementById(i).value;
				etv=document.getElementById(i+parseInt(1)).value;
				if(etv<=stv){
					document.getElementById("time_error").innerHTML="Invalid Time";
					etv=document.getElementById(i+parseInt(1)).value="";
					etv=document.getElementById(i+parseInt(1)).focus();
					return false;
				}
				
			}
			document.getElementById("time_error").innerHTML="";
		}

		}
	
}

function subject_valid_onchange(fsv,wnid,max,rwm,exist_val){
	//alert(exist_val);
	for(var t=0;t<max;t++){
		if(t!=parseInt(wnid)){
			var id=rwm+"_"+t;
			var othSub=document.getElementById(id).value;
			if(othSub==fsv){
				var fake=rwm+"_"+wnid;
				alert("This subject already selected for this day.");
				//alert(fake);
				document.getElementById(fake).value =exist_val;
			}
		}
	}	
}


function teacher_valid_onchange(v,teach_id,sft,cls,y,ex_v) {
	var mcls,tim,i,did,tsp,ttime,fakeid,tid;
	mcls=document.getElementById("max_cls").value;
	did=document.getElementById(teach_id);
	tsp=teach_id.split("_");tid=parseInt(tsp[2])+parseInt(1);
// time empty test
	for(i=1;i<=mcls;i++){
		tim=document.getElementById(i);
		if(tim.value==''){
			alert('Please Select Time');
			did.value="";
			tim.focus();
			return false;
		}
	}	
// time empty test end

// time exist by query start 
	if(tsp[2]==1){
	fakeid=parseInt(tsp[2])+parseInt(2);
	}
	else {
	fakeid=parseInt(tsp[2])+parseInt(tid);	
	}
	ttime=document.getElementById(fakeid).value;
	
//------------query start--------------	
	$.ajax({
		url: "index.php/student_submit/ajax_request",
		type: 'POST',	
		data:{rot_day:tsp[1],rot_sft:sft,tec_code:v,test_time:ttime,rot_y:y},	
		success: function(data)
		{	
			if(data==1){
				
			}
			else {
				alert('This Teacher Already Selected');
				did.value=ex_v;
				return false;
			}
		}          
		});	
//------------query End----------------	

	
//time exist by query End
	
}


function submit_confirm(){
	var con=confirm("Are You Sure?");
	if(con==true){
		return true;
	}
	else{
		return false;
	}
}
</script>	
<style>
	table tr :nth-child(){
		background:green;
	}
	table tr :nth-child(){
		background:red;
	}
</style>	
						<div class="row">
							<div class="col-md-12">
							
							   <div class="box">
									<div class="box-header">
										<h3 class="box-title">Class Routine Edit</h3>                                    
									</div><!-- /.box-header -->
									<div class="box-body table-responsive">
										<span id="time_error" style="text-align:center;font-size:20px;color:red;font-weight:bold;"></span>
										<form action="index.php/student_submit/class_routine" method="post" onsubmit="return time_valid();">
											<table class="table table-bordered table-hover table-responsive">
												<tr class="active">
													<td style="font-size:20px;font-weight:bold;text-align:center;">Preiod</td>
													<?php
														$max_cls=$routine[0]->maxclass;
														for($p=1;$p<=$max_cls;$p++){
													?>
													<td style="font-weight:bold;text-align:center;">
														<?php echo  $p."th&nbsp;period"; ?>
													</td>
													<?php } ?>
													<!-------- Time SHow ------->
												</tr>	
												<tr class="success">
													<td style="font-size:20px;font-weight:bold;text-align:center;">Time</td>
													<?php 
														$tid=0;
														for($i=0;$i<$max_cls;$i++){ 
														$tid++;
													?>
													<td>
											
														<input type="time" name="s_time[]" id="<?php echo $tid; ?>" class="form-control" value="<?php echo $routine[$i]->stime; ?>" onblur="time_valid();"/>
														
														<center><span class="glyphicon glyphicon-hand-down"></span></center>
														
														<input type="time" name="e_time[]" id="<?php echo ++$tid; ?>" class="form-control" value="<?php echo $routine[$i]->etime;?>" onblur="time_valid();"/>
											
													</td>
													<?php } ?>
													<input type="hidden" value="<?php echo $max_cls; ?>" id="max_cls"/>
												</tr>
												
												<!--------Subject And Teacher Show------------>
												
												<?php
												$array=array("Satarday","Sunday","Monday","Tuesday","Wednesday","Thuasday","Friday");
												$rm=0;$frm=0;$end=0;$ex_index=0;
												foreach($array as $day){
													$rwm=$array[$rm];$first_tech=1;
												?>
												<tr>
													<td style="font-size:20px;font-weight:bold;text-align:center;">
													<?php echo substr($day,0,3); ?>
													</td>
													<?php
													$ro_day=$this->db->query("select subjid,teacherid,routineid from routine where classid='$class_name' and section='$section' and shiftid='$shift' and day='$day'")->result();
													for($i=0;$i<$max_cls;$i++){
														
													?>
													<td>
													<input type="hidden" name="row_id[]" value="<?php echo $ro_day[$i]->routineid; ?>"/>
													
													<!--Subject name show----->
													<select name="sub_name[]" class="form-control" onchange="subject_valid_onchange(this.value,<?php echo $i; ?>,<?php echo $max_cls; ?>,'<?php echo $rwm ?>',<?php echo $ro_day[$i]->subjid; ?>)" id="<?php echo $rwm ?>_<?php echo $i; ?>" <?php if($rwm!='Friday'):if($rwm=='Thuasday'):if($i<4):echo "required";endif;endif;endif; ?>>
													<?php foreach($subject as $sub_value){ ?>
														<?php if($ro_day[$i]->subjid==''){?>
														<option value="">Subject Select</option>
														<?php } ?>
														<option <?php if($ro_day[$i]->subjid==$sub_value->subjid){ echo "selected"; } ?>  value="<?php echo $sub_value->subjid; ?>">
														<?php echo $sub_value->sub_name; ?>
														</option>	
													<?php } ?>
													</select>
													
													<!----Teacher name show----->
													<?php 
													foreach($teacher as $teach_value){
														if($ro_day[$i]->teacherid==$teach_value->empid){
															$default_tech=$teach_value->empid;
															}
													}
													?>
													
													<select style="margin-top:5px;" name="teach_name[]" class="form-control" id="tech_<?php echo $day; ?>_<?php echo $i; ?>"  onchange="teacher_valid_onchange(this.value,this.id,rot_sft.value,rot_cls.value,rot_year.value,<?php echo $default_tech; ?>)" required>
													<?php if($first_tech==1){?>
														<option value="<?php echo $cls_teacher->empid; ?>"><?php echo $cls_teacher->name; ?></option>
														<?php } else { ?>
													<?php foreach($teacher as $teach_value){?>
														
														<option <?php if($ro_day[$i]->teacherid==$teach_value->empid){ echo "selected"; } ?>  value="<?php echo $teach_value->empid; ?>">
														<?php echo $teach_value->name."(".$teach_value->empid.")"; ?>
														</option>
														
													<?php } } ?>
													</select>
													</td>
													<?php $first_tech++; } ?>
													<input type="hidden" name="days[]" value="<?php echo $day; ?>"/>
												</tr>
												
												<?php $rm++;} ?>
												<tr>
													<td style="text-align:center;" colspan="<?php echo $max_cls+1; ?>">
													
													
													<input type="hidden" name="shift" value="<?php echo $shift; ?>" id="rot_sft"/>
													<input type="hidden" name="section" value="<?php echo $section; ?>"/>
													<input type="hidden" name="cls_name" value="<?php echo $class_name;?>" id="rot_cls"/>
													<input type="hidden" name="year" value="<?php echo $year;?>" id="rot_year"/>
										
														 <button type="submit" name="submit_edit"   class="btn btn-primary" onclick="return submit_confirm();">
														<span class="glyphicon glyphicon-send"></span>  Save
														 </button>&nbsp;&nbsp;
														<a href="student_section/level_2_setting"><button type="button"  name="reset"  class="btn btn-warning">
															<span class="glyphicon glyphicon-hand-left"></span>  Back
														</button></a>
													
													</td>
													
							
												</tr>
											</table>
										</form>
								    </div>
								</div>
						    </div>
					    </div>
					                  
		</div>
	</section><!-- /.content -->
</aside><!-- /.right-side -->     <!---rightbar close here ---->