<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_model extends CI_Model {
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
	
	public function all_emptype()
	{
		return $this->db->select("*")->from("emp_type")->get()->result();
	}
	
	public function all_designation()
	{
		return $this->db->select("*")->from("employee_catg")->get()->result();
	}
	
	public function all_emplevetype()
	{
		return $this->db->select("*")->from("emp_levtype")->get()->result();
	}
	
	public function emp_setting_delete_test($tbl,$clm,$id)
	{
		$this->db->query("select * from $tbl where $clm='$id'");
		return $this->db->affected_rows();
	}
	
	public function all_department()
	{
		return $this->db->get("emp_depart_catg")->result();
	}
	
	public function unique_subject()
	{
		return $this->db->get("subject_setup")->result();
	}
	
	public function employee_list($w)
	{
		return $this->db->select("*")->from("empee")->where($w)->order_by("emptypeid","asc")->get()->result();
	}
	
	public function day_attendance($date,$typ)
	{
		return $this->db->query("select * from emp_attendance where atendate='$date' and emptypeid='$typ'")->row();
	}
	
	public function type_wise_employee ($typid)
	{
		return $this->db->query("select * from empee  where emptypeid='$typid' and status='1'")->result();
	}
	
	public function total_attendance($d)
	{
		return $this->db->query("select * from emp_attendance where atendate='$d'")->result();
	}
	
	public function employee_info($eid)
	{
		return $this->db->query("select e.*,d.manage_type,s.sub_name,des.emp_type from empee e, emp_depart_catg d, subject_setup s,employee_catg des where e.empid='$eid' and e.subject=s.subsetid and e.department=d.edepid and des.ecatgid=e.deginition")->row();
	}
	
	public function all_teacher()
	{
		$where=array('emptypeid'=>1,'status'=>1);
		return $this->db->select("*")->from("empee")->where($where)->get()->result();
	}
	
	
	
}
?>