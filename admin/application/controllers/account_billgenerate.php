<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class account_billgenerate extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		$this->load->model('account_model','accmodone');
		$this->load->model('account_model_edit','accmodtwo');
		$this->load->model('numbertobangla','numbershow');
		if($stid==''){ redirect('login?error=2','location'); 
		}
		
		
	}

// bill generate form start
	public function billpages(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('account/bill_generate/bill_gefpage');
		$this->load->view('footer');
	}

// bill generate end

	public function monthcheck(){
		$this->load->view('account/bill_generate/search_month');
	}


	public function feetitle(){
		$this->load->view('account/bill_generate/search_feetitle');
	}

// student bill section start

public function studentbill(){
	//print_r($_POST);exit;
	if(isset($_POST)):
		extract($_POST);
		//validation category
		
		if(!isset($feeidck)) { echo "Choose Bill Category";exit; }
		//print_r($_POST);
		//exit;
		$year = date("Y");
		$fees = implode(",", $feeidck);
		//Exist bill generate  test same year and smae month
		$existbill=$this->db->query("select * from stu_bill where  years=$year  and classid=$classid and generate_status=1 and from_month >= $monthfdate and to_month<= $monthedate")->row();
		
		//month calculation
		$countmonth=1;
		if($monthfdate>$monthedate) {
			$countmonth+=$monthfdate-$monthedate;
		}
		elseif($monthfdate<$monthedate){
			$countmonth+=$monthedate-$monthfdate;
		}
		
		
		if(count($existbill)>0) { echo "Bill Already Generated";exit; }
		
		// validation total bill refference indivisual bill
		$total=$this->db->query("select sum(amount) as total from class_fee_sett where feeid in($fees) and year=$year")->row()->total;
		$totalmthamount=$total*$countmonth;
		//echo $totalAmount;
		if($totalmthamount!=$totalAmount) { echo "Total Amount is Wrong";exit; }
		
		if($totalAmount<1) { echo "Amount is Empty";exit; }
		//exit;
		// get incomplete bill student
		$inCompBill = $this->accmodone->inCompleteBillStd( $classid,$year,$monthfdate,$monthedate );

		// get user id
		$user = $this->session->userdata("userid");

		// calculate student bill
		foreach( $inCompBill as $billInfo ):
			//$discount = $this->accmodone->getDiscount( $billInfo->shiftid,$billInfo->classid,$billInfo->roll_no,$year );
			//$discount = $this->accmodone->getDiscount( 1,1,1,2016 );
			
			// check student vahicales
			$vahicales = $this->accmodone->vahicalesCheckingRent( $billInfo->shiftid,$billInfo->classid,$billInfo->section,$billInfo->roll_no,$year );
			
			$vahicalRent = $vahicales->amount?$vahicales->amount:0;

			// add vahicales id
			$vid = 0;
			if($vahicalRent):
				$vid = $vahicales->assid;
			endif;

			$fees = implode(",", $feeidck);

//  advanced payment section
				$advancePayAmount = 0;
				$advancpay=$this->db->query("select * from stu_bill where stu_id=$billInfo->stu_id and years=$year and generate_status=3 and from_month >= $monthfdate and to_month<= $monthedate")->result();
				if(count($advancpay)>0):
					foreach($advancpay as $value):
						$expctg=explode(",",$value->fee_catg);
						foreach($expctg as $key=>$ctg):
							if(in_array($ctg,$feeidck)):
								$feekey = array_search ($ctg, $feeidck);
								$wh=array("feeid" => $feeidck[$feekey]);
								$paid=$this->db->get_where("class_fee_sett",$wh)->row()->amount;
								$advancePayAmount+=$paid;
								unset($feeidck[$feekey]);
							endif;
						endforeach;
					endforeach;
					$fees = implode(",", $feeidck);
				endif;
				//if(count($feeidck)<1) { break; }
				$BillAmount = $totalAmount;
//  end advance section
	

			$BillAmount = $totalAmount;

			if( $advancePayAmount > 0):
				$totalBill = $totalAmount - $advancePayAmount;
			endif;

			$totalBill = $BillAmount;

			//student descount check whice not payment advance bill
			$discountrate="";
			$discountctg="";
			$inddisamount="";
			$discount = $this->accmodone->getDiscount( $billInfo->shiftid,$billInfo->classid,$billInfo->roll_no,$year );
			
			if($discount !=0 ):
			$discountamount=$this->accmodone->getctgDiscount($discount,$feeidck);
			
			$disctginfo=explode("#",$discountamount);
			
			$discountrate=$disctginfo[0];
			$discountctg=$disctginfo[1];
			$inddisamount=$disctginfo[2];
			
			$totalBill = $BillAmount - $disctginfo[3];
			
			endif;
			
			//echo $totalBill;exit;
			
			if($vahicalRent > 0):
				$totalBill += $vahicalRent;
			endif;

			$status = 0;
			if($totalBill <= 0):
				$status = 1;
			endif;

			//if($totalBill<1) { break; }
			
			if($totalBill>0 && count($feeidck)>0) {
			
			// get invoice id
			$invoiceId = $this->accmodone->incInvoiceId();

			// make student bill information
			$stuBill = array(
					"stu_id" 	 => $billInfo->stu_id,
					"classid" 	 => $billInfo->classid,
					"invoice_no" => $invoiceId,
					"fee_catg"   => $fees,
					"vahicles"	 => $vid,
				"vahicle_rent"   => $vahicalRent,
				"discount"   => $discountrate,
				"discount_ctg"   => $discountctg,
				"discount_amount"   => $inddisamount,
					"total_bill" => $totalBill,
					"from_month" => $monthfdate,
					"to_month"   => $monthedate,
					"years"  	 => $year,
					"generate_status"  	 => 1,
					"status"	 => $status,
					"e_user"     => $user
				);

			// print_r($stuBill);exit;

			// insert this data into student bill
			$ins = $this->db->insert("stu_bill",$stuBill);

			// get student account
			$stuAccount = $this->accmodone->studentAccount( $billInfo->stu_id );

			// student balance
			$balance = $stuAccount - $totalBill;

			// make student account data
			$stuAccData = array(
					"balance" => $balance
				);

			// update student table
			$stuAcc = $this->db->where("stu_id",$billInfo->stu_id)->update("student_account",$stuAccData);
			
			//data insert student ledger
			$stuledger=array(
			'stu_id'       =>$billInfo->stu_id,
			'invoice_no'   =>$invoiceId,
			'debit'        =>$totalBill,
			'voucher_type' =>1,
			'e_user'       =>$user
			);
			
			$this->db->insert("student_ledger",$stuledger);
			
			}
		endforeach;
		// redirect to previous page
		//if($stuAcc){ echo 1;exit; }
		//else { echo "Bill Generate Error";exit; }
		echo 1;exit;

	endif;
	
}

