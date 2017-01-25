<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student extends CI_Controller {
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
	
	public function student_attendance()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/student_attendance');
		$this->load->view('footer');
	} 
    
	public function exam_result()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/exam_result');
		$this->load->view('footer');
	}
	
	public function exam_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/exam_routine');
		$this->load->view('footer');
	}
	
	public function student_bill()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/student_bill');
		$this->load->view('footer');
	}
	
	public function student_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/student_notice');
		$this->load->view('footer');
	}
	
	public function sylabas()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/sylabas');
		$this->load->view('footer');
	}
	
	public function dwnlFl(){
		function download(){
		  global $filename, $safeFilename, $downloads;
		 // instruction
		  $dwnlTp=$_GET['t'];
		if($dwnlTp=='s'):
		  $downloads = "../admin/download/syllabus";
		elseif($dwnlTp=='n'):
			$downloads = "../admin/download/notice";
		elseif($dwnlTp=='c'):
			$downloads = "../admin/download/academic calender";
		endif;
		  $safeFilename = '/^\w+\.\w+$/';
		  $filename = $_GET['d'];
			  
			  if (!file_exists($downloads."/".$filename)) {
				echo "file not exists";
				exit;
			  }
			  
			  header("Content-disposition: attachment; filename=".$filename);
			  header("Content-type: application/pdf");
			  $r=readfile($downloads."/".$filename);
			  exit(0);
			}
			download();
	}
	
	public function class_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_perants/class_routine');
		$this->load->view('footer');
	}
	
}