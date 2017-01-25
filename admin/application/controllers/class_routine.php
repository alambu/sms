<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class class_routine extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			//redirect('login?error=3','location');
		}
		$this->load->model('admin_model','n');
		$this->load->model("setting/setting_model","bsetting");
		$this->load->model('student/student_model','student');
		$this->load->model('employee/employee_model','employee');
		$this->load->model('class_routine/routine_model','routine');
	}

	
	public function setting() {
		$data=array();
		$y=date("Y");
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('class_routine/setting',$data);
		
	}
	
	public function routine()
	{
		$data=array();
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('class_routine/routine',$data);
	}
	
	public function section_routine_show()
	{
		$data=array();
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('class_routine/section_routine_show',$data);
	}
	
	public function section_routine_show_edit()
	{
		$data=array();
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('class_routine/section_routine_show_edit',$data);
	}
	
	public function routine_list()
	{
		$data=array();
		extract($_GET);
		$data['class']=$this->bsetting->class_info($sid);
		$this->load->view('class_routine/routine_list',$data);
	}
	
	public function view_class_routine()
	{
		$this->load->view('class_routine/view_class_routine');
	}

}
?>