<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class basic_setting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model("setting/setting_model","bsetting");
		
	}

	public function setting() {
		$this->load->view('header');
		$this->load->view('leftbar');
		$data=array();
		$y=date("Y");
		$data['vers']=$this->db->select("*")->from("version_catg")->order_by("verid","asc")->get()->result();
		$data['t_vrow']=$this->db->affected_rows();
		$data['sft']=$this->db->select("*")->from("shift_catg")->order_by("shiftid","asc")->get()->result();
		$data['t_srow']=$this->db->affected_rows();
		$data['cls_list']=$this->db->select("*")->from("class_catg")->order_by("classid","asc")->get()->result();
		$data['all_subject']=$this->db->select("*")->from("subject_setup")->order_by("subsetid","desc")->get()->result();
		$data['t_crow']=$this->db->count_all("class_catg");
		
		$data['t_prow']=$this->db->affected_rows();
		
		
		$data['t_aprow']=$this->db->affected_rows();
		
		$data['app_fee_r']=$this->db->query("select a.*,b.class_name from  application_catg a,class_catg b where a.classid=b.classid and a.years='$y' order by appctgid asc")->result();
		$data['app_fee_row']=$this->db->affected_rows();
		
		$data['online_payment']=$this->db->query("select status from  online_status")->row()->status;
		$data['payment_row']=$this->db->affected_rows();
		$data['all_group']=$this->bsetting->all_group();
		
		
		$this->load->view('setting/setting',$data);
		
	}
	//<!---------------student section end---------------------->
	
	
	public function shift_edit() {
		extract($_GET);
		$data=array();
		$data['edit_shift']=$this->bsetting->setting_edit('shift_catg','shiftid',$id);
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('setting/shift_edit',$data);
		$this->load->view('footer');
	}
	
	public function subject_edit() {
		extract($_GET);
		$data=array();
		$data['edit_subject']=$this->bsetting->subject_info('subject_setup','subsetid',$id);
		$data['all_group']=$this->bsetting->all_group();
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('setting/subject_edit',$data);
		$this->load->view('footer');
	}
	
	public function group_edit() {
		extract($_GET);
		$data=array();
		$data['edit_group']=$this->bsetting->setting_edit('group_setup','groupid',$id);
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('setting/group_edit',$data);
		$this->load->view('footer');
	}
	
	public function selected_class()
	{
	
			extract($_POST);
			$array_cls=array();
			$array_id=array();
			$select=$this->db->query("select * from class_catg where shiftid='$sft_id'")->result();
			foreach($select as $v){
				
				array_push($array_cls,$v->class_name);
				array_push($array_id,$v->classid);
				
			}
			$cls=implode($array_cls,",");
			$cid=implode($array_id,",");
			echo $cls."#".$cid;
	}
	
	public function subject_show()
	{
		$data=array();
		extract($_GET);
		$this->load->view("setting/subject_show");
	}
	
	public function show_class()
	{
		$data=array();
		extract($_GET);
		$data['cls']=$this->bsetting->class_info($sft);
		$this->load->view("setting/show_class",$data);
	}
	
	public function class_subject_edit()
	{
		extract($_GET);
		$data=array();
		$data['edit_subject']=$this->bsetting->subject_class_info($id);
		$data['all_group']=$this->bsetting->all_group();
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('setting/class_subject_edit',$data);
		$this->load->view('footer');
	}
	
	public function class_edit()
	{
		extract($_GET);
		$data=array();
		$data['edit_class']=$this->bsetting->edit_class_info($id);
		$data['all_group']=$this->bsetting->all_group();
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('setting/class_edit',$data);
		$this->load->view('footer');
	}
	
	
}

