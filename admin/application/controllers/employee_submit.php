<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class employee_submit extends CI_Controller {
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
		$this->load->model('employee/employee_model','employee');
	}
	
	
	




///////////////////Start employee Department ///////////////////
		public function employee_dep_catg()
		{			 
			extract($_POST);
			$e_date=date("Y-m-d h:i:a");
			$e_user=$this->session->userdata('userid');
			if(trim($dept)=='') { echo "Department is Empty";exit; }
			$this->form_validation->set_rules('dept', 'dept', 'trim|required|is_unique[emp_depart_catg.manage_type]');
			if ($this->form_validation->run() == FALSE)
			{
				echo "Department is Exist";exit;
			}
			$data=array(
			'manage_type'=>$dept,
			'e_date'=>$e_date,
			'e_user'=>$e_user
			);
			
			$insert=$this->employee->all_insert("emp_depart_catg",$data);
			if($insert) { echo 1; } else { echo "Data Not Save"; }
		}
			
			
			public function employee_dep_catg_edit()
			{
				// Department Edit Start
					extract($_POST);
					$up_date=date("Y-m-d h:i:a");
					$up_user=$this->session->userdata('userid');
					if(trim($manage_typ)==''){
					echo "Department is Empty";exit;
					}
			// Department Validation start 		
					$this->form_validation->set_rules('manage_typ', 'dept', 'trim|required|is_unique[emp_depart_catg.manage_type]');
					if ($this->form_validation->run() == FALSE)
					{
						echo "Department is Exist";exit;
					}
			// Department Validation End 		
					
					$data=array(
					'manage_type'=>$manage_typ,
					'up_date'=>$up_date,
					'up_user'=>$up_user
					);
					$where=array("edepid"=>$edepid);
					$up=$this->employee->all_update($where,"emp_depart_catg",$data);
					if($up){
					echo 1;exit;
					}
					else {
					echo "Data Not Save";exit;	
					}
				
			}

		///////////////////Start employee type ///////////////////
		
		
		public function employee_dep_catg_delete()
		{
			extract($_GET);
			$delete_test=$this->employee->emp_setting_delete_test("empee","department",$id);
			if($delete_test>0) 
			{
				redirect('employee_section/setting?del=0','location'); 
			} 
			else 
			{
				
			$del=$this->employee->all_delete('emp_depart_catg','edepid',$id);
			if($del) 
			{
			redirect('employee_section/setting?del=1','location'); 
			}
			else 
			{
			redirect('employee_section/setting?del=2','location');
			}
			
			}
		}
		
	public function employee_type_catg(){
// Employee Type Submit Start			
	   extract($_POST);
	   $aff_row=0;$edate=date('Y-m-d h:s:a');
	   $user=$this->session->userdata('userid');
	   if(trim($typ)==''){
		   echo "Field is Empty";exit;
		}
	   $typ_up=$typ;
	   $sql=$this->db->query("SELECT type FROM emp_type WHERE type='$typ_up' limit 1");
	   
		if($this->db->affected_rows()<1){      
		   $data=array(
		   'type'=>$typ_up,
		   'e_date'=>$edate,
		   'e_user'=>$user
		   );
		   $insert=$this->employee->all_insert("emp_type",$data);
		   if($insert)
		   {
			   echo 1;exit;
		   } 
		   else 
		   {
			   echo "Data Not Save";exit;
		   }
		}
		
		else {
		echo "Already Exist";exit;
		
		}
			
		
//Employee Type Submit End
	}
	
	public function registration()
	{
	
	extract($_POST);
	
	$entry_date=date('Y-m-d h:s:A');
	$entry_user=$this->session->userdata('userid');
	$date=date("Y-m-d");
	//validation start
	if(trim($emp_name)=='') { echo "Employee Name Empty";exit; }
	if(trim($nick_name)=='') { echo "Nick Name Empty";exit; }
	if(trim($father_name)=='') { echo "Father Name Empty";exit; }
	if(trim($mother_name)=='') { echo "Mother Name Empty";exit; }
	if(trim($birth_date)=='') { echo "Birth Day is Empty";exit; }
	if(trim($join_date)=='') { echo "Join Date is Empty";exit; }
	if(trim($present_address)=='') { echo "Present Address Empty";exit; }
	if(trim($permanent_address)=='') { echo "Permanent Address Empty";exit; }
	if(trim($nid)=='') { echo "National ID Number is Empty";exit; }
	if(trim($religion)=='') { echo "Religion is  Empty";exit; }
	if(trim($emp_types)=='') { echo "Employee Type is Empty";exit; }
	if(trim($department)=='') { echo "Department is  Empty";exit; }
	if(trim($blood_group)=='') { echo "Blood Group Empty";exit; }
	if(trim($designation)=='') { echo "Designation is Empty";exit; }
	if(trim($phone)=='') { echo "Mobile Number is Empty";exit; }
	if(trim($alt_phone)=='') { echo "Alternet Mobile Number is Empty";exit; }
	if(trim($gender)=='') { echo "Gender is Empty";exit; }
	if(trim($edu_qualify)=='') { echo "Educational Qualification is Empty";exit; }
	if(trim($acc_no)=='') { echo "Account No is Empty";exit; }
	if(trim($emp_id)=='') { echo "Employee ID is Empty";exit; }
	//validation end
	
	//image validation start 
	if(empty($_FILES['image']['name']))
	{
		echo "Image is Empty";exit;
	}	
	//image validation end
	
	
	//subject Validation start
	if($emp_types==1)
	{
		if(trim($subject)=='')
		{
			echo "Subject is Empty";exit;
		}
		$sub=$subject;
	}
	else 
	{
		$sub="";
	}
	
	//subject validation end
	
	
	// data base validation chk start
	$nid_chk=$this->db->query("select id from empee where nickN='$nick_name'");
	if($this->db->affected_rows()>0) { echo "Nick Name Exist";exit; }
	$exist_emp=$this->db->query("select count(id) as t_emp from empee where deginition='$designation'")->row()->t_emp;
	$need_emp=$this->db->query("select need_emp from employee_catg where ecatgid='$designation'")->row()->need_emp;
	if($exist_emp==$need_emp) { echo "You Can not Join Employee Your Selected Designation";exit; }
	// data base validation chk End	
	
	//employee id validation test start
	$this->db->query("select * from empee where empid='$emp_id'");
	if($this->db->affected_rows()>0) { echo "Employee id is Exist";exit; }
	//employee id validation test end
	
	//Copy Image Start
	$new_image=$_FILES['image']['name'];
	$tmp_name=$_FILES['image']['tmp_name'];
    copy($tmp_name,"img/employee_image/$new_image");
	//Copy Image End
	
	
	$info_array=array(
	'empid'=>$emp_id,
	'name'=>$emp_name,
	'nickN'=>$nick_name,
	'fname'=>$father_name,
	'mname'=>$mother_name,
	'dob'=>$birth_date,
	'join_date'=>$join_date,
	'pre_address'=>$present_address,
	'par_address'=>$permanent_address,
	'nid'=>$nid,
	'religion'=>$religion,
	'blood'=>$blood_group,
	'subject'=>$sub,
	'department'=>$department,
	'emptypeid'=>$emp_types,
	'deginition'=>$designation,
	'phone'=>$phone,
	'alt_phone'=>$alt_phone,
	'gender'=>$gender,
	'acc_no'=>$acc_no,
	'picture'=>$new_image,
	'status'=>1,
	'e_date'=>$entry_date,
	'e_user'=>$entry_user,
	'edu_q'=>$edu_qualify
	);
	

	$log_array=array(
	'empid'=>$emp_id,
	'pass'=>$emp_id,
	'e_date'=>$entry_date,
	'e_user'=>$entry_user
	);
	
	$insert=$this->employee->all_insert("empee",$info_array);
	$insert=$this->employee->all_insert("emp_login",$log_array);
	

	if($insert){
		echo 1;exit;
	}
	else {
		echo "Data Not Save";exit;
	}
		
	}
	
	public function employee_edit()
    {
		
		$today=date('Y-m-d h:s:a');
		$e_user=$this->session->userdata('userid');
		extract($_POST);
		// empty validation start
		if(trim($emp_name)=='') { echo "Employee Name Empty";exit; }
		if(trim($nick_name)=='') { echo "Nick Name Empty";exit; }
		if(trim($father_name)=='') { echo "Father Name Empty";exit; }
		if(trim($mother_name)=='') { echo "Mother Name Empty";exit; }
		if(trim($birth_date)=='') { echo "Birth Day is Empty";exit; }
		if(trim($join_date)=='') { echo "Join Date is Empty";exit; }
		if(trim($present_address)=='') { echo "Present Address Empty";exit; }
		if(trim($permanent_address)=='') { echo "Permanent Address Empty";exit; }
		if(trim($nid)=='') { echo "National ID Number is Empty";exit; }
		if(trim($religion)=='') { echo "Religion is  Empty";exit; }
		if(trim($emp_type)=='') { echo "Employee Type is Empty";exit; }
		if(trim($department)=='') { echo "Department is  Empty";exit; }
		if(trim($blood_group)=='') { echo "Blood Group Empty";exit; }
		if(trim($designation)=='') { echo "Designation is Empty";exit; }
		if(trim($phone)=='') { echo "Mobile Number is Empty";exit; }
		if(trim($alt_phone)=='') { echo "Alternet Mobile Number is Empty";exit; }
		if(trim($gender)=='') { echo "Gender is Empty";exit; }
		if(trim($edu_qualify)=='') { echo "Educational Qualification is Empty";exit; }
		if(trim($acc_no)=='') { echo "Account No is Empty";exit; }
		if(trim($empsid)=='') { echo "Employee ID is Empty";exit; }
		// empty validation End
		
		
		// data base validation start
		$nid_chk=$this->db->query("select * from empee where nid='$nid' or nickN='$nick_name' or empid='$empsid'");
		$nid_row=$nid_chk->num_rows();
		if($nid_row>0)
		{
		$row_val=$nid_chk->row();
		if($row_val->nid!=$nid) { echo "National ID is Exist";exit; } 
		if($row_val->nickN!=$nick_name) { echo "Nick Name Already Exist";exit; } 
		if($row_val->empid!=$empsid) { echo "Employee ID is Exist"; exit; }
		}
		//echo $designation;
		
		$exist_emp=$this->db->query("select count(id) as t_emp from empee where deginition='$designation'")->row()->t_emp;
		$need_emp=$this->db->query("select need_emp from employee_catg where ecatgid='$designation'")->row()->need_emp;
		
		if($exist_emp>$need_emp) {
			
			echo "Designation Almost Full";exit;
		}
		
		// data base validation end
		
		
		//subject validation start
		if($emp_type==1)
		{
			if(trim($subject)=='')
			{
				echo "Subject is Empty";exit;
			}
			$sub=$subject;
		}
		else 
		{
			$sub="";
		}
		
		//subject validation end
		
		$id=$this->input->post('id');
		$empid=$this->input->post('empsid'); 
		$name=$this->input->post('emp_name');
		$father_name=$this->input->post('father_name');
		$mother_name=$this->input->post('mother_name');
		$birth_date=$this->input->post('birth_date');
		$join_date=$this->input->post('join_date');


		$present_address=$this->input->post('present_address');
		$permanent_address=$this->input->post('permanent_address');
		$national_id=$this->input->post('nid');
		$religion=$this->input->post('religion');
		$blood_group=$this->input->post('blood_group');
		
		$department=$this->input->post('department');
		$emp_types=$this->input->post('emp_type');
		$designation=$this->input->post('designation');
		$gender=$this->input->post('gender');
		$phone=$this->input->post('phone');
		$alt_phone=$this->input->post('alt_phone');
		$nick_name=$this->input->post('nick_name');
		$edu_qualify=$this->input->post('edu_qualify');
		
		if(!(empty($_FILES['image']['name']))) {				
		$new_image=$_FILES['image']['name'];
		$tmp_name=$_FILES['image']['tmp_name'];
		$exist_pic=$nid_chk->row()->picture;
		unlink("img/employee_image/$exist_pic");
		if($_FILES['image']['size']){
			copy($tmp_name,"img/employee_image/$new_image");
		}
		
		$data1=array(

		   'name'=>$name,
		   'nickN'=>$nick_name,
		   'fname'=>$father_name,
		   'mname'=>$mother_name,
		   'dob'=>$birth_date,
		   'join_date'=>$join_date,
		   'resign_date'=>$resign_date,
		   'pre_address'=>$present_address,
		   'par_address'=>$permanent_address,
		   'nid'=>$national_id,
		   'blood'=>$blood_group,
		   'subject'=>$sub,
		   'department'=>$department,
		   'emptypeid'=>$emp_types,
		   'deginition'=>$designation,
		   'phone'=>$phone,
		   'alt_phone'=>$alt_phone,
		   'edu_q'=>$edu_qualify,
		   'gender'=>$gender,
		   'picture'=>$new_image,
		   'up_date'=>$today,
		   'up_user'=>$e_user
		   
		   );
		$where=array("id"=>$id);
		$this->employee->all_update($where,'empee',$data1);
		
		} 
		
		else 
		{
			
		$data1=array(
	   'name'=>$name,
	   'fname'=>$father_name,
	   'mname'=>$mother_name,
	   'dob'=>$birth_date,
	   'join_date'=>$join_date,
	   'resign_date'=>$resign_date,
	   'pre_address'=>$present_address,
	   'par_address'=>$permanent_address,
	   'nid'=>$national_id,
	   'blood'=>$blood_group,
	   'subject'=>$sub,
	   'department'=>$department,
	   'emptypeid'=>$emp_types,
	   'deginition'=>$designation,	
	   'phone'=>$phone,
	   'gender'=>$gender,			   
	   'up_date'=>$today,
	   'up_user'=>$e_user
	   );
	   
		$where=array("id"=>$id);
		$this->employee->all_update($where,'empee',$data1);
		
		}

		if($this->db->affected_rows()>0) {
			echo 1;exit;
		}
		else {
			echo "Data Not Update";exit;
		}

				
			  
	

	}
	
	
	public function employee_resign()
	{
		extract($_GET);
		$data=array("status"=>0);
		$data1=array("status"=>2);
		$where=array("empid"=>$id);
		$resign=$this->employee->all_update($where,"empee",$data);
		$resign=$this->employee->all_update($where,"emp_login",$data1);
		if($resign)
		{
			redirect("employee_section/employee_registration?del=1","location");
		}
		else 
		{
			redirect("employee_section/employee_registration?del=0","location");
		}
	}
	
	
	public function employee_type_catg_edit()
	{
		//Employee Type Edit  Start					
		extract($_POST);
		$up_date=date("Y-m-d h:i:a");
		$up_user=$this->session->userdata('userid');
		$ty=$type;
		//Type Validation Start			
		if(trim($ty)==''){
		echo "Field is Empty";
		}
		$test=$this->db->query("select type from emp_type where type='$ty'");
		$row=$this->db->affected_rows();
		if($row>0){
			echo "Already Exist";exit;
		}
		// Type Validation End			
		$data=array(
		'type'=>$ty,
		'up_date'=>$up_date,
		'up_user'=>$up_user
		);
		$where=array("emptypeid"=>$emptypeid);
		$up=$this->employee->all_update($where,"emp_type",$data);
		if($up){
			echo 1;exit;
		}
		else {
			echo "Data Not Update";exit;
		}
		
	
	//Employee Type Edit  End
	}
	

 ///////////////////employee designation ///////////////////
 
 public function employee_designation_catg(){
	extract($_POST);
	$edate=date('Y-m-d h:s:a');
    $user=$this->session->userdata('userid');
	if(trim($desig)=='' || trim($need)=='' || trim($quali)==''){
	   echo "Please Fillup All Data";exit;
	}
	$catg_up=$desig;
	$sql=$this->db->query("SELECT emp_type FROM employee_catg WHERE emp_type='$catg_up' limit 1");
    if($this->db->affected_rows()<1){
	   $data=array(
	   'emp_type'=>$catg_up,
	   'need_emp'=>$need,
	   'qualification'=>$quali,
	   'e_date'=>$edate,
	   'e_user'=>$user
	   );
	   $insert=$this->employee->all_insert("employee_catg",$data);
	   if($insert)
	   {
		   echo 1;exit;
	   }
	   else 
	   {
		   echo "Data Not Save";exit;
	   }
	}
	else 
	{
		echo "Designation Already Exist";exit;
	}
			
}
/////////////// End employee designation/////////////////
 
 
 public function employee_designation_catg_edit ()
 {
	//Designation Edit Start				

	extract($_POST);
	$aff_row=0;
	$up_date=date("Y-m-d h:i:a");
	$up_user=$this->session->userdata('userid');
	$des=$desig;
// validation Start				
	if(trim($des)=='' || trim($need)=='' || trim($quali)=='') {
	echo "Please Fillup All Field";exit;
	}
	$test=$this->db->query("select emp_type from employee_catg where emp_type='$des'");
	$row=$this->db->affected_rows();
	if($row>0){
		if($test->row()->emp_type!=$des)
		{
			echo "Designation Already Exist";exit;
		}	
	}
// validation End				
	$data=array(
	'emp_type'=>$des,
	'need_emp'=>$need,
	'qualification'=>$quali,
	'up_date'=>$up_date,
	'up_user'=>$up_user
	);
	$where=array("ecatgid"=>$ecatgid);
	$up=$this->employee->all_update($where,"employee_catg",$data);
	if($up){
		echo 1;
	}
	else {
		echo "Data Not Update";
	}
	

	
//Designation Edit End	 
 }
 
 
 public function employee_designation_catg_delete()
 {
	extract($_GET);
	$delete_test=$this->employee->emp_setting_delete_test("empee","deginition",$id);
	if($delete_test>0) 
	{
		redirect('employee_section/setting?del=0','location'); 
	} 
	else 
	{
		
	$del=$this->employee->all_delete('employee_catg','ecatgid',$id);
	if($del) 
	{
	redirect('employee_section/setting?del=1','location'); 
	}
	else 
	{
	redirect('employee_section/setting?del=2','location');
	}
	
	}
 }
 
 
 public function employee_type_delete()
 {
	extract($_GET);
	$delete_test=$this->employee->emp_setting_delete_test("empee","emptypeid",$id);
	if($delete_test>0) 
	{
		redirect('employee_section/setting?del=0','location'); 
	} 
	else 
	{
	$del=$this->employee->all_delete("emp_type","emptypeid",$id);
	if($del) 
	{
	redirect('employee_section/setting?del=1','location'); 
	}
	else 
	{
	redirect('employee_section/setting?del=2','location');
	}
	
	} 
 }
 
 
 public function employee_rqst_leave_form()
 {
	 
 if(isset($_POST['submit'])){	 
 extract($_POST);
 $entry_date=date('Y-m-d');
 $entry_user=$this->session->userdata('userid');
 $sdate=date("Y-m-d",strtotime($request_start_date));
 $edate=date("Y-m-d",strtotime($request_end_date));
 $aff_row=0;
 $data=array(
    'reqid'=>'',
	'empid'=>$employee_name,
	'levid'=>$leave_catagory,
	'sdate'=>$sdate,
	'edate'=>$edate,
	'comment'=>$request_comment,
	'show_status'=>'0',
	'e_date'=>$entry_date,
	'e_user'=>$entry_user,
	'up_date'=>'',
	'up_user'=>''
   );

$this->db->insert('emp_reqlev',$data);
	 
if($this->db->affected_rows()>0) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
$this->session->set_userdata($aff);

redirect("employee_section/employee_rqst_leave_form","location");


	 
}
	 
}
  
