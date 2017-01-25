<!-- php -->
<?php
// get shift id
	$shft=$this->db->get("shift_catg")->result();
// get class id
	$cls=$this->db->get("class_catg")->result();
?>
<!-- php -->

<!-- all script -->
<script type="text/javascript">

	function changeClass(str) {
		$.ajax({
		url: "index.php/home/changeCls",
		type: 'POST',	
		data:{cls_id:str},	
		success: function(data)
		{	
			if(data.length!=0){
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("sec").innerHTML='';
			document.getElementById("sec").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("sec").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
			}
			else {
				document.getElementById("sec").innerHTML='';
				document.getElementById("sec").innerHTML="<option value=''>Section Select</option>";
			}
		}
		
		});
	}
	
function isNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

function selected_class(sftid) {
	$.ajax({
	url: "index.php/home/selected_class",
	type: 'POST',	
	data:{sft_id:sftid},	
	success: function(data)
	{
		if(data!='#') {
		var data1=data.split("#");	
		var d=data1[0].split(",");
		var d1=data1[1].split(",");
		var sec="Select Class";
		document.getElementById("class").innerHTML='';
		document.getElementById("class").innerHTML="<option value=''>"+sec+"</option>";
		
		for(var i=0;i<d.length;i++){
			
			document.getElementById("class").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
		}
		
		}
		
		else {
			document.getElementById("class").innerHTML='';
			document.getElementById("class").innerHTML="<option value=''>Select Class</option>";
		}
	
	}
	
	});
}

</script>
<!-- all script -->

<style type="text/css">
	table tr th{border:none !important;}
	table tr td{border:none !important;}
	#sprofile tr th{text-align: right;}
	#sprofile tr td{color: black;font-family: arial;}
	#sprofile{color:black !important;}
</style>

<!--this is main dynamic content start--> 
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Student Information </div>
						<div class="panel-body" style="min-height:770px;">
							<form action="" method="post" class="form">
								<table class="table" style="width:75%;margin:0px auto;border:1px solid #d0d0d0;">
									<tr>
										<th>Shift :</th>
										<td>
											<select name="shift" id="shift" class="form-control" onchange="selected_class(this.value);">
												<option value="">Select</option>
											<?php foreach($shft as $s): ?>
												<option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N ?></option>
											<?php endforeach; ?>
											</select>
										</td>
									</tr>
									<tr>
										<th>Class :</th>
										<td>
											<select name="class" id="class" class="form-control" onchange="changeClass(this.value)">
												<option value="">Select</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>Section :</th>
										<td>
											<select name="sec" id="sec" class="form-control">
												<option value="">Select</option>
											</select>
										</td>
									</tr>
									<tr>
										<th>Roll :</th>
										<td>
											<input type="text" name="roll" id="roll" class="form-control" onkeypress="return isNumber(event)">
										</td>
									</tr>
									<tr>
										<td></td>
										<td>
											<button class="btn btn-primary" name="go" style="width:150px;">Search</button>
										</td>
									</tr>
								</table><hr style="border:1px solid #d0d0d0;" />
							</form>

<?php 
	if(isset($_POST['go'])):
		extract($_POST);
			// get student information
			$pdate=date("Y-m-d");
			
			$data=array(
				"classid"=>$class,
				"section"=>$sec,
				"shiftid"=>$shift,
				"roll_no"=>$roll,
				"syear"=>$pdate
			);
			$spro=$this->db->select("*")->from("re_admission")->where($data)->get()->row();
			//echo $this->db->last_query();
			// get class name
			$cls=$this->db->select("*")->from("class_catg")->where("classid",$class)->get()->row();
			// get shift
			$sft=$this->db->select("*")->from("shift_catg")->where("shiftid",$shift)->get()->row();
			// get roll
			$nm=$this->db->select("*")->from("regis_tbl")->where("stu_id",$spro->stu_id)->get()->row();


?>

