<?php
if((isset($_GET['id'])) || (isset($_GET['d']))){
	if(isset($_GET['id'])){
	$appid=$_GET['id'];
	}
	else if(isset($_GET['d'])){
	  $appid=$_GET['d'];
	}
	$y=date("Y");
	$stinfo=$this->db->query("select a.*,b.class_name from application_tbl a,class_catg b,application_catg c where a.appid='$appid' and a.appctgid=c.appctgid and
	c.classid=b.classid")->row();
	
	$scinfo=$this->db->query("select * from sprofile limit 1")->row();
}

 ?>
<!---<td >পাসপোর্ট নং </td>
								<td ><span>&nbsp;:&nbsp;</span></td>--------->
<script>
//window.onbeforeunload = function(){ return 'আপনি যদি পেজটি  Reload দেন তাহলে আপনাকে নতুন করে ডাটা এন্ট্রি দিতে হবে.';};
</script>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<base href="<?php echo base_url(); ?>"></base>
<style type="text/css">
	@media print{
		@page { size: A4; }
		table{
			width:800px;
			margin:0px auto;
			
		}
		body{
			background:white;
		}
	}
	
</style>
<script type="text/javascript">
document.onreadystatechange = function(){
if(document.readyState === 'complete'){
 <?php 
	if(isset($_GET['d'])){
	?>
	alert('Your Application Complete Successfully Your Applicant ID <?php  echo $_GET['d']; ?>');
    <?php 	
	}
 ?>	
 
}
}

</script>
	<meta charset="UTF-8">
	<title>আবেদন পত্র</title>
	<link rel="stylesheet" type="text/css" href="css/all_print_copy/application.css" media="all" />
	<link href="css/all_print_copy/print.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div style="left:300px;top:5px;position:middle;background:#666;" align="center" id="bar"><a  target='_blank' href="javaScript:window.print();"><img src="img/print/print.png"/></a>
</div>
<br/>
	<div class="full"> 
		<div id="wrapper" >
						<!-----------top area start--------------->
			<div class="top_area" >
				<div class="fix structure top_section">
					<div id="top_left">
						<img src="img/schoolslogo.jpg" alt="logo" style="hieght:120px;width:120px;"/>
					</div>
					<div id="top_mid">
						<h2><?php echo $scinfo->schoolN; ?></h2>
						<?php $ex=explode(",",$scinfo->address); ?>
						<p>	<?php echo $scinfo->address; ?> <br />
							ফোন : <?php echo $scinfo->phone; ?>, <?php echo  $scinfo->mobile; ?>
						</p>
					</div>
					<div id="top_right">
						<img src="img/student_section/application_form/<?php echo $stinfo->image; ?>" alt="image" />
					</div>
				</div>
			</div>
						<!-----------top area end--------------->
						
						
						<!-----------header area start--------------->
			<div class="header_area">
				<div class="fix structure header_section"> 
					<h2> ভর্তির আবেদন পত্র </h2>
					<span style="float:left;">Applicant ID:<input type="text" name="" id="" readonly value="<?php echo $_GET['d']; ?>"/></span>
					<span> আবেদনের তারিখ: <input type="text" name="" id="" readonly value="<?php echo date("d-m-Y",strtotime($stinfo->e_date)); ?>"/></span>
				</div>
			</div>
<!-----------header area end--------------->
			
<!-----------application area start--------------->
			
			<div class="app_area">
				<div class="fix structure app_section">
					<div id="app_section_right">
						<table class="table1">
							<tr>
								<td>&nbsp;Applicant Name</td>
								<td colspan="3"><span>&nbsp;<?php echo $stinfo->name; ?></span></td>
							</tr>
							
							<tr>
								<td>&nbsp;Father Name</td>
								<td colspan="3" style="border-left:none;"><span>&nbsp;<?php echo $stinfo->fName; ?></span></td>
							</tr>
							<tr>
								<td>&nbsp;Mother Name</td>
								<td colspan="3" ><span>&nbsp;<?php echo $stinfo->mName; ?></span></td>
							</tr>
							<tr>
								<td>&nbsp;Mobile No</td>
								<td><span>&nbsp;<?php echo $stinfo->Phone_n; ?></span></td>
								<td>Gender </td>
								<td style="border-left:none;"><span>&nbsp;&nbsp;<?php echo $stinfo->gender; ?></span></td>
							</tr>
							<tr>
								<td>&nbsp;Institute Name</td>
								<td colspan="3" style="border-left:none;"><span>&nbsp;<?php echo $stinfo->inst_name; ?></span></td>
								
							</tr>
							<tr>
								<td>&nbsp;Class</td>
								<td style="border-left:none;"><span>&nbsp;<?php echo $stinfo->class_name; ?></span></td>
								<td style="">GPA </td>
								<td style=""><span>&nbsp;&nbsp;<?php echo $stinfo->gpa; ?></span></td>
							</tr>
							
							<tr>
								<td>&nbsp;City</td>
								<td><span>&nbsp;<?php echo $stinfo->city; ?></span></td>
								<td>Blood Group</td>
								<td><span>&nbsp;<?php echo $stinfo->blood_grou; ?></span></td>
							</tr>
							<tr>
								<td>&nbsp;Email</td>
								<td><span>&nbsp;<?php echo $stinfo->email; ?></span></td>
								<td>City</td>
								<td><span>&nbsp;<?php echo $stinfo->city; ?></span></td>
							</tr>
							
							<tr>
								<td >&nbsp;Present Address</td>
								
								<td colspan="3" style="border-left:none;">
									<p> 
										&nbsp;<?php echo $stinfo->pre_address; ?>
									</p>
								</td>
							</tr>
							<tr>
								<td>&nbsp;Permanent Address</td>
								
								<td colspan="3">
									<p> 
										&nbsp;<?php echo $stinfo->par_address; ?>
										
									</p>
								</td>
							</tr>
							<tr>
								<td colspan="4"><center><button style="background:red;height:40px;width:70px;font-size:15px;color:white;" class="btn btn-danger" onclick="window.close();">Close</button></center></td>
							</tr>
							
						</table>
					</div>
				</div>
			</div>
			<!-----------application area end--------------->
			
			<!-----------Instraction area Start--------------->
	<!---		<div class="attach_area"> 
				<div class="fix structure attach_section"> 
					<table border='0' class="attach_table" width='95%' height='70px' cellpadding='0' cellspacing='0' style="border-collapse:collapse;margin:0px auto;table-layout:fixed;"> 
						<tr> 
							<td width='8%' style="font-size:18px;font-weight:700;font-style:normal;text-indent:20px;"><u>Instruction:</u>
							</td>
							<td width='91%' style='font-size:16px;font-weight:normal;font-style:normal;text-indent:5px;'>:&nbsp;</td>
						</tr>
						<tr> 
							<td colspan="2" width='99%' style="text-indent:20px;">
							1.<span style="font-size:15px;">&nbsp;asjdfljasdlfj</span>
							</br>
							<span style="font-size:15px;padding-left:20px;">2.&nbsp;asjdfljasdlfj</span>
								</br>
							<span style="font-size:15px;padding-left:20px;">3.&nbsp;asjdfljasdlfj</span>
								</br>
							<span style="font-size:15px;padding-left:20px;">4.&nbsp;asjdfljasdlfj</span>
								</br>	
							
							</td>
						</tr>
					</table>
				</div>
			</div>	----------->
<!-----------Instraction area End--------------->			
		</div>
	</div>
</body>
</html>
