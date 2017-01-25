	<div class="row" style="margin-top:40px;">
		 <div class="col-md-12">
				
		 <!----///employee Search code close here///-->
		<?php 
		  $data=array();
		  if(isset($_POST['search_employee'])){
			extract($_POST);//desig dept_name type
			if(empty($desig) && empty($dept_name) && empty($type)){
			$where=array('status'=>1);
			}
			elseif(empty($desig) && empty($dept_name)){
				//echo "type";
				$where=array(
				'status'=>1,
				'emptypeid'=>$type
				);
			}
			elseif(empty($type) && empty($desig)){
				$where=array(
				'status'=>1,
				'department'=>$dept_name
				);
			}
			elseif(empty($type) && empty($dept_name)){
				$where=array(
				'status'=>1,
				'deginition'=>$desig
				);
			}
			elseif(empty($type)){
				$where=array(
				'status'=>1,
				'department'=>$dept_name,
				'deginition'=>$desig
				);
			}
			elseif(empty($desig)){
				$where=array(
				'status'=>1,
				'department'=>$dept_name,
				'emptypeid'=>$type
				);
			}
			elseif(empty($dept_name)){
				$where=array(
				'status'=>1,
				'emptypeid'=>$type,
				'deginition'=>$desig
				);
			}
			else {
			$where=array(
				'status'=>1,
				'department'=>$dept_name,
				'emptypeid'=>$type,
				'deginition'=>$desig
				);
			}
			$data['query']=$this->employee->employee_list($where);
		  }
		  else {
		  $where=array("status"=>1);
		  $data['query']=$this->employee->employee_list($where);
		  }
		  $this->load->view('employee_section/employee_report',$data);
		  ?>
		</div>
	</div>