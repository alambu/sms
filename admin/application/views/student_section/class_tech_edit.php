<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
				
	<style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">


function ajax_request_clsid(cls_id){
						
	$.ajax({
		url: "index.php/student_submit/ajax_request",
		type: 'POST',	
		data:{cls_id:cls_id},	
		success: function(data)
		{		
			var d=data.split(",");
			var sec="select";
			document.getElementById("section").innerHTML='';
			document.getElementById("section").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("section").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
			}
		}          
		});
	}		

function class_tech_chk(empid,y,sft){
	//alert(empid);
	//alert(y);
	//alert(sft);
	$.ajax({
		url: "index.php/student_submit/class_tech_chk",
		type: 'POST',	
		data:{empid:empid,cts_y:y,cts_sft:sft},	
		success: function(data)
		{		
			if(data==1){
				document.getElementById("show_tech_position").innerHTML="";
			}
			else {
			alert('THEACHER ALREADY EXIST');
			document.getElementById("teach_name").value="";
			document.getElementById("show_tech_position").innerHTML=data;
			}
		}          
		});
	
}	
	
</script>
<?php 
	if(isset($_GET['id'])){
		$ctsid=$_GET['id'];
		$y=$_GET['y'];
		$info=$this->db->query("select a.*,b.class_name,c.shift_N,d.name
        from class_tehsett a,class_catg b,shift_catg c,empee d where a.classid=b.classid and a.shiftid=c.shiftid
        and a.empid=d.empid and a.ctsid='$ctsid'")->row();
	}
?>
                <section class="content-header">
                    <h1>
                       Class Teacher Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container">
<!-----------------------confirmation msg start-------------------------->	
						<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------------confirmation msg End-------------------------->						
					   <form class="form-horizontal" role="form" action="student_submit/class_tech_setting" method="post">
						
						<div class="form-group">        
						   <div class="col-md-5">          
							<label>Shift Name</label>
							<input type="text" name="" value="<?php echo $info->shift_N; ?>" class="form-control"  readonly required />
							
							<input type="hidden" name="shiftid" id="shiftid" value="<?php echo $info->shiftid; ?>"/>
						  </div>
						  
						  <div class="col-md-5">
							<label>Class Name</label>
							<input type="text" name="" value="<?php echo $info->class_name; ?>" class="form-control" id="class_name" readonly required>
							<input type="hidden" name="ctsid" value="<?php echo $ctsid; ?>"/>
							<input type="hidden" name="class_name" value="<?php echo $info->classid; ?>"/>
						  </div>
						   
						</div> 
						<div class="form-group">
						   <div class="col-md-5"> 
							<label>Section</label>
							<input type="text" name="section" value="<?php echo $info->section; ?>" readonly class="form-control" id="section" required />
								
						  </div>
						  <div class="col-md-5">
							<label>Year</label>
							<input type="text" name="year" value="<?php echo $info->years; ?>" class="form-control" id="year"  readonly required />
						  </div>
						 </div>
						<div class="form-group">
							<div class="col-md-5">
							<label>Present Class Teacher</label>
								<input type="text" class="form-control" name="pre_tech" value="<?php echo $info->name; ?>" readonly />
							</div>
							<div class="col-md-5">
							<label>New Class Teacher</label>
							<select type="text" name="teach_name" class="form-control" id="teach_name" onchange="class_tech_chk(this.value,year.value,shiftid.value);"  required >
											<option value="">Select New Teacher</option>
											<?php
													
											$teacher_id=$this->db->query("select emptypeid from  emp_type where type='teacher'")->row()->emptypeid;
											$select=$this->db->query("select * from empee where emptypeid='$teacher_id' and empid!='$info->empid'")->result();
											foreach($select  as $value){
											?>
											<option value="<?php echo $value->empid; ?>"><?php echo $value->name; ?></option>
											<?php } ?>
							</select>
							<input type="hidden" name="teach_txt" id="teach_txt"/>
							</div>
						</div>
						
						<div class="form-group">
						   <div class="col-md-5">          
							<button type="submit" name="submit_edit" class="btn btn-primary" data-toggle="tooltip" title="Update"><span class="glyphicon glyphicon-send"></span> Update</button>&nbsp;&nbsp;
							<a href="student_section/level_2_setting">
							<button type="button" value="" class="btn btn-success" data-toggle="tooltip" title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button>
							</a>
						  </div>
						</div> 
						
						  
					</form>
					<div class="row">
						<div class="col-md-10" id="show_tech_position">
						
						</div>
					</div>
						
					</div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->