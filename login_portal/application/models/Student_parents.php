<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student_parents extends CI_Model {
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
	
	public function student_info($sid)
	{
		$y=date("Y");
		return $this->db->query("select reg.*,re.* from regis_tbl reg,re_admission re where re.syear='$y' and re.stu_id='$sid' and re.stu_id=reg.stu_id")->row();
	}
	
	
	
	public function get_chield($pid)
	{
		$y=date("Y");
		return $this->db->query("select reg.name,re.*,p.parentid from regis_tbl reg,re_admission re,father_login p where re.syear='$y' and p.parentid='$pid' and reg.parentid=p.parentid and re.stu_id=reg.stu_id and re.status>0")->result();
	}
	
	public function section_info($sid)
	{
		return $this->db->select("*")->from("section_tbl")->where("sectionid",$sid)->get()->row();
	}
	
	public function class_routine($where)
	{
		return $this->db->select("*")->from("routine")->where($where)->get()->result();
	}
	
	public function shidule_info($w)
	{
		return $this->db->select("*")->from("routine_shidule")->where($w)->get()->row();
	}
	
	public function teacher_info($tid)
	{
		return $this->db->select("*")->from("empee")->where("empid",$tid)->get()->row();
	}
	
	public function subject_info($sid)
	{
		return $this->db->query("select sinfo.*,sset.sub_name,short_name from subject_class sinfo,subject_setup sset where sinfo.subsetid=sset.subsetid and sinfo.subjid='$sid'")->row();
	}
	
	public function syllabus($cid)
	{
		return $this->db->select("*")->from("syllabus")->where("classs",$cid)->get()->result();
	}
	
	public function notice()
	{
		return $this->db->select("*")->from("notice")->order_by("id","desc")->get()->result();
	}
	

}
?>