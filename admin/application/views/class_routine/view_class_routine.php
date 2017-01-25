<!DOCTYPE html>
<html>
	    <head>
			<base href="<?php echo base_url(); ?>"></base>
		<?php 
		extract($_GET);
		$group=$this->bsetting->ge_section($sec)->groupid;
		$where1=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec,'day'=>1);
		$time_shidule=$this->routine->class_routine($where1);
		?>
	
	<style>
	<?php if(count($time_shidule)>6) { ?>
	@media print {
		@page { size: landscape; }
		
		table {
			width:550px !important;
			margin:0px auto;
			border:1px solid black !important;
			
		}
		table tr td {
			margin:0px !important;
			padding:0px !important;
			font-size:13px;
			
		}
		
		.btn-success {
			display:none !important;
		}
		.btn-danger {
			display:none !important;
		}
		.btn-primary {
			display:none !important;
		}
	}
	<?php } else { ?>
	
	@media print {
		@page { size: landscape; }
		
		table {
			width:700px;
			margin:0px auto;
			border:1px solid black !important;
			
		}
		
		.btn-success {
			display:none !important;
		}
		.btn-danger {
			display:none !important;
		}
		.btn-primary {
			display:none !important;
		}
	}	
		
	<?php } ?>
	.border_css { min-height:500px; }
	
	.t_css 
	{
	min-height:500px;
	margin:10px auto;
	width:550px;
	}
	</style>
	
		<meta charset="UTF-8"/>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
       
		<link href="css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
		<link href="css/bootstrap-datepicker.min.css" rel="stylesheet"/>
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
			
