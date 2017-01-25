<!DOCTYPE html>
<html>
	    <head>
			<base href="<?php echo base_url(); ?>"></base>
	
	
	<style>
	@media print{
		@page { size: landscape; }
		
		table{
			width:800px;
			margin:0px auto;
			
			
		}
		table tr td table tr td  {
			background:red;
		}
		.btn-success{
			display:none !important;
		}
		.btn-danger{
			display:none !important;
		}
	}
	table{
		width:95%;
		margin:0px auto;
	}
	</style>
	
	<meta charset="UTF-8"/>
	  
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<script type="text/javascript" language="javascript" src="all/assets/js/datatable.min.js"></script>
		<script type="text/javascript" language="javascript" src="all/assets/js/bootstrap.js"></script>
		<script type="text/javascript" language="javascript" src="all/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" language="javascript" src="all/assets/js/jquery.min.js"></script>
		<script type="text/javascript" language="javascript" src="all/assets/js/update_jquery.min.js"></script>
        <!-- bootstrap 3.0.2 -->
        <link href="all/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="all/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="all/assets/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="all/assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="all/assets/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
			
</head>
<body>
						<?php 
							if(isset($_GET['classid'])){
								 $shift=$_GET['shift'];
								 $section=$_GET['section'];
								 $class_name=$_GET['classid'];
								
								$max_cls=$this->db->query("select  maxclass from   class_period where classid='$class_name'")->row()->maxclass;
								
								$subject=$this->db->query("select * from subject_class where classid='$class_name'")->result();
								
								$tea_id=$this->db->query("select emptypeid from emp_type where type='Teacher'")->row()->emptypeid;
								
								$teacher=$this->db->query("select * from empee where emptypeid='$tea_id'")->result();
								
						?>


						
						<div class="row">
						<div class="col-md-12">
						
						   <div class="box" style="border:1px;">
                               <p style="padding-top:10px;"> <h1><center>Class Routine</center></h1> </p>
							   <p style="text-align:center;padding-left:20px;line-height:9px;"><b>Class:</b>    <?php echo $this->db->query("select class_name from class_catg where classid='$class_name'")->row()->class_name; ?></p>
							   <p style="text-align:center;padding-left:20px;line-height:9px;"><b>Section:</b>   <?php echo $section; ?></p>
							   <p style="text-align:center;padding-left:20px;line-height:9px;"><b>Shift:</b>    <?php echo $this->db->query("select shift_N from shift_catg where shiftid='$shift'")->row()->shift_N; ?></p>
								
							
						<table  class="table-bordered table-striped table-responsive">
							<thead>
							<tr>
								<td style="font-size:20px;font-weight:bold;text-align:center;">Day</td>
								<?php 
									$shidiul=$this->db->query("select * from routine where day='Satarday' and classid='$class_name' and section='$section' and  shiftid='$shift'")->result();
									$j=1;
									$total=count($shidiul);
									for($i=0;$i<$total;$i++){
									?>
									
								<td>
								<table>
								<tr>
										<td><?php echo date('h:i:A',strtotime($shidiul[$i]->stime));?></td>
										<td><span class="glyphicon glyphicon-minus"></span></td>
										<td><?php echo date('h:i:A',strtotime($shidiul[$i]->etime)); ?></td>
									
								</tr>
								</table>	
								</td>
									<?php 
										if(($j)<=($total-1)){
										$cet=date("h:i:A",strtotime($shidiul[$i]->etime));
										$cst=date("h:i:A",strtotime($shidiul[$i+1]->stime));
										
										if($cet===$cst){
											//echo "soman";
										}
										else {
										?> <td><b style="font-size:20px;color:green;">Break</b></td> <?php //echo "<center>"."Break Time: &nbsp;&nbsp;".$cet."&nbsp;&nbsp; <b>To</b> &nbsp;&nbsp;".$cst."</center>";
											
										}
										}
										?>
							<?php $j++; } ?>
							</tr>
							</thead>
							<tbody>
							 <?php
							
							$array=array("Satarday","Sunday","Monday","Tuesday","Wednesday","Thuasday","Friday");
							
							foreach($array as $day) {
							?>
						 
								<tr>
									
									<td style="font-weight:bold;text-align:center;">
										<?php echo $day; ?>
									</td>
								<?php 
										$tim=$this->db->query("select * from routine where day='$day' and shiftid='$shift' and section='$section' and classid='$class_name'");
										$row=$tim->num_rows();
										$time=$tim->result();
										$total=count($time);
										$i=0;$j=1;
										for($i;$i<$total;$i++){
											$sub=$time[$i]->subjid;
											$teach=$time[$i]->teacherid;
								?>		
									<td style="text-align:center;">
										
										<?php 
										echo "<b>";
										echo $this->db->query("select sub_name from subject_class where subjid='$sub'")->row()->sub_name;
										echo "</b>";
										echo "</br>";
										echo $this->db->query("select name from empee where empid='$teach'")->row()->name."(".$teach.")";
										
										?>
										
									</td>
									 <?php
									if(($j)<=($total-1)){
											$cet=date("h:i:A",strtotime($time[$i]->etime));
											$cst=date("h:i:A",strtotime($time[$i+1]->stime));
											
											if($cet===$cst){
												//echo "soman";
											}
											else {
												echo "<td rowspan=''></td>";
											//echo "<center>"."Break Time: &nbsp;&nbsp;".$cet."&nbsp;&nbsp; <b>To</b> &nbsp;&nbsp;".$cst."</center>";
												
											}
											}
										 $j++;
										 } 
									
									 ?>
									
								</tr>
							<?php  } ?>
							</tbody>
							
								  </table>
									<table  style="margin:10px auto;">
										<tr>
											<td>Md.Mohammad Alam</td>
											<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Md.Mobarok Hossain</td>
										</tr>
										<tr>
											<td style="font-weight:bold;"><u><i>Principal</i></u></td>
											<td style="font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><i>Created By</i></u></td>
										</tr>
									</table>
										
					  </div>
					   
					  <p>
						<center>
								
								<button class="btn btn-success" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print</button>
								&nbsp;&nbsp;
								<button class="btn btn-danger" onclick="window.close();"><span class="glyphicon glyphicon-remove"></span> Close</button>
						</center>
				  
					  </p>
					  </div>
					  </div>
					 
					  <?php } ?>
</body>
</html>					  