<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		
		if($stid==''){ redirect('login?error=2','location'); 
		}
		$this->load->model('account_model','accmodone');
		$this->load->model('account_model_edit','accmodtwo');
		$this->load->model('numbertobangla','numbershow');
		$this->load->helper('date');
	}

// class wise fees amount setting start

	public function class_fee_sett(){
		$data=array();
		$yeare=date('Y');
		$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
		$data['query']=$sql->result();
		$sql1=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
		$data['query1']=$sql1->result();
		$data['classid']='';
		$data['years']='';

		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/class_fee_sett',$data);
		$this->load->view('footer');

	}

// check duplicate class fees
	public function chkDuplicateCls(){
		extract($_POST);

		$data = array(
				"classid" => $cls,
				"year"	  => $y
			);
		
		$duplicate = $this->db->get_where("class_fee_sett",$data)->num_rows();

		if($duplicate):
			echo 1;
		else:
			echo 0;
		endif;

	}

// class wise fees amount setting end

// single category setting
	public function class_fee_sett_single(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/class_fee_sett_single');
		$this->load->view('footer');
	}
	
// single category fees setting end

	public function stu_bill_catg(){
		$this->load->view('account/stu_bill_catg');
	}

// new account opening start

	public function account_open(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/account_open');
		$this->load->view('footer');
	}
	
// new account Balance Transfer

	public function balanceTransfer(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/balanceTransfer');
		$this->load->view('footer');
	}

// new account open end

// expanse accountability start
	public function expanse_form(){	
		$this->load->view('header');
		$this->load->view('leftbar');	
		$this->load->view('account/expanse_form');
		$this->load->view('footer');
	}
// expanse accountability end

// expanse entry part of check method
	public function checkshow(){
		$this->load->view('account/chekshow');
	}
// expanse entry part of check method end

	// income start sector
	public function income_checksohow(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/other_income_form');
		$this->load->view('footer');
	}

// income end

	public function extincome_checksohow(){
		$this->load->view('account/income_chekshow');
	}

// student payment start

	public function student_payment_form(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/student_payment_form');
		$this->load->view('footer');
	}
// student payment section end

	public function searchstubillpay(){
		$this->load->view('account/search_stu_payment');
	}
	
	// student general settings start

	public function student_fee_catg(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/fee_catg');
		$this->load->view('footer');
	}

	// student general settings end
	
	public function application_fee_form(){
		$data=array();
		$today=date('Y-m-d');
		$dates=date('d-m-Y');
		$year=date('Y');
		/*$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE year(a.e_date)='$year' order by date(a.e_date) DESC");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(amount) AS balance FROM app_fees WHERE year(e_date)='$year'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$dates;
		$data['end_date']=$dates;*/
		$this->load->view('account/app_fees_form',$data);
	}
	public function student_payment_bill(){
		$this->load->view('account/student_bill_form');
	}
	public function search_billgenerate(){
		
		$this->load->view('account/search_stu_billcreate');
	}
	
	public function testing(){
		$this->load->view('account/testing');
	}
	public function classfeecatagory(){
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		if(isset($_POST['title'])){
			$i=0;
			foreach($_POST['title'] as $cnt => $title) {
				if(!empty($_POST['title'][$cnt])){
					$catg=$_POST['title'][$cnt];
					$sql=$this->db->query("SELECT catg_type FROM fee_catg WHERE catg_type='$catg' limit 1");
					if($this->db->affected_rows()<1){						
						 $sqlinset=$this->db->query("INSERT INTO fee_catg (catg_type,status,e_date,e_user,up_user) values('$title','1','$edate','$user','')");
						 $i++;
					}
				}
				if($i>0){
					echo '1';exit;
				}				
			}				
		}
		echo "Sorry ! Data insert not Successfully.";exit;
	}
	
	public function classfeesett(){
		$class=$this->input->post('classname');
			//year=date('Y');
			$year=$this->input->post('year_text');
			 $date_check=date('Y');
			 $date_check1=date('Y')+1;
				if($year<$date_check){echo "Hello ! Are you try to hack.";exit;}
				if($year>$date_check1){echo "Hello ! Are you try to hack.";exit;}
			$sql=$this->db->query("select * from class_fee_sett where classid='$class' and year='$year'");
			if($this->db->affected_rows()>0){
				echo "Sorry ! You all ready complete this class fee.";exit;
			}
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		if(isset($_POST['title'])){
			$i=0;			
			foreach($_POST['amount'] as $cnt => $amount) {						
						$sqlinset=$this->db->query("INSERT INTO class_fee_sett (classid,feectgid,amount,year,e_date,e_user,up_user) values('$class','".$_POST['title'][$cnt]."','".$_POST['amount'][$cnt]."','$year','$edate','$user','')");
						 $i++;
				
			}
			if($i>0){
					echo '1';exit;
				}		
		}
		echo "Sorry ! Data insert not Successfully.";exit;
	}
	
// check category fees settings
	public function classfeesett_single(){
		extract($_POST);
			if($classname==''){
				echo "Please Select class Name";exit;
			}
			if($title==''){
				echo "Please Select Category Name";exit;
			}
			if($amount==''){
				echo "Amount is Empty";exit;
			}
			
			$class = $this->input->post('classname');
			$title = $this->input->post('title');
			
			//$year=date('Y');
			$year=$year_text;
			$date_check=date('Y');
			$date_check1=date('Y')+1;
				
				if($year<$date_check){echo "Hello ! Are you try to hack.";exit;}
				if($year>$date_check1){echo "Hello ! Are you try to hack.";exit;}
				
				$sql = $this->db->query("select * from class_fee_sett where classid='$class' AND feectgid='$title' AND year='$year'");
			
				if($this->db->affected_rows()>0){
					echo "Sorry.This category fees already settup for this class.";exit;
				}

				$edate = date('Y-m-d h:s:a');
				$user = $this->session->userdata("userN");
		
				if(isset($_POST['title'])){
			
					$data=array(
						'classid'=>$classname,
						'feectgid'=>$title,
						'amount'=>$amount,
						'year'=>$year,
						'e_date'=>$edate,
						'e_user'=>$user,
						'up_user'=>'',				
					);	
				
					$sql_query = $this->accmodone->classfeesett_sin($data);
			
					if($sql_query>0){
						echo '1';exit;
					}
					echo "Sorry ! Data insert not Successfully.";exit;
				}

		echo "Sorry ! Please select Category.";exit;
	}

// category fees setting end

	public function student_bill_catginsert(){
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		if(isset($_POST['title'])){
			$i=0;
			foreach($_POST['title'] as $cnt => $title) {
				if(!empty($_POST['title'][$cnt])){
					$catg=$_POST['title'][$cnt];
					$sql=$this->db->query("SELECT billpay_type FROM billpay_catg WHERE billpay_type='$catg' limit 1");
					if($this->db->affected_rows()<1){						
						 $sqlinset=$this->db->query("INSERT INTO billpay_catg (billpay_type,e_date,e_user,up_user) values('$title','$edate','$user','')");
						 $i++;
					}
				}
				if($i>0){
					echo '1';exit;
				}				
			}		
		}
		echo "Sorry ! Data insert not Successfully.";exit;
	}
		public function expanse_catginsert(){
			
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		if(isset($_POST['title'])){
			$i=0;
			foreach($_POST['title'] as $cnt => $title) {
				
				if(!empty($_POST['title'][$cnt])){
					
					 $catg=$_POST['title'][$cnt];
					$sql=$this->db->query("SELECT expance_type FROM expance_catg WHERE expance_type='$catg' limit 1");					
					if($this->db->affected_rows()<1){							
						 $sqlinset=$this->db->query("INSERT INTO expance_catg (expance_type,e_date,e_user,up_user) values('$title','$edate','$user','')");
						 $i++;
					}
				}
				if($i>0){
					echo '1';exit;
				}				
			}		
		}
		echo "Sorry ! Data insert not Successfully.";exit;
	}

	
	public function income_catginsert(){
			
		$edate=date('Y-m-d h:s:a');
		if(isset($_POST['title'])){
			$i=0;
			foreach($_POST['title'] as $cnt => $title) {
				
				if(!empty($_POST['title'][$cnt])){
					
					 $catg=$_POST['title'][$cnt];
					$sql=$this->db->query("SELECT income_type FROM income_catg WHERE income_type='$catg' limit 1");					
					if($this->db->affected_rows()<1){							
						 $sqlinset=$this->db->query("INSERT INTO income_catg (income_type,e_date,e_user,up_user) values('$title','$edate','$user','')");
						 $i++;
					}
				}
				if($i>0){
					echo '1';exit;
				}				
			}		
		}
		echo "Sorry ! Data insert not Successfully.";exit;
	}
	
