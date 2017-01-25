<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class student_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
	
	public function all_insert($tbl,$data)
	{
		$insert=$this->db->insert($tbl,$data);
		if($insert) { return true; } else { return false; }
	}
	
	public function all_update($where,$tbl,$data)
	{
		$this->db->where($where);
		$up=$this->db->update($tbl,$data);
		if($up) { return true; } else { return false; }
	}
	
	public function all_delete($tbl,$clm,$id)
	{
		$del=$this->db->query("delete from $tbl where $clm='$id'");
		if($del) { return true; } else { return false; }
	}
	
	public function all_group()
	{
		return $this->db->select("*")->from("group_setup")->get()->result();
	}
	
	
	public function roll_no_exist_chk($cls,$sft,$year,$roll,$sec)
	{
		$this->db->query("select * from re_admission where classid='$cls' and shiftid='$sft' and syear='$year' and roll_no='$roll' and section='$sec' and status>0");
		return $this->db->affected_rows();
	}
	
	public function group_detact_test($id)
	{
		return $this->db->query("select groupid from section_tbl where sectionid='$id'")->row()->groupid;
	}
	
	
	public function parrent_id_test($id)
	{
	$this->db->query("select * from father_login where parentid='$id' limit 1");
	return $this->db->affected_rows();
	}
	
	
	public function student_id_test($id)
	{
	$this->db->query("select * from regis_tbl where stu_id='$id' limit 1");
	return $this->db->affected_rows();
	}
	
	public function all_parrent()
	{
		return $this->db->select("*")->from("father_login")->get()->result();
	}
	
	public function all_shift()
	{
		return $this->db->get("shift_catg")->result();
	}
	
	
	public function report_by_session($sft,$year)
	{
		return $this->db->query("select re.*,reg.name,picture,cls.class_name,sft.shift_N from re_admission re,regis_tbl reg,class_catg cls,shift_catg sft where re.syear='$year' and re.shiftid='$sft' and re.stu_id=reg.stu_id and cls.classid=re.classid and re.shiftid=sft.shiftid and re.status>0 order by re.roll_no asc")->result(); 
	}
	
	public function all_class()
	{
		return $this->db->get("class_catg")->result();
	}
	
	
	public function report_by_section($sft,$year,$classid,$section)
	{
		if($section=='all')
		{	
		return $this->db->query("select re.*,reg.name,picture,cls.class_name,sft.shift_N from re_admission re,regis_tbl reg,class_catg cls,shift_catg sft where re.syear='$year' and re.shiftid='$sft' and re.classid='$classid' and re.stu_id=reg.stu_id and cls.classid=re.classid and re.status>0 and  re.shiftid=sft.shiftid order by re.roll_no asc")->result();
		}
		else 
		{
		return $this->db->query("select re.*,reg.name,picture,cls.class_name,sft.shift_N from re_admission re,regis_tbl reg,class_catg cls,shift_catg sft where re.syear='$year' and re.shiftid='$sft' and re.classid='$classid' and re.section='$section' and re.stu_id=reg.stu_id and cls.classid=re.classid and re.status>0 and re.shiftid=sft.shiftid order by re.roll_no asc")->result();	
		}
	}
	
	public function student_info($sid)
	{
		$y=date("Y");
		return $this->db->query("select reg.*,re.* from regis_tbl reg,re_admission re where re.syear='$y' and re.stu_id='$sid' and re.stu_id=reg.stu_id")->row();
	}
	
	public function student_info_by_session($sid,$y)
	{
		return $this->db->query("select reg.*,re.* from regis_tbl reg,re_admission re where re.syear='$y' and re.stu_id='$sid' and re.stu_id=reg.stu_id")->row();
	}
	
	public function roll_no_exist_chk_byedit($cls,$sft,$year,$roll,$sec,$sid)
	{
		$query=$this->db->query("select * from re_admission where classid='$cls' and shiftid='$sft' and syear='$year' and stu_id='$sid' and section='$sec' and status>0 limit 1");
		if($this->db->affected_rows()==0)
		{
			return 0;
		}
		else 
		{
			$exist_roll=$query->row()->roll_no;
			if($exist_roll!=$roll)
			{
				return 1;
			}
			else 
			{
				return 0;
			}
		}
	}
	
	public function attendanc_exist_chk($sft,$cls,$sec,$date)
	{
		$this->db->query("select * from attendance where shiftid='$sft' and classid='$cls' and section='$sec' and date='$date'");
		return $this->db->affected_rows();
	}
	
	
	public function section_wise_student($session,$sft,$cls,$sec)
	{
		return $this->db->query("select re.*,reg.name,picture from re_admission re,regis_tbl reg where re.stu_id=reg.stu_id and re.syear='$session' and re.classid='$cls' and re.shiftid='$sft' and re.section='$sec' and re.status>0")->result();
	}
	
	public function daily_attendance_edit_sheet($sft,$cls,$sec,$date)
	{
		return $this->db->query("select * from attendance where shiftid='$sft' and classid='$cls' and section='$sec' and date='$date'")->row();
	}
	
	
	public function shift_info($sid)
	{
		return $this->db->query("select * from shift_catg where shiftid='$sid'")->row();
	}
	
	public function get_total_student($where) 
	{
		return $this->db->select("count(readid)as total_student")->from("re_admission")->where($where)->get()->row()->total_student;
	}
	
	public function mounthly_attendance($w)
	{
		return $this->db->select("*")->from("attendance")->where($w)->get()->result();
	}
	
	public function gardian_info($w)
	{
		return $this->db->select("*")->from("father_login")->where($w)->get()->row();
	}
	
	public function student_info_by_admission($w)
	{
		return $this->db->select("*")->from("re_admission")->where($w)->get()->result();
	}
	
	public function get_student_details($stuid)
	{
		return $this->db->select("*")->from("regis_tbl")->where("stu_id",$stuid)->get()->row();
	}
	
	public function get_class_details($cid)
	{
		return $this->db->select("*")->from("class_catg")->where("classid",$cid)->get()->row();
	}
	
	public function get_section_details($sid)
	{
		return $this->db->select("*")->from("section_tbl")->where("sectionid",$sid)->get()->row();
	}
	
	
	public function student_book_status($sid)
	{
		return $this->db->query("select lis.bookN,bc.book_id,dis.*,reg.name from book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg where reg.stu_id='$sid' and dis.stu_id='$sid' and dis.status='1' and dis.book_id=bc.book_id and bc.blist_id=lis.blist_id")->result();
	}
	
	public function student_account_status($sid)
	{
		return $this->db->select("*")->from("student_account")->where("stu_id",$sid)->get()->row();
	}
	
}
?>