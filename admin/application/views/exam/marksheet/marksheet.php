<?php

// getting the student information
	$header_info = $this->mkst->single_std_info( $shift,$class,$section,$roll );
	// echo $this->db->last_query();
	
	// group name 
	$dept = $this->mkst->group_name( $header_info->group_name );

	// total student
	$total_std = $this->mkst->total_student_this_year( $class,$shift,$section,$year );

	// half-yearly attendance
	$half_year_total_att = $this->mkst->half_year_t_attend( $year );
	$htotal_att = $half_year_total_att->num_rows();
	$hinfo = $half_year_total_att->result();
	
	$stu_h_att = $this->mkst->stuedent_att( $hinfo,$header_info->stu_id );

	if( $htotal_att ):
		// attendance percentige
		$ha_pers = $this->mkst->convertToBangla(($stu_h_att*100)/$htotal_att)." %";
	endif;

	
	// yearly attendance
	$final_year_total_att = $this->mkst->final_year_t_attend( $year );
	$ftotal_att = $final_year_total_att->num_rows();
	$finfo = $final_year_total_att->result();

	
	$stu_f_att = $this->mkst->stuedent_att( $finfo,$header_info->stu_id );

	if( $ftotal_att ):
		// attendance percentige
		$fa_pers = $this->mkst->convertToBangla(($stu_f_att*100)/$ftotal_att)." %";
	endif;

	// total attendance percentage
	$total_att_pers = $this->mkst->convertToBangla(( ( $stu_h_att + $stu_f_att )*100 )/($htotal_att + $ftotal_att));

	// all all subject of this class
	$all_sub = $this->mkst->all_subject( $class );


?>