// new account insert
	public function accountopen_insert(){
		$edate = date('Y-m-d h:s:a');
		$user = $this->session->userdata("userN");
		extract($_POST);
		//print_r($_POST);exit;
		$sql = $this->db->query("SELECT accountid FROM account_cre WHERE accountid = '$accnumber'");
			
			if($this->db->affected_rows()>0){
				echo "Sorry ! This Account Number All Ready exits.";exit;
			}

			if(!(isset($bankname))) $bankname = '';

		// account information
		$data = array(
			'accountid' => $accnumber,
			'acc_name'  => $accname,
			'bank_name' => $bankname,
			'bank_type' => $type,
			'balance'   => $openbalance,
			'e_date'    => $edate,
			'e_user'    => $user
		);
		
		$trans_id = $this->accmodone->transactionId();
		$invoice_id = $this->accmodone->incInvoiceId();

		//////////////////////////////////
		//	trans_type				   //
		//  1-> opening balances 	  //
		//	2-> student bill income  //
		//	3-> extra income        //
		//	4-> expanse 			//
		//  trans_category 		   //
		//  5-> advanced payment   //
		//  6-> cash to bank       //
		//  7-> bank to cash       //
		///////////////////////////

		$m = date("m");
		$y = date("Y");

		// main ledger info
		$mLedger = array(
				"trans_id" 	   => $trans_id,
				"accountid"    => $accnumber,
				"invoice_no"   => $invoice_id,
				"trans_type"   => 1,
				"trans_method" => 1,
				"check_no" 	   => 0,
				"debit" 	   => $openbalance,
				"balance" 	   => $openbalance,
				"month" 	   => $m,
				"year" 		   => $y,
				"e_user" 	   => $user
			);

		$upsql = $this->accmodone->accountinsert($data);
		$ledger = $this->accmodone->mainLedger($mLedger);
		
		if( $ledger && $upsql ){
			echo 1;
		}
		else{
			echo "Sorry ! Data insert not successfully";exit;
		}
	}

// income data insert

	public function extraincome_insert(){
		$edate = date('Y-m-d h:s:a');
		$user = $this->session->userdata("userN");
		$m = date("m");
		$y = date("Y");

		extract($_POST);
		

		$sql = $this->db->query("SELECT * FROM account_cre WHERE accountid = '$accnumber'");
			
			if($this->db->affected_rows()<1){
				echo "Sorry ! Account Number is empty.";exit;
			}

			$trans_id = $this->accmodone->transactionId();
			$invoice_id = $this->accmodone->incInvoiceId();
			
			// if cash transaction
			if(isset($checknunber)):$checknunber = $checknunber;
			else:$checknunber = '';
			endif;

			// if cash transaction
			if(isset($personN)):$personN = $personN;
			else:$personN = '';
			endif;

			// get account balance
			$balance = $this->db->query("SELECT balance FROM account_cre WHERE accountid = '$accnumber'")->row();

			$newBalance = $balance->balance + $amount;

			// data
			$data = array(
					"trans_id" 	   => $trans_id,
					"accountid"    => $accnumber,
					"invoice_no"   => $invoice_id,
					"trans_type"   => 3,
					"trans_catg"   => $incomecatg,
					"trans_method" => $method,
					"check_no" 	   => $checknunber,
					"pay_person"   => $personN,
					"debit" 	   => $amount,
					"credit"	   => 0,
					"balance" 	   => $newBalance,
					"month" 	   => $m,
					"year" 		   => $y,
					"e_user" 	   => $user,
					"e_date"	   => $edate
				);

			$mainLedger = $this->db->insert("main_ledger",$data);

			$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newBalance',up_user = '$user' WHERE accountid = '$accnumber'");

			if($mainLedger && $accUpdate):
				echo 1;
			else:
				echo "Income does not save";
			endif;


	}

// income data insert end

// expanse insert start
	public function expanse_insert(){
		$edate = date('Y-m-d h:s:a');
		$user = $this->session->userdata("userN");
		$m = date("m");
		$y = date("Y");

		extract($_POST);

		$accIno = $this->db->query("SELECT balance FROM account_cre WHERE accountid = '$accnumber'")->row();

		// check this account exits or not ?
			if($this->db->affected_rows()<1){
				echo "Sorry ! Account Number is empty.";exit;
			}

			// check if expanse money more than balance
			if( $accIno->balance < $amount ){
				echo "Sorry ! Balance is not Available";exit;
			}

			$newBalance = $accIno->balance - $amount;

			// get transaction and invoice no
			$trans_id = $this->accmodone->transactionId();
			$invoice_id = $this->accmodone->expInvoiceId();
			
			// if cash transaction
			if(isset($checknunber)):$checknunber = $checknunber;
			else:$checknunber = '';
			endif;

			// if cash transaction
			if(isset($personN)):$personN = $personN;
			else:$personN = '';
			endif;

			// data
			$data = array(
					"trans_id" 	   => $trans_id,
					"accountid"    => $accnumber,
					"invoice_no"   => $invoice_id,
					"trans_type"   => 4,
					"trans_catg"   => $expansectg,
					"trans_method" => $method,
					"check_no" 	   => $checknunber,
					"pay_person"   => $personN,
					"debit" 	   => 0,
					"credit"	   => $amount,
					"balance" 	   => $newBalance,
					"month" 	   => $m,
					"year" 		   => $y,
					"e_user" 	   => $user,
					"e_date"	   => $edate
				);


			$mainLedger = $this->db->insert("main_ledger",$data);

			$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newBalance',up_user = '$user' WHERE accountid = '$accnumber'");

			if($mainLedger && $accUpdate):
				echo 1;
			else:
				echo "Expanse does not save";
			endif;

	}

// expanse entry end

