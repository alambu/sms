<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class allSubmit extends CI_Controller {
	
// constructor function

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
		}
		else{
			redirect('login?error=2','location');
		}
	}

// constructor function

// exam name adding function
	public function exm_name(){

		if(isset($_POST['okxm'])){
		$exam=$_POST['exam_name'];

		// affected row initialize
			$aff_row=0;

		// db secure connection establish
		$this->db->trans_start();

		$edate=date("Y-m-d H:m:s");
		$euser=$this->session->userdata('userid');

			// insert data array
			$data=array(
				"exmnid"=>'',
				"exm_name"=>$exam,
				"status"=>1,
				"e_date"=>$edate,
				"e_user"=>$euser,
				"up_date"=>'',
				"up_user"=>''
				);

		// insert data
			$this->db->insert("exm_namectg",$data);

			if($this->db->affected_rows()){
				$aff_row++;
			}

		// db secure connection close
		$this->db->trans_complete();

		$aff=array("aff"=>$aff_row);

		$this->session->set_userdata($aff);
		redirect("exam/general","location");
		}
	}

// end exam name adding function

// exam category function
	public function exm_cat(){
		if(isset($_POST['ok'])){
			extract($_POST);
			$y=date("Y");
			$id=$this->session->userdata('userid');
			// affected row initialize
			$aff_row=0;

			$data=array(
				"exm_ctgid"=>'',
				"exmnid"=>$exam_name,
				"exmdate"=>$exam_date,
				"comment"=>$comment,
				"year"=>$y,
				"status"=>1,
				"e_user"=>$id,
				"up_date"=>'',
				"up_user"=>''
				);

// notice make
			$xmNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$exam_name)->get()->row();
			$title=$xmNm->exm_name." will be start on ".$exam_date;
			$body=$title." ".$comment;
			$d=date("Y-m-d");
			// notice array
			$ntArray=array(
				"id"=>'',
				"title"=>$title,
				"pdf_details"=>$body,
				"notice_date"=>$d,
				"entry_user"=>$id
				);
			// entry
			$this->db->insert("notice",$ntArray);
// notice make end

			$this->db->trans_start();
				$this->db->insert("exm_catg",$data);

				if($this->db->affected_rows()){
					$aff_row++;
				}
			
			$this->db->trans_complete();

				$aff=array("aff"=>$aff_row);
				$this->session->set_userdata($aff);
			
				redirect("exam/xmController","location");

		}
	}

	// duplicate exam scheduling check
	public function duplicateScheduling(){
		extract($_POST);

		$w = array(
				"exmnid" => $xid,
				"status" => 0
			);

		$this->db->select("*")->from("exm_catg")->where($w);
		$count = $this->db->count_all_results();

		// echo $this->db->last_query();
		echo $count;

	}

// end exam category function


// exam routine 

	public function xmRoutine(){
		if(isset($_POST['ok'])){
			extract($_POST);
			$edate=date("Y-d-m H:m:s");
			$eid=$this->session->userdata('userid');
			$aff_row=0;

			for($i=0;$i<count($exm_id);$i++){
				$data=array(
					"id"=>'',
					"exm_ctgid"=>$exm_id[$i],
					"max_exm"=>$max_exm[$i],
					"e_date"=>$edate,
					"e_user"=>$eid,
					"up_date"=>'',
					"up_user"=>''
					);

				$this->db->trans_start();
				
					$this->db->insert("exm_routine_sett",$data);
					
					if($this->db->affected_rows()){
						$aff_row++;
					}
				
				$this->db->trans_complete();

				$aff=array("aff"=>$aff_row);
				$this->session->set_userdata($aff);
			
				redirect("exam/exm_routine","location");
			}

		}
	}
// exam routine 

