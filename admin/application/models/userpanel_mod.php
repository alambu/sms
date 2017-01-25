<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class userpanel_mod extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function userReginsert($data){
		$status=$this->db->insert('user_reg',$data);
		return $status;
	}
	public function upschoolprofile($data){
		$this->db->where('id',$data['id']);
        $status=$this->db->update('sprofile',$data);	
		return $status;
	}
	public function editReginsert($data){
		$this->db->where('userid',$data['userid']);
        $status=$this->db->update('user_reg',$data);	
		return $status;
	}
}
?>