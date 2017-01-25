<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class employee_edit extends CI_Controller {
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

	
	



public function edit_leave_request_approve_report(){
	
	if(isset($_POST['reject'])){



 
$data1=array(

   'salary'=>$salary,
   'up_date'=>$today,
   'up_user'=>$e_user
   
   ); 
   
       
   
   $result=$this->db->where("empid",$id)->update("emp_salary_his",$data1);
   
  
   

if($this->db->affected_rows()) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
   
    redirect("employee_reports/leave_request_approve_report","location");


   
}

	
}

 
public function edit_employee_salary_report()
 {
if(isset($_POST['submit'])){

$id=$this->input->post('id');
$salary=$this->input->post('salary');

$today=date('Y-m-d h:s:a');
$e_user=$this->session->userdata('userid');

 
$data1=array(

   'salary'=>$salary,
   'up_date'=>$today,
   'up_user'=>$e_user
   
   ); 
   
       
   
   $result=$this->db->where("empid",$id)->update("emp_salary_his",$data1);
   
  
   

if($this->db->affected_rows()) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
   
    redirect("employee_section/employee_salary_history","location");


   
}

}



 public function edit_employee_leave_report()
 {
		if(isset($_POST['submit'])){
		$id=$this->input->post('id');
		$category=$this->input->post('leave_catagory');
		$request_start_date=$this->input->post('request_start_date');
		$request_end_date=$this->input->post('request_end_date');
			if($request_start_date!=''){
				$strt_date=date("Y-m-d",strtotime($request_start_date));
			}
			if($request_start_date!=''){
				$end_date=date("Y-m-d",strtotime ($request_end_date));
			}		
		$request_comment=$this->input->post('request_comment');
		

		$today=date('Y-m-d h:s:a');
		$e_user=$this->session->userdata('userid');		 
		$data1=array(
		   'levid'=>$category,
		   'sdate'=>$strt_date,
		   'edate'=>$end_date,
		   'comment'=>$request_comment,
		   
		   'up_date'=>$today,
		   'up_user'=>$e_user	   		   
		   ); 
		   $result=$this->db->where("reqid",$id)->update("emp_reqlev",$data1);
		if($this->db->affected_rows()) {
			  $aff_row++;
		}
			$aff=array("aff"=>$aff_row);
				$this->session->set_userdata($aff);		  
				redirect("employee_section/employee_rqst_leave_form","location");
		}

}



 public function edit_employee_vacancy_report()
 {
if(isset($_POST['submit'])){

$id=$this->input->post('id');
//$depts_name=$this->input->post('depts_name');
$present_employee=$this->input->post('present_employee');
$need_employee=$this->input->post('need_employee');


$today=date('Y-m-d h:s:a');
$e_user=$this->session->userdata('userid');

 
$data1=array(
    
   //'dept_name'=>$depts_name,
   'need_emp'=>$need_employee,
   'precent_emp'=>$present_employee,
   'up_date'=>$today,
   
   'up_user'=>$e_user
   
   ); 

   $result=$this->db->where("vanid",$id)->update("emp_vacancy",$data1);

if($this->db->affected_rows()) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
   
    redirect("employee_section/employee_vacancy","location");
   
   
 
 
   
}

}



 public function edit_employee_attendance_report()
 {
if(isset($_POST['submit'])){

$id=$this->input->post('id');
$attend_month=$this->input->post('attend_month');
$attend_date=$this->input->post('attend_date');
$attend_status=$this->input->post('attend_status');


$today=date('Y-m-d h:s:a');
$e_user=$this->session->userdata('userid');

 
$data1=array(


    'atendate'=>$attend_date,
   'month'=>$attend_month,
   'attend_status'=>$attend_status,
   'up_date'=>$today,
   'up_user'=>$e_user
   
   ); 

   $result=$this->db->where("empid",$id)->update("emp_attendance",$data1);



if($this->db->affected_rows()) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
   
    redirect("employee_reports/employee_attendance_report","location");
   
   
 



   
}

}


 
 
 

 
 public function employee_dep_catg()
 {

  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_dep_catg_edit');
  $this->load->view('footer');
 }

}
?>