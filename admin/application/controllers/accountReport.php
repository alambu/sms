<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AccountReport extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$stid = $this->session->userdata('userid');
		$ststatus = $this->session->userdata('status');
		$stsid = $this->session->userdata('sId');
		if($stid==''){ redirect('login?error=2','location'); }
		$this->load->model('account_model','accmodone');
		$this->load->model('account_model_edit','accmodtwo');
		$this->load->model('numbertobangla','numbershow');
		
		
	}

	// monthly expanse report
	public function monthlyExpanseStatement(){
		$this->load->view("account/report/monthlyExpanse");
	}



// monthlty income report start
	public function monthlyIncomeReport(){
		// $this->load->view("header");
		// $this->load->view("leftbar");
		$this->load->view("account/report/monthlyIncome");
		// $this->load->view("footer");
	}

// monthly income report end


// monthly income statement monthly closing
	public function monthlyClosing(){
		if(isset($_POST['monthClosing'])):
			extract($_POST);
			$aff_row = 0;

			$data = array(
					"total_income" => $total,
					"month"		   => $month,
					"year"		   => $year
				);

			$checkExit = $this->accmodone->checkExitsAccountClosing( $month,$year );

			if( $checkExit ):
				$update = $this->accmodone->updateAccountIncome( $total,$month,$year );
			else:
				$ins = $this->accmodone->insertAccountIncome( $data );
			endif;

			if( $update || $ins ):
				$aff_row++;
			endif;
				
			$aff=array("aff"=>$aff_row);

			$this->session->set_userdata($aff);

			redirect("accountReport/monthlyIncomeReport","location");

		endif;
	}

	// monthly expanse statement monthly closing
	public function monthlyExpClosing(){
		if(isset($_POST['monthClosing'])):
			extract($_POST);
			$aff_row = 0;

			$data = array(
					"total_expanse" => $totalExp,
					"hand_cash"     => $handCash,
					"bank_cash"     => $bankCash,
					"month"		    => $month,
					"year"		    => $year
				);

			$checkExit = $this->accmodone->checkExitsAccountClosing( $month,$year );

			if( $checkExit ):
				$update = $this->accmodone->updateAccountExp( $total,$handCash,$bankCash,$month,$year );
			else:
				$ins = $this->accmodone->insertAccountExp( $data );
			endif;

			if( $update || $ins ):
				$aff_row++;
			endif;
				
			$aff=array("aff"=>$aff_row);

			$this->session->set_userdata($aff);

			redirect("accountReport/monthlyIncomeReport","location");

		endif;
	}

	// advanced reporting
	public function advancedPaymentReport(){
		$this->load->view("header");
		$this->load->view("leftbar");
		$this->load->view("account/report/advancedReport");
		$this->load->view("footer");
	}

	// student assign to vahicles
	public function vahicleStdAssign(){
		$this->load->view("header");
		$this->load->view("leftbar");
		$this->load->view("account/vanAssign");
		$this->load->view("footer");
	}
	
	public function vanEdit(){
		$this->load->view("account/vanEdit");
	}

	public function EnableDisableVan( $vassid,$status ){
		$data = array( "status" => $status );
		$update = $this->db->where("assid",$vassid)->update("van_assign",$data);
		echo $update;
	}

	public function duplicateVanAssign( $vahicles,$shift,$class,$section,$roll ){

		$y = date("Y");
		$data = array(
				"vanid" 	=> $vahicles,
				"shiftid" 	=> $shift,
				"classid" 	=> $class,
				"sectionid" => $section,
				"roll" 		=> $roll,
				"status" 	=> 1,
				"year" 		=> $y
			);

		echo $this->db->get_where("van_assign",$data)->num_rows();

	}

	public function studentLedger() {
		$this->load->view("header");
		$this->load->view("leftbar");
		$this->load->view("account/report/StudentLedger");
		$this->load->view("footer");
	}
	
	public function vanPaymentHistory(){
		//$this->load->view("header");
		//$this->load->view("leftbar");
		$this->load->view("account/report/vanPaymentHistory");
		//$this->load->view("footer");
	}

}