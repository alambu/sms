<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class student_submit extends CI_Controller {
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
		$this->load->model("student/student_model","student");
	}


	// ----------------student section start-----------------------
	public function application_catg_setting() {
		
		if(isset($_POST['submit'])){
			$class_name=$this->input->post('class_name');
			$fee=$this->input->post('fee');
			$years=$this->input->post('years');
			$min_gpa=$this->input->post('min_gpa');
			$in=1;
			$i=count($class_name);
			$e_user=$this->session->userdata('userid');
			$status='0';
			$today=date('Y-m-d h:s:a');
			
			for($j=0;$j<$i;$j++){
				if((trim($fee[$j])!='') && ($class_name[$j]!='') && (trim($years)!='')){
				$data=array(
				'appctgid'=>'',
				'classid'=>$class_name[$j],
				'fee'=>$fee[$j],
				'years'=>$years,
				'min_gpa'=>$min_gpa[$j],
				'status'=>$status,
				'e_date'=>$today,
				'e_user'=>$e_user,
				'up_user'=>''
				);
				$classid=$class_name[$j];
				
				$chk=$this->db->query("select * from application_catg where classid='$classid' and years='$years'");
				$row=$chk->num_rows();
				
				if($row<1){
				$insert=$this->db->insert('application_catg',$data);
				$in++;
				}
				
				else {
					
					//array_push($d,$data);
					
				}
				}
				else {
					
				}
			}
			
			//$this->session->set_userdata($d);
			
			if(($in>1) || ($in==1)){ 
				
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			
		
			
			else {

			}
			
		}
		
		if(isset($_POST['submit_edit'])){
			extract($_POST);
			$up_user=$this->session->userdata('userid');
			$up_date=date("Y-m-d h:s:A");
			$up=1;
			$this->db->query("select id from application_tbl where appctgid='$appctgid'");
			
			if($this->db->affected_rows()>0){
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_edit/application_catg_edit?id='.$appctgid."&y=".$years,'location');
			}
			elseif(trim($fee)==''){
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);	
			redirect('student_edit/application_catg_edit?id='.$appctgid."&y=".$years,'location');	
			}
			
			$data=array(
			'fee'=>$fee,
			'min_gpa'=>$gpa,
			'up_user'=>$up_user,
			'up_date'=>$up_date
			);
			$this->db->where('appctgid', $appctgid);
			$update=$this->db->update('application_catg' ,$data);
			
			if($up){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			else {
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/application_catg_edit?id='.$appctgid."&y=".$years,'location');
			}
		}
		
	}
	
	public function application_form() {
		
		
		if(isset($_POST['submit']))  {
			extract($_POST);
			
			$cname=$this->db->query("select a.class_name,b.classid,b.appctgid from class_catg a,application_catg b where b.appctgid='$class_name' and a.classid=b.classid")->row()->class_name;
			
			foreach($_POST as $key=>$value){
				if($key=='class_name') {
					if(trim($value)!='') {
						//echo $value;
						
						
					if($cname=='SIX' || $cname=='NINE'){
						if(trim($gpa)==''){
						   redirect('student_section/application_form?d='.serialize($_POST), 'location' );
						}
						elseif($gpa>5.00){
							redirect('student_section/application_form?d='.serialize($_POST), 'location' );
						}
						elseif(trim($inst_name)=='') {
							
							redirect('student_section/application_form?d='.serialize($_POST), 'location' );
						}
					}
					
					}
					
					else {
						redirect('student_section/application_form?d='.serialize($_POST), 'location' );
					}
					
				}
				
				else {
					
					if($key!='submit' || $key!='blood_grou' || $key!='email'){ }
					else {	
					if(trim($value)==''){
						redirect('student_section/application_form?d='.serialize($_POST), 'location' );
						}
					}
				}
				
			}
			
			$picture=$this->input->post('picture');
			$pic=$_FILES['picture']['name'];
			$tmp_name=$_FILES['picture']['tmp_name'];
			//applicant id genarate start
			$r=rand(1000,9000);
			$sparent=substr($r,0,4);
			$yparent=date("Y");
			$mparent=date("m");
			$parrentid=$mparent.$yparent.$sparent;
			$appid=$parrentid;
			//applicant id genarate end
			$today=date('Y-m-d h:s:a');
			$e_user=$this->session->userdata('userid');
			$image=$appid.".jpg";
			$des="img/student_section/application_form/".$appid.".jpg";	
			$tmp_name=$_FILES['picture']['tmp_name'];
			copy($tmp_name,"img/student_section/application_form/$pic");
			rename("img/student_section/application_form/$pic",$des);
			
			$data=array(
				'id'=>'',
				'appid'=>$appid,
				'appctgid'=>$class_name,
				'name'=>$sname,
				'fName'=>$fname,
				'mName'=>$mname,
				'Phone_n'=>$phone,
				'email'=>$email,
				'gpa'=>$gpa,
				'inst_name'=>$inst_name,
				'par_address'=>$par_address,
				'pre_address'=>$pre_address,
				'gender'=>$gender,
				'religion'=>$religion,
				'blood_grou'=>$blood_grou,
				'city'=>$city,
				'trans_id'=>$trans_id,
				'image'=>$image,
				'e_date'=>$today,
				'e_user'=>$e_user,
				'up_date'=>' ',
				'up_user'=>' '
			);
			
			$insert=$this->db->insert('application_tbl ',$data);
			if($insert) {
			redirect('student_report/application_details?d='.$appid, 'location' );
			}
			else {
			$info=array(
			'c'=>2
			);
			
			redirect('student_section/application_form?d='.serialize($_POST), 'location' );
			
			}
		}
		
	}
	
	public function valid_stuid(){
		if(isset($_POST['stu_id'])){
			$stu_id=$_POST['stu_id'];
			$search=$this->db->query("select * from regis_tbl where stu_id='$stu_id'");
			$row=$search->num_rows();
			if($row>0){
				echo "<b style='color:green;'>Student ID is Correct</b>";
			}
			else {
				echo "<b style='color:red;'>Student ID is Wrong!</b>";
			}
		}
	}

//registration form start
	
	public function student_registration(){
		//print_r($_POST);
		if(isset($_POST)){
			//echo "ekhane";
			//print_r($_POST);exit;
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
			
			if(trim($PresentVill) == ''){echo "Present Address village Name is Empty";exit;}
			if(trim($PresentPostOffice) == ''){echo "Present Address post office is Empty";exit;}
			if(trim($PresentUpozila) == ''){echo "Present Address upozila is Empty";exit;}
			if(trim($PresentDistrict) == ''){echo "Present Address district is Empty";exit;}
			$pre_address = $PresentVill." , ".$PresentPostOffice." , ".$PresentUpozila." , ".$PresentDistrict;
			
			if(trim($PermanentVill) == ''){echo "Permanent Address village Name is Empty";exit;}
			if(trim($PermanentPostOffice) == ''){echo "Permanent Address post office is Empty";exit;}
			if(trim($PermanentUpozila) == ''){echo "Permanent Address upozila is Empty";exit;}
			if(trim($PermanentDistrict) == ''){echo "Permanent Address district is Empty";exit;}
			$par_address = $PermanentVill." , ".$PermanentPostOffice." , ".$PermanentUpozila." , ".$PermanentDistrict;
			
			//if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }
			//if(trim($par_address)=='') { echo "Parmanent Address is Empty";exit; }
			//input empty validation end
			
			
			//IMAGE validation start
			
			if(isset($_FILES['picture'])){
				if(empty($_FILES['picture']['name']))
				{
					echo "Picture is Empty";exit;
				}
			}
			//image validation end
			
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
			
			if(isset($_FILES['picture'])) {
			//image upload start
			if ($_FILES['picture']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                $pic = $stu_id.'_'. uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['picture']['tmp_name'], 'img/student_section/registration_form/' . $pic);
               // $data['image'] = $name;
			
			}
			//image upload end
			
			}
			else {
				$src="img/student_section/application_form/".$picture;
				$des="img/student_section/registration_form/".$stu_id.".jpg";
				$destination="img/student_section/registration_form/".$picture;
				copy($src,$destination);
				//rename($destination,$des);	
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
			
			
			
			
			
			$insert=$this->student->all_insert('regis_tbl',$data2);
			$insert=$this->student->all_insert('re_admission',$data1);
			$insert=$this->student->all_insert('fstu_login',$data4);
			
			if($insert) { echo 1;exit; } else { echo "Data Not Save";exit; }
			
		
	}

	}
	
	
	
	public function student_edit()
	{
		extract($_POST);

		$stu_img=$hid_stu.".jpg";
		$today=date('Y-m-d h:s:s');
		$up_user=$this->session->userdata('userid');
		//input empty validation start
		if(trim($sname)=='') { echo "Student Name is Empty";exit; }
		if(trim($pid)=='') { echo "Guardian ID is Empty";exit; }
		if(trim($hid_stu)=='') { echo "Student ID is Empty";exit; }
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
		//input empty validation end
		
		
		
		//roll no exist test
		$rol_chk=$this->student->roll_no_exist_chk_byedit($class_catg,$shift,$ses_year,$roll_no,$section,$hid_stu);
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
		
		
		//IMAGE validation start
		
		if(!empty($_FILES['picture']['name'])) 
		{
			
			$des="img/student_section/registration_form/".$hid_pic;	
			unlink($des);
			
			//image upload start
			if ($_FILES['picture']['name'] != '') {
                $ext = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
                $pic = $hid_stu.'_'. uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['picture']['tmp_name'], 'img/student_section/registration_form/' . $pic);
               // $data['image'] = $name;
			
			}
			//image upload end
			
	
		}
		else 
		{
			$pic=$hid_pic;
		}
		
		//image validation end
		
		//update array start
		$data1=array(
		'shiftid'=>$shift,
		'classid'=>$class_catg,
		'section'=>$section,
		'groupid'=>$group,
		'roll_no'=>$roll_no,
		'syear'=>$ses_year,
		'status'=>'1',
		'course_fee'=>'',
		'up_date'=>$today,
		'up_user'=>$up_user
		);
		
		$data2=array(
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
		'up_date'=>$today,
		'up_user'=>$up_user
		);
		
		$where1=array('readid'=>$readid);
		$tbl1="re_admission";
		$up=$this->student->all_update($where1,$tbl1,$data1);
		$where2=array('stu_id'=>$hid_stu);
		$tbl2="regis_tbl";
		$up=$this->student->all_update($where2,$tbl2,$data2);
		
		if($up) { echo 1; } else { echo "Data Not Save"; }
		
	}
	

	// group detect test start
	public function group_detact()
	{
		extract($_POST);
		$group=$this->student->group_detact_test($secid);
		if($group!='')
		{
			$ex=explode(",",$group);
			foreach($ex as $value)
			{
			?>
			<option value='<?php echo $value; ?>'><?php echo $this->db->select("group_name")->from("group_setup")->where("groupid",$value)->get()->row()->group_name; ?></option>
			<?php
			}
		}
		else 
		{
			echo 0;
		}
	}
	
	// group detect test end

		//Re-admission sart

		public function re_admission() {
		if(isset($_POST['submit'])){
			$reg_in=1;
			$stu_id=$this->input->post('stu_id');
			$catagoryid=$this->input->post('catagoryid');
			$section=$this->input->post('section');
			$roll_no=$this->input->post('roll_no');
			$syear=$this->input->post('session');
			$course_fee=$this->input->post('course_fee');
			$shift=$this->input->post('shift');
			
			$today=date('Y-m-d h:s:a');
			$e_user=$this->session->userdata('userN');
			
			$data=array(
			'readid'=>'',
			'stu_id'=>$stu_id,
			'shiftid'=>$shift,
			'classid'=>$catagoryid,
			'section'=>$section,
			'roll_no'=>$roll_no,
			'syear'=>$syear,
			'course_fee'=>'',
			'e_date'=>$today,
			'e_user'=>$e_user,
			'up_date'=>'',
			'up_user'=>''
			
			);
			//roll chk start
			$rol_chk=$this->db->query("select * from re_admission where shiftid='$shift' and classid='$catagoryid' and section='$section' and roll_no='$roll_no' and syear='$syear'");
			$chk_r_row=$rol_chk->num_rows();
			if($chk_r_row>0){
				//$reg_in++;
				$msg=array(
				'reg_in'=>$reg_in
				);
				$this->session->set_userdata($msg);
				redirect( 'student_section/re_admission?rd='.serialize($_POST), 'location' );
			}
			//roll chk end
			$regis=$this->db->query("select * from regis_tbl where stu_id='$stu_id'");
			$chk_reg=$regis->num_rows();
			if($chk_reg>0){
			$select=$this->db->query("select * from  re_admission  where stu_id='$stu_id' and syear='$syear'");
			$row=$select->num_rows();
			
			if($row<1){

				$insert=$this->db->insert('re_admission ',$data);
				
			if($insert) {
			$reg_in++;	
			$msg=array(
			'reg_in'=>$reg_in
			);
			$this->session->set_userdata($msg);
			redirect('student_section/registration_form', 'location' );
			}
			else {
			$msg=array(
			'reg_in'=>$reg_in
			);
			$this->session->set_userdata($msg);
			
			redirect('student_section/student_registration?rd='.serialize($_POST), 'location' );
			}
			
			}
			
			else {
				$msg=array(
				'reg_in'=>$reg_in
				);
				$this->session->set_userdata($msg);
			redirect('student_section/student_registration?rd='.serialize($_POST), 'location' );
			}
			
			}
			else {
				$msg=array(
				'reg_in'=>$reg_in
				);
				$this->session->set_userdata($msg);
				redirect( 'student_section/student_registration?rd='.serialize($_POST),'location' );
			}
		}
	}


