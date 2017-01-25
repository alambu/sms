<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stsid=='' || $stid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model('admin_model','n');
		$this->load->model('account_model','accmodone');
		
	}
	
	public function index()
	{		
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('content');
		$this->load->view('footer');
	}
	public function teachers()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/teachers');
		$this->load->view('footer');
	}
	
	
	public function stuff_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/stuff_info');
		$this->load->view('footer');
	}
	
	public function parents_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/parents_info');
		$this->load->view('footer');
	}
	
	public function about()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/about');
		$this->load->view('footer');
	}
	
	public function add_contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_contact_admission');
		$this->load->view('footer');
	}
	
	public function add_admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_admission_info');
		$this->load->view('footer');
	}
	
	
	
	public function add_image_catagory()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_image_catagory');
		$this->load->view('footer');
	}
	
	public function add_department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_department');
		$this->load->view('footer');
	}
	public function history()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/history');
		$this->load->view('footer');
	}
	
	
		public function calendar()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/calendar');
		$this->load->view('footer');
	}
	
			public function rules_regulation()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/rules_regulation');
		$this->load->view('footer');
	}
	
			public function mailbox()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/mailbox');
		$this->load->view('footer');
	}
	
			public function login()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/examples/login');
		$this->load->view('footer');
	}
	
			public function class_six()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/charts/morris');
		$this->load->view('footer');
	}
	
		public function class_seven()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/charts/flot');
		$this->load->view('footer');
	}
	
		public function class_eight()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/charts/inline');
		$this->load->view('footer');
	}
	
	public function class_nine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/charts/class_nine_students');
		$this->load->view('footer');
	}
	
		public function class_ten()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/charts/class_ten_students');
		$this->load->view('footer');
	}
	
		public function class_six_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/UI/general');
		$this->load->view('footer');
	}
	
		public function class_seven_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/UI/icons');
		$this->load->view('footer');
	}
	
	
		public function edit_about()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_about');
		$this->load->view('footer');
	}
	
		public function edit_history()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_history');
		$this->load->view('footer');
	}
	
	public function edit_teachers()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_teachers');
		$this->load->view('footer');
	}
	
	public function new_teacher()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_teacher');
		$this->load->view('footer');
	}
	
	public function new_about()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_about');
		$this->load->view('footer');
	}
	
	
	public function facility()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/facility');
		$this->load->view('footer');
	}
	
	public function infrastructure()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/infrastructure');
		$this->load->view('footer');
	}
	

	public function edit_facility()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_facility');
		$this->load->view('footer');
	}
	
	public function edit_infrastructure()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_infrastructure');
		$this->load->view('footer');
	}
	
	public function edit_rules_regulation()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_rules_regulation');
		$this->load->view('footer');
	}
	
	public function department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/department');
		$this->load->view('footer');
	}
	
	public function edit_department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_department');
		$this->load->view('footer');
	}
	
	public function library_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/library_info');
		$this->load->view('footer');
	}
	
	public function edit_library_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_library_info');
		$this->load->view('footer');
	}
	
	public function book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/book_list');
		$this->load->view('footer');
	}
	
	public function edit_book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_book_list');
		$this->load->view('footer');
	}
	public function delete_book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_book_list');
		$this->load->view('footer');
	}
	
	public function new_book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_book_list');
		$this->load->view('footer');
	}
	
	public function welcome_message()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/welcome_message');
		$this->load->view('footer');
	}
	
	public function edit_welcome_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_welcome_msg');
		$this->load->view('footer');
	}
	
	public function principal_message()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/principal_message');
		$this->load->view('footer');
	}
	
	public function edit_principal_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_principal_msg');
		$this->load->view('footer');
	}
	public function vice_principal_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/vice_principal_msg');
		$this->load->view('footer');
	}
		public function edit_vice_principal_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_vice_principal_msg');
		$this->load->view('footer');
	}
	
	public function admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/admission_info');
		$this->load->view('footer');
	}
	
	public function edit_admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_admission_info');
		$this->load->view('footer');
	}
	
	public function contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/contact_admission');
		$this->load->view('footer');
	}
	
	public function edit_contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_contact_admission');
		$this->load->view('footer');
	}
	
	public function syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/syllabus');
		$this->load->view('footer');
	}
	
	public function edit_syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_syllabus');
		$this->load->view('footer');
	}
	
	public function delete_syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_syllabus');
		$this->load->view('footer');
	}
	
	public function new_syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_syllabus');
		$this->load->view('footer');
	}

	public function add_stuff()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_stuff');
		$this->load->view('footer');
	}
	
	public function add_history()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_history');
		$this->load->view('footer');
	}
	
	public function add_rules()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_rules');
		$this->load->view('footer');
	}
	
	public function add_facility()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_facility');
		$this->load->view('footer');
	}
	
	public function add_infustracture()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_infustracture');
		$this->load->view('footer');
	}
	
	public function add_prin_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_prin_msg');
		$this->load->view('footer');
	}
	
	public function add_vic_prin_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_vic_prin_msg');
		$this->load->view('footer');
	}
	
	public function add_welcome_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/add_welcome_msg');
		$this->load->view('footer');
	}
	
	
	public function edit_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_vacancy');
		$this->load->view('footer');
	}
	
	public function delete_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_vacancy');
		$this->load->view('footer');
	}
	
	public function new_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_vacancy');
		$this->load->view('footer');
	}
	
	public function notice()
	{
		$data['all_data'] = $this->n->gettable();
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/notice',$data);
		$this->load->view('footer');
	}
	
	public function edit_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_notice');
		$this->load->view('footer');
	}
	
	public function delete_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_notice');
		$this->load->view('footer');
	}
	
	public function new_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_notice');
		$this->load->view('footer');
	}
	
	public function library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/library_gallery');
		$this->load->view('footer');
	}
	
		public function new_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_library_gallery');
		$this->load->view('footer');
	}
	
		public function edit_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_library_gallery');
		$this->load->view('footer');
	}
	
		public function delete_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_library_gallery');
		$this->load->view('footer');
	}
	
		public function gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/gallery');
		$this->load->view('footer');
	}
	
		public function vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/vacancy');
		$this->load->view('footer');
	}
	
			public function edit_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/edit_gallery');
		$this->load->view('footer');
	}
	
			public function delete_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_gallery');
		$this->load->view('footer');
	}
	
			public function new_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/new_gallery');
		$this->load->view('footer');
	}
	
	public function addImageCategory(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/addImageCategory');
		$this->load->view('footer');
	}
	
	public function delete_image_catagory(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('pages/delete_image_catagory');
		$this->load->view('footer');
	}
	// ----------------student section start-----------------------
	public function application_catg_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/app_catg_setting');
		$this->load->view('footer');
	}
	
	public function application_form(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/application_form');
		$this->load->view('footer');
	}
	
	public function registration_form(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/registration_form');
		$this->load->view('footer');
	}
	
	
	public function re_admission(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/re_admission');
		$this->load->view('footer');
	}
	
	public function class_catg_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_catg_setting');
		$this->load->view('footer');
	}
	
	public function shift_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/shift_setting');
		$this->load->view('footer');
	}
	
	
	public function version_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/version_setting');
		$this->load->view('footer');
	}
	
	
	public function subject_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/subject_setting');
		$this->load->view('footer');
	}
	
	public function class_routine_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_routine_setting');
		$this->load->view('footer');
	}
	
	public function class_routine(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_routine');
		$this->load->view('footer');
	}
	
	
	public function class_tech_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_tech_setting');
		$this->load->view('footer');
	}
	
	public function class_tech_frox_setting(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/class_tech_frox_setting');
		$this->load->view('footer');
	}
	
	public function attendance(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/attendance');
		$this->load->view('footer');
	}
	
	public function online_status(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('student_section/online_status');
		$this->load->view('footer');
	}
	
	
	//<!---------------student section end---------------------->
	
	// ------------------------libary section start----------------------------
	
	public function category_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/category_form');
	  $this->load->view('footer');
	 }
	 public function book_list_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_list_form');
	  $this->load->view('footer');
	 }
	
	 public function book_code_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_code_form');
	  $this->load->view('footer');
	 }
	 
	 public function book_distribution_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_distribution_form');
	  $this->load->view('footer');
	 }
	 
	  public function book_return_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_return_form');
	  $this->load->view('footer');
	 }
 
	
	// ------------------------libary section End----------------------------
	public function image_upload() {
		if(isset($_POST)) {  
		
		echo $_FILES['img']['tmp_name'];
		
		}
	//	echo $sourcePath = $_FILES['file']['tmp_name'];
	
	}
	
	// ------------------------Start Employee Section-------------------------------->
	public function employee_dept_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_dept_form');
  $this->load->view('footer');
 }
 
 public function employee_designation_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_designation_form');
  $this->load->view('footer');
 }
 
  public function employee_reg_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_reg_form');
  $this->load->view('footer');
 }
 
 public function employee_leave_type_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_leave_type_form');
  $this->load->view('footer');
 }
 
  public function employee_rqst_leave_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_rqst_leave_form');
  $this->load->view('footer');
 }
 
 
 public function employee_approval_leave()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_approval_leave');
  $this->load->view('footer');
 }
 
  public function employee_salary_history()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_salary_history');
  $this->load->view('footer');
 }
 
  public function employee_salary_increment()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_salary_increment');
  $this->load->view('footer');
 }
 
  public function employee_vacancy()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_vacancy');
  $this->load->view('footer');
 }
 
 public function employee_attendence()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_attendence');
  $this->load->view('footer');
 }

 public function approval_popup()
 {
  
  $this->load->view('employee_section/approval_popup');
  
 }
	//------------------ End Employee Section------------------------------>
}