// Balance Transfer start
	public function balanceTransferEntry(){
		//print_r($_POST);exit;
		extract($_POST);
		if($transtype==6){
			$this->transferCashToBank($_POST);
		}
		elseif($transtype==7){
			$this->transferBankToCash($_POST);
		}
		else {
			echo "Transfer Type Not Found";exit;
		}
	}
	
	public function transferCashToBank($pstdata) {
		
		$edate = date('Y-m-d h:s:a');
		$user = $this->session->userdata("userN");
		$m = date("m");
		$y = date("Y");
		extract($pstdata);
		$cashaccount= $this->db->query("SELECT * FROM account_cre WHERE bank_type = 1 limit 1")->row();
		$banckaccount= $this->db->query("SELECT * FROM account_cre WHERE bank_type = 2 and accountid='$bankaccno' limit 1")->row();
		
		if(count($cashaccount)<1 || count($banckaccount)<1)
		{
			echo "Account is Invalid";exit;
		}	
		
		// check if expanse money more than balance
		if( $cashaccount->balance < $amount ) {
			echo "Sorry ! Balance is not Available In Cash Account";exit;
		}
		
		$newcashBalance = $cashaccount->balance - $amount;
		$newbankBalance = $banckaccount->balance+$amount;
		$cashtrans_id   = $this->accmodone->transactionId();
		$banktrans_id   = $this->accmodone->transactionId();
		$crinvoice_id   = $this->accmodone->transferInvoiceId();
		$drinvoice_id   = $this->accmodone->transferInvoiceId();

		// data insert for cash transaction
		$cashdata = array(
			"trans_id" 	   => $cashtrans_id,
			"accountid"    => $cashaccount->accountid,
			"invoice_no"   => $crinvoice_id,
			"trans_type"   => 6,
			"trans_method" => 1,
			"credit"	   => $amount,
			"debit"	       => 0,
			"balance" 	   => $newcashBalance,
			"month" 	   => $m,
			"year" 		   => $y,
			"e_user" 	   => $user,
			"e_date"	   => $edate
		);
		
		// data insert for Bank transaction
		if(isset($personN)):$personN = $personN;
			else:$personN = '';
			endif;

		
		$bankdata = array(
			"trans_id" 	   => $banktrans_id,
			"accountid"    => $bankaccno,
			"invoice_no"   => $drinvoice_id,
			"trans_type"   => 7,
			"trans_method" => 2,
			"debit" 	   => $amount,
			"credit" 	   => 0,
			"balance" 	   => $newbankBalance,
			"month" 	   => $m,
			"year" 		   => $y,
			"e_user" 	   => $user,
			"e_date"	   => $edate
		);
		//cash account update
		$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newcashBalance',up_user = '$user' WHERE accountid = '$cashaccount->accountid'");
		//bank account update
		$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newbankBalance',up_user = '$user' WHERE accountid = '$bankaccno'");
		
		$mainLedger = $this->db->insert("main_ledger",$cashdata);
		$mainLedger = $this->db->insert("main_ledger",$bankdata);
		
		if($mainLedger){
		echo 1;exit;
		}
		else {
		echo "Data Not Save";exit;	
		}
		
	}
	
	public function transferBankToCash($pstdata) {
		
		$edate = date('Y-m-d h:s:a');
		$user = $this->session->userdata("userN");
		$m = date("m");
		$y = date("Y");
		extract($pstdata);
		$cashaccount= $this->db->query("SELECT * FROM account_cre WHERE bank_type = 1 limit 1")->row();
		$banckaccount= $this->db->query("SELECT * FROM account_cre WHERE bank_type = 2 and accountid='$bankaccno' limit 1")->row();
		
		if(count($cashaccount)<1 || count($banckaccount)<1)
		{
			echo "Account is Invalid";exit;
		}	
		
		// check if expanse money more than balance
		if( $banckaccount->balance < $amount ) {
			echo "Sorry ! Balance is not Available In Bank Account";exit;
		}
		
		$newcashBalance = $cashaccount->balance + $amount;
		$newbankBalance = $banckaccount->balance-$amount;
		$cashtrans_id   = $this->accmodone->transactionId();
		$banktrans_id   = $this->accmodone->transactionId();
		$crinvoice_id   = $this->accmodone->transferInvoiceId();
		$drinvoice_id   = $this->accmodone->transferInvoiceId();
		
		// data insert for cash transaction
		$cashdata = array(
			"trans_id" 	   => $cashtrans_id,
			"accountid"    => $cashaccount->accountid,
			"invoice_no"   => $drinvoice_id,
			"trans_type"   => 6,
			"trans_method" => 1,
			"credit"	   => 0,
			"debit"	       => $amount,
			"balance" 	   => $newcashBalance,
			"month" 	   => $m,
			"year" 		   => $y,
			"e_user" 	   => $user,
			"e_date"	   => $edate
		);
		
		// data insert for Bank transaction
		if(isset($personN)):$personN = $personN;
			else:$personN = '';
			endif;

		
		$bankdata = array(
			"trans_id" 	   => $banktrans_id,
			"accountid"    => $bankaccno,
			"invoice_no"   => $crinvoice_id,
			"trans_type"   => 7,
			"trans_method" => 2,
			"check_no" 	   => $checknunber,
			"pay_person"   => $personN,
			"debit" 	   => 0,
			"credit" 	   => $amount,
			"balance" 	   => $newbankBalance,
			"month" 	   => $m,
			"year" 		   => $y,
			"e_user" 	   => $user,
			"e_date"	   => $edate
		);
		
		//cash account update
		$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newcashBalance',up_user = '$user' WHERE accountid = '$cashaccount->accountid'");
		//bank account update
		$accUpdate = $this->db->query("UPDATE account_cre SET balance = '$newbankBalance',up_user = '$user' WHERE accountid = '$bankaccno'");
		
		$mainLedger = $this->db->insert("main_ledger",$cashdata);
		$mainLedger = $this->db->insert("main_ledger",$bankdata);
		
		if($mainLedger){
		echo 1;exit;
		}
		else {
		echo "Data Not Save";exit;	
		}
		
	}

// Balance Transfer End


    // student payment start
	public function studentBillPayment() {
		//print_r($cashInfo);exit;
		$aff_row = 0;
		extract($_POST);
		//print_r($_POST);exit;
		// student bill generate table update
	if( $payment <= $totalBill ){
			
			if($discount_amount>0) {
				$totalBill-=$discount_amount;
			}
			else {
				$discount_amount=0;
			}
			
			if($totalBill<1) {
				echo "Received Amount Can't be 0";exit;
			}
			
			$data=array(
			"status"        =>1,
			"special_waver" =>$discount_amount,
			"total_bill"    =>$totalBill
			);
		
		$up = $this->db->where("invoice_no",$invoice_no)->update("stu_bill",$data);

		// basic data
		$edate = date("Y-m-d");
		$eu = $this->session->userdata("userid");

		// get invoice information
		$invoiceInfo = $this->accmodone->invoiceInfo( $invoice_no );
		
		// get student name
		$studentName = $this->accmodone->studentname( $invoiceInfo->stu_id );
		// print_r($studentName);

		// get student information
		$studentInfo = $this->accmodone->studentInformation( $invoiceInfo->stu_id,$invoiceInfo->years );
		// print_r($studentInfo);

		// get fees category name
		$feesCategory = $this->accmodone->feesCategory( $invoiceInfo->fee_catg );
		// print_r($feesCategory);

		// divide two part
		$feesPart = explode("+", $feesCategory);
		// explode fees name
		$feesName = explode(",", $feesPart[0]);
		// explode fees id
		$feesId = explode(",", $feesPart[1]);

		// total month
		$tmonth = $invoiceInfo->to_month - $invoiceInfo->from_month + 1;
		// get transaction id
		
		
		$transId = $this->accmodone->transactionId();

		$stuBalance = $this->db->select("balance")->from("student_account")->where("stu_id",$invoiceInfo->stu_id)->get()->row()->balance;
		$newStudentBalance = $stuBalance+$payment+$discount_amount;

		$data = array("balance" => $newStudentBalance);
		$this->db->where("stu_id",$invoiceInfo->stu_id)->update("student_account",$data);

		// data for student payment
		$payData = array(
				"stu_id" 	 => $invoiceInfo->stu_id,
				"classid" 	 => $invoiceInfo->classid,
				"trans_id" 	 => $transId,
				"invoice_no" => $invoice_no,
				"payment" 	 => $payment,
				"month" 	 => date("m"),
				"year" 		 => date("Y"),
				"e_date" 	 => $edate,
				"e_user" 	 => $eu
			);

		// insert this data into student bill payment table
		
		$ins = $this->db->insert("stu_pay",$payData);

		// get cash account balance
		$cashInfo = $this->accmodone->currentAccountBalance();
		
		// new balance
		$newBalance = $cashInfo->balance + $payment;

// update cash account
$cashUpdate = array("balance" => $newBalance);

$this->db->where("bank_type","1")->update("account_cre",$cashUpdate);

		// get month
		$m = date("m");
		// get year
		$y = date("Y");
		// get transaction type
		$transtype=2;
		if($invoiceInfo->generate_status==3):
		$transtype=5;
		endif;
		// general ledger entry
		$ledgerData = array(
					"trans_id" 	   => $transId,
					"accountid"    => $cashInfo->accountid,
					"invoice_no"   => $invoice_no,
					"trans_type"   => $transtype,
					"trans_method" => 1,
					"debit" 	   => $payment,
					"balance" 	   => $newBalance,
					"month" 	   => $m,
					"year" 		   => $y,
					"e_user" 	   => $eu,
					"e_date"	   => $edate
				);

		// insert data into main ledger
		$ledgerInsert = $this->db->insert("main_ledger",$ledgerData);
		
		//data insert student ledger
		$stuledger=array(
		'stu_id'       =>$invoiceInfo->stu_id,
		'trans_id'     =>$transId,
		'invoice_no'   =>$invoice_no,
		'credit'       =>$totalBill,
		'voucher_type' =>2,
		'e_user'       =>$eu
		);
		
		$this->db->insert("student_ledger",$stuledger);
		
		if( $ins && $ledgerInsert ){
			echo 1;exit;
		}
		else {
			echo "Bill Not Received";exit;
		}

	}
	else
	{
			echo "Total bill Not Match Payable Bill Amount";exit;
	}
	
	$aff = array("aff"=>$aff_row);
	$this->session->set_userdata($aff);

	redirect("account/student_payment_form","location");

}

