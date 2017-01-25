<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class account_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	public function exmname($id){
		$sqlexm=$this->db->SELECT('exm_name')->FROM('exm_namectg')->where('exmnid',$id)->get()->row();
		return $sqlexm;
	}
	public function accountinsert($data){
		$status=$this->db->insert('account_cre',$data);
		return $status;
	}

	function mainLedger($data){
		$status = $this->db->insert('main_ledger',$data);
		return $status;
	}

	public function accountinfo($accid){
		$status=$this->db->select('*')->from('account_cre')->where('accountid',$accid)->get()->row();
		return $status;
	}
	public function legderinsert($leger){
		$status=$this->db->insert('main_ledger',$leger);
		return $status;
	}
	public function extraincomes($data){
		$status=$this->db->insert('other_income',$data);
		return $status;
	}
	public function classfeesett_sin($data){
		$status=$this->db->insert('class_fee_sett',$data);
		return $status;
	}
	public function expanseinsert($data){
		$status=$this->db->insert('expance',$data);
		return $status;
	}
	public function appfeeinsert($data){
		$status=$this->db->insert('app_fees',$data);
		return $status;
	}
	public function classname($classid){
		$query=$this->db->query("SELECT class_name FROM class_catg WHERE classid='$classid'");
		$queryrow=$query->row();
		return $queryrow;
	}
	public function classcount($classid){
		$query=$this->db->query("SELECT count(classid) as tclass FROM class_fee_sett WHERE classid='$classid'");
		$queryrow=$query->row();
		return $queryrow;
	}
	public function classfeecatg($feectgid){
		$query=$this->db->query("SELECT catg_type FROM fee_catg WHERE feectgid='$feectgid'");
		$feerow=$query->row();
		return $feerow;
	}
	public function studentname($stuid){
		$query=$this->db->query("SELECT name FROM regis_tbl WHERE stu_id='$stuid'");

		$stuids=$query->row();
		return $stuids;
	}
	public function billdisription($bildes){
		$status=$this->db->insert('stu_bill_descrip',$bildes);
		return $status;
	}
	public function billcreate($stubills){
		$status=$this->db->insert('stu_bill',$stubills);
		return $status;
	}
	public function studentleger($ledger){
		$status=$this->db->insert('stu_ledger',$ledger);
		return $status;
	}
	public function studentpay($stu_pays){
		$status=$this->db->insert('stu_pay',$stu_pays);
		return $status;
	}
	public function stuschship($data){
		$status=$this->db->insert('schship',$data);
		return $status;
	}
	public function readimssion($id){
		$query=$this->db->query("SELECT * FROM re_admission WHERE readid='$id'");
		$stuids=$query->row();
		return $stuids;
	}
	public function sectionshow($id){
		$classql=$this->db->select('*')->from('class_catg')->WHERE('classid',$id)->get()->row();
		 $querys=$classql->section;
		 return $querys;
	}

// transaction id
	function transactionId(){
		$trid = $this->db->order_by("id","DESC")->limit(1)->get("transaction_log")->row();
		
		if( $trid->trans_id ):
			$transactionKey = $trid->trans_id+1;
		else:
			$transactionKey = substr(microtime() + floor(rand()*100),0,8);
		endif;

			$data = array(
				"id" 	   => '',
				"trans_id" => $transactionKey
			);
			$this->db->insert("transaction_log",$data);

		
		return $transactionKey;

	}

	// income invoice id
	function incInvoiceId(){
		$invid = $this->db->order_by("id","DESC")->limit(1)->get("inc_invoice_log")->row();
		
		if( $invid->invoice_id ):
			$invoiceKey = $invid->invoice_id+1;
		else:
			$gentkey=substr(microtime() + floor(rand()*100),0,8);
			$invoiceKey = str_replace(".","",$gentkey);
		endif;

			$data = array(
				"invoice_id" => $invoiceKey
			);
			$this->db->insert("inc_invoice_log",$data);

		return $invoiceKey;
	}

	// expanse invoice id
	function expInvoiceId(){
		$invid = $this->db->order_by("id","DESC")->limit(1)->get("exp_invoice_log")->row();
		
		if( $invid->invoice_id ):
			$invoiceKey = $invid->invoice_id+1;
		else:
			$invoiceKey = str_replace(".","",substr(microtime() + floor(rand()*100),0,8));
		endif;

			$data = array(
				"id" 		 => '',
				"invoice_id" => $invoiceKey
			);
			$this->db->insert("exp_invoice_log",$data);

		return $invoiceKey;
	}
	
	// transfer invoice id
	function transferInvoiceId() {
		$invid = $this->db->order_by("id","DESC")->limit(1)->get("transfer_invoice_log")->row();
		
		if( $invid->invoice_id ):
			$invoiceKey = $invid->invoice_id+1;
		else:
			$invoiceKey = str_replace(".","",substr(microtime() + floor(rand()*100),0,8));
		endif;

			$data = array(
				"invoice_id" => $invoiceKey
			);
			$this->db->insert("transfer_invoice_log",$data);

		return $invoiceKey;
	}