</head>
<body>
						<?php
						$days=array('1'=>'Satarday','2'=>'Sunday','3'=>'Monday','4'=>'Tuesday','5'=>'Wednsday','6'=>'Thusday','7'=>'Friday');
						
						if(count($time_shidule)>6)
						{
							$css_class='t_css';
							$tname="nickN";
							$sname="short_name";
						}
						else 
						{
							$css_class='table table-condensed table-striped table-bordered table-responsive border_css';
							$tname="name";
							$sname="sub_name";
						}
						//exit;
						?>


						</br>
						<div class="row" style="margin:5px 5px;">
							<div class="col-md-12">
									<?php 
									
									if($group=='') 
									{
									?>
									<table id="routine_tbl" class="<?php echo $css_class; ?>" border="1" nowrap="0">
										<tr>
											<td style="text-align:center;" colspan="<?php echo count($time_shidule)+1; ?>">
												Year:<?php echo $year; ?></br>
												Shift:<?php echo $this->routine->get_shift_name($sft)->shift_N; ?></br>
												Class:<?php echo $this->bsetting->get_class_name($cls)->class_name; ?></br>
												Section:<?php echo $this->bsetting->ge_section($sec)->section_name; ?></br>
											</td>
										</tr>
										<tr>
											<td style="text-align:center;font-weight:bold;">Day</td>
											<?php 
											foreach($time_shidule as $value) { 
											$w=array('shidule_id'=>$value->shidule_id);
											$shidule_info=$this->routine->shidule_info($w);
											?>
											<td style="text-align:center;font-weight:bold;">
												<?php echo date("g:i:A",strtotime($shidule_info->stime)).'<b>-</b>'.date("g:i:A",strtotime($shidule_info->etime));?> 
											</td>
											<?php } ?>
										</tr>
										<?php 
										foreach($days as $dkey=>$dvalue)
										{
										?>	
									    <tr>
									    <td style="text-align:center;font-weight:bold;"><?php echo $dvalue; ?></td>
										
										<?php 	
											$where=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec,'day'=>$dkey);
											$routine=$this->routine->class_routine($where);
											
											foreach($routine as $rvalue)
											{
											$w=array('shidule_id'=>$rvalue->shidule_id);	
											$teacher=$this->routine->teacher_info($rvalue->teacherid);	
											$subject=$this->routine->subject_info($rvalue->subjid);	
											$break=$this->routine->shidule_info($w)->period_title;	
											?>
											<td <?php if($break==0) { echo ""; }  ?> style="text-align:center;">
											
											  <?php 
											  
											  if($break>0) 
											  {
												if($subject->$sname=='' ||  $teacher->$tname=='')
												{
												echo "<span class='glyphicon glyphicon-minus'></span>";
												}
												else 
												{
												echo $subject->$sname."</br>".$teacher->$tname;
												}
											  } 
											  else 
											  {
												echo "<span class=''><b>Break</b></span>";	  
											  }
												?>
											
											</td>
											<?php 
											}
											?>
										</tr>
										<?php
										}
										?>
									</table>
									<?php
									}
									
									else 
									{	
									?>
									
									<table class="<?php echo $css_class; ?>" border="1" nowrap="0">
									
										<tr>
											<td style="text-align:center;" colspan="<?php echo count($time_shidule)+1; ?>">
												Year:<?php echo $year; ?></br>
												Shift:<?php echo $this->routine->get_shift_name($sft)->shift_N; ?></br>
												Class:<?php echo $this->bsetting->get_class_name($cls)->class_name; ?></br>
												Section:<?php echo $this->bsetting->ge_section($sec)->section_name; ?></br>
											</td>
										</tr>
										
										<tr>
											<td style="text-align:center;font-weight:bold;">Day</td>
											<?php 
											foreach($time_shidule as $value) { 
											$w=array('shidule_id'=>$value->shidule_id);
											$shidule_info=$this->routine->shidule_info($w);
											?>
											<td style="text-align:center;font-weight:bold;">
												<?php echo date("g:i:A",strtotime($shidule_info->stime)).'<b>-</b>'.date("g:i:A",strtotime($shidule_info->etime));?> 
											</td>
											<?php } ?>
										</tr>
										<?php 
										foreach($days as $dkey=>$dvalue)
										{
										?>	
									    <tr>
									    <td style="text-align:center;font-weight:bold;"><?php echo $dvalue; ?></td>
										
										<?php 	
											$where=array('year'=>$year,'shiftid'=>$sft,'classid'=>$cls,'section'=>$sec,'day'=>$dkey);
											$routine=$this->routine->class_routine($where);
											
											if(count($routine)==0)
											{
												foreach($time_shidule as $value) { echo "<td><span glyphicon glyphicon-minus></span></td>"; }
											}
											
											foreach($routine as $rvalue)
											{	
											$w=array('shidule_id'=>$rvalue->shidule_id);
											
											$break=$this->routine->shidule_info($w)->period_title;	
											?>
											<td <?php if($break==0) { echo ""; }  ?> style="text-align:center;">
											
											  <?php 
											  
											  if($break>0) 
											  {
												//combine class start
												if($rvalue->groupid=='') {	
													
												$teacher=$this->routine->teacher_info($rvalue->teacherid);	
												$subject=$this->routine->subject_info($rvalue->subjid);
												
												if($subject->$sname=='' ||  $teacher->$tname=='')
												{
												echo "<span class='glyphicon glyphicon-minus'></span>";
												}
												
												else 
												{
												echo $subject->$sname."</br>".$teacher->$tname;
												}
												
												}
												//combine class end
												
												//group class start
												else {
													
												$ex_grp=explode(",",$rvalue->groupid);
												$ex_tech=explode(",",$rvalue->teacherid);
												$ex_sub=explode(",",$rvalue->subjid);
												echo "
												<table class='table table-bordered table-condensed'>
												<tr>
													<th>Group</th>
													<th>Subject</th>
													<th>Teacher</th>
												</tr>
												";
												foreach($ex_grp as $gkey=>$gpval) 
												{ 
												$teacher=$this->routine->teacher_info($ex_tech[$gkey]);	
												$subject=$this->routine->subject_info($ex_sub[$gkey]);
												if($subject->$sname=='' ||  $teacher->$tname=='')
												{
												echo "<span class='glyphicon glyphicon-minus'></span>";
												}
												
												else 
												{
												?>
													<tr>
														<td><?php echo $this->bsetting->selected_group($gpval)->group_name; ?></td>
														<td><?php echo $subject->$sname; ?></td>
														<td><?php echo $teacher->$tname; ?></td>
													</tr>
												<?php 
												}
												
												}
												echo "</table>";
											    }
												
												//group class end
												
											  } 
											  else 
											  {
												echo "<span class=''><b>Break</b></span>";	  
											  }
												?>
											
											</td>
											<?php 
											}
											?>
										</tr>
										<?php
										}
										?>
									</table>
									
									<?php 
									}
									?>
								
							</div>
						</div>
						
					 <div class="row">
						<div class="col-md-12">
							<center><button type="button" onclick="window.print()" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></button> &nbsp; &nbsp; <button type="button" onclick="window.close()" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></center>
						</div>
					 </div>
</body>
</html>					  