<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Library_report extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
	public function distribute_bybook($where) {
		return $this->db->query("select ctg.catg_type,ctg.bctg_id,lis.blist_id,bookN,bc.*,dis.stu_id,stdrdate,stdreturn,bdis_id,s.name from book_catg ctg,book_list lis,book_sdistribute dis, book_code bc,regis_tbl s $where")->result();
	}
	
	public function book_list($where)
	{
		return $this->db->query("select ctg.catg_type,lis.*,count(bc.bcid) as total from book_catg ctg,book_list lis,book_code bc where  $where")->result();
	}
	
	public function book_catg()
	{
		return $this->db->query("select * from book_catg")->result();
	}
	
	public function book_list_bycatg($ctgid)
	{
		return $this->db->select("*")->from("book_catg")->where("bctg_id",$ctgid)->get()->row();
	}
	
	public function book_list_info($list_id)
	{
		return $this->db->select("*")->from("book_list")->where("blist_id",$list_id)->get()->row();
	}
	
	
	public function book_info($bk_id)
	{
		return $this->db->query("select lis.*,c.blist_id,book_id from book_list lis,book_code c where lis.blist_id=c.blist_id and c.book_id='$bk_id'")->row();
	}
	
	
	public function library_update($where,$tbl,$data)
	{
		$this->db->where($where);
		$up=$this->db->update($tbl,$data);
		if($up) { return true; } else { return false; }
	}
	
	
	public function book_return_expeird($where)
	{
		
		return $this->db->query("select ctg.catg_type,lis.bookN,bc.book_id,dis.*,reg.name,personal_phone,re.syear from book_catg ctg ,book_list lis,book_code bc ,regis_tbl reg,re_admission re,book_sdistribute dis  $where")->result();
	}
	
	
	public function distribute_log($data)
	{
		extract($data);
		
		if($dis_log!='')
		{
		return $this->db->query("select lis.bookN,bc.book_id,dis.*,reg.name from book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg where reg.stu_id='$dis_log' and dis.stu_id='$dis_log' and dis.status='1' and dis.book_id=bc.book_id and bc.blist_id=lis.blist_id");
		}
		elseif($dis_log_roll!='')
		{
		$ex=explode("/",$dis_log_roll);
		return $query=$this->db->query("select lis.bookN,bc.book_id,dis.*,reg.name from book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg,re_admission re  where re.syear='$ex[4]' and re.shiftid='$ex[0]' and re.classid='$ex[1]' and re.section='$ex[2]' and re.roll_no='$ex[3]' and re.stu_id=dis.stu_id and re.stu_id=reg.stu_id and lis.blist_id=bc.blist_id and bc.book_id=dis.book_id and dis.status='1' order by dis.bdis_id desc");
		}
		
		
	}
	
	public function get_student_id($sft,$cls,$sec,$roll,$y)
	{
		echo $this->db->query("select stu_id from re_admission where shiftid='$sft' and classid='$cls' and section='$sec'
		and roll_no='$roll' and syear='$y'")->row()->stu_id;
	}
	
	public function book_return($where)
	{
		extract($where);
		if(!empty($student_id))
		{
			
			return $this->db->query("select ctg.catg_type,lis.bookN,writterN,bc.book_id,dis.*,reg.name from book_catg ctg,book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg where ctg.bctg_id=lis.bctg_id and bc.blist_id=lis.blist_id and bc.book_id=dis.book_id and dis.status='1' and bc.status='1' and dis.stu_id='$student_id' and dis.stu_id=reg.stu_id")->result();
			
		}
		
		else
		{
		
		$student_id=$this->db->query("select stu_id from re_admission where shiftid='$sft_ret' and classid='$cls_name' and section='$section' and roll_no='$roll_no_ret' and syear='$y'")->row()->stu_id;
		
		return $this->db->query("select ctg.catg_type,lis.bookN,writterN,bc.book_id,dis.*,reg.name from book_catg ctg,book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg where ctg.bctg_id=lis.bctg_id and bc.blist_id=lis.blist_id and bc.book_id=dis.book_id and dis.status='1' and bc.status='1' and dis.stu_id='$student_id' and dis.stu_id=reg.stu_id")->result();
		}
			
	}
	
	public function all_book($where)
	{
		return $this->db->query("select ctg.catg_type,lis.bookN,bc.* from book_catg ctg,book_list lis,book_code bc $where")->result();
	}
	
	public function all_lost_book($where)
	{
		return $this->db->query("select ctg.catg_type,lis.bookN,writterN,bc.* from book_catg ctg,book_list lis,book_code bc  $where")->result();
	}
	
	public function total_distribute($ctg)
	{
		return $this->db->query("select count(bc.book_id) as total_dis,ctg.bctg_id from book_code bc,book_list lis,book_catg ctg where lis.bctg_id='$ctg' and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id  and bc.status='1'")->row()->total_dis;
	}
	
	public function total_loss($ctg)
	{
		return $this->db->query("select count(bc.book_id) as total_loss,ctg.bctg_id from book_code bc,book_list lis,book_catg ctg where lis.bctg_id='$ctg' and bc.blist_id=lis.blist_id and lis.bctg_id=ctg.bctg_id  and bc.status>1")->row()->total_loss;
	}
	
	
	public function library_storage($query)
	{
		return $this->db->query($query)->result();
	}
	
	
	public function data_pass_modal_lost($bk_id,$stu_id)
	{
		return $this->db->query("select lis.bookN,price,fineprice,bc.book_id,dis.stu_id,reg.name  from book_list lis,book_code bc,book_sdistribute dis,regis_tbl reg where  bc.blist_id=lis.blist_id and bc.book_id='$bk_id' and dis.status='1' and bc.status='1' and dis.stu_id='$stu_id' and reg.stu_id=dis.stu_id and dis.book_id=bc.book_id")->row();
	}
	
	public function entry_user_info($uid)
	{
		return $this->db->query("select dis.e_user,ureg.fullname from book_sdistribute dis,user_reg ureg where dis.bdis_id='$uid' and ureg.userid=dis.e_user limit 1")->row();
	}
	
	public function selected_book_list($bctg_id)
	{
		return $this->db->select("*")->from("book_list")->where("bctg_id",$bctg_id)->get()->result();
	}
	
	public function distribute_bystudent($where)
	{
		return $this->db->query("select ctg.catg_type,ctg.bctg_id,lis.blist_id,bookN,bc.*,dis.stu_id,stdrdate,stdreturn,bdis_id,s.name from book_catg ctg,book_list lis,book_sdistribute dis, book_code bc,regis_tbl s,re_admission re $where")->result();
	}
	
}
?>