// income statement report
	function incomeStatement( $data,$w ){
		$default = array(2,3,5);

		if($w == '1'):
			return $this->db->select("*")->from("main_ledger")->where($data)->where_in("trans_type",$default)->order_by("id","DESC")->get()->result();
		else:
			return $this->db->select("*")->from("main_ledger")->where($data)->where_in("trans_type",$default)->where($w)->order_by("id","DESC")->get()->result();
		endif;
	}

// expanse statement
function expanseStatement( $data,$w ){
	$default = array(4);

		if($w == '1'):
			return $this->db->select("*")->from("main_ledger")->where($data)->where_in("trans_type",$default)->order_by("id","DESC")->get()->result();
		else:
			return $this->db->select("*")->from("main_ledger")->where($data)->where_in("trans_type",$default)->where($w)->order_by("id","DESC")->get()->result();
		endif;
}

// transaction category name or purpose
	function incomeTransactionType($category){
		$category = trim($category);
		return $this->db->select("income_type")->from("income_catg")->where("id",$category)->get()->row()->income_type;
	}

// expanse category name or purpose
	function expanseTransactionType( $category ){
		$category = trim($category);
		return $this->db->select("expance_type")->from("expance_catg")->where("id",$category)->get()->row()->expance_type;	
	}

// main ledger section
	function mainLedgerStatement( $data,$w ){

		if($w == '1'):
			return $this->db->select("*")->from("main_ledger")->where($data)->order_by("id","DESC")->get()->result();
		else:
			return $this->db->select("*")->from("main_ledger")->where($data)->where($w)->order_by("id","DESC")->get()->result();
		endif;
	}

	// get month name
	function getMonthName( $m ){
		$months = array(
                "1"  => "January",
                "01" => "January",
                "2"  => "February",
                "02" => "February",
                "3"  => "March",
                "03" => "March",
                "4"  => "Appril",
                "04" => "Appril",
                "5"  => "May",
                "05" => "May",
                "6"  => "June",
                "06" => "June",
                "7"  => "July",
                "07" => "July",
                "8"  => "August",
                "08" => "August",
                "9"  => "September",
                "09" => "September",
                "10" => "October",
                "11" => "November",
                "12" => "December"
            );
        return $months[$m];
	}

	// get extra income report
	function extraIncomeRepo( $month,$year ){
		return $this->db->select("i.income_type,m.id,sum(debit) as amount")->from("main_ledger m")->join("income_catg i","m.trans_catg = i.id","left")->where("m.trans_type","3")->where("m.month",$month)->where("m.year",$year)->group_by("trans_catg")->get()->result();
	}


	// income hand cash

	function incHandCash( $m,$y ){
		return $this->db->select("*")->from("monthly_closing")->where("month",$m)->where("year",$y)->order_by("id","DESC")->limit(1)->get()->row()->hand_cash;
	}

	// expanse hand cash

	function expHandCash( $m,$y ){
		return $this->db->select("sum(balance) as total")->from("account_cre")->where("bank_type","1")->get()->row()->total;
	}

	// bank balance

	function incBankBalance( $m,$y ){
		return $this->db->select("*")->from("monthly_closing")->where("month",$m)->where("year",$y)->order_by("id","DESC")->limit(1)->get()->row()->bank_cash;
	}

	// expanse bank balance

	function expBankBalance( $m,$y ){
		return $this->db->select("sum(balance) as total")->from("account_cre")->where("bank_type","2")->get()->row()->total;
	}

	// school information
	function schoolInfo(){
		return $this->db->limit(1)->order_by("id","DESC")->get("sprofile")->row();
	}

	// exiting accounting data in history log
	function checkExitsAccountClosing( $month,$year ){
		return $this->db->where("month",$month)->where("year",$year)->get("monthly_closing")->num_rows();
	}

	// monthly account closing update income
	function updateAccountIncome( $total,$month,$year ){
		$data = array( "total_income" => $total );
		return $this->db->where("month",$month)->where("year",$year)->update("monthly_closing",$data);
	}

	// monthly account closing insert income
	function insertAccountIncome( $data ){
		return $this->db->insert("monthly_closing",$data);
	}

	// current month total income
	function currentTotalIncome(){
		$m = date("m");
		$y = date("Y");
		return $this->db->where("month",$m)->where("year",$y)->order_by("id","DESC")->limit(1)->get("monthly_closing")->row()->total_income;
	}

	// update monthly statement closing expanse
	function updateAccountExp( $total,$handCash,$bankCash,$month,$year ){
		$w = array(
				"month" => $month,
				"year"  => $year
			);
		$data = array(
				"total_expanse" => $total,
				"hand_cash" => $handCash,
				"bank_cash" => $bankCash
			);

		return $this->db->where($w)->update("monthly_closing",$data);

	}

	// monthly account closing insert expanse
	function insertAccountExp( $data ){
		return $this->db->insert("monthly_closing",$data);
	}


	// schooler ship 
	function schoolerShip( $data ){
		return $this->db->where($data)->get("schship")->result();
	}

	// get class name
	function getClass( $cls ){
		return $this->db->where("classid",$cls)->get("class_catg")->row();
	}

	// get class name
	function getShift( $shft ){
		return $this->db->where("shiftid",$shft)->get("shift_catg")->row();
	}
	
	// get Section name
	function getSection( $secid ){
		return $this->db->where("sectionid",$secid)->get("section_tbl")->row();
	}

	// get student name
	function stdName( $shift,$class,$roll,$year ){
		
		return $this->db->query("SELECT * FROM re_admission r LEFT JOIN regis_tbl t ON r.stu_id = t.stu_id WHERE r.shiftid = '$shift' AND r.classid = '$class' AND r.roll_no = '$roll' AND r.syear = '$year'")->row();
	}

	// get those student id whose bill was not generated
	function inCompleteBillStd( $class,$year,$fmonth,$tmonth ){
		return $this->db->query("SELECT * FROM re_admission WHERE classid = '$class' AND syear = '$year' AND status = 1 AND stu_id NOT IN(SELECT stu_id FROM stu_bill WHERE classid = '$class' AND years = '$year'AND from_month = '$fmonth' AND to_month = '$tmonth' AND generate_status<3)")->result();
	}

	// get student discount
	function getDiscount( $shift,$class,$roll,$year ) {

		// data info
		$data = array(
			"shiftid" => $shift,
			"classid" => $class,
			"roll" 	  => $roll,
			"year" 	  => $year
		);

		$discount = $this->db->select("*")->from("schship")->where($data)->get()->row();

		//return $discount = $discount->discount?$discount:0;
		if(count($discount)==0)
		{
			return 0;
		}
		else 
		{
			return $discount->discount."#".$discount->discount_ctg;
		}
	
	}
	
	// calculate category wise discount
	
	function getctgDiscount($str,$selctg) {
		$strfind=explode("#",$str);
		$strctg=explode(",",$strfind[1]);
		$strdiscount=explode(",",$strfind[0]);
		$discountamount=array();
		
		$ctgamount=$this->db->query("select amount from class_fee_sett where feeid in($strfind[1])")->result_array();
		$i=0;
		foreach($ctgamount as $value):
		if(in_array($strctg[$i],$selctg)){
		$amount=($value['amount']*($strdiscount[$i]/100));
		array_push($discountamount,$amount);
		}
		else {
			unset($strctg[$i]);
			unset($strdiscount[$i]);
		}
		$i++;
		endforeach;
		return implode($strdiscount,",").'#'.implode($strctg,",").'#'.implode($discountamount,",").'#'.array_sum($discountamount);
	}

	// student account information
	function studentAccount( $stu_id ){
		
		$data = array(
				"stu_id" => $stu_id
			);

		$chk = $this->db->get_where("student_account",$data)->row();
	
		if( $chk->stu_id ):
			return $chk->balance;
		else:
			$info = array(
					"stu_id" => $stu_id,
					"balance" => 0
				);
			$ins = $this->db->insert("student_account",$info);

			if( $ins ):
				$this->studentAccount( $stu_id );
			endif;
		endif;
	}

	// get user name
	function getUserName( $uid ){
		$data = array(
				"userid" => $uid
			);
		return $this->db->get_where("user_reg",$data)->row()->fullname;
	}

	// get invoice information
	function invoiceInfo( $invoiceId ){
		$data = array(
				"invoice_no" => $invoiceId
			);
		return $this->db->get_where("stu_bill",$data)->row();
	}

	// student information
	function studentInformation( $studentId,$year ){
		return $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,r.groupid,r.roll_no,r.classid,r.shiftid,r.roll_no,r.syear,r.section,r.section,r.shiftid,r.classid,r.syear FROM re_admission r RIGHT JOIN shift_catg s ON r.shiftid = s.shiftid RIGHT JOIN class_catg c ON r.classid = c.classid RIGHT JOIN section_tbl p ON r.section = p.sectionid WHERE r.stu_id = '$studentId' AND r.syear = '$year' AND r.status=1")->row();
	}
	
	// waver information
	function waverInformation( $shift,$class,$section,$roll_no,$year ){
		// make data
		$data = array(
			"shiftid" => $shift,
			"classid" => $class,
			"section" => $section,
			"roll" => $roll_no,
			"year" => $year,
			"status" => '1' 
		);
		
		return $this->db->get_where("schship",$data)->row();
		
	}
	

	// fees category list
	function feesCategory( $fees ){
		
		$f = explode(",", $fees);
		$feeName = '';
		$feeAmount = '';
		
		for($i = 0;$i < count($f);$i++):
			$query = $this->db->query("SELECT c.amount,feeid,f.catg_type FROM class_fee_sett c RIGHT JOIN fee_catg f ON f.feectgid = c.feectgid WHERE c.feeid = '$f[$i]'")->row();
			
			$feeName .= $query->catg_type.',';
			$feeAmount .= $query->amount.',';
			$feeCategory .= $query->feeid.',';
		
		endfor;

		return substr($feeName,0,-1).'+'.substr($feeAmount,0,-1).'+'.substr($feeCategory,0,-1);
	}

	// get invoice information
	function getBillInfo( $class,$month,$year ){
		$data = array(
				"classid" 		=> $class,
				"years"         => $year,
				"from_month >= "=> $month,
				"to_month <= "	=> $month
			);
		return $this->db->get_where("stu_bill",$data)->result();
	}
	
	// get singleinvoice information
	function getsingleInvoiceInfo( $inc ){
		$where = array(
				"invoice_no" 	=> $inc
			);
		return $this->db->get_where("stu_bill",$where)->result();
	}
	
	

	// current account balance
	function currentAccountBalance(){
		return $this->db->select("*")->from("account_cre")->where("bank_type","1")->order_by("id","DESC")->limit(1)->get()->row();
	}

	// student payment report
	function studentPaymentReport( $data ){
		
		$where = 'WHERE ';
		foreach($data as $key => $value ):
			$where .= $key.'='.$value.' AND ';
		endforeach;

		$where = substr($where, 0 , -4);

		return $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,r.groupid,r.roll_no,stb.invoice_no,stp.trans_id,rg.name,stb.e_date as bdate,stp.e_date as pdate,stp.payment,r.roll_no FROM re_admission r RIGHT JOIN stu_bill stb ON stb.stu_id = r.stu_id RIGHT JOIN stu_pay stp ON stp.invoice_no = stb.invoice_no RIGHT JOIN shift_catg s ON r.shiftid = s.shiftid RIGHT JOIN class_catg c ON r.classid = c.classid RIGHT JOIN section_tbl p ON r.section = p.sectionid RIGHT JOIN regis_tbl rg ON rg.stu_id = r.stu_id $where")->result();
	}

	// get transaction information
	function billPaymentInfo( $transId ){
		$data = array(
				"trans_id" => $transId
			);
		return $this->db->get_where("stu_pay",$data)->row();
	}

	// bill generate report
	function billGenerateReport( $data ){
		$where = 'WHERE ';
		
		foreach($data as $key => $value ):
			$where .= $key.'='.$value.' AND ';
		endforeach;

		$where = substr($where, 0 , -4);

		return $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,r.roll_no,stb.invoice_no,rg.name,stb.e_date as gdate,stb.total_bill,r.roll_no,stb.from_month,stb.to_month,stb.years,stb.e_user,stb.status FROM stu_bill stb LEFT JOIN re_admission r ON stb.stu_id = r.stu_id LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id $where")->result();
	}

	// present cash balance
	function cashBalance(){
		return $this->db->select("sum(balance) as balance")->from("account_cre")->where("bank_type","1")->get()->row()->balance;
	}

	// present bank balance
	function bankBalance(){
		return $this->db->select("sum(balance) as balance")->from("account_cre")->where("bank_type","2")->get()->row()->balance;
	}

	// todays income
	function todayIncome(){
		$date = date("Y-m-d");

		return $this->db->query("SELECT sum(debit) as balance FROM main_ledger WHERE trans_type IN (2,3,5) AND date(e_date) = '$date'")->row()->balance;
		//return $this->db->last_query();
	}

	// todays income
	function todayExpanse(){
		$date = date("Y-m-d");

		return $this->db->query("SELECT sum(credit) as balance FROM main_ledger WHERE trans_type = 4 AND date(e_date) = date('$date')")->row()->balance;
	}

		// student information 
	function getProfil(){
		
		$shift = $this->shift;
		$class = $this->class;
		$section = $this->section;
		$roll = $this->roll;
		
		return $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,rg.name,r.roll_no,rg.picture,sac.balance FROM re_admission r LEFT JOIN shift_catg s ON r.shiftid = s.shiftid LEFT JOIN class_catg c ON r.classid = c.classid LEFT JOIN section_tbl p ON r.section = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id LEFT JOIN student_account sac ON sac.stu_id = r.stu_id WHERE r.shiftid = '$shift' AND r.classid = '$class' AND r.section = '$section' AND r.roll_no = '$roll' ")->row();
	}

	// get student account information
	function studentAccountBalance( $stu_id ){
		$data = array(
				"stu_id" => $stu_id
			);
		return $this->db->get_where("student_account",$data)->row();
	}

	// cash account present balance info
	function cashAccountBalance(){
		$data = array(
				"bank_type" => 1
			);

		return $this->db->get_where("account_cre",$data)->row();
	}

	// advanced payment report
	function advancedReport( $data ){
		//error_reporting(1);
		// return $data;
		$where = 'WHERE ';
		foreach($data as $key => $value):
			$where .= $key . "= ". $value . " AND ";
		endforeach;

		$where = substr($where, 0 , -4);

		return $this->db->query("SELECT r.stu_id,c.class_name,s.shift_N,p.section_name,r.roll_no,rg.name,r.roll_no,a.edate,a.amount,a.adv_year,a.from_month,a.to_month FROM advancepayment a LEFT JOIN re_admission r ON a.stu_id = r.stu_id LEFT JOIN shift_catg s ON a.shiftid = s.shiftid LEFT JOIN class_catg c ON a.classid = c.classid LEFT JOIN section_tbl p ON a.sectionid = p.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id $where ")->result();
		// return $this->db->last_query();

	}

	// van assign student report
	function vanAssignReport( $data ){
		$where = ' ';
		foreach($data as $key => $value):
			$where .= $key . "= ". $value . " AND ";
		endforeach;

		$where = substr($where, 0 , -4);

		return $this->db->query("SELECT v.assid,amount,r.stu_id,rg.name,picture,s.shift_N,stb.section_name,c.class_name,v.roll,v.edate,v.status,v.udate FROM van_assign v RIGHT JOIN re_admission r ON v.year = r.syear LEFT JOIN shift_catg s ON s.shiftid = v.shiftid LEFT JOIN class_catg c ON c.classid = v.classid LEFT JOIN section_tbl stb ON stb.sectionid = v.sectionid LEFT JOIN regis_tbl rg ON rg.stu_id = r.stu_id WHERE v.shiftid = r.shiftid AND v.classid = r.classid AND v.sectionid = r.section AND v.roll = r.roll_no AND $where")->result();
	}

	// vahicales checking rent balance
	function vahicalesCheckingRent($shift,$class,$section,$roll,$year){
		$data = array(
				"shiftid" 	=> $shift,
				"classid" 	=> $class,
				"sectionid" => $section,
				"roll" 		=> $roll,
				"year" 		=> $year,
				"status" 	=> 1
			);
		return $this->db->query("SELECT vs.assid,v.rent,vs.amount,vs.vanid FROM van_assign vs LEFT JOIN vahicles v ON vs.vanid = v.vid WHERE vs.shiftid = $shift AND vs.classid = $class AND vs.sectionid = $section AND vs.roll = $roll AND vs.year = $year AND vs.status = 1")->row();
	}

	// total teacher count
	function totalTeacherCount(){
		$data = array( "emptypeid" => "1" );
		return $this->db->get_where("empee",$data)->num_rows();
	}

	// total parents count
	function totalParentsCount(){
		return $this->db->count_all("father_login");
	}

	// advanced payment information of current year
	function advancedInfoThisYear( $studentId,$fMonth,$eMonth,$feeId,$year ) {
		$advanceBalance = $this->db->query("SELECT a.payid,a.trans_id,a.invoice_no,a.stu_id,c.amount FROM advancepayment a
RIGHT JOIN class_fee_sett c ON c.feeid = a.trans_catg WHERE stu_id = $studentId AND adv_year = '$year' AND trans_catg = '$feeId' AND from_month <= '$fMonth' AND to_month >= '$eMonth'")->row()->amount;

		return $balance = $advanceBalance?$advanceBalance:0;

	}
	
	// student due
	function dueAmountOfStudent( $studentId ){
		return $this->db->select("balance")->from("student_account")->where("stu_id",$studentId)->get()->row()
->balance;
	}

function studentAllTransID( $studentID ){
	$pay = $this->db->query("SELECT GROUP_CONCAT(trans_id) AS pt FROM stu_pay WHERE stu_id = '$studentID'")->row()->pt;
	
	if($pay==''){ return 0; }
	else {
	return $pay;	
	}
	return $totalTrans;
	
}

function mainLedgerStudentHistory( $transID ){
	$mainLedger = $this->db->query("SELECT * FROM main_ledger WHERE trans_id IN($transID) ORDER BY e_date ASC")->result();
	return json_decode(json_encode($mainLedger),true);
}
	
function studentAllBill( $studentID ){
	$bill = $this->db->query("SELECT * FROM stu_bill WHERE stu_id = '$studentID'")->result();
	return json_decode(json_encode($bill),true);
}

	function array_orderby( &$arr, $col, $dir = SORT_ASC ){

    	$sort_col = array();
    	
    	foreach ($arr as $key=> $row) {
        	$sort_col[$key] = $row[$col];
    	}

    	array_multisort($sort_col, $dir, $arr);
    	return $arr;
	}


	function duplicatAdvanceCheck( $shift,$class,$section,$roll,$fm,$tm,$y,$catg ){
		$where = array(
			"shiftid" 		 => $shift,
			"classid" 		 => $class,
			"sectionid" 	 => $section,
			"roll" 			 => $roll,
			"from_month >= " => $fm,
			"to_month <= " 	 => $tm,
			"adv_year" 		 => $y,
			"trans_catg" 	 => $catg
		);

	return $dupliCount = $this->db->get_where("advancepayment",$where)->num_rows();
	}
	
	
	
	//sms api function start
	
	public function send_sms($mobile,$txt)
	{
		
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
		if($response->IsError)
		{
		 //echo "<h2 style='color:red'>FAILED!</h3>";
		 // Know the reason for failure (and the error code)
		 echo sprintf("Reason: %s [%d]", $response->ErrorMessage, $response->ErrorCode);
		}
		else
		{
			//echo "<h2 style='color:green;'>SUCCESS!</h2>";
			//return true;
		}
	}

	
	public function vahicaleRentHistory($stuid) {
		return $this->db->query("select * from stu_bill where vahicles!=0 and status=1 and stu_id=$stuid")->result();
	}
	
	
	//check dublicate bill category same year and same month
	public function dublicateCategoryTest($stuid,$y,$month,$sfee) {
		$billinfo=$this->db->query("select * from stu_bill where stu_id=$stuid and years=$y and from_month=$month")->result();
		//print_r($billinfo);exit;
		if(count($billinfo)>0):
		
		foreach($billinfo as $value):
			$explodectg=explode(",",$value->fee_catg);
			foreach($explodectg as $ctg):
				if(in_array($ctg,$sfee)): 
				//echo $ctg;
				$query = $this->db->query("SELECT f.feeid,c.* FROM class_fee_sett f, fee_catg c WHERE f.feeid = $ctg and f.feectgid=c.feectgid")->row();
				//print_r($query);
				echo  $query->catg_type. " Already Generate Your Selected Month";exit;
				endif;
			endforeach;
		endforeach;
		
		endif;
		
		//return 0;
	
	}

}

?>