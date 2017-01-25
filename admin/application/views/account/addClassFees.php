<script type="text/javascript">
	function chkDuplicateCls( cls,year ){
		$.ajax({
			url:"account/chkDuplicateCls",
			type:"POST",
			data:{cls:cls,y:year},
			success:function(data){
				if(data == 1){
					document.getElementById("classNm").value = '';
					alert("This class fee already settup.Pls select another one.If new category follow bellow link.")
				}
			}
		});
	}
</script>

<form class="form-horizontal" role="form" action="index.php/account/classfeesett" method="post" id="formid">
	<div class="form-group">
		<label class="control-label col-sm-2" >Class Name:</label>
		<div class="col-sm-4">
			<select class="form-control" name="classname" id="classNm" required onchange="chkDuplicateCls(this.value,year.value)" >
				<option value="">--Select--</option>
					<?php 
						$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
						foreach($sqlacc as $accidshow){
					?>
				<option value="<?php echo $accidshow->classid?>"><?php echo $accidshow->class_name?></option>
				<?php }?>
			</select>
		</div>
		
		<label class="control-label col-sm-1" >Year:</label>
			<div class="col-sm-2">
				<select class="form-control" name="year_text" id="year" required>
					<?php $d=date('Y'); $c=$d+1;?>
					<option value="<?php echo $d?>"><?php echo $d?></option>
					<option value="<?php echo $c?>"><?php echo $c?></option>
				</select>
			</div>
		</div>
		
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
			$nr=1;
			$sqlacc=$this->db->select('*')->from('fee_catg')->where('status',1)->get()->result();							foreach($sqlacc as $accidshow){
		?>
			<div class="form-group">
				<div class="col-sm-1">
					<label for="ex1">&nbsp </label>
				</div>
				
				<div class="col-sm-4">
					<input type="hidden" name="title[]" value="<?php echo $accidshow->feectgid?>"/>
					<input type="text" name="titles" class="form-control" value="<?php echo $accidshow->catg_type?>" readonly />
				</div>
			  
			  	<div class="col-sm-4">
					<input class="form-control" name="amount[]" id="amounta<?php echo $nr?>" type="text" required placeholder="Enter Amount" onkeypress="return isamountonly(event)" required />
			  	</div>
			</div>
			
			<?php $nr++;}?>
						
			<div class="form-group">
				<div class="col-sm-1">
					<label for="ex1">&nbsp </label>
				</div>
			<div class="col-sm-2">									
				<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
			</div>
		</div>
	</form>

<div class="col-md-12">
	<div class="col-sm-1"></div>
		<div class="col-sm-9">
			<a href="index.php/account/class_fee_sett_single"><p style="color:red;"><span class="glyphicon glyphicon-th-large"></span><b> Note:</b>New Category Fees Setting in existing class.</p></a>
		</div>
</div>