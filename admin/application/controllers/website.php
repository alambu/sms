<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class website extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');

		if($stid=='' ||  $stsid=='')
		{
		  redirect('login?error=2','location');
		}
		
		$this->load->model('admin_model','n');
		$this->load->model('student','report');
	
		
	}


	// ----------------libray section start-----------------------
	public function teachers()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/teachers');
		$this->load->view('footer');
	}
	
	
	public function stuff_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/stuff_info');
		$this->load->view('footer');
	}
	
	public function parents_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/parents_info');
		$this->load->view('footer');
	}
	
// about section start

	public function about()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_about');
		$this->load->view('footer');
	}

public function updateAboutMsg(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['priImg']['name']):
		// get image name
		$imgNm=$_FILES['priImg']['name'];
		// path
		$path="../admin/img/document/about/";
		// get previous image name
		$preIm=$this->db->select("*")->from("about")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['priImg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("about",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/about","location");
}

// about section end

// admission section start
	public function add_contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_contact_admission');
		$this->load->view('footer');
	}
	
	public function add_admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_admission_info');
		$this->load->view('footer');
	}
	
	public function admissionResult(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/admissionResultPublish');
		$this->load->view('footer');
	}

	public function admissionResultUpdate(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/newAdmissionResult');
		$this->load->view('footer');
	}

	public function admissionResultDelete(){
		$id = $this->uri->segment(3);

		$up = $this->db->where("id",$id)->delete("admission_result");

		redirect("website/admissionResult","location");

	}


	public function uploadAdmissionFile(){
		if(isset($_POST['upload'])):
			extract($_POST);

			$ed = date("Y-m-d");
			$eu = $this->session->userdata('userid');
			$dest = "download/admission_result/".$_FILES['resultFile']['name'];
			$remove = "download/admission_result/".$filename;

			if($id):	
				unlink($remove);
				$data = array(
						"title" 	=> $title,
						"file_name" => $_FILES['resultFile']['name'],
						"edate" 	=> $ed,
						"euser" 	=> $eu
					);

				$ins = $this->db->where("id",$id)->update("admission_result",$data);
			else:
				$data = array(
						"id" 		=> '',
						"title" 	=> $title,
						"file_name" => $_FILES['resultFile']['name'],
						"edate" 	=> $ed,
						"euser" 	=> $eu
					);
$mv = move_uploaded_file($_FILES['resultFile']['tmp_name'],$dest);
				$ins = $this->db->insert("admission_result",$data);
			endif;

			// success
			$aff_row = 0;
			if($this->db->affected_rows()){
						$aff_row++;
				}
			$aff=array("aff"=>$aff_row);

			$this->session->set_userdata($aff);
			redirect("website/admissionResult","location");

		endif;
	}

// admission section end
	
	public function add_image_catagory()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_image_catagory');
		$this->load->view('footer');
	}
	
public function chkCatNm(){
	extract($_POST);
	$chk=$this->db->select("*")->from("image_catagory")->like("image_catagory",$d,"both")->get()->num_rows();
	echo $chk;
}

public function addImgCat(){
	extract($_POST);
// initialize
	$aff_row=0;
	
for($i=0;$i<count($catagory);$i++){
	// data array
	$data=array(
		"id"=>'',
		"image_catagory"=>$catagory[$i]
		);
	// insert
	$ins=$this->db->insert("image_catagory",$data);

	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/add_image_catagory","location");

}

	public function add_department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_department');
		$this->load->view('footer');
	}

public function chkDept(){
	extract($_POST);
	$chk=$this->db->select("*")->from("department")->where("department_name",$d)->get()->num_rows();
	echo $chk;
}

