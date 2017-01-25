<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Routine_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
	
	public function shift_shidule($w)
	{
		return $this->db->select("*")
		->from("routine_shidule")
		->where($w)
		->order_by("shidule_id","asc")
		->get()
		->result();
	}
	
	public function maximum_period($w)
	{
		return $this->db->select("*")
		->from("maximum_period")
		->where($w)
		->order_by("id","asc")
		->get()
		->row();
	}
	
	public function class_period($w)
	{
		return $this->db->select("*")
		->from("class_period")
		->where($w)
		->order_by("perid","asc")
		->get()
		->row();
	}
	
	public function class_teacher($w)
	{
		return $this->db->select("*")
		->from("class_tehsett")
		->where($w)
		->order_by("ctsid","asc")
		->get()
		->row();
	}
	
	public function class_routine($w)
	{
		return $this->db->select("*")
		->from("routine")
		->where($w)
		->order_by("routineid","asc")
		->get()
		->result();
	}
	
	public function routine_break_test($w)
	{
		return $this->db->select("*")
		->from("routine_shidule")
		->where($w)
		->order_by("shidule_id","asc")
		->get()
		->row();
	}
	
	public function class_routine_report($w)
	{	
		extract($w);
		return $this->db->query("select r.*,s.stime,etime,period_title from routine r,routine_shidule s where s.year='$year' and s.shiftid='$shiftid' and r.shidule_id=s.shidule_id and s.year=r.year and r.shiftid=s.shiftid and r.classid='$classid' and r.section='$section' and r.day='$day'")->result();
	}
	
	public function routine_edit_teacher_exist_test($teacher,$id)
	{
		$wh=array('routineid'=>$id,'teacherid'=>$teacher);
		$routine=$this->db->select("*")->from("routine")->where($wh)->get();
		if($this->db->affected_rows()>0) 
		{
			$info=$routine->row()->routineid;
			if($info==$id) { return true; }
			else { return false; }
		} 
		else 
		{ return true; }
	}
	
	public function subject_explode_array($str)
	{
		$ex=explode(",",$str);
		return $ex;
	}
	
	public function teacher_explode_array($str)
	{
		$ex=explode(",",$str);
		return $ex;
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
	
	public function get_shift_name($sfid)
	{
		return $this->db->select("*")->from("shift_catg")->where("shiftid",$sfid)->get()->row();
	}
	
	
	
	
}
?>