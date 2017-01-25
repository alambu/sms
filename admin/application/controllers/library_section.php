<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class library_section extends CI_Controller {
	public function __construct(){
		parent::__construct();
		
		$stid=$this->session->userdata('userid');
		$ststatus=$this->session->userdata('status');
		$stsid=$this->session->userdata('sId');
		if($stid=='' || $stsid=='')
		{
			redirect('login?error=3','location');
		}
		$this->load->model('admin_model','n');
		$this->load->model('library_section/library_report','lib_report');
	}
		



	// ----------------libray section start-----------------------
	public function category_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/category_form');
	  $this->load->view('footer');
	 }
	 public function book_list_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_list_form');
	  $this->load->view('footer');
	 }
	 
	  public function book_setup()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_setup');
	  $this->load->view('footer');
	 }
	 public function book_dist_return(){
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  extract($_POST);
	  $today=date("Y-m-d");
	  $data=array();
	  //book return report start
	  if(isset($_POST['submit_return'])) 
	  {
		$data['ret_book']=$this->lib_report->book_return($_POST);
	  }
	  //book return report end
	  if(isset($_POST['exp_search']))
	  {
		if(empty($sft) && empty($cls) && empty($section) && empty($roll_no))
			{
				$w="where dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";
			}
			elseif(empty($cls) && empty($section) && empty($roll_no))
			{
				$w="where re.shiftid='$sft' and dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";
			}
			elseif(empty($section) && empty($roll_no))
			{
				$w="where re.shiftid='$sft' and re.classid='$cls' and dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";
			}
			elseif(empty($roll_no))
			{
				$w="where re.shiftid='$sft' and re.classid='$cls' and re.section='$section' and dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";
			}
			else 
			{
				$w="where re.shiftid='$sft' and re.classid='$cls' and re.section='$section' and re.roll_no='$roll_no' and dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";
			}
		
	   $data['exp_info']=$this->lib_report->book_return_expeird($w);
	  }
	  else 
	  {
	   $y=date("Y");
	   
	   $w="where dis.status='1' and date(dis.e_date)<'$today' and bc.book_id=dis.book_id and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and dis.stu_id=re.stu_id and re.syear='$y' and dis.stu_id=reg.stu_id";	
	   $data['exp_info']=$this->lib_report->book_return_expeird($w);
	     
	  }
	  $this->load->view('library_section/book_dist_return',$data);
	  $this->load->view('footer'); 
	 }
	  
	  public function book_edit(){
		  
	  $this->load->view('header');
	  $this->load->view('leftbar');
		$data=array();
	    if(isset($_POST['submit_list'])){
	    extract($_POST);
	    if($catg_name=='all_catg'){
		  $where="ctg.bctg_id=lis.bctg_id and bc.blist_id=lis.blist_id group by bc.blist_id";
	    }
		else {
		$where="ctg.bctg_id='$catg_name' and  ctg.bctg_id=lis.bctg_id and bc.blist_id=lis.blist_id group by bc.blist_id"; 
		}
		
		}
		else {
		$where="ctg.bctg_id=lis.bctg_id and bc.blist_id=lis.blist_id group by bc.blist_id";	
		}
	  $data['info']=$this->lib_report->book_list($where);
	  $data['all_catg']=$this->lib_report->book_catg();
	  $this->load->view('library_section/book_edit',$data);
	  $this->load->view('footer'); 
	  
	 }
	 
	  public function book_report() {
		// distribute report start
		extract($_POST);
		$data=array();
		if(isset($_POST['submit_view_all']))
		{
			if(empty($catg_name) && empty($list_no) && empty($bk_code))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id";
			}
			elseif(empty($list_no) && empty($bk_code))
			{
				$w="where lis.bctg_id='$catg_name' and  bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id";
			}
			elseif(empty($catg_name) && empty($list_no))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and bc.book_id='$bk_code'";
			}
			elseif(empty($catg_name) && empty($bk_code))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and lis.blist_id='$list_no'";
			}
			elseif(empty($catg_name))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and lis.blist_id='$list_no' and bc.book_id='$bk_code'";
			}
			elseif(empty($list_no))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and ctg.bctg_id='$catg_name' and bc.book_id='$bk_code'";
			}
			elseif(empty($bk_code))
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and lis.blist_id='$list_no' and ctg.bctg_id='$catg_name'";
			}
			else
			{
				$w="where bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and lis.blist_id='$list_no' and ctg.bctg_id='$catg_name' and bc.book_id='$bk_code'";
			}	
			
			$data['all_book']=$this->lib_report->all_book($w);
		}
		
		//all lost book report start
		
		
		
		
		//storage report start 
		
		if(isset($_POST['submit_view_store']))
		{
			
		if($catg_name=='all_catg'){
		
		$q="select ctg.bctg_id,catg_type,count(bc.book_id) as total_book,lis.blist_id from book_catg ctg left join book_list lis on ctg.bctg_id=lis.bctg_id left join book_code bc on lis.blist_id=bc.blist_id group by ctg.bctg_id";
		}
		else {
		$q="select ctg.bctg_id,catg_type,count(bc.book_id) as total_book,lis.blist_id from book_catg ctg,book_list lis,book_code bc where ctg.bctg_id='$catg_name' and ctg.bctg_id=lis.bctg_id and lis.blist_id=bc.blist_id";	
			
		}
		
		}
		else {
		
		$q="select ctg.bctg_id,catg_type,count(bc.book_id) as total_book,lis.blist_id from book_catg ctg left join book_list lis on ctg.bctg_id=lis.bctg_id left join book_code bc on lis.blist_id=bc.blist_id group by ctg.bctg_id";	
		}
		
		$data['storage']=$this->lib_report->library_storage($q);
		//storage report end
		
		
		if(isset($_POST['submit_all_lost']))
		{
			if($catg_name=='all_catg')
			{
				$w="where bc.status>1 and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id";
			}
			else
			{
				$w="where bc.status>1 and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id and lis.bctg_id='$catg_name'";
			}
			
			$data['all_lost']=$this->lib_report->all_lost_book($w);
		}
		else 
		{
			$w="where bc.status>1 and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id";
			$data['all_lost']=$this->lib_report->all_lost_book($w);
		}
		
		//search by book
		if(isset($_POST['by_book'])) 
		{
			if(empty($catg) && empty($bk_name) && empty($bk_code))
			{
				$w="where lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($bk_name) && empty($bk_code))
			{
				
				$w="where lis.bctg_id='$catg' and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($catg) && empty($bk_name))
			{
				$w="where  bc.book_id='$bk_code' and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($catg) && empty($bk_code))
			{
				$w="where lis.blist_id='$bk_name' and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($catg))
			{
				$w="where lis.blist_id='$bk_name' and  bc.book_id='$bk_code'  and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($bk_name))
			{
				$w="where ctg.bctg_id='$catg' and bc.book_id='$bk_code'  and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($bk_code))
			{
				$w="where ctg.bctg_id='$catg' and lis.blist_id='$bk_name'  and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			else
			{
				$w="where ctg.bctg_id='$catg' and lis.blist_id='$bk_name' and bc.book_id='$bk_code'  and  lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}	
			$data['info']=$this->lib_report->distribute_bybook($w);
		}
		//end search by book
		
		
		// search by date
		if(isset($_POST['by_student']))
		{
			if(empty($sft) && empty($cls) && empty($section) && empty($roll_no))
			{
				$w="where date(dis.e_date) like '$y%' and lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id and re.stu_id=dis.stu_id and re.syear='$y'";
			}
			elseif(empty($cls) && empty($section) && empty($roll_no))
			{
				$w="where date(dis.e_date) like '$y%' and re.syear='$y' and dis.stu_id=re.stu_id and re.shiftid='$sft' and lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($section) && empty($roll_no))
			{
				$w="where date(dis.e_date) like '$y%' and re.syear='$y' and dis.stu_id=re.stu_id and re.shiftid='$sft' and re.classid='$cls' and lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			elseif(empty($roll_no))
			{
				$w="where date(dis.e_date) like '$y%' and re.syear='$y' and dis.stu_id=re.stu_id and re.shiftid='$sft' and re.classid='$cls' and re.section='$section' and lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			else 
			{
				$w="where date(dis.e_date) like '$y%' and re.syear='$y' and dis.stu_id=re.stu_id and re.shiftid='$sft' and re.classid='$cls' and re.section='$section' and re.roll_no='$roll_no' and lis.bctg_id=ctg.bctg_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and bc.status='1' and s.stu_id=dis.stu_id";
			}
			$data['info']=$this->lib_report->distribute_bystudent($w);
		}
		
// End all book report
	  
	  $this->load->view('library_section/book_report',$data);
	  
	 }
	 public function book_code_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_code_form');
	  $this->load->view('footer');
	 }
	 
	 public function book_distribution_form()
	 {
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_distribution_form');
	  $this->load->view('footer');
	 }
	 
	  public function book_return_form()
	 {
		if(isset($_POST['submit_view'])){
			$data=array();
			extract($_POST);
			$data['info']=$this->db->query("select a.bookN,a.writterN,b.bctg_id,c.book_id ,c.stdreturn , d.catg_type from book_list a,book_code b,book_sdistribute c , book_catg d where
			b.blist_id=a.blist_id and c.book_id=b.book_id and b.bctg_id=d.bctg_id and b.status='1' and c.stu_id='$student_id' and c.lib_recdate='0000-00-00'")->result();
		}
	  $this->load->view('library_section/book_return_form',$data);
	  
	 }
 
	
	
	public function book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('library_section/book_list');
		$this->load->view('footer');
	}
	
	
}

