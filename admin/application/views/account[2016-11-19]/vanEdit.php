	<script>
	$(document).ready(function(){
	
	
	$('#formid6').submit(function() {
		//alert('ekhane');
  		$.post(
            "index.php/account/vahicleEdit",
            $("#formid6").serialize(),
            function(data){
              if(data==1)
			  {
				    alert('Transport Update Successfully');						
					window.location="accountReport/vahicleStdAssign";
						
				  }			  
				  else {
					  alert(data);
				  }
			});
			return false;
		});
		
		
	});
	</script>
	<?php 
	//print_r($_GET);
	extract($_GET);
	$vaninfo=$this->db->query("select * from vahicles where vid=$vid")->row();
	?>
	
	<form class="form-horizontal" action="index.php/account/vahicleEdit" method="post" id="formid6">
	  <div class="form-group">
		<label class="control-label col-sm-2" for="email">Serial No:</label>
		<div class="col-sm-10">
		  <input type="text" name="serial"  class="form-control" id="serial" required value="<?php echo $vaninfo->vnumber; ?>" placeholder="Vahicles Serial No" />
		</div>
	  </div>
	  <div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Name:</label>
		<div class="col-sm-10"> 
		  <input type="text" name="vname"  class="form-control" required value="<?php echo $vaninfo->name; ?>"  id="vname" placeholder="Vahicles Name" />
		  <input type="hidden" name="vid" value="<?php echo $vid; ?>"/>
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Route:</label>
		<div class="col-sm-10"> 
		  <input type="text" name="route"  class="form-control" id="vroute" required value="<?php echo $vaninfo->route; ?>"  placeholder="Vahicles Route" />
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Capacity:</label>
		<div class="col-sm-10"> 
		  <input type="text" name="capacity"  class="form-control" id="vcapacity" required value="<?php echo $vaninfo->capacity; ?>"  placeholder="Vahicles Capacity" />
		</div>
	  </div>
	  
	  <div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Rent(TK):</label>
		<div class="col-sm-10"> 
		 <input type="text" name="rent"  class="form-control" id="vrent" required value="<?php echo $vaninfo->rent; ?>"  placeholder="Rent" onkeypress="return isNumber(event)" />
		</div>
	  </div>
	  
	  <div class="form-group"> 
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Update</button>
		</div>
	  </div>
	</form>