<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class library_submit extends CI_Controller {
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
		
	


	// ----------------libray submit start-----------------------
	public function category_form()
	 {
	  if(isset($_POST['submit'])){
		  $catg_type=$this->input->post('catagory');
		  $t=count($catg_type);
		  $e_date=date("Y-m-d h:i:A");
		  $e_user=$this->session->userdata('userid');
		  $ok=0;$wrong=0;$in=1;
		  // Start insert for loop
		  for($i=$t-1;$i>=0;$i--) {
			$type=strtoupper($catg_type[$i]);  
			$data=array(
			'bctg_id'=>'',
			'catg_type'=>$type,
			'e_date'=>$e_date,
			'e_user'=>$e_user,
			'up_date'=>''
			); 
			
			$chk=$this->db->query("select * from book_catg where catg_type='$type'");
			
			$row=$chk->num_rows();
			
			if($row<1){
			$insert=$this->db->insert("book_catg",$data);
			if($insert){ $in++; } else {  }
			}
			else {
			 //$wrong++;	
			}
		  }
		  
		  //End insert For loop
		  
		  if($in==1 || $in>1){
		   $msg=array(
		   'in'=>$in
		   );
		   $this->session->set_userdata($msg);
	       redirect('library_section/book_setup','location');
		} 
	  }
	  
	  if(isset($_POST['catg_delete'])){
		 $id=$this->input->post('catg_delete');
		 $chk=$this->db->query("select * from book_list where bctg_id='$id'");
		 if($chk->num_rows()==0){
			 $delete=$this->db->query("delete from book_catg where bctg_id='$id'");
			 if($delete){
			/* $info=array(
			 'del_id'=>1
			 );
			 $this->session->set_userdata($info);*/
			 }
			 redirect('library_section/book_edit','location');
		 }
		 else {
			 /*
			 $info=array(
			 'del_id'=>2
			 );
			 $this->session->set_userdata($info);*/
			 redirect('library_section/book_edit','location');
		 }
	  }
	 
	  
	 }
	 
	 public function book_list_form()
	 {
	  if(isset($_POST['submit'])){
		  extract($_POST);
		  $t=count($book_name);
		  $e_date=date("Y-m-d h:i:A");
		  $e_user=$this->session->userdata('userid');
		  $ok=0;$wrong=0;$in=1;
		  
		  for($i=0;$i<$t;$i++) {
			  
			  $book=strtoupper($book_name[$i]);
			  $writer=strtoupper($writer_name[$i]);
			  $quantity=$tquantity[$i];
			  
			  $data=array(
			  'blist_id'=>'',
			  'bctg_id'=>$catagory,
			  'bookN'=>$book,
			  'writterN'=>$writer,
			  'tquantity'=>$quantity,
			  'price'=>$price[$i],
			  'fineprice'=>$fine_price[$i],
			  'e_date'=>$e_date,
			  'e_user'=>$e_user,
			  'up_date'=>''
			  );
			  if($book!=''){
			  $chk=$this->db->query("select * from  book_list where bookN='$book'");
			  $row=$chk->num_rows();
			  if($row<1){
			  if($fine_price[$i]<101){		
			  $insert=$this->db->insert("book_list",$data);
			  }
			  if($insert){ $in++; } else {  }
			  }
			  else {
				//$wrong++;
			  }
			  }
			  else {
				  //$wrong++;
			  }
		  }
		  
		   if($in>=1){
		   $msg=array(
		   'in'=>$in
		   );
		   $this->session->set_userdata($msg);
	       redirect('library_section/book_setup','location');
		  } 
	  }	 
	 
	 }
	
	 public function book_code_form()
	 {
	  
		 extract($_POST);
		 $e_date=date("Y-m-d h:i:A");
		 $e_user=$this->session->userdata('userid');
		 $i=1;$j=1;
		 if(trim($list_id)=='') { exit; }
		 
		 foreach($bk_code as $value)
		 { 
			if(trim($value)=='')
			{
				echo "bk_".$i;exit;
			}
			$i++;
		 }
		 
		 foreach($bk_code as $value)
		 {
			 
			$test=$this->db->select("book_id")->from("book_code")->where("book_id",$value)->get();
			if($this->db->affected_rows()>0){
				echo "ck_".$j;exit; 
			}
			$j++;
		 }
		 
		 foreach($bk_code as $book_id)
		 {
		 $data=array(
		 'blist_id'=>$list_id,
		 'book_id'=>$book_id,
		 'e_date'=>$e_date,
		 'e_user'=>$e_user,
		 'up_date'=>'',
		 'up_user'=>''
		 );
		 $insert=$this->db->insert("book_code",$data);
		}
		if($insert)
		{
			echo "ok";
		}
		else
		{
			echo "wrong";
		}	
	 
	 }
	 
	 public function book_distribution_form()
	 {
	  if(isset($_POST['submit'])){
		  extract($_POST);
		  $e_date=date("Y-m-d h:i:A");
		  $e_user=$this->session->userdata('userid');
		  $ok=0;$wrong=0;$dis=1;
		  $data=array(
		  'bdis_id'=>'',
		  'stu_id'=>$student_id,
		  'book_id'=>$book_id,
		  'stdrdate'=>date("Y-m-d",strtotime($given_date)),
		  'stdreturn'=>date("Y-m-d",strtotime($return_date)),
		  'lib_recdate'=>'',
		  'e_date'=>$e_date,
		  'e_user'=>$e_user,
		  'up_date'=>'',
		  'up_user'=>''
		  );
		  if($given_date=='' || $return_date=='' || $book_id=='' || $student_id==''){
			  $msg=array(
			   'dis'=>$dis
			   );
		     $this->session->set_userdata($msg);
			 redirect('library_section/book_dist_return','location');
		  }
		  if($given_date>$return_date){
			  $msg=array(
			   'dis'=>$dis
			   );
		     $this->session->set_userdata($msg);
			 redirect('library_section/book_dist_return','location');
		  }
		  
		  $cbk=$this->db->query("select * from book_code where book_id='$book_id'");
		  $row=$cbk->num_rows();
		  if($row==0){
			$msg=array(
			   'dis'=>$dis
			   );
		     $this->session->set_userdata($msg);
			 redirect('library_section/book_dist_return','location');  
		  }
		  else {
		  $st=$cbk->row()->status;
		  if($st<1){
		  $insert=$this->db->insert("book_sdistribute",$data);
		  if($insert){
		  $where=array('book_id'=>$book_id);
		  $tbl="book_code";
		  $data=array('status'=>1);	  
		  $up=$this->lib_report->library_update($where,$tbl,$data);
		  if($up){
			  
			  $dis++; 
			} 
			
			} 
			
		}
			
			} 
		  if($dis>=1){
			 $msg=array(
			   'dis'=>$dis
			   );
		     $this->session->set_userdata($msg);
			 redirect('library_section/book_dist_return','location');
			}
		else {
			 $msg=array(
			   'dis'=>$dis
			   );
		     $this->session->set_userdata($msg);
			redirect('library_section/book_dist_return','location'); 
		}
		  
	  }
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
	
	public function data_passTo_modal()
	{
		if(isset($_POST)){
			extract($_POST);
			if($typ=='catg'){
				$select=$this->lib_report->book_list_bycatg($e_id);
				echo $select->bctg_id.",".$select->catg_type;
			}
			else if($typ=='book_list'){
				$select=$this->lib_report->book_list_info($e_id);
				echo $select->blist_id.",".$select->bookN.",".$select->writterN.",".$select->tquantity.",".$select->price.",".$select->fineprice;
			}
			elseif($typ=='all_book_list'){
				$select=$this->lib_report->book_info($e_id);
				echo $select->blist_id.",".$select->bookN.",".$select->writterN.",".$select->tquantity.",".$select->price.",".$select->fineprice.",".$select->book_id;
			}
			elseif($typ=='restore'){
				$bk_code;
			}
		}
		
	}
	
	public function ajax_edit() {
		if(isset($_POST)){
			extract($_POST);
			$v=strtoupper($u_v);
			$up_date=date("Y-m-d h:i:A");
			$up_user=$this->session->userdata('userid');
			
			
			//catagory update start
			
			if($typ=='catg'){
				$data=array(
				'catg_type'=>$v,
				'up_date'=>$up_date,
				'up_user'=>$up_user
				);
				$qu=$this->db->query("select * from book_catg where catg_type='$v'")->num_rows();
				if($qu==0){
				$where=array('bctg_id'=>$u_id);
				$tbl="book_catg";
				$up=$this->lib_report->library_update($where,$tbl,$data);
				if($up){
					echo 1;
				}
				else {
					echo 0;
				}
				
				}
				else {
					echo 2;
				}
			}
			
			//catagory update end
			
			//book list update start
			
			elseif($typ=='book_list') {
				$ex=explode(",",$d);
				$data=array(
				'bookN'=>strtoupper($ex[1]),
				'writterN'=>strtoupper($ex[2]),
				'tquantity'=>$ex[3],
				'price'=>$ex[4],
				'fineprice'=>$ex[5],
				'up_date'=>$up_date,
				'up_user'=>$up_user
				);
				$where=array('blist_id'=>$ex[0]);
				$tbl="book_list";
				$up=$this->lib_report->library_update($where,$tbl,$data);
				if($up){
					echo 1;
				}
				else {
					echo 0;
				}
			}
			
			// book list update end
			
			elseif($typ=='all_book_list'){
				$ex=explode(",",$d);
				$data=array(
				'bookN'=>$ex[1],
				'writterN'=>$ex[2],
				'tquantity'=>$ex[3],
				'price'=>$ex[4],
				'fineprice'=>$ex[5],
				'up_date'=>$up_date,
				'up_user'=>$up_user
				);
				$chk=$this->db->query("select * from book_code where book_id='$ex[6]'");
				$row=$chk->num_rows();
				
				if($row<1) {
				// book list update 	
				$where=array('blist_id'=>$ex[0]);
				$tbl="book_list";
				$up=$this->lib_report->library_update($where,$tbl,$data);
				// book list update 
				
				
				//book code update 
				$where=array('book_id'=>$ex[7]);
				$tbl="book_code";
				$data=array('book_id='=>$ex[6]);
				$up=$this->lib_report->library_update($where,$tbl,$data);
				//book code update
				
				if($up){
					echo 1;
				}
				else {
					echo 0;
				}
				
				
				}
				
				else {
					$chk1=$this->db->query("select * from book_code where book_id='$ex[7]'");
					 if($chk1->row()->book_id==$ex[6]){
						$where=array("blist_id"=>$ex[0]);
						$tbl="book_list";
						$up=$this->lib_report->library_update($where,$tbl,$data);
						
						$where=array("book_id"=>$ex[7]);
						$tbl="book_code";
						$data=array('book_id'=>$ex[6]);
						$up=$this->lib_report->library_update($where,$tbl,$data);
						if($up){
							echo 1;
						}
						else {
							echo 0;
						}
					}
					else {
						 echo 2;
					}
				}
			
			}
			
		}
	}
	public function ajax_request(){
		
		if(isset($_POST['st_roll'])){
			extract($_POST);
			$ex=explode("/",$st_roll);
			$y=date("Y");
			$where=array(
			'syear'=>$y,
			'shiftid'=>$ex[0],
			'classid'=>$ex[1],
			'section'=>$ex[2],
			'roll_no'=>$ex[3]
			);
			
			$rol_chk=$this->db->select("*")->from("re_admission")->where($where)->limit("1")->get();
			$affected=$this->db->affected_rows();
			if($affected==0){
			echo 0;
			}
			else{
			 $rol_chkTest=$rol_chk->row();
			 $st=$rol_chkTest->stu_id;
			 $q=$this->db->query("select a.name,b.class_name,c.stu_id from regis_tbl a,class_catg b ,re_admission c where c.stu_id='$st' and c.stu_id=a.stu_id
			 and b.classid=c.classid and c.syear='$y'")->row();
			 echo $q->stu_id."/".$q->name."/".$q->class_name;
			}
		
			
			
		}
		
		if(isset($_POST['dam_v'])){
			extract($_POST);
			//cm userid
			$empid=$this->session->userdata('userid');
			$user_n=$this->session->userdata('userid');
			$up_date=date("Y-m-d h:i:a");$s="3";
			$data=array(
			'empid'=>$empid,
			'comment'=>$cm,
			'status'=>$s,
			'up_date'=>$up_date,
			'up_user'=>$user_n
			);
			$this->db->where("book_id",$dam_v);
			$up=$this->db->update("book_code",$data);
			if($up){
				echo 1;
			}
			else {
				echo 0;
			}
		}
		
		if(isset($_POST['ctg_id'])){
			extract($_POST);
			
			$select=$this->db->query("select * from book_list where bctg_id='$ctg_id'");
			$row=$select->num_rows();
			if($row>0){
			  $r=$select->result();
			  ?><option value="">Select</option><?php 
			  foreach($r as $v){
				  ?>
				  <option value="<?php echo $v->blist_id; ?>"><?php echo $v->bookN; ?></option>
			  <?php	  
			  }
			}
			else {?>
				 <option value="">Select</option>
			<?php 	 
			}
		}
		
		if(isset($_POST['st_id'])) {
			extract($_POST);
			$y=date("Y");
			$se=$this->db->query("select a.name,b.class_name,c.stu_id,c.classid from re_admission c,regis_tbl a,class_catg b  where c.stu_id='$st_id
           'and c.syear='$y' and a.stu_id='$st_id' and b.classid=c.classid");
		   if($se->num_rows()<1){
			   echo 0;
		   }
		   else {
			   $select=$se->row();
		       echo  $d=$select->name.",".$select->class_name;
		   }
		}
		
		if(isset($_POST['bk_code'])){
			extract($_POST);
			$chk=$this->db->query("select * from book_code where book_id='$bk_code' and status>=0");
			$row=$chk->num_rows();
			if($row>0){
				$select=$chk->row();
				if($select->status==1){
					echo 1;
				}
				elseif($select->status==2){
					echo 2;
				}
				elseif($select->status==3){
					echo 3;
				}
				else {
					echo "bcid".",".$select->bcid;
				}
			}
			else {
				 echo 0;
				}	
		}
		
		if(isset($_POST['ret_book'])){
			extract($_POST);
			$y=date("Y");
			$se=$this->db->query("select a.name,b.class_name,c.stu_id,c.classid from re_admission c,regis_tbl a,class_catg b  where c.stu_id='$ret_book' and  c.syear='$y' and a.stu_id='$ret_book' and b.classid=c.classid");
		   if($se->num_rows()<1){
			   echo 0;
		   }
		   else {
			   $select=$se->row();
		       echo  $d=$select->name.",".$select->class_name;
		   }
			
		}
		
		if(isset($_POST['reciv_book']))
		{
			extract($_POST);
			$d=date("Y-m-d");
			$up_date=date("Y-m-d h:i:A");
			$up_user=$this->session->userdata('userid');
			$tbl="book_code";
			$data=array('status'=>0,'stu_id'=>'','up_date'=>$up_date,'up_user'=>$up_user);
			$where=array('book_id'=>$reciv_book);
			$up=$this->lib_report->library_update($where,$tbl,$data);
			
			$tbl="book_sdistribute";
			$data=array('lib_recdate'=>$d,'status'=>0,'up_date'=>$up_date,'up_user'=>$up_user);
			$where=array('bdis_id'=>$dis_id);
			$up=$this->lib_report->library_update($where,$tbl,$data);
			if($up){
				echo 1;
			}
			else {
				echo 0;
			}
		}
	}
	
	public function ajax_delete(){
		if(isset($_POST['typ'])){
			extract($_POST);//dist_id;
			$up_date=date("Y-m-d h:i:A");
			$up_user=$this->session->userdata('userid');
			$tbl="book_code";
			$where=array("book_id"=>$bkid);
			$data=array('status'=>2,'stu_id'=>$stid,'comment'=>$msg,'up_date'=>$up_date,'up_user'=>$up_user);
			$up=$this->lib_report->library_update($where,$tbl,$data);

			$tbl="book_sdistribute";
			$where=array("bdis_id"=>$dist_id);
			$data=array('status'=>0,'up_date'=>$up_date,'up_user'=>$up_user);
			$up=$this->lib_report->library_update($where,$tbl,$data);
			
			if($up){ echo 1; } else { echo 0 ; }

		}
	}
	
	public function inline_insert(){
		if(isset($_POST)){
			extract($_POST);
			$e_date=date("Y-m-d h:i:A");
		    $e_user=$this->session->userdata('userid');
			
			if($typ=='book_list'){
			$ex=explode(",",$ins_data);
			$data=array(
			  'blist_id'=>'',
			  'bctg_id'=>$ex[5],
			  'bookN'=>strtoupper($ex[0]),
			  'writterN'=>strtoupper($ex[1]),
			  'tquantity'=>$ex[2],
			  'price'=>$ex[3],
			  'fineprice'=>$ex[4],
			  'e_date'=>$e_date,
			  'e_user'=>$e_user,
			  'up_date'=>''
			  );
			  $chk=$this->db->query("select * from  book_list where bookN='$ex[0]'");
			  $row=$chk->num_rows();
			  if($row<1){
			  $insert=$this->db->insert("book_list",$data);
			  if($insert){ echo 1; }
			  }
			  else {
				echo 0;
			  }
			  
		  }
		  
		  elseif($typ=='book_code'){
			 $ex=explode(",",$ins_data);
			$data=array(
			 'blist_id'=>$ex[1],
			 'book_id'=>$ex[0],
			 'comment'=>'',
			 'e_date'=>$e_date,
			 'e_user'=>$e_user,
			 'up_date'=>'',
			 'up_user'=>''
			 );
			 $chk=$this->db->query("select * from book_code where book_id='$ex[0]'")->num_rows();
			 if($chk<1){
			 $insert=$this->db->insert("book_code",$data);
			 if($insert){ echo 1; } else { echo 0; }
			 }
			 else {
				 echo 2;
			 }
			  
		  }
		}
	}
	public function distribute_log() {
		
		$query=$this->lib_report->distribute_log($_POST);
		$row=$query->num_rows();
		$today=date("Y-m-d");
		if($row>0){
			
		?>
		
			<table  class="table table-hover table-condensed table-bordered">
				
				<tr class="active">
					<td>SL.No</td>
					<td>Student ID</td>
					<td>Student Name</td>
					<td>Book Code</td>
					<td>Book Name</td>
					<td>Distribute Date</td>
					<td>Return Date</td>
				</tr>
					
				<?php
				$i=1;
				foreach($query->result() as $value)
				{
					$distribute_date=date("d-m-Y",strtotime($value->stdrdate));
					$return_date=date("d-m-Y",strtotime($value->stdreturn));
				?>		
					<tr <?php if($return_date>$today) { echo "class='danger'"; } ?>>
						<td><?php echo $i++; ?></td>
						<td><?php echo $value->stu_id; ?></td>
						<td><?php echo $value->name; ?></td>
						<td><?php echo $value->book_id; ?></td>
						<td><?php echo $value->bookN; ?></td>
						<td><?php echo $distribute_date; ?></td>
						<td><?php echo $return_date; ?></td>
						
					</tr>
				<?php	
				}
				?>			
			</table>
		
		
			<?php
			}
			else{
				echo 0;
			}   	
		}
	
	
	public function book_recived_book_2(){
		extract($_POST);
		$d=date("Y-m-d");
		$up_date=date("Y-m-d h:i:A");
		$up_user=$this->session->userdata('userid');
			
		$up=$this->db->query("UPDATE book_code SET status='0',stu_id='',up_date='$up_date',up_user='$up_user' WHERE book_id='$reciv_book'");
		
		$up1=$this->db->query("UPDATE book_sdistribute SET lib_recdate='$d',up_date='$up_date',up_user='$up_user' WHERE stu_id='$st' and book_id='$reciv_book'");
		if($up && $up1){
				echo 1;
			}
			else {
				echo 0;
			}
		
	}
	
	public function book_restore()
	{
		extract($_POST);
		$up_date=date("Y-m-d h:i:A");
		$up_user=$this->session->userdata('userid');
		$where=array("book_id"=>$bid);
		$tbl="book_code";
		$data=array('status'=>0,'up_date'=>$up_date,'up_user'=>$up_user,'comment'=>'','empid'=>'');
		$up=$this->lib_report->library_update($where,$tbl,$data);
		if($up)
		{ echo 1; }
	    else 
		{
			echo 2;
		}	
	}
	
	
	 public function book_info_pass()
	 {
	  extract($_POST);
	  $info=$this->lib_report->data_pass_modal_lost($bkid,$stid);
	  echo $info->name.",".$info->bookN.",".$info->book_id.",".$info->price.",".$info->fineprice;
	 }
	 
	 public function book_code_validation()
	 {
		 extract($_POST);$i=1;
		 foreach($bk_code as $value){
			 
			$test=$this->db->select("book_id")->from("book_code")->where("book_id",$value)->get();
			if($this->db->affected_rows()>0){
				echo "bk_".$i;exit; 
			}
			$i++;
		 }
		 echo 1;

	 }

	
}