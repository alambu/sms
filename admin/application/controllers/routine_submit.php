<?php 
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class routine_submit extends CI_Controller {
	
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
		$this->load->model("setting/setting_model","bsetting");
		$this->load->model('student/student_model','student');
		$this->load->model('employee/employee_model','employee');
		$this->load->model('class_routine/routine_model','routine');
	}
	
	
	public function period_length_setup()
	{
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		//validation start
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($year)=='') { echo "Year is Empty";exit; }
		if(trim($cls_length)=='') { echo "Maximum Period is Empty";exit; }
		//validation end
		$where=array('shiftid'=>$shift,'year'=>$year);
		$exist_test=$this->routine->maximum_period($where);
		
		$data=array(
		'shiftid'=>$shift,
		'year'=>$year,
		'max_period'=>$cls_length,
		'e_user'=>$e_user,
		'up_user'=>$e_user
		);
		
		if(count($exist_test)>0)
		{
			$action=$this->bsetting->all_update($where,"maximum_period",$data);
		}
		else 
		{
			$action=$this->bsetting->all_insert("maximum_period",$data);
		}
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Save";
		}
	}
	
	
	
	public function shidule_edit()
	{
		//print_r($_POST);
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		
		//validation start
		
		if(trim($year)=='') { echo "Empty Year";exit; }
		if(trim($shift)=='') { echo "Empty Shift";exit; }
		
		
		//schdule edit test start 
		$w=array('shiftid'=>$shift,'year'=>$year);
		$test=$this->routine->class_period($w);
		if(count($test)>0) { echo "Sorry You Can Not Edit";exit; }
		//schdule edit test end
		
		if(!is_array($stime)) { echo "Please Add Shidule"; exit; }
		$j=1;//print_r($stime);
		foreach($stime as $key=>$value)
		{	//echo $key;exit;
			if(trim($value)=='') { echo "Start Time is Empty in Row Number ".$j; exit;  }
			
			if(trim($etime[$key])=='') { echo "End Time is Empty in Row Number ".$j; exit;  }
			
			if(trim($period_title[$key])=='') { echo "Period Title is Empty in Row Number ".$j; exit;  }
			
			$st=date("H:i",strtotime($value));
			$et=date("H:i",strtotime($etime[$key]));
			
			if($key>0)
			{	//echo $key;exit;
				$str=date("H:i",strtotime($value));
				$etr=date("H:i",strtotime($etime[$key-1]));
				$p=$j;
				if($str<=$etr) { echo "Start Time is Small or Equal in Row Number ".--$p;exit; }
			}	
			
			if($st>=$et) { echo "Start Time is Big in Row Number ".$j;exit; }
			
			$j++;
		}
		//validation end 
		
		//data action start
		foreach($stime as $key=>$value)
		{
			$data=array(
			'shiftid'=>$shift,
			'year'=>$year,
			'stime'=>$value,
			'etime'=>$etime[$key],
			'period_title'=>$period_title[$key],
			'e_user'=>$e_user,
			'up_user'=>$e_user
			);
			$where_update=array('year'=>$year,'shiftid'=>$shift,'shidule_id'=>$shidule_id[$key]);
			if($shidule_id[$key]!='') { $action=$this->bsetting->all_update($where_update,"routine_shidule",$data); }
			else { $action=$this->bsetting->all_insert("routine_shidule",$data); }	

		}
		
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Save";exit;
		}
		//data action end
	}
	
	
	
	
	public function shidule_setup()
	{
		//print_r($_POST);exit;
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		
		//validation start
		
		if(trim($year)=='') { echo "Empty Year";exit; }
		if(trim($shift)=='') { echo "Empty Shift";exit; }
		
		if(!is_array($stime)) { echo "Please Add Shidule"; exit; }
		
		$j=1;//print_r($stime);
		foreach($stime as $key=>$value)
		{	//echo $key;exit;
			if(trim($value)=='') { echo "Start Time is Empty in Row Number ".$j; exit;  }
			
			if(trim($etime[$key])=='') { echo "End Time is Empty in Row Number ".$j; exit;  }
			
			if(trim($period_title[$key])=='') { echo "Period Title is Empty in Row Number ".$j; exit;  }
			
			$st=date("H:i",strtotime($value));
			$et=date("H:i",strtotime($etime[$key]));
			
			if($key>0)
			{	//echo $key;exit;
				$str=date("H:i",strtotime($value));
				$etr=date("H:i",strtotime($etime[$key-1]));
				$p=$j;
				if($str<=$etr) { echo "Start Time is Small or Equal in Row Number ".--$p;exit; }
			}	
			
			if($st>=$et) { echo "Start Time is Big in Row Number ".$j;exit; }
			
			$j++;
		}
		
		//validation end 
		
		$where=array('year'=>$year,'shiftid'=>$shift);
		$exist_test=$this->routine->shift_shidule($where);
		if(count($exist_test)>0) { echo "Already Setup"; exit; }
		//data action start
		foreach($stime as $key=>$value)
		{
			$data=array(
			'shiftid'=>$shift,
			'year'=>$year,
			'stime'=>$value,
			'etime'=>$etime[$key],
			'period_title'=>$period_title[$key],
			'e_user'=>$e_user,
			'up_user'=>$e_user
			);
			$action=$this->bsetting->all_insert("routine_shidule",$data);

		}
		
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Save";exit;
		}
		//data action end
	}

	
	public function class_period_setup()
	{
		//print_r($_POST);
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		if(trim($year)=='') { echo "Empty Year";exit; }
		if(trim($shift)=='') { echo "Empty Shift";exit; }
		if(trim($stime)=='') { echo "Empty Start Time";exit; }
		if(trim($total_period)=='') { echo "Empty Total Class";exit; }
		if(trim($cls)=='') { echo "Empty Class";exit; }
		$where=array('year'=>$year,'shiftid'=>$shift,'classid'=>$cls);
		
		$test_array=array('shidule_id'=>$stime);
		$routine=$this->routine->class_routine($test_array);
		if(count($routine)>0) { echo "Sorry You Can Not Edit";exit; }
		
		$where1=array('year'=>$year,'shiftid'=>$shift,'period_title'=>1,'shidule_id>='=>$stime);
		$exist_test=$this->routine->class_period($where);
		if(count($exist_test)>0) 
		{
			$ac='up'; 
		} 
		else { $ac='in'; }
		
		$data=array(
		'shiftid'=>$shift,
		'classid'=>$cls,
		'maxclass'=>$total_period,
		'year'=>$year,
		'shidule_id'=>$stime,
		'e_user'=>$e_user
		);
		
		$i=1;
		$ptest=$this->routine->shift_shidule($where1);
		if(count($ptest)<$total_period) 
		{
			echo "Period is Large For Time Schedule";exit; 
		}
		
		if($ac=='in') { $action=$this->bsetting->all_insert("class_period",$data); } 
		else { $action=$this->bsetting->all_update($where,"class_period",$data); }
		if($action) { echo 1;exit; }
		else { echo "Data Not Save"; }
	}
	
	public function class_teacher_setup()
	{
		//print_r($_POST);
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		//validation start
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='')   { echo "Class is Empty";exit; }
		if(trim($year)=='')  { echo "Year is Empty";exit;  }
		if(trim($section)=='')  { echo "Section is Empty";exit;  }
		if(trim($teacher)=='')  { echo "Teacher is Empty";exit;  }
		//validation end
		
		$where1=array('years'=>$year,'shiftid'=>$shift,'classid'=>$cls,'section'=>$section);
		//teacher exist test start
		$where3=array('years'=>$year,'empid'=>$teacher);
		$teacher_test=$this->routine->class_teacher($where3);
		if(count($teacher_test)>0) { echo "Teacher Already Exist";exit; }
		//teacher exist test end
		
		//insert update test start
		$test=$this->routine->class_teacher($where1);
		if(count($test)>0) 
		{
			
		$ac="up";
		} 
		else 
		{ 
		
		$ac='in'; 
		}
		// insert update test end
		
		$data=array(
		'empid'=>$teacher,
		'shiftid'=>$shift,
		'classid'=>$cls,
		'section'=>$section,
		'years'=>$year,
		'status'=>1,
		'e_user'=>$e_user
		);
		
		if($ac=='in') { $action=$this->bsetting->all_insert("class_tehsett",$data); }
		
		else { $action=$this->bsetting->all_update($where1,"class_tehsett",$data); }
		
		if($action) { echo 1;exit; }
		else { echo "Data Not Save";exit; }
	}
	
	public function routine_not_group_create()
	{
		extract($_POST);
		//routine exist test start
		$rw=array('year'=>$year,'shiftid'=>$shift,'classid'=>$cls,'section'=>$section);
		$routine=$this->routine->class_routine($rw);
		if(count($routine)>0) { echo "Routine Already Create You Can Edit Now";exit; }
		//routine exist test end 
	
		//validation start
		$e_user=$this->session->userdata('userid');
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='') { echo "Class is Empty";exit; }
		if(trim($year)=='') { echo "Year is Empty";exit; }
		if(trim($section)=='') { echo "section is Empty";exit; }
		foreach($shidule_id as $value)
		{
			if(trim($value)=='') { echo "Schedule is Empty"; exit; }
		}
		$days=array('0'=>'Satarday','1'=>'Sunday','2'=>'Monday','3'=>'Tuesday','4'=>'Wednsday','5'=>'Thusday','6'=>'Friday');
		
		$k=0;
		for($i=0;$i<=6;$i++)
		{
			if($i<5)
			{
				
				for($j=0;$j<$total_period;$j++)
				{	
					$p=$j;
					if(trim($subject[$k])=='') { echo "Subject is Empty in ".$days[$i]." ".++$p."th Period"; exit; }
					if(trim($teacher[$k])=='') { echo "Teacher is Empty in ".$days[$i]." ".++$p."th Period"; exit; }
					
					//Teacher exist test start
					$d=$i;
					$where=array('year'=>$year,'day'=>++$d,'shiftid'=>$shift,'teacherid'=>$teacher[$k],'shidule_id'=>$shidule_id[$j]);
					$test=$this->routine->class_routine($where);
					if(count($test)>0) { echo "Teacher Already Exist in ".$days[$i]." ".++$p."th Period"; exit;  }
					//Teacher exist test end
					$k++;
				}
			
			}
			
			
			//start thusday
			elseif($i==5) 
			{
				
				for($l=0;$l<$total_period;$l++)	
				{
					$p=$l;
					if($l<4) {	
					if(trim($subject[$k])=='') { echo "Subject is Empty in ".$days[$i]." ".++$p."th Period"; exit; }
					if(trim($teacher[$k])=='') { echo "Teacher is Empty in ".$days[$i]." ".++$p."th Period"; exit; }
					}
					else 
					{
						if(!empty($subject[$k]))
						{
							if(empty($teacher[$k]))
							{
								echo "Teacher is Empty in ".$days[$i]." ".++$p."th Period"; exit;
								
								//Teacher exist test start
								$d=$i;
								$where=array('year'=>$year,'day'=>++$d,'shiftid'=>$shift,'teacherid'=>$teacher[$k],'shidule_id'=>$shidule_id[$j]);
								$test=$this->routine->class_routine($where);
								if(count($test)>0) { echo "Teacher Already Exist in ".$days[$i]." ".++$p."th Period"; exit;  }
								//Teacher exist test end
								
							}	
						}	
					}
					
					
					$k++;
				}
				
			}

			//start fri day
			elseif($i==6) 
			{
			for($j=0;$j<$total_period;$j++)
			{	
				$p=$j;	
				if(!empty($subject[$k])) 
				{
				if(empty($teacher[$k]))
				{
				echo "Teacher is Empty in ".$days[$i]." ".++$p."th Period"; exit; 
				//Teacher exist test start
				$d=$i;
				$where=array('year'=>$year,'day'=>++$d,'shiftid'=>$shift,'teacherid'=>$teacher[$k],'shidule_id'=>$shidule_id[$j]);
				$test=$this->routine->class_routine($where);
				if(count($test)>0) { echo "Teacher Already Exist in ".$days[$i]." ".++$p."th Period"; exit;  }
				//Teacher exist test end
				}
				}
				
				$k++;
			}
			
			}
		
		}
		
		//action start
		
		$k=0;$d=0;
		for($i=0;$i<=6;$i++) 
		{
		$d++;	
		$p=$i;
		for($j=0;$j<count($shidule_id);$j++)	
		{
		$w=array('year'=>$year,'shiftid'=>$shift,'shidule_id'=>$shidule_id[$j]);	
		$break_test=$this->routine->routine_break_test($w);
		$data=array(
		'classid'=>$cls,
		'section'=>$section,
		'groupid'=>'',
		'subjid'=>$subject[$k],
		'shiftid'=>$shift,
		'teacherid'=>$teacher[$k],
		'day'=>$d,
		'shidule_id'=>$shidule_id[$j],
		'year'=>$year,
		'status'=>1,
		'e_user'=>$e_user,
		'up_user'=>$e_user
		);
		
		if($break_test->period_title>0) { $k++; }
		
		$action=$this->bsetting->all_insert("routine",$data);
		}
		
		}
		
		//action end
		if($action)
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Save";exit;
		}
		//print_r($_POST);
		
	}
	
	
	
	public function routine_not_group_create_edit()
	{
		//print_r($_POST);exit;
		extract($_POST);
		$e_user=$this->session->userdata('userid');
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='') { echo "Class is Empty";exit; }
		if(trim($year)=='') { echo "Year is Empty";exit; }
		if(trim($section)=='') { echo "section is Empty";exit; }
		if(trim($day)=='') { echo "Day is Empty";exit; }
		
		foreach($routine_id as $value)
		{
			if(trim($value)=='') { echo "Routine is Empty"; exit; }
		}
		
		if($day<=5)
		{
			
		for($j=0;$j<$total_period;$j++)
		{	
			$p=$j;	
			if(trim($subject[$j])=='') { echo "Subject is Empty in ".++$p."th Period"; exit; }
			
			if(trim($teacher[$j])=='') { echo "Teacher is Empty in ".++$p."th Period"; exit; }
			
			$exist=$this->routine->routine_edit_teacher_exist_test($teacher[$j],$routine_id[$j]);
			
			if(!$exist) { echo "Teacher Already Exist Another Class";exit; }
		}
		
		}
		
		//start thusday
		elseif($day==6) 
		{
			
		for($l=0;$l<4;$l++)	
		{
			$p=$l;
			if(trim($subject[$l])=='') { echo "Subject is Empty in ".++$p."th Period"; exit; }
			if(trim($teacher[$l])=='') { echo "Teacher is Empty in ".++$p."th Period"; exit; }
			$exist=$this->routine->routine_edit_teacher_exist_test($teacher[$j],$routine_id[$j]);
			if(!$exist) { echo "Teacher Already Exist Another Class";exit; }
			//$k++;
		}
		
		}
		
		//start fri day
		else 
		{
			
		for($j=0;$j<$total_period;$j++)
		{	
			$p=$j;
			if(!empty($subject[$j])) 
			{
			if(empty($teacher[$j]))
			{
			echo "Teacher is Empty in ".++$p."th Period"; exit; 
			$exist=$this->routine->routine_edit_teacher_exist_test($teacher[$j],$routine_id[$j]);
			if(!$exist) { echo "Teacher Already Exist Another Class";exit; }
			}
			}
		}
		
		}
		
		$j=0; //echo count($routine_id);echo count($subject);exit;
		for($i=0;$i<count($routine_id);$i++)
		{
			$shiduleid=$this->db->select("shidule_id")->from("routine")->where("routineid",$routine_id[$i])->get()->row()->shidule_id;
			$w=array('year'=>$year,'shiftid'=>$shift,'shidule_id'=>$shiduleid);	
			$break_test=$this->routine->routine_break_test($w);
			if($break_test->period_title>0){
			$data=array(
			'subjid'=>$subject[$j],
			'teacherid'=>$teacher[$j]
			);
			$where=array('routineid'=>$routine_id[$i]);
			$action=$this->bsetting->all_update($where,"routine",$data);
			$j++;
			}
		}
		if($action) 
		{
			echo 1;exit;
		}
		else 
		{
			echo "Data Not Save";exit;
		}
		
	}
	
	
	
	public function routine_group_create()
	{
		extract($_POST);
		//validation start
		$e_user=$this->session->userdata('userid');
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='') { echo "Class is Empty";exit; }
		if(trim($year)=='') { echo "Year is Empty";exit; }
		if(trim($section)=='') { echo "section is Empty";exit; }
		//validation end
		$rw=array('year'=>$year,'shiftid'=>$shift,'classid'=>$cls,'section'=>$section,'day'=>$day);

		//routine exist test start
		$test=$this->routine->class_routine($rw);
		if(count($test)>0) { echo "Routine Already Exist This Day";exit; }
		//routine exist test end
		
		$period=1;
		//period empty validation test start
		foreach($grp_title as $key=>$value)
		{	
			if($day<6) 
			{
				if($value=='')
				{
					echo "Period is Empty in Period Number ".++$key;exit;
				}
				elseif($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				elseif($value==1)
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
			}
			elseif($day==6)
			{	
				if($period<5) {
					
				if($value=='')
				{
					echo "Period is Empty in Period Number ".++$key;exit;
				}
				elseif($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				
				elseif($value==1)
				
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
				
				}
				
				else 
				{
					if($value!='')
					{
					
					if($value==0)
					{
						if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
						if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
						
					}
					
					elseif($value==1)
					
					{
						$g=$key;
						for($i=1;$i<=$total_group;$i++)
						{
							if($i==1) { $t=$g*$total_group; }
						if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
						if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
						$t++;
						}
					}
					
					}
				}
				
				$period++;
			}
			
			else 
			{
				if($value!='')
				{
				
				if($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				
				elseif($value==1)
				
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
				
				}
			}
			
		}
		//period empty validation test end
		
		$j=0;
		//teacher exist test start
		//echo count($shidule_id);exit;
		foreach($shidule_id as $key=>$value)
		{	
				$w=array('shidule_id'=>$value);
				$break_test=$this->routine->routine_break_test($w);
				if($break_test->period_title==1) 
				{
					if($day<6) {
					$per=$key;
					if($grp_title[$j]==0)
					{
						$teacher=$teacher_com[$j];
						$w=array('year'=>$year,'shiftid'=>$shift,'day'=>$day,'shidule_id'=>$value,'teacherid'=>$teacher);
						$exist_test=$this->routine->class_routine($w);
						if(count($exist_test)>0) { echo "Teacher Already Exist in Period ".++$per;exit; }
					}
					
					elseif($grp_title[$j]==1)
					{
						$g=$j;
						for($i=1;$i<=$total_group;$i++)
						{
						if($i==1) { $t=$g*$total_group; }
						$teacher=$teacher_grp[$t];
						$w=array('year'=>$year,'shiftid'=>$shift,'day'=>$day,'shidule_id'=>$value,'teacherid'=>$teacher);
						$exist_test=$this->routine->class_routine($w);
						if(count($exist_test)>0) { echo "Teacher Already Exist in Period ".++$per;exit; }
						$t++;
						}
					}
					
					}
					
					elseif($day==6)
					{
						
					}
					
					$j++;
					
				}

		}
		//teacher exist test end
		
		//routine exist test start
		$routine=$this->routine->class_routine($rw);
		if(count($routine)>0) { echo "Already Create You Can Edit Now";exit; }
		//routine exist test end 
		
		
		
		
		//data insert start
		$j=0;
		foreach($shidule_id as $key=>$value)
		{	
				$w=array('shidule_id'=>$value);
				$break_test=$this->routine->routine_break_test($w);
				$subject='';
				$teacher='';
				$grp='';
				$subj=array();
				$teach=array();
				$grpid=array();
				if($break_test->period_title==1) { 
				
					if($grp_title[$j]==0)
					{
						
						$subject=$subject_com[$j];
						$teacher=$teacher_com[$j];
						$grp='';
					}
					
					elseif($grp_title[$j]==1)
					{
						$g=$j;
						for($i=1;$i<=$total_group;$i++)
						{
						if($i==1) { $t=$g*$total_group; }	
						array_push($subj,$subject_grp[$t]);
						array_push($teach,$teacher_grp[$t]);
						array_push($grpid,$group[$t]);
						$t++;
						}
						
						$subject=implode($subj,",");
						$teacher=implode($teach,",");
						$grp=implode($grpid,",");
					}
					
					$j++;
					
				}
				
				else 
				{
					$subject='';
					$teacher='';
					$grp='';
				}
				
				$data=array(
				'classid'=>$cls,
				'section'=>$section,
				'groupid'=>$grp,
				'subjid'=>$subject,
				'shiftid'=>$shift,
				'teacherid'=>$teacher,
				'day'=>$day,
				'shidule_id'=>$value,
				'year'=>$year,
				'status'=>1,
				'e_user'=>$e_user
				);
				$action=$this->bsetting->all_insert('routine',$data);
		}
		//data insert end
		
		if($action) { echo 1;exit; } else { echo "Data Not Save";exit; }
		
		
	}

	
	public function routine_group_create_edit()
	{
		extract($_POST);
		//validation start
		$e_user=$this->session->userdata('userid');
		if(trim($shift)=='') { echo "Shift is Empty";exit; }
		if(trim($cls)=='') { echo "Class is Empty";exit; }
		if(trim($year)=='') { echo "Year is Empty";exit; }
		if(trim($section)=='') { echo "section is Empty";exit; }
		//validation end
		$rw=array('year'=>$year,'shiftid'=>$shift,'classid'=>$cls,'section'=>$section,'day'=>$day);
		$period=1;
		//echo $day;exit;
		
		//period empty validation test start
		foreach($grp_title as $key=>$value)
		{	
			if($day<6) 
			{
				if($value=='')
				{
					echo "Period is Empty in Period Number ".++$key;exit;
				}
				elseif($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				elseif($value==1)
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
			}
			elseif($day==6)
			{	
				if($period<5) {
					
				if($value=='')
				{
					echo "Period is Empty in Period Number ".++$key;exit;
				}
				elseif($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				
				elseif($value==1)
				
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
				
				}
				
				else 
				{
					if($value!='')
					{
					
					if($value==0)
					{
						if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
						if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
						
					}
					
					elseif($value==1)
					
					{
						$g=$key;
						for($i=1;$i<=$total_group;$i++)
						{
							if($i==1) { $t=$g*$total_group; }
						if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
						if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
						$t++;
						}
					}
					
					}
				}
				
				$period++;
			}
			
			else 
			{
				if($value!='')
				{
				
				if($value==0)
				{
					if($subject_com[$key]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_com[$key]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					
				}
				
				elseif($value==1)
				
				{
					$g=$key;
					for($i=1;$i<=$total_group;$i++)
					{
						if($i==1) { $t=$g*$total_group; }
					if($subject_grp[$t]=='') { echo "Subject is Empty in Period Number ".++$key;exit; }
					if($teacher_grp[$t]=='') { echo "Teacher is Empty in Period Number ".++$key;exit; }
					$t++;
					}
				}
				
				}
			}
			
		}
		//period empty validation test end
		
		
		$j=0;
		//teacher exist test start
		
		foreach($shidule_id as $key=>$value)
		{	
				$w=array('shidule_id'=>$value);
				$break_test=$this->routine->routine_break_test($w);
				if($break_test->period_title==1) 
				{ 
					if($day<6) {
					if($grp_title[$j]==0)
					{
						$teacher=$teacher_com[$j];
						$exist_test=$this->routine->routine_edit_teacher_exist_test($teacher,$routineid[$key]);
						if($exist_test==false) { echo "Teacher Already Exist"; exit; }
					}
					
					elseif($grp_title[$j]==1)
					{
						$g=$j;
						for($i=1;$i<=$total_group;$i++)
						{
						if($i==1) { $t=$g*$total_group; }
						$teacher=$teacher_grp[$t];
						$exist_test=$this->routine->routine_edit_teacher_exist_test($teacher,$routineid[$key]);
						if($exist_test==false) { echo "Teacher Already Exist"; exit; }
						$t++;
						}
					}
					}
					elseif($day==6)
					{
						
					}
					$j++;
					
				}

		}
		//teacher exist test end
		
		//data insert start
		$j=0;
		foreach($shidule_id as $key=>$value)
		{	
				$w=array('shidule_id'=>$value);
				$break_test=$this->routine->routine_break_test($w);
				$subject='';
				$teacher='';
				$grp='';
				$subj=array();
				$teach=array();
				$grpid=array();
				if($break_test->period_title==1) { 
				
					if($grp_title[$j]==0)
					{
						
						$subject=$subject_com[$j];
						$teacher=$teacher_com[$j];
						$grp='';
					}
					
					elseif($grp_title[$j]==1)
					{
						$g=$j;
						for($i=1;$i<=$total_group;$i++)
						{
						if($i==1) { $t=$g*$total_group; }	
						array_push($subj,$subject_grp[$t]);
						array_push($teach,$teacher_grp[$t]);
						array_push($grpid,$group[$t]);
						$t++;
						}
						
						$subject=implode($subj,",");
						$teacher=implode($teach,",");
						$grp=implode($grpid,",");
					}
					
					$j++;
					
				}
				
				else 
				{
					$subject='';
					$teacher='';
					$grp='';
				}
				
				$data=array(
				'classid'=>$cls,
				'section'=>$section,
				'groupid'=>$grp,
				'subjid'=>$subject,
				'shiftid'=>$shift,
				'teacherid'=>$teacher,
				'day'=>$day,
				'shidule_id'=>$value,
				'year'=>$year,
				'status'=>1,
				'e_user'=>$e_user
				);
				$where=array('routineid'=>$routineid[$key]);
				$action=$this->bsetting->all_update($where,'routine',$data);
		}
		//data insert end
		
		if($action) { echo 1;exit; } else { echo "Data Not Save";exit; }
	}
	
	
	
}	
?>