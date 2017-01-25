<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function gettable(){
		$query = $this->db->get('notice');
		return $query->result();
	}
	public function department_check($id){
		$sql=$this->db->query("SELECT * FROM emp_depart_catg WHERE 	edepid='$id'")->row();
		return $sql;
	}
	public function reject_insert($data){
		$sql=$this->db->insert('emp_approved',$data);
		return $sql;
	}
}