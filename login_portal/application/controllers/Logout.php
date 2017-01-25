<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller {

	public function index(){

		$id = $this->session->userdata('lidcheck');
		$sId = $this->session->userdata('sId');
		$type = $this->session->userdata('ltype');

		if($type == 1):
			$upTbl = "fstu_login";
			$w = array(
					"stu_id" => $id
				);

		elseif($type == 2):
			$upTbl = "father_login";
			
			$w = array(
				"parentid" => $id
			);
		elseif($type == 3):
			$upTbl = "emp_login";
			
			$w = array(
				"empid" => $id
			);
		endif;

		$data=array(
				"status" => 0,
				"sId" => ''
			);

		$this->db->where($w);
		$this->db->update($upTbl,$data);		
		
		$this->session->sess_destroy();
		redirect('login?t='.$type,'location');	
	}

}

