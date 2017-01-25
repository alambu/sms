<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employee_section extends CI_Controller {
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
		$this->load->model('employee/employee_model','employee');
	}



	// ----------------employee section start-----------------------
 public function employee_dept_form()
 {

  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_dept_form');
  $this->load->view('footer');
 }
 
 public function setting()
 {

  $this->load->view('header');
  $this->load->view('leftbar');
  $data=array();
  $data['info']=$this->employee->all_emptype();
  $data['desig']=$this->employee->all_designation();
  $data['leave_type']=$this->employee->all_emplevetype();
  $data['dept']=$this->employee->all_department();
  $this->load->view('employee_section/setting',$data);
  
  $this->load->view('footer');
 }
 
 public function employee_designation_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/emp_type_form');
  $this->load->view('footer');
 }
 
 
 //Employee Registration Start
 
 public function employee_registration()
 {	
	$data=array();
	$data['all_designation']=$this->employee->all_designation();
	$data['all_department']=$this->employee->all_department();
	$data['subject']=$this->employee->unique_subject();
	$this->load->view('employee_section/employee_registration',$data);
 }
 //Employee Registration End
 
 
 
 
 public function employee_designation_catg_edit()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_designation_catg_edit');
  $this->load->view('footer');
 }
 
 public function employee_type_edit()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_type_edit');
  $this->load->view('footer');
 }
 
 public function employee_leave_type_edit()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_leave_type_edit');
  $this->load->view('footer');
 }
 
 public function employee_leave_type_form()
 {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/emp_type_form');
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
 
  public function employee_edit()
  {
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_edit');
  $this->load->view('footer');
  }

 
  public function request_list()
 {
		$this->load->view('header');
		$this->load->view('leftbar');
		$data=array();
		$select=$this->db->query("select emp_reqlev.reqid,empee.name,empee.empid,emp_reqlev.sdate,emp_reqlev.	edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where emp_reqlev.show_status='0'");
		 $data['query']=$select->result();
		  $data['catg']='';
		  $this->load->view('employee_section/request_list',$data);
		 $this->load->view('footer');
 }  
 
// this is for approve data or reject


 public function search_request_list()
 {
	 extract($_POST);
	 $data=array();
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  if($categoryname!=''){
			$select=$this->db->query("select empee.name,empee.empid,emp_reqlev.reqid,emp_reqlev.sdate,emp_reqlev.	edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where emp_reqlev.show_status='0' AND emp_type.emptypeid='$categoryname'");
			 $data['query']=$select->result();
			 $data['catg']=$categoryname;
		  $this->load->view('employee_section/request_list',$data);
	 }
	 else{
		  $select=$this->db->query("select empee.name,empee.empid,emp_reqlev.reqid,emp_reqlev.sdate,emp_reqlev.	edate,emp_reqlev.comment,emp_reqlev.levid,emp_type.type,emp_levtype.lev_type from emp_reqlev left join empee on emp_reqlev.empid=empee.empid left join emp_type on emp_type.emptypeid=empee.emptypeid left join emp_levtype on emp_levtype.levid=emp_reqlev.levid where emp_reqlev.show_status='0'");
		 $data['query']=$select->result();
		 $data['catg']='';
		$this->load->view('employee_section/request_list',$data);
	 }
	$this->load->view('footer');
	}
 
 public function approval_popup()
 {
  
  $this->load->view('employee_section/approval_popup');
  
 }
 

	
	//------------------ End Employee Section------------------------------>
}

