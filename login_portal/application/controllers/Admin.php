<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$typeckd=$this->session->userdata('ltype');
		$id=$this->session->userdata('lidcheck');
		$sId=$this->session->userdata('sId');
		if($typeckd=='' || $id=='' || $sId=='') { redirect('login','location'); }	
		$this->load->model('student_parents','stu_parensts');
	}
		
	public function index()
	{

		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('content');
		$this->load->view('footer');
	}
	
	
	public function changePass(){
	$this->load->view('header');
	$this->load->view('leftbar');
	$this->load->view('password');
	$this->load->view('footer');
	}
	
	public function newPassChng(){
	extract($_POST);
	$aff_row = 0;
	$tid = $this->session->userdata("lidcheck");
	$eid = $this->session->userdata("ltype");
	if($eid==1){$talbeck='fstu_login'; $idck='stu_id';}
	if($eid==2){$talbeck='father_login';$idck='parentid';}
	if($eid==3){$talbeck='emp_login';$idck='empid';}	
	// check old password
	$old = $this->db->select("*")->from($talbeck)->where($idck,$tid)->limit(1)->get()->row();

	if($old->pass == $opass){
		$data = array(
				"pass" =>$cpass
			);
		$where=array($idck=>$tid);

		$up = $this->stu_parensts->all_update($where,$talbeck,$data);

		if($up){

			$aff_row++;

			$aff=array("aff"=>$aff_row);
			$this->session->set_userdata($aff);

			redirect('admin/changePass','location');
		}
	}
	
	else{
		redirect('admin/changePass?error=1','refresh');
	}
	
	}
	
	
	
	
}