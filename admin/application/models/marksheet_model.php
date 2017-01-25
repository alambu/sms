<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marksheet_model extends CI_Model {
   function __construct(){
		parent::__construct();
		
	}


	// single student information
	function single_std_info( $shift,$class,$section,$roll ){
		return $this->db->query("SELECT r.stu_id,r.name,r.gender,c.class_name FROM regis_tbl r,class_catg c WHERE r.stu_id = ( SELECT stu_id FROM re_admission WHERE shiftid='$shift' AND classid='$class' AND section='$section' AND roll_no='$roll'  ) AND c.classid='$class'")->row();
	}

	// total student of this class this year
	function total_student_this_year( $class,$shift,$section,$year ){
		$data = array(
			"classid" => $class,
			"shiftid" => $shift,
			"section" => $section,
			"syear"	  => $year
		);
		return $this->db->from("re_admission")->where($data)->get()->num_rows();
	}

	// grade testing
	function getGrading( $mark ){
		$grd = $this->db->query("SELECT grade_N,grade_point FROM exm_grade WHERE mark_from <= round($mark) AND mark_upto >= round($mark)")->row();
		return $grd->grade_point;
	}

	// half year total attendance
	function half_year_t_attend( $year ){
		$hfd = $year."-01-01";
		$hld = $year."-06-30";
		
		return $this->db->select('stu_id')->from("attendance")->where("date(`date`) >=",date($hfd))->where("date(`date`) <=",date($hld))->get();
	}

	// final year total attendance
	function final_year_t_attend( $year ){
		$ffd = $year."-07-01";
		$fld = $year."-12-31";
		
		return $this->db->from("attendance")->where("date(`date`) >=",date($ffd))->where("date(`date`) <=",date($fld))->get();
	}

	// student attendance
	function stuedent_att( $hinfo,$stu_id ){
		// student present
		$tmp = "";
		foreach( $hinfo as $hta ):
			$tmp .= $hta->stu_id.",";
		endforeach;
		
		$tmp_t_a = explode(",", $tmp);
		
		// array count value
		$h_arr_count = array_count_values($tmp_t_a);
		return $h_arr_count[$stu_id];
	}

	// all subject name get
	function all_subject( $class ){
		return $this->db->select("*")->from("subject_class")->where("classid",$class)->get()->result();
	}

	// group name
	function group_name( $group_name ){
		$grp_nm = strtolower($group_name);
		if( $grp_nm == 'science' ):
			$dept = "বিজ্ঞান";
		elseif( $grp_nm == 'huminities' ):
			$dept = "মানবিক";
		elseif( $grp_nm == 'commers' ):
			$dept = "বাণিজ্য";
		endif;

		return $dept;
	}

	// bangla writing of class name
	function banglaString($bnStr){
		
		$bnWrt = array(
				"one" => 'প্রথম',
				"two" => 'দ্বিতীয়',
				"three" => 'তৃতীয়',
				"four" => 'চতুর্থ',
				"five" => 'পঞ্চম',
				"six" => 'ষষ্ঠ',
				"seven" => 'সপ্তম',
				"eight" => 'অষ্টম',
				"nine" => 'নবম',
				"ten" => 'দশম'
			);

		$str = strtolower($bnStr);
		return $bnWrt[$str];
	}

	// bangla convert number
	function convertToBangla( $digit ){
		$banglaDigit = array(
			"1" => '১',
			"2" => '২',
			"3" => '৩',
			"4" => '৪',
			"5" => '৫',
			"6" => '৬',
			"7" => '৭',
			"8" => '৮',
			"9" => '৯',
			"0" => '০',
			"." => '.'
		);
		
		$digitSplit = str_split( $digit );

		$convDigit = '';
		for($i=0;$i<count($digitSplit);$i++){
			$convDigit .= $banglaDigit[$digitSplit[$i]];
		}

		return $convDigit;

	}

	// last two tutorial marks
	function last_two_tutorial( $class,$section,$shift,$subj,$stu_id,$year ){
		return $this->db->query("SELECT * FROM exm_markother WHERE classid='$class' AND section='$section' AND shift='$shift' AND subjid='$subj' AND stu_id='$stu_id' AND othexmid IN (SELECT othexmid FROM exm_othercatg WHERE xm_year='$year' ORDER BY othexmid DESC)")->result();
	}

	// half yearly exam
	function half_yearly_xm( $shift,$class,$section,$roll,$subjid ){
		return $this->db->query("SELECT * FROM mark_add m,exm_catg p WHERE m.exmid=(SELECT c.exm_ctgid FROM exm_namectg e,exm_catg c WHERE e.exmnid=c.exmnid AND e.exmnid=(SELECT exmnid FROM exm_namectg ORDER BY exmnid ASC LIMIT 1) ORDER BY c.exm_ctgid DESC LIMIT 1) AND m.subjid='$subjid' AND shift='$shift' AND classid='$class' AND section='$section' AND roll_no='$roll' ORDER BY m.id DESC LIMIT 1")->row();
	}

	// final exam
	function final_xm( $shift,$class,$section,$roll,$subjid ){
		return $this->db->query("SELECT * FROM mark_add m,exm_catg p WHERE m.exmid=(SELECT c.exm_ctgid FROM exm_namectg e,exm_catg c WHERE e.exmnid=c.exmnid AND e.exmnid=(SELECT exmnid FROM exm_namectg ORDER BY exmnid DESC LIMIT 1) ORDER BY c.exm_ctgid DESC LIMIT 1) AND m.subjid='$subjid' AND shift='$shift' AND classid='$class' AND section='$section' AND roll_no='$roll' ORDER BY m.id DESC LIMIT 1")->row();
	}

	// chcek final exam by ctgid
	function final_exam( $ctgid ){
		// find exam name id
		$find_xm_id = $this->db->query("SELECT * FROM exm_namectg WHERE exmnid=(SELECT exmnid FROM exm_catg WHERE exm_ctgid='$ctgid')")->row()->exmnid;
		// get final exam id
		$final_xm_id = $this->db->select("*")->from("exm_namectg")->order_by("exmnid","DESC")->limit(1)->get()->row()->exmnid;
		// checking
		if( $final_xm_id == $find_xm_id ):
			return true;
		else:
			return false;
		endif;
	}

	// get shift id
	function get_shift(){
		return $this->db->get("shift_catg")->result();
	}

	// if assosicate or not
	function test_assosiate_subj( $sbid ){
		$data = array(
				"assosciate_with" => $sbid
			);

		$assosiate = $this->db->get_where("subject_class",$data)->num_rows();
		if($assosiate):
			return true;
		else:
			return false;
		endif;
	}

	// assosiate with or not
	function assosiate_with( $sbid ){
		$data = array(
				"subjid" => $sbid
			);
		$assos = $this->db->get_where("subject_class",$data)->row();
		if($assos->assosciate_with):
			return true;
		else:
			return false;
		endif;
	}

	// grading last digit after dicimal point
	function exact_grading( $point ){
		$exmp = str_split($point);
		if(count($exmp) < 4):
			return $point."0";
		else:
			return $point;
		endif;
	}

}