<html>
	<head>
		<meta charset="utf-8">
		<title>সাংবৎসরিক পরীক্ষার ফলাফল</title>
		<link rel="stylesheet" type="text/css" href="marksheet.css" media="all" />
		<style>
		.wrapper{
			width: 29.7cm;
			height: 21cm;
			padding:1em;
			margin: 5 auto;
			border: 1px #D3D3D3 solid;
			border-radius: 5px;
			background: white;
		}
		
		@wrapper{
			size: A4 landscape;
			margin: 0;
		}
		@media print {
			#printtbl{display: none;}
			@page { size: landscape; }
			body{
				font-family:SolaimanLipi;
			}
			.wrapper{
				margin:0em;
				border: initial;
				border-radius: initial;
				height: initial;
				box-shadow: initial;
				background: initial;
				page-break-after: none;
				-webkit-print-color-adjust: exact;
				marks:bleed;
			}
			.main_table_style p.custom-center{
				text-align: left !important;
				text-indent: 315px !important;
			}
		}

		@media screen and projection {
			a {
				display:inline;
			}
			img.logo{
			height:20px;
			}	
		}
		
		@media print
		{    
			.no-print, .no-print *
			{
				visibility:hidden;
				
			}				
		}
		.main_table_style{
			border-collapse: collapse;
			table-layout: fixed;
		}
		.main_table_style p{
			padding: 4px 0px;
			box-sizing:border-box;
			-moz-box-sizing:border-box;
			-webkit-box-sizing:border-box;
			text-align: center;
			font-size: 14px;
			font-weight:normal;
			font-style: normal;
			font-family: SolaimanLipi;
		}
		.main_table_style p.custom-center{
				text-align: left !important;
				text-indent: 315px;
		}
		p.small-font{
			font-size: 10px;
			white-space: nowrap;
		}
		p.xx_small-font{
			font-size: 9px;
			white-space: nowrap;
		}
		p.medium-font{
			font-size : 12px;
		}
		p.white-space-normal{
			white-space: normal;
		}
		p.highlight{
			font-weight: bolder;
			position: relative;
			/*top: 10px;*/
			
		}
		p.position-bottom{
			position: relative;
			/*top: 0px;*/
		}
		p.left-align{
			text-align:left;
		}
		p.down{
			position: relative;
			top: 80px;
		}
		</style>
	</head>
	
	<body>
		<div class="wrapper" attr="none">
			<table class="main_table_style"  width="100%" cellspacing="0" cellpadding="0" border="1" >
				<tr>
					<td colspan="25"><p> টি এন্ড টি উচ্চ বিদ্যালয়, মতিঝিল, ঢাকা-১০০০ </p></td>
				</tr>
				<tr>
					<td colspan="4"><p> পূর্ব শ্রেণি হতে উত্তীর্ণ </p></td>
					<td colspan="21"><p class="custom-center"> সাংবৎসরিক পরীক্ষার ফলাফল-২০১৫ </p></td>
				</tr>
				<tr>
					<td colspan="5"><p><?php echo $header_info->name ?></p></td>
					<td colspan="5"><p>শ্রেণি <?php echo $this->mkst->banglaString($header_info->class_name); ?> (<?php echo $dept; ?>) <?php if($header_info->gender == 'Male'):echo "বালক";elseif($header_info->gender == 'Female'):echo "বালিকা";endif; ?> রোল <?php echo $this->mkst->convertToBangla($roll) ?> </p></td>
					<td><p class="small-font">উপস্থিতির %</p></td>
					<td colspan="2"><p class="small-font">সাংব: উপস্থিতি %</p></td>
					<td colspan="2"><p>বিলম্বে উপস্থিত</p></td>
					<td colspan="2"><p>স্কুল পলায়ন</p></td>
					<td colspan="2"></td>
					<td colspan="2"><p>জিপিএ</p></td>
					<td colspan="2"><p>স্থান</p></td>
					<td colspan="2"><p>ফেলের সংখ্যা</p></td>
				</tr>
				<tr>
					<td colspan="2"><p>অর্ধ-বার্ষিক:</p></td>
					<td colspan="2"><p class="medium-font white-space-normal"> শ্রেণির শিক্ষার্থী সংখ্যা</p></td>
					<td><p><?php echo $this->mkst->convertToBangla($total_std) ?></p></td>
					<td colspan="2"><p class="small-font"> কার্যকাল (জানুয়ারি-জুন)</p></td>
					<td><p><?php if( $htotal_att ):echo $this->mkst->convertToBangla($htotal_att);endif; ?></p></td>
					<td><p class="medium-font">উপস্থিতি</p></td>
					<td><p><?php echo $this->mkst->convertToBangla($stu_h_att); ?></p></td>
					<td><p><?php echo $ha_pers ?></p></td>
					<td colspan="2" rowspan="2"><p class="highlight"><?php echo $total_att_pers; ?></p></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2"><p>অর্ধ-বার্ষিক</p></td>
					<td colspan="2"><p id="half_year_grd"></p></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2"><p>বার্ষিক:</p></td>
					<td colspan="2"><p class="medium-font white-space-normal"> শ্রেণির শিক্ষার্থী সংখ্যা</p></td>
					<td><p><?php echo $this->mkst->convertToBangla($total_std) ?></p></td>
					<td colspan="2"><p class="small-font white-space-normal">মোট কার্যকাল (জুলাই-ডিসেম্বর)</p></td>
					<td><p><?php if( $ftotal_att ):echo $this->mkst->convertToBangla($ftotal_att);endif; ?></p></td>
					<td><p class="medium-font">উপস্থিতি</p></td>
					<td><p><?php echo $this->mkst->convertToBangla($stu_f_att); ?></p></td>
					<td><p><?php echo $fa_pers ?></p></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
					<td colspan="2"><p>সাংবৎসরিক</p></td>
					<td colspan="2"><p id="final_year_grd"></p></td>
					<td colspan="2"></td>
					<td colspan="2"></td>
				</tr>
				<tr>
					<td colspan="2"><p>২</p></td>
					<td colspan="2"><p>টিউটরিয়্যাল</p></td>
					<td colspan="4"><p>অর্ধ-বার্ষিক </p></td>
					<td colspan="2"><p> বার্ষিক</p></td>
					<td colspan="2"><p class="small-font">অর্ধ-বার্ষিক সর্বোচ্চ নম্বর</p></td>
					<td colspan="2"><p class="small-font">বার্ষিক সর্বোচ্চ নম্বর</p></td>
					<td rowspan="2"><p class="xx_small-font position-bottom">সাংসৃ: ৪০%</p></td>
					<td rowspan="2"><p class="xx_small-font position-bottom">সাংবহু: ৪০%</p></td>
					<td rowspan="2" ><p class="small-font position-bottom">মোট ৮০%</p></td>
					<td rowspan="2"><p class="small-font position-bottom">ডাইরী</p></td>
					<td rowspan="2"><p class="xx_small-font white-space-normal">ধারাবাহিক মূল্যায়ন ২০%</p></td>
					<td rowspan="2"><p class="small-font position-bottom">মোট ১০০%</p></td>
					<td rowspan="2"><p class="small-font position-bottom">জিপি</p></td>
					<td rowspan="2" colspan="4"></td>
				</tr>
				<tr>
					<td colspan="2"><p>বিষয়</p></td>
					<td><p>১ম</p></td>
					<td><p>২য়</p></td>
					<td><p class="small-font">সৃজনশীল</p></td>
					<td><p class="small-font">বহুনির্বাচনী</p></td>
					<td><p class="small-font">মোট</p></td>
					<td><p class="small-font">জিপি</p></td>
					<td><p class="small-font">সৃজনশীল</p></td>
					<td><p class="small-font">বহুনির্বাচনী</p></td>
					<td><p class="small-font">সৃজনশীল</p></td>
					<td><p class="small-font">বহুনির্বাচনী</p></td>
					<td><p class="small-font">সৃজনশীল</p></td>
					<td><p class="small-font">বহুনির্বাচনী</p></td>
				</tr>

