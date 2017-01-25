<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class setting_model extends CI_Model {
    function __construct()
    {
        parent::__construct();
    }
	
	
	public function all_insert($tbl,$data)
	{
		$insert=$this->db->insert($tbl,$data);
		if($insert) { return true; } else { return false; }
	}
	
	public function all_update($where,$tbl,$data)
	{
		$this->db->where($where);
		$up=$this->db->update($tbl,$data);
		if($up) { return true; } else { return false; }
	}
	
	public function setting_edit($tbl,$clm,$id) 
	{
		return $this->db->query("select * from $tbl where $clm='$id' limit 1")->row();
	}
	
	public function shift_delete_test($id)
	{
		$this->db->query("select * from re_admission where shiftid='$id'");
		return $this->db->affected_rows();
	}
	
	public function all_delete($tbl,$clm,$id)
	{
		$del=$this->db->query("delete from $tbl where $clm='$id'");
		if($del) { return true; } else { return false; }
	}
	
	public function all_group()
	{
		return $this->db->select("*")->from("group_setup")->get()->result();
	}
	
	public function group_delete_test($id)
	{
		return $id;
	}
	
	public function section_test($data)
	{
		extract($data);
		//cls_name:section_cls,section:section,shift_name:shift_name
		return $row=$this->db->query("select * from class_catg where shiftid='$shift_name' and class_name='$cls_name' and section='$section'")->row();
	}
	
	public function section_test_by_submit($data)
	{
		extract($data);
		$cinfo=$this->db->query("select * from class_catg where shiftid='$shift_name' and class_name='$cls_name'");
		if($this->db->affected_rows()>0)
		{   
			$sec=$cinfo->row()->section;
			$ex=explode(",",$sec);
			foreach($section as $key=>$value){
				if(in_array($value,$ex))
				{
					return "Section ".$section[$key]." Already Exist";
				}	
			}
			return 2;
		}
		else 
		{
			return 1;
		}
		
	}
	
	
	public function group_exist_test($data)
	{
		extract($data);
		$ginfo=$this->db->query("select * from class_catg where shiftid='$shift_name' and class_name='$cls_name'");
		if($this->db->affected_rows()>0)
		{   
			$exist_group=$ginfo->row()->group;
			if($exist_group!=0)
			{
				$ex_group=explode(",",$exist_group);
				foreach($group as $key=>$value){
					if(in_array($value,$ex_group))
					{
						return "Group ".$group[$key]." Already Exist";
					}	
				}
				return 2;
			}
			return 2;
		}
		
		else 			
		{
			return 1;
		}
	}
	
	public function exist_class_info($sft,$cls)
	{
		return $this->db->query("select * from class_catg where shiftid='$sft' and class_name='$cls'")->row();
	}
	
	
	public function class_info($shift)
	{
		return $this->db->select("*")->from("class_catg")->where("shiftid",$shift)->get()->result();
	}
	
	
	public function section_info($clsid)
	{
		return $this->db->select("*")->from("section_tbl")->where("classid",$clsid)->get()->result();
	}
	
	public function ge_section($secid)
	{
		return $this->db->select("*")->from("section_tbl")->where("sectionid",$secid)->get()->row();
	}
	
	public function section_explode($section)
	{
		$ex=explode(",",$section);
		$return_section="";
		foreach($ex as $value)
		{
			$return_section.='<span class="label label-info">'.$value.'</span> &nbsp;';
		}
		return $return_section;
	}
	
	public function group_explode($group)
	{
		$ex=explode(",",$group);
		if($group!='') {
		$return_group="";
		foreach($ex as $value)
		{
			$group_name=$this->db->query("select group_name from group_setup where groupid='$value'")->row()->group_name;
			$return_group.='<span class="label label-primary">'.$group_name.'</span> &nbsp;';
		}
		}
		else 
		{
			$return_group="<span class='label label-danger'>have no group</span> &nbsp;";
		}
		return $return_group;
	}
	
	public function subject_exist_test($sub_name)
	{
		$sinfo=$this->db->query("select * from subject_setup where sub_name='$sub_name'");
		if($this->db->affected_rows()>0)
		{
			return  2;
		}
		else 
		{
			return 1;
		}
	}
	
	public function short_name_exist_test($shrt_name)
	{
		$sinfo=$this->db->query("select * from subject_setup where short_name='$shrt_name'");
		if($this->db->affected_rows()>0)
		{
			return  2;
		}
		else 
		{
			return 1;
		}
	}
	
	public function selected_group($gid)
	{
		return $this->db->query("select * from group_setup where groupid='$gid'")->row();
	}
	
	public function subject_info($tbl,$w,$did)
	{
		return $this->db->select("*")->from($tbl)->where($w,$did)->get()->row();
	}
	
	
	public function subject_delete_test($sid)
	{
		$this->db->query("select * from subject_class where subsetid='$sid'");
		return $this->db->affected_rows();
	}
	
	public function subject_class_info($sid)
	{
		return $this->db->query("select s.*,c.* from subject_setup s,subject_class c where c.subjid='$sid' and c.subsetid=s.subsetid")->row();
	}
	
	public function class_delete_test($cls)
	{
		$this->db->query("select * from re_admission where classid='$cls'");
		return $this->db->affected_rows();
	}
	
	public function edit_class_info($cid)
	{
		return $this->db->query("select c.*,s.section_name,groupid,sectionid from class_catg c,section_tbl s where c.classid='$cid' and c.classid=s.classid")->result();
	}
	
	
	public function group_explode_array($grp)
	{
		$explode=explode(",",$grp);
		return $explode;
	}
	
	public function class_wise_subject($clsid)
	{
		return $this->db->query("select c.*,s.* from subject_class c,subject_setup s where c.classid='$clsid' and s.subsetid=c.subsetid")->result();
	}
	
	public function section_delete_test($sid)
	{
		$this->db->select("*")->from("re_admission")->where("section",$sid)->get();
		return $this->db->affected_rows();
	}
	
	public function get_class_name($cid)
	{
		return $this->db->select("*")->from("class_catg")->where("classid",$cid)->get()->row();
	}
	
	
}
?>