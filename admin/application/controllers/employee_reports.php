<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_reports extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		$this->load->model('admin_model','n');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		
	}

	
  public function employee_type_report(){

	 $data=array();
	 $data['query']=$this->db->select("*")->from("emp_type")->get()->result();
    $this->load->view('employee_section/emp_type_form',$data);  
 }	
	
	public function attendance_details(){
		
		$this->load->view('header');
		//$this->load->view('leftbar');
		$this->load->view('employee_section/attendance_details');
		//$this->load->view('footer');
		
	}
 
 public function employee_report(){
	 $data=array();
	 $data['query']=$this->db->select("*")->from("empee")->get()->result();
	 $data['depid']='';
	 $data['empid']='';
	 $data['stdate']=date('d-m-Y');
	 $data['etdate']=date('d-m-Y');
  $this->load->view('employee_section/employee_report',$data);  
 }
 
 ////Employee Report Search start here/////
 
 public function employee_report_search(){ 
	    $data=array();
		extract($_POST);
		if($start_date!=''){
			$ssdate=date('Y-m-d',strtotime($start_date));
		}
		if($end_date!=''){
			$eedate=date('Y-m-d',strtotime($end_date));
		}
		if($emp_name=='' && $depart=='' && $start_date!='' && $end_date!=''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE join_date between '$ssdate' AND '$eedate'")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;			
			 $this->load->view('employee_section/employee_report',$data);
		}
		elseif($emp_name=='' && $depart!='' && $start_date!='' && $end_date!=''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE join_date between '$ssdate' AND '$eedate' AND department='$depart'")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			 
			$this->load->view('employee_section/employee_report',$data);
		}
		elseif($emp_name!='' && $depart!='' && $start_date!='' && $end_date!=''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE join_date between '$ssdate' AND '$eedate' AND department='$depart' AND empid='$emp_name'")->result();
			$data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			$this->load->view('employee_section/employee_report',$data);
		}
		elseif($emp_name=='' && $depart!='' && $start_date=='' && $end_date==''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE department='$depart'")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			$this->load->view('employee_section/employee_report',$data);
		}
		elseif($emp_name!='' && $depart=='' && $start_date=='' && $end_date==''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE empid='$emp_name'")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			$this->load->view('employee_section/employee_report',$data);
		}
		
		elseif($emp_name!='' && $depart!='' && $start_date=='' && $end_date==''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE empid='$emp_name' AND department='$depart' ")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			$this->load->view('employee_section/employee_report',$data);
		}
		elseif($emp_name!='' && $depart!='' && $start_date!='' && $end_date!=''){
			 $data['query']=$this->db->query("SELECT * FROM empee WHERE empid='$emp_name' AND department='$depart'")->result();
			 $data['depid']=$depart;
			 $data['empid']=$emp_name;
			 $data['stdate']=$start_date;
			 $data['etdate']=$end_date;
			$this->load->view('employee_section/employee_report',$data);
		}
		else{
			 $data['query']=$this->db->query("SELECT * FROM empee")->result();
			 $data['depid']='';
			 $data['empid']='';
			 $data['stdate']=date('d-m-Y');
			 $data['etdate']=date('d-m-Y');
			$this->load->view('employee_section/employee_report',$data);
		}		
	 }
	 
	  ////Employee Report Search close here/////
	  
 public function employee_report_details(){

  $this->load->view('employee_section/employee_report_details');
 }
 
 

	
