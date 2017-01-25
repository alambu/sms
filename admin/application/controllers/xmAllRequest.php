<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class xmAllRequest extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
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
		$this->load->model('student','report');
		}
		else{
			redirect('login?error=2','location');
		}
	}

public function seatPlanSection(){
	if(isset($_POST['clsid'])){
		$cls=$_POST['clsid'];

		$section = $this->db->select("group_concat(DISTINCT section_name ORDER BY section_name ASC SEPARATOR ',') AS section")->from("section_tbl")->where("classid",$cls)->get()->row();
		echo $section->section;
		// echo $this->db->last_query();
	}
}

public function subjectFind(){
	if(isset($_POST['clsid'])){
		$cls=$_POST['clsid'];
		$subjN='';
		$subjD='';
		
		$subj=$this->db->query("SELECT s.subjid,p.sub_name FROM subject_class s right join subject_setup p ON s.subsetid = p.subsetid WHERE s.classid = '$cls'")->result();
		
		foreach($subj as $s){
			$subjN.=$s->sub_name.',';
			$subjD.=$s->subjid.',';
		}
		
		$subjName=chop($subjN,',');
		$subjId=chop($subjD,',');

		echo $subjName.'+'.$subjId;

	}
}

// getting all section by class name change in seat planing report
public function classChng(){
	$clsd=$_POST['clsid'];
	$rd=$_POST['rd'];

	$clsec=$this->db->select("group_concat(DISTINCT section_name ORDER BY section_name ASC SEPARATOR ',') AS section")->from("section_tbl")->where("classid",$clsd)->get()->row();
	echo $clsec->section."+".$rd;
}

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
	
	// get onchange class section
	public function changeClassSection( ){
		if(isset($_POST['clsid'])){
			$cls=$_POST['clsid'];

			$section = $this->db->select("group_concat(DISTINCT section_name ORDER BY section_name ASC SEPARATOR ',') AS section,group_concat(DISTINCT sectionid ORDER BY section_name ASC SEPARATOR ',') AS sectionid")->from("section_tbl")->where("classid",$cls)->get()->row();
			echo $section->section.'+'.$section->sectionid;
			// echo $this->db->last_query();
		}
	}
	

public function xmDateSearch(){
	extract($_POST);

	$dd=explode("+", $d);
	$xmDate=0;

	$data=array(
		"othexmid"=>$dd[0],
		"classid"=>$dd[1],
		"section"=>$dd[2],
		"shift"=>$dd[3],
		"subjid"=>$dd[4]
		);

	$xmS=$this->db->select("exm_date")->distinct()->from("exm_markother")->where($data)->order_by("id","desc")->limit(15)->get()->result();


	foreach($xmS as $name){
		$xmDate.=",".$name->exm_date;
	}

	echo $xmDate;

}


// duplicate grade check
public function chkgd(){
	$gdVal=$_POST['d'];
	$chk=$this->db->select("*")->from("exm_grade")->where("grade_N",$gdVal)->get()->result();
	echo count($chk);
}

// duplicate point check
public function chkpt(){
	$ptVal=$_POST['d'];
	$chk=$this->db->select("*")->from("exm_grade")->where("grade_point",$ptVal)->get()->result();
	echo count($chk);
}

// duplicate mark rang check
public function chkrg(){
	$ptVal=$_POST['d'];
	$chk=$this->db->select("*")->from("exm_grade")->where("grade_point",$ptVal)->get()->result();
	echo count($chk);
}

//  subject total mark check
public function subjectTmark(){
	extract($_POST);

	// array data
	$data=array(
		"classid"=>$c,
		"subjid"=>$s
		);

	$valid=$this->db->select("*")->from("pass_markctg")->where($data)->get()->num_rows();

	if($valid<=0){

	$rst=$this->db->select("*")->from("subject_class")->where($data)->get()->row();

	// result create
	$rsl=$rst->stherory_mk."+".$rst->sobj_mk."+".$rst->sprack_mk."+".$rst->exm_mark;
	echo $rsl;
}else{
	echo "fail";
}
}

// this is for exam name duplicate data check
public function duplicate(){
	extract($_POST);

	// query
	$dpl=$this->db->select("*")->from("exm_namectg")->where("exm_name",$val,'both')->get()->num_rows();
	// return query total value
	echo $dpl;

}

// duplicate subject select
public function duplicateSub(){
	extract($_POST);
	$dexp=explode("+",$sb);

	$data=array(
		"exm_ctgid"=>$dexp[0],
		"classid"=>$dexp[1],
		"shiftid"=>$dexp[2],
		"section"=>$dexp[3],
		"subjid"=>$dexp[4]
		);

// duplicate data
	$dpl=$this->db->select("*")->from("exm_pdistribute")->where($data)->get()->row();

// return data to requested page
	if(count($dpl)>0){
		// search teacher name
	$tName=$this->db->select("*")->from("empee")->where("empid",$dpl->techID)->get()->row();
	// data send
		$rdata=$dpl->tpaper.'+'.$dpl->retdate.'+'.$tName->name.'+'.count($dpl);	
	}else{$rdata="em".'+'."pt".'+'."y".'+'.'0';}
	
	echo $rdata;
}