// student payment end

	public function applicationfee(){
		
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		extract($_POST);
		$appsql=$this->db->query("SELECT * FROM application_tbl WHERE appid='$appid'");
			if($this->db->affected_rows()<1){
				echo "Sorry ! Your Application ID is invalid.";exit;
			}
		$appsqlrow=$appsql->row();
		$appcid=$appsqlrow->appctgid;
		$appcsql=$this->db->query("SELECT app_name,fee FROM application_catg WHERE appctgid='$appcid'");
		$appcrow=$appcsql->row();
		$appcname=$appcrow->app_name;
		$appfee=$appcrow->fee;
		
		if($method=='Bkash'){
			$sendaccount=substr($sendacc,-10);
		}
		if($method=='DBBL'){
			$sendaccount=substr($sendacc,-11);
		}		
		$transql=$this->db->query("SELECT * FROM bk_payment WHERE trans_id='$tansid' AND sent_account='$sendaccount' AND method='$method'");
		if($this->db->affected_rows()<1){
			echo "Sorry ! Your transaction ID OR send account number  is invalid.";exit;
		}
			$ransrow=$transql->row();
			$stufee=$ransrow->amount;
			
		$transqls=$this->db->query("SELECT * FROM bk_payment WHERE trans_id='$tansid' AND status='1'");
			if($this->db->affected_rows()>0){
				echo "Sorry ! Your transaction ID  is invalid.";exit;
			}
		$feesql=$this->db->query("SELECT * FROM bk_payment WHERE trans_id='$tansid' and amount<'$appfee'");
		{
			if($this->db->affected_rows()>0){
				echo "Sorry ! Amount is less than application fee.";exit;
			}
		}
		
		if($method=='Bkash'){
			$recaccount=substr($recacc,-10);
		}
		if($method=='DBBL'){
			$recaccount=substr($recacc,-11);
		}			
		$sql=$this->db->query("select * from account_cre where accountid='$recaccount' and bank_name='$method'");
			if($this->db->affected_rows()<1){
				echo "Sorry ! Received Account Number is invalid.";exit;
			}
			else{
				$row=$sql->row();
				$acbal=$row->balance;				
			}			
			$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_no,5),'APAY-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_no,5)),0)+1)),
					IFNULL(MAX(RIGHT(invoice_no,5)),0)+1
					)
					FROM app_fees")or die(mysql_error());  
					$cqryresult = mysql_fetch_array($cquery);
				    $appyaccinvoice = $cqryresult[0];
		$data=array(
			'appid'=>$appid,
			'invoice_no'=>$appyaccinvoice,
			'method'=>$method,
			'trans_id'=>$tansid,
			'accountid'=>$recaccount,
			'saccid'=>$sendaccount,			
			'purpose'=>'Application Fee |'.$appcname,
			'amount'=>$stufee,
			'status'=>'1',
			'e_date'=>$edate,
			'e_user'=>$user,
			'up_user'=>'',
		);
		$stasql=$this->accmodone->appfeeinsert($data);		
		if($stasql==1){	
			$up=$this->db->query("UPDATE bk_payment SET status='1' WHERE trans_id='$tansid' AND sent_account='$sendaccount' AND method='$method'");
			echo '1';exit;
		}
		else{
			echo "Sorry ! Data insert not successfully.";exit;
		}
	}
	public function listof_classfee_catg(){
		$data=array();
		$sql=$this->db->query("SELECT * FROM fee_catg");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_class_fee_catg',$data);		
	}
	public function listof_classfee_setting(){		
		$data=array();
		$yeare=date('Y');
		$sql=$this->db->query("SELECT * FROM class_fee_sett WHERE year='$yeare' order by classid ASC");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_class_fee_setting',$data);		
	}
	public function listof_expanse_catg(){
		$data=array();
		$sql=$this->db->query("SELECT * FROM expance_catg order by expance_type ASC");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_expanse_catg',$data);		
	}
	public function listof_other_catg(){
		$data=array();
		$sql=$this->db->query("SELECT * FROM income_catg order by income_type ASC");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_otherincome_catg',$data);		
	}
	public function listof_stubill_catg(){
		$data=array();
		$sql=$this->db->query("SELECT * FROM billpay_catg order by billpay_type ASC");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_billpay_catg',$data);		
	}
	public function listof_account_details(){
		$data=array();
		$sql=$this->db->query("SELECT * FROM account_cre");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_account_details',$data);		
	}
	public function listof_extra_income(){
		$data=array();
		$today=date('Y-m-d');
		$dates=date('d-m-Y');
		$sql=$this->db->query("SELECT * FROM other_income WHERE date(e_date) between '$today' AND '$today' order by id DESC");
		$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM other_income")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM other_income WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['query']=$sql->result();
		$data['start_date']=$dates;
		$data['end_date']=$dates;	
		$this->load->view('account/viewlist/listof_other_income',$data);		
	}
	public function listof_expanse_detail(){
		
			$data=array();
		$today=date('Y-m-d');
		$dates=date('d-m-Y');
		$sql=$this->db->query("SELECT * FROM expance WHERE date(e_date) between $today AND $today order by id DESC");
		$sql_sum=$this->db->query("SELECT SUM(balance) AS balance FROM expance")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(balance) AS balances FROM expance WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['query']=$sql->result();
		$data['start_date']=$dates;
		$data['end_date']=$dates;	
		$this->load->view('account/viewlist/listof_expanse_details',$data);
		
	}
	public function listof_applicationfee(){
		$data=array();
		$today=date('Y-m-d');
		$dates=date('d-m-Y');
		$year=date('Y');
		$sql=$this->db->query("SELECT a.appid as appid,b.appctgid as appctgid,c.classid,a.invoice_no as invoice_no,a.method as method,a.trans_id as trans_id,a.accountid as accountid,
a.saccid as saccid,a.purpose as purpose,a.amount as amount,a.status as status,a.e_date FROM app_fees as a LEFT JOIN application_tbl as b
ON a.appid=b.appid  left join application_catg as c on b.appctgid=c.appctgid WHERE year(a.e_date)='$year' order by date(a.e_date) DESC;");
		$data['query']=$sql->result();
		$sql_sum=$this->db->query("SELECT SUM(amount) AS balance FROM app_fees WHERE year(e_date)='$year'")->row();
		$sql_todaysum=$this->db->query("SELECT SUM(amount) AS balances FROM app_fees WHERE date(e_date) between '$today' AND '$today'")->row();
		$data['tamount']=$sql_sum->balance;
		$data['today_amount']=$sql_todaysum->balances;
		$data['start_date']=$dates;
		$data['end_date']=$dates;	
		$this->load->view('account/viewlist/listof_app_fee',$data);		
	}
	public function listof_scholarship(){
		$year=date('Y');
		$data=array();
		//$sql=$this->db->query("SELECT * FROM schship WHERE year(e_date)='$year' order by sshipid DESC");
		$sql=$this->db->query("SELECT * FROM rep_schship WHERE syear='$year' order by sshipid DESC");
		$data['query']=$sql->result();
		$this->load->view('account/viewlist/listof_scholarship_stu',$data);		
	}
	public function classsection(){
			extract($_POST);
		if($classname!=''){
		$classql=$this->db->select('*')->from('class_catg')->WHERE('classid',$classname)->get()->row();
		echo $classql->section;exit;
		}		
	}
	public function billgenerateinsert(){
		$edate=date('Y-m-d h:s:a');
		$user=$this->session->userdata("userN");
		extract($_POST);
		$date=date('Y');
					$stdsql=$this->db->query("SELECT * FROM re_admission WHERE classid='$classid' AND section='$section' AND syear='$date'")->result();
					
					foreach($stdsql as $row){
						$readid=$row->readid;
						$stuid=$row->stu_id;
					$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_no,5),'SBIL-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_no,5)),0)+1)),
					IFNULL(MAX(RIGHT(invoice_no,5)),0)+1
					)
					FROM stu_bill")or die(mysql_error());  
					$cqryresult = mysql_fetch_array($cquery);
				    $billinvoice = $cqryresult[0];	
					$sch=$this->db->query("SELECT sshipid,readid FROM schship WHERE readid='$readid' AND stu_id='$stuid' limit 1");
					$i=0;
					if($this->db->affected_rows()>0){
						$sshipidrow=$sch->row();
						$sshipids=$sshipidrow->sshipid;						
						$stdfeesql=$this->db->query("SELECT amount,feectgid FROM class_fee_sett WHERE classid='$classid' AND year='$date'")->result();
						$balance=0;
						foreach($stdfeesql as $feec){								
							$fectgid=$feec->feectgid;							
							$feectg=$this->db->query("SELECT catg_type FROM fee_catg WHERE feectgid='$fectgid'")->row();
							$catgtype=$feectg->catg_type;
								$disfee=$this->db->query("SELECT amount,calculates FROM stu_sship_amount WHERE sshipid='$sshipids' AND stu_id='$stuid' AND feectgid='$fectgid'")->row();
								$disamount=$disfee->amount;
								$discal=$disfee->calculates;							
							if($catgtype=='Monthly Fee'){								
								if($discal=='1'){									
								$m=$feec->amount*$disamount/100;
								$n=$feec->amount-$m;
								$m_discrip='(Discount '.$disamount.' %)';
								$feeamount=$feec->amount*$month;
								$calamount=($feeamount*$disamount)/100;
								$feenetamount=$feeamount-$calamount;	
								$balance=$balance+$feenetamount;
								}
								else{
								$m=$feec->amount-$disamount;
								$n=$feec->amount-$m;
								$m_discrip='(Discount '.$disamount.' Taka.)';
								$feeamount=$feec->amount*$month;
								$feenetamount=$feeamount-$disamount;	
								$balance=$balance+$feenetamount;
								}
								$bildes=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'catg_type'=>$catgtype.'| '.$n.'*'.$month.' '.$m_discrip,
									'balance'=>$feenetamount,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_date'=>'',
									'up_user'=>'',
								);
								$bisql=$this->accmodone->billdisription($bildes);
								
							}
							else{
								if($discal==1){																			
								$feeamount=$feec->amount;
								$calamount=($feeamount*$disamount)/100;
								$m_discrip='(Discount '.$disamount.' %)';	
								$feenetamount=$feeamount-$calamount;	
								$balance=$balance+$feenetamount;
								}
								else{
								$feeamount=$feec->amount;
								$feenetamount=$feeamount-$disamount;
								$m_discrip='(Discount '.$disamount.' Taka .)';								
								$balance=$balance+$feenetamount;
								}
								$bildes=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'catg_type'=>$catgtype.' '.$m_discrip,
									'balance'=>$feenetamount,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_date'=>'',
									'up_user'=>'',
								);
								$bisql=$this->accmodone->billdisription($bildes);
							}
						}
						////////////// stu_bill insert ///////////
							$stubills=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'billpay_type'=>$billctg,
									'amount'=>$balance,									
									'descrip'=>'',
									'e_date'=>$edate,
									'e_user'=>$user,									
									'up_user'=>'',
								);
								$bisqls=$this->accmodone->billcreate($stubills);
								if($bisqls==1){
								$udate=date('Y-m-d H:i:s');
								$stdacc=$this->db->query("SELECT balance FROM stu_creacc WHERE stu_id='$stuid'")->row();
								$stdaccbalance=$stdacc->balance;								
									$accupdate=$stdaccbalance+$balance;
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM stu_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;
								$ledger=array(
									'trans_id'=>$legtransid,
									'stu_id'=>$stuid,
									'bill_invoice'=>$billinvoice,
									'pay_invoice'=>'0',
									'porpose'=>$billctg.'| Bill Create |'.date('M-d-Y').'|'.$user,
									'debit'=>'0.00',
									'credit'=>$balance,									
									'balance'=>$accupdate,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_user'=>'',
								);
								$legsql=$this->accmodone->studentleger($ledger);
								$sqlaccup=$this->db->query("UPDATE stu_creacc SET balance='$accupdate',up_date='$udate',up_user='$user' WHERE stu_id='$stuid'");
								}
								$i++;
								////////////// end stu_bill insert ///////////
						}
						else{
						$stdfeesql=$this->db->query("SELECT amount,feectgid FROM class_fee_sett WHERE classid='$classid' AND year='$date'")->result();
						$balance=0;
						foreach($stdfeesql as $feec){								
							$fectgid=$feec->feectgid;
							$feectg=$this->db->query("SELECT catg_type FROM fee_catg WHERE feectgid='$fectgid'")->row();
							$catgtype=$feectg->catg_type;
							if($catgtype=='Monthly Fee'){
								$feeamount=$feec->amount*$month;
								$balance=$balance+$feeamount;
								$bildes=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'catg_type'=>$catgtype.'('.$feec->amount.'*'.$month.')',
									'balance'=>$feeamount,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_date'=>'',
									'up_user'=>'',
								);
								$bisql=$this->accmodone->billdisription($bildes);
							}
							else{
								$feeamount=$feec->amount;
								$balance=$balance+$feeamount;
								$bildes=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'catg_type'=>$catgtype,
									'balance'=>$feeamount,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_date'=>'',
									'up_user'=>'',
								);
								$bisql=$this->accmodone->billdisription($bildes);
							}
						}
							$stubills=array(
									'stu_id'=>$stuid,
									'invoice_no'=>$billinvoice,
									'billpay_type'=>$billctg,
									'amount'=>$balance,
									'descrip'=>'',
									'e_date'=>$edate,									
									'e_user'=>$user,									
									'up_user'=>'',
								);
								$bisqlss=$this->accmodone->billcreate($stubills);
								if($bisqlss==1){
								$udate=date('Y-m-d H:i:s');
								$stdacc=$this->db->query("SELECT balance FROM stu_creacc WHERE stu_id='$stuid'")->row();
								$stdaccbalance=$stdacc->balance;								
									$accupdate=$stdaccbalance+$balance;
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM stu_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;
								$ledger=array(
									'trans_id'=>$legtransid,
									'stu_id'=>$stuid,
									'bill_invoice'=>$billinvoice,
									'pay_invoice'=>'0',
									'porpose'=>$billctg.'| Bill Create |'.date('M-d-Y').'|'.$user,
									'debit'=>'0.00',
									'credit'=>$balance,									
									'balance'=>$accupdate,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_user'=>'',
								);
								$legsql=$this->accmodone->studentleger($ledger);
								$sqlaccup=$this->db->query("UPDATE stu_creacc SET balance='$accupdate',up_date='$udate',up_user='$user' WHERE stu_id='$stuid'");
									$i++;
								}
						}
					}
					if($i>0){
						echo '1';exit;
					}
					}
		public function student_paymentinset(){
			
			$edate=date('Y-m-d h:s:a');
			$user=$this->session->userdata("userN");
			$udate=date('Y-m-d H:i:s');
			extract($_POST);					
			if(trim($studentid)==''){
				echo "Sorry ! Student ID can not found";exit;
			}
			if(trim($paytype)==''){
				echo "Sorry ! Payment amount is empty";exit;
			}
			if(trim($totalbill)==''){
				echo "Sorry ! Total Bill amount is empty";exit;
			}
			if(trim($accountid)==''){
				echo "Sorry !Please select account name.";exit;
			}
			
			$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_no,5),'SPAY-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_no,5)),0)+1)),
					IFNULL(MAX(RIGHT(invoice_no,5)),0)+1
					)
					FROM stu_pay")or die(mysql_error());  
					$cqryresult = mysql_fetch_array($cquery);
				    $payinvoice = $cqryresult[0];	
				$stu_pays=array(
					'stu_id'=>$studentid,
					'invoice_no'=>$payinvoice,
					'billpay_type'=>$paytype,
					'amount'=>$payamount,
					'e_date'=>$edate,
					'e_user'=>$user,
					'up_user'=>'',
				);
				$status=$this->accmodone->studentpay($stu_pays);
				if($status==1){
					$nsbalnce=$totalbill-$payamount;
					$sacc=$this->db->query("UPDATE stu_creacc SET balance='$nsbalnce',up_date='$udate',up_user='$user' WHERE stu_id='$studentid'");
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM stu_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;
								$ledger=array(
									'trans_id'=>$legtransid,
									'stu_id'=>$studentid,
									'bill_invoice'=>'0',
									'pay_invoice'=>$payinvoice,
									'porpose'=>$paytype.'| Bill Pay |'.date('M-d-Y').'|'.$user,
									'debit'=>$payamount,
									'credit'=>'0.00',									
									'balance'=>$nsbalnce,
									'e_date'=>$edate,
									'e_user'=>$user,
									'up_user'=>'',
								);
								$legsql=$this->accmodone->studentleger($ledger);
								if($legsql==1){
									$accsql=$this->db->query("SELECT balance FROM account_cre WHERE accountid='$accountid'")->row();
									$accbalance=$accsql->balance;
									$newbalance=$accbalance+$payamount;
								$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM main_ledger")->row();
								 $legtrans=$tranidquery->trans_id;
								 $legtransid=$legtrans+1;									
								$leger=array(
									'trans_id'=>$legtransid,
									'accountid'=>$accountid,
									'boucher_no'=>$payinvoice,
									'perpose'=>'Student Payment |'.$className.'|'.$sectionname.'|'.$sturollno.'|'.$shiftss.'|'.$studentid,
									'credit'=>$payamount,
									'debit'=>'0.00',
									'balance'=>$newbalance,
									'e_user'=>$user,
									'e_date'=>$edate
								);
								$legsql=$this->accmodone->legderinsert($leger);
								$sqlaccup=$this->db->query("UPDATE account_cre SET balance='$newbalance',up_date='$udate',up_user='$user' WHERE accountid='$accountid'");
								$sql_reg=$this->db->query("select name,Phone_n from regis_tbl where stu_id='$studentid'")->row();
								$stuName=$sql_reg->name;
								$mobile=substr($sql_reg->Phone_n,-11);
								$txt="Thank you $stuName.You payment $payamount Taka. Your money receipt no :$payinvoice";
								$txt=urlencode($txt);
								$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
								file_get_contents($url);								
							}
							$bata=array(
								'invmoneyinvoce'=>$payinvoice								
							);
							$this->session->set_userdata($bata);
							echo '1';exit;
						}
						
						echo "Sorry ! Payment Not Complete";exit;
					}