public function submitDept(){
	extract($_POST);

	// initialize
	$path="img/document/department/";
	$img=$_FILES['deptImg']['name'];

	$dest=$path.$img;

	// move file
	move_uploaded_file($_FILES['deptImg']['tmp_name'], $dest);

	// data array
	$data=array(
		"id"=>'',
		"department_name"=>$dept_name,
		"details"=>$details,
		"image"=>$img
		);

// initialize
$aff_row=0;
	// insert into data base

	$ins=$this->db->insert("department",$data);

	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/add_department","location");
}

// history section start

	public function history()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_history');
		$this->load->view('footer');
	}


public function updateHistory(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['priImg']['name']):
		// get image name
		$imgNm=$_FILES['priImg']['name'];
		// path
		$path="img/document/history/";
		// get previous image name
		$preIm=$this->db->select("*")->from("history")->where("id",$msgid)->get()->row();
		
		if($preIm->image):
			// get previous image path
			$preDest=$path.$preIm->image;
			// delete previous image 
			unlink($preDest);
		endif;
		
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['priImg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"details"=>$details,
			"image"=>$imgNm
			
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("history",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/history","location");
}
	
// history section end

		public function calendar()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/calendar');
		$this->load->view('footer');
	}
	
// start rules and regulation section

public function rules_regulation()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_rules_regulation');
		$this->load->view('footer');
	}
	

public function updateRules(){
	extract($_POST);
// initialize
	$aff_row=0;

	// data array
	$data=array(
		"title"=>$title,
		"details"=>$details
		);
	// insert
	$ins=$this->db->update("rules",$data);

	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/rules_regulation","location");
}

// end rules and regulation section

public function mailbox()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/mailbox');
		$this->load->view('footer');
	}
	
			public function login()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/examples/login');
		$this->load->view('footer');
	}
	
			public function class_six()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/charts/morris');
		$this->load->view('footer');
	}
	
		public function class_seven()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/charts/flot');
		$this->load->view('footer');
	}
	
		public function class_eight()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/charts/inline');
		$this->load->view('footer');
	}
	
	public function class_nine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/charts/class_nine_students');
		$this->load->view('footer');
	}
	
		public function class_ten()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/charts/class_ten_students');
		$this->load->view('footer');
	}
	
		public function class_six_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/UI/general');
		$this->load->view('footer');
	}
	
		public function class_seven_routine()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/UI/icons');
		$this->load->view('footer');
	}
	
	
	
	
	
	
	public function edit_teachers()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_teachers');
		$this->load->view('footer');
	}
	
	public function new_teacher()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_teacher');
		$this->load->view('footer');
	}
	
	public function new_about()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_about');
		$this->load->view('footer');
	}
	
// facility section start

	public function facility()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_facility');
		$this->load->view('footer');
	}
	

public function updateFacility(){
	extract($_POST);
// initialize
	$aff_row=0;

	// data array
	$data=array(
		"title"=>$title,
		"details"=>$details
		);
	// insert
	$ins=$this->db->update("facility",$data);

	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/facility","location");
}

// facility section end

// infrustracture section start

	public function infrastructure()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_infrastructure');
		$this->load->view('footer');
	}

public function updateInfrastructure(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['priImg']['name']):
		// get image name
		$imgNm=$_FILES['priImg']['name'];
		// path
		$path="img/document/infrustructure/";
		// get previous image name
		$preIm=$this->db->select("*")->from("infrastructure")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['priImg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("infrastructure",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/infrastructure","location");
}	

// infrustructure section end
	
// department section start 
	public function department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/department');
		$this->load->view('footer');
	}
	
	public function edit_department()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_department');
		$this->load->view('footer');
	}
	
public function updateDept(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['welimg']['name']):
		// get image name
		$imgNm=$_FILES['welimg']['name'];
		// path
		$path="img/document/department/";
		// get previous image name
		$preIm=$this->db->select("*")->from("department")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['welimg']['tmp_name'], $dest);
		// data array
		$data=array(
			"department_name"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"department_name"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->where("id",$msgid)->update("department",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/department","location");
}

// end department section

	public function library_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/library_info');
		$this->load->view('footer');
	}
	
	public function edit_library_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_library_info');
		$this->load->view('footer');
	}
	
	public function book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/book_list');
		$this->load->view('footer');
	}
	
	public function edit_book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_book_list');
		$this->load->view('footer');
	}