// duplicate room check
public function roomDupli(){
	extract($_POST);

	$rmn=$this->db->select("*")->from("room_settup")->where("room_number",$rno)->like("r_name",$rmn,'both')->get()->num_rows();
	echo $rmn;
}

// check duplicate other exam name
public function othrxm(){
	extract($_POST);
	$e=strtolower($d);

	$oth=$this->db->select("*")->from("exm_othercatg")->where(strtolower("exm_name"),$e)->get()->num_rows();
	echo $oth;
}

// check duplicate exam
public function chkDupXmRtn(){
	extract($_POST);
	$dup=explode("+", $da);
	// check with exam date
	$data=array(
		"exm_ctgid"=>$dup[0],
		"exm_date"=>$dup[1],
		"classid"=>$dup[2],
		"subject"=>$dup[3]
		);

$chk=$this->db->select("*")->from("exm_routine")->where($data)->get()->num_rows();
	// check without exam date
	$data=array(
		"exm_ctgid"=>$dup[0],
		"classid"=>$dup[2],
		"subject"=>$dup[3]
		);

	$chk=$this->db->select("*")->from("exm_routine")->where($data)->get()->num_rows();
	echo $chk;
}

public function totalStd(){
	extract($_POST);

	// data array
	$data=array(
		"shiftid"=>$s,
		"classid"=>$c,
		"section"=>$sc
		);

	$tStd=$this->db->select("*")->from("re_admission")->where($data)->get()->num_rows();
	echo $tStd;
}

public function seatChk(){
	extract($_POST);
// split this data
	$d=explode("+", $dA);

	// make data array
	$data=array(
		"exm_ctgid"=>$d[0],
		"classN"=>$d[1],
		"shiftid"=>$d[2],
		"section"=>$d[3],
		"room"=>$d[4]
		);
	// check if this data exits in table
	$ext=$this->db->select("*")->from("exm_seatplain")->where($data)->get()->num_rows();
	// send this value tho calling function
	echo $ext;
}

public function seatChkRl(){
	extract($_POST);
// split this data
	$d=explode("+", $dA);
	// initialize
	$ext=0;

	// make data array
	$data=array(
		"exm_ctgid"=>$d[0],
		"classN"=>$d[1],
		"shiftid"=>$d[2],
		"section"=>$d[3],
		"roll_no"=>$d[4]
		);
	// data array two for query two
	$data2=array(
		"exm_ctgid"=>$d[0],
		"classN"=>$d[1],
		"shiftid"=>$d[2],
		"section"=>$d[3]
		);
	// check if this data exits in table
	$ext=$this->db->select("*")->from("exm_seatplain")->where($data)->get()->num_rows();
	// check if data found
	if($ext):
		echo $ext;	// if found return
	else:	// otherwise check another
		// explode roll
		$rollExp=explode("-",$d[4]);
		// query all data by data2 arrat
		$allD=$this->db->select("*")->from("exm_seatplain")->where($data2)->get()->result();
		// foreach
		foreach($allD as $ad):
			$getRlExp=explode("-",$ad->roll_no);
			if(($rollExp[0]>=$getRlExp[0])&&($rollExp[0]<=$getRlExp[1])):
				$ext++;
			endif;
		endforeach;
		echo $ext;
	endif;
}

public function getXmDate(){
	extract($_POST);

	$xmDate=$this->db->select("*")->from("exm_routine")->where("exm_ctgid",$d)->group_by("exm_date")->get()->result();
	// make this data to string
$dataString='';
foreach($xmDate as $xd):
	$dataString.=$xd->exm_date.",";
endforeach;

echo substr($dataString,0,-1);
}

// get room list for seat plan print
public function getRmLst(){
	extract($_POST);

	$data=explode("+",$d);

	$dataArray=array(
		"exm_ctgid"=>$data[0],
		"shiftid"=>$data[1],
		"classN"=>$data[2],
		"section"=>$data[3]
		);
// initialize data
	$roomId='';
	$roomName='';
	$returnData='';
	$room_Number='';
// query for get data
	$gd=$this->db->select("*")->from("exm_seatplain")->where($dataArray)->get()->result();

	foreach($gd as $g):
		$roomId.=$g->room.",";
		// get room name
		$rm=$this->db->select("room_number,r_name")->from("room_settup")->where("roomid",$g->room)->get()->row();
		$room_Number.=$rm->room_number.",";
		$roomName.=$rm->r_name.",";
	endforeach;

	echo $returnData=$roomId."+".$room_Number."+".$roomName;

}

// check duplicate room
public function duplicateRoom(){
	extract($_POST);

	$dupRm = $this->db->select("*")->from("room_settup")->where("room_number",$rn)->where("r_name",$rm)->get()->num_rows();
	// return data value
	echo $dupRm;
}

}