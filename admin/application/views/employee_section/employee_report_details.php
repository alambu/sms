<html>
	<head>
	<base href="<?php echo base_url()?>"></base>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>
		 <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
	</head>
	<body>
	
<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.bold{
			font-weight:bold;
			font-size:17px;
		}
	</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">
 
	function imge_upload(img_val){
		if(img_val==''){
			document.getElementById("img_div").style.display = "none";
		}
		else{
			document.getElementById("img_div").style.display = "block";
		$("#img_id").attr('src',URL.createObjectURL(event.target.files[0]));
		}
	}

	
</script>

<?php 

if(isset($_GET['id'])){
	extract($_GET);
 $details=$this->db->select("*") 
             ->from ("empee")
            ->where(id,"$id")
			->get()
			->result();
}

?>
                <section class="content-header">
                   <center> <h3>
                      Employee Details
                    </h3>
					</center>
                    <ol class="breadcrumb">
                       
                    </ol>
                </section>
				
                <!-- Main content -->
                <section class="content">
					<div class="container-fluid">
					
                    <div class="row">
                      <div class="col-md-12">
                                
                                    <table id="example1" class="table table-striped table-bordered table-hover" style="height:100%;width:100%;">
							
							
								<?php 
								
								foreach($details as $value){
									
									?>
								<tbody>
									<tr>
											<td class="bold"   colspan="4"><img src="img/employee_image/<?php echo $value->picture; ?>" class="img-thumbnail" style="height:150px; width:150px;"   align="center" />
											</td>
											
									</tr>
								
								
									<tr>
										<td class="bold">Employee Id</td>
										<td><?php echo $value->empid; ?></td>
										<td class="bold">National Id</td>
										<td><?php echo  $value-> nid;?></td>
									</tr>
									
									<tr>
										<td class="bold"> Name</td>
										<td><?php echo $value->name;?></td>
										<td class="bold">Nick Name</td>
										<td><?php echo $value->nickN; ?></td>
									</tr>
									
									<tr>
									    <td class="bold">Father Name</td>
										<td><?php echo $value->fname; ?></td>
										<td class="bold">Mother Name</td>
										<td><?php echo $value->mname;?></td>
										
									</tr>
									
									<tr>
										<td class="bold">Birth Date</td>
										<td><?php echo  date("d-m-Y",strtotime ($value->dob) );?></td>
										
										<td class="bold">Join Date</td>
										<td><?php echo  date("d-m-Y",strtotime ($value->join_date) );?></td>
										
									</tr>
									
									<tr>
									    <td class="bold">Religion</td>
										<td><?php echo $value-> religion; ?></td>
										<td class="bold">Gender</td>
										<td><?php echo  $value-> gender;?></td>
										
									</tr>
									
									<tr>  
									    <td class="bold">Mobile No</td>
										<td><?php echo $value-> phone; ?></td>
										<td class="bold">Employee Type</td>
										<td>           
										<?php 		
										$type=array("1"=>"<span class='label label-info'>Teacher</span>","2"=>"<span class='label label-primary'>Stuff</span>");
										echo $type[$value->emptypeid];
										?>
									
										</td>
										
									</tr>
									
									<tr> 
									
									    <td class="bold">Subject</td>
										<td>
										<?php  
										$subj=$value->subject;	
										echo $this->db->query("select sub_name from subject_setup where subsetid='$subj'")->row()->sub_name;
										
										?>
										</td>
										
										
										<td class="bold">Alternate Phone</td>
										<td>
										<?php echo $value->alt_phone;?>
										</td>

										
									</tr>
										
									
									<tr> 
										<td class="bold">Designation</td>
										<td>
										<?php
										$desig=$value->deginition;
										echo $this->db->query("select emp_type from employee_catg where ecatgid='$desig ' ")->row()->emp_type;
										?>
										</td>
											<td class="bold">Blood Group</td>
											<td><?php echo  $value->blood;?></td>
											
									</tr>
									<tr>
									
									    <td class="bold">Permanent Address</td>
										<td><?php echo $value-> par_address; ?></td>
										<td class="bold">Present Address</td>
										<td><?php echo  $value-> pre_address;?></td>
										
									</tr>
									<tr>
										<td class="bold">Educational Qualification</td>
										<td colspan="3"><?php echo $value->edu_q; ?></td>
										    
									</tr>
									
									
									
										
								<?php } ?>
								</tbody>
								
							</table>
							<center>
							<button type="button" class="btn btn-danger" onclick="window.close();"> Close</button>
							</center>
						</div>

                    </div>
					

			</div>
		</section><!-- /.content -->
	</aside><!-- /.right-side -->     <!---rightbar close here ---->
	</body>
</html>