public function delete_employee(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/delete_employee');
  $this->load->view('footer');
  
 }
 
 

 
 public function employee_salary_report(){

		$data=array(); 
           $data['query']=$this->db->query("select a.empid,b.name, a.month, a.years, a.salary,a.date,a.e_date
		   from emp_salary_his as a left join empee as b on a.empid=b.empid")->result(); 	  
		  $this->load->view('employee_section/employee_salary_report',$data);
 }

 /////Employee salary Report search start ////
 public function employee_salary_report_search(){
	 
	    $data=array();
		extract($_POST);
		$data=array();
		if($start_date!=''){
				  $ssdate=date('Y-m-d',strtotime($start_date));
		}
		if($end_date!=''){
				 $eedate=date('Y-m-d',strtotime($end_date));
		}
		
		
		if(empty($start_date) && empty($end_date) && empty($emp_name)){
		$data=array(); 

	 
           $data['query']=$this->db->query("select a.empid,b.name, a.month, a.years, a.salary,a.date,a.e_date
		   from emp_salary_his as a left join empee as b on a.empid=b.empid ")->result();	
		   $data['start_date']=$start_date;
		   $data['end_date']=$end_date;
		   $data['empid']=$emp_name;
		 			
		  $this->load->view('employee_section/employee_salary_report',$data);
		} 
		
		elseif(empty($start_date) && empty($end_date)){
		  $data=array(); 
           $data['query']=$this->db->query("select b.empid,a.name, b.month, b.years, b.salary,b.date,b.e_date
		   from emp_salary_his as b left join empee as a on b.empid=a.empid where a.empid='$emp_name'")->result();
		   
            $data['start_date']=$start_date;
		   $data['end_date']=$end_date;
		   $data['empid']=$emp_name;	
		   
		  $this->load->view('employee_section/employee_salary_report',$data);
		}
		
		elseif(empty($emp_name)){			
        $data=array(); 
           $data['query']=$this->db->query("select b.empid,a.name, b.month, b.years, b.salary,b.date,b.e_date
		   from emp_salary_his as b left join empee as a on b.empid=a.empid where b.date between '$ssdate' AND '$eedate'")->result();
		   
           $data['start_date']=$start_date;
		   $data['end_date']=$end_date;
		   $data['empid']=$emp_name;	
		   
		  $this->load->view('employee_section/employee_salary_report',$data);
		}
		
		else{
			 $data['query']=$this->db->query("select b.empid,a.name, b.month, b.years, b.salary,b.date,b.e_date
		   from empee as a left join emp_salary_his as b on a.empid=b.empid where a.empid='$emp_name' AND date(b.date) between '$ssdate' AND '$eedate'")->result();	
            $data['start_date']=$start_date;
		   $data['end_date']=$end_date;
		   $data['empid']=$emp_name;		   
		  $this->load->view('employee_section/employee_salary_report',$data);
		}
   }
   
    /////Employee salary Report search close ////
 
 
  public function edit_employee_salary_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/edit_employee_salary_report');
  $this->load->view('footer');
 }
 
 
 ////employee leave report start here
 
    public function employee_leave_report(){    
	$month=date('m'); 
	$year=date('Y');	
		$data=array();
		   $check=$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid,a.show_status,a.sdate, a.edate,a.comment,b.status,a.e_date
			from emp_reqlev as a  left join emp_approved as b  on b.reqid=a.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where month(a.e_date) between '01' AND '$month' AND year(a.e_date)='$year'")->result();	
          $data['start_date']=date('d-m-Y');
		  $data['end_date']=date('d-m-Y');	
		  $data['leavctg']=$leavctg;
		  $data['status']=$status;
		  $this->load->view('employee_section/employee_leave_report',$data);
	}	
 /////employee leave report close here 	

 public function employee_leave_report_search(){
	    $data=array();
		extract($_POST);
		$data=array();
		if($start_date!=''){
				  $ssdate=date('Y-m-d',strtotime($start_date));
		}
		if($end_date!=''){
				  $eedate=date('Y-m-d',strtotime($end_date));
		}
		if(empty($leavctg) && empty($start_date) && empty($end_date) && $status==''){
	
			 $data['query']=$this->db->query("")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status; 
		  $this->load->view('employee_section/employee_leave_report',$data);
		  
		}
		
		elseif(empty($start_date) && empty($end_date) && $status=='' ){
		
		 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from  emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg'")->result();	
		      $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		
		elseif(empty($start_date)&&empty($end_date)&&empty($leavctg)&&($status!='')){
			
		 if($status==0){
			$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,a.e_date
		   from emp_reqlev as a left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.show_status='$status'")->result();
		  
           $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		 }
		 else{
			$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status'")->result();
		  $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status; 
		 }
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		
		
		elseif(empty($leavctg) && $status==''){
		
		 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate'")->result();
           $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;		   
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		elseif(empty($start_date) && empty($end_date)&& $status==''){	
		
		$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND a.levid='$leavctg'")->result();	
		   $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		elseif($status==''){	
	
		$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg' AND date(a.e_date) between '$ssdate' AND '$eedate' ")->result();	
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		elseif(empty($leavctg)&& $status==''){
		
		$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND b.status='$status'")->result();	
		     $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		  $this->load->view('employee_section/employee_leave_report',$data);
		}
		
		elseif(empty($leavctg)){
			 if($status==0){
		
		$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND a.show_status='$status'")->result();	
		     $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		}
		else
			
		{
			$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(a.e_date) between '$ssdate' AND '$eedate' AND b.status='$status' ")->result();	
		     $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		 
		}
		$this->load->view('employee_section/employee_leave_report',$data);
		}
		
			elseif(empty($start_date)&&empty($end_date)){
			 if($status==0){
		
		$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg' AND a.show_status='$status'")->result();	
		     $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		}
		else
			
		{
			$data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b  on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg'  AND b.status='$status' ")->result();	
		     $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status;
		 
		}
		$this->load->view('employee_section/employee_leave_report',$data);
		}
		
		
			
	else{
		 if($status==0){
		 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		   from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.show_status='$status' AND date(a.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg'")->result();	
		   $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['leavctg']=$leavctg;
		   $data['status']=$status; 
		 }
		 
		else{
			 $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, a.show_status, a.sdate, a.edate,a.comment,b.status,a.e_date
		    from emp_reqlev as a  left join emp_approved as b on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND date(a.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg'")->result();	
		     $data['sdates']=$sdate;
		    $data['edates']=$edate;
		    $data['leavctg']=$leavctg;
		    $data['status']=$status;
	
		  }
		$this->load->view('employee_section/employee_leave_report',$data);
	  }
		
 }
 
     public function edit_employee_leave_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/edit_employee_leave_report');
  $this->load->view('footer');
 }
	
    public function employee_vacancy_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_vacancy_report');
  $this->load->view('footer');
 }
 

     public function edit_employee_vacancy_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/edit_employee_vacancy_report');
  $this->load->view('footer');
  
 }


    public function employee_attendance_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/employee_attendance_report');
  $this->load->view('footer');
 } 
	
    public function edit_employee_attendance_report(){
  $this->load->view('header');
  $this->load->view('leftbar');
  $this->load->view('employee_section/edit_employee_attendance_report');
  $this->load->view('footer');
  
 } 	

	   public function leave_request_approve_report(){
		   $month=date('m');
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid")->result();
		   $data['sdates']=date('d-m-Y');
		   $data['edates']=date('d-m-Y');
			$this->load->view('employee_section/leave_request_approve_report',$data);  
		 }

		    public function edit_leave_request_approve_report(){
             
			 if(isset($_GET['id'])){
			 $id=$_GET['id'];
				 
				 $data=array("status"=>"2");
				 $this->db->where("reqid",$id)->update("emp_approved",$data);
				 redirect("employee_reports/leave_request_approve_report","location");
			 }
			 
            } 	
		 
		 
		 
		 
		public function leave_request_approve_search(){
			
			extract($_POST);
			if($sdate!=''){
				 $ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				 $eedate=date('Y-m-d',strtotime($edate));
			}
			//echo $edate.','.$sdate.','.$status.','.$leavctg.','.$empids;exit;
		if($sdate=='' && $edate=='' && $status=='' && $leavctg=='' && $empids==''){	
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid ")->result();
		   $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		
		
		elseif($sdate!='' && $edate!='' && $status=='' && $leavctg=='' && $empids==''){	
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date
		   from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate'")->result();
		   $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status!='' && $leavctg=='' && $empids==''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND b.status='$status'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status!='' && $leavctg!='' && $empids==''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND b.status='$status' AND a.levid='$leavctg'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status!='' && $leavctg!='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND b.status='$status' AND a.levid='$leavctg' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status=='' && $leavctg!='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status!='' && $leavctg=='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND b.status='$status' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate!='' && $edate!='' && $status=='' && $leavctg!='' && $empids==''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where date(b.e_date) between '$ssdate' AND '$eedate' AND a.levid='$leavctg'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
			elseif($sdate=='' && $edate=='' && $status!='' && $leavctg=='' && $empids==''){
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
			elseif($sdate=='' && $edate=='' && $status=='' && $leavctg!='' && $empids==''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate=='' && $edate=='' && $status=='' && $leavctg=='' && $empids!=''){
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.empid='$empids'")->result();
		   $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate=='' && $edate=='' && $status!='' && $leavctg!='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND a.levid='$leavctg' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate=='' && $edate=='' && $status=='' && $leavctg!='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where a.levid='$leavctg' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate=='' && $edate=='' && $status!='' && $leavctg=='' && $empids!=''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND a.empid='$empids'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
		elseif($sdate=='' && $edate=='' && $status!='' && $leavctg!='' && $empids==''){					
		   $data=array();
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid where b.status='$status' AND a.levid='$leavctg'")->result();
		    $data['sdates']=$sdate;
		   $data['edates']=$edate;
		   $data['empid']=$empids;
		   $data['levid']=$leavctg;
		   $data['statu']=$status;
			$this->load->view('employee_section/leave_request_approve_report',$data);  
			}
			else{
			$data=array();
			$month=date('m');
		   $data['query']=$this->db->query("select a.reqid,a.empid,c.name,d.lev_type,a.levid, b.e_user, b.sdate, b.edate,b.comment,b.status,b.userid,b.e_date from emp_approved as b left join emp_reqlev as a on a.reqid=b.reqid left join empee as c on a.empid=c.empid left join emp_levtype as d on a.levid=d.levid WHERE month(b.e_date)='$month'")->result();
		    $data['sdates']=date('d-m-Y');
		   $data['edates']=date('d-m-Y');
		   $data['empid']='';
		   $data['levid']='';
		   $data['statu']='';
			$this->load->view('employee_section/leave_request_approve_report',$data);
			}
		 } 
		}
	?>
	
	
	