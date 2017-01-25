<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function gettable(){
		$query = $this->db->get('notice');
		return $query->result();
	}
	public function classname($stuid){
		$query=$this->db->query("SELECT * FROM re_admission WHERE stu_id='$stuid' order by readid DESC limit 1");
		$row=$query->row();
		return $row;
		
	}
	
	public function student_log($stuid){
		$query=$this->db->query("SELECT * FROM re_admission WHERE stu_id='$stuid' order by readid DESC");
		$row=$query->num_rows();
		if($row>0){
		$result=$query->result();
		return $result;
		}
		else {
			return 0;
		}
	}
	
	public function class_teacher($y){
		$q=$this->db->query("select * from class_tehsett where years='$y' order by ctsid desc ")->result();
		return $q;
	}
}