
<script type="text/javascript">
$(document).ready(function(){
 $('#formid').submit(function() {
  $.post(
            "index.php/account/classfeesett_single",
            $("#formid").serialize(),
            function(data){
              if(data==1)
			  {
				  $("#hidemessage").show(); 
					setTimeout(function(){					
					window.location="index.php/account/class_fee_sett_single";
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
<aside class="right-side">     	
                <section class="content-header">
                    <h1>
                         Class Fee Setting For Single Category Form
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
				<div class="col-md-11" style="min-height:50px;">
					<div class="alert alert-success" id="hidemessage" style="margin-top:10px;margin-bottom:5px;">
					<strong> Successfully!</strong>Your Data insert complete.
				   </div>
				   </div>
                    <div class="row">
                      <div class="col-md-10">
					 <form class="form-horizontal" role="form" action="index.php/account/classfeesett" method="post" id="formid">
						
						<div class="form-group">
							<label class="control-label col-sm-2" >Class Name:</label>
							  <div class="col-sm-4">
								<select class="form-control" name="classname" required>
									<option value="">--Select--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->classid?>"><?php echo $accidshow->class_name?></option>
										<?php }?>
								</select>
							  </div>
							  <label class="control-label col-sm-2" >Year:</label>
							  <div class="col-sm-4">
									<!--<input class="form-control" name="year" id="year" type="text" value="<?php// echo date('Y')?>" readonly>-->
									<select class="form-control" name="year_text" id="year" required>
									<?php $d=date('Y'); $c=$d+1;?>
									<option value="<?php echo $d?>"><?php echo $d?></option>
									<option value="<?php echo $c?>"><?php echo $c?></option>
									</select>
							  </div>
							 
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" >Category Name:</label>
							
							  <div class="col-sm-4">
									<select class="form-control col-sm-4" name="title" id="title" required>
									<option value="">--Select--</option>
									<?php
										$sqlacc=$this->db->select('*')->from('fee_catg')->where('status',1)->get()->result();										
										foreach($sqlacc as $accidshow){?>
											<option value="<?php echo $accidshow->feectgid?>"><?php echo $accidshow->catg_type?></option>
										<?php $nr++;}?>	
									</select>
							  </div>
							  <label class="control-label col-sm-2" >Amount:</label>
							  <div class="col-sm-4">
									<input class="form-control" name="amount" id="amount" type="text" required placeholder="Enter Amount" onkeypress="return isamountonly(event)" required />
							  </div>
							 
						</div>
					
						<div class="form-group">
						<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
						</div>
							<div class="col-sm-4">									
								<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
								<a href="index.php/account/class_fee_sett"><button type="button" name="button" class="btn btn-info"><span class="glyphicon glyphicon-arrow-left"></span> Back</button></a>
							</div>
						</div>
					  </form>									
					  </div>
					   
                    </div>	
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
