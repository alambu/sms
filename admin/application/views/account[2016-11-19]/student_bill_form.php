<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
	 
  $.post(
            "index.php/account/billgenerateinsert",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/account/student_payment_bill";
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
</script>

<aside class="right-side">      <!---rightbar start here --->
    <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Examination Bill Generate 
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="form-horizontal" role="form">
				<div class="col-md-11" style="min-height:60px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> Successfully ! </strong> Your Data insert complete.
					</div>
				   </div>
                    <div class="row">
					<div class="col-sm-10">						
						<div class="form-group">
						  <label class="control-label col-sm-2" >Class Name:</label>
						  <div class="col-sm-2">          
							<select class="form-control" name="classname" id="classname" required onchange="ajax_request_clsid(this.value);">
									<option value="">--Select--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->classid?>"><?php echo $accidshow->class_name?></option>
										<?php }?>
							</select>
						  </div>
						   <label class="control-label col-sm-1" >Section:</label>
						  <div class="col-sm-2">          
							<select class="form-control" name="sections" id="sections" required>
									<option value="">--Select--</option>
									
							</select>
						  </div>
						  <label class="control-label col-sm-2" >Bill Category:</label>
						  <div class="col-sm-3">          
							<select class="form-control" name="billctgss" id="billctgss" required>
									<option value="">--Select--</option>
									<?php 
										$exmsql=$this->db->select('*')->from('exm_catg')->where('status',1)->get()->result();										
										foreach($exmsql as $exmsqlrow){
											$exmrow=$this->accmodone->exmname($exmsqlrow->exmnid);
									?>
										<option value="<?php echo $exmrow->exm_name.'-'.$exmsqlrow->year?>"><?php echo $exmrow->exm_name.'-'.$exmsqlrow->year?></option>
										<?php }?>
							</select>
						  </div>
						  </div>
						  <div class="form-group">
						  <label class="control-label col-sm-2">Number of Month:</label>
						  <div class="col-sm-2">          
							<input type="text" name="nummonth"  class="form-control" id="nummonth" value=""/>
						  </div>
						  <label class="control-label col-sm-1">Year:</label>
						  <div class="col-sm-2">          
							<input type="text" name="year"  class="form-control" id="year" value="<?php echo date('Y')?>" readonly/>
						  </div>
						  
						 <div class="col-sm-2">
							<button type="submit" name="submit" class="btn btn-primary" onclick="var searchval=searching();if(searchval==false){return false};htmlData('index.php/account/search_billgenerate','classid='+classname.value+'&sections='+sections.value+'&month='+nummonth.value+'&billctgs='+billctgss.value);"><span class="glyphicon glyphicon-search"></span>  Search</button>

						  </div>
						</div>						
					  </div>
					</div>  
				</div>					
                    <div class="row">                     
					  <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="" method="post" id="formid">
						<div id="txtResult"></div>
					  </form>			
						
					  </div>
					  <div class="col-md-2">
					  
					  </div>
                    </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
			<?php $this->load->view('footer');?>