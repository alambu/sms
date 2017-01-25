<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<style>
.cellClass {
    vertical-align:middle !important;
    height:auto;
}
</style>
<script type="text/javascript">
function ajax_request_clsid(cls_id){						
	$.ajax({
		url: "index.php/account/classsection",
		type: 'POST',	
		data:{classname:cls_id},	
		success: function(data)
		{							
			if(data.length!=0){
			var d=data.split(",");
					
			document.getElementById("sections").innerHTML="<option value=''>--Select--</option>";			
			for(var i=0;i<d.length;i++){				
				document.getElementById("sections").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
			}
			}else{
				document.getElementById("sections").innerHTML='';
				document.getElementById("sections").innerHTML='<option value="">--Select--</option>';
			}
		}          
		});
	}
</script>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Scholarship Student
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="row">
						<div class="col-sm-12">
						<form class="form-horizontal" role="form" action="index.php/account_edit/search_scholarship" method="post">
						<div class="form-group">
							<div class="col-sm-1" > </div>   													
							<div class="col-sm-2">          
							<select class="form-control" name="classname" id="classname" required onchange="ajax_request_clsid(this.value);">
									<option value="">--Select Class--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->classid?>" <?php if($classid==$accidshow->classid){echo "SELECTED";}?>><?php echo $accidshow->class_name?></option>
										<?php }?>
							</select>
						  </div>
						   
						  <div class="col-sm-2">          
							<select class="form-control" name="sections" id="sections" required>
								<?php 
								if($sectionid!=''){?>
									<?php $sec=$this->accmodone->sectionshow($classid);
										$sec_exp=explode(',',$sec);
										$tsec=count($sec_exp);
										for($i=0;$i<$tsec;$i++){										
									?>
									<option value="<?php echo $sec_exp[$i]?>" <?php if($sectionid==$sec_exp[$i]){echo "Selected";}?>><?php echo $sec_exp[$i];?></option>
										<?php ?>
								<?php }} else{?>
									<option value="">--Select Section--</option>
								<?php } ?>	
							</select>
						  </div>
						   <div class="col-sm-2">          
							<select class="form-control" name="shift" id="shift" required>
								<option value="">--Select Shift--</option>
									<?php 
										$exsqlacc=$this->db->select('*')->from('shift_catg')->get()->result();										
										foreach($exsqlacc as $exaccidshow){
									?>
										<option value="<?php echo $exaccidshow->shiftid?>" <?php if($shipid==$exaccidshow->shiftid){echo "SELECTED";}?>><?php echo $exaccidshow->shift_N?></option>
										<?php }?>
							</select>
						  </div>
						  <div class="col-sm-2">          
							<select class="form-control" name="year" id="year">
							<option value="">All</option>
								<?php $yearss=date('Y');
								$b='2010';
								for($a=$yearss;$a>=$b;$a--){
								?>
									<option value="<?php echo $a?>" <?php if($years==$a){echo "SELECTED";}?>><?php echo $a?></option>
								<?php }?>
							</select>
						  </div>								
								<div class="col-sm-2">
									<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
								</div>
						</div>
						</form>
						</div>
						
					</div>
					<hr/>
                    <div class="row">
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Student ID</th>
									<th>Student Name</th>
									<th>Class Name</th>										
									<th>Section</th>										
									<th>Roll No</th>														
									<th>Status</th>														
									<th>Year</th>														
									<th>Father Occupation</th>														
									<th>Action</th>														
																							
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){	
										//$stuname=$this->accmodone->studentname($row->stu_id);
										//$readids=$this->accmodone->readimssion($row->readid);
										//$classname=$this->accmodone->classname($readids->classid);
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $row->stu_id?></td>
									<td><?php echo $row->name?></td>
									<td><?php echo $row->class_name?></td>
									<td><?php echo $row->section?></td>
									<td><?php echo $row->roll_no?></td>									
									<td><?php $status=$row->scholarship;if($status==1){echo 'Full Fee Scholarship';}if($status==2){echo 'Half Fee Scholarship';}if($status==3){echo 'Poor Fund';}?></td>
									<td><?php echo $row->syear?></td>	
									<td><?php echo $row->foccupation?></td>	
									<td><a href="index.php/account_edit/stuedit_scholarship?sshipid=<?php echo $row->sshipid?>&stuid=<?php echo $row->stu_id?>&readidss=<?php echo $row->readid?>"><button type="button" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>  Edit</button></a>&nbsp;																		
									<button type="button" onclick="delete_data(<?php echo $row->sshipid?>)" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button></td>
								</tr>
								<?php }?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>