// schoolership section start
public function stu_scholarship(){
	$this->load->view('header');
	$this->load->view('leftbar');
	$this->load->view('account/stu_scholarship');
	$this->load->view('footer');
}
public function schoolerShipCatg(){
	///$this->load->view('header');
	//$this->load->view('leftbar');
	$this->load->view('account/schoolerShipCatg');
	//$this->load->view('footer');
}

//change waver 
public function changeWaver() {
	
	extract($_POST);
	$status=array("status"=>$sts);
	$this->db->where("schid",$did);
	$this->db->update("schship",$status);
	echo 1;exit;
	
}

// get onchange class section
	public function changeClassSection( ){
	//echo "hello";
		//error_reporting(1);
		if(isset($_POST['clsid'])){
			$cls=$_POST['clsid'];

			$section = $this->db->select("group_concat(DISTINCT section_name ORDER BY section_name ASC SEPARATOR ',') AS section,group_concat(DISTINCT sectionid ORDER BY section_name ASC SEPARATOR ',') AS sectionid")->from("section_tbl")->where("classid",$cls)->get()->row();
			echo $section->section.'+'.$section->sectionid;
			// echo $this->db->last_query();
		}
	}

// schoolership section end

public function search_stu_scholarship(){
	$this->load->view('account/search_stu_scholarship');
}

				public function stu_scholarship_insert(){
					$edate=date('Y-m-d h:s:a');
					$user=$this->session->userdata("userN");
					$udate=date('Y-m-d H:i:s');
					$years=date('Y');
					extract($_POST);
					if(trim($classname)==''){echo "Please Select Class Name.";exit;}
					if(trim($sections)==''){echo "Please Select Section Name.";exit;}
					if(trim($rollno)==''){echo "Please Select Roll No.";exit;}
					if(trim($shiftid)==''){echo "Please Select Shift .";exit;}
					if(trim($scholarship)==''){echo "Please Select Scholarship Category.";exit;}
					$resql=$this->db->query("SELECT stu_id,readid FROM re_admission WHERE shiftid='$shiftid' AND classid='$classname' AND section='$sections' AND roll_no='$rollno' AND syear='$years'");
					if($this->db->affected_rows()>0){
						$stuquery=$resql->row();
						$restuid=$stuquery->stu_id;
						$re_admid=$stuquery->readid;
						$readmission_sql=$this->db->query("SELECT * FROM schship WHERE readid='$re_admid' AND stu_id='$restuid'");
						if($this->db->affected_rows()>0){
							echo "Sorry ! You all ready complete scholarship this student.";exit;
						}
						else{
							$data=array(
								'readid'=>$re_admid,
								'stu_id'=>$restuid,
								'scholarship'=>$scholarship,
								'e_date'=>$edate,
								'e_user'=>$user,
								'up_user'=>'',
							);							
							$status=$this->accmodone->stuschship($data);							
							if($status==1){								
							$i=0;	
							$readmission_ss=$this->db->query("SELECT * FROM schship WHERE readid='$re_admid' AND stu_id='$restuid'");	
							$sqlred=$readmission_ss->row();
							  $sshipid=$sqlred->sshipid;						
							foreach($_POST['amount'] as $cnt => $amount){						
							$sqlinset=$this->db->query("INSERT INTO stu_sship_amount (sshipid,stu_id,feectgid,amount,calculates,e_date,e_user,up_user) values('$sshipid','$restuid','".$_POST['title'][$cnt]."','".$_POST['amount'][$cnt]."','".$_POST['persentage'][$cnt]."','$edate','$user','')");
								
							 $i++;
							}
							if($i>0){
								echo '1';exit;
							}
							}
							else{
								echo "Sorry ! Data Insert Not Successfully.";exit;
							}
						}
					}
					else{
						echo "Sorry! Your information is invalid.";exit;
					}
				}
		public function cash_application_fee(){
			$this->load->view('account/app_fees_form_cash');
		}
		public function cash_application_insert(){
			
			$edate=date('Y-m-d h:s:a');
			$udate=date('Y-m-d H:i:s');
			$user=$this->session->userdata("userN");
			extract($_POST);
				$appsql=$this->db->query("SELECT * FROM application_tbl WHERE appid='$appcid'");
					if($this->db->affected_rows()<1){
						echo "Sorry ! Your Application ID is invalid.";exit;
					}
				$sqlss=$this->db->query("SELECT appid FROM app_fees WHERE appid='$appcid'");
					if($this->db->affected_rows()>0){
						echo "Congratulation !You All ready payment complete";exit;
					}
				$appsqlrow=$appsql->row();
				$appcataid=$appsqlrow->appctgid;
				$appcsql=$this->db->query("SELECT classid,fee FROM application_catg WHERE appctgid='$appcataid'");
				$appcrow=$appcsql->row();
				//$appcname=$appcrow->classid;
				$appcname=$cname;				
				$appfee=$appcrow->fee;
				if($payamount<$appfee){
					echo "Sorry! Payment Amount is less than application Fee.";exit;
				}
				if($payamount>$appfee){
					echo "Sorry! Payment Amount is largest application Fee.";exit;
				}
						$mi=2;
						  $ma=9;
						  $cd=10;
						  $ce=20;
						 $a=rand($mi,$ma);
						 $b=rand($cd,$ce);
					$transid = round(microtime(true) *$b * $a).rand($cd,$ce);					
				$sql=$this->db->query("select balance from account_cre where accountid='$accnumber'");
						  
					$row=$sql->row();
					$acbal=$row->balance;
					$new_balnace=$acbal+$payamount;
					$cquery = mysql_query("SELECT CONCAT (IFNULL(LEFT(invoice_no,5),'APAY-'),REPEAT(0,5-LENGTH(IFNULL(MAX(RIGHT(invoice_no,5)),0)+1)),
							IFNULL(MAX(RIGHT(invoice_no,5)),0)+1
							)
							FROM app_fees")or die(mysql_error());  
							$cqryresult = mysql_fetch_array($cquery);
							$appyaccinvoice = $cqryresult[0];
				$data=array(
					'appid'=>$appcid,
					'invoice_no'=>$appyaccinvoice,
					'method'=>'Cash',
					'trans_id'=>$transid,
					'accountid'=>$accnumber,
					'saccid'=>'0',			
					'purpose'=>'Application Fee |'.$appcname,
					'amount'=>$payamount,
					'status'=>'1',
					'e_date'=>$edate,
					'e_user'=>$user,
					'up_user'=>'',
				);				
				$stasql=$this->accmodone->appfeeinsert($data);					
				if($stasql==1){	
					$tranidquery=$this->db->query("SELECT MAX(trans_id) as trans_id FROM main_ledger")->row();
					 $legtrans=$tranidquery->trans_id;
					 $legtransid=$legtrans+1;									
					$leger=array(
						'trans_id'=>$legtransid,
						'accountid'=>$accnumber,
						'boucher_no'=>$appyaccinvoice,
						'perpose'=>'Application Fee |'.$appcname.'-'.date('Y').'|'.$user,
						'credit'=>$payamount,
						'debit'=>'0.00',
						'balance'=>$new_balnace,						
						'e_date'=>$edate,
						'e_user'=>$user
					);
					$bata=array(
							'moneyinv'=>$appyaccinvoice,
							);
					$this->session->set_userdata($bata);					
					$ledstatus=$legsql=$this->accmodone->legderinsert($leger);
					if($ledstatus==1){
					$sqlaccup=$this->db->query("UPDATE account_cre SET balance='$new_balnace',up_date='$udate',up_user='$user' WHERE accountid='$accnumber'");
					echo '1';exit;
					}
					else{
						echo "Data insert successfully But Ledger Can not update.";exit;
					}
				}
				else{
					echo "Sorry ! Data insert not successfully.";exit;
				}	
		}
		public function moneyreceipt_index(){
			$data=array();
			$data['payinvoices']=$this->session->userdata("invmoneyinvoce");
			$this->load->view('account/invoice/bill_invoice_first',$data);
		}
		public function moneyreceipt_index_reprint(){			
			$data=array();
			$getvalue=$this->input->get("inv");
			$bata=array(
				'invmoneyinvoce'=>$getvalue								
			);
			$this->session->set_userdata($bata);
			$data['payinvoices']=$getvalue;
			$this->load->view('account/invoice/bill_invoice_first',$data);
		}
		public function moneyreceipt_index_reprint_stuledger(){			
			$data=array();
			$getvalue=$this->input->get("inv");
			$bata=array(
				'invmoneyinvoce'=>$getvalue								
			);
			$this->session->set_userdata($bata);
			$data['payinvoices']=$getvalue;
			$this->load->view('account/invoice/bill_invoice_first_stu_ledger',$data);
		}
		public function moneyreceit(){
			$data=array();
			$data['payinvoices']=$this->session->userdata("moneyinv");
			$this->load->view('account/invoice/bill_application_fee_first',$data);
		}

