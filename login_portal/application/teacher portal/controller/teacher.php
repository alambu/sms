<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teacher extends CI_Controller {

	public function classRoutine(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/classRoutine');
		$this->load->view('footer');
	}

	public function studentAttend(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/studentAttend');
		$this->load->view('footer');
	}

	public function attendanceSubmit(){
		extract($_POST);
		// initialization
		$tid = $this->session->userdata("lidcheck");
		$d = date("Y-m-d");
		$stdID  = '';
		$rollID = '';
		$aff_row=0;

		for($i = 0;$i < count($attend);$i++):
			$exp = explode("+",$attend[$i]);
			$stdID .= $exp[0].",";
			$rollID .= $exp[1].",";
		endfor;

		$std = substr($stdID,0,-1);
		$rld = substr($rollID,0,-1);

		if(isset($_POST['submit'])):
			// data array
			$data = array(
						"id"      =>'' ,
						"stu_id"  =>$std ,
						"shiftid" =>$shift ,
						"classid" =>$class ,
						"section" =>$section ,
						"roll_no" =>$rld ,
						"date" 	  =>$d ,
						"status"  =>'0' ,
						"e_date"  =>$d ,
						"e_user"  =>$tid ,
						"up_date" =>'' ,
						"up_user" =>'' 
					);
			// insert data base
			$insup = $this->db->insert("attendance",$data);
		elseif(isset($_POST['update'])):
			// data array
			$data = array(
						"stu_id"  =>$std ,
						"shiftid" =>$shift ,
						"classid" =>$class ,
						"section" =>$section ,
						"roll_no" =>$rld ,
						"date" 	  =>$d ,
						"status"  =>'0'
					);

			// update data
			$insup = $this->db->where("id",$attRow)->update("attendance",$data);
		endif;

		if($this->db->affected_rows()){
				$aff_row++;
			}
		$aff=array("aff"=>$aff_row);

		$this->session->set_userdata($aff);

		// if success
		if($insup):
			$url = 'teacher/studentAttend/'.$shift;
			redirect($url,'refresh');
		endif;
	}

	public function markEntry(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/studentMarkEntry');
		$this->load->view('footer');
	}

	public function markClassSection(){
		extract($_POST);
		$da = explode("+",$search);

		// data array
		$dArray = array(
					"shiftid"   => $da[0],
					"classid"   => $da[1],
					"teacherid" => $da[2],
					"year" 		=> $da[3]
					);

		// get section of this teacher 
		$tSection = $this->db->select("*")->from("routine")->where($dArray)->group_by("classid")->get()->result();
		$section = '';
		foreach($tSection as $ts):
			$section .= $ts->section.",";
		endforeach;

		// return data
		// echo rtrim($section,",");
		if(rtrim($section,",") != ''):
			echo rtrim($section,",");
		endif;
	}

	public function getTeacherSubject(){
		extract($_POST);

		$dataArray = explode("+",$dd);

		// data array
		$data = array(
				"shiftid" 	=> $dataArray[0],
				"classid" 	=> $dataArray[1],
				"section" 	=> $dataArray[2],
				"teacherid" => $dataArray[3],
				"year" 		=> $dataArray[4]
			);

		// search subject in database
		$subject = $this->db->select("*")->from("routine")->where($data)->group_by("subjid")->get()->result();

		$subjid = '';
		$subName = '';

		foreach($subject as $sub):
			$subjid .= $sub->subjid.',';
			// get subject name
			$subnm = $this->db->select("sub_name")->from("subject_class")->where("subjid",$sub->subjid)->get()->row();
			$subName .= $subnm->sub_name.',';
		endforeach;
	
		echo rtrim($subjid,",")."+".rtrim($subName,",");
	}

	public function stdListMark(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/markEntryStdLst');
		$this->load->view('footer');
	}


// single student entry function
	public function singleStdEntry(){
		$d = $_POST['d'];
		
		$stdData = explode("+", $d);

			$edate = date("Y-m-d H:m:s");
			$eyear = date("Y");
			$euser = $this->session->userdata("lidcheck");

			// affected row initialize
				$aff_row = 0;

				$data = array(
						"id"		 	 => '',
						"stu_id"		 => $stdData[0],
						"exmid"			 => $stdData[1],
						"classid"		 => $stdData[2],
						"section"		 => $stdData[3],
						"shift"			 => $stdData[4],
						"roll_no"		 => $stdData[5],
						"subjid"		 => $stdData[6],
						"theory_mark"    => $stdData[7],
						"obj_mark"	     => $stdData[8],
						"practical_mark" => $stdData[9],
						"sba_mark"		 => $stdData[10],
						"total_mark"	 => $stdData[11],
						"exmyear"		 => $eyear,
						"e_date"		 => $edate,
						"e_user"		 => $euser,
						"up_date"		 => '',
						"up_user"		 => ''
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

	public function teacherAttendance(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/teacherAttendance');
		$this->load->view('footer');
	}

	public function salaryState(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/salaryStatement');
		$this->load->view('footer');
	}

	public function studentInformation(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/studentInformation');
		$this->load->view('footer');
	}

	public function leaveRequest(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('teacher/leaveRequest');
		$this->load->view('footer');
	}


	// leave request submit

	public function employee_rqst_leave_form(){
	 
		 if(isset($_POST['submit'])){	 
		 extract($_POST);
		 
		 $entry_date = date('Y-m-d');
		 $entry_user = $this->session->userdata('lidcheck');
		 
		 $sdate=date("Y-m-d",strtotime($request_start_date));
		 $edate=date("Y-m-d",strtotime($request_end_date));
		 $aff_row=0;
		 
		 $data=array(
		    'reqid'		  => '',
			'empid'		  => $employee_name,
			'levid'		  => $leave_catagory,
			'sdate'		  => $sdate,
			'edate'		  => $edate,
			'comment'	  => $request_comment,
			'show_status' => '0',
			'e_date'	  => $entry_date,
			'e_user'	  => $entry_user,
			'up_date'	  => '',
			'up_user'	  => ''
		   );

		$this->db->insert('emp_reqlev',$data);
			 
		if($this->db->affected_rows()>0) {
		      $aff_row++;
		}

		$aff=array("aff"=>$aff_row);
		$this->session->set_userdata($aff);

		redirect("teacher/leaveRequest","location");


			 
		}
	 
}

}