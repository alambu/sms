<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_delete extends CI_Controller {
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
	}
	// ----------------student section start-----------------------
	public function application_catg_delete(){
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$app_name=$_GET['app_name'];
			$delete=$this->db->query("delete from application_catg where appctgid='$id'");
			if($delete){
				$d=array(
				'c'=>$app_name
				);
				$this->session->set_userdata($d);
				redirect('student_report/application_catg_report','location');
			}
		}
		
		
	}
	
	public function version_delete(){
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from version_catg where verid='$id'");
			if($delete){
				$info=array(
				'd'=>1
				);
				$this->session->set_userdata($info);
				redirect("student_report/version_setting","location");
			}
		}
		
		
	}
	
	public function class_tech_delete(){
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from class_tehsett where ctsid='$id'");
			if($delete){
				$info=array(
				'd'=>1
				);
				$this->session->set_userdata($info);
				redirect("student_report/class_tech_setting","location");
			}
		}
		
		
	}
	
	public function subject_delete(){
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from subject_class where subjid='$id'");
			if($delete){
				$info=array(
				'd'=>1
				);
				$this->session->set_userdata($info);
				redirect("student_report/subject_setting","location");
			}
		}
		
		
	}
	

	//------------------ End Employee Section------------------------------>
}