<!-- fetching data -->
			<?php
				
				$frow = ceil(count($all_sub)/2);
				$checker = 0;
				$minus_subj = 0;
				foreach( $all_sub as $asb ):
				$checker++;

				// last two tutorial mark
				$tutorial_mark = $this->mkst->last_two_tutorial( $class,$section,$shift,$asb->subjid,$header_info->stu_id,$year );

				// half yearly examination mark
				$h_xm_mk = $this->mkst->half_yearly_xm( $shift,$class,$section,$roll,$asb->subjid );
				
				// final examination mark
				$f_xm_mk = $this->mkst->final_xm( $shift,$class,$section,$roll,$asb->subjid );
			?>

				<tr>
					<td colspan="2"><p class="medium-font"><?php echo $asb->sub_name ?></p></td>
					
					<td><p><?php $total_ftuto += $ftu = $tutorial_mark[0]->mark;if(!is_null($tutorial_mark[0]->mark)):echo $this->mkst->convertToBangla($ftu);endif; ?></p></td>
					
					<td><p><?php $total_stuto += $tutorial_mark[1]->mark;$ftu += $tutorial_mark[1]->mark;if(!is_null($tutorial_mark[1]->mark)):echo $this->mkst->convertToBangla($tutorial_mark[1]->mark);endif; ?></p></td>
					
					<td><p><?php if(!is_null($h_xm_mk->theory_mark)):echo $this->mkst->convertToBangla($h_xm_mk->theory_mark);$ththr += $h_xm_mk->theory_mark;endif; ?></p></td>
					
					<td><p><?php if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):if(!is_null($h_xm_mk->obj_mark)):echo $this->mkst->convertToBangla($h_xm_mk->obj_mark);$thobj += $h_xm_mk->obj_mark;endif;endif; ?></p></td>
					
					<td><p><?php $tmark = $h_xm_mk->theory_mark+$h_xm_mk->obj_mark;if(!is_null($h_xm_mk->theory_mark)):$thtotal += $tmark; echo $this->mkst->convertToBangla($tmark);endif; ?></p></td>
					
					<td><p>
					<?php 
					if($asb->exm_mark <= 50):
						$tmark = $tmark*2;
					endif;
					// call this subject is associate with or not
					$asso = $this->mkst->test_assosiate_subj( $asb->subjid );
					$ast = $this->mkst->assosiate_with( $asb->subjid );
					if(!$asso && !$ast):	// if associate not found
						if(!is_null($h_xm_mk->theory_mark)):
							$gdSbj = $this->mkst->getGrading($tmark);
							if($asb->optional):$gdSbj = $gdSbj-2;endif;
							echo $this->mkst->convertToBangla($gdSbj);
							$thgrade += $gdSbj;
						endif;
					endif;
					?>
					</p></td>
					
					<td><p><?php $fxmth = $f_xm_mk->theory_mark;if(!is_null($fxmth)):echo $this->mkst->convertToBangla($fxmth);$fxmth_tot += $fxmth;endif; ?></p></td>
					
					<td><p><?php if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):$fxmobj = $f_xm_mk->obj_mark;if(!is_null($fxmobj)):echo $this->mkst->convertToBangla($fxmobj);$fxmobj_tot += $fxmobj;endif;endif; ?></p></td>
					
					<td><p></p></td>
					
					<td><p></p></td>
					
					<td><p></p></td>
					
					<td><p></p></td>
					
					<td><p><?php $theory_fourty = ((($h_xm_mk->theory_mark+$f_xm_mk->theory_mark)*40)/100);if(!is_null($f_xm_mk->theory_mark)):echo $this->mkst->convertToBangla($theory_fourty);endif;$th_fourty += $theory_fourty; ?></p></td>
					
					<td><p><?php $obj_fourty = ((($h_xm_mk->obj_mark+$f_xm_mk->obj_mark)*40)/100);if(!is_null($f_xm_mk->obj_mark)):if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):echo $this->mkst->convertToBangla($obj_fourty);endif;endif;$obj_fort += $obj_fourty; ?></p></td>
					
					<td><p><?php $sixty_pers = $theory_fourty+$obj_fourty;if(!is_null($f_xm_mk->theory_mark)):echo $this->mkst->convertToBangla($sixty_pers);endif;$tot_eighty += $sixty_pers; ?></p></td>
					
					<td><p><?php $o = $f_xm_mk->other_mark;if(!is_null($f_xm_mk->other_mark)):echo $this->mkst->convertToBangla($o);endif;$tot_o += $o; ?></p></td>
					
					<td><p><?php if($asb->exm_mark <= 50):$ftu = $ftu/2;endif;if($ftu > 20):$twenty_pers = $o+($ftu/4);else:$twenty_pers = $o+($ftu/2);endif;if(!is_null($f_xm_mk->other_mark)):echo $this->mkst->convertToBangla($twenty_pers);endif;$tot_twenty_pers += $twenty_pers; ?></p></td>
					
					<td><p><?php $hundred_pers = $sixty_pers+$twenty_pers;if(!is_null($f_xm_mk->theory_mark)):echo $this->mkst->convertToBangla($hundred_pers);endif;$tot_hnd_pers += $hundred_pers; ?></p></td>
					
					<td><p>
					<?php 
						if($asb->exm_mark <= 50):
							$hundred_pers = $hundred_pers*2;
						endif;
						// call this subject is associate with or not
						$asso = $this->mkst->test_assosiate_subj( $asb->subjid );
						$ast = $this->mkst->assosiate_with( $asb->subjid );
						if(!$asso && !$ast):	// if associate not found
							if(!is_null($f_xm_mk->theory_mark)):
								$gnd = $this->mkst->getGrading($hundred_pers);
								if($asb->optional):$gnd = $gnd-2;endif;
								echo $this->mkst->convertToBangla($gnd);$tot_grd += $gnd;
							endif; 
						endif; 
					?>
					</p></td>
				
				<?php if( $checker == 1 ): ?>
					<td colspan="4"><p>মন্তব্য (অর্ধ-বার্ষিক)</p></td>
				
				<?php elseif( $checker == 2 ): ?>
					<td colspan="4" rowspan="<?php echo $frow ?>"><p class="down small-font" style="top:<?php echo ($frow-2)*15 ?>px;" >শ্রেণি শিক্ষকের স্বাক্ষর</p></td>
				
				<?php elseif( $checker == $frow ): ?>
					<td colspan="4"><p>মন্তব্য (সাংবৎসরিক)</p></td>
				
				<?php elseif( $checker == $frow+1 ): ?>
					<td colspan="4" rowspan="<?php echo $frow+2 ?>"><p class="down small-font" style="top:<?php echo ($frow-1)*17 ?>px;">শ্রেণি শিক্ষকের স্বাক্ষর</p></td>
				<?php endif; ?>
				
				</tr>
			
			<!-- total row start -->
			<?php
				if($asb->assosciate_with):
					// release first assosiate total value for next
					$asso_obj_fourty = 0;
					$asso_th_fourty = 0;

					// for half yearly only
					$associate_subj_mk = $this->mkst->half_yearly_xm( $shift,$class,$section,$roll,$asb->assosciate_with );
					// for final year
					$assos_f_xm = $this->mkst->final_xm( $shift,$class,$section,$roll,$asb->assosciate_with );
					// assosiate tutorial mark
					$asso_tu_mk = $this->mkst->last_two_tutorial($class,$section,$shift,$asb->assosciate_with,$header_info->stu_id,$year);
			?>
				<tr>
					<td colspan="2"><p>মোটঃ</p></td>
					<td><p><?php echo $this->mkst->convertToBangla($asso_tu = $tutorial_mark[0]->mark+$asso_tu_mk[0]->mark); ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($tutorial_mark[1]->mark) ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($asso_h_th_tmk = $h_xm_mk->theory_mark+$associate_subj_mk->theory_mark) ?></p></td>
					<td><p><?php if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):echo $this->mkst->convertToBangla($asso_h_obj_tmk = $h_xm_mk->obj_mark+$associate_subj_mk->obj_mark);endif; ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($concate_tot = $h_xm_mk->theory_mark+$h_xm_mk->obj_mark+$associate_subj_mk->theory_mark+$associate_subj_mk->obj_mark) ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($tgd = $this->mkst->getGrading($concate_tot/2));$thgrade += $tgd; ?></p></td>
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_f_th_tmk = $fxmth+$assos_f_xm->theory_mark);endif; ?></p></td>
					<td><p><?php if(!is_null($fxmobj)):if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):echo $this->mkst->convertToBangla($asso_f_obj_tmk = $fxmobj+$assos_f_xm->obj_mark);endif;endif; ?></p></td>
					<td><p><?php  ?></p></td>
					<td><p><?php  ?></p></td>
					<td><p><?php  ?></p></td>
					<td><p><?php  ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_th_fourty = ((($asso_h_th_tmk+$asso_f_th_tmk)*40)/100));endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):if(($asb->sobj_mk != 0) || ($asb->sprack_mk != 0)):echo $this->mkst->convertToBangla($asso_obj_fourty = ((($asso_h_obj_tmk+$asso_f_obj_tmk)*40)/100));endif;endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_eighty = $asso_th_fourty+$asso_obj_fourty);endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_dairy = $assos_f_xm->other_mark+$f_xm_mk->other_mark);endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_twenty = (($asso_tu/2)+$asso_dairy));endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla( $asso_hundr = $asso_eighty+$asso_twenty );$asso_hnd_half = round(($asso_hundr/2),0,PHP_ROUND_HALF_UP);endif; ?></p></td>
					
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($asso_gnd = $this->mkst->getGrading($asso_hnd_half));$tot_grd += $asso_gnd;endif; ?></p></td>
				</tr>
			<?php endif; ?>
			<!-- total row end -->
			
			<?php
				// total subject calculating
				// concate subject which assosiate with other means that
				// part one and part two subject like as bangla 1st,bangla2nd
				if($asb->assosciate_with):
					$minus_subj++;
				endif;
				// calculate optional subject
				if($asb->optional):
					$minus_subj++;
				endif;

				endforeach;
				$t_subj = count($all_sub)-$minus_subj;
				$h_grd = $this->mkst->exact_grading(round((($thgrade)/$t_subj),2,PHP_ROUND_HALF_UP));
				$f_grd = $this->mkst->exact_grading(round((($tot_grd)/$t_subj),2,PHP_ROUND_HALF_UP));
				

			?>
			<script type="text/javascript">
				document.getElementById("half_year_grd").innerHTML = '<?php echo $this->mkst->convertToBangla($h_grd); ?>';
				document.getElementById("final_year_grd").innerHTML = '<?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($f_grd);endif; ?>';
			</script>

				<tr>
					<td colspan="2" style="text-align:center;">মোটঃ</td>
					<td><p><?php //echo $this->mkst->convertToBangla($total_ftuto) ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($total_Stuto) ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($ththr); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($thobj); ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($thtotal); ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($thgrade); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($fxmth_tot); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($fxmobj_tot); ?></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($th_fourty); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($obj_fort); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_eighty); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_o); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_twenty_pers); ?></p></td>
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($tot_hnd_pers);endif; ?></p></td>
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($tot_grd);endif; ?></p></td>
				</tr>

				<tr>
					<td colspan="2" style="text-align:center;">জিপিএঃ</td>
					<td><p><?php //echo $this->mkst->convertToBangla($total_ftuto) ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($total_Stuto) ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($ththr); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($thobj); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($thtotal); ?></p></td>
					<td><p><?php echo $this->mkst->convertToBangla($h_grd); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($fxmth_tot); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($fxmobj_tot); ?></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($th_fourty); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($obj_fort); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_eighty); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_o); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_twenty_pers); ?></p></td>
					<td><p><?php //echo $this->mkst->convertToBangla($tot_hnd_pers); ?></p></td>
					<td><p><?php if(!is_null($fxmth)):echo $this->mkst->convertToBangla($f_grd);endif; ?></p></td>
				</tr>
				
				<tr>
					<td colspan="2"><p class="small-font">অর্ধ-বার্ষিক</p></td>
					<td><p class="xx_small-font">শ্রেণির পাঠ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">বাড়ির কাজ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">মনযোগ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">আচারণ</p></td>
					<td colspan="2"></td>
					<td colspan="4"><p class="xx_small-font left-align">শ্রেণি শিক্ষকের স্বাক্ষর :</p></td>
					<td colspan="3"><p class="xx_small-font left-align">প্রধান শিক্ষকের স্বাক্ষর :</p></td>
					<td colspan="2"><p class="xx_small-font left-align">অভিভাবকের স্বাক্ষর</p></td>
					<td colspan="2"><p></p></td>
				</tr>
				<tr>
					<td colspan="2"><p class="small-font">সাংবৎসরিক</p></td>
					<td><p class="xx_small-font">শ্রেণির পাঠ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">বাড়ির কাজ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">মনযোগ</p></td>
					<td colspan="2"></td>
					<td><p class="xx_small-font">আচারণ</p></td>
					<td colspan="2"></td>
					<td colspan="4"><p class="xx_small-font left-align">শ্রেণি শিক্ষকের স্বাক্ষর :</p></td>
					<td colspan="3"><p class="xx_small-font left-align">প্রধান শিক্ষকের স্বাক্ষর :</p></td>
					<td colspan="2"><p class="xx_small-font left-align">অভিভাবকের স্বাক্ষর</p></td>
					<td colspan="2"><p></p></td>
				</tr>
			</table>


			<!-- printing option -->
			<table style="margin-top:10px;" id="printtbl">
				<tr>
					<td colspan="10">
						<button class="btn btn-primary" style="width:100px;height:25px;float:right;" onclick="window.print()" >Print</button>
					</td>
				</tr>
			</table>
			<!-- printing option -->

		</div>
	</body>
</html>