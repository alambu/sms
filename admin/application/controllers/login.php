<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
		if(isset($_POST['submit'])){
			
			$userN=$this->input->post('userid');
			$logpass=$this->input->post('password');
			if(($userN=='') && ($logpass=='')){
				redirect('login?id=1','location');
			}
			
			else if(($userN=='') || ($logpass=='')){
				redirect('login?id=2','location');
			}
			
			else{
			$query=$this->db->query("select * from user_reg where userN='$userN' and logpass='$logpass' limit 1");
			
			$row=$query->row();
			//$this->db->last_query();exit;
			if($this->db->affected_rows()<1){
				redirect('login?id=4','location');
			}
			else {
				$userid=$row->userid;
				$ruleid=$row->ruleid;
				$userN=$row->userN;
				$logpass=$row->logpass;
				$status='1';
				$rulesql=$this->db->select('ruleN')->FROM('rule')->WHERE('ruleid',$ruleid)->get()->row();
				$usertype=$rulesql->ruleN;
				$sId=md5($userid.'+'.$userN.'+'.$logpass.'+'.date('Y-m-d H:i:s'));
				
				$data=array(
					'userid'=>$userid,
					'ruleid'=>$ruleid,
					'userN'=>$userN,					
					'Utype'=>$usertype,					
					'sId'=>$sId,
					'status'=>'1'
				);
				$this->session->set_userdata($data);
				
				$update=$this->db->query("UPDATE  user_reg SET  status='$status', sId='$sId' WHERE userid='$userid'");
				
				if($update){
				redirect('admin','location');
				}
			}
			

		}

		}		
	}

}