//Re-admission End
	
	public function class_period_setting() {
		if(isset($_POST['submit'])){
			extract($_POST);
			$e_date=date("Y-m-d h:i:a");
			$e_user=$this->session->userdata('userid');
			$i=count($classid);$j=0;$in=1;
			for($j;$j<$i;$j++){
				if(trim($classid[$j])!='' and  trim($total_class[$j])!=''){
					
					$chk_row=$this->db->query("select perid from class_period where classid='$classid[$j]'")->num_rows();
					if($chk_row==0){
					$data=array(
					'classid'=>$classid[$j],
					'maxclass'=>$total_class[$j],
					'e_date'=>$e_date,
					'e_user'=>$e_user,
					'up_date'=>'',
					'up_user'=>''
					);
					
					$insert=$this->db->insert("class_period",$data);
					if($insert){ $in++; } else {  }
					}
				}
			}
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);
			redirect('student_section/level_2_setting','location');
		}
		
		if(isset($_POST['submit_edit'])){
			extract($_POST);
			$up_user=$this->session->userdata('userid');
			$up=1;
			if(trim($perid)=='' || trim($total_class)==''){
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/class_period_setting?id='.$perid,'location');
			}
			else {
				$update=$this->db->query("update class_period set maxclass='$total_class',up_user='$up_user' where perid='$perid'");
				if($update){
					$up++;
					$msg=array('up'=>$up);
					$this->session->set_userdata($msg);
					redirect('student_section/level_2_setting','location');
				}
				else {
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);	
				redirect('student_edit/class_period_setting?id='.$perid,'location');	
				}
			}
			
		}
		
	}
	
	public function ajax_request() {
//Ajax Request Function Body Start
		
		if(isset($_POST['chk_pid'])){
			extract($_POST);
			$chk=$this->db->query("select * from father_login where parentid='$chk_pid'");
			$row=$this->db->affected_rows();
			if($row==0){
				echo 0;
			}
			else {
				echo 1;
			}
		}
		
		if(isset($_POST['readm_id'])){
			$id=$_POST['readm_id'];
			$select=$this->db->query("select * from regis_tbl where stu_id='$id'");
			$row=$select->num_rows();
			
			if($row>0){
				
				$find=$select->row();
				
				$query=$this->db->query("select * from re_admission where stu_id='$id' order by readid desc limit 1")->row();
				
				$all_sec=$this->db->select("section")->from("class_catg")->where("classid",$query->classid)->get()->row()->section;
				
				$class_id=$query->classid;
				$section=$query->section;
				$syear=$query->syear;
				$shiftid=$query->shiftid;
				$s=$find->section;
				$s_name=$this->db->query("select * from shift_catg")->result();
				foreach($s_name as $name){
					$sfid.=$name->shiftid.',';
					$sfname.=$name->shift_N.',';
				}
				$c=$this->db->query("select * from class_catg")->result();
				
				foreach($c as $v){
					$d.=$v->classid.',';
					$dn.=$v->class_name.',';
				}
				
				
				echo $d.'+'.$dn.'+'.$class_id.'+'.$section.'+'.$sfid.'+'.$sfname.'+'.$shiftid.'+'.$all_sec;
			}
			
			else {
				echo "1";
			}
		}
		
		if(isset($_POST['rot_day'])){
			extract($_POST);
			$y=date("Y");
			//echo $rot_cls.$rot_sft.$tec_code test_time;
			$row=$this->db->query("select routineid from routine where year='$rot_y' and shiftid='$rot_sft' and day='$rot_day' and stime='$test_time' and teacherid='$tec_code'")->num_rows();
			if($row>0){
				echo 0;
			}
			else {
				echo 1;
			}
		}
		
		if(isset($_POST['cls_id'])){
			extract($_POST);
			$array_sec=array();
			$array_id=array();
			$select=$this->bsetting->section_info($cls_id);
			foreach($select as $v){
				
				array_push($array_sec,$v->section_name);
				array_push($array_id,$v->sectionid);
				
			}
			$cls=implode($array_sec,",");
			$cid=implode($array_id,",");
			echo $cls."#".$cid;
		}
		
		if(isset($_POST['subject'])){
			$clsid=$_POST['subject'];
			$query=$this->db->query("select * from  subject_class where classid='$clsid'")->result();
			echo "<option value=''>select</option>";
			foreach($query as $v){
				?>
				<option value="<?php echo $v->subjid; ?>"><?php echo $v->sub_name; ?></option>
			<?php 	
			}
		}
		
		if(isset($_POST['chk_tech'])){
			$tech_id=$_POST['chk_tech'];
			$y=date("Y");
			$q=$this->db->query("select * from class_tehsett where empid='$tech_id' and  years='$y'");
			if($q->num_rows()>0){
				echo "1";
			}
			else{
				echo "0";
			}
		}
		
		if(isset($_POST['chk_frox_tech'])){
			$tech_id=$_POST['chk_frox_tech'];
			$y=date("Y-m-d");
			$q1=$this->db->query("select * from class_tehsett where empid='$tech_id'");
			
			if($q1->num_rows()>0){ 
			
			echo "1"; 
			
			}
			else {  
			
			$q2=$this->db->query("select * from class_froxsett where empid='$tech_id' and  date='$y'");
			if($q2->num_rows()>0){
				echo "1";
			}
			else {
				echo "0";
			}
			
			}
		}
		
		if(isset($_POST['apply_id'])){
			$appid=$_POST['apply_id'];
			$query=$this->db->query("select * from application_tbl where appid='$appid'");
			
			$row=$query->num_rows();
			if($row>0){
				$info=$query->row();
				$where=array('years'=>date("Y"),'appctgid'=>$info->appctgid);
				$classid=$this->db->select("classid")->from("application_catg")->where($where)->get()->row()->classid;
				$section=$this->db->select("section")->from("class_catg")->where("classid",$classid)->get()->row()->section;
				
				$value=$info->name."|".$info->fName."|".$info->mName."|".$info->Phone_n."|".$info->email."|".$info->par_address."|".$info->	pre_address."|".$info->gender."|".$info->religion."|".$info->blood_grou."|".$info->city."|".$info->image."|".$classid."|".$section;
				echo $value;
			}
			else {
				echo  '0';
			}
		}
		
		
		if(isset($_POST['cls_name'])){
			extract($_POST);
			$cls=strtoupper(trim($cls_name));
			$s=strtoupper(trim($sec));
			$chk=$this->db->query("select section from class_catg where class_name='$cls'");
			if($chk->num_rows()<1){
				echo 1;
			}
			else {
				$chkv=$chk->row()->section;
				$exist_sec=explode(",",$chkv);
				if( in_array( $s ,$exist_sec ) ){
					echo 0;
				}
				else {
					echo 1;
				}
			}
		}
		
		if(isset($_POST['sec_cls'])){
			extract($_POST);
			//$sft;
			if($sec_cls!=''){
			$teacher=$this->db->query("select a.empid,a.name,a.emptypeid,b.emptypeid,b.type from empee a , emp_type  b
			where a.emptypeid=b.emptypeid
			and b.type='teacher'")->result();
			$section=$this->db->query("select section from class_catg where classid='$sec_cls'")->row()->section;
			$ex=explode(",",$section);
			$j=0;$t=count($ex);
			foreach($ex as $value){
			$chk_exist_sect=$this->db->query("select count(ctsid) as total from class_tehsett where classid='$sec_cls' and section='$value' and shiftid='$sft'")->row()->total;
			if($chk_exist_sect>0){
				$j++;
			}
			}
			if($j!=$t){
			
		?>
		
			<tr>
				<td colspan="2">
					<span style="font-size:16px;font-weight:bold;">Year</span>
					<select name="year" id="tech_year" class="form-control"  required>
						<option value="">Select</option>
						<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
						<option value="<?php echo date("Y")+1; ?>"><?php echo date("Y")+1; ?></option>
					</select>
				</td>
			</tr>
			<tr><td colspan="2" id="tech_exist_info"></td></tr>
			<tr class="active">
				<th>Section</th>
				<th>Teacher</th>
				<input type="hidden" id="hid_sec" value="<?php echo count($ex); ?>"/>
			</tr>
			<?php
			$i=1;
			foreach($ex as $value){
				$chk_exist_sect=$this->db->query("select count(ctsid) as total from class_tehsett where classid='$sec_cls' and section='$value' and shiftid='$sft'")->row()->total;
				if($chk_exist_sect>0){
					continue;
				}
				$i++;
			?>
			<tr>
				<td><input type="text" value="<?php echo $value; ?>" name="section[]" id="teach_section<?php echo $i; ?>" class="form-control" readonly /></td>
				
				<td>
					<select name="teach_name[]" id="tech_set<?php echo $i; ?>" onchange="exist_teacher_chk(<?php echo $sec_cls; ?>,tech_year.value,this.id,hid_sec.value,<?php echo $i; ?>,<?php echo $sft; ?>);" class="form-control" required>
					<option value="">Select Teacher</option>
					<?php 
					foreach($teacher as $tech_v){
					?>
					<option value="<?php echo $tech_v->empid; ?>"><?php echo $tech_v->name; ?></option>
					<?php 
					}
					?>
					</select>
				</td>
				
			</tr>
		<?php
		} 
		
		?>
		
		<?php
		}
		else {
			echo 'filup';
		}
		}
		else {
			echo 0;
		}
		
		}
		
		if(isset($_POST['tech'])){
			extract($_POST);
			$row=$this->db->query("select * from class_tehsett where years='$year' and empid='$tech' and shiftid='$sft'");
			if($row->num_rows()>0){
			$info=$this->db->query("select a.*,b.class_name,c.name,d.shift_N from class_tehsett a,class_catg b,empee c,shift_catg d where a.years='$year' and a.empid='$tech' and c.empid='$tech'
			and a.classid=b.classid and a.shiftid='$sft'")->row();	
			?>
				<table class="table table-condensed">
					<tr class="danger">
						<td>Teacher Name:</td>
						<td><?php echo $info->name; ?></td>
						<td>Shift Name:</td>
						<td><?php echo $info->shift_N; ?></td>
						<td>Class Name:</td>
						<td><?php echo $info->class_name; ?></td>
						<td>Section:</td>
						<td><?php echo $info->section; ?></td>
						<td>Session:</td>
						<td><?php echo $info->years; ?></td>
					</tr>
				</table>
			<?php
			}
			else {
			  	echo 1;
			}
				
		}
		
		if(isset($_POST['y_app'])){
			extract($_POST);
			if($y_app!=''){
			$t_crow=$this->db->select("*")->from("class_catg")->get()->result();
			
			if($this->db->affected_rows()==0){ echo "class khali"; exit; }
			
			$app_fee_set=$this->db->query("select * from class_catg where classid not in(select classid from
			application_catg where years='$y_app')")->result();
			$app_comp= $this->db->affected_rows();
			if($app_comp!=0){
			?>
			<tr class="active">
				<td>SL.No</td>
				<td>Class Name</td>
				<td>Fee</td>
				<td>Minimum GPA</td>
			</tr>
			
			
			<?php
			
			$app_fee=1;foreach($app_fee_set as $value){ ?>
			<tr>
				<td><?php echo $app_fee++; ?></td>
				<td>
					<input type="hidden" name="class_name[]" value="<?php echo trim($value->classid); ?>"/>
					<input type="text" class="form-control" value="<?php echo  trim($value->class_name); ?>" readonly />
				</td>
				<td>
					<input type="text" name="fee[]" class="form-control" id="fee" placeholder="Enter Fee" onkeypress="return isNumber(event)" />
				</td>
				<td>
					<input type="text" name="min_gpa[]" class="form-control" onchange="gpa_chk(this.id,this.value);" id="min_gpa_<?php echo $value->classid; ?> " placeholder="Enter GPA" maxlength="4" onkeypress="return isNumber(event)" />
				</td>
				
			</tr>
			<?php } ?>
			
			<tr>
			<td colspan="4">
				<center>
				<button type="submit" onclick="form_submit();" name="submit" class="btn btn-primary" data-toggle="tooltip" title="Save"><span class="glyphicon glyphicon-send"></span> Submit</button>&nbsp;&nbsp;
				<button type="reset" value="" class="btn btn-warning" id="reset" onclick="reset_content(this.value);" data-toggle="tooltip" title="Reset"><span class="glyphicon glyphicon-refresh"> Refresh</button>
				</center>
			  
			</td>
			</tr>
		<?php 	
		}
		else {
			?>
			<tr><td colspan="3" style="color:red;font-size:20px;text-align:center;">All Class Fee Setup Successfully Completed in Year <?php echo $y_app; ?></td></tr>
			<?php 
		}
		
		}
		else {
			echo 0;
		}
		
		}
		
		if(isset($_POST['sub_chk_cls'])){
			extract($_POST);
			//cls_name
			$chk_subject=$this->db->query("select subjid from subject_class where classid='$sub_chk_cls' and sub_name='$sub_chk'")->num_rows();
			if($chk_subject>0){
				echo 0;
			}
			else {
				echo 1;
			}
		}
		
		if(isset($_POST['cls_name_gpa'])){
			extract($_POST);
			//echo $cls_name_gpa;
			//echo $in_gpa;
			$y=date("Y");
			echo $chk_gpa=$this->db->query("select a.min_gpa,b.class_name from application_catg a, class_catg b where a.classid=b.classid and a.years='$y' and
			b.class_name='$cls_name_gpa'")->row()->min_gpa;
			
		}
		
		if(isset($_POST['te_ro_show'])){
			extract($_POST);
			$y=date("Y");
			
			$teacher=$this->db->query("select a.empid,a.name from empee a,emp_type b where a.emptypeid=b.emptypeid and a.empid!='$te_ro_show' and b.type='teacher'")->result();
			
			$routine=$this->db->query("select a.routineid,a.section,a.stime,a.etime,a.day,a.shiftid,b.class_name,c.shift_N,d.sub_name,e.name from routine a,class_catg b,shift_catg c ,subject_class d,empee e
			where a.year='$y' and teacherid='$te_ro_show' and a.status='0' and e.empid='$te_ro_show' and a.classid=b.classid and a.shiftid=c.shiftid and a.subjid=d.subjid");
			
			$row=$this->db->affected_rows();
			if($row>0){
			?>
				<table class="table table-hover table-condensed">
				<tr class="active">
				<th>SL.No</th>
				<th>Name</th>
				<th>Shift</th>
				<th>Class</th>
				<th>Section</th>
				<th>Subject</th>
				<th>Day</th>
				<th>Class Start</th>
				<th>Class End</th>
				<th>Proxy
				<input type="hidden" name="empid" value="<?php echo $te_ro_show; ?>"/>
				</th>
				</tr>
				<?php 
				$i=1;
				foreach($routine->result() as $value){	
				?>
				<tr>
				<td>
					<input type="hidden" name="routineid[]" value="<?php echo trim($value->routineid); ?>"/>
					<?php echo $i++; ?>
				</td>
				<td><?php echo $value->name; ?></td>
				<td>
					<input type="hidden" name="shiftid[]" value="<?php echo $value->shiftid; ?>"/>
					<?php echo $value->shift_N; ?>
				</td>
				<td>
					<?php echo $value->class_name; ?>
				</td>
				<td>
					<?php echo $value->section; ?>
				</td>
				<td>
					<?php echo $value->sub_name; ?>
				</td>
				<td>
					<input type="hidden" name="day[]" value="<?php echo $value->day; ?>"/>
					<?php echo $value->day; ?>
				</td>
				<td>
				<input style="display:none;" type="time" name="stime[]" value="<?php echo $value->stime; ?>"/>
				<?php echo date("h:i:A",strtotime($value->stime)); ?>
				</td>
				<td><?php echo date("h:i:A",strtotime($value->etime)); ?></td>
				<td>
				<select class="form-control" name="proxy_tech[]" id="tech_period_<?php echo $i; ?>" onchange="proxy_setting_test('<?php echo $value->shiftid; ?>','<?php echo $value->stime;?>','<?php echo $value->day; ?>','<?php echo $i; ?>',this.value);">
				<option value="">Select Proxy Teacher</option>
				<?php foreach($teacher as $v){
				?>
				<option value="<?php echo $v->empid; ?>"><?php echo $v->name; ?></option>
				<?php
				} ?>
				</select>
				</td>
				</tr>
				<?php 	
				}
				?>
				
				</table>
			</form>
			<?php 
			}
			
			else {
				echo 0;
			}
		}
		
		if(isset($_POST['sft_prox_tech'])) {
			extract($_POST);
			$y=date("Y");
			//sft_prox_tech:sft,prox_time:stime,prox_tech:sel_id
			$selected_routine=$this->db->query("select routineid from routine where shiftid='$sft_prox_tech' and stime='$prox_time' and teacherid='$emp' and day='$day' and year='$y' and status='0'");
			
			$row=$this->db->affected_rows();
			
			if($row>0){
				$routine=$this->db->query("select a.*,b.shift_N,c.class_name,d.sub_name,e.name from routine a,shift_catg b,class_catg c,subject_class d,empee e   where a.year='$y' and a.shiftid='$sft_prox_tech' and b.shiftid='$sft_prox_tech' and a.classid=c.classid and d.subjid=a.subjid and  a.teacherid='$emp' and day='$day' and a.status='0' and a.teacherid=e.empid")->result();
			?>
			<table class="table table-hover table-condensed">
				<tr class="warning">
					<th>SL.No</th>
					<th>Name</th>
					<th>Shift</th>
					<th>Class</th>
					<th>Section</th>
					<th>Subject</th>
					<th>Day</th>
					<th>Class Start</th>
					<th>Class End</th>
				</tr>
			<?php
			$i=1;
			
			foreach($routine as $value){
			?>
			<tr <?php if($value->routineid==$selected_routine->row()->routineid){ echo 'class="danger"';} ?>>
				<td><?php echo $i++; ?></td>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->shift_N; ?></td>
				<td><?php echo $value->class_name; ?></td>
				<td><?php echo $value->section; ?></td>
				<td><?php echo $value->sub_name; ?></td>
				<td><?php echo $value->day; ?></td>
				<td><?php echo $value->stime; ?></td>
				<td><?php echo $value->etime; ?></td>
			</tr>
			<?php
			}
			?>
			
			<?php 
			}
			else {
				echo "0";
			}
			$frox_routine=$this->db->query("select a.empid,b.*,c.name,d.shift_N,e.sub_name from class_froxsett a,routine b ,empee c,shift_catg d,subject_class e where a.routineid=b.routineid and a.years='$y' and b.year='$y' and a.status='0' and b.status='1' and b.teacherid='$emp' and c.empid='$emp' and b.shiftid='$sft_prox_tech'  and d.shiftid='$sft_prox_tech' and b.stime='$prox_time' and b.day='$day' and e.subjid=b.subjid");
			$row=$this->db->affected_rows();
			if($row>0){
			?>
			<tr>
				<td colspan="10" style="text-align:center;">Proxy Period</td>
			</tr>
			<?php 
			foreach($frox_routine as $value){
			?>
			
			<tr>
				<td><?php echo $i++; ?></td>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->shift_N; ?></td>
				<td><?php echo $value->class_name; ?></td>
				<td><?php echo $value->section; ?></td>
				<td><?php echo $value->sub_name; ?></td>
				<td><?php echo $value->day; ?></td>
				<td><?php echo $value->stime; ?></td>
				<td><?php echo $value->etime; ?></td>
			</tr>
			<?php } ?>
			</table>
			<?php 	
			}
			else {
				echo "0";
			}
			?>
			
			
			<?php 
				
		
		}

// End Ajax Request Function Body	
	}
	public function class_tech_ajax(){
		if(isset($_POST['cls'])){
			$clsid=$_POST['cls'];
			$section=$_POST['section'];
			$query=$this->db->query("select * from  class_tehsett where classid='$clsid' and section='$section'")->result();
			echo "<option value=''>select</option>";
			foreach($query as $v){
				$empid=$v->empid;
				?>
				<option value="<?php echo $v->ctsid; ?>"><?php echo $this->db->query("select name from empee where empid='$empid'")->row()->name; ?></option>
			<?php 	
			}
		}
	}
	
	
		public function class_catg_setting(){
		
		if(isset($_POST['submit'])){
			$class_name=strtoupper($this->input->post('class_name'));
		    $section=$this->input->post('section');
			$e_user=$this->session->userdata('userid');
			$e_date=date('Y-m-d h:s:a');
			$i=0;$j=0;$in=1;
			$push=array();
			$chk_class=$this->db->query("select * from class_catg where class_name='$class_name'");
			$row=$chk_class->num_rows();
			$ts=count($section);
			
			for($ts;$ts>=0;$ts--){
					$v=trim($section[$ts]);
					if($v!=''){
					array_push($push,strtoupper($v));
					}
				}
				
			$uniq=array_unique($push);
			
			if($row<1){
				
				foreach($uniq as $sec){
				$sec_v.=$sec.',';
				$i++;	
				}
				$sec_value=chop($sec_v,",");
				if($sec_value!=''){
				$data=array(
				'classid'=>'',
				'class_name'=>$class_name,
				'section'=>$sec_value,
				'e_date'=>$e_date,
				'e_user'=>$e_user,
				'up_date'=>'',
				'up_user'=>''
				);
				$insert=$this->db->insert('class_catg',$data);
				$in++;
				}
			}
			
			else {
				$exist_sec=$chk_class->row()->section;
				$explod=explode(",",$exist_sec);
				$j=0;
				foreach($uniq as $v){
					if(!(in_array(strtoupper($v),$explod))){
						$exist_sec.=','.strtoupper($v);
						$i++;
					}
					else{
						$j++;
					}	
				}
				
				
				
				$exist_section=chop($exist_sec,",");
				
				//$this->session->set_userdata($info1);
				$insert=$this->db->query("UPDATE class_catg SET section='$exist_section' WHERE class_name='$class_name'");
			}
			
			
			if($insert){
				$in++;
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			
			else {
				
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			
		}
		
	}
	
	public function shift_setting(){
		
		if(isset($_POST['submit'])){
			$shift=$this->input->post('shift');
			$s=trim($shift);$in=1;
			$chk=$this->db->query("select shiftid from shift_catg where shift_N='$s'")->num_rows();
			if($chk!=0){
				$msg=array('in'=>$in);
			    $this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			if($s=='') {
				$msg=array('in'=>$in);
			    $this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
				}
			$e_user=$this->session->userdata('userid');
			$e_date=date('Y-m-d h:s:a');
			
			$data=array(
				'shiftid'=>'',
				'shift_N'=>strtoupper($s),
				'e_date'=>$e_date,
				'e_user'=>$e_user,
				'up_date'=>'',
				'up_user'=>''
				);
			$insert=$this->db->insert("shift_catg",$data);
			if($insert){
				$in++;
				$msg=array('in'=>$in);
			    $this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			else {
				redirect('student_section/level_1_setting','location');
			}
			
		}
		
		if(isset($_POST['submit_edit'])) {
		
	    $shift=trim($this->input->post('shift'));
		$shiftid=$this->input->post('shiftid');
		$old_shift=$this->input->post('old_shift');
		$up_user=$this->session->userdata('userid');
		$up_date=date('Y-m-d h:s:a');$up=1;
		if($shift==''){
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_edit/shift_setting?id='.$shiftid,'location');
			}
		
		$data=array(
		'shift_N'=>strtoupper($shift),
		'up_user'=>$up_user,
		'up_date'=>$up_date
		);
		
		$this->db->where('shiftid', $shiftid);
		$update=$this->db->update('shift_catg' ,$data);
		
		if($update){
			$up++;
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_section/level_1_setting','location');	
		}
		
	}
		
		
		
	}
	
	
	public function version_setting() {
		
		if(isset($_POST['submit'])){
			$version=$this->input->post('version',true);
			$v=trim($version);$in=1;
			if($v==''){
				$msg=array('in'=>$in);
			    $this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location'); 
			}
			
			$chk=$this->db->query("select verid from version_catg where version_N='$v'")->num_rows();
			if($chk!=0)
			{ 
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);
			redirect('student_section/level_1_setting','location'); 
			}
			$e_user=$this->session->userdata('userid');
			$e_date=date('Y-m-d h:s:a');
			$data=array(
				'verid'=>'',
				'version_N'=>strtoupper($v),
				'e_date'=>$e_date,
				'e_user'=>$e_user,
				'up_date'=>'',
				'up_user'=>''
				);
			$insert=$this->db->insert('version_catg',$data);
			if($insert){
				$in++;$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			else{
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
		}
		
		if(isset($_POST['submit_edit'])) {
		
	    $version=trim($this->input->post('version'));
		$verid=$this->input->post('verid');
		$old_version=$this->input->post('old_version');
		$up_date=date("Y-m-d h:s:a");
		$up_user=$this->session->userdata('userid');
		$up=1;
		if($version==''){
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_edit/version_setting?id='.$verid,'location'); 
			}
		$data=array(
		'version_N'=>strtoupper($version),
		'up_date'=>$up_date,
		'up_user'=>$up_user
		);
		
		$this->db->where('verid', $verid);
		$update=$this->db->update('version_catg' ,$data);
		if($update){
			$up++;
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_section/level_1_setting','location');
		}
		
		}
		
	}
	
	
	public function subject_setting()  {
		
		if(isset($_POST['submit'])) {
			$class_name=trim($this->input->post('class_name'));
			$exam_mark=$this->input->post('exam_mark');
			$theo_mrk=$this->input->post('theo_mrk');
			$prac_mark=$this->input->post('prac_mark');
			$ex_mark=$this->input->post('ex_mark');
			$sub=$this->input->post('sub_name');
			$sub_seq=$this->input->post('sub_seq');
			$e_date=date('Y-m-d h:s:a');
			$e_user=$this->session->userdata('userid');
			$exist_sub=array();$in=1;
			$i=count($exam_mark);
			if($class_name==''){ 
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);
			redirect('student_section/level_1_setting','location'); 
			}
			for($j=0;$j<$i;$j++) {
				
				$sub_name=strtoupper($sub[$j]);
				$select=$this->db->query("select * from subject_class where classid='$class_name' and sub_name='$sub_name'");
				
				$row=$select->num_rows();
				
				if($row<1) {
					
					$total=$theo_mrk[$j]+$ex_mark[$j]+$prac_mark[$j];
					
					if($total==$exam_mark[$j]){
					$in++;
			        $insert=$this->db->query("insert  into  subject_class  values('','$class_name','$sub_name','$exam_mark[$j]','$theo_mrk[$j]','$ex_mark[$j]','$prac_mark[$j]','$sub_seq[$j]','','','$e_date','$e_user','','')");
					}
					else {
						
					}
				  
				}
				else {
					
				$sub_id=$select->row()->subjid;

				  array_push($exist_sub,$sub_id);
					
					$nins++;
				}
			
			}
		
		if(($in>1) || ($in==1)) {
				
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
		}
		
		}
		
		
		if(isset($_POST['submit_edit'])){
			extract($_POST);
			$up_user=$this->session->userdata("userN");
			$up_date=date("Y-m-d h:s:a");
			$sub=strtoupper(trim($sub_name));
			$exam=trim($exam_mark);
			$theo=trim($theo_mrk);
			$ex=trim($ex_mark);
			$prac=trim($prac_mark);
			$total=$prac+$ex+$theo;
			$up=1;
			if(($sub=='')||($exam=='')|| ($theo=='')){
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/subject_setting?id='.$subjid."&class_name=".$classid,'location');
			}
			elseif($exam!=$total){
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/subject_setting?id='.$subjid."&class_name=".$classid,'location');
			}
			
			$update=$this->db->query("UPDATE subject_class SET sub_name='$sub', exm_mark='$exam',stherory_mk='$theo',sobj_mk='$ex',sprack_mk='$prac',up_date='$up_date',up_user='$up_user' where subjid='$subjid'");
			
			if($update){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
			else {
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/level_1_setting','location');
			}
		}
		
		
		
	}
	
	public function class_routine_setting(){
		
		if(isset($_POST['submit'])){
			$class_name=$this->input->post('class_name');
			//$total_class=$this->input->post('total_class');
			$shiftid=$this->input->post('shiftid');
			$stime=$this->input->post('stime');
			$in=1;
			$i=count($class_name);
			
			$e_user=$this->session->userdata('userid');
			
			
			$today=date('Y-m-d h:s:a');
			
			for($j=0;$j<$i;$j++) {
				
				if(($shiftid!='') && ($class_name!='') && ($stime[$j]!='') ) {
					
				$data=array(
				'id'=>'',
				'shiftid'=>$shiftid,
				'classid'=>$class_name[$j],
				'stime'=>$stime[$j],
				'e_date'=>$today,
				'e_user'=>$e_user,
				'up_date'=>'',
				'up_user'=>''
				);
				$class_id=$class_name[$j];
				
				$chk=$this->db->query("select * from routine_sett where classid='$class_id' and shiftid='$shiftid'");
				$row=$chk->num_rows();
				
				if($row<1){
				$insert=$this->db->insert('routine_sett',$data);
				$in++;
				}
				
				else {
					
					
				}
			}
			else {
				
			}
			
			
			}
			
			if(($in==1) || ($in>1)){
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location');
			}
			else {

			}
	}
	
	if(isset($_POST['submit_edit'])){
		extract($_POST);
		$up_date=date("Y-m-d h:i:A");
		$up_user=$this->session->userdata('userid');
		$up=1;
		if(trim($stime)==''){
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_edit/class_routine_setting?id='.$up_id,'location');
		}
		$data=array(
		'stime'=>$stime,
		'up_user'=>$up_user,
		'up_date'=>$up_date
		);
		$this->db->where('id',$up_id);
		$update=$this->db->update("routine_sett",$data);
		if($update){
			$up++;
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_section/level_2_setting','location');
		}
		else {
			$msg=array('up'=>$up);
			$this->session->set_userdata($msg);
			redirect('student_edit/class_routine_setting?id='.$up_id,'location');
		}
	}
	
	
	}
	
	
	public function class_routine(){
		
		if(isset($_POST['submit'])){
			extract($_POST);
			$edate=date('Y-m-d h:i:s');
			$user=$this->session->userdata('userid');
			//$year=date('Y');
			$c=count($s_time);
			$j=$c-1;$i=0;$d=0;$in=1;
			
//-----------------exist routine validation chk start-----------------------			
			$chk=$this->db->query("select * from routine where year='$year' and shiftid='$shift' and classid='$cls_name' and section='$section'")->num_rows();
			if($chk>0){
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
			}
//-----------------exist routine validation chk End-----------------------			
			foreach($_POST['sub_name'] as $cnt=>$sub_name){	
				if($i>$j){
					
					$d++;$i=0;
					
//subject validation start--------------------------
				
//subject validation End----------------------------	
					
				}
				
			    $st=$_POST['s_time'][$i];
			    $et=$_POST['e_time'][$i];
				
			
				
			    $sql=$this->db->query("insert into routine(classid,section,subjid,shiftid,teacherid,day,stime,etime,year,status,e_date,e_user,up_user) values('$cls_name','$section','$sub_name','$shift','".$_POST['teach_name'][$cnt]."','".$_POST['days'][$d]."','".$st."','".$et."','$year','0','$edate','$user','')");
				
				$i++;
			
			}
			
			if($sql){
				$in++;
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
				
			}
			else {
				$in++;
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
				
			}
			
		}
		
		if(isset($_POST['submit_edit'])){
			extract($_POST);
			$udate=date('Y-m-d h:i:s');
			$upuser=$this->session->userdata('userid');
			$up=1;
			$where=array('section'=>$section,'classid'=>$cls_name,'shiftid'=>$shift);
			$select=$this->db->select("routineid")->from("routine")->where($where)->get()->result();
			//$year=date("Y");
			$c=count($s_time);
			$j=$c-1;$i=0;$d=0;$total=count($select);
			$y=date("Y");

			for($k=0;$k<$total;$k++){	
				if($i>$j){
					$d++;$i=0;
				}
				$up_array=array(
				'subjid'=>$sub_name[$k],
				'teacherid'=>$teach_name[$k],
				'day'=>$days[$d],
				'stime'=>$s_time[$i],
				'etime'=>$e_time[$i],
				'year'=>$year,
				'up_date'=>$udate,
				'up_user'=>$upuser
				);
				$this->db->where("routineid",$row_id[$k]);
				$update=$this->db->update("routine",$up_array);
				$i++;
			}
			
			if($update){
				$up++;
				$msg=array(
				'up'=>$up
				);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
			}
			else {
				$up++;
				$msg=array(
				'up'=>$up
				);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
			}
		}
	   	 
	}
	
	
	public function class_tech_setting() {
		if(isset($_POST['submit'])){
			$teach_name=$this->input->post('teach_name');
			$class_name=$this->input->post('class_name');
			$shiftid=$this->input->post('shiftid');
			$section=$this->input->post('section');
			$year=$this->input->post('year');
			$e_user=$this->session->userdata('userid');
			$e_date=date('Y-m-d h:s:a');
			$i=count($section);
			$in=1;
			for($j=0;$j<$i;$j++) {
			if((trim($teach_name[$j])!='') && (trim($class_name)!='') && ($section[$j]!='') && (trim($year)!='')){
			$data=array(
			'ctsid'=>'',
			'empid'=>$teach_name[$j],
			'shiftid'=>$shiftid,
			'classid'=>$class_name,
			'section'=>$section[$j],
			'years'=>$year,
			'status'=>'1',
			'e_date'=>$e_date,
			'e_user'=>$e_user,
			'up_date'=>' ',
			'up_user'=>' '
			);
			
			$tech_chk=$this->db->query("select * from class_tehsett where years='$year' and empid='$teach_name[$j]' and shiftid='$shiftid'");
			
			$tech_row=$tech_chk->num_rows();
			
			if($tech_row<1){
				$cls_chk=$this->db->query("select * from class_tehsett where classid='$class_name' and section='$section[$j]' and shiftid='$shiftid'");
				if($cls_chk->num_rows()<1){
				$insert=$this->db->insert("class_tehsett",$data);
				if($insert){
				$in++;
				}
				else {
					
				}
			}
			else {
				
			}
			}
			else {
				
			}
		}
		
		else {
			
		}
		
		}
		
		if($in==1 || $in>1){
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);
			redirect('student_section/level_2_setting','location');
			
		}
		
		}
		
		
		if(isset($_POST['submit_edit'])){
			extract($_POST);
			$up_date=date("Y-m-d h:s:a");
			$up_user=$this->session->userdata("userN");
			$up=1;
			if(trim($shiftid)=='' || trim($class_name)=='' || trim($teach_name)=='' || trim($year)==''){
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/class_tech_setting?id='.$ctsid."&y=".$year,'location');
			}
			$data=array(
			'empid'=>$teach_name,
			'up_date'=>$up_date,
			'up_user'=>$up_user
			);
			$chk_teacher=$this->db->query("select * from class_tehsett where empid='$teach_name' and shiftid='$shiftid' and years='$year'");
			$row=$chk_teacher->num_rows();
			if($row<1){
			$this->db->where("ctsid",$ctsid);
			$update=$this->db->update("class_tehsett",$data);
			}
			else {
				
			}
			if($update){
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect("student_section/level_2_setting","location");
			}
			else {
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_edit/class_tech_setting?id='.$ctsid."&y=".$year,'location');
			}
		}
		
		
	}
	
	public function class_tech_frox_setting(){
		if(isset($_POST['submit'])){
			$in=1;
			extract($_POST);
			if((trim($fsdate)=='') || (trim($fedate)=='') )
			{	
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location'); 
			}
			$sdate=date("Y-m-d",strtotime($fsdate));
			$edate=date("Y-m-d",strtotime($fedate));
			$year=date("Y");$e_date=date('Y-m-d h:s:a');$status=0;
			$e_user=$this->session->userdata('userid');
			
			$i=count($routineid);

			for($j=0;$j<$i;$j++){
			if($proxy_tech[$j]!='' && $routineid[$j]!=''){
				
			//------------------exist teacher condition chk start-------------
			
			$where=array('year'=>$year,'shiftid'=>$shiftid[$j],'day'=>$day[$j],'stime'=>$stime[$j],'teacherid'=>$proxy_tech[$j]);
			
			$row1=$this->db->select("routineid")->from("routine")->where($where)->get()->num_rows();
			
		    $row2=$this->db->query("select a.empid from class_froxsett a,routine b where a.routineid='$routineid[$j]' and b.routineid='$routineid[$j]' and a.status='0' and b.status='1' and a.years='$year' and b.year='$year' and b.shiftid='$shiftid[$j]' and b.stime='$stime[$j]' and b.day='$day[$j]' and b.teacherid='$proxy_tech[$j]'")->num_rows();
			
			//------------------exist teacher condition chk End-------------
			if(($row1==0) && ($row2==0)){
			$this->db->query("update routine set status='1' where routineid='$routineid[$j]'");
			$data=array(
			'froxid'=>'',
			'empid'=>$proxy_tech[$j],
			'routineid'=>$routineid[$j],
			'years'=>$year,
			'status'=>$status,
			'fsdate'=>$sdate,
			'fedate'=>$edate,
			'e_date'=>$e_date,
			'e_user'=>$e_user,
			'up_date'=>'',
			'up_user'=>''
			);
			
			$insert=$this->db->insert('class_froxsett',$data);
			$in++;
			}
			}
			}
			
			
			if($in==1 || $in>1){
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location');
			}
			else {
				$msg=array('in'=>$in);
				$this->session->set_userdata($msg);
				redirect('student_section/level_2_setting','location');
			}
		}
	}
	
	public function attendance() {
			$present=array();
			$chk_box=$this->input->post('chk_box');
			$stu_id=$this->input->post('stu_id');
			$date=date("Y-m-d");
			$e_date=date('Y-m-d h:s:a');
			$e_user=$this->session->userdata('userid');
		    $class_name=$this->input->post('cls_name');
		    $section=$this->input->post('section');
		    $shift=$this->input->post('shift');
			$status="1";
			$i=1;
			
			for($j=0;$j<=count($stu_id);$j++) {
				
				if(in_array($stu_id[$j], $chk_box)){
					array_push($present,$stu_id[$j]);
				}
			}
			
			
			$a=count($present);
			for($k=0;$k<=$a-1;$k++) {
				
				$ex=explode('/',$present[$k]);
				$val_id.=$ex[0].",";
				$val_rol.=$ex[1].",";
				
				$i++;
			}
			
			$student_id=chop($val_id,",");
			
			$roll=chop($val_rol,",");
			
			$data=array(
			 'stu_id'=>$student_id,
			 'shiftid'=>$shift,
			 'classid'=>$class_name,
			 'section'=>$section,
			 'roll_no'=>$roll,
			 'date'=>$date,
			 'status'=>$status,
			 'e_date'=>$e_date,
			 'e_user'=>$e_user
			 );
				 
			$insert=$this->student->all_insert("attendance",$data);
				
			if($insert){
				echo 1;
			}
			else 
			{
				echo "Data Not Save";
			}
		
		
	}
	
	public function attendance_edit() {
		
		if(isset($_POST['submit_edit'])){
			$present=array();
			$chk_box=$this->input->post('chk_box');
			$stu_id=$this->input->post('stu_id');
			$name=$this->input->post('name');
			$roll_no=$this->input->post('roll_no');
			$date=date("Y-m-d");
			
			$up_date=date("Y-m-d h:s:a");
			$up_user=$this->session->userdata('userid');
			
		    $class_name=$this->input->post('cls_name');
		    $section=$this->input->post('section');
		    $shift=$this->input->post('shift');
			$status="1";
			$i=1;
			
			
			for($j=0;$j<=count($stu_id);$j++) {
				
				if(in_array($stu_id[$j], $chk_box)){
					array_push($present,$stu_id[$j]);
					
				}
			}
			
			$a=count($present);
			for($k=0;$k<=$a-1;$k++){
				
				$ex=explode('/',$present[$k]);
				$val_id.=$ex[0].",";
				$val_rol.=$ex[1].",";
				$i++;
			}
			
			$student_id=chop($val_id,",");
			$roll=chop($val_rol,",");
			
			$data=array(
				 'stu_id'=>$student_id,
				 'roll_no'=>$roll,
				 'up_date'=>$up_date,
				 'up_user'=>$up_user
				 );
				 
			 $where=array(
				'date'=>$date,
				'classid'=>$class_name,
				'shiftid'=>$shift,
				'section'=>$section
				);
			
			$up=$this->student->all_update($where,"attendance",$data);
				
			if($up)
			{
				echo 1;
			}
			else 
			{
				echo "Data Not Update";
			}
			
		}
	
	}
	
	
	public function guardian_edit()
	{
		extract($_POST);
		
		//validations start
		if(trim($upid)=='') { echo "Gardian id is Empty";exit; }
		if(trim($ugname)=='') { echo "Gardian Name is Empty";exit; }
		if(trim($uemail)=='') { echo "Email id is Empty";exit; }
		if(trim($umobile)=='') { echo "mobile id is Empty";exit; }
		//validation end
		
		$where=array('parentid'=>$upid);
		$data=array('name'=>$ugname,'email'=>$uemail,'phonen'=>$umobile);
		$action=$this->student->all_update($where,'father_login',$data);
		
		if($action)
		{
			echo 1;
		}
		else 
		{
			echo "Data Not Update";
		}
	}
	
	public function online_status(){
		if(isset($_POST['submit_edit'])){
			$status=$this->input->post('submit_edit');
			$up=1;
			$up_user=$this->session->userdata('userid');
			$up_date=date('Y-m-d h:s:a');
			
			$data=array(
			'id'=>'',
			'status'=>$status,
			'up_date'=>$up_date,
			'up_user'=>$up_user
			);
			
			$select=$this->db->query("select * from  online_status");
			$row=$select->num_rows();
			$result=$select->row();
			$s_result=$result->status;
			
			if($row<1){
				$insert=$this->db->insert('online_status',$data);
				$up++;
				$msg=array('up'=>$up);
				$this->session->set_userdata($msg);
				redirect('student_section/online_status','location');
				}
			else {
				
				if(($status=='1') && ($s_result=='1')){
					$up++;
					$msg=array('up'=>$up);
					$this->session->set_userdata($msg);
					redirect('student_section/level_1_setting','location');
				}
				else if(($status=='1') && ($s_result=='0')){
					$up++;
					$msg=array('up'=>$up);
					$this->session->set_userdata($msg);
					$this->db->query("update online_status set status='1'");
					
					redirect('student_section/level_1_setting','location');
				}
				else if(($status=='0') && ($s_result=='1')){
					$up++;
					$msg=array('up'=>$up);
					$this->session->set_userdata($msg);
					$this->db->query("update online_status set status='0'");
					redirect('student_section/level_1_setting','location');
				}
				else if(($status=='0') && ($s_result=='0')){
					$up++;
					$msg=array('up'=>$up);
					$this->session->set_userdata($msg);
					redirect('student_section/level_1_setting','location');
				}
			}	
			
		}
		
		else {
			
			$status=$this->input->post('status');
			$e_user=$this->session->userdata('userid');
			$e_date=date('Y-m-d h:s:a');
			$in=1;
			$data=array(
			'id'=>'',
			'status'=>$status,
			'e_date'=>$e_date,
			'e_user'=>$e_user,
			'up_date'=>'',
			'up_user'=>''
			);
			
			$insert=$this->db->insert('online_status',$data);
			if($insert){
			$in++;
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);	
			redirect('student_section/level_1_setting','location');
			}
			else {
			$msg=array('in'=>$in);
			$this->session->set_userdata($msg);	
			redirect('student_section/level_1_setting','location');	
			}
		}
	}
	
	
	//<!---------------student section end---------------------->
	
	
 
	
	// ------------------------libary section End----------------------------
	public function image_upload() {
		if(isset($_POST)) {  
		
		echo $_FILES['img']['tmp_name'];
		
		}
	//	echo $sourcePath = $_FILES['file']['tmp_name'];
	
	}
	
	public function class_tech_chk(){
		if(isset($_POST['empid'])){
			extract($_POST);
			$query=$this->db->query("select * from class_tehsett where empid='$empid' and shiftid='$cts_sft' and years='$cts_y'");
			$row=$query->num_rows();
			if($row>0){
				$info=$this->db->query("select a.section,b.name,c.class_name,d.shift_N,a.years from class_tehsett a,empee b,class_catg c,shift_catg d where
				a.years='$cts_y' and a.empid='$empid' and b.empid='$empid' and a.classid=c.classid and a.shiftid=d.shiftid")->result();
			?>
			<table class="table table-bordered">
				<tr class="success">
					<td>SL.No</td>
					<td>Teacher Name</td>
					<td>Shift Name</td>
					<td>Class Name</td>
					<td>Section</td>
					<td>Year</td>
				</tr>
				<?php $i=1; foreach($info as $value){
				?>
				<tr>
					<td><?php echo $i++; ?></td>
					<td><?php echo $value->name; ?></td>
					<td><?php echo $value->shift_N; ?></td>
					<td><?php echo $value->class_name; ?></td>
					<td><?php echo $value->section; ?></td>
					<td><?php echo $value->years; ?></td>
				</tr>
				<?php 
				}
				?>
			</table>
			<?php 
			}
			else {
				echo 1;
			}
		}
	}
	
	public function admission_cancel()
	{
		extract($_POST);
		$where=array('stu_id'=>$sid);
		$data=array('status'=>0);
		$up=$this->student->all_update($where,'re_admission',$data);
		if($up) { echo 1;exit; } else { echo "Not Cancel";exit; }
	}
	
	// ------------------------Start Employee Section-------------------------------->
	
	//------------------ End Employee Section------------------------------>
}