<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_edit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		
	}


	// ----------------student section start-----------------------
	public function application_catg_edit(){
		if(isset($_GET['sts'])){
		extract($_GET);
		$up_date=date("Y-m-d h:i:a");
		$up_user=$this->session->userdata('userid');
		$up=1;
		if($sts==1){
			
			$update=$this->db->query("UPDATE application_catg SET status='0',up_date='$up_date',up_user='$up_user' WHERE appctgid='$id_no'");
			if($update){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect("student_section/level_1_setting","location");
			}
		}
		if($sts==0){
			$update=$this->db->query("UPDATE application_catg SET status='1',up_date='$up_date',up_user='$up_user' WHERE appctgid='$id_no'");
			if($update){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect("student_section/level_1_setting","location");
			}
		}
		
		}
		
		if((isset($_GET['id'])) && (isset($_GET['y']))){
			$this->load->view('header');
			$this->load->view('leftbar');
			$this->load->view('student_section/application_catg_edit');
			$this->load->view('footer');
			
		}
		
		
	}
	
	public function application_form(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/application_form');
		$this->load->view('footer');
	}
	
	public function registration_edit(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/student_edit');
		$this->load->view('footer');
	}
	
	
	public function re_admission(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/re_admission');
		$this->load->view('footer');
	}
	
	public function class_period_setting()
	{	
		$data=array();
		$this->load->view('header');
		$this->load->view('leftbar');
		if(isset($_GET['id'])){
			extract($_GET);
			$data['period']=$this->db->query("select a.*,b.class_name from class_period a,class_catg b  where perid='$id' and a.classid=b.classid")->row();
		}
		$this->load->view('student_section/class_period_edit',$data);
		$this->load->view('footer');
	}
	
	public function class_catg_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_catg_edit');
		$this->load->view('footer');
	}
	
	
	
	
	public function version_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/version_edit');
		$this->load->view('footer');
	}
	
	
	public function subject_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/subject_edit');
		$this->load->view('footer');
	}
	
	public function class_routine_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		if(isset($_GET['id'])){
			$data=array();
			extract($_GET);
			$data['info']=$this->db->query("select a.*,b.class_name,c.shift_N from routine_sett a,class_catg b ,shift_catg c  where a.id='$id' and a.classid=b.classid and a.shiftid=c.shiftid")->row();
		}
		
		$this->load->view('student_section/class_routine_edit',$data);
		$this->load->view('footer');
	}
	
	public function class_routine(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/routine_edit');
		$this->load->view('footer');
	}
	
	
	public function class_tech_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_tech_edit');
		$this->load->view('footer');
	}
	
	public function class_tech_frox_setting(){
		if(isset($_GET['fid'])){
			extract($_GET);
			$up_date=date("Y-m-d h:i:A");
			$up_user=$this->session->userdata('userid');
			$up=1;
			$up1=$this->db->query("update routine set status='0',up_date='$up_date',up_user='$up_user' where routineid='$rid'");
			
			$up2=$this->db->query("update class_froxsett set status='1' ,up_date='$up_date',up_user='$up_user' where froxid='$fid'");
			
			if($up1 && $up2){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location');
			}
			else {
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location');
			}
		}
		
	}
	
	public function attendance(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/attendance');
		$this->load->view('footer');
	}
	
	
	public function attendance_edit(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/attendance_edit');
		$this->load->view('footer');
	}
	
	public function online_status(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/online_status');
		$this->load->view('footer');
	}
	
	public function routine_edit(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/routine_edit');
		$this->load->view('footer');
	}
	
	
	//<!---------------student section end---------------------->
	
	
}

