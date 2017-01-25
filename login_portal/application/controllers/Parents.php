<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class parents extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$typeckd=$this->session->userdata('ltype');
		$id=$this->session->userdata('lidcheck');
		$sId=$this->session->userdata('sId');
		if($typeckd=='' || $id=='' || $sId=='') { redirect('login','location'); }	
		$this->load->model('student_parents','stu_parensts');
	}
		
	public function index()
	{

		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('content');
		$this->load->view('footer');
	}

	
	
}