// income print copy

		public function extra_income_print(){
			$data=array();
			$data['payinvoices']=$this->session->userdata("moneyinv");
			$this->load->view('account/invoice/other_income_first',$data);
		}

// income print copy end

		public function add_balance(){
			$data=array();
			$months=date('m');
			$data['query']=$this->db->select("*")->from("add_balance")->where("month(e_date)",$months)->get()->result();
			$data['tamount']=$this->db->select("sum(balance) as balance")->from("add_balance")->get()->row();
			$this->load->view('account/add_balance',$data);
		}
		public function search_add_balance(){
			$this->load->view('account/search_add_balance');
		}
		
		public function smsportal(){
			$this->load->view('sms/dynamic_sms');
		}
		
		public function sendsms()
		{
			
			extract($_POST);
			$years=date('Y');
			if($classid==''){ echo "Please Class Name.";exit;}
			if(trim($messages)==''){ echo "Please Type your Message.";exit;}
			if($classid=='all'){
			$sql=$this->db->query("select a.stu_id,a.classid,a.syear,b.local_guardian,b.Phone_n from re_admission as a left join regis_tbl as b on a.stu_id=b.stu_id where a.syear='$years'")->result();
			$txt=urlencode($messages);
			foreach($sql as $row){
				$mobile=substr($row->Phone_n,-11);
				// $url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
				// file_get_contents($url);
				
				$client = new SoapClient('http://180.210.160.7/Services/SmsClient.asmx?WSDL');
				// Set the parameters
				$requestParams = array(
					'userName' => 'SOZIBDCB', // Use your user-id here
					'password' => 'SOZIBDCB123',
				 'smsText'  => $txt,
				 'commaSeparatedReceiverNumbers' =>$mobile, // you can use multiple mobile numbers here; e.g: 01810000000,01710000000,0191000000,015...
				 'nameToShowAsSender' => '' // Use your mask text here if you want (and you have masking enabled)
				);
				// Call to send sms
				$response = $client->SendSms($requestParams)->SendSmsResult;
				// Check if sms sending was successful
				if($response->IsError){
				 //echo "<h2 style='color:red'>FAILED!</h3>";
				 // Know the reason for failure (and the error code)
				 echo sprintf("Reason: %s [%d]", $response->ErrorMessage, $response->ErrorCode);
				}
				else{
				 echo "<h2 style='color:green;'>SUCCESS!</h2>";
				
				 }
				
				
				
				
			}	
			echo "1";exit;
			
			}
			else{
				$sql=$this->db->query("select a.stu_id,a.classid,a.syear,b.local_guardian,Phone_n from re_admission as a left join regis_tbl as b on a.stu_id=b.stu_id where a.classid='$classid' AND a.syear='$years'")->result();
				$txt=urlencode($messages);
				foreach($sql as $row){
				$mobile=substr($row->Phone_n,-11);
				// $url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
				// file_get_contents($url);
				
				
				$client = new SoapClient('http://180.210.160.7/Services/SmsClient.asmx?WSDL');
				// Set the parameters
				$requestParams = array(
					'userName' => 'SOZIBDCB', // Use your user-id here
					'password' => 'SOZIBDCB123',
				 'smsText'  => $txt,
				 'commaSeparatedReceiverNumbers' =>$Mobile, // you can use multiple mobile numbers here; e.g: 01810000000,01710000000,0191000000,015...
				 'nameToShowAsSender' => '' // Use your mask text here if you want (and you have masking enabled)
				);
				// Call to send sms
				$response = $client->SendSms($requestParams)->SendSmsResult;
				// Check if sms sending was successful
				if($response->IsError){
				 //echo "<h2 style='color:red'>FAILED!</h3>";
				 // Know the reason for failure (and the error code)
				 echo sprintf("Reason: %s [%d]", $response->ErrorMessage, $response->ErrorCode);
				}
				else{
				 //echo "<h2 style='color:green;'>SUCCESS!</h2>";
				
				 }
				
			}
				echo "1";exit;
			}
		
		}
		
		public function sendsmstwo()
		{
			extract($_POST);
			if($phoneN==''){ echo "Please Type Mobile Number.";exit;}
			if(trim($messages)==''){ echo "Please Type Your Message.";exit;}									
				
			$mobile=substr($phoneN,-11);
			$txt=urldecode($messages);
			$bname="High School";
			
			
			$client = new SoapClient('http://180.210.160.7/Services/SmsClient.asmx?WSDL');
			
		// Set the parameters
			$requestParams = array(
				'userName' => 'SOZIBDCB', // Use your user-id here
				'password' => 'SOZIBDCB123',
			 'smsText'  => $txt,
			 'commaSeparatedReceiverNumbers' =>$mobile, // you can use multiple mobile numbers here; e.g: 01810000000,01710000000,0191000000,015...
			 'nameToShowAsSender' => '' // Use your mask text here if you want (and you have masking enabled)
			);
			// Call to send sms
			$response = $client->SendSms($requestParams)->SendSmsResult;
			// Check if sms sending was successful
			if($response->IsError){
			 //echo "<h2 style='color:red'>FAILED!</h3>";
			 // Know the reason for failure (and the error code)
			 echo sprintf("Reason: %s [%d]", $response->ErrorMessage, $response->ErrorCode);
			}
			else{
				//echo "<h2 style='color:green;'>SUCCESS!</h2>";
				echo "1";
			}
			
		}
			
		public function teacherSMS()
		{			
			extract($_POST);		
			if(trim($messages)==''){ echo "Please Type Your Message.";exit;}
			
			if($tectype=='all')
			{
				$sql=$this->db->query("select name,emptypeid,phone from empee where status='0'")->result();
				$txt=urldecode($messages);
				foreach($sql as $row){
				$mobile=substr($row->phone,-11);
				$this->accmodone->send_sms($mobile,$txt);
				}	
				echo "1";exit;
			}
			
			if($tectype=='1'){
				$sql_typeid=$this->db->query("select emptypeid from emp_type where type='Teacher'")->row();
				$sql=$this->db->query("select a.name,a.emptypeid,a.phone from empee as a left join emp_type on a.emptypeid=emp_type.emptypeid where a.emptypeid='$sql_typeid->emptypeid' and a.status='0'")->result();
				$txt=urldecode($messages);
				
				foreach($sql as $row)
				{
				$mobile=substr($row->phone,-11);
				$this->accmodone->send_sms($mobile,$txt);
				
				}	
			echo "1";exit;
			}
			if($tectype=='2'){
				$sql_typeid=$this->db->query("select emptypeid from emp_type where type='Staff'")->row();
				$sql=$this->db->query("select a.name,a.emptypeid,a.phone from empee as a left join emp_type on a.emptypeid=emp_type.emptypeid where a.emptypeid='$sql_typeid->emptypeid' and a.status='0'")->result();
				$txt=urldecode($messages);
				foreach($sql as $row){
				$mobile=substr($row->phone,-11);
				// $url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
				// file_get_contents($url);
				$this->accmodone->send_sms($mobile,$txt);
				}	
				echo "1";exit;
			}
				echo "Sorry ! Message not sent.";exit;
			
		}
		
		// advanced payment
		public function advancePayment() {
			$this->load->view("header");
			$this->load->view("leftbar");
			$this->load->view("account/advancedPayment");
			$this->load->view("footer");
		}