// seat plan settings
	public function seatPlanSet(){
		if(isset($_POST['ok'])){
			extract($_POST);
			$edate=date("Y-m-d H:m:s");
			$aff_row=0;
			$eid=$this->session->userdata("userid");

			$r=$froll.'-'.$eroll;
			// teacher
			// $tch=implode(",", $storage);
			

				$data=array(
					"id"=>'',
					"exm_ctgid"=>$exam_name,
					"classN"=>$cls_name,
					"shiftid"=>$sht,
					"section"=>$section,
					"roll_no"=>$r,
					"room"=>$room,
					"e_date"=>$edate,
					"e_user"=>$eid,
					"up_date"=>'',
					"up_user"=>''
					);
				// insert query
				$this->db->trans_start();
					$this->db->insert("exm_seatplain",$data);
					if($this->db->affected_rows()){
						$aff_row++;
					}
				$this->db->trans_complete();
		

			$aff=array("aff"=>$aff_row);
			$this->session->set_userdata($aff);
			
			redirect("exam/XmSeat","location");
		}
	}
// seat plan settings


// grading system development
	public function gradeSetting(){
		if(isset($_POST['gd'])){
			extract($_POST);
			$edate=date("Y-m-d H:m:s");
			$aff_row=0;
			$eid=$this->session->userdata("userid");

// php validation
			if((!empty($gradeSet))&&(!empty($pointSet))&&(!empty($smark))&&(!empty($emark))){
				$data=array(
					"gradid"=>'',
					"grade_N"=>$gradeSet,
					"grade_point"=>$pointSet,
					"mark_from"=>$smark,
					"mark_upto"=>$emark,
					"comment"=>$comment,
					"e_date"=>$edate,
					"e_user"=>$eid,
					"up_date"=>'',
					"up_user"=>''
					);
				$this->db->trans_start();
					$this->db->insert("exm_grade",$data);
					if($this->db->affected_rows()){
						$aff_row++;
					}
				$this->db->trans_complete();


			$aff=array("aff"=>$aff_row);
			$this->session->set_userdata($aff);
			}
			redirect("exam/general","location");

		}
	}
// end grading system development

	// paper distribute 
		public function paperDistribute(){
			if(isset($_POST['ok'])){
				extract($_POST);
				$edate=date("Y-m-d H:m:s");
				$aff_row=0;
				$eid=$this->session->userdata("userid");

				for($i=0;$i<count($exam_name);$i++){
					$data=array(
						"pdisid"=>'',
						"subjid"=>$subjpaper[$i],
						"exm_ctgid"=>$exam_name[$i],
						"classid"=>$cls_name[$i],
						"shiftid"=>$sftid[$i],
						"section"=>$section[$i],
						"tpaper"=>$tpaper[$i],
						"disdate"=>$edate,
						"retdate"=>$return_date[$i],
						"techID"=>$teacher[$i],
						"e_date"=>$edate,
						"e_user"=>$eid,
						"up_date"=>'',
						"up_user"=>''
						);

// if exits
	$exts=array(
		"subjid"=>$subjpaper[$i],
		"exm_ctgid"=>$exam_name[$i],
		"classid"=>$cls_name[$i],
		"shiftid"=>$sftid[$i],
		"section"=>$section[$i]
		);

	$dNum=$this->db->select("*")->from("exm_pdistribute")->where($exts)->get()->num_rows();
	if($dNum<=0):

					// data insert
						$this->db->trans_start();
							$this->db->insert("exm_pdistribute",$data);

							// insert logic test
							if($this->db->affected_rows()){
								$aff_row++;
							}

						$this->db->trans_complete();
					// data insert
	endif;
				}

				$aff=array("aff"=>$aff_row);
				$this->session->set_userdata($aff);
				
				$this->load->view('header');
				$this->load->view('leftbar');
				$this->load->view("exam/distId",$_POST['ok']);
				$this->load->view('footer');
				// redirect("exam/paper_dist","location");
			}
		}
	// paper distribute 

		// paper received
			public function paperReceived(){
				if(isset($_POST['ok'])){
					extract($_POST);


					$edate=date("Y-m-d H:m:s");
					$aff_row=0;
					$eid=$this->session->userdata("userid");

					$data=array(
						"id"=>'',
						"pdisid"=>$distId,
						"tpaper"=>$tt,
						"subdate"=>$edate,
						"comment"=>$comment,
						"e_date"=>$edate,
						"e_user"=>$eid,
						"up_date"=>'',
						"up_user"=>''
						);

					// data insert
					$this->db->trans_start();
						$this->db->insert("exm_preceive",$data);
						if($this->db->affected_rows()){
							$aff_row++;
						}
					$this->db->trans_complete();

					$aff=array("aff"=>$aff_row);
					
					$this->session->set_userdata($aff);
				
					redirect("exam/paperProcessing","location");

				}
			}
		// papaer received


