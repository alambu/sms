<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admission_section  extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model('admission/admission_model','admission');
		$this->load->model("setting/setting_model","bsetting");
		$this->load->model('student/student_model','student');
	}
	
	
	public function setting()
	{
		$data=array();
		$data['fee_info']=$this->admission->application_fee();
		$data['all_shift']=$this->admission->all_shift();
		$this->load->view('header');
		$this->load->view('leftbar');
	    $this->load->view('admission/setting',$data);
		$this->load->view('footer');
	}
	
	public function admission()
	{
		$data=array();
		$data['all_shift']=$this->admission->all_shift();
		
		//applicant list by date start
		extract($_POST);
		if(isset($_POST['by_date'])) 
		{
			
		if(empty($appid) && empty($sdate) && empty($edate))
		{
			
		}
		
		elseif(empty($sdate) && empty($edate))
		{
			$where=array('appid'=>$appid);
			$data['apinfo']=$this->admission->application_list($where);
		}
		
		elseif(empty($sdate))
		{
			$where=array('date(e_date)'=>$edate);
			$data['apinfo']=$this->admission->application_list($where);
		}
		
		elseif(empty($edate))
		{
			$where=array('date(e_date)'=>$sdate);
			$data['apinfo']=$this->admission->application_list($where);
		}
		
		else 
		{
			$data['apinfo']=$this->admission->application_list_bydate($sdate,$edate);
		}
			
		}
		
		else 
		{
			$where=array('year(e_date)'=>$year,'classid'=>$cls);
			$data['apinfo']=$this->admission->application_list($where);
		}
		
		$this->load->view('header');
		$this->load->view('leftbar');
	    $this->load->view('admission/admission',$data);
		$this->load->view('footer');
	}
	
	public function application_details(){
		$this->load->view("admission/application_details");
	}
	
	public function student_registration(){
		$data=array();
		$y=date("Y");
		$data['shift_list']=$this->db->get("shift_catg")->result();
		$data['class']=$this->db->get("class_catg")->result();
		$data['version_list']=$this->db->get("version_catg")->result();
		$data['all_group']=$this->bsetting->all_group();
		$data['all_parrent']=$this->student->all_parrent();
		if(isset($_GET['sft'])){
			extract($_GET);$con=count($_GET);
			if($con==2){
			//	echo "shift and class";
				$data['stu_info']=$this->db->query("select a.*,b.name,b.picture,c.class_name,d.shift_N from re_admission a,regis_tbl b,class_catg c,shift_catg d where
				a.syear='$y' and a.shiftid='$sft'  and a.classid='$cls' and a.shiftid=d.shiftid and a.classid=c.classid and a.stu_id=
				b.stu_id")->result();
			}
			elseif($con==3){
				//echo "shift and class and section";
				$data['stu_info']=$this->db->query("select a.*,b.name,b.picture,c.class_name,d.shift_N from re_admission a,regis_tbl b,class_catg c,shift_catg d where
				a.syear='$y' and a.shiftid='$sft'  and a.classid='$cls'  and a.section='$sec' and a.shiftid=d.shiftid and a.classid=c.classid and a.stu_id=
				b.stu_id")->result();
			}
		}
		elseif(isset($_GET['ses'])){
			extract($_GET);
			$data['stu_info']=$this->db->query("select a.*,b.name,b.picture,c.class_name,d.shift_N from re_admission a,regis_tbl b,class_catg c,shift_catg d where
			a.syear='$ses' and a.shiftid='$ses_sft' and  a.shiftid=d.shiftid and a.classid=c.classid and a.stu_id=
			b.stu_id")->result();
		}
		extract($_GET);
		$where=array('appid'=>$appid);
		$data['appinfo']=$this->admission->applicant_info($where);
		$this->load->view('admission/student_registration',$data);
		
	}
	
	
}
	
?>