// multiple student bill section end
	
	// single student bill generation section
	public function singleStdBillGen(){
		//print_r($_POST);exit;
		if(isset($_POST)):
			extract($_POST);
			if(!isset($feeidck)) {
			  echo "Choose Bill Category";exit;	
			}
			// print_r($_POST);
			$year = date("Y");
			$fees = implode(",", $feeidck);
			
			// get user id
			$user = $this->session->userdata("userid");
			
			//Exist bill generate  test same year and smae month
			$billinfo=$this->db->query("select * from stu_bill where stu_id=$proStu and years=$year and generate_status<3 and from_month >= $month and to_month<= $month")->row();
			
			if(count($billinfo)>0) { echo "Bill Already Generated";exit; }
			
			//"from_month >= "=> $month,
			//"to_month <= "	=> $month
			
			// validation total bill refference indivisual bill
			$total=$this->db->query("select sum(amount) as total from class_fee_sett where feeid in($fees) and year=$year")->row()->total;
			
			if($total!=$totalAmount) { echo "Total Amount is Wrong";exit; }
			
			// calculate student bill
				$discount = $this->accmodone->getDiscount( $shift,$classid,$stuclroll,$year );

				// check student vahicales
				$vahicales = $this->accmodone->vahicalesCheckingRent( $shift,$classid,$sections,$stuclroll,$year );

				
				$vahicalRent = $vahicales->amount?$vahicales->amount:0;

				// add vahicales id
				$vid = 0;
				if($vahicalRent):
					$vid = $vahicales->assid;
				endif;

				

	//  advanced payment section
				$advancePayAmount = 0;
				$advancpay=$this->db->query("select * from stu_bill where stu_id=$proStu and years=$year and generate_status=3 and from_month >= $month and to_month<= $month")->result();
				if(count($advancpay)>0):
					foreach($advancpay as $value):
						$expctg=explode(",",$value->fee_catg);
						foreach($expctg as $key=>$ctg):
							if(in_array($ctg,$feeidck)):
								$feekey = array_search ($ctg, $feeidck);
								$wh=array("feeid" => $feeidck[$feekey]);
								$paid=$this->db->get_where("class_fee_sett",$wh)->row()->amount;
								$advancePayAmount+=$paid;
								unset($feeidck[$feekey]);
							endif;
						endforeach;
					endforeach;
					$fees = implode(",", $feeidck);
				endif;
				if(count($feeidck)<1) { echo "Bill Advance Generated Your Selected Category";exit; }
				$BillAmount = $totalAmount;
	//  end advance section
				
				
				if($advancePayAmount > 0):
					$BillAmount = $totalAmount - $advancePayAmount;
				endif;

				$totalBill = $BillAmount;

				//student descount check whice not payment advance bill
				$discountrate="";
				$discountctg="";
				$inddisamount="";
				$discount = $this->accmodone->getDiscount( $shift,$classid,$stuclroll,$year );
				
				if($discount !=0 ):
				$discountamount=$this->accmodone->getctgDiscount($discount,$feeidck);
				
				$disctginfo=explode("#",$discountamount);
				
				$discountrate=$disctginfo[0];
				$discountctg=$disctginfo[1];
				$inddisamount=$disctginfo[2];
				
				$totalBill = $BillAmount - $disctginfo[3];
				
				endif;
				
				//echo $totalBill;exit;
				
				if($vahicalRent > 0):
					$totalBill += $vahicalRent;
				endif;

				$status = 0;
				if($totalBill <= 0):
					$status = 1;
				endif;

				if($totalBill<1) { echo "Bill Already Paid";exit; }
				
				// get invoice id
				$invoiceId = $this->accmodone->incInvoiceId();

				// make student bill information
				$stuBill = array(
						"stu_id" 	        => $proStu,
						"classid" 	        => $classid,
						"invoice_no"        => $invoiceId,
						"fee_catg"          => $fees,
						"vahicles"	        => $vid,
					    "vahicle_rent"	    => $vahicalRent,
					    "discount"          => $discountrate,
					    "discount_ctg"      => $discountctg,
					    "discount_amount"   => $inddisamount,
						"total_bill"        => $totalBill,
						"from_month"        => $month,
						"to_month"          => $month,
						"years"  	        => $year,
						"generate_status"  	=> 2,
						"status"	        => $status,
						"e_user"            => $user
					);

					// insert this data into student bill
					$ins = $this->db->insert("stu_bill",$stuBill);
					//print_r($stuBill);exit;

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
				'invoice_no'   =>$invoiceId,
				'debit'        =>$totalBill,
				'voucher_type' =>1,
				'e_user'       =>$user
				);
				
				$this->db->insert("student_ledger",$stuledger);

			// redirect to previous page
			if($stuAcc){ echo 1;exit; }
			else { echo "Bill Generate Error";exit; }

		endif;
	}