public function updateBookLst(){
	extract($_POST);

	// initialize
	$update=date("Y-m-d");
	$uid=$this->session->userdata('userid');
	$aff_row=0;
	// get data array
	$data=array(
		"bctg_id"=>$cat,
		"bookN"=>$bknm,
		"writterN"=>$wnm,
		"tquantity"=>$qnt,
		"up_date"=>$update,
		"up_user"=>$uid
		);
	// update
	$up=$this->db->where("blist_id",$bid)->update("book_list",$data);
	// success
	if($this->db->affected_rows()){
		$aff_row++;
	}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/book_list","location");

}

public function delete_book_list()
	{
		$id=array(
			"blist_id"=>$_GET['id']
			);

		$delete= $this->db->delete('book_list',$id);

		if($delete){
			redirect('website/book_list');
			
		}
}

// welcome message section start

public function welcome_message()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_welcome_msg');
		$this->load->view('footer');
	}
	
	
public function editSubmitData(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['welimg']['name']):
		// get image name
		$imgNm=$_FILES['welimg']['name'];
		// path
		$path="message/welcome/";
		// get previous image name
		$preIm=$this->db->select("*")->from("welcome_message")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['welimg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("welcome_message",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/welcome_message","location");
}

// welcome message end

// principal message section start

	public function principal_message()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_principal_msg');
		$this->load->view('footer');
	}


public function subPrinceData(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['priImg']['name']):
		// get image name
		$imgNm=$_FILES['priImg']['name'];
		// path
		$path="message/principal/";
		// get previous image name
		$preIm=$this->db->select("*")->from("principal_message")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['priImg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("principal_message",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/principal_message","location");
}

// principal section end


// vice principal section start
	
	public function vice_principal_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_vice_principal_msg');
		$this->load->view('footer');
	}

public function subVcMsg(){
	extract($_POST);
	// initialize
	$aff_row=0;
	// get image
	if($_FILES['priImg']['name']):
		// get image name
		$imgNm=$_FILES['priImg']['name'];
		// path
		$path="message/vice_principal/";
		// get previous image name
		$preIm=$this->db->select("*")->from("vice_principal_message")->where("id",$msgid)->get()->row();
		// get previous image path
		$preDest=$path.$preIm->image;
		// delete previous image 
		unlink($preDest);
		// destination
		$dest=$path.$imgNm;
		// copy image
		move_uploaded_file($_FILES['priImg']['tmp_name'], $dest);
		// data array
		$data=array(
			"title"=>$title,
			"image"=>$imgNm,
			"details"=>$details
			);
		else:
			// data array
			$data=array(
				"title"=>$title,
				"details"=>$details
				);
	endif;

	// update data
	$up=$this->db->update("vice_principal_message",$data);
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/vice_principal_msg","location");
}

// vice principal message end



	public function admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/admission_info');
		$this->load->view('footer');
	}
	
	public function edit_admission_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_admission_info');
		$this->load->view('footer');
	}
	
	public function contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/contact_admission');
		$this->load->view('footer');
	}
	
	public function edit_contact_admission()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_contact_admission');
		$this->load->view('footer');
	}

// syllabus section start
	public function syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/syllabus');
		$this->load->view('footer');
	}

	public function addSyllubus(){
	extract($_POST);	// extract your data

// set destination
	$path="download/syllabus/";
// get notice file name
	$fileName=$_FILES['img']['name'];
	// get dest file path
	$dest=$path.$fileName;
	// upload
	move_uploaded_file($_FILES['img']['tmp_name'], $dest);
// initialize data
	$edate=date("Y-m-d");
	// affected row initialize
			$aff_row=0;
	$uid=$this->session->userdata('userid');
	// data array
	$data=array(
		"id"=>'',
		"classs"=>$class_name,
		"title"=>$cls_title,
		"pdf_details"=>$fileName,
		"dates"=>$edate,
		"entry_user"=>$uid
		);
	// insert data
	$this->db->insert("syllabus",$data);
	
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/syllabus","location");
}


