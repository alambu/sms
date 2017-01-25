<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_edit extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		$this->load->model('account_model_edit','accmodtwo');
		$this->load->model('account_model','accmodone');
		$this->load->model('numbertobangla','numbershow');
		if($stid==''){ redirect('login?error=2','location'); }
		
		
	}
		public function stuedit_scholarship(){
			$this->load->view('account/edit_form/edit_stu_scholarship');
		}
		public function stuedit_scholarship_edit(){
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);
			if($scholarship==''){
				echo "Sorry ! please Select Scholarship.";exit;
			}
			if($scholarship!=$scholarshipid){
				$sqlship=$this->db->query("UPDATE schship SET scholarship='$scholarship',up_date='$udate',up_user='$user' WHERE sshipid='$sshipids'");
			}
				foreach($_POST['amount'] as $cnt => $amount){						
				$sqlinset=$this->db->query("update  stu_sship_amount set amount='".$_POST['amount'][$cnt]."' ,calculates='".$_POST['persentage'][$cnt]."',up_date='$udate',up_user='$user' WHERE sshipdisid='".$_POST['shipamountid'][$cnt]."'");							
				}
			echo '1';exit;
		}
		public function scholarship_delete(){
			extract($_GET);
			$tables=array(
				'tcolum'=>'sshipid',
				'tableN'=>'schship'
			);
			$data=array(
				'values'=>$shipids,
			);
			$this->accmodtwo->delete($tables,$data);
			echo '1';
		}
		public function edit_classfee_catg(){
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);
			if(trim($tvalue)==''){
				echo "Sorry ! Category Name is Empty.";exit;
			}
			 $sql=$this->db->query("select catg_type FROM fee_catg where feectgid='$tvalue'")->row();
			 if($this->db->affected_rows()>0){
				 echo 'Sorry ! Duplicate Data not support.';exit;
			 }
			$tables=array(
				'tcolum'=>'feectgid',
				'tableN'=>'fee_catg',
				'values'=>$feectgid
			);
			$data=array(
				'catg_type'=>$tvalue,
				'up_date'=>$udate,
				'up_user'=>$user
			);
			$status=$this->accmodtwo->update($tables,$data);			
			if($status==1){
				echo '1';exit;
			}
			else{
				echo "Sorry ! Data update not successfully";exit;
			}
		}
		public function edit_classfee_catg_status(){
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);
			if(trim($tvalue)==''){
				echo "Sorry ! Category Name is Empty.";exit;
			}
			$tables=array(
				'tcolum'=>'feectgid',
				'tableN'=>'fee_catg',
				'values'=>$feectgid
			);
			$data=array(
				'status'=>$tvalue,
				'up_date'=>$udate,
				'up_user'=>$user
			);
			$status=$this->accmodtwo->update($tables,$data);			
			if($status==1){				
				echo '1'.'+'.$feectgid;exit;
			}
			else{
				echo "Sorry ! Data update not successfully";exit;
			}
		}
		public function edit_billpay_catg(){			
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);
			if(trim($tvalue)==''){
				echo "Sorry ! Field is Empty.";exit;
			}
			 $unqid=$_POST['uniqid'];
			 $tabname=$_POST['tabname'];
			 $checkcol=$_POST['cloname'];
			 $sql=$this->db->query("select $checkcol FROM $tabname where $checkcol='$tvalue'")->row();
			 if($this->db->affected_rows()>0){
				 echo 'Sorry ! Duplicate Data not support.';exit;
			 }			
			$tables=array(
				'tcolum'=>$_POST['uniqid'],
				'tableN'=>$_POST['tabname'],
				'values'=>$feectgid
			);
			$data=array(
				$_POST['cloname']=>trim($tvalue),
				'up_date'=>$udate,
				'up_user'=>$user
			);
			$status=$this->accmodtwo->update($tables,$data);			
			if($status==1){
				echo '1';exit;
			}
			else{
				echo "Sorry ! Data update not successfully";exit;
			}
		}
		public function edit_fee_setting_catgs(){
			print_r($_POST);EXIT;
		}
		public function edit_fee_setting_catg(){
			
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);
			if(trim($classid)==''){
				echo "Sorry ! Please Select Class Name.";exit;
			}
			if(trim($catgory)==''){
				echo "Sorry ! Please Select Category Name.";exit;
			}
			if(trim($amount)==''){
				echo "Sorry ! Amount is empty.";exit;
			}
			$tables=array(
				'tcolum'=>'feeid',
				'tableN'=>'class_fee_sett',
				'values'=>$rowid
			);			
			$data=array(				
				'classid'=>$classid,
				'feectgid'=>$catgory,
				'amount'=>$amount,
				'up_date'=>$udate,
				'up_user'=>$user
			);
			$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$classid' AND feectgid='$catgory' AND year='$year' AND feeid!='$rowid'");			
			if($this->db->affected_rows()>0){
				echo "Sorry ! This value all ready exits.";exit;
			}
			$status=$this->accmodtwo->update($tables,$data);			
			if($status==1){
				echo '1';exit;
			}
			else{
				echo "Sorry ! Data update not successfully";exit;
			}
		}
		public function search_other_income(){
			extract($_POST);
			$accid=$this->input->post('accnumber');
			$incatgname=$this->input->post('categoryid');
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($sdate!='' && $edate!=''&& $accid=='' && $incatgname==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM other_income  WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			elseif($sdate!='' && $edate!=''&& $accid!='' && $incatgname==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE accountid='$accid' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE accountid='$accid' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			elseif($sdate!='' && $edate!=''&& $accid=='' && $incatgname!=''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE income_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE income_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}	
			elseif($sdate!='' && $edate!=''&& $accid!='' && $incatgname!=''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE accountid='$accid' AND income_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE accountid='$accid' AND income_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;	
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			elseif($accid!='' && $incatgname!='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE accountid='$accid' AND income_type='$incatgname' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE accountid='$accid' AND income_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			elseif($accid!='' && $incatgname=='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE accountid='$accid' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE accountid='$accid'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			elseif($accid=='' && $incatgname!='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE income_type='$incatgname' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE income_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;		
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
			else{
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM other_income  WHERE  date(e_date) between '$today' AND '$today' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  other_income WHERE income_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=date('d-m-Y');
				$data['end_date']=date('d-m-Y');					
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_other_income',$data);
				$this->load->view('account/other_income_form',$data);
			}
		}
		public function search_expanse(){
			extract($_POST);
			$accid=$this->input->post('accnumber');
			$incatgname=$this->input->post('categoryid');
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($sdate!='' && $edate!=''&& $accid=='' && $incatgname==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM expance  WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			elseif($sdate!='' && $edate!=''&& $accid!='' && $incatgname==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE accountid='$accid' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE accountid='$accid' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			elseif($sdate!='' && $edate!=''&& $accid=='' && $incatgname!=''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE expance_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE expance_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}	
			elseif($sdate!='' && $edate!=''&& $accid!='' && $incatgname!=''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE accountid='$accid' AND expance_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE accountid='$accid' AND expance_type='$incatgname' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;	
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			elseif($accid!='' && $incatgname!='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE accountid='$accid' AND expance_type='$incatgname' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE accountid='$accid' AND expance_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;	
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			elseif($accid!='' && $incatgname=='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE accountid='$accid' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE accountid='$accid'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			elseif($accid=='' && $incatgname!='' && $sdate=='' && $edate==''){
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE expance_type='$incatgname' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE expance_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;		
				$data['start_date']=$sdate;
				$data['end_date']=$edate;
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
			else{
				$data=array();
				$today=date('Y-m-d');
				$sql=$this->db->query("SELECT * FROM expance  WHERE  date(e_date) between '$today' AND '$today' order by id asc");
				$data['query']=$sql->result();
				$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM  expance WHERE expance_type='$incatgname'")->row();
				$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
				$data['tamount']=$sql_sum->balance;
				$data['today_amount']=$sql_todaysum->balances;
				$data['start_date']=date('d-m-Y');
				$data['end_date']=date('d-m-Y');					
				$data['catgid']=$incatgname;					
				$data['accountid']=$accid;				
				//$this->load->view('account/viewlist/listof_expanse_details',$data);
				$this->load->view('account/expanse_form',$data);
			}
		}
		public function search_appfee(){
		
				$data=array();
				$today=date('Y-m-d');
				$year=date('Y');
				extract($_POST);
			$accid=$this->input->post('accnumber');
			$classN=$this->input->post('classname');
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($sdate!='' && $edate!=''&& $accid=='' && $classN==''){
				$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE date(a.e_date) between '$ssdate' AND '$eedate'  order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(amount) AS balance FROM app_fees WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
			elseif($sdate!='' && $edate!=''&& $accid=='' && $classN!=''){
				$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND b.appctgid='$classN' order by date(a.e_date) ASC;");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND b.appctgid='$classN'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
		elseif($sdate!='' && $edate!=''&& $accid!='' && $classN==''){
			$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND a.accountid='$accid' order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND a.accountid='$accid'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
	elseif($sdate!='' && $edate!=''&& $accid!='' && $classN!=''){
			$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND a.accountid='$accid' AND b.appctgid='$classN' order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE date(a.e_date) between '$ssdate' AND '$eedate' AND a.accountid='$accid' AND b.appctgid='$classN'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
	elseif($accid!='' && $classN!='' && $sdate=='' && $edate==''){
			$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE year(a.e_date)='$year' AND a.accountid='$accid' AND b.appctgid='$classN' order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE year(a.e_date)='$year' AND a.accountid='$accid' AND b.appctgid='$classN'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
	elseif($accid!='' && $classN=='' && $sdate=='' && $edate==''){
			$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE year(a.e_date)='$year' AND a.accountid='$accid' order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE year(a.e_date)='$year' AND a.accountid='$accid'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}
		elseif($accid=='' && $classN!='' && $sdate=='' && $edate==''){
			$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE year(a.e_date)='$year' AND b.appctgid='$classN' order by date(a.e_date) ASC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(a.amount) AS balance FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE year(a.e_date)='$year' AND b.appctgid='$classN'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;
		$data['catgid']=$classN;					
		$data['accountid']=$accid;		
		//$this->load->view('account/viewlist/listof_app_fee',$data);
		$this->load->view('account/app_fees_form',$data);
			}	
		
		else{
		$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,d.class_name,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid left join class_catg as d on c.classid=d.classid WHERE year(a.e_date)='$year' order by date(a.e_date) DESC;");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(amount) AS balance FROM app_fees WHERE year(e_date)='$year'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=date('d-m-Y');
		$data['end_date']=date('d-m-Y');
		$data['catgid']=$classN;					
		$data['accountid']=$accid;	
		$this->load->view('account/app_fees_form',$data);
		}
		}
	public function search_appfee_bk_payment(){
			$data=array();
			$today=date('Y-m-d');
			$year=date('Y');
			extract($_POST);
			$accid=$this->input->post('raccnumber');
			$sdate=$this->input->post('rsdate');
			$edate=$this->input->post('redate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($accid!='' && $sdate!='' && $edate!=''){
				$sql=$this->db->query("select * from bk_payment where accountid='$accid' AND date(e_date) BETWEEN '$ssdate' AND '$eedate'");
				$sql_sum=$this->db->query("select sum(amount) as balances from bk_payment where accountid='$accid' AND date(e_date) BETWEEN '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("select sum(amount) as balances from bk_payment where date(e_date) BETWEEN '$today' AND '$today'")->row();
				$data['rquery']=$sql->result();
				$data['rtamount']=$sql_sum->balances;
				$data['rtoday_amount']=$sql_todaysum->balances;
				$data['rstart_date']=$sdate;
				$data['rend_date']=$edate;
									
				$data['raccountid']=$accid;	
				$data['query']='';
				$data['tamount']='';
				$data['today_amount']='';
				$data['start_date']='';
				$data['end_date']='';
				$data['catgid']='';					
				$data['accountid']='';
				$this->load->view('account/app_fees_form',$data);
			}
			elseif($accid=='' && $sdate!='' && $edate!=''){
				$sql=$this->db->query("select * from bk_payment where date(e_date) BETWEEN '$ssdate' AND '$eedate'");
				$sql_sum=$this->db->query("select sum(amount) as balances from bk_payment where date(e_date) BETWEEN '$ssdate' AND '$eedate'")->row();
				$sql_todaysum=$this->db->query("select sum(amount) as balances from bk_payment where date(e_date) BETWEEN '$today' AND '$today'")->row();
				$data['rquery']=$sql->result();
				$data['rtamount']=$sql_sum->balances;
				$data['rtoday_amount']=$sql_todaysum->balances;
				$data['rstart_date']=$sdate;
				$data['rend_date']=$edate;
								
				$data['raccountid']=$accid;	
				$data['query']='';
				$data['tamount']='';
				$data['today_amount']='';
				$data['start_date']='';
				$data['end_date']='';
				$data['catgid']='';					
				$data['accountid']='';
				$this->load->view('account/app_fees_form',$data);
			}
			elseif($accid!='' && $sdate=='' && $edate==''){
				$sql=$this->db->query("select * from bk_payment where accountid='$accid'");
				$sql_sum=$this->db->query("select sum(amount) as balances from bk_payment where accountid='$accid'")->row();
				$sql_todaysum=$this->db->query("select sum(amount) as balances from bk_payment where date(e_date) BETWEEN '$today' AND '$today'")->row();
				$data['rquery']=$sql->result();
				$data['rtamount']=$sql_sum->balances;
				$data['rtoday_amount']=$sql_todaysum->balances;
				$data['rstart_date']=$sdate;
				$data['rend_date']=$edate;
									
				$data['raccountid']=$accid;	
				$data['query']='';
				$data['tamount']='';
				$data['today_amount']='';
				$data['start_date']='';
				$data['end_date']='';
				$data['catgid']='';					
				$data['accountid']='';
				$this->load->view('account/app_fees_form',$data);
			}
			else{
				$eyar=date('Y');
				$sql=$this->db->query("select * from bk_payment where year(e_date)='$eyar'");
				$sql_sum=$this->db->query("select sum(amount) as balances from bk_payment where year(e_date)='$eyar'")->row();
				$sql_todaysum=$this->db->query("select sum(amount) as balances from bk_payment where date(e_date) BETWEEN '$today' AND '$today'")->row();
				$data['rquery']=$sql->result();
				$data['rtamount']=$sql_sum->balances;
				$data['rtoday_amount']=$sql_todaysum->balances;
				$data['rstart_date']=$sdate;
				$data['rend_date']=$edate;
									
				$data['raccountid']=$accid;	
				$data['query']='';
				$data['tamount']='';
				$data['today_amount']='';
				$data['start_date']='';
				$data['end_date']='';
				$data['catgid']='';					
				$data['accountid']='';
				$this->load->view('account/app_fees_form',$data);
			}
	}
	public function search_scholarship(){
		extract($_POST);
		$data=array();
		if($classname!='' && $sections!='' && $shift!='' && $year==''){
			$sql=$this->db->query("SELECT * FROM rep_schship WHERE  classid='$classname' AND section='$sections' AND shiftid='$shift'");
		$data['query']=$sql->result();
		$data['classid']=$classname;
		$data['sectionid']=$sections;
		$data['shipid']=$shift;
		$data['years']=$year;
		//$this->load->view('account/viewlist/listof_scholarship_stu',$data);
		$this->load->view('account/stu_scholarship',$data);
		}
		elseif($classname!='' && $sections!='' && $shift!='' && $year!=''){
			$sql=$this->db->query("SELECT * FROM rep_schship WHERE  classid='$classname' AND section='$sections' AND shiftid='$shift' AND syear='$year'");
		$data['query']=$sql->result();
		$data['classid']=$classname;
		$data['sectionid']=$sections;
		$data['shipid']=$shift;
		$data['years']=$year;
		//$this->load->view('account/viewlist/listof_scholarship_stu',$data);
		$this->load->view('account/stu_scholarship',$data);
		}		
		else{
		$years=date('Y');
		$sql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$years'");
		$data['query']=$sql->result();
		$data['classid']=$classname;
		$data['sectionid']=$sections;
		$data['shipid']=$shift;
		$data['years']=$year;
		//$this->load->view('account/viewlist/listof_scholarship_stu',$data);
		$this->load->view('account/stu_scholarship',$data);
		}
	}
	public function search_scholarship_reporting(){
		extract($_POST);
		$years=date('Y');
		$data=array();
		if($rclassname!='' && $rsections!='' && $rshift!='' && $ryear==''){
		$rsql=$this->db->query("SELECT * FROM rep_schship WHERE  classid='$rclassname' AND section='$rsections' AND shiftid='$rshift'");
		$data['rquery']=$rsql->result();
		$sql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$years'");
		$data['query']=$sql->result();
		$data['rclassid']=$rclassname;
		$data['rsectionid']=$rsections;
		$data['rshipid']=$rshift;
		$data['ryears']=$ryear;
		$data['classid']='';
		$data['sectionid']='';
		$data['shipid']='';
		$data['years']='';
		$this->load->view('account/stu_scholarship',$data);
		}
		elseif($rclassname!='' && $rsections!='' && $rshift!='' && $ryear!=''){
			$rsql=$this->db->query("SELECT * FROM rep_schship WHERE  classid='$rclassname' AND section='$rsections' AND shiftid='$rshift' AND syear='$ryear'");
		$data['rquery']=$rsql->result();
		$sql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$years'");
		$data['query']=$sql->result();
		$data['rclassid']=$rclassname;
		$data['rsectionid']=$rsections;
		$data['rshipid']=$rshift;
		$data['ryears']=$ryear;
		$this->load->view('account/stu_scholarship',$data);
		}		
		else{
		$years=date('Y');
		$rsql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$years'");
		$data['rquery']=$rsql->result();
		$sql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$years'");
		$data['query']=$sql->result();
		$data['rclassid']=$rclassname;
		$data['rsectionid']=$rsections;
		$data['rshipid']=$rshift;
		$data['ryears']=$ryear;
		$this->load->view('account/stu_scholarship',$data);
		}
	}

// main ledger reporting start

	public function listof_main_ledger(){
		$this->load->view("header");
		$this->load->view("leftbar");
		$this->load->view('account/viewlist/listof_main_ledger');
		$this->load->view("footer");
	}

// main ledger reporting end

	public function search_main_ledger(){
				$data=array();
				$today=date('Y-m-d');
				extract($_POST);
			$accid=$this->input->post('accnumber');			
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}				
			if($accid!=''  && $sdate!='' && $edate!=''){
			$sql=$this->db->query("SELECT * FROM main_ledger WHERE accountid='$accid' && date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
			$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE accountid='$accid' && date(e_date) between '$ssdate' AND '$eedate'")->row();
			$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
			$data['credit_t']=$sql_sum->credit;
			$data['debit_t']=$sql_sum->debit;
			$data['today_credit']=$sql_todaysum->credit;
			$data['today_debit']=$sql_todaysum->debit;		
			$data['query']=$sql->result();
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$data['catgid']=$credebs;					
			$data['accountid']=$accid;	
			$this->load->view('account/viewlist/listof_main_ledger',$data);
		}
		elseif($accid=='' && $sdate!='' && $edate!=''){
			$sql=$this->db->query("SELECT * FROM main_ledger WHERE date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
			
			$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
			$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
			$data['credit_t']=$sql_sum->credit;
			$data['debit_t']=$sql_sum->debit;
			$data['today_credit']=$sql_todaysum->credit;
			$data['today_debit']=$sql_todaysum->debit;		
			$data['query']=$sql->result();
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$data['catgid']=$credebs;					
			$data['accountid']=$accid;	
			$this->load->view('account/viewlist/listof_main_ledger',$data);
		}
		elseif($accid!=''  && $sdate=='' && $edate==''){
			$sql=$this->db->query("SELECT * FROM main_ledger WHERE accountid='$accid' order by id ASC");
			
			$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE accountid='$accid'")->row();
			$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
			$data['credit_t']=$sql_sum->credit;
			$data['debit_t']=$sql_sum->debit;
			$data['today_credit']=$sql_todaysum->credit;
			$data['today_debit']=$sql_todaysum->debit;		
			$data['query']=$sql->result();
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$data['catgid']=$credebs;					
			$data['accountid']=$accid;	
			$this->load->view('account/viewlist/listof_main_ledger',$data);
		}
		
			else{
			$data=array();
			$sql=$this->db->query("SELECT * FROM main_ledger order by id DESC");
			$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger")->row();
			$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM main_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
			$data['credit_t']=$sql_sum->credit;
			$data['debit_t']=$sql_sum->debit;
			$data['today_credit']=$sql_todaysum->credit;
			$data['today_debit']=$sql_todaysum->debit;		
			$data['query']=$sql->result();
			$data['start_date']=date('d-m-Y');;
			$data['end_date']=date('d-m-Y');;
			$data['catgid']=$credebs;					
			$data['accountid']=$accid;	
			$this->load->view('account/viewlist/listof_main_ledger',$data);
		}
	}
	public function listof_student_ledger(){		
		$data=array();
		$today=date('Y-m-d');
		$dates=date('d-m-Y');
		$sql=$this->db->query("SELECT * FROM stu_ledger WHERE date(e_date) between '$today' AND '$today' order by id DESC limit 1000");
		$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['credit_t']=$sql_sum->credit;
		$data['debit_t']=$sql_sum->debit;
		$data['today_credit']=$sql_todaysum->credit;
		$data['today_debit']=$sql_todaysum->debit;			
		$data['query']=$sql->result();
		$data['start_date']=$dates;
		$data['end_date']=$dates;	
		$this->load->view('account/viewlist/listof_student_ledger',$data);
	}
	public function search_student_ledger(){
		$data=array();
		$today=date('Y-m-d');
		$stuid=$this->input->post('stuid');			
		$bilpay=$this->input->post('bilpay');			
		$sdate=$this->input->post('sdate');
		$edate=$this->input->post('edate');
		if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
		}
		if($edate!=''){
			$eedate=date('Y-m-d',strtotime($edate));
		}
		if($sdate!='' && $edate!='' && $stuid=='' && $bilpay==''){
		$sql=$this->db->query("SELECT * FROM stu_ledger WHERE date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['credit_t']=$sql_sum->credit;
		$data['debit_t']=$sql_sum->debit;
		$data['today_credit']=$sql_todaysum->credit;
		$data['today_debit']=$sql_todaysum->debit;			
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate!='' && $edate!='' && $stuid!='' && $bilpay==''){
		$sql=$this->db->query("SELECT * FROM stu_ledger WHERE stu_id='$stuid' AND date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE stu_id='$stuid' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE stu_id='$stuid' AND date(e_date) between '$today' AND '$today'")->row();
		$data['credit_t']=$sql_sum->credit;
		$data['debit_t']=$sql_sum->debit;
		$data['today_credit']=$sql_todaysum->credit;
		$data['today_debit']=$sql_todaysum->debit;
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate=='' && $edate=='' && $stuid!='' && $bilpay==''){
		$sql=$this->db->query("SELECT * FROM stu_ledger WHERE stu_id='$stuid' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE stu_id='$stuid'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE stu_id='$stuid' AND date(e_date) between '$today' AND '$today'")->row();
		$data['credit_t']=$sql_sum->credit;
		$data['debit_t']=$sql_sum->debit;
		$data['today_credit']=$sql_todaysum->credit;
		$data['today_debit']=$sql_todaysum->debit;		
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate=='' && $edate=='' && $stuid!='' && $bilpay!=''){
			if($bilpay==1){$generate='amount';$tabl='stu_bill';}
			if($bilpay==2){$generate='amount';$tabl='stu_pay';}
		$sql=$this->db->query("SELECT * FROM $tabl WHERE stu_id='$stuid' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM($generate) AS $generate  FROM $tabl WHERE stu_id='$stuid'")->row();
		$data['total_amount']=$sql_sum->$generate;	
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		$data['checks']='2';	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate=='' && $edate=='' && $stuid=='' && $bilpay!=''){
			if($bilpay==1){$generate='amount';$tabl='stu_bill';}
			if($bilpay==2){$generate='amount';$tabl='stu_pay';}
		$sql=$this->db->query("SELECT * FROM $tabl order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM($generate) AS $generate  FROM $tabl")->row();
		$data['total_amount']=$sql_sum->$generate;	
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		$data['checks']='2';	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate!='' && $edate!='' && $stuid=='' && $bilpay!=''){
			if($bilpay==1){$generate='amount';$tabl='stu_bill';}
			if($bilpay==2){$generate='amount';$tabl='stu_pay';}
		$sql=$this->db->query("SELECT * FROM $tabl WHERE  date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM($generate) AS $generate  FROM $tabl WHERE date(e_date) between '$ssdate' AND '$eedate'")->row();
		$data['total_amount']=$sql_sum->$generate;	
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		$data['checks']='2';	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		elseif($sdate!='' && $edate!='' && $stuid!='' && $bilpay!=''){
			if($bilpay==1){$generate='amount';$tabl='stu_bill';}
			if($bilpay==2){$generate='amount';$tabl='stu_pay';}
		$sql=$this->db->query("SELECT * FROM $tabl WHERE stu_id='$stuid' AND date(e_date) between '$ssdate' AND '$eedate' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM($generate) AS $generate  FROM $tabl WHERE stu_id='$stuid' AND date(e_date) between '$ssdate' AND '$eedate'")->row();
		$data['total_amount']=$sql_sum->$generate;	
		$data['query']=$sql->result();
		$data['stuids']=$stuid;
		$data['bilpay']=$bilpay;
		$data['start_date']=$sdate;
		$data['end_date']=$edate;	
		$data['checks']='2';	
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
		}
		else{			
		$sql=$this->db->query("SELECT * FROM stu_ledger WHERE date(e_date) between '$today' AND '$today' order by id ASC");
		$sql_sum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(credit) AS credit ,SUM(debit) as debit FROM stu_ledger WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['credit_t']=$sql_sum->credit;
		$data['debit_t']=$sql_sum->debit;
		$data['today_credit']=$sql_todaysum->credit;
		$data['today_debit']=$sql_todaysum->debit;		
		$data['query']=$sql->result();
		$data['stuids']='';
		$data['bilpay']='';
		$data['start_date']=date('d-m-Y');
		$data['end_date']=date('d-m-Y');
		//$this->load->view('account/viewlist/listof_student_ledger',$data);
		$this->load->view('account/student_payment_form',$data);
	}
	}
	public function bill_description($id){
		$data=array();
		$data['details']=$this->accmodtwo->details_bill($id);		
		$total=$this->accmodtwo->details_bill_sum($id);
		$data['t_amount']=$total->balance;
		$data['invoice']=$id;
		
		$this->load->view('account/viewlist/bill_details',$data);
	}
	public function print_moneyreceipt(){		
			extract($_GET);
			$data=array();			
			$this->load->view('account/invoice/moneyRec',$data);
		}
	public function search_class_fee_seting(){
			extract($_POST);
			$yeare=date('Y');

			if($classname!='' && $year!=''){

				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$classname' AND year='$year' order by year ASC");
				$data['query']=$sql->result();
				$data['query1']=$sql->result();
				$data['classid']=$classname;
				$data['years']=$year;
				$data['classid1']=$classname;
				$data['years1']=$year;
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view("header");
				$this->load->view("leftbar");
				$this->load->view('account/class_fee_sett',$data);
				$this->load->view("footer");
			}
			elseif($classname!='' && $year==''){
				
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$classname' order by feeid ASC");
				
				$data['query']=$sql->result();

				// $sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				
				$data['query1']=$sql->result();
				$data['classid']=$classname;
				$data['years']=$year;
				$data['classid1']=$classname;
				$data['years1']=$year;
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view("header");
				$this->load->view("leftbar");
				$this->load->view('account/class_fee_sett',$data);
				$this->load->view("footer");
			}
			elseif($classname=='' && $year!=''){
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$year' order by classid ASC");
				$data['query']=$sql->result();

				$data['query1']=$sql->result();
				$data['classid']=$classname;
				$data['years']=$year;
				$data['classid1']=$classname;
				$data['years1']=$year;
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view("header");
				$this->load->view("leftbar");
				$this->load->view('account/class_fee_sett',$data);
				$this->load->view("footer");
			}
			else{
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				
				$data['query']=$sql->result();
				$data['query1']=$sql->result();
				$data['classid']='';
				$data['years']=$yeare;
				$data['classid1']='';
				$data['years1']=$yeare;
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view("header");
				$this->load->view("leftbar");
				$this->load->view('account/class_fee_sett',$data);
				$this->load->view("footer");
			}
		}
		public function search_class_fee_seting_reporting(){
			extract($_POST);
			$yeare=date('Y');
			if($classname!='' && $year!=''){
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				$data['query']=$sql->result();
				$sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$classname' AND year='$year' order by year ASC");
				$data['query1']=$sql1->result();
				$data['classid1']=$classname;
				$data['years1']=$year;
				$data['classid']='';
				$data['years']='';
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view('account/class_fee_sett',$data);
			}
			elseif($classname!='' && $year==''){
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				$data['query']=$sql->result();
				$sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$classname' order by classid ASC");
				$data['query1']=$sql1->result();
				$data['classid1']=$classname;
				$data['years1']=$year;
				$data['classid']='';
				$data['years']='';
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view('account/class_fee_sett',$data);
			}
			elseif($classname=='' && $year!=''){
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				$data['query']=$sql->result();
				$sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$year' order by classid ASC");
				$data['query1']=$sql1->result();
				$data['classid1']=$classname;
				$data['years1']=$year;
				$data['classid']='';
				$data['years']='';
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view('account/class_fee_sett',$data);
			}
			else{
				$data=array();
				$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				$data['query']=$sql->result();
				$sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
				$data['query1']=$sql1->result();
				$data['classid1']='';
				$data['years1']=$yeare;
				$data['classid']='';
				$data['years']='';
				//$this->load->view('account/viewlist/listof_class_fee_setting',$data);
				$this->load->view('account/class_fee_sett',$data);
			}
		}
			public function appidamount(){				
				extract($_POST);
				if($appids==''){
					echo "Application ID is Empty.";exit;
				}
				$sql=$this->db->query("select appctgid FROM application_tbl WHERE appid='$appids'");
				if($this->db->affected_rows()<1){
					echo "Sorry ! Application Id is incorrect. ";exit;
				}
				$sqlss=$this->db->query("SELECT appid FROM app_fees WHERE appid='$appids'");
				if($this->db->affected_rows()>0){
					echo "Congratulation !You All ready payment complete";exit;
				}
				$sql_row=$sql->row();
				$appctg=$sql_row->appctgid;
				$apsql=$this->db->select('*')->from('application_catg')->WHERE('appctgid',$appctg)->get()->row();
				$clid=$apsql->classid;
				$sql_class=$this->db->select("class_name")->from("class_catg")->where("classid",$clid)->limit(1)->get()->row();
				echo $sql_class->class_name.','.$apsql->fee;exit;
								
			}
			public function print_appfee_moneyRec(){			
			$this->load->view('account/invoice/moneyRec_cashfee');
			}
			public function print_otherincome_moneyRec(){			
			$this->load->view('account/invoice/other_income_invoice');
			}
			public function expanse_print(){	
			$data=array();
			$data['payinvoices']=$this->session->userdata("moneyinv");			
			$this->load->view('account/invoice/expanse_first',$data);
			}
			public function print_expanse_moneyRec(){			
			$this->load->view('account/invoice/expanse_invoice');
			}
			function bill_generate_reporating(){
				$data=array();
				$today=date('Y-m-d');
				$classid=$this->input->post('classid');					
				$sdate=$this->input->post('sdate');
				$edate=$this->input->post('edate');
				if($sdate!='' && $edate==''){
					echo "Please Select To Month.";exit;
				}
				if($sdate=='' && $edate!=''){
					echo "Please Select From Month.";exit;
				}
				if($sdate!=''){
					$ssdate=date('Y-m-d',strtotime($sdate));
				}
				if($edate!=''){
					$eedate=date('Y-m-d',strtotime($edate));
				}
				
				if($classid!='' && $sdate!='' && $edate!=''){
					
					$data['rquery']=$this->db->query("SELECT * FROM stu_bill WHERE classid='$classid' AND date(e_date) between '$ssdate' AND '$eedate'")->result();
					$data['classids']=$classid;
					$data['ssdate']=$sdate;
					$data['esdate']=$edate;
					$this->load->view("account/bill_generate/bill_gefpage",$data);
					
				}
				elseif($classid!='' && $sdate=='' && $edate==''){
					$data['rquery']=$this->db->query("SELECT * FROM stu_bill WHERE classid='$classid'")->result();
					$data['classids']=$classid;
					$data['ssdate']=$sdate;
					$data['esdate']=$edate;
					$this->load->view("account/bill_generate/bill_gefpage",$data);
				}
				elseif($classid=='' && $sdate!='' && $edate!=''){
					$data['rquery']=$this->db->query("SELECT * FROM stu_bill WHERE date(e_date) between '$ssdate' AND '$eedate'")->result();
					$data['classids']=$classid;
					$data['ssdate']=$sdate;
					$data['esdate']=$edate;
					$this->load->view("account/bill_generate/bill_gefpage",$data);
				}
				else{
					$data['rquery']=$this->db->query("SELECT * FROM stu_bill WHERE date(e_date) between '$today' AND '$today'")->result();
					$data['classids']=$classid;
					$data['ssdate']=date('d-m-Y');
					$data['esdate']=date('d-m-Y');
					$this->load->view("account/bill_generate/bill_gefpage",$data);
				}
			}
		public function add_balance_insert(){
			$edate=date('Y-m-d h:s:a');
			$udate=date('Y-m-d H:i:s');
			$user=$this->session->userdata("userN");
			extract($_POST);
			if(trim($accountid)==''){echo "Please Select Account Number.";exit;}
			if(trim($amount)==''){echo "Please Type your Amount.";exit;}
			$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_id,5),'BADD-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_id,5)),0)+1)),
					IFNULL(MAX(RIGHT(invoice_id,5)),0)+1
					)
					FROM add_balance")or die(mysql_error());  
					$cqryresult = mysql_fetch_array($cquery);
				    $balanc_invoice = $cqryresult[0];
					$data=array(
					'invoice_id'=>$balanc_invoice,
					'accountid'=>$accountid,
					'balance'=>$amount,
					'comment'=>$comment,
					'e_user'=>$user
					);
					
					$status=$this->accmodtwo->balance_add_insert($data);
					if($status==1){
						$accsql=$this->db->query("SELECT balance FROM account_cre WHERE accountid='$accountid'")->row();
									$accbalance=$accsql->balance;
									$newbalance=$accbalance+$amount;
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM main_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;									
								$leger=array(
									'trans_id'=>$legtransid,
									'accountid'=>$accountid,
									'boucher_no'=>$balanc_invoice,
									'perpose'=>'Balance Add |'.$accountid.'|'.$balanc_invoice,
									'credit'=>$amount,
									'debit'=>'0.00',
									'balance'=>$newbalance,
									'e_user'=>$user,
									'e_date'=>$edate
								);
								$legsql=$this->accmodone->legderinsert($leger);
								if($legsql==1){
								$sqlaccup=$this->db->query("UPDATE account_cre SET balance='$newbalance',up_date='$udate',up_user='$user' WHERE accountid='$accountid'");
								echo "1";exit;
								}
								echo "Balance Add Successfully But Ledger not update.";exit;
					}
					echo "Sorry ! Data insert not successfully.";exit;
		}
		public function search_balance_add(){
			extract($_POST);
			$data=array();
			$months=date('m');
			$accid=$this->input->post('accnumber');
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($accid!='' && $sdate!="" && $edate!=""){				
			$data['query']=$this->db->query("select * from add_balance where accountid='$accid' and  date(e_date) between '$ssdate' AND '$eedate' ")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from add_balance where accountid='$accid' and  date(e_date) between '$ssdate' AND '$eedate' ")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/add_balance',$data);
			}
			elseif($accid=='' && $sdate!="" && $edate!=""){				
			$data['query']=$this->db->query("select * from add_balance where date(e_date) between '$ssdate' AND '$eedate' ")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from add_balance where date(e_date) between '$ssdate' AND '$eedate'")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/add_balance',$data);
			}
			elseif($accid!='' && $sdate=="" && $edate==""){				
			$data['query']=$this->db->query("select * from add_balance where accountid='$accid'")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from add_balance where accountid='$accid'")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/add_balance',$data);
			}
			else{
				$data['query']=$this->db->select("*")->from("add_balance")->where("month(e_date)",$months)->get()->result();
				$data['tamount']=$this->db->select("sum(balance) as balance")->from("add_balance")->get()->row();
				$data['accountid']='';
				$data['start_date']='';
				$data['end_date']='';
			$this->load->view('account/add_balance',$data);
			}
		}


// account transfer section
public function balance_transper(){
	$data=array();
	$months=date('m');
	$data['query']=$this->db->select("*")->from("bank_transfer")->where("month(edate)",$months)->get()->result();
	$data['tamount']=$this->db->select("sum(trans_balance) as balance")->from("bank_transfer")->get()->row();
	$this->load->view('account/balance_transper',$data);
}
// account transfer section end


		public function balance_transfer_insert(){
			extract($_POST);
			$edate=date('Y-m-d h:s:a');
			$udate=date('Y-m-d H:i:s');
			$user=$this->session->userdata("userN");
			extract($_POST);
			if(trim($accountid)==''){echo "Please Select Transfer Account Number.";exit;}
			if(trim($recaccount)==''){echo "Please Select Received Account Number.";exit;}
			if(trim($amount)==''){echo "Please Type your Amount.";exit;}
			if(trim($accountid)==trim($recaccount)){echo "Sorry! Transfer Account And Received Account is same.";exit;}
			$accsql=$this->db->query("SELECT balance FROM account_cre WHERE accountid='$accountid'")->row();
				$tranAccb=$accsql->balance;
				if($tranAccb<$amount){
					echo "Sorry ! Amount is greater than total Balance.";exit;
				}
			$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_id,5),'BTRS-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_id,5)),0)+1)),
					IFNULL(MAX(RIGHT(invoice_id,5)),0)+1
					)
					FROM bank_transfer")or die(mysql_error());  
					$cqryresult = mysql_fetch_array($cquery);
				    $balanc_invoice = $cqryresult[0];
					$data=array(
					'invoice_id'=>$balanc_invoice,
					'tranAcc'=>$accountid,
					'recAcc'=>$recaccount,
					'balance'=>$amount,
					'comment'=>$comment,
					'e_user'=>$user,
					'up_date'=>'',
					'up_user'=>'',
					);
					
					$status=$this->accmodtwo->balance_transfer_insert($data);
					if($status==1){
						$newtranAccB=$tranAccb-$amount;
						$rec_accsql=$this->db->query("SELECT balance FROM account_cre WHERE accountid='$recaccount'")->row();
									$rec_balance=$rec_accsql->balance;
									$rec_newbalance=$rec_balance+$amount;
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM main_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;									
								$leger=array(
									'trans_id'=>$legtransid,
									'accountid'=>$accountid,
									'boucher_no'=>$balanc_invoice,
									'perpose'=>'Transfer |'.$accountid.' to '.$recaccount.'|'.$balanc_invoice,
									'credit'=>'0.00',
									'debit'=>$amount,
									'balance'=>$newtranAccB,
									'e_user'=>$user,
									'e_date'=>$edate
								);
								$legsql=$this->accmodone->legderinsert($leger);
								if($legsql==1){
								$sqlaccup=$this->db->query("UPDATE account_cre SET balance='$newtranAccB',up_date='$udate',up_user='$user' WHERE accountid='$accountid'");
								}
								$tranidquerys=$this->db->query("SELECT MAX(trans_id) as trans_id FROM main_ledger")->row();
								 $legtranss=$tranidquerys->trans_id;
								 $legtransids=$legtranss+1;
								$leger2=array(
									'trans_id'=>$legtransids,
									'accountid'=>$recaccount,
									'boucher_no'=>$balanc_invoice,
									'perpose'=>'Received |'.$recaccount.' From '.$accountid.'|'.$balanc_invoice,
									'credit'=>$amount,
									'debit'=>'0.00',
									'balance'=>$rec_newbalance,
									'e_user'=>$user,
									'e_date'=>$edate
								);
								$legsqls=$this->accmodone->legderinsert($leger2);
								if($legsqls==1){
								$sqlaccup=$this->db->query("UPDATE account_cre SET balance='$rec_newbalance',up_date='$udate',up_user='$user' WHERE accountid='$recaccount'");
								echo "1";exit;
								}
								echo "Balance Add Successfully But Ledger not update.";exit;
					}
					echo "Sorry ! Data insert not successfully.";exit;
			
		}
		public function search_balance_transfer(){
			extract($_POST);
			$data=array();
			$months=date('m');
			$accid=$this->input->post('accnumber');
			$sdate=$this->input->post('sdate');
			$edate=$this->input->post('edate');
			if($sdate!=''){
				$ssdate=date('Y-m-d',strtotime($sdate));
			}
			if($edate!=''){
				$eedate=date('Y-m-d',strtotime($edate));
			}
			if($accid!='' && $sdate!="" && $edate!=""){				
			$data['query']=$this->db->query("select * from bank_transfer where tranAcc='$accid' and  date(e_date) between '$ssdate' AND '$eedate' ")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from bank_transfer where tranAcc='$accid' and  date(e_date) between '$ssdate' AND '$eedate' ")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/balance_transper',$data);
			}
			elseif($accid=='' && $sdate!="" && $edate!=""){				
			$data['query']=$this->db->query("select * from bank_transfer where date(e_date) between '$ssdate' AND '$eedate' ")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from bank_transfer where date(e_date) between '$ssdate' AND '$eedate' ")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/balance_transper',$data);
			}
			elseif($accid!='' && $sdate=="" && $edate==""){				
			$data['query']=$this->db->query("select * from bank_transfer where tranAcc='$accid'")->result();
			$data['tamount']=$this->db->query("select sum(balance) as balance from bank_transfer where tranAcc='$accid'")->row();
			$data['accountid']=$accid;
			$data['start_date']=$sdate;
			$data['end_date']=$edate;
			$this->load->view('account/balance_transper',$data);
			}
			else{
				$months=date('m');
				$data['query']=$this->db->select("*")->from("bank_transfer")->where("month(e_date)",$months)->get()->result();
				$data['tamount']=$this->db->select("sum(balance) as balance")->from("bank_transfer")->get()->row();
				$data['accountid']='';
				$data['start_date']='';
				$data['end_date']='';
				$this->load->view('account/balance_transper',$data);
			}
		}
}
?>