<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class userpanel extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		
		if($stid=='' || $stsid=='')
		{
		   redirect('login?error=2','location');
		}
		
		$this->load->model('userpanel_mod','usermod');
		
		
		
		}
	public function user_registations(){		
		$this->load->view('other/user_registation');		
	}
	public function school_profile(){
		$data=array();
		$sql=$this->db->query("select * from sprofile order by id ASC LIMIT 1");
		$data['row']=$sql->row();
		$this->load->view('other/school_profile',$data);
	}
		public function profile_upload()
		{
			$this->load->view('other/profile_upload');
		}
		public function userImg()
		{
			 $config['upload_path'] = 'img/';
				  $config['allowed_types'] = 'gif|jpg|png';
				  $config['max_size'] = '1000';
				  $config['max_width']  = '600';
				  $config['max_height']  = '600';
                          $this->load->library('upload', $config);
                         $this->upload->initialize($config);    
			
	       if($this->upload->do_upload()){
	            $fata=array('upload_data'=>$this->upload->data());
	            $path='img/'.$fata['upload_data']['orig_name'];
			}
		}

public function school_profile_update(){
	$user=$this->session->userdata("userid");	
	extract($_POST);
	  
	  $config['upload_path'] = 'img/document/school_logo/';
	  $config['allowed_types'] = 'gif|jpg|png';
	  $config['max_size'] = '1000';
	  $config['max_width']  = '600';
	  $config['max_height']  = '600';
	  
	  $this->load->library('upload', $config);
	  $this->upload->initialize($config);    			
		
		
		   
	   if($this->upload->do_upload()){
	  
			$fata=array('upload_data'=>$this->upload->data());
			$path=$fata['upload_data']['orig_name'];
			
			$data=array(
			'id'=>$idschol,
			'schoolN'=>$schName,
			'address'=>$schaddress,
			'phone'=>$phonenumber,
			'mobile'=>$mobilenumber,
			'email'=>$emailaddress,
			'logo'=>$path,
			'up_user'=>$user
			);
	   }else{
	  
			$data=array(
			'id'=>$idschol,
			'schoolN'=>$schName,
			'address'=>$schaddress,
			'phone'=>$phonenumber,
			'mobile'=>$mobilenumber,
			'email'=>$emailaddress,
			'up_user'=>$user
			);				
		}			
			$upsql=$this->usermod->upschoolprofile($data);
			redirect('userpanel/school_profile');			
	}

	public function user_registation_insert(){
			extract($_POST);
			$salname=$this->db->query("select * from user_reg where userN='$username' LIMIT 1");
				if($this->db->affected_rows()>0){ echo "2"; exit;}	
				$this->load->library('form_validation');
				$this->form_validation->set_rules('username', 'Please Minimum 3 Character & alpha dash not allow', 'required|min_length[3]|max_length[50]|is_unique[user_reg.userN]|alpha_dash');
					 if ($this->form_validation->run() ==FALSE)
					{
						echo '3'; exit;
					}
				$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[confirmpass]|');
				$this->form_validation->set_rules('confirmpass', 'Password Confirmation', 'trim|required');
			   if ($this->form_validation->run() ==FALSE)
				{
					echo '4'; exit;
				}
				
			$edate=date('Y-m-d h:s:a');
			$user=$this->session->userdata("userN");			
			$data=array(
			'ruleid'=>$rulename,
			'userN'=>$username,
			'fullname'=>$fullname,
			'logpass'=>$password,
			'phone'=>$phonenumber,
			'email'=>$emailadd,
			'status'=>'0',
			'sId'=>'',
			'e_date'=>$edate,
			'e_user'=>$user,
			'up_user'=>''
			);
			$status=$this->usermod->userReginsert($data);
			if($status==1){
				echo '1';exit;
				//redirect("userpanel/user_registations") ;
			}
			else{
				echo "Data insert not successfully";exit;
			}
		}
		public function show_registation(){
			$data=array();
			$sql=$this->db->query("select * from user_reg");
			$data['query']=$sql->result();
			$this->load->view('other/view_registation',$data);
		}
		
		
		public function change_password()
		{
		 	
		  $this->load->view('other/change_password');
		}
		
		public function change_password_submit()
		{
		  //print_r($_POST);
		  extract($_POST);
		  $uid=$this->session->userdata('userid');
		  $exist_pass=$this->db->query("select * from user_reg  where userid='$uid'")->row();
		  if($exist_pass->logpass!=$old_password) { echo "Old Password is Wrong";exit; }
		  if($password!=$confirmpass) { echo "Password Not Match";exit; }
		  
		  $where=array('userid'=>$uid);
		  $data=array('logpass'=>$password);
		  
		  $this->db->where($where);
		  $up=$this->db->update('user_reg',$data);
		  if($up) { echo 1;exit; } else { echo "Not Update"; } 
		   
		}
		
			public function registaion_edit(){
				extract($_GET);	
				$data=array();
				$data['query']=$this->db->query("SELECT * FROM user_reg WHERE userid='$reg'")->row();
				$this->load->view('other/edit_user_registation',$data);
			}
			public function edit_registaions(){
				
			extract($_POST);		
			$edate=date('Y-m-d h:s:a');
			$update=date('Y-m-d H:i:s');
			$user=$this->session->userdata("userN");			
			$data=array(
			'userid'=>$userid,
			'ruleid'=>$rulename,
			'fullname'=>$fullname,
			'logpass'=>$password,
			'phone'=>$phonenumber,
			'email'=>$emailadd,
			'up_date'=>$update,
			'up_user'=>$user,
			);
			
			$status=$this->usermod->editReginsert($data);
			if($status==1){
				echo '1';exit;
			}
			else{
				echo "Data Update not successfully";exit;
			}
			}
			
			public function school_commitee()
			{
				$this->load->view('header');
				$this->load->view('leftbar');
				$this->load->view('other/school_commitee');
				$this->load->view('footer');
			}
			
			public function school_commitee_entry()
			{
				//print_r($_POST);
				extract($_POST);
				$e_user=$this->session->userdata('userid');
				//validation start
				$pic=$_FILES['picture']['name'];
				if(trim($sname)=='') { echo "Applicant Name is Empty";exit; }	
				if(trim($mname)=='') { echo "Mother Name is Empty";exit; }	
				if(trim($fname)=='') { echo "Fother Name is Empty";exit; }	
				if(trim($gender)=='') { echo "Gender is Empty";exit; }	
				if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }	
				if(trim($par_address)=='') { echo "Permanent Address is Empty";exit; }
				if(trim($desig)=='') { echo "Designation is Empty";exit; }
				if(trim($phone)=='') { echo "Mobile No is Empty";exit; }
				if(trim($pic)=='') { echo "Picture is Empty";exit; }	
				
				//validation end
				
				$des="img/school_commitee/".$pic;	
				$tmp_name=$_FILES['picture']['tmp_name'];
				copy($tmp_name,$des);
				
				$data=array(
				'name'=>$sname,
				'fname'=>$fname,
				'mname'=>$mname,
				'mobile'=>$phone,
				'email'=>$email,
				'gender'=>$gender,
				'designation'=>$desig,
				'per_address'=>$par_address,
				'pre_address'=>$pre_address,
				'picture'=>$pic,
				'e_user'=>$e_user
				);
				
				$ac=$this->db->insert('manageing_commitee',$data);
				if($ac){ echo 1;exit; } else { echo "Data Not Save";exit; }
			}
			
			public function commitee_details()
			{
				extract($_POST);
				$info=$this->db->select("*")->from("manageing_commitee")->where("memberid",$mid)->get()->row();
				//print_r($info);
			?>
			<table class="table table-condensed">
				<tr>
					<td colspan="4"><img src="img/school_commitee/<?php echo $info->picture; ?>" class="img-thumbnil" height="100" width="100"/></br> <b>Designation:</b> <?php echo $info->designation; ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Name:</td>
					<td><?php echo $info->name; ?></td>
					<td style="font-weight:bold;">Father Name:</td>
					<td><?php echo $info->fname; ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Mother Name:</td>
					<td><?php echo $info->mname; ?></td>
					<td style="font-weight:bold;">Gender:</td>
					<td><?php echo $info->gender; ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Mobile:</td>
					<td><?php echo $info->mobile; ?></td>
					<td style="font-weight:bold;">Email:</td>
					<td><?php echo $info->email; ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Parmanent Address:</td>
					<td><?php echo $info->per_address; ?></td>
					<td style="font-weight:bold;">Present Address:</td>
					<td><?php echo $info->pre_address; ?></td>
				</tr>
			</table>
			<?php 
			}
			
			public function commitee_edit()
			{
				$this->load->view('header');
				$this->load->view('leftbar');
				$this->load->view('other/commitee_edit');
				$this->load->view('footer');
			}
			
			public function  school_commitee_edit()
			{
				extract($_POST);//print_r($_POST);exit;
				$e_user=$this->session->userdata('userid');
				//validation start
				$pic=$_FILES['picture']['name'];
				if(trim($sname)=='') { echo "Applicant Name is Empty";exit; }	
				if(trim($mname)=='') { echo "Mother Name is Empty";exit; }	
				if(trim($fname)=='') { echo "Fother Name is Empty";exit; }	
				if(trim($gender)=='') { echo "Gender is Empty";exit; }	
				if(trim($pre_address)=='') { echo "Present Address is Empty";exit; }	
				if(trim($par_address)=='') { echo "Permanent Address is Empty";exit; }
				if(trim($desig)=='') { echo "Designation is Empty";exit; }
				if(trim($phone)=='') { echo "Mobile No is Empty";exit; }
				$info=$this->db->select("*")->from("manageing_commitee")->where("memberid",$hid_id)->get()->row();
				
					
				
				//validation end
				if(!(trim($pic)=='')) {
				$des="img/school_commitee/".$pic;
				//unlink("img/school_commitee/".$info->picture);
				$tmp_name=$_FILES['picture']['tmp_name'];
				copy($tmp_name,$des);
				$pic=$_FILES['picture']['name'];
				}
				else 
				{
				$pic=$info->picture;	
				}
				
				$data=array(
				'name'=>$sname,
				'fname'=>$fname,
				'mname'=>$mname,
				'mobile'=>$phone,
				'email'=>$email,
				'gender'=>$gender,
				'designation'=>$desig,
				'per_address'=>$par_address,
				'pre_address'=>$pre_address,
				'picture'=>$pic,
				'e_user'=>$e_user
				);
				
				$this->db->where('memberid',$hid_id);
				$ac=$this->db->update('manageing_commitee',$data);
				//echo "ekhane";exit;
				if($ac){ echo 1;exit; } else { echo "Data Not Save";exit; }
			}
			
			public function commitee_sms()
			{
				extract($_POST);
				$txt=urlencode($messages);
				$commitee=$this->db->select("*")->from("manageing_commitee")->get()->result();
				if($type=='all')
				{
					foreach($commitee as $row) 
					{
					$mobile=$row->mobile;
					$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
					file_get_contents($url);
				
					}
					echo 1;exit;
				}
				else 
				{
					$mobile=$type;
					$url="http://datacenter.com.bd/dcbmain/index.php/smsapi?user=mob&pass=mob123&key=mafiapaglo2lumia8787ADFDFER&mobile=$mobile&msg=$txt";
					file_get_contents($url);
					echo 1;exit;
				}
			}
			
}	
	?>