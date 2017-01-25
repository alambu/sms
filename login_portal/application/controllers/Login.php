<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
public function __construct()
	{
	parent::__construct();
	}
	public function index()
	{
		$data=array();
		$data['title']="Login";
		$this->load->view('login',$data);
        }
	public function login_action()
	{
		error_reporting(1);
	  if(isset($_POST['login'])){
     	$username=trim($this->input->post('username',TRUE));
      	$pass=trim($this->input->post('password',TRUE));
      	$t=trim($this->input->post('type',TRUE));
      
      if(($username=='')&&($pass=='')){
      	$url="login/?t=".$t;
       redirect($url,'location');
      }
      else if(($username=='')&&($pass!='')){
      	$url="login/?t=".$t;
		 redirect($url,'location');;
      }
  
      else if(($username!='')&&($pass=='')){
      	$url="login/?t=".$t;
		 redirect($url,'location');
      }
	  else{
		  $typeck=$this->input->post('type');
		  if($typeck==1){$talbeck='fstu_login'; $idck='stu_id';}
		  if($typeck==2){$talbeck='father_login';$idck='parentid';}
		  if($typeck==3){$talbeck='emp_login';$idck='empid';}
			$query=$this->db->query("SELECT * FROM $talbeck WHERE $idck='$username' AND  pass='$pass' LIMIT 1");
			$row=$query->row();
			if($this->db->affected_rows()<1){
				$url="login/?t=".$typeck;
				redirect($url,'location');
			}
			else {
				
				$userid=$row->$idck;				
				$logpass=$row->pass;
				$status='1';				
				$sId=md5($userid.'+'.$userN.'+'.$logpass.'+'.date('Y-m-d H:i:s'));
				
				$data=array(
					'lidcheck'=>$userid,
					'ltype'=>$typeck,				
					'sId'=>$sId,
					'status'=>'1'
				);
				

				$this->session->set_userdata($data);
				
				$update=$this->db->query("UPDATE  $talbeck SET  status='$status', sId='$sId' WHERE $idck='$userid'");
				
				if($update){
					$url='admin';
					redirect($url,'location');
				}
			}
			

		} 
    }
	
	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */