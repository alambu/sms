<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logout extends CI_Controller {

	public function index()
	{
		$id=$this->session->userdata('userid');
		$sId=$this->session->userdata('sId');
		
		$w=array(
			"userid"=>$id,
			"sId"=>$sId
		);
		
		$data=array(
			"status"=>0,
			"sId"=>''
		);		
		$this->db->where($w);
		$this->db->update("user_reg",$data);		
		$this->session->sess_destroy();
		redirect('login?id=3','location');	
	}

}

