<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper("url");
		$this->load->library("pagination");
		$this->load->model("websitetools","webTool");
	}

	public function index()
	{	
		// get school information
		$spro=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();

		$data = array();
		$data['title']=$spro->schoolN;
		$this->load->view('header',$data);
		$this->load->view('slide');
		$this->load->view('content');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	
		public function about()
	{
		$data = array();
		$data['title']='About';
		$this->load->view('header',$data);
		$this->load->view('content_page/about');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	public function history()
	{
		$data = array();
		$data['title']='History';
		$this->load->view('header',$data);
		$this->load->view('content_page/history');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function teachers_info()
	{
		$data = array();
		$config = array();
		
		// pagination start
        $config["base_url"] = base_url() . "home/teachers_info";
        $config["total_rows"] = $this->webTool->allTeacherRecordCount();
        $config["per_page"] = 4;
        $config["uri_segment"] = 3;
        
        $config['full_tag_open'] = '<p style="text-align:center;">';
        $config['full_tag_close'] = '</p>';

        $config['num_tag_open'] = '<button class="btn btn-sm btn-default">';
        $config['num_tag_close'] = '</button>';

        $config['prev_tag_open'] = '<button class="btn btn-default">';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_close'] = '</button>';
        
        $config['next_tag_open'] = '<button class="btn btn-default">';
        $config['next_link'] = 'Next';
        $config['next_tag_close'] = '</button>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["allThr"] = $this->webTool->
            teacherInfo($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        // pagination end

		
		$data['title']='Teacher Information';
		$this->load->view('header',$data);
		$this->load->view('content_page/teachers_info');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function students_info()
	{
		$data = array();
		$data['title']='Students Information';
		$this->load->view('header',$data);
		$this->load->view('content_page/students_info');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function stuff_info()
	{   
	    $data = array();
		$data['title']='Stuff Information';
		$this->load->view('header',$data);
		$this->load->view('content_page/stuff_info');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	
	public function rules_regulation()
	{   
	    $data = array();
		$data['title']='Rules & Regulation';
		$this->load->view('header',$data);
		$this->load->view('content_page/rules_regulation');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function facility()
	{
		$data = array();
		$data['title']='Facility';
		$this->load->view('header',$data);
		$this->load->view('content_page/facility');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function infrastructure()
	{
		$data = array();
		$data['title']='Infrastructure';
		$this->load->view('header',$data);
		$this->load->view('content_page/infrastructure');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
// academic calender
	public function academicCal(){
		$data = array();
		$data['title']='Academic Calender';
		$this->load->view('header',$data);
		$this->load->view('content_page/academicCal');
		$this->load->view('right_content');
		$this->load->view('footer');	
	}

	public function vacancy()
	{
		$data = array();
		$data['title']='vacancy';
		$this->load->view('header',$data);
		$this->load->view('content_page/vacancy');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function science()
	{
		$data = array();
		$data['title']='Science';
		$this->load->view('header',$data);
		$this->load->view('content_page/science');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function humanities()
	{
		$data = array();
		$data['title']='Humanities';
		$this->load->view('header',$data);
		$this->load->view('content_page/humanities');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function students_registration()
	{
		$data = array();
		$data['title']='Students Registration';
		$this->load->view('header',$data);
		$this->load->view('content_page/students_registration');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function business_studies()
	{
		$data = array();
		$data['title']='Business Studies';
		$this->load->view('header',$data);
		$this->load->view('content_page/business_studies');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function gallery()
	{
		$data = array();
		$data['title']='gallery';
		$this->load->view('header',$data);
		$this->load->view('content_page/gallery');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function gallery_details()
	{
		$data = array();
		$data['title']='gallery';
		$this->load->view('header',$data);
		$this->load->view('content_page/gallery_details');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	// public function academic_exam_result()
	// {
	// 	$data = array();
	// 	$data['title']='Academic Exam Result';
	// 	$this->load->view('header',$data);
	// 	$this->load->view('content_page/academic_exam_result');
	// 	$this->load->view('right_content');
	// 	$this->load->view('footer');
	// }
	
	public function admission_exam_result()
	{
		$data = array();
		$data['title']='Admission Exam Result';
		$this->load->view('header',$data);
		$this->load->view('content_page/admission_exam_result');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
		
		public function library_info()
	{
		$data = array();
		$data['title']='Library Information';
		$this->load->view('header',$data);
		$this->load->view('content_page/library_info');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function book_list()
	{
		$data = array();
		$data['title']='Book list';
		$this->load->view('header',$data);
		$this->load->view('content_page/book_list');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function adventure_books()
	{
		$data = array();
		$data['title']='Adventure Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/adventure_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function comedy_books()
	{
		$data = array();
		$data['title']='Comedy Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/comedy_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function historical_books()
	{
		$data = array();
		$data['title']='Historical Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/historical_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function literature_books()
	{
		$data = array();
		$data['title']='Literature Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/literature_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function mathematical_books()
	{
		$data = array();
		$data['title']='Mathematical Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/mathematical_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function religion_books()
	{
		$data = array();
		$data['title']='Religion Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/religion_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function science_fiction_books()
	{
		$data = array();
		$data['title']='Science Fiction Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/science_fiction_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function story_books()
	{
		$data = array();
		$data['title']='Story Books';
		$this->load->view('header',$data);
		$this->load->view('content_page/story_books');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function photo_gallery()
	{
		$data = array();
		$data['title']='Photo Gallery';
		$this->load->view('header',$data);
		$this->load->view('content_page/photo_gallery');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
public function albumDetails(){
		$data['title']='Photo Details';
		$this->load->view('header',$data);
		$this->load->view('content_page/albumPhotoDetails');
		$this->load->view('right_content');
		$this->load->view('footer');
}


public function selected_class()
	{
	
			extract($_POST);
			$array_cls=array();
			$array_id=array();
			$select=$this->db->query("select * from class_catg where shiftid='$sft_id'")->result();
			foreach($select as $v){
				
				array_push($array_cls,$v->class_name);
				array_push($array_id,$v->classid);
				
			}
			$cls=implode($array_cls,",");
			$cid=implode($array_id,",");
			echo $cls."#".$cid;
	}
	


public function admission_info()
	{
		$data = array();
		$data['title']='Admission Information';
		$this->load->view('header',$data);
		$this->load->view('content_page/admission_info');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function application_form()
	{
		$data = array();
		$data['title']='Application Form';
		$this->load->view('header',$data);
		$this->load->view('content_page/application_form');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

// this is application form action 
public function applicationAction(){
		$sname=$this->input->post('sname');
		$mname=$this->input->post('mname');
		$fname=$this->input->post('fname');
		$class_name=$this->input->post('class_name');
		$email=$this->input->post('email');
		$gpac=$this->input->post('gpaC');
		$inst_name=$this->input->post('schoName');
		$gender=$this->input->post('gender');
		$religion=$this->input->post('religion');
		$blood_grou=$this->input->post('blood_grou');
		$pre_address=$this->input->post('pre_address');
		$par_address=$this->input->post('par_address');
		$city=$this->input->post('city');
		$phone=$this->input->post('phone');
		$pob=$this->input->post('pob');
		$dob=$this->input->post('dob');
		$picture=$this->input->post('picture');
		$pic=$_FILES['picture']['name'];
		$tmp_name=$_FILES['picture']['tmp_name'];
		$r=rand(1000,9000);
		$sr=substr($r,0,4);
		$yemp=date("Y");$m=date("m");
		$appid=$yemp.$m.$sr;
		$today=date('Y-m-d H:i:s');
		$e_user=$this->session->userdata('userN');
		
		//validation start
		
		if(trim($sname)=='') { echo "Applicant Name is Empty";exit; }	
		if(trim($mname)=='') { echo "Mother Name is Empty";exit; }	
		if(trim($fname)=='') { echo "Fother Name is Empty";exit; }	
		if(trim($class_name)=='') { echo "Class Name is Empty";exit; }	
		if(trim($gender)=='') { echo "Gender is Empty";exit; }	
		if(trim($religion)=='') { echo "Religion is Empty";exit; }	
		if(trim($blood_grou)=='') { echo "Blood Group is Empty";exit; }	
		if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }	
		if(trim($par_address)=='') { echo "Permanent Address is Empty";exit; }	
		if(trim($city)=='') { echo "City is Empty";exit; }	
		if(trim($pob)=='') { echo "Place Of Birth is Empty";exit; }	
		if(trim($dob)=='') { echo "Birth Day is Empty";exit; }	
		if(trim($pic)=='') { echo "Picture is Empty";exit; }	
		
		//validation end
		
		$des="admin/img/student_section/application_form/".$pic;	
		$tmp_name=$_FILES['picture']['tmp_name'];
		copy($tmp_name,"admin/img/student_section/application_form/$pic");
		
		$data=array(
			'appid'=>$appid,
			'classid'=>$class_name,
			'name'=>$sname,
			'fName'=>$fname,
			'mName'=>$mname,
			'Phone_n'=>$phone,
			'email'=>$email,
			'gpa'=>$gpac,
			'pob'=>$pob,
			'dob'=>$dob,
			'inst_name'=>$inst_name,
			'par_address'=>$par_address,
			'pre_address'=>$pre_address,
			'gender'=>$gender,
			'religion'=>$religion,
			'blood_grou'=>$blood_grou,
			'city'=>$city,
			'image'=>$pic,
			'e_date'=>$today,
			'e_user'=>$e_user
		);
		
		$insert=$this->db->insert('application_tbl',$data);
		
		if($insert) {
			/*$mobile=substr($phone,-11);
			$messages="Your Application Complete Successfully.Your ID: $appid.Thank you $sname for application.";
			$txt=urlencode($messages);*/
			//$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
			//file_get_contents($url);
			echo $appid;exit;
			
		}
		else {
		echo "Data Not Save";exit;
		
		}
		
	}
	// this is application end

// application details
	public function application_details(){
		$this->load->view("content_page/application_details");
	}

		public function contact_to_admission()
	{
		$data = array();
		$data['title']='Contact to Admission';
		$this->load->view('header',$data);
		$this->load->view('content_page/contact_to_admission');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function class_routine()
	{
		$data = array();
		$data['title']='Class Routine';
		$this->load->view('header',$data);
		$this->load->view('content_page/class_routine');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function exam_routine()
	{
		$data = array();
		$data['title']='Exam Routine';
		$this->load->view('header',$data);
		$this->load->view('content_page/exam_routine');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

	public function xmR()
	{
		$data = array();
		$data['title']='Exam Routine';
		$this->load->view('header',$data);
		$this->load->view('content_page/xmRoutine');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function notice()
	{
		$data = array();
		$data['title']='Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function syllabus()
	{
		$data = array();
		$data['title']='Syllabus';
		$this->load->view('header',$data);
		$this->load->view('content_page/syllabus');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function admission_notice()
	{
		$data = array();
		$data['title']='Admission Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/admission_notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function exam_fee_notice()
	{
		$data = array();
		$data['title']='Exam Fee Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/exam_fee_notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function registration_notice()
	{
		$data = array();
		$data['title']='Registration Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/registration_notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function vacation_notice()
	{
		$data = array();
		$data['title']='Vacation Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/vacation_notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
		public function school_rules_notice()
	{
		$data = array();
		$data['title']='School Rules Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/school_rules_notice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function download_file()
	{
		$data = array();
		$data['title']='download file';
		$this->load->view('header',$data);
		$this->load->view('content_page/download_file');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function academic_calender()
	{
		$data = array();
		$data['title']='Calender';
		$this->load->view('header',$data);
		$this->load->view('content_page/academic_calender');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
	
	public function download()
	{
		
			  
			function download()
			{
			 
			  global $filename, $safeFilename, $downloads;
			  $downloads = "admin/download";
			  $safeFilename = '/^\w+\.\w+$/';
			  $filename = $_POST['download'];
			  
			  
			  if (!file_exists("$downloads/$filename")) {
				error("file not exists");
				exit;
			  }

			  
			  
			  header("Content-disposition: attachment; filename=$filename");
			  header("Content-type: application/octet-stream");
			  $r=readfile("$downloads/$filename");
			  exit(0);
			}
			download();
	}

public function view_class_routine(){
	$this->load->view("content_page/view_class_routine");
}

// get class section
public function classSection()
	{
		$cl=$_POST['clsid'];
		$sec=$this->db->select("*")->from("class_catg")->where("classid",$cl)->get()->row();
		$sub=$this->db->select("*")->from("subject_class")->where("classid",$cl)->get()->result();
		$section=$sec->section;
		$subject='';
		$subid='';

		foreach($sub as $s){
			$subject.=$s->sub_name.',';
			$subid.=$s->subjid.',';
		}

		echo $section."+".$subject."+".$subid;
	}

// student result
public function indStdRslt(){
		$this->load->view('header');
		$this->load->view('content_page/indivisualStdResult');
		$this->load->view('right_content');
		$this->load->view('footer');
	}
public function indStdR(){
		$this->load->view('header');
		$this->load->view('content_page/stdResult');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

	// end

	// download syllabus
	public function dwnlFl(){
		function download(){
		  global $filename, $safeFilename, $downloads;
		 // instruction
		  $dwnlTp=$_GET['t'];
		if($dwnlTp=='s'):
		  $downloads = "admin/download/syllabus";
		elseif($dwnlTp=='n'):
			$downloads = "admin/download/notice";
		elseif($dwnlTp=='c'):
			$downloads = "admin/download/academic calender";
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

	// read notice
	public function readNotice(){
		$this->load->view('header');
		$this->load->view('content_page/readFile');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

	public function changeCls() {
		
		extract($_POST);
		$array_sec=array();
		$array_id=array();
		$select=$this->db->query("select * from section_tbl where classid='$cls_id'")->result();
		foreach($select as $v){
			
			array_push($array_sec,$v->section_name);
			array_push($array_id,$v->sectionid);
			
		}
		$cls=implode($array_sec,",");
		$cid=implode($array_id,",");
		echo $cls."#".$cid;
		
	}

	// all notice
	public function allNotice(){
		$data = array();
		$data['title']='All Notice';
		$this->load->view('header',$data);
		$this->load->view('content_page/allNotice');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

	// details message
	public function details(){
		$t=$_GET['t'];
		$data=array();
		$data['mtype']=$t;
			
		if($t=='w'):
			$data['title']="Welcome Message";
		elseif($t=='v'):
			$data['title']="Vice Principal Message";
		elseif($t=='p'):
			$data['title']="Principal Message";
		endif;

		$this->load->view('header',$data);
		$this->load->view('content_page/messageDetails',$data);
		$this->load->view('right_content');
		$this->load->view('footer');	
	}
	public function re_application_form(){
		$data=array();
		$data['title']="Re Print Application";
		$this->load->view('header',$data);
		$this->load->view('content_page/rePrintDia');
		$this->load->view('right_content');
		$this->load->view('footer');
	}

	public function re_Print(){
		$data=array();
		$data['title']="Re Print Application";
		$this->load->view('content_page/application_details');
	}
}