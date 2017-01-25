<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_submit extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model("setting/setting_model","bsetting");
	}

	public function shift_setting()
	{
		$e_user=$this->session->userdata('userid');
		extract($_POST);
		if(trim($shift)=='') {
			echo "Field is Empty";exit;
		}
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required|is_unique[shift_catg.shift_N]');
		if ($this->form_validation->run() == FALSE) {
			echo "Shift Already Exist";exit;
		}
		$data=array('shift_N'=>$shift,'e_user'=>$e_user);
		$insert=$this->bsetting->all_insert("shift_catg",$data);
		
		if($insert)	{ echo 1;exit; } else { echo "Data Save Fail";exit; }
	}
	
	public function shift_edit()
	{
		
		$up_user=$this->session->userdata('userid');
		extract($_POST);
		if(trim($shift)=='') {
			echo "Field is Empty";exit;
		}
		$this->form_validation->set_rules('shift', 'Shift', 'trim|required|is_unique[shift_catg.shift_N]');
		if ($this->form_validation->run() == FALSE) {
			echo "Shift Already Exist";exit;
		}
		$data=array('shift_N'=>$shift,'up_user'=>$up_user);
		$where=array('shiftid'=>$shiftid);
		$up=$this->bsetting->all_update($where,"shift_catg",$data);
	
		if($up)	{ echo 1;exit; } else { echo "Update is Fail";exit; }
	}
	
	
	public function shift_delete()
	{
		extract($_GET);
		$test=$this->bsetting->shift_delete_test($id);
		if($test<1)
		{
			$del=$this->bsetting->all_delete('shift_catg','shiftid',$id);
			if($del)
			{
				echo "<script>alert('Data Delete Successfylly');</script>";
				redirect('basic_setting/setting');
				
			}	
		}
		else 
		{
			echo "<script>window.history.back();alert('You Can Not Delete Shift');</script>";
		}
	}
	
	
	public function group_setting()
	{
		$e_user=$this->session->userdata('userid');
		extract($_POST);
		if(trim($group)=='') {
			echo "Field is Empty";exit;
		}
		$this->form_validation->set_rules('group', 'group', 'trim|required|is_unique[group_setup.group_name]');
		
		if ($this->form_validation->run() == FALSE) {
			echo "Group Already Exist";exit;
		}
		
		$data=array('group_name'=>$group,'e_user'=>$e_user);
		$insert=$this->bsetting->all_insert("group_setup",$data);
		
		
		if($insert)	{ echo 1;exit; } else { echo "Data Save Fail";exit; }
	}
	
	
	public function group_edit()
	{
		
		$up_user=$this->session->userdata('userid');
		extract($_POST);
		if(trim($group)=='') {
			echo "Field is Empty";exit;
		}
		$this->form_validation->set_rules('group', 'group', 'trim|required|is_unique[group_setup.group_name]');
		if ($this->form_validation->run() == FALSE) {
			echo "Group Already Exist";exit;
		}
		$data=array('group_name'=>$group,'up_user'=>$up_user);
		$where=array('groupid'=>$groupid);
		$up=$this->bsetting->all_update($where,"group_setup",$data);
	
		if($up)	{ echo 1;exit; } else { echo "Update is Fail";exit; }
	}
	
	
	public function class_setting()
	{
		extract($_POST);
		/*print_r($_POST);
		echo count($section);
		echo count($group);
		exit;*/
		//class and shift validation start
		$e_user=$this->session->userdata('userid');
		$up_user=$this->session->userdata('userid');
		$this->form_validation->set_rules('cls_name', 'Class_name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo "Class Name is Empty";exit;
		}
		
		$this->form_validation->set_rules('shift_name', 'Shift Name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			echo "Shift Name is Empty";exit;
		}
		//class and shift validation end
		
		//class exist test start
		$test=$this->bsetting->exist_class_info($shift_name,$cls_name);
		if($test>0) { echo "Class Already Exist";exit; }
		//class exist test end
		
		// section validation start 
		
		if(!is_array($section))
		{
			echo "Please Add Section";exit;
		}
		// section validation end
		
		
		//section empty test
		if(in_array(" ",$section))
		{
			echo "Section is Empty";exit;
		}	
		//section empty test end
		
		
		//section dublicate test start
		$sec_unique=array_unique($section);
		if(count($sec_unique)!=count($section)) { echo "Section is Dublicate Entry"; exit; }
		//section dublicate test end
		
		$data=array(
		'shiftid'=>$shift_name,
		'class_name'=>$cls_name,
		'e_user'=>$e_user,
		'up_user'=>$up_user
		);
		
		//class entry start
		$action=$this->bsetting->all_insert("class_catg",$data);
		$clsid=$this->db->query("select classid from class_catg order by classid desc limit 1")->row()->classid;
		//class entry end
		
		
		//section entry start
		$i=count($section)-1;
		for($i;$i>=0;$i--) {
		$data=array(
		'classid'=>$clsid,
		'section_name'=>$section[$i],
		'groupid'=>$group[$i],
		'e_user'=>$e_user,
		'up_user'=>$up_user
		);
		
		$action=$this->bsetting->all_insert("section_tbl",$data);

		}
		//section entry end
		
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data not Save";exit;
		}
		
	}
	
	
	public function section_test()
	{
		extract($_POST);
		$test=$this->bsetting->section_test($_POST);
		if(count($test)>0)
		{
			$sec=$test->section;
			$ex=explode(",",$sec);
			if(in_array($section,$ex))
			{
				echo 2;
			}	
			else 
			{
				echo 1;
			}
		}
		else 
		{
			echo 1;
		}
	}
	
	
	public function subject_edit()
	{
		extract($_POST);
		if(trim($subject)=='')
		{
			echo "Subject Field is Empty";exit;
		}
		if(trim($short_name)=='')
		{
			echo "Short Name Field is Empty";exit;
		}	
		
		$up_user=$this->session->userdata('userid');
		
		$data1=array(
		'sub_name'=>$subject,
		'short_name'=>$short_name,
		'up_user'=>$up_user
		);
		$tbl="subject_setup";
		$w=array('subsetid'=>$hid_subid);
		$up=$this->bsetting->all_update($w,$tbl,$data1);
		if($up)
		{
			echo 1;exit;
		}
		else 
		{
			echo 2;exit;
		}
	}
	
	
	public function subject_delete()
	{
		extract($_GET);
		$test=$this->bsetting->subject_delete_test($id);
		if($test<1)
		{	
		$del=$this->bsetting->all_delete('subject_setup','subsetid',$id);
		if($del)
		{
			echo "<script>alert('Data Delete Successfully');</script>";
			redirect('basic_setting/setting');
			
		}
		
		}
		else 
		{
			echo "<script>window.history.back();alert('Sorry This Subject Already Use');</script>";
		}
	}
	
	public function section_delete()
	{
		extract($_GET);
		$test=$this->bsetting->section_delete_test($id);
		if($test>0)
		{
			echo "<script>window.history.back();alert('Sorry Can not Delete');</script>";
		}
		else 
		{
			$del=$this->bsetting->all_delete('section_tbl','sectionid',$id);
			if($del)
			{
				echo "<script>alert('Delete Successfully');</script>";
				redirect('basic_setting/setting','location');
			}	
		}
	}
	
	public function class_subject_delete()
	{
		extract($_GET);
		$del=$this->bsetting->all_delete('subject_class','subjid',$id);
		if($del)
		{
			echo "<script>window.history.back();alert('Data Delete Successfully');</script>";
			
		}
	}
	
	
	
	public function subject_class_edit()
	{
		extract($_POST);
		if(($theo_mark==0) || (trim($theo_mark)==''))
		{
			echo "Invalid Theory Mark";exit;
		}
		if(trim($sequence)=='')
		{
			echo "Invalid Sequence ";exit;
		}
		
		if(($total_mark<100) || (trim($total_mark)==''))
		{
			echo "Invalid Total Mark ";exit;
		}
		
		$data=array(
		'exm_mark'=>$total_mark,
		'stherory_mk'=>$theo_mark,
		'sobj_mk'=>$obj_mark,
		'sprack_mk'=>$prac_mark,
		'sequence'=>$sequence,
		'optional'=>$optional,
		'groupid'=>$group
		);
		
		$where=array('subjid'=>$hid_subid);
		$tbl="subject_class";
		$up=$this->bsetting->all_update($where,$tbl,$data);
		if($up)
		{
			echo 1;
		}
		else 
		{
			echo "Data Not Update";exit;
		}
	}
	
	
	public function class_edit()
	{
		extract($_POST);
		
		//class name update start
		$w=array('classid'=>$classid);
		$data=array('class_name'=>$class_name);
		if(empty($class_name)) { echo "Class Name is EMpty";exit; }
		$action=$this->bsetting->all_update($w,"class_catg",$data);
		//class name update end
		
		$i=0;
		foreach($section as $key=>$value)
		{
			if(empty($section_name[$key]))
			{ echo "section is Empty";exit; }
			$group_array=array();
			for($j=0;$j<$total_group;$j++)
			{
				if($chk_group[$i]>0)
				{
					array_push($group_array,$group[$i]);
				}	
				$i++;
			}
			$where=array('sectionid'=>$value);
			$grp=implode($group_array,',');
			$data=array('section_name'=>$section_name[$key],'groupid'=>$grp);
			$action=$this->bsetting->all_update($where,"section_tbl",$data);
		}
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Update";exit;
		}
		
	}
	
	
	public function subject_setup()
	{
		extract($_POST);

		if(!is_array($subject))
		{
			echo "Please Add Subject";exit;
		}
		$count=count($subject);
		$e_user=$this->session->userdata('userid');
		$j=1;
		for($i=0;$i<$count;$i++)
		{
			//empty test start
			if(trim($subject[$i])=='')
			{
				echo "Subject Field is Empty in Row Number ".$j;exit;
			}
			if(trim($short_name[$i])=='')
			{
				echo "Short Name Field is Empty in Row Number ".$j;exit;
			}	
			
			
			$sub_test=$this->bsetting->subject_exist_test($subject[$i]);
			if($sub_test>1) { echo "Subject ".$subject[$i]." Already Exist"; exit; }
			
			$short_test=$this->bsetting->short_name_exist_test($short_name[$i]);
			if($short_test>1) { echo "Short Name ".$short_name[$i]." Already Exist"; exit; }
			//existing data test end
			$j++;
		}
		
		$tbl="subject_setup";
		
		$unique_short_name=array_unique($short_name);
		$unique_subject=array_unique($subject);

		$unique_count_sub=count($unique_subject);
		if($unique_count_sub!=$count) { echo "Entry Error Subject is Dublicate"; exit; }
		
		$unique_count_short=count($unique_short_name);
		if($unique_count_short!=$count) { echo "Entry Error Short Name is Dublicate"; exit; }
		
		for($i=0;$i<$count;$i++)
		{
		$data=array(
		'sub_name'=>$subject[$i],
		'short_name'=>$short_name[$i],
		'e_user'=>$e_user
		);
		$insert=$this->bsetting->all_insert($tbl,$data);
		}
		
		if($insert)
		{
			echo 1;
		}
		else 
		{
			echo 2;
		}
	}
	
	
	public function subject_distribute()
	{
		extract($_POST);
		//print_r($_POST);exit;
		if(trim($sft_name)=='')
		{
			echo "Shift is Empty";exit;
		}
		if(trim($class_name)=='')
		{
			echo "Class is Empty";exit;
		}
		if(count($theo_mark)==0)
		{
			echo "Please Chose Subject";exit;
		}		
		$tbl="subject_class";
		$j=1;$i=0;
		foreach($sub_chk as $value)
		{
			if($value>0)
			{
				if(($theo_mark[$i]==0) || ($theo_mark[$i]==''))
				{
					echo "Invalid Theory Mark in Row Number ".$j;exit;
				}
				if(($total_mark[$i]==0) || ($total_mark[$i]>100))
				{
					echo "Invalid Total Mark Minimum 100 in Row Number ".$j;exit;
				}
				if(trim($sequence[$i])=='')
				{
					echo "Invalid Siquence in Row Number ".$j;exit;
				}	
				
				$row_test=$this->db->query("select * from  $tbl  where shiftid='$sft_name' and  classid='$class_name' and  subsetid='$value'");
				$row=$this->db->affected_rows();
				if($row>0)
				{
					echo "Subject Already Exist in Row Number ".$j;exit;
				}
				$i++;
			}
			$j++;
		}
		
		$i=0;
		foreach($sub_chk as $value)
		{
			if($value>0)
			{
				$data=array(
				'shiftid'=>$sft_name,
				'classid'=>$class_name,
				'groupid'=>$group[$i],
				'subsetid'=>$value,
				'exm_mark'=>$total_mark[$i],
				'stherory_mk'=>$theo_mark[$i],
				'sobj_mk'=>$obj_mark[$i],
				'sprack_mk'=>$prac_mark[$i],
				'sequence'=>$sequence[$i],
				'optional'=>$optional[$i]
				);
				$insert=$this->bsetting->all_insert($tbl,$data);
				$i++;
			}
		}
		
		if($insert)
		{
			echo 1;
		}
		else 
		{
			echo "Data Not Save";
		}
		
	}
	
	
	public function class_delete()
	{
		extract($_GET);
		$test=$this->bsetting->class_delete_test($id);
		if($test>0)
		{
			echo "<script>window.history.back();alert('Sorry Can not Delete');</script>";
		}
		else 
		{
			$del=$this->bsetting->all_delete('class_catg','classid',$id);
			$del=$this->bsetting->all_delete('section_tbl','classid',$id);
			if($del)
			{
				echo "<script>alert('Delete Successfully');</script>";
				redirect('basic_setting/setting','location');
			}	
		}
	}
	
	public function group_delete()
	{
		extract($_GET);
		$test=$this->db->query("select * from re_admission where groupid='$id'")->result();
		if(count($test)>0)
		{
			echo "<script>window.history.back();alert('Sorry Can not Delete');</script>";
		}
		else 
		{
			$del=$this->bsetting->all_delete('group_setup','groupid',$id);
			if($del)
			{
				//echo "<script>alert('Delete Successfully');</script>";
				redirect('basic_setting/setting?d=1','location');
			}
			else 
			{
				redirect('basic_setting/setting?d=0','location');
			}
				
		}
	}
	

}

