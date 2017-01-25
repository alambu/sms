<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_section extends CI_Controller {
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
		$this->load->model("setting/setting_model","bsetting");
		$this->load->model('student/student_model','student');
	}


	// ----------------student section start-----------------------
	
	
	public function certificate()
	{
	$data=array();
	$data['all_shift']=$this->student->all_shift();	
	if(isset($_POST['card']))
	{
		extract($_POST);
		$where=array('syear'=>$year,'shiftid'=>$asft_re,'classid'=>$acls_re,'section'=>$asec_re,'status'=>1);
		$data['sinfo']=$this->student->student_info_by_admission($where);
	}	
	$this->load->view('header');
	$this->load->view('leftbar');
	$this->load->view('student_section/certificate_home',$data);
	$this->load->view('footer');
	}
	
	//Certificate print start
	public function certificate_print(){
		//$this->load->view('header');
		$this->load->view('student_section/certificate');	
	}
	//Certificate print end
	
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
		$this->load->view('student_section/student_registration',$data);
		
	}
	
	public function student_report()
	{
		$data=array();
		$y=date("Y");
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('student_section/student_report',$data);
	}
	
	
	public function search_option_show()
	{
		extract($_GET);
		$data=array();
		$data['class']=$this->bsetting->class_info($sid);
		$data['all_shift']=$this->student->all_shift();
		$this->load->view('student_section/search_option_show',$data);
	}
	
	
	public function student_log_search()
	{
		$this->load->view('student_section/student_log_search');
	}
	
	public function student_search_bysesion()
	{
		extract($_GET);
		$explode=explode("/",$str);
		$shiftid=$explode[0];
		$syear=$explode[1];
		$data=array();
		$data['sinfo']=$this->student->report_by_session($shiftid,$syear);
		$this->load->view('student_section/student_search_bysesion',$data);
	}
	
	public function student_search_bysection()
	{
		extract($_GET);
		$explode=explode("/",$str);
		$shiftid=$explode[0];
		$syear=$explode[1];
		$classid=$explode[2];
		$sec=$explode[3];
		$data=array();
		$data['sinfo']=$this->student->report_by_section($shiftid,$syear,$classid,$sec);
		$this->load->view('student_section/student_search_bysection',$data);
	}
	
	
	public function student_edit()
	{
		$data=array();
		$data['all_shift']=$this->student->all_shift();
		$data['all_class']=$this->student->all_class();
		$data['all_group']=$this->bsetting->all_group();
		$data['all_parrent']=$this->student->all_parrent();
		extract($_GET);
		$data['sinfo']=$this->student->student_info($sid);
		$this->load->view('student_section/student_edit',$data);
	}
	
	
	public function attendance(){
		$data=array();
		$data['shift_select']=$this->student->all_shift();
		$data['select_cls']=$this->db->get("class_catg")->result();
		if(isset($_POST['entry'])){
		extract($_POST);
		$date=date("Y-m-d");
		$ses=date("Y");
		
		$data['chk_row_atten']=$this->student->attendanc_exist_chk($shift,$class_catg,$section,$date);
		$data['attendance_sheet']=$this->student->section_wise_student($ses,$shift,$class_catg,$section);
		$data['chk_student']=$this->db->affected_rows();
		$data['selected_class']=$this->bsetting->class_info($shift);
		$data['selected_section']=$this->bsetting->section_info($class_catg);
	    }
		//attendance report start
		
		$this->load->view('student_section/attendance',$data);
		
	}
	
	
	public function attendance_details(){
		
		$this->load->view('header');
		//$this->load->view('leftbar');
		$this->load->view('student_section/attendance_details');
		//$this->load->view('footer');
		
	}
	
	public function attendance_edit() {
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/attendance_edit');
		$this->load->view('footer');
	}
	
	public function today_attendance_report()
	{
		extract($_GET);
		$data=array();
		$data['class']=$this->bsetting->class_info($sid);
		$this->load->view("student_section/today_attendance_report",$data);
		
	}
	
	public function registration_details(){
		
		$this->load->view('header');
		//$this->load->view('leftbar');
		$this->load->view('student_section/registration_details');
		//$this->load->view('footer');
		
	}
	
	public function student_log_popup() {
		$this->load->view('header');
		if(isset($_GET['id'])){	
		extract($_GET);	
		$data['stu_log_pop']=$this->db->query("select a.*,b.name,c.class_name,d.shift_N from re_admission a,regis_tbl b ,class_catg c,shift_catg d where a.stu_id='$id' and
		b.stu_id='$id' and a.classid=c.classid and a.shiftid=d.shiftid order by a.readid desc")->result();
		}
		$this->load->view('student_section/student_log_popup',$data);
		$this->load->view('footer');
	}
	
	
	public function admission_cancel()
	{
		$data=array();
		$data['shift_select']=$this->student->all_shift();
		if(isset($_POST['by_roll']))
		{
			extract($_POST);
			$where=array('syear'=>$year,'shiftid'=>$asft_re,'classid'=>$acls_re,'section'=>$asec_re,'roll_no'=>$rol_r,'status'=>1);
			$data['sinfo']=$this->student->student_info_by_admission($where);
		}	
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/admission_cancel',$data);
		$this->load->view('footer');
	}
	
	
	public function send_sms()
	{
		//print_r($_POST);
		extract($_POST);
		$info=$this->db->query("select f.phonen,s.stu_id from father_login f,regis_tbl s where f.parentid=s.parentid and s.stu_id='$hid_stu'")->row();
		$txt=$msg;
		$mobile=$info->phonen;
		
		$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
		file_get_contents($url);
		echo 1;exit;
	}
	
	//<!---------------student section end---------------------->
	
}