public function duplicatAdvanceCheck(){
	//print_r($_POST);exit;
	extract($_POST);
	$dupliCount = $this->accmodone->duplicatAdvanceCheck( $s,$c,$sec,$r,$fm,$tm,$y,$cat );
	//echo "Database";
	echo $dupliCount;

}

		// get student profil
		public function getProfil(){
			// error_reporting(1);
			extract($_POST);
			
			$this->shift = $shift;
			$this->class = $class;
			$this->section = $section;
			$this->roll = $roll;

			$getData = $this->accmodone->getProfil();
			
			$data = '';

			foreach($getData as $key => $value):
				$data .= $value.',';
			endforeach;

			
			if($data):
				echo substr($data, 0,-1);
			else:
				echo "2";
			endif;

		}

		// payment amount add
		public function advancePaymentEntry(){
			//echo "<pre>";
			//print_r($_POST);
			if(isset($_POST)):
				extract($_POST);
				if(!isset($feeidck)) { echo "Choose Bill Category";exit; }
				
				$fees = implode(",", $feeidck);
				
				//check dublicate bill category same year and same month
				
				$this->accmodone->dublicateCategoryTest($proStu,$year,$frommonth,$feeidck);
				
				// validation total bill refference indivisual bill
				$total=$this->db->query("select sum(amount) as total from class_fee_sett where feeid in($fees) and year=$year")->row()->total;
				
				if($total!=$totalAmount) { echo "Total Amount is Wrong";exit; }
				
				// store data in Bill Generate table with advance status=3

					// get income invoice id
					$invoice_no = $this->accmodone->incInvoiceId();

					// insert user
					$eu = $this->session->userdata("userid");

					$comment = "Advanced Payment";
					$subAmount = $totalAmount;
					$totalBill = $subAmount;
					
					//student descount check
					$discountrate="";
					$discountctg="";
					$inddisamount="";
					$discount = $this->accmodone->getDiscount( $shift,$classid,$stuclroll,$year );
					//print_r($discount);
					if($discount !=0 ):
					$discountamount=$this->accmodone->getctgDiscount($discount,$feeidck);
				
					$disctginfo=explode("#",$discountamount);
					
					$discountrate=$disctginfo[0];
					$discountctg=$disctginfo[1];
					$inddisamount=$disctginfo[2];
					
					$totalBill = $subAmount - $disctginfo[3];
					//$BillAmount = $BillAmount - $disctginfo[3];
					
					endif;
					
					// advanced payment data
						$advanceData = array(
							"invoice_no" => $invoice_no,
							"stu_id" 	 => $proStu,
							"classid" 	 => $classid,
							"fee_catg" => $fees,
							"from_month" => $frommonth,
							"to_month"	 => $frommonth,
							"discount"   => $discountrate,
							"discount_ctg"   => $discountctg,
							"discount_amount"   => $inddisamount,
							"total_bill" => $totalBill,
							"years" 	 => $year,
							"generate_status" 	 => 3,
							"e_user" 	 => $eu
						);
					$advanceInsert = $this->db->insert("stu_bill",$advanceData);
					
					// get student account
					$stuAccount = $this->accmodone->studentAccount( $proStu );

					// student balance
					// echo $totalBill;
					$balance = $stuAccount - $totalBill;

					// make student account data
					$stuAccData = array(
							"balance" => $balance
						);

					// update student table
					$stuAcc = $this->db->where("stu_id",$proStu)->update("student_account",$stuAccData);
					
					//data insert student ledger
					$stuledger=array(
					'stu_id'       =>$proStu,
					'invoice_no'   =>$invoice_no,
					'debit'        =>$totalBill,
					'voucher_type' =>1,
					'e_user'       =>$eu
					);
					
					$this->db->insert("student_ledger",$stuledger);
					
					if($stuAcc){
					echo 1;exit;
					}
					else {
					echo "Data Not Save";exit;	
					}
					
			endif;
		}