<div class="col-md-9" style="margin-left:12%;border:1px solid #d0d0d0;">
    <table id="example1" class="table table-striped table-hover" style="height:100%;">
		<thead>
			<tr>
				<th colspan="3"><center><h1 style="padding-top:-100px;v-align:top;">Student Information</h1></center></th>
						
				<th>
					<center><img class="img-thumbnail" src="admin/img/student_section/registration_form/<?php echo $nm->picture; ?>" style="height:110px;width:120px;"/></center>
				</th>
			</tr>
		</thead>	
								
				<tbody>
					
					<tr>
						<td class="bold">Student ID</td>
						<td><?php echo $spro->stu_id; ?></td>
						<td class="bold">Student Name</td>
						<td><?php echo $nm->name;?></td>
					</tr>
									
					<tr>
						<td class="bold">Father Name</td>
						<td><?php echo $nm->fName; ?></td>
						<td class="bold">Mother Name</td>
						<td><?php echo $nm->mName;?></td>
					</tr>
									
					<tr>
						<td class="bold">Father Occopation</td>
						<td><?php echo $nm->foccupation; ?></td>
						<td class="bold">Mother's Occopation</td>
						<td><?php echo $nm->moccupation;?></td>
					</tr>
									
					<tr>
						<td class="bold">Class</td>				
						<td><?php echo $this->db->select("class_name")->from("class_catg")->where("classid",$class)->get()->row()->class_name;?>
						</td>
						<td class="bold">Section</td>
						<td><?php echo $this->db->select("section_name")->from("section_tbl")->where("sectionid",$sec)->get()->row()->section_name; ?></td>
					</tr>

					<tr>
						<td class="bold">Date Of Birth</td>			
						<td><?php echo $nm->dob; ?></td>
						<td class="bold">Birth Day No</td>
						<td><?php echo $nm->dob_id; ?></td>
					</tr>
									
					<tr>
						<td class="bold">Place Of Birth</td>		
						<td><?php echo $nm->pob; ?></td>
						<td class="bold">Previus School</td>
						<td><?php echo $nm->pbs; ?></td>
					</tr>
									
					<tr>
						<td class="bold">Local Gardian</td>			
						<td><?php echo $nm->local_guardian; ?></td>
						<td class="bold">Shift</td>
						<td><?php echo $sft->shift_N;  ?></td>
					</tr>
					
					<tr>
						<td class="bold">Session</td>
						<td><?php echo $spro->syear; ?></td>
						<td class="bold">Admission Date</td>
						<td><?php echo date('d-m-Y',strtotime($nm->e_date)) ; ?></td>
					</tr>
					
					<tr>
						<td class="bold">Email</td>
						<td><?php echo $nm->email; ?></td>
						<td class="bold">Phone</td>
						<td><?php echo $nm->Phone_n; ?></td>
					</tr>
						
					<tr>
						<td class="bold">Father's Name</td>
						<td><?php echo $nm->fName; ?></td>
						<td class="bold">Mother's Name</td>
						<td><?php echo $nm->mName; ?></td>
					</tr>
					
					<tr>
						<td class="bold">Gender</td>
						<td><?php echo $nm->gender; ?></td>
						<td class="bold">Rilegion</td>
						<td><?php echo $nm->religion; ?></td>
					</tr>
					
					<tr>
						<td class="bold">city</td>
						<td><?php echo $nm->city; ?></td>
						<td class="bold">Blood Group</td>
						<td><?php echo $nm->blood_grou; ?></td>
					</tr>
									
					<tr>
						<td class="bold">Parmanent Address</td>
						<td><?php echo $nm->par_address; ?></td>
						<td class="bold">Present Address</td>
						<td><?php echo $nm->pre_address; ?></td>
					</tr>
									
					<tr>
						<td class="bold">GPA</td>
						<td colspan="3"><?php echo $nm->gpa; ?></td>
					</tr>
									
				</tbody>
			</table>
		</div>
							<!-- <div  class="col-md-4">
								<img src="admin/img/student_section/registration_form/<?php echo $nm->picture ?>" class="img-responsive img-thumbnail" height="150" width="150" style="margin-top:10%;" />
							</div> -->

			<?php endif; ?>
				</div>
			</div>
		</div><!-- Welcome Massage End-->
	</div>
</div>