<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class exam extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
	{
		redirect('login?error=2','location');
	}
		$this->load->model('admin_model','n');
		$this->load->model('marksheet_model','mkst');
	}


	public function general()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/generalSetup');
		$this->load->view('footer');
	}
	
	public function admitCard()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/printcopy/admitCard');
		$this->load->view('footer');
	}
	
	public function cardPrint()
	{
		//$this->load->view('header');
		//$this->load->view('leftbar');
		$this->load->view('exam/printcopy/cardPrint');
		//$this->load->view('footer');
	}

	public function result()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/result');
		$this->load->view('footer');
	}

	public function paperProcessing()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/examPaper');
		$this->load->view('footer');
	}

	public function XmSeat()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/examSeat');
		$this->load->view('footer');
	}

	public function exm_cat()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/exm_cat');
		$this->load->view('footer');
	}

	public function exm_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/exam_routine_sett');
		$this->load->view('footer');
	}

	public function seat_plan()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/seat_planing');
		$this->load->view('footer');
	}

	public function grade_setting()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/grading');
		$this->load->view('footer');
	}

	public function paper_dist()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/paper_distribute');
		$this->load->view('footer');
	}

	public function paper_search()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/paper_receive_search');
		$this->load->view('footer');
	}

	public function paper_receive()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/paper_receive_action');
		$this->load->view('footer');
	}

	public function passing_mark_set()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/passing_mark_set');
		$this->load->view('footer');
	}

	public function mark_entry()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/mark_add');
		$this->load->view('footer');
	}

	public function classSection()
	{

		$cl=$_POST['clsid'];
		
		$sec = $this->db->select("group_concat(DISTINCT section_name ORDER BY section_name ASC SEPARATOR ',') AS section")->from("section_tbl")->where("classid",$cl)->get()->row();

		$sub = $this->db->query("SELECT s.subjid,p.sub_name,p.subsetid FROM subject_class s LEFT JOIN subject_setup p ON s.subsetid = p.subsetid WHERE s.classid = $cl")->result();


		$section = $sec->section;
		$subject='';
		$subid='';

		foreach($sub as $s){
			$subject.=$s->sub_name.',';
			$subid.=$s->subjid.',';
		}

		echo $section."+".$subject."+".$subid;
	}

	public function stdListMarkEntry(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/mark_entry');
		$this->load->view('footer');
	}

	public function other_xm(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/other_xm');
		$this->load->view('footer');
	}

	public function otherXmEnty(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/otherXmEntry');
		$this->load->view('footer');
	}

	public function otherXmStd(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/otherXmStdList');
		$this->load->view('footer');
	}

	public function xmRoutine(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/xmRoutineSetup');
		$this->load->view('footer');
	}

	public function roomSetup(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/roomSet');
		$this->load->view('footer');
	}

	public function xmController(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/xmController');
		$this->load->view('footer');
	}

	public function teacherSchedul(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/teacherSchedul');
		$this->load->view('footer');
	}

	// this is for  testing
	public function testing(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/testing");
		$this->load->view('footer');
	}



public function tiniMc(){
	// print_r($_POST);
	
	extract($_POST);

	$data=array(
		"id"=>'',
		"content"=>$content
		);

	$this->db->insert("tini",$data);
	if($this->db->affected_rows()){
		 redirect("exam/testing","location");
	}
}

// create pdf file
public function pdf(){
	$this->load->view("exam/testPDF");
}

public function autoCompleteTest(){
	$this->load->view("test/demo");
}

public function timepicker(){
	$this->load->view("exam/timepickerExample");
}

}