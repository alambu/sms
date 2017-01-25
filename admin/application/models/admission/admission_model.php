<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admission_model extends CI_Model {
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

	public function application_fee()
	{
		return $this->db->select("*")->from("application_fee")->get()->row();
	}
	
	public function all_shift()
	{
		return $this->db->select("*")->from("shift_catg")->get()->result();
	}
	
	public function class_info($sft)
	{
		return $this->db->select("*")->from("class_catg")->where("shiftid",$sft)->get()->result();
	}
	
	
	public function admission_fee_info($w)
	{
		return $this->db->select("*")->from("admission_fee")->where($w)->get()->row();
	}
	
	public function application_list($w)
	{
		return $this->db->select("*")->from("application_tbl")->where($w)->get()->result();
	}
	
	public function get_class_info($cid)
	{
		return $this->db->select("*")->from("class_catg")->where('classid',$cid)->get()->row();
	}
	
	public function application_list_bydate($sd,$ed)
	{
		return $this->db->query("select * from application_tbl where date(e_date) between '$sd' and '$ed'")->result();
	}
	
	public function get_shift_info($sid)
	{
		return $this->db->select("*")->from("shift_catg")->where('shiftid',$sid)->get()->row();
	}
	
	public function applicant_info($w)
	{
		return $this->db->select("*")->from("application_tbl")->where($w)->get()->row();
	}

}
?>