public function employee_salary_payment()
{
	 
if(isset($_POST['submit'])) {
extract($_POST);
$entry_date=date('Y-m-d h:s:A');
$entry_user=$this->session->userdata('userid');
$aff_row=0;

// input validation start 
 foreach($_POST as $key=>$val){
	 if(($key=='submit') || ($key=='reset')){
		 
	 }
	 else {
		 if(trim($val)==''){
			$aff=array("aff"=>$aff_row);
			$this->session->set_userdata($aff);
			redirect("employee_section/employee_salary_history","location");
		 }
	 }
 }
// input validatio end
$d=explode("/",$pay_d);
$payment_date=$d[2]."-".$d[1]."-".$d[0];

$data=array(
'empid'=>$employee_name,
'month'=>$month,
'years'=>$year,
'salary'=>$salary,
'date'=>$payment_date,
'e_date'=>$entry_date,
'e_user'=>$entry_user,
'up_date'=>'',
'up_user'=>''
);

$insert=$this->db->insert("emp_salary_his",$data);

if($insert) {
    $aff_row++;
	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_salary_history","location");
}
else {
	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_salary_history","location");
}

}
	 
}


 
public function employee_leave_type_form()    
 {	 
     $entry_date=date('Y-m-d h:s:a');
	 $entry_user=$this->session->userdata('userid');
	 extract($_POST);
	 if(trim($leave_type)=='' || trim($max_leave)==''){
		echo "Please Fillup All Data";exit; 
	 }
	$lev_typ_up=$leave_type;
	$q=$this->db->query("select * from  emp_levtype  where  lev_type='$lev_typ_up'");
	$row=$q->num_rows();
	
	if($row==0){
	$data=array(
	'lev_type'=>$lev_typ_up,
	'max_lev'=>$max_leave,
	'status'=>1,
	'e_date'=>$entry_date,
	'e_user'=> $entry_user
	);
	$insert=$this->employee->all_insert("emp_levtype",$data);
	if($insert) { echo 1;exit; } else { echo "Data Not Save";exit; }
	}
	
	else {
	    echo "Already Exist";exit;
	}

 
} 
 
 public function employee_leave_type_edit()
 {
	 
		extract($_POST);
		$up_date=date("Y-m-d h:i:a");
		$up_user=$this->session->userdata('userid');
		$levtype=$leave_type;
		
		// validation start
		if(trim($levtype)=='' || trim($max_leave)==''){
			echo "Please Fillup All Data";exit; 
		}
		$test=$this->db->query("select lev_type from  emp_levtype where lev_type='$levtype'");
		$row=$this->db->affected_rows();
		if($row>0){
			if($test->row()->lev_type!=$levtype){
				echo "Already Exist";exit; 
			}
		}
		// validation End
		
		$data=array(
		'lev_type'=>$levtype,
		'max_lev'=>$max_leave,
		'status'=>$status,
		'up_date'=>$up_date,
		'up_user'=>$up_user
		);
		$where=array("levid"=>$levid);
		$up=$this->employee->all_update($where,"emp_levtype",$data);
		if($up){
		echo 1;exit;
		}
		else 
		{
		echo "Data not Update";exit;	
		}
	
 }
 
 
  public function employee_vacancy()
 {
	 
	 if(isset($_POST['submit'])) {
	
$dept_name=$this->input->post('dept_name');
$present_employee=$this->input->post('present_employee');
$need_employee=$this->input->post('need_employee');

$entry_date=date('Y-m-d h:s:A');
$entry_user=$this->session->userdata('userid');
$update_date="";
$update_user="";

$num=$this->db->query("select * from emp_vacancy where dept_name='$dept_name' ")->num_rows();

if($num==0){
	
$insert=$this->db->query("insert into emp_vacancy values('','$dept_name','$need_employee','$present_employee','$entry_date','$entry_user','$update_date',' $update_user')");

if($this->db->affected_rows()){
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_vacancy","location");
	
}

else {
	
	 
    $aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_vacancy","location"); 
 		
}

}
	 
}
 
 
 public function ajax_request_clsid(){
     $start_date=$this->input->post('ab');    
      $end_date=$this->input->post('dc');     
   }
   


 
public function ajax_request1(){
    
   $id=$_POST['edepid'];
   //$this->db->limit(1);
   echo $sel=$this->db->query("select manage_type from emp_depart_catg  where edepid='$id' ")->row()->manage_type;

  }
 

 
public function ajax_request(){
   if(isset($_POST['des_lem'])){
	   extract($_POST);
	   $exist_emp=$this->db->query("select count(id) as t_emp from empee where deginition='$des_lem'")->row()->t_emp;
	   $need_emp=$this->db->query("select need_emp from employee_catg where ecatgid='$des_lem'")->row()->need_emp;
	   if($exist_emp>=$need_emp){
		   echo 0;
	   }
	   else {
		   echo 1;
	   }
   }
   
   if(isset($_POST['nid_chk'])){
	   extract($_POST);
	   $this->db->query("select * from empee where nid='$nid_chk'");
	   if($this->db->affected_rows()>0){
		   echo 0;
	   }
	   else {
		   echo 1;
	   }
   }   
   	
   if(isset($_POST['emp_id'])){ 
   $id=$_POST['emp_id'];
   $this->db->limit(1);
   $sel=$this->db->select("*")->from("emp_salary_incre")->where("empid",$id)->order_by("eincid", "desc")->get()->row();
	echo $sel->salary;
  }
  elseif(isset($_POST['nick_name'])){
	  extract($_POST);
	  $v=strtoupper($nick_name);
	 echo  $row=$this->db->query("select * from empee where nickN='$v'")->num_rows();
	  
  }
  
  elseif(isset($_POST['mv_test'])){
	  extract($_POST);
	  $ex=explode("/",$mv_test);
	  $pd=date("Y-m-d");
	  $sd=date("Y-m-d",strtotime($ex[0]));
	  $ed=date("Y-m-d",strtotime($ex[1]));
	  $max=$ex[2];
	  if($sd<$pd){
		  echo "Please Don't Select Preveus Date";
	  }
	  elseif($sd>$ed){
		  echo "Start Date is Big End Date";
	  }
	  else {
		  //echo 'ok';
		  $ex2=explode("-",$sd);
		  $ex3=explode("-",$ed);
		  $sdm=$ex2[1];
		  $edm=$ex3[1];
		  if($sdm==$edm){
			 $v=$ex3[2]-$ex2[2];
			 $com_v=$v;
		  }
		  elseif($edm>$sdm){
			if($sdm==4 ||$sdm==6 || $sdm==9 || $sdm==11){
				 $v=30-$ex2[2];
			}
			elseif($sdm==2){
				 $v=28-$ex2[2];
			}
			else {
				 $v=31-$ex2[2];
			}
			$nextv=0+$ex3[2];
			$com_v=$nextv+$v;
		  }
		if($com_v>=$max){
			//echo $com_v;
			echo "This Catagory Maximum Leave is  ".$max." Days";
		}
		else {
			echo "ok";
		}
	  }
	  
  }
  
  
  }
	

	

	
	
  public function employee_salary_increment()
 {
	 
	 if(isset($_POST['submit'])) {
	
$employee_name=$this->input->post('employee_name');
$increment_salary=$this->input->post('increment_salary');
$date=$this->input->post('increment_date');
$ex=explode("/",$date);
$increment_date=$ex[2]."-".$ex[1]."-".$ex[0];

$entry_date=date('Y-m-d ');
$entry_user=$this->session->userdata('userid');
$update_date=date('Y-m-d h:s:a');
$update_user="";


$insert=$this->db->query("insert into emp_salary_incre values('','$employee_name','$increment_salary','$increment_date','$entry_date','$entry_user','$update_date',' $update_user')");

//$this->db->query("UPDATE empee SET salary=' $increment_salary ' WHERE empid='$employee_name ' ");


if($this->db->affected_rows()) {
      $aff_row++;
}

$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
   
    redirect("employee_section/employee_salary_history","location");

}
	 
 }


 
public function request_list(){	
  if(isset($_POST['submit'])){	  
   $s=$this->input->post('startdate');
   $e=$this->input->post('enddate');
   $start_date=date("Y-m-d",strtotime($s));
   $end_date=date("Y-m-d",strtotime($e));
   $message=$this->input->post('message');
   $req_id=$this->input->post('reqidAprove');
   $user_id=$this->session->userdata('userid');
   $em=$this->input->post('emid');
   $aff_row=0;
   $e_date=date('Y-m-d ');
   
   //input Chk validation start
   if((trim($s)=='') || (trim($e)=='')){
	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_rqst_leave_form","location");
   }
   //input chk validation End
   
   $e_user=$this->session->userdata('userid');

   $update_date=date("Y-m-d h:i:a");
   $update_user=$this->session->userdata('userid');
   $status="1";
	

$insert=$this->db->query("insert into emp_approved values('','$user_id','$req_id','$start_date','$end_date','$message','$status','$e_date','$e_user','','')");

$this->db->query("UPDATE emp_reqlev SET show_status='1',up_date='$update_date',up_user='$update_user' where reqid='$req_id'" );

if($this->db->affected_rows()){
      $aff_row++;
	  
}

	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_rqst_leave_form","location");

}
	 
 }

function employee_attendence(){
	
	// attendance entry start
	
	if(isset($_POST['submit'])){
	extract($_POST);
	$present=$chk_box;
	$date=date("Y-m-d");
	$e_date=date('Y-m-d h:s:a');
	$e_user=$this->session->userdata('userid');
	$aff_row=0;
	
	foreach($present as $value){
		$v.=trim($value).",";
		
	}
	$emp=chop($v,",");
	$attend_month=date("m");
	$data=array(
		'eattenid'=>'',
		'emptypeid'=>$emptypeid,
		'empid'=>$emp,
		'atendate'=>$date,
		'month'=>$attend_month,
		'e_date'=>$e_date,
		'e_user'=>$e_user,
		'up_date'=>'',
		'up_user'=>''
	);
	
	$query=$this->db->insert("emp_attendance",$data);
	
	if($this->db->affected_rows()) {
      $aff_row++;
	}

	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_attendence","location");
	}
	
	//attendance entry end
	
}


public function employee_attendence_edit()
{
	//attendance Edit start
	
	if(isset($_POST['submit_edit'])){
	extract($_POST);
	$present=$chk_box;
	$up_date=date('Y-m-d h:s:a');
	$up_user=$this->session->userdata('userid');
	$aff_row=0;
	foreach($present as $value){
		$v.=trim($value).",";
		
	}
	$emp=chop($v,",");
	
	$data=array(
		'empid'=>$emp,
		'up_date'=>$up_date,
		'up_user'=>$up_user
	);
	$this->db->where("eattenid",$att_id);
	$up=$this->db->update("emp_attendance",$data);
	
	if($up) {
      $aff_row++;
	  $aff=array("aff"=>$aff_row);
      $this->session->set_userdata($aff);
      redirect("employee_section/employee_attendence","location");
	}
    else {
	$aff=array("aff"=>$aff_row);
    $this->session->set_userdata($aff);
    redirect("employee_section/employee_attendence","location");
	}
 }
	
	//attendance edit end
}

		public function reject_req(){
			
			extract($_POST);
			$date=date("Y-m-d");
			$e_date=date('Y-m-d h:s:a');
			$user=$this->session->userdata('userid');
			$userisd=$this->session->userdata('userid');
			$ssdate=date('Y-m-d',strtotime($sdate));
			$eedate=date('Y-m-d',strtotime($edate));

			$data=array(
				'userid'=>$userisd,
				'reqid'=>$reqid,
				'sdate'=>$ssdate,
				'edate'=>$eedate,
				'comment'=>$cmnt,
				'status'=>'2',
				'e_user'=>$user,
				'e_date'=>$e_date,
				'up_user'=>'',				
			);
			$status=$this->n->reject_insert($data);
			if($status==1){
				$up=$this->db->query("UPDATE emp_reqlev SET show_status='1' WHERE reqid='$reqid'");
				echo "1";
			}
		}
		
	public function maxlv(){
		extract($_POST);
		$lvMx=$this->db->select("*")->from("emp_levtype")->where("levid",$d)->get()->row();
		echo $lvMx->max_lev;
	}

	
	public function chekDept(){
		extract($_POST);
		$info=$this->db->select("*")->from("emp_vacancy")->where("dept_name",$k)->get()->num_rows();
		echo $info;
	}
	
}	
?>