<?php 

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class employee_delete  extends CI_Controller {
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
	}
	
	//-------------------------employee section start here------------------
	
	public function delete_employee(){
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from empee where id='$id'");
			if($delete){
			
				redirect('employee_reports/employee_report','location');
			}
		}
		
		
	}
	
		public function delete_employee_salary(){
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from emp_salary_his where id='$id'");
			if($delete){
			
				redirect('employee_reports/employee_salary_report','location');
			}
		}
		
		
	}
	
	
		public function delete_leave_report(){
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from emp_reqlev where reqid='$id'");
			if($delete){
			
				redirect('employee_reports/employee_leave_report','location');
			}
		}
		
		
	}
	
	
	
	public function delete_employee_vacancy(){
		
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from emp_vacancy where vanid='$id'");
			if($delete){
			
				redirect('employee_reports/employee_vacancy_report','location');
			}
		}
		
		
	}
	
	
		public function delete_employee_attendance(){
		
		
		if(isset($_GET['id'])){
			$id=$_GET['id'];
			$delete=$this->db->query("delete from emp_attendance where empid='$id'");
			if($delete){
			
				redirect('employee_reports/employee_attendance_report','location');
			}
		}
	}
	
	
	
	
	}
	
	?>