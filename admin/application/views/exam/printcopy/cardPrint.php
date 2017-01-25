<?php 
extract($_GET);
//print_r($_GET);
//echo "</br>";
$stuinfo=$this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,rg.name,rg.name_ban,r.roll_no,rg.picture,sac.balance
FROM re_admission r LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid
LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id
LEFT JOIN student_account sac ON sac.stu_id = r.stu_id
WHERE r.syear=$year and r.classid=$classid order by r.roll_no asc")->result_array();
//echo "<pre>";
$tstudent=count($stuinfo);
//print_r($stuinfo);
function convertbangla($input){
$bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');
$output = str_replace(range(0, 9),$bn_digits, $input); 
return $output;
}
$fromarray=explode("-",$start);
$toarray=explode("-",$end);
$sqlaccs = $this->db->select('*')->from('class_catg')->get()->result();

$fromdate=convertbangla($fromarray[0]).'/'.convertbangla($fromarray[1]).'/'.convertbangla($fromarray[2]);
$todate=convertbangla($toarray[0]).'/'.convertbangla($toarray[1]).'/'.convertbangla($toarray[2]);

$schoolProfile = $this->db->order_by("id","DESC")->limit(1)->get("sprofile")->row();
?>

<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<base href="<?php echo base_url(); ?>"></base>
		<title>Admit Card Print</title>
		<link href="<?php //echo base_url("css/all_print_copy/moneyRecipt.css"); ?>" rel="stylesheet" type="text/css"/>
		
		
		<style type="text/css"> 
		html, body, div, span, applet, object, iframe,
		h1, h2, h3, h4, h5, h6, p, blockquote, pre,
		a, abbr, acronym, address, big, cite, code,
		del, dfn, em, img, ins, kbd, q, s, samp,
		small, strike, strong, sub, sup, tt, var,
		b, u, i, center,
		dl, dt, dd, ol, ul, li,
		fieldset, form, label, legend,
		table, caption, tbody, tfoot, thead, tr, th, td,
		article, aside, canvas, details, embed, 
		figure, figcaption, footer, header, hgroup, 
		menu, nav, output, ruby, section, summary,
		time, mark, audio, video {
			margin: 0;
			padding: 0;
			border: 0;
			font-size: 100%;
			font: inherit;
			vertical-align: baseline;
		}
		/* HTML5 display-role reset for older browsers */
		article, aside, details, figcaption, figure, 
		footer, header, hgroup, menu, nav, section {
			display: block;
		}
		body {
			line-height: 1;
		}
		ol, ul {
			list-style: none;
		}
		blockquote, q {
			quotes: none;
		}
		blockquote:before, blockquote:after,
		q:before, q:after {
			content: '';
			content: none;
		}
		table {
			border-collapse: collapse;
			border-spacing: 0;
		}
		*{
			margin: 0px;
			padding: 0px;	
		}
		body{
			color: #666;
			background-color:lightgray;
			font-family:solaimanLipi,arial;
			font-size: 14px;
			line-height: 20px;
		}
		.fix{
			overflow:hidden;
		}
		.floatleft{
			float: left;
		}
		.floatright{
			float: right;
		}
		.stracture{
			margin: 0 auto;
			display: block;
			
		}
		.wrapper{
			width: 21cm;
			height: 30.9cm;
			padding:1em;
			margin: 0 auto;
			border: 1px black solid;
			border-radius: 5px;
			background: white;
			margin-bottom: 10px;
		}
		.top-side{
			width: 21cm;
			height: 10cm;
			border: 1px dashed #000;
		}
		
		.mid-side{
			width: 21cm;
			height: 10cm;
			border: 1px dashed #000;
		}
		.bottom-side{
			width: 21cm;
			height: 10cm;
			border: 1px dashed #000;
		}
		.heading{
			width: 20.2cm;
			text-align:center;
			line-height: 17px;
			padding: 1em;
			border: 0px solid red;
		}
		
		.heading-left{
			width: 4cm;
			border: 0px solid green;
		}
		.heading-mid{
			width: 12cm;
			text-align:center;
			padding: 2px; /*optional*/
			border: 0px solid green;
		}
		.heading-mid p>span{
			font-weight: bold;
			font-size: 13px;
		}
		.heading-right{
			width: 3.9cm;
			border: 0px solid green;
		}
		.heading-mid>h2{
			font-weight: bold;
			font-size: 28px;
			padding-bottom: 10px;
		}
		.heading-mid>h4{
			font-style: normal;
			font-weight: normal;
			font-size: 10px;
		}
		.heading-mid .small-font{
			font-size: 12px;
		}
		.mid-top{
			margin-top: 5px;
		}
		.mid-top-left, .mid-top-right{
			width: 7.8cm;
		}
		.mid-top-mid{
			width: 5.3cm;
			border: 0px solid red;
		}
		
		.mid-top-left {
			padding: 5px 0px 0px 20px;
			color: #000;
			font-size: 12px;
			box-sizing: border-box;
		}
		.mid-top-mid{
			text-align: center;
			font-weight: bold;
			color: #000;
		}
		.mid-top-mid>p{
			font-size: 26px;
			background: #333;
			color: #fff;
			padding: 2px;
			border: 1px solid #000;
			margin-bottom: 5px;
		}
		.mid-top-right{
			padding-left: 30px;
			color: #000;
			font-size: 11px;
			line-height: 17px;
			box-sizing: border-box;
		}
		.mid-top-right span.date-style{
			border-bottom: 0px dashed #000;
		}
		.mid-studentinfo{
			margin-top: 10px;
			color: #000;
			font-size: 14px;
			border: 0px solid gray;
		}
		.mid-studentinfo span{
			border: 1px solid #000;
			height: 18px;
			font-size: 12px;
			padding: 1px;
			display: inline-block;
			margin: 2px;
		}
		
		.mid-studentinfo span.span1{
			width: 120px;
			font-size: 18px;
			background:black;
			color:white;
		}
		.mid-studentinfo span.span2{
			width: 550px;
			font-size:14px;
		}
		.mid-studentinfo span.span3{
			width: 87px;
			font-size:14px;
		}
		
		.mid-studentinfo-left{
			width: 21cm;
			padding-left: 50px;
			box-sizing: border-box;
		}
		.footer{
			margin-top: 10px;
			border: 0px solid red;
			margin-bottom: 10px;
		}
		.footer p{
			position: relative;
			top: 45px;
		}
		.footer p>span{
			border-top: 1px solid #000;
		}
		.footer-left{
			width: 10cm;
			height: 75px;
			text-align: center;
			border: 0px solid blue;
		}
		.footer-right{
			width: 10cm;
			height: 75px;
			text-align: center;
			border: 0px solid yellow;
			
		}
		div.inwords-div{
			text-indent: 50px;
		} 
		.inwords-div span.inwords{
			border-bottom: 0px dashed #000;
			color: #333;
			font-size: 12px;
			font-weight: bold;
			font-style: italic;
		}
		
		/*  - For Print
		------------------------------------------------------*/
		.print-certificate {
		 width: 77px;
		 height: 76px;
		 position: fixed;
		 padding: 5px;
		 bottom: 30px;
		 right: 30px;
		 color: #ffffff;
		 font-size: 2em;
		 text-align: center;
		 line-height: 36px;
		 background-color: #D3D3D3;
		 -moz-border-radius: 6px 20px 6px 20px;
		 -webkit-border-radius: 6px 20px 6px 20px;
		 border-radius: 6px 20px 6px 20px;
		 z-index: 9999;
		}
		.print-certificate img{
		 width: 70px;
		 height: 70px;
		 margin-top: 5px;
		 cursor: pointer;
		}
		@media all and (max-width: 1065px) {
			#print-full-page {
				display:none;
			}
		}
		@media print
		{    
			.no-print, .no-print *
			{
				visibility:hidden;
			}
			table{
				background:none;
			} 
			
			.wrapper{
				margin-bottom: 0px;
				page-break-after: always;
				border:none;
			}
		}
	</style>
	</head>
	<body>
		<?php 
		$i=0;
		foreach($stuinfo as $key=>$value) {
			if($i>=$tstudent) { break; }
			
		//echo $tstudent;
		?>
		<div class="fix stracture wrapper"> 
		
		<div class="fix top-side">
			<div class="fix heading">
				<div class="heading-left floatleft">
					<div style="float:right;"> 
						<img src="<?php echo base_url("img/document/school_logo/$schoolProfile->logo"); ?>" alt="" style="height: 60px;width: 60px;" />
					</div>
				</div>
				<div class="heading-mid floatleft">
					<h2>বসুরহাট একাডেমী</h2>
					<p class="small-font">টি এন্ড টি রোড, বসুরহাট, কোম্পানীগন্জ, নোয়াখালী</p>
					<p> 
						<span>মোবাইল :</span>
						<span>০১৭০০৮৫২০৩২(অফিস), ০১৮১৮৭৪৭১৫৫(অধ্যক্ষ)</span>
					</p>
				</div>
				<div class="heading-right floatright">
				    <?php $img=$stuinfo[$i]['picture']; ?>
					<img src="<?php echo base_url("img/student_section/registration_form/$img"); ?>" alt="" style="height: 60px;width: 60px;" />
				</div>
			</div>
			<div class="fix mid-top">
				<div class="mid-top-left floatleft">
					
				</div>
				<div class="mid-top-mid floatleft">
					<p>প্রবেশ পত্র</p>
					<span><?php echo $examname.'-'.convertbangla($year); ?></span>
				</div>
				<div class="mid-top-right floatright">
				</div>
			</div>
			<div class="fix mid-studentinfo">
				<div class="mid-studentinfo-left floatleft">
					<p> 
						<span class="span1">ছাত্র/ ছাত্রীর নাম</span>
						<span class="span2"><?php echo $stuinfo[$i]['name_ban']; ?></span>
					</p>
					<p> 
						<span class="span1">শ্রেণী </span>
						<span class="span3"><?php echo $stuinfo[$i]['class_name']; ?> </span>
						<span class="span1">রোল নং </span>
						<span class="span3"><?php echo convertbangla($stuinfo[$i]['roll_no']);  ?> </span>
						<span class="span1">শাখা </span>
						<span class="span3"><?php echo $stuinfo[$i]['section_name']; ?> </span>
						
					</p>
					<p> 
						<span class="span1"> পরীক্ষার তারিখ</span>
						<span class="span3"><?php echo $fromdate; ?> </span>
						<span class="span1">হতে </span>
						<span class="span3"><?php echo $todate; ?> </span>
						<span class="span1">পর্যন্ত</span>
					</p>
				</div>
			</div>
			
			<div class="fix footer">
				<div class="footer-left floatleft">
					<p><span>শ্রেণী শিক্ষক</span></p>
				</div>
				<div class="footer-right floatright">
					<p><span>অধ্যক্ষ</span></p>
				</div>
			</div>
			<div class="fix stracture inwords-div"> 
				<p>
					<span class="inwords">বিঃ দ্রঃ -</span>
					<span class="inwords"> প্রত্যেক পরীক্ষা দিবসে প্রবেশ পত্র অবশ্যই সঙ্গে আনতে হবে ।</span>
				</p>
			</div>
		</div>
		<?php $i++; ?>
		<div class="dottet"></div>
		<div class="fix stracture mid-side">
			<div class="fix heading">
				<div class="heading-left floatleft">
					<div style="float:right;"> 
						<img src="<?php echo base_url("img/document/school_logo/$schoolProfile->logo"); ?>" alt="" style="height: 60px;width: 60px;" />
					</div>
				</div>
				<div class="heading-mid floatleft">
					<h2>বসুরহাট একাডেমী</h2>
					<p class="small-font">টি এন্ড টি রোড, বসুরহাট, কোম্পানীগন্জ, নোয়াখালী</p>
					<p> 
						<span>মোবাইল :</span>
						<span>০১৭০০৮৫২০৩২(অফিস), ০১৮১৮৭৪৭১৫৫(অধ্যক্ষ)</span>
					</p>
				</div>
				<div class="heading-right floatright">
					<?php $img=$stuinfo[$i]['picture']; ?>
					<img src="<?php echo base_url("img/student_section/registration_form/$img"); ?>" alt="" style="height: 60px;width: 60px;" />
				</div>
			</div>
			<div class="fix mid-top">
				<div class="mid-top-left floatleft">
					
				</div>
				<div class="mid-top-mid floatleft">
					<p>প্রবেশ পত্র</p>
					<span><?php echo $examname.'-'.convertbangla($year); ?></span>
				</div>
				<div class="mid-top-right floatright">
				</div>
			</div>
			<div class="fix mid-studentinfo">
				<div class="mid-studentinfo-left floatleft">
					<p> 
						<span class="span1">ছাত্র/ ছাত্রীর নাম</span>
						<span class="span2"><?php echo $stuinfo[$i]['name_ban']; ?></span>
					</p>
					<p> 
						<span class="span1">শ্রেণী </span>
						<span class="span3"><?php echo $stuinfo[$i]['class_name']; ?> </span>
						<span class="span1">রোল নং </span>
						<span class="span3"><?php echo convertbangla($stuinfo[$i]['roll_no']);  ?> </span>
						<span class="span1">শাখা </span>
						<span class="span3"><?php echo $stuinfo[$i]['section_name']; ?> </span>
						
					</p>
					<p> 
						<span class="span1"> পরীক্ষার তারিখ</span>
						<span class="span3"><?php echo $fromdate; ?> </span>
						<span class="span1">হতে </span>
						<span class="span3"><?php echo $todate; ?> </span>
						<span class="span1">পর্যন্ত</span>
					</p>
				</div>
			</div>
			
			<div class="fix footer">
				<div class="footer-left floatleft">
					<p><span>শ্রেণী শিক্ষক</span></p>
				</div>
				<div class="footer-right floatright">
					<p><span>অধ্যক্ষ</span></p>
				</div>
			</div>
			<div class="fix stracture inwords-div"> 
				<p>
					<span class="inwords">বিঃ দ্রঃ -</span>
					<span class="inwords"> প্রত্যেক পরীক্ষা দিবসে প্রবেশ পত্র অবশ্যই সঙ্গে আনতে হবে ।</span>
				</p>
			</div>
		</div>
		<?php $i++; ?>
		<div class="dottet"></div>
		<div class="fix stracture bottom-side">
			<div class="fix heading">
				<div class="heading-left floatleft">
					<div style="float:right;"> 
						<img src="<?php echo base_url("img/document/school_logo/$schoolProfile->logo"); ?>" alt="" style="height: 60px;width: 60px;" />
					</div>
				</div>
				<div class="heading-mid floatleft">
					<h2>বসুরহাট একাডেমী</h2>
					<p class="small-font">টি এন্ড টি রোড, বসুরহাট, কোম্পানীগন্জ, নোয়াখালী</p>
					<p> 
						<span>মোবাইল :</span>
						<span>০১৭০০৮৫২০৩২(অফিস), ০১৮১৮৭৪৭১৫৫(অধ্যক্ষ)</span>
					</p>
				</div>
				<div class="heading-right floatright">
					<?php $img=$stuinfo[$i]['picture']; ?>
					<img src="<?php echo base_url("img/student_section/registration_form/$img"); ?>" alt="" style="height: 60px;width: 60px;" />
				</div>
			</div>
			<div class="fix mid-top">
				<div class="mid-top-left floatleft">
					
				</div>
				<div class="mid-top-mid floatleft">
					<p>প্রবেশ পত্র</p>
					<span><?php echo $examname.'-'.convertbangla($year); ?></span>
				</div>
				<div class="mid-top-right floatright">
				</div>
			</div>
			<div class="fix mid-studentinfo">
				<div class="mid-studentinfo-left floatleft">
					<p> 
						<span class="span1">ছাত্র/ ছাত্রীর নাম</span>
						<span class="span2"><?php echo $stuinfo[$i]['name_ban']; ?></span>
					</p>
					<p> 
						<span class="span1">শ্রেণী </span>
						<span class="span3"><?php echo $stuinfo[$i]['class_name']; ?> </span>
						<span class="span1">রোল নং </span>
						<span class="span3"><?php echo convertbangla($stuinfo[$i]['roll_no']);  ?> </span>
						<span class="span1">শাখা </span>
						<span class="span3"><?php echo $stuinfo[$i]['section_name']; ?> </span>
						
					</p>
					<p> 
						<span class="span1"> পরীক্ষার তারিখ</span>
						<span class="span3"><?php echo $fromdate; ?> </span>
						<span class="span1">হতে </span>
						<span class="span3"><?php echo $todate; ?> </span>
						<span class="span1">পর্যন্ত</span>
					</p>
				</div>
			</div>
			
			<div class="fix footer">
				<div class="footer-left floatleft">
					<p><span>শ্রেণী শিক্ষক</span></p>
				</div>
				<div class="footer-right floatright">
					<p><span>অধ্যক্ষ</span></p>
				</div>
			</div>
			<div class="fix stracture inwords-div"> 
				<p>
					<span class="inwords">বিঃ দ্রঃ -</span>
					<span class="inwords"> প্রত্যেক পরীক্ষা দিবসে প্রবেশ পত্র অবশ্যই সঙ্গে আনতে হবে ।</span>
				</p>
			</div>
		</div>
		<?php $i++;?>
	</div>
	<?php 
	} 
	//echo $i;
	?>
	<!--- for print----->
		<div id="print-full-page" class="no-print">
			<div class="print-certificate">
				<a target="" href="javaScript:window.print();" title="প্রিন্ট করুন">
					<img src="<?php echo base_url("img/print/print_big.png"); ?>" alt="প্রিন্ট করুন" />
				</a>
			</div>
		</div>
		<!--- end for print------>
		
	</body>
</html>