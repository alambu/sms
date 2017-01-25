<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
public function __construct()
	{
	parent::__construct();
 }
	public function index()
	{
		$data['title']="Login";
		$this->load->view('header',$data);
		$this->load->view('login',$data);
		$this->load->view('right_content');
		$this->load->view('footer');
    }
	public function login_action()
	{
		
	  if(isset($_POST['login'])){
     
     	$username=trim($this->input->post('username',TRUE));
      	$pass=trim($this->input->post('password',TRUE));
      	$t=trim($this->input->post('type',TRUE));
      
      if(($username=='')&&($pass=='')){
      	$url="login?sk=empty&t=".$t;
       redirect($url,'location');
      }
      else if(($username=='')&&($pass!='')){
      	$url="login?sk=username&t=".$t;
		 redirect($url,'location');;
      }
  
      else if(($username!='')&&($pass=='')){
      	$url="login?sk=pass&t=".$t;
		 redirect($url,'location');
      }
	  else{
		  $typeck=$this->input->post('type');
		  if($typeck==1){$talbeck='fstu_login'; $idck='stu_id';}
		  if($typeck==2){$talbeck='father_login';$idck='parentid';}
		  if($typeck==3){$talbeck='emp_login';$idck='empid';}
			$query=$this->db->query("select * from $talbeck where $idck='$username' and pass='$pass' limit 1");
			
			$row=$query->row();
			
			if($this->db->affected_rows()<1){
				$url="login?sk=empty&t=$typeck";
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