// other exam entry
public function otherXmEntry(){
	if(isset($_POST['ok'])){
		extract($_POST);

		$edate=date("Y-m-d H:m:s");
		$euser=$this->session->userdata('userid');

// affected row initialize
	$aff_row=0;

$d = date("Y");
	// insert data array
	$data=array(
		"othexmid"	=> '',
		"exm_name"	=> $othName,
		"xm_year" 	=> $d,
		"e_date"	=> $edate,
		"e_user"	=> $euser,
		"up_date"	=> '',
		"up_user"	=> ''
		);

	$this->db->trans_start();
		// insert data
			$this->db->insert("exm_othercatg",$data);

			if($this->db->affected_rows()){
				$aff_row++;
			}


// print_r($data);
// echo $this->db->last_query();exit;

// db secure connection close
	$this->db->trans_complete();

		$aff=array("aff"=>$aff_row);

		$this->session->set_userdata($aff);

		redirect("exam/general","location");

		}
	}
// other exam entry

// pass mark settup
	public function passMarkSett(){
		if(isset($_POST['ok'])){
			extract($_POST);

				$edate=date("Y-m-d H:m:s");
				$euser=$this->session->userdata('userid');

				// affected row initialize
					$aff_row=0;

			// looping for data insert
					for($i=0;$i<count($sub_name);$i++){

			// data test
						if( ( ( $sub_name[$i] != '' ) && ( $theory[$i] != '' ) && ( $obj[$i] != '' ) && ( $practical[$i] != '' ) && ( $total[$i] == '' ) ) || ( ( $sub_name[$i] != '' ) && ( $theory[$i] == '' ) && ( $obj[$i] == '' ) && ( $practical[$i] == '' ) && ( $total[$i] != '' ) ) ):

					// data array create
					$data=array(
						"passid"=>'',
						"classid"=>$clsid,
						"subjid"=>$sub_name[$i],
						"theory"=>$theory[$i],
						"obj"=>$obj[$i],
						"diff_pass"=>$practical[$i],
						"t_mark"=>$total[$i],
						"e_date"=>$edate,
						"e_user"=>$euser,
						"up_date"=>'',
						"up_user"=>''
						);

			$this->db->trans_start();
				$this->db->insert("pass_markctg",$data);

				if($this->db->affected_rows()){
					$aff_row++;
				}

			$this->db->trans_complete();
				
				endif;
}
			$aff=array("aff"=>$aff_row);

			$this->session->set_userdata($aff);
			$url="exam/general?cl=".base64_encode($clsid);

			redirect($url,"location");
		}
	}
// pass mark settup

// single student entry function
	public function singleStdEntry(){
		$d=$_POST['d'];
		
		$stdData=explode("+", $d);

			$edate=date("Y-m-d H:m:s");
			$eyear=date("Y");
			$euser=$this->session->userdata('userid');

			// affected row initialize
				$aff_row=0;

				$data=array(
					"id"=>'',
					"stu_id"=>$stdData[0],
					"exmid"=>$stdData[1],
					"classid"=>$stdData[2],
					"section"=>$stdData[3],
					"shift"=>$stdData[4],
					"roll_no"=>$stdData[5],
					"subjid"=>$stdData[6],
					"theory_mark"=>$stdData[7],
					"obj_mark"=>$stdData[8],
					"practical_mark"=>$stdData[9],
					"other_mark"=>$stdData[10],
					"total_mark"=>$stdData[11],
					"exmyear"=>$eyear,
					"e_date"=>$edate,
					"e_user"=>$euser,
					"up_date"=>'',
					"up_user"=>''
					);

				$this->db->trans_start();
				$this->db->insert("mark_add",$data);

				if($this->db->affected_rows()){
					$aff_row++;
				}

			$this->db->trans_complete();
echo $aff_row;
			// $aff=array("aff"=>$aff_row);

			// $this->session->set_userdata($aff);
			// $url="exam/passing_mark_set?cl=".base64_encode($clsid);

			// redirect("exam/stdListMarkEntry","location");

	}