// single student bill generation section end


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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
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
		$this->load->view('account/viewlist/listof_student_ledger',$data);
		
	}
}

// bill description section start
	public function bill_description(){
		$data=array();
		extract($_GET);
		$data['invoice']=$invoice;
		$this->load->view("account/invoice/moneyReceiptModal",$data);

	}

// bill description section end

// bill print section start
	public function billPrint(){
		$data=array();
		$data['postdata']=$_GET;
		$this->load->view("account/invoice/invoicePrint",$data);
		/*exit;
		echo '
<link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript" src="../../js/update_jquery.min.js"></script>';

echo '
		<style>
			body{width:70%;margin:20px 100px}
			@media print{
				button{display:none !important;margin-top:0px !important;}
				body{margin-top:-40px !important;page-break-after:always;font-size:10px;}
				b,span,label,table,thead,tbody,tr,th,td{font-size:10px;}
				#stuName{position:relative;left:-10px;}
				#shiftName{position:relative;left:-10px;}
				#sectionName{position:relative;left:-5px;}
				h2,h6{padding:0px;margin:0px;}
				table,thead,tbody,tr,td,th{padding:0px;margin:0px;}
			}
		</style>
	';
		extract($_POST);
		// all invoice 
		$invoiceInfo = $this->accmodone->getBillInfo( $classid,$monthfdate,$year );
		if(!count($invoiceInfo)):echo '<h3 style="text-align:center;color:red;">No Generated bill found for <i style="color:blue;">'.$this->accmodone->getMonthName($monthfdate).'</i> month</h3><button class="btn btn-danger" style="margin-left:40%;" onclick="window.close()" >Close this window</button>';
		else:
		echo '<button class="btn btn-warning" style="position:relative;left:350px;width:200px;" onclick="window.print();" >Print</button><br/><br/><br/>';
		// echo "<pre>";
		// print_r($_POST);
		
		// get school profile
		$schoolProfile = $this->db->order_by("id","DESC")->limit(1)->get("sprofile")->row();

		foreach($invoiceInfo as $invoInfo):
			echo '<div style="height:49%;"><div class="panel panel-default" >
				<div class="panel-body">
					<div>
						<img src="../../img/document/school_logo/'.$schoolProfile->logo.'" height="65px" width="70px" style="position:relative;float:left;top:10px;left:20px;" />
						<h2 style="text-align:center;">'.$schoolProfile->schoolN.'</h2>
						<h6 style="text-align:center;">'.$schoolProfile->address.'</h6>
						<h6 style="text-align:center;">মোবাইলঃ '.$schoolProfile->phone.' (অফিস)</h6></br>
						<label class="label label-primary" style="position:relative;left:42%;" >অভিভাবক অবিহিত করন পত্র</label></br></br>
					</div>	
			';
			$this->bill_description( $invoInfo->invoice_no );
			echo "</div></div></div>";
			//echo "<br/><br/><br/><br/><br/>";
		endforeach;
		endif;
			*/
	}
