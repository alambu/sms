<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_report extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model('admin_model','n');
		$this->load->model('student','report');

		
		
	}


	// ----------------student section start-----------------------
	
	
	
	
	public function application_details(){
		
		//$this->load->view('header');
		//$this->load->view('leftbar');
		$this->load->view('student_section/application_details');
		//$this->load->view('footer');
		
	}
	
	
	public function student_log(){
		$data=array();
		
		$this->load->view('student_section/student_log',$data);
		
	}
	
	
	
	
	
	
	public function  view_class_routine(){
		//$this->load->view('header');
		$this->load->view('student_section/view_class_routine');
		
	}
	
	
	
	
	// ------------------------Start Employee Section-------------------------------->
	
	//------------------ End Employee Section------------------------------>
}