// single student entry function

// other exam mark entry each student
	public function oThXmMkEnt(){
		extract($_POST);

		$data=explode("+", $d);

$eDate=date("Y-m-d H:i:s");
$eID=$this->session->userdata('userid');
// data array
		$dataArray=array(
			"id"=>'',
			"stu_id"=>$data[0],
			"othexmid"=>$data[1],
			"classid"=>$data[2],
			"section"=>$data[3],
			"shift"=>$data[4],
			"roll_no"=>$data[5],
			"subjid"=>$data[6],
			"exm_mark"=>$data[7],
			"mark"=>$data[8],
			"exm_date"=>$data[9],
			"e_date"=>$eDate,
			"e_user"=>$eID,
			"up_date"=>'',
			"up_user"=>''
			);

		// data inserting
		$this->db->trans_start();
			$ins=$this->db->insert("exm_markother",$dataArray);
			$a=$this->db->affected_rows();
		$this->db->trans_complete();

		if($a>=1){
			echo "suc";
		}else{
			echo "fa";
		}

	}
// other exam mark entry each student

// exam routine setting
public function routine(){

	extract($_POST);

	$edate=date("Y-m-d H:i:s");
	$eUser=$this->session->userdata('userid');
	$aff_row=0;

//  morning exam entry
if((count($Mcls)>0)&&($Mcls!='')){
	for($i=0;$i<count($Mcls);$i++){

	$data=array(
		"id"=>'',
		"exm_ctgid"=>$exmid,
		"classid"=>$Mcls[$i],
		"exm_date"=>$eDate,
		"stime"=>$MsTi,
		"etime"=>$MeTi,
		"subject"=>$mSub[$i],
		"e_date"=>$edate,
		"e_user"=>$eUser,
		"up_date"=>'',
		"up_user"=>''
		);

	$this->db->trans_start();
		$mEntry=$this->db->insert("exm_routine",$data);

		if($this->db->affected_rows()){
					$aff_row++;
				}
	
	$this->db->trans_complete();
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
}
}

// evening exam entry
if((count($Ecls)>0)&&($Ecls!='')){
for($i=0;$i<count($Ecls);$i++){

	$data=array(
		"id"=>'',
		"exm_ctgid"=>$exmid,
		"classid"=>$Ecls[$i],
		"exm_date"=>$eDate,
		"stime"=>$EsTi,
		"etime"=>$EeTi,
		"subject"=>$Esub[$i],
		"e_date"=>$edate,
		"e_user"=>$eUser,
		"up_date"=>'',
		"up_user"=>''
		);

	$this->db->trans_start();
	$mEntry=$this->db->insert("exm_routine",$data);
	
		if($this->db->affected_rows()){
					$aff_row++;
				}
	
	$this->db->trans_complete();
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);

}
}
// end routine entry
$url="exam/xmRoutine?xm=".$exmid;
	redirect($url,"location");

}
// exam routine setting

// room setup
	public function roomSetup(){
		extract($_POST);

		$eu=$this->session->userdata('userid');
		$ed=date("Y-m-d H:i:s");
		$aff_row=0;

for($i=0;$i<count($roomid);$i++){

		// data array
		$data=array(
			"roomid"=>'',
			"room_number"=>$roomid[$i],
			"r_name"=>$rname[$i],
			"e_user"=>$eu,
			"e_date"=>$ed,
			"up_user"=>'',
			"up_date"=>''
			);
	// insert data
		$this->db->trans_start();
			$this->db->insert("room_settup",$data);

			if($this->db->affected_rows()){
				$aff_row++;
			}

		$this->db->trans_complete();


}

	$aff=array("aff"=>$aff_row);
	$this->session->set_userdata($aff);

	redirect("exam/general","location");

	}