// bill print section end

// schoolership add section start
	public function addSchoolerShip(){
		//print_r($_POST);exit;
		if(isset($_POST)):
			extract($_POST);
			$discount_ctg=array();
			$discount=array();
			
			//implode disount
			foreach($waver as $key=>$value):
			if($value>0){
				array_push($discount,$value);
				array_push($discount_ctg,$feeidck[$key]);
			}
			endforeach;
			
			if(count($discount_ctg)<1){
				echo "Enter Category Waver (%)";exit;
			}
			
			$uid = $this->session->userdata("userid");
			$aff_row = 0;
			
			// data
			$data = array(
					"shiftid"  => $shift,
					"classid"  => $class,
					"section"  => $section,
					"roll" 	   => $roll,
					"discount" => implode($discount,","),
					"discount_ctg" => implode($discount_ctg,","),
					"year" 	   => $year,
					"status"   => 1,
					"euser"    => $uid
				);
			$where = array(
				"shiftid" => $shift,
				"classid" => $class,
				"roll" 	  => $roll,
				"year" 	  => $year
			);	
			$discountinfo = $this->db->select("*")->from("schship")->where($where)->get()->row();
			if(count($discountinfo)==0){
			$ins = $this->db->insert("schship",$data);
			}
			else {
			$this->db->where("schid",$discountinfo->schid);	
			$ins=$this->db->update("schship",$data);	
			}
			
			if($ins){
			echo 1;exit;
				
			}
			else {
			echo "Data Not Save";exit;	
			}

			//$aff = array("aff"=>$aff_row);

			//$this->session->set_userdata($aff);
			//redirect("account/stu_scholarship","location");

		endif;
	}
// schoolership add section end

// bill receipt copy section start
	public function receiptCopy(){
		$this->load->view("account/invoice/receiptCopyModal");
	}
// bill receipt copy section end

// bill receipt copy print section start
	public function receiptCopyPrint(){
		$this->load->view("account/invoice/receiptCopyPrint");
	}
// bill receipt copy print section end



// get all classes
	public function getClass(){
		extract($_POST);
		$data = array(
				"shiftid" => $shf
			);
		$class = $this->db->get_where("class_catg",$data)->result();

		$className = '';
		$classId = '';


		foreach( $class as $cls ):
			$className .= $cls->class_name.',';
			$classId .= $cls->classid.',';
		endforeach;

		echo substr($className,0,-1).'+'.substr($classId,0,-1);

	}

// advanced payment fee category get
	public function advanceFeeGet(){
		error_reporting(1);
		$this->load->view('account/bill_generate/advancedPayFee');
	}

	public function singleStdFee(){
		error_reporting(1);
		$this->load->view('account/bill_generate/singleStdFee');
	}
	
	public function singleinvoicePrint(){
		$data=array();
		extract($_GET);
		$data['invoice']=$invoice;
		$this->load->view("account/invoice/singleinvoicePrint",$data);
	}


}