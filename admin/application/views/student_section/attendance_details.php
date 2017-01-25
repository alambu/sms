<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
<style>
.bold{
font-weight:bold;
font-size:17px;
}
.badge.badge-success {
background-color: #00a651;
color: #ffffff;
}
.badge.badge-danger{
background-color: #cc2424;
color: #ffffff;
}
</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">



  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=270,width=550,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

 

$(document).ready(function(){
 $('#sms_form').submit(function() {
	 document.getElementById('class_submit').innerHTML = 'Sending----';
	 document.getElementById('class_submit').disabled = 'disabled';
		$.post(
            "index.php/student_section/send_sms",
            $("#sms_form").serialize(),
            function(data){	
              if(data==1)
			  {
				alert('Send Successfully');
				document.getElementById('class_submit').disabled = false;
			  }	
			  else 
			  {  
				  alert(data);
				  document.getElementById('class_submit').disabled = false;
			  }
			  document.getElementById('class_submit').innerHTML = '<span class="glyphicon glyphicon-send"></span> send';
		});
 return false;
 });
});	
 
</script>

<?php
if(isset($_GET['typ'])){
	extract($_GET);
if($typ=='today'){
	$sft_N=$this->db->select("shift_N")->from("shift_catg")->where("shiftid",$sft)->get()->row()->shift_N;
	$sec_name=$this->bsetting->ge_section($sec)->section_name;
	$cls_N=$this->db->select("class_name")->from("class_catg")->where("classid",$cls)->get()->row()->class_name;
	
	$ex_d=explode("-",$d);
									
	$where1=array(
	'syear'=>$ex_d[0],
	'classid'=>$cls,
	'section'=>$sec,
	'shiftid'=>$sft,
	'status'=>1
	);
	
	$where=array(
	'classid'=>$cls,
	'section'=>$sec,
	'shiftid'=>$sft,
	'date'=>$d
	);
}
elseif($typ=='month_sec'){
	extract($_GET);
	$like=$d."-".$m;
	$shift=$this->db->query("select shift_N from shift_catg where shiftid='$sft'")->row()->shift_N;
	$class=$this->db->query("select class_name from class_catg where classid='$cls'")->row()->class_name;
	$total_student=$this->db->query("select count(readid) as total from re_admission where syear='$d' and shiftid='$sft' and classid='$cls' and section='$sec' ")->row()->total;
	$attendence=$this->db->query("select * from attendance where shiftid='$sft' and classid='$cls' and section='$sec' and date like '$like%'");
	
	$total_days=$this->db->affected_rows();
	
}
elseif($typ=='month_stu'){
	extract($_GET);
	$stu_info=$this->db->query("select a.*,b.* from regis_tbl a ,re_admission b where a.stu_id='$stu' and b.stu_id='$stu' and b.syear='$d'")->row();
	$like=$d."-".$m;
	$attendence=$this->db->query("select * from attendance where shiftid='$sft' and classid='$cls' and section='$sec' and date like '$like%'");
	$total_days=$this->db->query("select count(id) as total from attendance where shiftid='$sft' and classid='$cls' and section='$sec' and date like '$like%'")->row()->total;
	
}
}
?>
                <section class="content-header">
                    <h1>
                       Daily Attendance Report
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
					<?php 
					$month=array('January'=>'01','February'=>'02','March'=>'03','April'=>'04','May'=>'05','June'=>'06','July'=>'07','August'=>'08','September'=>'09','October'=>'10','November'=>'11','December'=>'12');
					?>
                    <div class="row">
                      <div class="col-md-11">
					    <div class="box">
						<div class="box-header">
						   <center>
						   <?php if($typ=='today'){ ?>
							<h3><b>Shift:</b> <?php echo $sft_N; ?></h3>
							<h4><b>Class Name:</b> <?php echo $cls_N; ?></h4>
							<h5><b>Section:</b> <?php echo $sec_name; ?></h5>
							<h5><b>Date:</b> <?php echo date("d-m-Y",strtotime($d)); ?></h5>
							<h5><b>Recived By:</b> <?php echo "Admin"; ?></h5>
							
							<?php } elseif($typ=='month_stu'){ ?>
							
							<h3><b>Session:</b> <?php echo $d; ?></h3>
							<h4><b>Month:</b> <?php foreach($month as $key=>$mv){ if($mv==$m){ echo $key; } } ?></h4>
							<h5><b>Total Attendance Days:</b> <?php echo $total_days; ?></h5>
							
							<?php } elseif($typ=='month_sec') {
							?>
							
							<h3><b>Session:</b> <?php echo $d; ?></h3>
							<h4><b>Month:</b> <?php foreach($month as $key=>$mv){ if($mv==$m){ echo $key; } } ?></h4>
							<h5><b>Shift:</b> <?php echo $shift; ?>&nbsp;<b>Class Name:</b> <?php echo $class; ?>&nbsp;<b>Section:</b> <?php echo $sec_name; ?></h5>
							<h5><b>Total Attendance Days:</b> <?php echo $total_days; ?></h5>
							<h5><b>Total Student:</b> <?php echo $total_student; ?></h5>
							
							<?php 
							} ?>
							</center>
						</div>
					    <div class="box-body">
                                <div class="table-responsive">
								<?php if($typ=='today'){ ?>
                                    <table id="example1" class="table table-hover" style="height:100%;">
								
								<thead>
									<tr>
										<th>Student ID</th>
										<th>Name</th>
										<th>Roll No</th>
										<th>Picture</th>
										<th>Attendance</th>
										<th>Action</th>
									</tr>
								</thead>	
								
								<tbody>
									<?php
									
									$al_student=$this->db->select("*")->from("re_admission")->where($where1)->get()->result();
									
									
									$select=$this->db->select("*")->from("attendance")->where($where)->get()->row();
									
									$present=explode(",",$select->stu_id);
									//print_r($present);
									$i=0;
									foreach($al_student as $value){
										
										
									?>
									
									<tr>
										<td><?php echo $value->stu_id; ?></td>
										<td><?php echo $this->db->select("name")->from("regis_tbl")->where("stu_id",$value->stu_id)->get()->row()->name; ?></td>
										<td><?php echo $value->roll_no;?></td>
										<td><img class="img-responsive img-thumbnail" src="img/student_section/registration_form/<?php echo $this->db->select("picture")->from("regis_tbl")->where("stu_id",$value->stu_id)->get()->row()->picture; ?>" style="height:50px;width:50px;" /></td>
										<td><?php if(in_array($value->stu_id, $present)){ echo "<span class='badge badge-success'> Present </span>"; } else { echo "<span class='badge badge-danger'> Absent </span> "; } ?></td>
										<td>
											<button type="button" value="<?php echo $value->stu_id; ?>"  class="btn btn-primary btn-sm" onclick="hid_stu.value='<?php echo $value->stu_id; ?>'" data-toggle="modal" data-target="#edit_parent"><span class="glyphicon glyphicon-envelope"></span> message</button>
										</td>
										
									</tr>
								<?php } ?>
								</tbody>
								<tfoot>
								   
								</tfoot>
							</table>
							<?php } elseif($typ=='month_stu'){
							?>
								<table id="example1" class="table table-hover" style="height:100%;">
								<thead>
									<tr>
										<th>SL.No</th>
										<th>Date</th>
										<th>Days</th>
										<th>Attendance</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach($attendence->result() as $value){ ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><span class='badge badge-success'><?php echo date("d-m-Y",strtotime($value->date)); ?></span></td>
										<td><?php echo date("D",strtotime($value->date)); ?></td>
										<?php $ex=explode(",",$value->stu_id); ?>
										
										<td>
										<?php if(in_array($stu,$ex)){
										?>
										<span class='badge badge-success'> Present </span>
										<?php 
										} else { ?>
										<span class='badge badge-danger'> Absent </span>
										<?php } ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
								</table>
							<?php 
							} elseif($typ=='month_sec') { ?>
							<table id="example1" class="table table-hover" style="height:100%;">
								
								<thead>
									<tr>
										<th>SL.No</th>
										<th>Date</th>
										<th>Days</th>
										<th>Present</th>
										<th>Absent</th>
										<th>Parsentis</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=1; foreach($attendence->result() as $value){ ?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><span class='badge badge-success'><?php echo date("d-m-Y",strtotime($value->date)); ?></span></td>
										<td><?php echo date("D",strtotime($value->date)); ?></td>
										
										<?php
											if($value->stu_id==''){
												$p=0;
											}
											else {
												$ex=explode(",",$value->stu_id);
												$p=count($ex);
											}
										?>
										<td><?php echo $p; ?></td>
										<td><?php echo $a=$total_student-$p; ?></td>
										<?php 
											$per=round(($p*100)/$total_student);
											if(($per>80)){
												$c="success";
											}
											elseif(($per>50) || ($per<80)){
												$c="info";
											}
											elseif(($per>40) || ($per<50)){
												$c="warning";
											}
											else {
												$c="danger";
											}
										?>
									
										<td>
											<div class="progress">
												<div class="progress-bar progress-bar-<?php echo $c; ?> progress-bar-striped" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%">
												 <span> <?php echo $per; ?>% Complete</span>
												</div>
											</div>
											
										</td>
										
										
									</tr>
									<?php } ?>
								</tbody>
							</table>
							<?php } ?>
							<center>
							<button type="button" class="btn btn-danger" onclick="window.close();"> Close</button>
							</center>
						</div>
						</div>
					  </div>
					  </div>
					 <div class="col-md-1">
					 
					 </div>
                    </div>
					
					<div class="modal fade" id="edit_parent" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" data-dismiss="modal" class="close">&times;</button>
							  <h4 class="modal-title">Send SMS</h4>
							</div>
							<div class="modal-body">
								<div class="row">
									<div class="col-md-12">
										<form action="student_section/send_sms" class="form-horizontal" id="sms_form">
											<div class="form-group">
												<div class="col-md-12">
													<label>Message</label>
													<textarea name="msg" class="form-control" required></textarea>
													<input type="hidden" name="hid_stu" class="form-control" id="hid_stu"/>
												</div>
												<div class="col-md-12">
													<button name="send" style="margin-top:5px;" type="submit" id="class_submit" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-send"></span> send</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
							<div class="modal-footer">
							  <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
							</div>
						  </div>
						  
						</div>
					</div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
<?php 
$this->load->view('footer');
?>			