// room setup


//  all mark entry submit
public function mkAlSb(){
		extract($_POST);

//  primary initialize
		$eyear=date("Y");
		$edate=date("Y-m-d");
		$euser=$this->session->userdata('userid');
// affected row initialize
		$aff_row=0;

//  insert query by looping
		for($i=0;$i<count($total);$i++){
			if( ($total[$i] > 0 ) || ( $theory[$i] > 0 ) || ( $obj[$i] > 0 ) || ( $practical[$i] > 0 ) ):
				$data=array(
					"id"=>'',
					"stu_id"=>$stdid[$i],
					"exmid"=>$exam,
					"classid"=>$clas,
					"section"=>$section,
					"shift"=>$shift[$i],
					"roll_no"=>$roll[$i],
					"subjid"=>$subid,
					"theory_mark"=>$theory[$i],
					"obj_mark"=>$obj[$i],
					"practical_mark"=>$practical[$i],
					"other_mark" => $otherMk[$i],
					"total_mark"=>$total[$i],
					"exmyear"=>$eyear,
					"e_date"=>$edate,
					"e_user"=>$euser,
					"up_date"=>'',
					"up_user"=>''
					);


				$this->db->trans_start();
				$this->db->insert("mark_add",$data);

				if($this->db->affected_rows()){
					$aff_row++;
				}

				$this->db->trans_complete();
			endif;
} // end looping query

	$aff=array("aff"=>$aff_row);
	$this->session->set_userdata($aff);

	$aa = $exam."/".$clas."/".$section."/".$subid."/".$shift[0];

	$url="exam/stdListMarkEntry/".$aa;
	redirect($url,"location");
	
	}
//  all mark entry submit

public function othXmMk(){
	extract($_POST);
	$aff_row=0;
	$test=0;

	$eDate=date("Y-m-d H:i:s");
	$eID=$this->session->userdata('userid');
// data array
	for($i=0;$i<count($roll);$i++){
		if($mark[$i]){
			$test++;
		
		$dataArray=array(
			"id"=>'',
			"stu_id"=>$stdid[$i],
			"othexmid"=>$exam,
			"classid"=>$class,
			"section"=>$section,
			"shift"=>$shift,
			"roll_no"=>$roll[$i],
			"subjid"=>$subid,
			"exm_mark"=>$emark,
			"mark"=>$mark[$i],
			"exm_date"=>$edate,
			"e_date"=>$eDate,
			"e_user"=>$eID,
			"up_date"=>'',
			"up_user"=>''
			);

		// data inserting
		$this->db->trans_start();
			 $ins=$this->db->insert("exm_markother",$dataArray);
			 if($this->db->affected_rows()){
				 $aff_row++;
			 }
		$this->db->trans_complete();
	}	// end for loop
}
	$aff=array("aff"=>$aff_row);
	$this->session->set_userdata($aff);

// make varriable for previous page
	$dataPre=base64_encode($exam)."/".base64_encode($class)."/".base64_encode($section)."/".base64_encode($shift)."/".base64_encode($emark)."/".base64_encode($edate)."/".base64_encode($subid);

	// if remain some entry
	if($test<$idvar):
		$url="exam/otherXmStd?pre=".$dataPre;
		redirect($url,"location");
	else:	redirect("exam/result","location");
	endif;
}

