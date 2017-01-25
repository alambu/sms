<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class edit extends CI_Controller {
	public function __construct(){
		parent::__construct();

		date_default_timezone_set('Asia/Dhaka');
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		$ses_sql=$this->db->select('userid,status,sId')->from('user_reg')->where('userid',$stid)->get()->row();
		if($this->db->affected_rows()<1)
		{
			redirect('login?error=3','location');
		}
		if($stid==$ses_sql->userid && $ststatus==$ses_sql->status && $stsid==$ses_sql->sId){
		$this->load->model('admin_model','n');
		}
		else{
			redirect('login?error=2','location');
		}
		$this->load->model('admin_model','n');
	}


	public function deactiveXm(){
		$stdID=$_POST['stdid'];
		$idval=$_POST['dd'];

		$data=array(
			"status"=>0
			);

		$upDate=$this->db->where("exmnid",$stdID)->update("exm_namectg",$data);

		if($upDate){echo "success".'+'.$idval;}else{echo "Fail".'+'.$idval;}

	}

	public function activeXm(){
		$stdID=$_POST['stdid'];
		$idval=$_POST['dd'];

		$data=array(
			"status"=>1
			);

		$upDate=$this->db->where("exmnid",$stdID)->update("exm_namectg",$data);

		if($upDate){echo "success".'+'.$idval;}else{echo "Fail".'+'.$idval;}

	}

	public function xmNmEdit(){
		$xmID=$_POST['xmID'];
		$xmName=$_POST['xmName'];
		$sdd=$_POST['sid'];
		$uDate=date("Y-m-d H:i:s");
		$user=$this->session->userdata("userid");

		$data=array(
			"exm_name"=>$xmName,
			"up_user"=>$user,
			"up_date"=>$uDate
			);

		$ext = 0;
		$ext = $this->db->select("*")->from("exm_namectg")->where("exm_name",$xmName)->get()->num_rows();
		
		if( $ext == 0 ):
			$xmNameUp = $this->db->where("exmnid",$xmID)->update("exm_namectg",$data);
		else:
			$oldXm = $this->db->select("*")->from("exm_namectg")->where("exmnid",$xmID)->get()->row();
			$xmName = $oldXm->exm_name;
		endif;
		echo $sdd.'+'.$xmName.'+'.$ext;
		// echo $xmName;
	}

// this function is for editing exam date

public function xmDateChange(){
	$data=$_POST['d'];
	$id=$_POST['id'];
	$usd=$this->session->userdata('userid');

	$upData=array(
		"exmdate"=>$data,
		"up_user"=>$usd
		);

	$up=$this->db->where("exm_ctgid",$id)->update("exm_catg",$upData);

	echo $data."+".$id;
}

// exam close function
public function xmClose(){
	$idXm=$_POST['xmCatId'];
	$usd=$this->session->userdata('userid');

	$data=array(
		"status"=>0,
		"up_user"=>$usd
		);

	$xmClUp=$this->db->where("exm_ctgid",$idXm)->update("exm_catg",$data);

	echo "Successfuly close this exam";

}

	public function xmSeatPlanEdit(){
		$allData=$_POST['data'];
		$data=explode("+", $allData);

		// user id
		$usd=$this->session->userdata('userid');

		// date time
		$dt=date("Y-m-d H:i:s");

		// split all data into small part
		$cl=$data[0];
		$sect=$data[1];
		$roll=$data[2];
		$room=$data[3];
		$xmid=$data[5];
		$ft=$data[7];
		$rowId=$data[8];

		// make data array
		$dArray=array(
			"classN"=>$cl,
			"shiftid"=>$ft,
			"section"=>$sect,
			"roll_no"=>$roll,
			"room"=>$room,
			"up_date"=>$dt,
			"up_user"=>$usd
			);

		// update data into database

		$this->db->where("id",$rowId)->update("exm_seatplain",$dArray);
		
		// after success
		echo $allData;

	}

	public function gdEdit(){
		$data=explode(",", $_POST['d']);

		$gdNm=$data[0];
		$sR=$data[1];
		$eR=$data[2];
		$gdPt=$data[3];
		$gdRow=$data[4];

		$gDate=date("Y-m-d H:i:s");
		$gUser=$this->session->userdata('userid');

		$dArray=array(
			"grade_N"=>$gdNm,
			"grade_point"=>$gdPt,
			"mark_from"=>$sR,
			"mark_upto"=>$eR,
			"up_date"=>$gDate,
			"up_user"=>$gUser
			);

		// if this grade exits in database
		$gdNameCk = $this->db->select("*")->from("exm_grade")->where("grade_N",$gdNm)->where_not_in("gradid",$gdRow)->get()->num_rows();

// grade point check
		$gdPointCk = $this->db->select("*")->from("exm_grade")->where("grade_point",$gdPt)->where_not_in("gradid",$gdRow)->get()->num_rows();
// check mark rang
		$markChk = $this->db->select("*")->from("exm_grade")->where("mark_from",$sR)->where("mark_upto",$eR)->where_not_in("gradid",$gdRow)->get()->num_rows();
// check all
		$allChk = $this->db->select("*")->from("exm_grade")->where("grade_N",$gdNm)->where("grade_point",$gdPt)->where("mark_upto",$eR)->where_not_in("gradid",$gdRow)->get()->num_rows();

if( $gdNameCk || $gdPointCk || $markChk || $allChk ):
	echo 2;
else:
	$gUpdate=$this->db->where("gradid",$gdRow)->update("exm_grade",$dArray);

		if( $gUpdate ){
			echo 1;
		}
endif;
}

	public function distPapUp(){
		$data=array(
			"techID"=>$_POST['t'],
			"tpaper"=>$_POST['dpt'],
			"retdate"=>$_POST['rD']
			);

		$disUp=$this->db->where("pdisid",$_POST['id'])->update("exm_pdistribute",$data);

		if($this->db->affected_rows()){
			echo 1;
		}
	}

	public function passMarkEdit(){

		$data=$_POST['d'];

		$sepData=explode("+", $data);

		// update identifier
		$upD=date("Y-m-d H:i:s");
		$upU=$this->session->userdata('userid');

		// editing data array for update
		$edata=array(
			"theory"=>$sepData[0],
			"obj"=>$sepData[1],
			"diff_pass"=>$sepData[2],
			"t_mark"=>$sepData[3],
			"up_date"=>$upD,
			"up_user"=>$upU
			);		

		$passUp=$this->db->where("passid",$sepData[4])->update("pass_markctg",$edata);

		if($this->db->affected_rows()){
			echo "1";
		}
	}


	// other exam edit
	public function oThxmNmEdit(){
		$xmID=$_POST['xmID'];
		$xmName = $_POST['xmName'];
		$sdd=$_POST['sid'];
		$uDate=date("Y-m-d H:i:s");
		$user=$this->session->userdata("userid");

		$data=array(
			"exm_name"=>$xmName,
			"up_user"=>$user,
			"up_date"=>$uDate
			);
// echo "1";
		$ext = 0;
		$ext = $this->db->select("*")->from("exm_othercatg")->where("exm_name",$xmName)->get()->num_rows();

		if( $ext == 0 ):
			$xmNameUp=$this->db->where("othexmid",$xmID)->update("exm_othercatg",$data);
		else:
			$oldXm = $this->db->select("*")->from("exm_othercatg")->where("othexmid",$xmID)->get()->row();
			$xmName = $oldXm->exm_name;
		endif;

		echo $sdd.'+'.$xmName.'+'.$ext;
	}


// room setup edit
public function UpdateRoomData(){
	extract($_POST);
	// initial value
	$upuser = $this->session->userdata("userid");

	$data = array(
			"room_number" => $d,
			"r_name" 	  => $dd,
			"up_user" 	  => $upuser
		);

	$up = $this->db->where("roomid",$ddd)->update("room_settup",$data);
	if( $up ):
		echo 1;
	else:
		echo 0;
	endif;
}


}