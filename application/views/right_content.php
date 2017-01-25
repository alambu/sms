<!-- all query are here -->
<?php
	$syl=$this->db->select("*")->from("syllabus")->group_by("classs")->order_by("id","desc")->get()->result();
	$ntc=$this->db->select("*")->from("notice")->order_by("id","desc")->limit(15)->get()->result();
	// total teacher
	//$ttype=$this->db->select("*")->from("emp_type")->where("type","teacher")->get()->row();
	$where=array('emptypeid'=>1,'status'=>1);
	$tteach=$this->db->select("*")->from("empee")->where($where)->get()->result();
	// get today attendance
	$td=date("Y-m-d");
	$ta=$this->db->select("*")->from("emp_attendance")->where("atendate",$td)->get()->row();
	if(count($ta)):
	$today=explode(",", $ta->empid);
	endif;
	$presentT=0;
	foreach($tteach as $tt):
		if(count($ta)):if(in_array($tt,$today)):$presentT++;endif;endif;
	endforeach;

	// student
	// total student
	$tstd=$this->db->select("*")->from("regis_tbl")->get()->result();
	// get today attendance
	//$td=date("Y-m-d");
	$tas=$this->db->select("*")->from("attendance")->where("date",$td)->get()->row();
	if(count($tas)):
	$todayS=explode(",", $tas->stu_id);
	endif;
	$presentS=0;
	foreach($tstd as $ts):
		if(count($tas)):if(in_array($ts,$todayS)):$presentS++;endif;endif;
	endforeach;
?>
<!-- all query are here end -->
<style type="text/css">
	#attend{
		list-style: none !important;
		margin-left: 10%;margin-top: 0px !important;margin-bottom: 0px !important;
	}
</style>
<!---This is right content strat-->
<div class="col-md-3 right_con"><!-- Right Content Start--> 
	<div class="panel panel-primary"><!-- attendance Start-->
			<div class="panel-heading" style="background-color:#004884;"><!--<i class="fa fa-download">--> Today's Attendance</div>
			<div class="panel-body">
				<ul class="nav nav-tabs">
				  <li class="active"><a data-toggle="tab" href="#home"><b>Student</b></a></li>
				  <li><a data-toggle="tab" href="#menu1"><b>Teacher</b></a></li>
				</ul>

				<div class="tab-content">
				  <div id="home" class="tab-pane fade in active">
						<li id="attend">Total : <?php echo count($tstd) ?></li>
						<li id="attend">Present : <?php echo $presentS; ?></li>
						<li id="attend">Absance : <?php echo count($tstd)-$presentS ?></li>
				  </div>
				  <div id="menu1" class="tab-pane fade">
						<li id="attend">Total : <?php echo count($tteach) ?></li>
						<li id="attend">Present : <?php echo $presentT; ?></li>
						<li id="attend">Absance : <?php echo count($tteach)-$presentT ?></li>
				  </div>
				</div>
			</div>
		</div><!-- attendance End-->
	<div class="panel panel-primary" style="height: 215px"> <!-- Notice Board Start-->   
		<div class="panel-heading" style="background:#004884" ><!--<i class="fa fa-spinner fa-spin"></i> &nbsp-->&nbsp;NOTICE BOARD</div> 
			<div class="panel-body" >    
				<marquee style="text-align: center;height: 153px;" behavior="scroll" direction="up" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()">	
					<?php foreach($ntc as $n): ?>
						<p style="text-align:left;border-bottom:1px solid #d0d0d0;">
							<span style='font-style:bold;'><b style="color:#777;"><?php echo $n->title ?></b>
							</span><br/>
							<span style='color:gray;'>Post Date <?php echo $n->notice_date ?></span><br/>
							<a href="index.php/home/readNotice?n=<?php echo $n->pdf_details ?>">Read</a>&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;
							<a href="index.php/home/dwnlFl?d=<?php echo $n->pdf_details ?>&t=n">Download</a> 
						</p>
					<?php endforeach; ?>
					<a href="index.php/home/allNotice">More Notice...</a> 
				</marquee>
			</div>
		</div><!-- Notice Board End--> 
		<div class="panel panel-primary"><!-- Form Download Start-->
			<div class="panel-heading" style="background-color:#004884;"><!--<i class="fa fa-download">--> Syllabus DOWNLOAD</div>
			<div class="panel-body">
				<p>
					<?php foreach($syl as $s): ?>
					<i class="glyphicon glyphicon-file" style="color:#789;"></i>
						<a href="index.php/home/dwnlFl?d=<?php echo $s->pdf_details ?>&t=s"><?php echo $s->title ?></a><br/>
					<?php endforeach; ?>
				</p>
			</div>
		</div><!-- Form Download End-->
		<div class="panel panel-primary"><!-- IMPORTANT Link Start-->
			<div class="panel-heading" style="background-color:#004884;"><!--<i class="fa fa-link"></i>--> &nbsp; IMPORTANT LINK</div>
				<div class="panel-body">
				<marquee style="height:153px;" behavior="scroll" direction="up" scrollamount="2" onmouseover="this.stop()" onmouseout="this.start()">	
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.dhakaeducationboard.gov.bd/" target="black">Dhaka Board</a>
					</span><br/>
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.nu.edu.bd/" target="black">National University</a>            
					</span><br/>
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.educationboard.gov.bd/" target="black">Ministry of Education</a>
					</span><br/>
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.dshe.gov.bd/" target="black">Directorate Of Secondary and Higher Education</a>            
					</span><br/>
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.dpe.gov.bd/" target="black">Directorate Of Primary Education</a>
					</span><br/>
					<span>
						<i class="fa fa-link"></i> &nbsp;
							<a href="http://www.bteb.gov.bd/" target="black">Technical Education Board</a>            
					</span>
					</marquee>
				</div>
		</div><!-- IMPORTANT Link End-->
			
		</div><!-- Right Content End--> 
	</div>
</div><!--Content End-->