public function meritSub(){
	if(isset($_POST['publish'])):
		extract($_POST);
	// initialize data
	$aff_row=0;
	$ed=date("Y-m-d");
	$eu=$this->session->userdata('userid');
	
// looping data entry
	for($i=0;$i<count($xmid);$i++):
	// data array
		$data=array(
			"id"=>'',
			"exmid"=>$xmid[$i],
			"class"=>$clsid[$i],
			"shift"=>$shft[$i],
			"section"=>$secId,
			"stu_id"=>$stuid[$i],
			"pre_roll"=>$pre_roll[$i],
			"present_roll"=>$presentRoll[$i],
			"total_mark"=>$total_mark[$i],
			"exm_year"=>$xmy[$i],
			"edate"=>$ed,
			"euser"=>$eu,
			"up_date"=>'',
			"up_user"=>''
			);

	// if this data already inserted
	$ext=$this->db->select("*")->from("meritlist")->where($data)->get()->num_rows();
	if(!$ext):
		// insert into merit table
		$ins=$this->db->insert("meritlist",$data);
		if($this->db->affected_rows()):
				 $aff_row++;
		endif;
	endif;
	

	endfor;
	// set session data
	$aff=array("aff"=>$aff_row);
	$this->session->set_userdata($aff);
	// set notice publish
	$xmNm=$this->db->select("*")->from("exm_namectg")->where("exmnid",$xmid[0])->get()->row();
	$cl=$this->db->select("*")->from("class_catg")->where("classid",$clsid[0])->get()->row();
	$title=$xmNm->exm_name." - ".$xmy[0]." of class ".$cl->class_name." of section ".$secId." Result publish";
	$noticeData=array(
		"id"=>'',
		"title"=>$title,
		"pdf_details"=>'',
		"notice_date"=>$ed,
		"entry_user"=>$eu
		);
	// insert notice
	$ntc=$this->db->insert("notice",$noticeData);
	// redirect to destination
	redirect("xmReport/meritListPanel","location");

endif;
}


// teacher schedule setting
public function tSchedul(){
	extract($_POST);
	// initialize
		$ed=date("Y-m-d");
		$eu=$this->session->userdata('userid');
		$aff_row=0;
// loop for each morning room data
	for($i=0;$i<count($mteach);$i++):
		// test if empty value come
		if($mteach[$i]!=''):
		// remove first bracket from input string
			// if morning data not empty
			if($mteach[$i]!=''):
				$mt=explode("(", $mteach[$i]); //morning teacher
				$fmt=''; // morning teacher initialize
			endif;
			
		// remove last bracket from morning string
			for($j=1;$j<count($mt);$j++):
				// if morning data not empty
				if($mteach[$i]!=''):
					$mmt=explode(")", $mt[$j]);
					$fmt.=$mmt[0].",";
				endif;
			endfor;
			// remove last comma
			$fmt=substr($fmt, 0,-1);
	//morning data 
			$mData=array(
				"id"=>'',
				"exm_ctgid"=>$exmid,
				"exm_date"=>$exmDate,
				"exm_time"=>'10:00',
				"room"=>$room[$i],
				"teachID"=>$fmt,
				"edate"=>$ed,
				"euser"=>$eu,
				"up_date"=>'',
				"up_user"=>''
				);
			// morning insert
			$mins=$this->db->insert("exm_teacher_schedul",$mData);

			if($this->db->affected_rows()):
				 $aff_row++;
			endif;
		endif;
	endfor;
// loop for each evening room data
	for($i=0;$i<count($eteach);$i++):
		// test if empty value come
		if($eteach[$i]!=''):
		// remove first bracket from input string
			// if evening data not empty
			if($eteach[$i]!=''):
				$et=explode("(", $eteach[$i]); // evening teacher
				$emt=''; // evening teacher initialize
			endif;
		// remove last bracket from evening string
			for($j=1;$j<count($et);$j++):
				// if evening data not empty
				if($eteach[$i]!=''):
					$eet=explode(")", $et[$j]);
					$emt.=$eet[0].",";
				endif;
			endfor;
			// remove last comma
			$emt=substr($emt, 0,-1);
	// evening data
			$eData=array(
				"id"=>'',
				"exm_ctgid"=>$exmid,
				"exm_date"=>$exmDate,
				"exm_time"=>'14:00',
				"room"=>$room[$i],
				"teachID"=>$emt,
				"edate"=>$ed,
				"euser"=>$eu,
				"up_date"=>'',
				"up_user"=>''
				);
		// evening insert
			$eins=$this->db->insert("exm_teacher_schedul",$eData);

			if($this->db->affected_rows()):
				 $aff_row++;
			endif;
		endif;
	endfor;

	// if success then
	if($aff_row):
		// set session data
	$aff=array("aff"=>$aff_row);
	$this->session->set_userdata($aff);
		redirect("exam/xmController","location");
	endif;
}

}