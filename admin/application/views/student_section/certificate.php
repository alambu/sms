<html>
	<head>
   <base href="<?php echo base_url();?>"></base>
	<meta charset="utf-8"/>
	<style>
		@media print{
		@page { size: landscape; }
		
		#bar{
			display:none !important;
		}
		
		}
		#main_div
		{
		min-height:610px;
		width:920px;
		background:#F2F2F2;
		margin:0px auto;
		}
		#certificate_body
		{
		height:570px;
		width:877px;
		background:white;
		margin:16px;
		position:relative;
		border:4px groove gray;
		float:left;
		}
	/* Header Start */
		#header{
		height:30%;
		width:98%;
		margin:1% 1% 0% 1%;
		background:white;
		float:left;
		}
		.header_p{
		text-align:center;
		margin:0px;
		}
	/* Header End */
	
	/* Content Start */
	   #content{
	   height:70%;
	   width:98%;
	   margin:0% 1% 1% 1%;
	 /*  background:url('1.jpg') scroll top center no-repeat;*/
	   
	   float:left;
	   }
	/* Content End */
	
	</style>	
	</head>
	
	<body>
		<?php 
		extract($_POST);
		$y=date("Y");
		//print_r($_POST);
		if($stu_cer!=''){
			$info=$this->db->query("select a.*,b.* from regis_tbl a,re_admission b where b.syear='$y' and a.stu_id='$stu_cer' and b.stu_id='$stu_cer'");
			//echo "sdf";
		}
		else {
			$info=$this->db->query("select a.*,b.* from regis_tbl a,re_admission b where b.syear='$y' and b.shiftid='$sft_cer' and b.classid='$cls_cer' and b.section='$sec_cer' and b.roll_no='$rol_cer' and b.stu_id=a.stu_id");
			//echo "sdjfasdf";
		}
		
		 $row=$this->db->affected_rows();
		if($row>0){
		$stu_info=$info->row();
		$sprofile=$this->db->query("select * from sprofile")->row();
		?>
		<div style="left:300px;top:5px;position:middle;background:#666;" align="center" id="bar"><a  target='_blank' href="javaScript:window.print();"><img src="img/print/print.png"/></a>&nbsp;&nbsp;&nbsp;<a href="student_section/certificate"><button type="button">Back</button></a>
		</div>
		<div id="main_div">
			<div id="certificate_body">
			
			<!------Header Start----->
				<div id="header">
					<p class="header_p" style="font-size:25px;"><?php echo $sprofile->schoolN; ?></p>
					<p class="header_p" style="font-size:20px;"><?php echo $sprofile->address; ?></p>
					<center><img src="img/document/school_logo/<?php echo $sprofile->logo; ?>" style="height:70px;width:70px;"/></center>
					<p class="header_p" style="font-size:45px;"><i><u><?php if($type_cer=='tc'){ if (isset($cer_eng)){?>Transfer Certificate<?php } else { echo "ছাড়  পত্র"; } } else { ?><?php if(isset($cer_eng)){ ?>Testimonial<?php } else  {  echo "প্রশংসা পত্র"; } }?></u></i></p>
					
					
				</div>
			<!------Header End----->
			
			
			<!------Content Start------>
				<?php if(isset($cer_eng)){ ?>
				<div id="content">
					<p style="font-size:20px;font-style:italic;line-height:40px;"><span style="border-bottom:1px solid gray;">This is Certify That, Name:&nbsp;<b><?php echo $stu_info->name; ?></b> &nbsp;Father Name:&nbsp;<b><?php echo $stu_info->fName; ?> &nbsp;</b>Mother Name:&nbsp;<b><?php echo $stu_info->mName; ?></b> &nbsp;Parmanent Address :&nbsp;<b><?php echo $stu_info->par_address; ?> &nbsp;</b> Present Address :&nbsp;<b><?php echo $stu_info->pre_address; ?>. &nbsp;</b>Session <b><?php echo $y; ?></b> Class: <b><?php echo $this->db->query("select class_name from class_catg where classid='$stu_info->classid'")->row()->class_name; ?> </b> Roll No:<b><?php echo $rol_cer; ?>.</b>  He Was Regular Student in My School.</span></p>
					
					<p style="font-size:20px;font-style:italic;">My Knowladge goes he did Not take part in any activity subversive of the state or of discipline during his study here.</p>
					<p><b>I Wish him/her Every Success in Life.</b></p>
					</br>
					<p>
					<?php $ses=$this->session->userdata('userid'); ?>
					<div style="width:100%;float:left;">
						<div style="width:30%;float:left;border:0px solid red;">
							<hr/>
							<p style="text-align:center;margin-top:2px;"><b>Register Sign</b></p>
							<?php //echo $this->db->query("select name from empee where empid='$ses'")->row()->name; ?>
						</div>
						<div style="width:30%;float:right;border:0px solid red;">
							<hr/>
							<p style="text-align:center;margin-top:2px;"><b>Principal Sign</b></p>
						</div>
					</div>
					</p>
					
				</div>
				<?php } else {  ?>
				
				<div id="content">
					<p style="font-size:20px;font-style:italic;line-height:40px;"><span style="border-bottom:1px solid gray;">এই মর্মে প্রত্যয়ন করা যাছে যে , নাম  :&nbsp;<b><?php echo $stu_info->name_ban; ?></b> &nbsp;পিতার নাম:&nbsp;<b><?php echo $stu_info->fName_ban; ?> &nbsp;</b>মাতার নাম :&nbsp;<b><?php echo $stu_info->mName_ban; ?></b> &nbsp;স্থায়ী ঠিকানা : &nbsp;<b><?php echo $stu_info->par_address; ?> &nbsp;</b>বর্তমান ঠিকানা :&nbsp;<b><?php echo $stu_info->pre_address; ?>. &nbsp;</b>সেসন <b><?php echo $y; ?></b> ক্লাস: <b><?php echo $this->db->query("select class_name from class_catg where classid='$stu_info->classid'")->row()->class_name; ?> </b>রোল নং : <b><?php echo $rol_cer; ?> .</b> সে আমার বিদ্যালয়ের একজন নিয়মিত ছাত্র / ছাত্রী  ।</span></p>
					
					<p style="font-size:20px;font-style:italic;">আমার জানা মতে সে  রাষ্ট্র বিরোধী কর্মকাণ্ডে জড়িত ছিলো না এবং তার শিক্ষা কালিন সময়ে কোন অনিয়ম করেনি।</p>
					<p><b> আমি তার সর্বাঙ্গীণ সাফল্য কামনা করি ।</b></p> 
					</br>
					<p>
					<div style="width:100%;float:left;">
						<div style="width:30%;float:left;border:0px solid red;">
							<hr/>
							<p style="text-align:center;margin-top:2px;">হিসাব রক্ষক</p>
							<?php //echo $this->db->query("select name from empee where empid='$ses'")->row()->name; ?>
						</div>
						<div style="width:30%;float:right;border:0px solid red;">
							<hr/>
							<p style="text-align:center;margin-top:2px;"> প্রধান শিক্ষক</p>
						</div>
					</div>
					</p>
					
				</div>
				
				<?php } ?>
			<!------Content End------>	
			
			
			</div>
		</div>
		<?php  } else {
		?>
			<h3>!Sorry Student Not Found</h3>
			<div style="left:300px;top:5px;position:middle;background:#666;" align="center" id="bar"><a  target='_blank' href="javaScript:window.print();"><img src="img/print/print.png"/></a>&nbsp;&nbsp;&nbsp;<a href="student_section/certificate"><button type="button">Back</button></a>
			</div>
		<?php 	
		} ?>
		<!--<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fhttp://datacenter.com.bd/smartup/index.php/onlinetrack/nagoriksonod_jachai?id=<?php //echo sha1('124512451')?>%2F&choe=UTF-8" height="150px" width="170px" style="padding:10px;box-sizing: border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;">-->
	</body>
</html>