// vehicales settings
		public function vahicleSetting(){
			extract($_POST);

			$log = 0;
			
			// insert user
			$eu = $this->session->userdata("userid");

			for($i = 0;$i < count($serial);$i++ ):
				// make data
				$data = array(
						"vid" 	  => '',
						"vnumber" => $serial[$i],
						"name"    => $name[$i],
						"route"   => $route[$i],
						"capacity" => $capacity[$i],
						"rent"    => $rent[$i],
						"euser"   => $eu
					);

				// insert into vahicales table
				$ins = $this->db->insert("vahicles",$data);

				// success
				if($ins):
					$log++;
				endif;

			endfor;

			if($log == $i):
				echo "1";
			else:
				echo "Some data could not save";
			endif;

		}
// vehicales Update
		public function vahicleEdit(){
			extract($_POST);
			//print_r($_POST);
			//exit;
			$log = 0;
			
			// insert user
			$eu = $this->session->userdata("userid");

			
				// make data
				$data = array(
						"vnumber" => $serial,
						"name"    => $vname,
						"route"   => $route,
						"capacity" => $capacity,
						"rent"    => $rent,
						"euser"   => $eu
					);

				// Update into vahicales table
				$this->db->where("vid",$vid);
				$ins = $this->db->update("vahicles",$data);

				// success
				if($ins){
					echo 1;exit;
				}
				else {
					echo "Update Not Successfully";exit;
				}

		}
		
		//public function studentassign testDateQuery
		public function studentAssignTest(){
			extract($_POST);
			$year=date("Y");
			//shift:shiftid,clsid:classid,section:section,roll:roll
			$where=array("shiftid"=>$shift,"classid"=>$clsid,"sectionid"=>$section,"roll"=>$roll,"year"=>$year);
			$van=$this->db->where($where)->get("van_assign")->row();
			if(count($van)>0) { echo 0;exit; }
			echo 1;exit;
		}
		
		// student assign submit function
		public function studentAssign(){

			// if(isset($_POST['submitBtn'])):
				extract($_POST);
				$log = 0;

				// insert user
				$eu = $this->session->userdata("userid");
				$QueryBatch = array();

				for($i = 0;$i < count($shift);$i++):
					// data
					$data = array(
							"assid" 	=> '',
							"vanid" 	=> $vahicles,
							"shiftid" 	=> $shift[$i],
							"classid" 	=> $class[$i],
							"sectionid" => $section[$i],
							"roll" 		=> $roll[$i],
							"amount" 	=> $amount[$i],
							"year" 		=> date("Y"),
							"euser" 	=> $eu
						);

					array_push($QueryBatch, $data);

				endfor;

				// print_r($QueryBatch);exit;
				// insert data into database
				$ins = $this->db->insert_batch("van_assign",$QueryBatch);

				if($ins):
					$log++;
				endif;

				if($log > 0):
					echo "1";
				else:
					echo "Maybe some data can't store";
				endif;

			// endif;
		}
//vahical start and end
	public function runVahicale(){
		extract($_GET);
		$data=array("status"=>1);
		$this->db->where("vid",$vid);
		$this->db->update("vahicles",$data);
		redirect("accountReport/vahicleStdAssign");
	}
	
	public function stopVahicale(){
		extract($_GET);
		$data=array("status"=>0);
		$this->db->where("vid",$vid);
		$this->db->update("vahicles",$data);
		redirect("accountReport/vahicleStdAssign");
	}
	
	public function studentRentChange(){
		extract($_POST);
		//print_r($_POST);
		$data=array("amount"=>$rent);
		$this->db->where("assid",$assid);
		$up=$this->db->update("van_assign",$data);
		if($up) { echo 1;exit; }
		else { echo "Data Not Updated";exit; }
	}

public function testQuery(){
	$pay = $this->db->query("SELECT GROUP_CONCAT(trans_id) AS pt FROM stu_pay WHERE stu_id = '486774448'")->row()->pt;
	$advance = $this->db->query("SELECT GROUP_CONCAT(trans_id) AS at FROM advancepayment WHERE stu_id = '486774448'")->row()->at;

	$totalTrans = $pay.','.$advance;

	$mainLedger = $this->db->query("SELECT * FROM main_ledger WHERE trans_id IN($totalTrans) ORDER BY e_date ASC")->result();

	$mainLedger = json_decode(json_encode($mainLedger),true);

	echo "<pre>";
	// print_r($mainLedger);

	$bill = $this->db->query("SELECT * FROM stu_bill WHERE stu_id = '486774448'")->result();
	$bill = json_decode(json_encode($bill),true);
	// print_r($bill);

	$concat = array_merge($mainLedger,$bill);
	$sorted = $this->array_orderby($concat);
	print_r($sorted);

}

public function array_orderby(){

    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

public function testDateQuery(){
	$startdate = '2016-03-24';
	$enddate = '2016-03-24';
	$this->db->select("*");
	$this->db->from('account_cre');
	$this->db->where('date(`e_date`) >=', $startdate);
	$this->db->where('date(`up_date`) <=', $enddate);
	$query = $this->db->get()->result_array();


	echo $this->db->last_query();
echo "<pre>";
print_r($query);

	}
						
}
?>