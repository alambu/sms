<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function exmname($id){
		$sqlexm=$this->db->SELECT('exm_name')->FROM('exm_namectg')->where('exmnid',$id)->get()->row();
		return $sqlexm;
	}
}
?>