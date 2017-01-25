<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.bold{
			font-weight:bold;
			font-size:17px;
		}
	</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">



  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=270,width=550,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

  
</script>
<?php 
if(isset($_GET['id'])){
	$stu_id=$_GET['id'];
	$class_name=$_GET['class_name'];
	$roll_no=$_GET['roll_no'];
	$section=$_GET['section'];
	$session=$_GET['session'];
	
	$select=$this->db->query("select * from regis_tbl where stu_id='$stu_id'")->row();
	$shiftn=$this->db->query("select sft.shift_N,re.stu_id from shift_catg sft,re_admission re where re.stu_id='$stu_id' and re.shiftid=sft.shiftid order by re.readid desc limit 1")->row()->shift_N;
	//echo $select->picture;
	
}
?>
                <section class="content-header">
                    <h1>
                       Student Details
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					
                    <div class="row">
                      <div class="col-md-11">
					    <div class="panel-body">
                                <div class="table-responsive" >
                                    <table id="example1" class="table table-striped table-bordered table-hover" style="height:100%;">
								
								<thead>
									<tr>
										<th colspan="3"><center><h1 style="padding-top:-100px;v-align:top;">Student Information</h1></center></th>
										<th>
											<center><img class="img-thumbnail" src="img/student_section/registration_form/<?php echo $select->picture; ?>" style="height:110px;width:120px;"/></center>
										</th>
									</tr>
								</thead>	
								
								<tbody>
									<tr>
										<td class="bold">Student ID</td>
										<td><?php echo $select->stu_id; ?></td>
										<td class="bold">Student Name</td>
										<td><?php echo $select->name;?></td>
										
									</tr>
									
									<tr>
										<td class="bold">Father Name</td>
										<td><?php echo $select->fName; ?></td>
										<td class="bold">Mother Name</td>
										<td><?php echo $select->mName;?></td>
										
									</tr>
									
									<tr>
										<td class="bold">Father Occopation</td>
										<td><?php echo $select->foccupation; ?></td>
										<td class="bold">Mother's Occopation</td>
										<td><?php echo $select->moccupation;?></td>
										
									</tr>
									
									<tr>
										<td class="bold">Class</td>									
										<td><?php echo $this->db->select("class_name")->from("class_catg")->where("classid",$class_name)->get()->row()->class_name; ?></td>
										<td class="bold">Section</td>
										<td><?php echo $this->db->select("section_name")->from("section_tbl")->where("sectionid",$section)->get()->row()->section_name; ?></td>
									</tr>
									<tr>
										<td class="bold">Date Of Birth</td>									
										<td><?php echo $select->dob; ?></td>
										<td class="bold">Birth Day No</td>
										<td><?php echo $select->dob_id; ?></td>
									</tr>
									
									<tr>
										<td class="bold">Place Of Birth</td>									
										<td><?php echo $select->pob; ?></td>
										<td class="bold">Previus School</td>
										<td><?php echo $select->pbs; ?></td>
									</tr>
									
									<tr>
										<td class="bold">Local Gardian</td>									
										<td><?php echo $select->local_guardian; ?></td>
										<td class="bold">Shift</td>
										<td><?php echo $shiftn;  ?></td>
									</tr>
									<tr>
										
										<td class="bold">Session</td>
										<td><?php echo $session; ?></td>
										<td class="bold">Admission Date</td>
										<td><?php echo date('d-m-Y',strtotime($select->e_date)) ; ?></td>
										
									</tr>
									<tr>
										
										<td class="bold">Email</td>
										<td><?php echo $select->email; ?></td>
										<td class="bold">Phone</td>
										<td><?php echo $select->Phone_n; ?></td>
										
									</tr>
									<tr>
										
										<td class="bold">Father's Name</td>
										<td><?php echo $select->fName; ?></td>
										<td class="bold">Mother's Name</td>
										<td><?php echo $select->mName; ?></td>
										
									</tr>
									<tr>
										
										<td class="bold">Gender</td>
										<td><?php echo $select->gender; ?></td>
										<td class="bold">Rilegion</td>
										<td><?php echo $select->religion; ?></td>
										
									</tr>
									<tr>
										
										<td class="bold">city</td>
										<td><?php echo $select->city; ?></td>
										<td class="bold">Blood Group</td>
										<td><?php echo $select->blood_grou; ?></td>
										
									</tr>
									
									<tr>
										
										<td class="bold">Parmanent Address</td>
										<td><?php echo $select->par_address; ?></td>
										<td class="bold">Present Address</td>
										<td><?php echo $select->pre_address; ?></td>
										
									</tr>
									
									<tr>
										
										<td class="bold">GPA</td>
										<td colspan="3"><?php echo $select->gpa; ?></td>
										
										
									</tr>
									
									
								</tbody>
								<tfoot>
								   
								</tfoot>
							</table>
							<center>
							<button type="button" class="btn btn-danger" onclick="window.close();"> Close</button>
							</center>
						</div>
						</div>
					  </div>
					 <div class="col-md-1">
					 
					 </div>
                    </div>
					

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			