<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		 /*$stid=$this->session->userdata('userid');
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
		}*/
	}
	public function index()
	{		
		$this->load->view('login_portal/header');
		$this->load->view('login_portal/leftbar');
		$this->load->view('login_portal/content');
		$this->load->view('login_portal/footer');
	}
}