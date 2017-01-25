<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
	
	 <style>
		.error{
			border-color:red;
		}
		input {
			text-transform:uppercase;
		}
	</style>            <!-- Content Header (Page header) -->
<script type="text/javascript">

function mark_calculation(th,obj,pra){
	var t,o,p;
	
	t=parseInt(th);
	o=parseInt(obj);
	p=parseInt(pra);
  
	if(isNaN(t)){
		t=0;
	}
	
	if(isNaN(o)){
		o=0;
	}
	
	if(isNaN(p)){
		p=0;
	}
  
  var total=t+o+p;
  
  var xmMark=document.getElementById("exam_mark").value;
  
  if(total>xmMark || total<xmMark){
	  alert('EXAM MARK IS NOT  EQUAL TOTAL MARK');
	 return false;
  }
  else {
	  return true;
  }
  
}	
</script>
<?php 
if(isset($_GET['id'])){
	extract($_GET);
	$c=$this->db->query("select class_name from class_catg where classid='$class_name'")->row()->class_name;
	$query=$this->db->query("select * from subject_class where subjid='$id'")->row();
	
}
?>	
                <section class="content-header">
                    <h1>
                        Subject Edit
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
					<div class="container">
<!-----------------confirmation msg start--------------------------->
					<?php $this->load->view('student_section/submit_confirm'); ?>
<!-----------------confirmation msg End----------------------------->
                    <div class="row">
                      <div class="col-md-10">
					   <form class="form-horizontal" role="form" onsubmit="return mark_calculation(theo_mrk.value,ex_mark.value,prac_mark.value);" action="student_submit/subject_setting" method="post">
					  <table  class="table">
					    <tr>
						<th>
							
						
						<div class="form-group">

						  <label class="control-label col-sm-2" for="pwd">Class Name:</label>
						  <div class="col-sm-6" id="shak_id_1">          
							<input type="text" name="class_name" class="form-control" value="<?php echo $c; ?>" readonly  id="class_name"/>
							<input type="hidden" name="classid" value="<?php echo $class_name; ?>"/>
								
						  </div>
						  <div class="col-sm-2">          
							
						  </div>
						</div>
						</th>
						</tr>
						<tr>
						<td>
						<div class="form-group" id="itemRows">

						  <div class="col-sm-4" id="shak_id_2">
							<center><label>Subject Name</label></center>
							<input type="text" name="sub_name" class="form-control" id="sub_name" value="<?php echo $query->sub_name; ?>" onkeypress="return only_chareter(this.value)" required />
						  </div>
						
						   <div class="col-sm-2">
							<center><label>Exam Mark</label></center>
							<input type="text" name="exam_mark" value="<?php echo $query->exm_mark; ?>" class="form-control" id="exam_mark" maxlength="6" onchange="" placeholder="Exam Mark" onkeypress="return isNumber(event);" required />
						  </div>
						  
						   <div class="col-sm-2"> 
							<center><label>Theory Mark</label></center>
							<input type="text" name="theo_mrk" value="<?php echo $query->stherory_mk; ?>" class="form-control" maxlength="4" id="theo_mrk" placeholder="Theory Mark" onchange="" onkeypress="return isNumber(event);" required />
							 <input type="hidden" name="subjid" value="<?php  echo $id; ?>"/>
						  </div>
						 
						  <div class="col-sm-2">
							<center><label>Objective Mark</label></center>
							<input type="text" name="ex_mark" value="<?php echo $query->sobj_mk; ?>" class="form-control" maxlength="4" id="ex_mark" placeholder="Objective Mark" onchange="" onkeypress="return isNumber(event);"/>
						  </div>
						  
						   <div class="col-sm-2">
							<center><label>Practical Mark</label></center>
							<input type="text" name="prac_mark" value="<?php echo $query->sprack_mk; ?>" class="form-control" maxlength="4" id="prac_mark" placeholder="Practical Mark" onchange="" onkeypress="return isNumber(event);" />
						  </div>
						   
						</div>
						</td>
						 </tr>
						<tr>
						<td>
						<div class="form-group">        
						   <div class="col-sm-2">          
							
						  </div>
						   <div class="col-sm-2">          
							
						  </div>
						  
						   <div class="col-sm-4">          
								<button type="submit" name="submit_edit" class="btn btn-primary"><span class="glyphicon glyphicon-send" data-toggle="tooltip" title="Update"></span> Update</button>&nbsp;&nbsp;
							<a href="student_section/level_1_setting"><button type="button" value="" class="btn btn-success" id="reset" data-toggle="tooltip" title="Go Back"><span class="glyphicon glyphicon-backward"></span> Back</button></a>
						    </div>
						   <div class="col-sm-2">          
							
						  </div>
						   <div class="col-sm-2">          
							
							
						  </div>
						  
						</div>
						</td>
					    </tr>
                       					  
					  </table>
					  </form>
					  </div>
					 <div class="col-md-2">
					 
					 </div>
                    </div>

					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->