// syllabus section end

public function updateNotice(){
	extract($_POST);
// initialization
	$uid=$this->session->userdata('userid');
	// test change syllabus
	if($_FILES['sfile']['name']):
		// get path
		$path="download/notice/";
	// get previous syllabus
	$ps=$this->db->select("*")->from("notice")->where("id",$sid)->get()->row();
	// get previous syllabus name
	$psnm=$path.$ps->pdf_details;
	// delete previous syllabus
	unlink($psnm);
	// new syllabus name
	$snm=$_FILES['sfile']['name'];
	$dest=$path.$snm;
	// move uploaded file
	move_uploaded_file($_FILES['sfile']['tmp_name'], $dest);
	// data array
	$data=array(
		"title"=>$title,
		"pdf_details"=>$snm,
		"notice_date"=>$pdate,
		"entry_user"=>$uid
		);
	else:
		// data array
		$data=array(
			"title"=>$title,
			"notice_date"=>$pdate,
			"entry_user"=>$uid
			);
	endif;
	// update
	$up=$this->db->where("id",$sid)->update("notice",$data);
	if($up):
		redirect("website/notice","location");
	endif;
}

	public function edit_syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_syllabus');
		$this->load->view('footer');
	}
	
public function updateSyllabus(){
	extract($_POST);
// initialization
	$uid=$this->session->userdata('userid');
	// test change syllabus
	if($_FILES['sfile']['name']):
		// get path
		$path="download/syllabus/";
	// get previous syllabus
	$ps=$this->db->select("*")->from("syllabus")->where("id",$sid)->get()->row();
	// get previous syllabus name
	$psnm=$path.$ps->pdf_details;
	// delete previous syllabus
	unlink($psnm);
	// new syllabus name
	$snm=$_FILES['sfile']['name'];
	$dest=$path.$snm;
	// move uploaded file
	move_uploaded_file($_FILES['sfile']['tmp_name'], $dest);
	// data array
	$data=array(
		"classs"=>$cls,
		"title"=>$title,
		"pdf_details"=>$snm,
		"dates"=>$pdate,
		"entry_user"=>$uid
		);
	else:
		// data array
		$data=array(
			"classs"=>$cls,
			"title"=>$title,
			"dates"=>$pdate,
			"entry_user"=>$uid
			);
	endif;
	// update
	$up=$this->db->where("id",$sid)->update("syllabus",$data);
	if($up):
		redirect("website/syllabus","location");
	endif;
}

	public function delete_syllabus()
	{

		$id=array(
		"id"=>$_GET['id']
		);
		$delete= $this->db->delete('syllabus',$id);


		if($delete){
			redirect('website/syllabus');
			
		}
	}
	
	public function new_syllabus()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_syllabus');
		$this->load->view('footer');
	}


	public function add_stuff()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_stuff');
		$this->load->view('footer');
	}
	
	public function add_history()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_history');
		$this->load->view('footer');
	}
	
	public function add_rules()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_rules');
		$this->load->view('footer');
	}
	
	public function add_facility()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_facility');
		$this->load->view('footer');
	}
	
	public function add_infustracture()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_infustracture');
		$this->load->view('footer');
	}
	
	public function add_prin_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_prin_msg');
		$this->load->view('footer');
	}
	
	public function add_vic_prin_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_vic_prin_msg');
		$this->load->view('footer');
	}
	
	public function add_welcome_msg()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/add_welcome_msg');
		$this->load->view('footer');
	}
	
	
	public function edit_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_vacancy');
		$this->load->view('footer');
	}
	
	public function delete_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/delete_vacancy');
		$this->load->view('footer');
	}
	
	public function new_vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_vacancy');
		$this->load->view('footer');
	}
	
