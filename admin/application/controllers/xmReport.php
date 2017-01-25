<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class xmReport extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		$ses_sql=$this->db->select('userid,status,sId')->from('user_reg')->where('userid',$stid)->get()->row();
		if($this->db->affected_rows()<1)
		{
			redirect('login?error=3','location');
		}
		if($stid==$ses_sql->userid && $ststatus==$ses_sql->status && $stsid==$ses_sql->sId){
		$this->load->model('admin_model','n');
		$this->load->model('student','report');
		$this->load->model('marksheet_model','mkst');
		}
		else{
			redirect('login?error=2','location');
		}
	}

	public function exm_name_list(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/xmNameList');
		$this->load->view('footer');
	}

	public function currentXm(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/currentXm');
		$this->load->view('footer');
	}

	public function seat_plan(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/seatPlanDialug');
		$this->load->view('footer');
	}

	public function seatPlanPrint(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/seatPlanPrint');
		$this->load->view('footer');
	}

	public function seatPlaning(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/seatPlaning');
		$this->load->view('footer');
	}

	public function gradeSysRep(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/grade_report');
		$this->load->view('footer');
	}

	public function paperDistDialog(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/paperDistDialogu');
		$this->load->view('footer');
	}

	public function disPaRep(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/distributePaperReport');
		$this->load->view('footer');
	}

	public function paperReceived(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/receivePaRepo');
		$this->load->view('footer');
	}

	public function disPaReRepo(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/disPaReRepo');
		$this->load->view('footer');
	}

	public function passMarkRepo(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/passMarkRepo');
		$this->load->view('footer');
	}

	public function subWiseStdD(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/subWiseStdDia');
		$this->load->view('footer');
	}

	public function subWiseStdRes(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/subWiseStdRes');
		$this->load->view('footer');
	}

	public function indStdRslt(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/indivisualStdResult');
		$this->load->view('footer');
	}

	public function indStdR(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/stdResult');
		$this->load->view('footer');
	}

	public function othXmRepo(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/othXmRepo');
		$this->load->view('footer');
	}

	public function othXmRslt(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/othXmRslt');
		$this->load->view('footer');
	}

	public function othXmStdRslt(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/othXmStdRslt');
		$this->load->view('footer');
	}

	public function xmRoutinePrint(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/xmRoutinePrint');
		$this->load->view('footer');
	}

	public function xmRoutineP(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/xmRoutineP');
		$this->load->view('footer');
	}

	public function roomRep(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('exam/roomRepo');
		$this->load->view('footer');
	}

// exam paper distribute token print
	public function printToken(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/ptoken");
		$this->load->view('footer');
	}

	public function meritListPanel(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/meritListPanel");
		$this->load->view('footer');
	}

	public function merit(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/meritLst");
		$this->load->view('footer');
	}

	public function meritList(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/meritDetails");
		$this->load->view('footer');
	}

	public function othMrt(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/otherMerit");
		$this->load->view('footer');	
	}

	public function othMrtLst(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/otherMeritDetails");
		$this->load->view('footer');	
	}

///////////////////////////////////////////////////////////////////////////
/////////////////////// edited by Md Shoriful Islam.(08-01-16) /////////
//////////////////////////////////////////////////////////////////////////
	
	// single marksheet filter
	public function single_marksheet(){
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view("exam/marksheet/single_marksheet_filter");
		$this->load->view('footer');	
	}

	// single marksheet show
	public function marksheet_single(){
		if(isset($_POST['marksheet'])):
			extract($_POST);
			// data array
			$data = array(
					"class"   => $class,
					"section" => $section,
					"shift"   => $shift,
					"roll" 	  => $roll,
					"year" 	  => $year
				);
		// $this->load->view('header');
		// $this->load->view('leftbar');
		$this->load->view("exam/marksheet/marksheet",$data);
		// $this->load->view('footer');	
	else:
		echo '<span style="color:red;">Bad request !</span>';
	endif;
	}

}