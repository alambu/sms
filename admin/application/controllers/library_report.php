<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class library_report extends CI_Controller {
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
	}
		
	}


	// ----------------libray section start-----------------------
	public function category_form()
	 {
	  $data=array();
	  $data['info']=$this->db->select("*")->from("book_catg")->get()->result();
	  
	  $this->load->view('library_section/category_report',$data);
	  
	 }
	 public function book_list_form()
	 {
	  $data=array();
	    if(isset($_POST['submit_view'])){
	    extract($_POST);
	    if($catg_name=='all_catg'){
		  $data['info']=$this->db->query("select a.catg_type,b.blist_id,b.bookN,b.writterN,b.price,b.fineprice,b.tquantity,b.e_date,b.e_user,c.bctg_id,count(c.blist_id)as total from
          book_catg a, book_list b,book_code c where
          a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and b.blist_id=c.blist_id and c.status<2 group by b.blist_id")->result();
	    }
		else {
		$data['info']=$this->db->query("select a.catg_type,b.blist_id,b.bookN,b.writterN,b.price,b.fineprice,b.tquantity,b.e_date,b.e_user,c.bctg_id,count(c.blist_id)as total from
        book_catg a, book_list b,book_code c where
        a.bctg_id='$catg_name' and b.bctg_id='$catg_name' and c.bctg_id='$catg_name' and b.blist_id=c.blist_id and c.status<2 group by b.blist_id")->result();  
		}
		  
		}
		else {
		$data['info']=$this->db->query("select a.catg_type,b.blist_id,b.bookN,b.writterN,b.price,b.fineprice,b.tquantity,b.e_date,b.e_user,c.bctg_id,count(c.blist_id)as total from
        book_catg a, book_list b,book_code c where
        a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and b.blist_id=c.blist_id and c.status<2 group by b.blist_id")->result();	
		}
	  
	  $this->load->view('library_section/book_list_report',$data);
	 }
	 public function library_storeg_report()
	 {
		$data=array();
	    if(isset($_POST['submit_view'])){
	    extract($_POST);
	    if($catg_name=='all_catg'){
		  $data['info']=$this->db->query("select a.bctg_id,a.catg_type,count(b.bctg_id) as total from book_catg a left join book_code b on a.bctg_id=b.bctg_id and b.status<2
		 group by a.catg_type order by total desc")->result();
	    }
		else {
		$data['info']=$this->db->query("select a.bctg_id,a.catg_type,c.bctg_id,count(c.bcid) as total from book_catg a,book_code c where a.bctg_id='$catg_name' and
		c.bctg_id='$catg_name' and c.status<2 group by c.bctg_id")->result();  
		}
		  
		}
		else {
		$data['info']=$this->db->query("select a.bctg_id,a.catg_type,count(b.bctg_id) as total from book_catg a left join book_code b on a.bctg_id=b.bctg_id and b.status<2
group by a.catg_type order by total desc")->result();	
		}
		$this->load->view('library_section/library_storeg_report',$data);
		
	 }
	 public function distribute_report()
	 {
		 $data=array();
		 if(isset($_POST['submit_view'])){
			 switch (extract($_POST)) {
				
				case

				empty($ctg)&& empty($bk)&& empty($sft)&&empty($cls)&& empty($stu_id) &&empty($s_date)&&empty($e_date):
					//echo "sob khali";
					
					break;
				
				case

				empty($ctg)&& empty($bk)&& empty($sft)&&empty($cls)&&empty($s_date)&&empty($e_date):
					//echo "shudhu student";
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,g.stu_id
					from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e
					,re_admission g where
					a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and
					g.stu_id='$stu_id' and e.stu_id='$stu_id' and d.stu_id='$stu_id'
					 and c.status='1' group by d.bcid")->result();
					break;
					
					
				case
				
				empty($ctg) && empty($cls) && empty($bk) && empty($sft)  &&  empty($e_date):
					//echo "stu_id and sdate";
					$d=date("Y-m-d",strtotime($s_date));
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,d.e_date,e.name,e.stu_id,g.stu_id from book_catg a,book_list b,book_code c,book_sdistribute d,regis_tbl e,re_admission g
					where a.bctg_id=b.bctg_id and b.blist_id=c.blist_id and c.bcid=d.bcid and c.status='1' and
					d.stdrdate='$d' and d.stu_id='$stu_id' and d.stu_id=g.stu_id and e.stu_id=d.stu_id
					group by c.bcid")->result();
					break;
					
				case
					
				empty($ctg) && empty($cls) && empty($bk) && empty($sft)  &&  empty($s_date):
					//echo "stu_id and edate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,
					d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,d.e_date,e.name,e.stu_id,g.stu_id
					from book_catg a,book_list b,book_code c,
					book_sdistribute d,regis_tbl e,re_admission g
					where a.bctg_id=b.bctg_id and b.blist_id=c.blist_id and c.bcid=d.bcid and c.status='1' and
					d.stdrdate='$d' and d.stu_id='$stu_id' and d.stu_id=g.stu_id and e.stu_id=d.stu_id
					group by c.bcid")->result();
					break;	
					
				case
					
				empty($ctg) && empty($cls) && empty($bk) && empty($sft):
					//echo "stu_id and edate and Sdate";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,d.e_date,e.name,e.stu_id,g.stu_idfrom book_catg a,book_list b,book_code c,book_sdistribute d,regis_tbl e,re_admission g
					where a.bctg_id=b.bctg_id and b.blist_id=c.blist_id and c.bcid=d.bcid and c.status='1' and
					d.stdrdate between '$s_date' and '$e_date' and d.stu_id='$stu_id' and d.stu_id=g.stu_id and e.stu_id=d.stu_id
					group by c.bcid")->result();
					break;	
					
					
				case

				empty($ctg)&& empty($stu_id)&& empty($sft)&&empty($cls)&&empty($s_date)&&empty($e_date):
					//echo "shodhu Book id";
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status, d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1' and c.book_id='$bk' and d.book_id='$bk' and d.stu_id=e.stu_id  group by c.bcid")->result();
					break;
					
				case
				
				empty($ctg) && empty($stu_id) && empty($cls) && empty($sft)  &&  empty($e_date):
					//echo "book and sdate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($s_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id from
					 book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and c.book_id='$bk' and d.book_id='$bk' and d.stdrdate='$d' and d.stu_id=e.stu_id  group by c.bcid")->result();
					break;
					
				case
					
				empty($ctg) && empty($stu_id) && empty($cls) && empty($sft)  &&  empty($s_date):
					//echo "book and edate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id from
					 book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and c.book_id='$bk' and d.book_id='$bk' and d.stdrdate='$d' and d.stu_id=e.stu_id  group by c.bcid")->result();
					break;	
					
				case
					
				empty($ctg) && empty($stu_id) && empty($cls) && empty($sft):
					//echo "book and edate and Sdate";
					$y=date("Y");
					$d1=date("Y-m-d",strtotime($s_date));
					$d2=date("Y-m-d",strtotime($e_date));
					
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id from
					 book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and c.book_id='$bk' and d.book_id='$bk' and d.stdrdate between '$d1' and '$d2' and d.stu_id=e.stu_id  group by c.bcid")->result();
					break;	

				case

				empty($ctg) && empty($stu_id)&& empty($sft)&&empty($bk) && empty($s_date)&& empty($e_date):
					//echo "shodhu  Class";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.classid,g.classid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,class_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and g.classid='$cls' and f.classid='$cls'
					and g.syear='$y'
					group by c.bcid")->result();
					break;
					
					
				case
				
				empty($ctg) && empty($stu_id) && empty($bk) && empty($sft)  &&  empty($e_date):
					//echo "class and sdate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($s_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.classid,g.classid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,class_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and g.classid='$cls' and f.classid='$cls'
					and g.syear='$y' and d.stdrdate='$d'
					group by c.bcid")->result();
					
					break;
					
				case
					
				empty($ctg) && empty($stu_id) && empty($bk) && empty($sft)  &&  empty($s_date):
					//echo "class and edate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.classid,g.classid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,class_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and g.classid='$cls' and f.classid='$cls'
					and g.syear='$y' and d.stdrdate='$d'
					group by c.bcid")->result();
					break;	
					
				case
					
				empty($ctg) && empty($stu_id) && empty($bk) && empty($sft):
					//echo "class and edate and Sdate";
					$y=date("Y");
					$d1=date("Y-m-d",strtotime($s_date));
					$d2=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.classid,g.classid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,class_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and g.classid='$cls' and f.classid='$cls'
					and g.syear='$y' and d.stdrdate between '$d1' and '$d2'
					group by c.bcid")->result();
					break;	
					
					
				
				case
					
				empty($ctg) && empty($stu_id)&& empty($cls)&&empty($bk) && empty($s_date)&& empty($e_date):
					//echo "shodhu  Shift";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.shiftid,g.shiftid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,shift_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft'
					and g.syear='$y'group by c.bcid")->result();
					break;
					
					
				case
				
				empty($ctg) && empty($stu_id) && empty($bk) && empty($cls)  &&  empty($e_date):
					//echo "shift and sdate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($s_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.shiftid,g.shiftid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,shift_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft'
					and g.syear='$y' and d.stdrdate='$d' group by c.bcid")->result();
					
					break;
					
				case
					
				empty($ctg) && empty($stu_id) && empty($bk) && empty($cls)  &&  empty($s_date):
					//echo "shift and edate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.shiftid,g.shiftid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,shift_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft'
					and g.syear='$y' and d.stdrdate='$d' group by c.bcid")->result();
					break;	
					
				case
					
				empty($ctg) && empty($stu_id) && empty($bk) && empty($cls):
					//echo "shift and edate and Sdate";
					$y=date("Y");
					
					$d1=date("Y-m-d",strtotime($s_date));
					$d2=date("Y-m-d",strtotime($e_date));
					
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.shiftid,g.shiftid,g.syear from book_catg a,book_list b,book_code c, book_sdistribute d,regis_tbl e,shift_catg f,re_admission g
					where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1'
					and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft'
					and g.syear='$y' and d.stdrdate between '$d1' and '$d2' group by c.bcid")->result();
					
					break;	
					

				case
					
				empty($ctg) && empty($stu_id) && empty($bk) && empty($s_date) &&  empty($e_date):
					//echo "Shift and class";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.bctg_id,c.blist_id,c.book_id,c.status,d.stu_id,d.bcid,d.book_id,d.stdrdate,d.stdreturn,d.e_user,e.name,e.stu_id,f.shiftid,g.shiftid,g.syear,g.classid,h.classid from book_catg a,book_list b,book_code c,book_sdistribute d,regis_tbl e,shift_catg f,re_admission g,class_catg h where a.bctg_id=b.bctg_id and b.bctg_id=c.bctg_id and c.bcid=d.bcid and c.status='1' and  d.stu_id=e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft'  and g.shiftid='$sft' and h.classid='$cls' and g.classid='$cls' and g.syear='$y' group by c.bcid")->result();
					break;
				
				
				case

				empty($bk)&& empty($sft)&&empty($cls)&&empty($stu_id)&&empty($s_date)&&empty($e_date):
					//echo "ctg";
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and c.status='1' and c.bcid=d.bcid and d.stu_id=e.stu_id group by d.bcid")->result();
					break;
				
				case
				
				empty($sft) && empty($stu_id) && empty($bk) && empty($cls)  &&  empty($e_date):
					//echo "catg and sdate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($s_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and c.status='1' and c.bcid=d.bcid and d.stu_id=e.stu_id and d.stdrdate='$d' group by d.bcid")->result();
					break;
					
				case
					
				empty($sft) && empty($stu_id) && empty($bk) && empty($cls)  &&  empty($s_date):
					//echo "catg and edate";
					$y=date("Y");
					$d=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and c.status='1' and c.bcid=d.bcid and d.stu_id=e.stu_id and d.stdrdate='$d' group by d.bcid")->result();
					break;	
					
				case
					
				empty($sft) && empty($stu_id) && empty($bk) && empty($cls):
					//echo "catg and edate and Sdate";
					$y=date("Y");
					$d1=date("Y-m-d",strtotime($s_date));
					$d2=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and c.status='1' and c.bcid=d.bcid and d.stu_id=e.stu_id and d.stdrdate between '$d1' and '$d2' group by d.bcid")->result();
					break;	
					
					
					
				case

				empty($sft)&&empty($cls)&&empty($stu_id)&&empty($s_date)&&empty($e_date):
					//echo "ctg and book";
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id=
					e.stu_id group by d.bcid")->result();
					break;
					
				case

				empty($sft)&&empty($cls)&&empty($stu_id)&& empty($e_date):
				//echo "ctg and book and sdate";
				$d=date("Y-m-d",strtotime($s_date));
				$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id=
					e.stu_id and d.stdrdate='$d' group by d.bcid")->result();
				break;
				
				case

				empty($sft)&&empty($cls)&&empty($stu_id)&& empty($s_date):
				//echo "ctg and book and edate";
				
				$d=date("Y-m-d",strtotime($e_date));
				$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id=
				e.stu_id and d.stdrdate='$d' group by d.bcid")->result();
				
				break;
				
				case

				empty($sft)&&empty($cls)&&empty($stu_id):
				//echo "ctg and book and edate and sdate";
				
				$d1=date("Y-m-d",strtotime($s_date));
				$d2=date("Y-m-d",strtotime($e_date));
				$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id=
				e.stu_id and d.stdrdate between '$d1' and '$d2' group by d.bcid")->result();
				
				break;
				
				
				case

				empty($cls)&&empty($stu_id)&&empty($s_date)&&empty($e_date):
					//echo "shift and book and ctg";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,f.shiftid,g.shiftid,g.stu_id
					from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e,shift_catg
					f,re_admission g  where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id=
					e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft' and g.syear='$y'  group by d.bcid")->result();
					break;
					
				case

				empty($stu_id)&&empty($s_date)&&empty($e_date):
					//echo "shift and book and ctg and class";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,f.shiftid,g.shiftid,g.stu_id,
					g.classid,h.classid from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e,
					shift_catg f,re_admission g , class_catg h  where a.bctg_id='$ctg'
					  and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and
					   c.status='1' and c.bcid=d.bcid and d.stu_id=
					e.stu_id and d.stu_id=g.stu_id and f.shiftid='$sft' and g.shiftid='$sft' and g.classid='$cls'
					and h.classid='$cls' and g.syear='$y'  group by d.bcid")->result();
					
					break;
					
				case

				empty($s_date)&&empty($e_date):
					//echo "shift and book and ctg and class and student id";
					$y=date("Y");
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,f.shiftid,g.shiftid,g.stu_id,
					g.classid,h.classid from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e,shift_catg f,re_admission g , class_catg h  where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id='$stu_id' and e.stu_id='$stu_id' and d.stu_id='$stu_id' and g.stu_id='$stu_id'and f.shiftid='$sft' and g.shiftid='$sft' and g.classid='$cls'
					and h.classid='$cls' and g.syear='$y'   group by d.bcid")->result();
					break;
					
				case

				empty($e_date):
					//echo "shift and book and ctg and class and student id and s_date";
					$y=date("Y");
					$s=date("Y-m-d",strtotime($s_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,f.shiftid,g.shiftid,g.stu_id,
					g.classid,h.classid from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e,shift_catg f,re_admission g , class_catg h  where a.bctg_id='$ctg' and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and c.status='1' and c.bcid=d.bcid and d.stu_id='$stu_id' and e.stu_id='$stu_id' and d.stu_id='$stu_id' and g.stu_id='$stu_id' and f.shiftid='$sft' and g.shiftid='$sft' and g.classid='$cls' and h.classid='$cls' and d.stdrdate='$s'   group by d.bcid")->result();
					
					break;
					
				case

				empty($s_date):
					//echo "shift and book and ctg and class and student id and e_date";
					$y=date("Y");
					$e=date("Y-m-d",strtotime($e_date));
					$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bookN,b.bctg_id,c.bcid,c.blist_id,c.bctg_id,c.book_id,
					c.status,d.bcid,d.stdrdate,d.stdreturn,d.e_user,d.stu_id,e.name,f.shiftid,g.shiftid,g.stu_id,
					g.classid,h.classid from book_catg a,book_list b ,book_code c ,book_sdistribute d,regis_tbl e,
					shift_catg f,re_admission g , class_catg h  where a.bctg_id='$ctg'
					  and b.bctg_id='$ctg' and c.bctg_id='$ctg' and b.blist_id='$bk' and c.blist_id='$bk' and
					   c.status='1' and c.bcid=d.bcid and d.stu_id='$stu_id' and
					e.stu_id='$stu_id' and d.stu_id='$stu_id' and g.stu_id='$stu_id'
					  and f.shiftid='$sft' and g.shiftid='$sft' and g.classid='$cls'
					and h.classid='$cls' and d.stdrdate='$e'  group by d.bcid")->result();
					break;	
				
				default:
					echo "Your favorite color is neither red, blue, nor green!";
			}
		}	
		 $this->load->view('library_section/distribute_report',$data);
		 
	 }
	 
	 public function all_book_report()
	 {
		extract($_POST);
		$data=array();
		if(isset($_POST['submit_view'])){
		 if(empty($list_no) && empty($bk_code)){
			 $data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bctg_id,b.bookN,c.stu_id,c.status,c.blist_id,c.book_id  from book_catg a,book_list b,book_code c
			 where a.bctg_id='$catg_name' and b.bctg_id='$catg_name' and b.blist_id=c.blist_id")->result();
		 }
		 elseif(empty($list_no) && empty($catg_name)){
			 $data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bctg_id,b.bookN,c.stu_id,c.status,c.blist_id,c.book_id from book_catg
			 a,book_list b,book_code c
			 where a.bctg_id=b.bctg_id and b.blist_id=c.blist_id and c.book_id='$bk_code'")->result();
		 }
		 elseif(empty($bk_code)){
			$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bctg_id,b.bookN,c.stu_id,c.status,c.blist_id,c.book_id from book_catg
			a,book_list b,book_code c
			where a.bctg_id='$catg_name' and b.bctg_id='$catg_name' and b.blist_id='$list_no' and c.blist_id='$list_no';")->result();
		 }
		 else {
			$data['info']=$this->db->query("select a.bctg_id,a.catg_type,b.blist_id,b.bctg_id,b.bookN,c.stu_id,c.status,c.blist_id,c.book_id from book_catg
			a,book_list b,book_code c
			where a.bctg_id='$catg_name' and b.bctg_id='$catg_name'  and b.blist_id='$list_no' and c.blist_id='$list_no' and c.book_id='$bk_code'")->result(); 
		 }
		}
		else {
			
		}
//start all book report	

	
	
//End all book report		
		
		 $this->load->view('library_section/all_book_report',$data);
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
	  $this->load->view('header');
	  $this->load->view('leftbar');
	  $this->load->view('library_section/book_return_form');
	  $this->load->view('footer');
	 }
 
	public function library_info()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('library_section/library_info');
		$this->load->view('footer');
	}
	
	public function book_list()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('library_section/book_list');
		$this->load->view('footer');
	}
	
	public function library_gallery()
	{
		$this->load->view('header');
		$this->load->view('leftbar');
		$this->load->view('library_section/library_gallery');
		$this->load->view('footer');
	}
	
	public function image_upload() {
		if(isset($_POST)) {  
		
		echo $_FILES['img']['tmp_name'];
		
		}
	//	echo $sourcePath = $_FILES['file']['tmp_name'];
	
	}
	// ------------------------libary section End----------------------------
	// ------------------------Start Employee Section-------------------------------->
	
	//------------------ End Employee Section------------------------------>
}