// notice section start

	public function notice()
	{
		$data['all_data'] = $this->n->gettable();
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/notice',$data);
		$this->load->view('footer');
	}
	
	public function addNotice(){
	extract($_POST);	// extract your data

// set destination
	$path="download/notice/";
// get notice file name
	$fileName=$_FILES['img']['name'];
	// get dest file path
	$dest=$path.$fileName;
	// upload
	move_uploaded_file($_FILES['img']['tmp_name'], $dest);
// initialize data
	// affected row initialize
			$aff_row=0;
	$uid=$this->session->userdata('userid');
	// data array
	$data=array(
		"id"=>'',
		"title"=>$notice_title,
		"pdf_details"=>$fileName,
		"notice_date"=>$notice_date,
		"entry_user"=>$uid
		);
	// insert data
	$this->db->insert("notice",$data);
	
	// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/notice","location");
}


	public function edit_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_notice');
		$this->load->view('footer');
	}
	
public function delete_notice()
	{
		$id=array(
			"id"=>$_GET['id']
			);

		$delete= $this->db->delete('notice',$id);

		if($delete){
			redirect('website/notice');
			}
}


public function new_notice()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_notice');
		$this->load->view('footer');
	}

// notice section end
	

public function library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/library_gallery');
		$this->load->view('footer');
	}
	
		public function new_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_library_gallery');
		$this->load->view('footer');
	}
	
		public function edit_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_library_gallery');
		$this->load->view('footer');
	}
	
		public function delete_library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/delete_library_gallery');
		$this->load->view('footer');
	}
	
// gallery section start

	public function gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/gallery');
		$this->load->view('footer');
	}
	
// gallery section end

		public function vacancy()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/vacancy');
		$this->load->view('footer');
	}
	
			public function edit_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/edit_gallery');
		$this->load->view('footer');
	}
	
			public function delete_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/delete_gallery');
		$this->load->view('footer');
	}

// gallery section start
	
public function new_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/new_gallery');
		$this->load->view('footer');
	}
	
public function gallery_update(){
		extract($_POST);
// initialization
		$aff_row=0;
// image name
		$img_nm=$_FILES['img']['name'];
// image path
		$path="galleryImage/img/";
		// destination
		$dest=$path.$img_nm;
		// move uploaded file
		move_uploaded_file($_FILES['img']['tmp_name'], $dest);

		// data array
		$data=array(
			"id"=>'',
			"title"=>$title,
			"catagory"=>$cat,
			"image"=>$img_nm
			);
		// insert data
		$ins=$this->db->insert("gallery",$data);
		// success
	if($this->db->affected_rows()){
				$aff_row++;
		}
	$aff=array("aff"=>$aff_row);

	$this->session->set_userdata($aff);
	redirect("website/gallery","location");

	}

// gallery section end

	public function addImageCategory(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/addImageCategory');
		$this->load->view('footer');
	}
	
	public function delete_image_catagory(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/delete_image_catagory');
		$this->load->view('footer');
	}
 
	
	
	public function image_upload() {
		if(isset($_POST)) {  
			echo $_FILES['img']['tmp_name'];
		}
	}

// google map section start
	public function google_map(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('website/googleMap');
		$this->load->view('footer');	
	}

	public function mapUpdate(){
		if(isset($_POST['update'])):
			extract($_POST);

			$ed = date("Y-m-d");
			$eu = $this->session->userdata("userid");

			$data = array(
					"id" => '',
					"map_link" => $map,
					"edate" => $ed,
					"euser" => $eu
				);

			$ins = $this->db->insert("google_map",$data);

			redirect("website/google_map","location");

		endif;
	}

// google map section end
}
