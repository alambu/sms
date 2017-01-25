<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admission_submit  extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model('admission/admission_model','admission');
		$this->load->model("setting/setting_model","bsetting");
		$this->load->model('student/student_model','student');
	}
	
	
	public function application_form()
	{
		$sname=$this->input->post('sname');
		$mname=$this->input->post('mname');
		$fname=$this->input->post('fname');
		$class_name=$this->input->post('class_name');
		$email=$this->input->post('email');
		$gpac=$this->input->post('gpaC');
		$inst_name=$this->input->post('schoName');
		$gender=$this->input->post('gender');
		$religion=$this->input->post('religion');
		$blood_grou=$this->input->post('blood_grou');
		$pre_address=$this->input->post('pre_address');
		$par_address=$this->input->post('par_address');
		$city=$this->input->post('city');
		$phone=$this->input->post('phone');
		$pob=$this->input->post('pob');
		$dob=$this->input->post('dob');
		$picture=$this->input->post('picture');
		$pic=$_FILES['picture']['name'];
		$tmp_name=$_FILES['picture']['tmp_name'];
		$r=rand(1000,9000);
		$sr=substr($r,0,4);
		$yemp=date("Y");$m=date("m");
		$appid=$yemp.$m.$sr;
		$today=date('Y-m-d H:i:s');
		$e_user=$this->session->userdata('userid');
		
		//validation start
		
		if(trim($sname)=='') { echo "Applicant Name is Empty";exit; }	
		if(trim($mname)=='') { echo "Mother Name is Empty";exit; }	
		if(trim($fname)=='') { echo "Fother Name is Empty";exit; }	
		if(trim($class_name)=='') { echo "Class Name is Empty";exit; }	
		if(trim($gender)=='') { echo "Gender is Empty";exit; }	
		if(trim($religion)=='') { echo "Religion is Empty";exit; }	
		if(trim($blood_grou)=='') { echo "Blood Group is Empty";exit; }	
		if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }	
		if(trim($par_address)=='') { echo "Permanent Address is Empty";exit; }	
		if(trim($city)=='') { echo "City is Empty";exit; }	
		if(trim($pob)=='') { echo "Place Of Birth is Empty";exit; }	
		if(trim($dob)=='') { echo "Birth Day is Empty";exit; }	
		if(trim($pic)=='') { echo "Picture is Empty";exit; }	
		
		//validation end
		
		$des="admin/img/student_section/application_form/".$pic;	
		$tmp_name=$_FILES['picture']['tmp_name'];
		copy($tmp_name,"img/student_section/application_form/$pic");
		
		$data=array(
			'appid'=>$appid,
			'classid'=>$class_name,
			'name'=>$sname,
			'fName'=>$fname,
			'mName'=>$mname,
			'Phone_n'=>$phone,
			'email'=>$email,
			'gpa'=>$gpac,
			'pob'=>$pob,
			'dob'=>$dob,
			'inst_name'=>$inst_name,
			'par_address'=>$par_address,
			'pre_address'=>$pre_address,
			'gender'=>$gender,
			'religion'=>$religion,
			'blood_grou'=>$blood_grou,
			'city'=>$city,
			'image'=>$pic,
			'e_date'=>$today,
			'e_user'=>$e_user
		);
		
		$insert=$this->admission->all_insert('application_tbl',$data);
		
		if($insert) {
			/*$mobile=substr($phone,-11);
			$messages="Your Application Complete Successfully.Your ID: $appid.Thank you $sname for application.";
			$txt=urlencode($messages);*/
			//$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
			//file_get_contents($url);
			echo $appid;exit;
			
		}
		else {
		echo "Data Not Save";exit;
		
		}
	}
	
	public function application_form_fee()
	{
		extract($_POST);
		if(trim($fee)=='') { echo "Fee is Empty";exit; }
		$uid=$this->session->userdata('userid');
		$data=array('fee'=>$fee,'entry_user'=>$uid);
		
		//insert update test start
		$exist_test=$this->admission->application_fee();
		if(count($exist_test)>0) {
			$where=array('id'=>$hid_id);
			$action=$this->admission->all_update($where,'application_fee',$data);
		}
		else 
		{
			$action=$this->admission->all_insert('application_fee',$data);
		}
		//insert update test end
		
		if($action) { echo 1; }
		else { echo "Data Not Save";exit; }
	}
	
	public function admission_fee()
	{
		//print_r($_POST);exit;
		//validation start
		extract($_POST);
		if(trim($fee)=='') { echo "Fee is Empty";exit; }
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='') { echo "Class is Empty";exit; }
		$uid=$this->session->userdata('userid');
		
		$data=array('shiftid'=>$shift,'classid'=>$cls,'fee'=>$fee,'entry_user'=>$uid);
		$where_test=array('shiftid'=>$shift,'classid'=>$cls);
		
		//insert update test start
		$exist_test=$this->admission->admission_fee_info($where_test);
		if(count($exist_test)>0) {
			$where=array('id'=>$hid_id);
			$action=$this->admission->all_update($where,'admission_fee',$data);
		}
		else 
		{
			$action=$this->admission->all_insert('admission_fee',$data);
		}
		//insert update test end
		
		if($action) { echo 1; }
		else { echo "Data Not Save";exit; }
		//validation end
	}
	
	public function student_registration(){
		if(isset($_POST['submit'])){
			extract($_POST);
			//student ID Genarate
			$r=rand(1000,9000);
			$sr=substr($r,0,4);
			$yemp=date("Y");$m=date("m");
			$stu_id=$yemp.$m.$sr;
			//student ID Genarate End
			
			$today=date('Y-m-d h:i:s');
			$e_user=$this->session->userdata('userid');
			
			//input empty validation start
			if(trim($sname)=='') { echo "Student Name is Empty";exit; }
			if(trim($pid)=='') { echo "Guardian ID is Empty";exit; }
			if(trim($fname)=='') { echo "Father Name is Empty";exit; }
			if(trim($f_ocop)=='') { echo "Father Occopation is Empty";exit; }
			if(trim($mname)=='') { echo "Mother Name is Empty";exit; }
			if(trim($mocop)=='') { echo "Mother Occopation is Empty";exit; }
			if(trim($sname_ban)=='') { echo "Student Name Bangla is Empty";exit; }
			if(trim($mname_ban)=='') { echo "Mother Name Bangla is Empty";exit; }
			if(trim($fname_ban)=='') { echo "Father Name Bangla is Empty";exit; }
			if(trim($shift)=='') { echo "Shift is Empty";exit; }
			if(trim($class_catg)=='') { echo "Class Name is Empty";exit; }
			if(trim($section)=='') { echo "Section is Empty";exit; }
			if(trim($roll_no)=='') { echo "Roll No is Empty";exit; }
			if(trim($gender)=='') { echo "Gender is Empty";exit; }
			if(trim($dob_id)=='') { echo "Birth Date Certificate ID is Empty";exit; }
			if(trim($dob)=='') { echo "Birth Day is Empty";exit; }
			if(trim($ses_year)=='') { echo "Session is Empty";exit; }
			if(trim($loc_grd)=='') { echo "Local Gardian Name is Empty";exit; }
			if(trim($grd_phone)=='') { echo "Gardian Mobile No is Empty";exit; }
			if(trim($religion)=='') { echo "Religion is Empty";exit; }
			if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }
			if(trim($par_address)=='') { echo "Parmanent Address is Empty";exit; }
			if(trim($appid)=='') { echo "Applicant is Empty";exit; }
			//input empty validation end
			
			
			$appimg=$this->db->select("*")->from("application_tbl")->where("appid",$appid)->get()->row();
			if($appimg->app_status>0)
			{
				echo "Already Admitted";exit;
			}	
			
			
			//roll no exist test
			$rol_chk=$this->student->roll_no_exist_chk($class_catg,$shift,$ses_year,$roll_no,$section);
			if($rol_chk>0) { echo "Roll No Already Exist";exit; }
			//roll no exist test
			
			
			//class group test start
			$grp_chk=$this->student->group_detact_test($section);
			if($grp_chk!='') {
			if(trim($group)=='')
			{
			echo "Group is Empty";	
			exit;
			}
			}
			//class group test end
			
			
			
			//parrents varification start
			$p_chk=$this->student->parrent_id_test($pid);
			if($p_chk==0){ echo "Parrent ID is Wrong";exit;}
			//parrents varification End
			
			
			
			//student id unique test start
			$s_chk=$this->student->student_id_test($stu_id);
			if($s_chk>0) { echo "Student ID is Dublicate";exit; }
			//student id uneque test end
			
			
			
			//picture copy start
			if(!empty($_FILES['picture']['name'])){	
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			copy($tmp_name,"img/student_section/registration_form/$pic");
			}
			else {
				$src="img/student_section/application_form/".$appimg->image;
				$destination="img/student_section/registration_form/".$appimg->image;
				copy($src,$destination);	
			}
			
			//picture copy End
			
			
			
			//----------re admission table array start-----//
			
			$data1=array(
			'stu_id'=>$stu_id,
			'shiftid'=>$shift,
			'classid'=>$class_catg,
			'section'=>$section,
			'groupid'=>$group,
			'roll_no'=>$roll_no,
			'syear'=>$ses_year,
			'status'=>'1',
			'course_fee'=>'',
			'e_date'=>$today,
			'e_user'=>$e_user
			
			);
			
			//---------registation table array End-----
			
			// registration table array start----
			
			$data2=array(
			'stu_id'=>$stu_id,
			'name'=>$sname,
			'fName'=>$fname,
			'foccupation'=>$f_ocop,
			'mName'=>$mname,
			'moccupation'=>$mocop,
			'name_ban'=>$sname_ban,
			'fName_ban'=>$fname_ban,
			'mName_ban'=>$mname_ban,
			'local_guardian'=>$loc_grd,
			'Phone_n'=>$grd_phone,
			'personal_phone'=>$par_phone,
			'email'=>$email,
			'par_address'=>$par_address,
			'pre_address'=>$pre_address,
			'dob'=>$dob,
			'dob_id'=>$dob_id,
			'pob'=>$pob,
			'pbs'=>$pbs,
			'gpa'=>$gpa,
			'gender'=>$gender,
			'religion'=>$religion,
			'blood_grou'=>$blood_grou,
			'city'=>$city,
			'picture'=>$pic,
			'verid'=>'0',
			'parentid'=>$pid,
			'e_date'=>$today,
			'e_user'=>$e_user
			);
			
			// registration table array End----
			
			
			// Student login array Start 
			$data4=array(
			'stu_id'=>$stu_id,
			'pass'=>$stu_id,
			'e_date'=>$today,
			'e_user'=>$e_user
			);
			// Student login array End 
			
			$up_data=array('app_status'=>1);
			$where=array('appid'=>$appid);
			
			
			
			$insert=$this->student->all_insert('regis_tbl',$data2);
			$insert=$this->student->all_insert('re_admission',$data1);
			$insert=$this->student->all_insert('fstu_login',$data4);
			$up=$this->student->all_update($where,'application_tbl',$up_data);
			if($insert) { echo 1;exit; } else { echo "Data Not Save";exit; }
			
		
	}

	}
	
	
}
	
?>