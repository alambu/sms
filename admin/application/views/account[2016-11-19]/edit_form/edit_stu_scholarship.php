<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<style>
		.divhide{display:none;}	
	</style>
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
  $.post(
            "index.php/account_edit/stuedit_scholarship_edit",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/account/listof_scholarship";
					},2000)
			  }			  
			  else{
				  alert(data);
			  }
     });
 return false;
 });
});
</script>
<script>
function ajax_request_clsid(cls_id){						
	$.ajax({
		url: "index.php/account/classsection",
		type: 'POST',	
		data:{classname:cls_id},	
		success: function(data)
		{							
			if(data.length!=0){
			var d=data.split(",");
					
			document.getElementById("sections").innerHTML="<option value=''>--Select--</option>";			
			for(var i=0;i<d.length;i++){				
				document.getElementById("sections").innerHTML+="<option value='"+d[i]+"'>"+d[i]+"</option>";
			}
			}else{
				document.getElementById("sections").innerHTML='';
				document.getElementById("sections").innerHTML='<option value="">--Select--</option>';
			}
		}          
		});
	}
	function searching(){		
		var clasid=document.getElementById("classname").value;
		var section=document.getElementById('sections').value;
			var month=document.getElementById('nummonth').value;
			var exmctg=document.getElementById('billctgss').value;
		if(clasid==""){
			alert("Please Select Class Name");
			return false;
		}
		
		if(section==''){
			alert("Please Select Section");
			return false;
		}
	
		if(exmctg==''){
			alert("Please Select Bill Category");
			return false;
		}
		
		if(month==''){
			alert("Please Enter Month");
			return false;
		}
	}
	function divdispaly(){
		var title=document.getElementById('scholarship').value;
		if(title!=''){
		document.getElementById("divtitle").style.display = "inline";
		}
		if(title==''){
			document.getElementById("divtitle").style.display = "none";
		}
	}
</script>

<aside class="right-side">      <!---rightbar start here --->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Scholarship Student Edit Form
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="col-md-11" style="min-height:60px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> Successfully ! </strong> Your Data Edit Successfully.
					</div>
				   </div>
				<form class="form-horizontal" role="form" method="post" action="index.php/account/stu_scholarship_insert" id="formid">
				<?php extract($_GET);		
					$sql_a=$this->db->select('*')->from('re_admission')->WHERE('readid',$readidss)->get()->row();
					$sql_b=$this->db->select('*')->from('schship')->WHERE('sshipid',$sshipid)->get()->row();
				?>		
					<input type="hidden" name="sshipids" value="<?php echo $sshipid?>"/>
					<input type="hidden" name="studentid" value="<?php echo $stuid?>"/>
					<input type="hidden" name="scholarshipid" value="<?php echo $sql_b->scholarship?>"/>
                    <div class="row">
					<div class="col-sm-10">						
						<div class="form-group">
						  <label class="control-label col-sm-2" >Class Name:</label>
						  <div class="col-sm-2">          
							<select class="form-control" name="classname" id="classname" required onchange="ajax_request_clsid(this.value);" disabled>
									<option value="">--Select--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->classid?>" <?php if($accidshow->classid==$sql_a->classid){echo 'SELECTED';}?>><?php echo $accidshow->class_name?></option>
										<?php }?>
							</select>
						  </div>
						   <label class="control-label col-sm-2" >Section:</label>
						  <div class="col-sm-2">          
							<select class="form-control" name="sections" id="sections" required disabled>
									<option value="<?php echo $sql_a->section?>"><?php echo $sql_a->section?></option>
									
							</select>
						  </div>
						  <label class="control-label col-sm-1">Roll No:</label>
						  <div class="col-sm-2">          
							<input type="text" name="rollno"  class="form-control" required placeholder="Roll" value="<?php echo $sql_a->roll_no?>" readonly />
						  </div>
						
						  </div>
							<div class="form-group">
							<label class="control-label col-sm-2">Shift:</label>
							  <div class="col-sm-2">          
								<select class="form-control" name="shiftid" id="shiftid" required disabled>
									<option value="">--Select--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('shift_catg')->get()->result();
										foreach($sqlaccs as $accidshows){
									?>
										<option value="<?php echo $accidshows->shiftid?>" <?php if($accidshows->shiftid==$sql_a->shiftid){echo 'SELECTED';}?>><?php echo $accidshows->shift_N?></option>
										<?php }?>
								</select>
							  </div>
							  <label class="control-label col-sm-2">Scholarship:</label>
							  <div class="col-sm-2">          
								<select class="form-control" name="scholarship" id="scholarship" required onchange="divdispaly()">
									<option value="">--Select--</option>
									<option value="1" <?php if($sql_b->scholarship=='1'){echo 'SELECTED';}?>>Full Fee Scholarship</option>
									<option value="2" <?php if($sql_b->scholarship=='2'){echo 'SELECTED';}?>>Half Fee Scholarship</option>
									<option value="3" <?php if($sql_b->scholarship=='3'){echo 'SELECTED';}?>>Poor Fund</option>
								</select>
							  </div>
							  <label class="control-label col-sm-1">Year:</label>
							  <div class="col-sm-2">          
								<input class="form-control" name="year[]" type="text" value="<?php echo date('Y')?>" readonly/>
							  </div>
							</div>
<hr/>							
						<div id="divtitle">
						<div class="form-group">
							<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
							 </div>
							 <div class="col-sm-4">
								<label for="ex1">Category Name </label>
							 </div>
							<div class="col-sm-4">
								<label for="ex1">Amount</label>
							  </div>
						</div>
						<?php 
							$sqlacc=$this->db->select('*')->from('stu_sship_amount')->WHERE('sshipid',$sshipid)->get()->result();
							foreach($sqlacc as $accidshow){
								$feecatgname=$this->accmodone->classfeecatg($accidshow->feectgid);
								?>
						<div class="form-group">
							<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
							 </div>
							  <div class="col-sm-4">
								<input type="hidden" name="shipamountid[]" value="<?php echo $accidshow->sshipdisid?>"/>
									<select class="form-control col-sm-4" name="title[]" required>
											<option value="<?php echo $accidshow->feectgid?>"><?php echo $feecatgname->catg_type?></option>
											
									</select>
							  </div>
							  <div class="col-sm-3">
									<input class="form-control" name="amount[]" id="amount" type="text" required placeholder="Enter Amount" onkeypress="return isamountonly(event)" required value="<?php echo $accidshow->amount?>" />
							  </div>
							  <div class="col-sm-2">
									<select class="form-control col-sm-4" name="persentage[]" required>
											<option value="">--Select--</option>
											<option value="1" <?php if($accidshow->calculates==1){echo 'SELECTED';}?>>Percentage</option>
											<option value="2" <?php if($accidshow->calculates==2){echo 'SELECTED';}?>>Discount</option>
											
									</select>
							  </div>
						</div>
					<?php }?>						
						<div class="form-group">        
						  <div class="col-sm-offset-1 col-sm-10">
							<button type="submit" name="submit" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span>  Edit</button>
							&nbsp;&nbsp;
							<a href="index.php/account_edit/search_scholarship"><button type="button" value="" class="btn btn-success" id="reset" onclick=" reset_content(this.value);"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
						  </div>
						</div>
					  </div>
					  </div>
					</div>  
				</form>					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			<?php $this->load->view('footer');?>