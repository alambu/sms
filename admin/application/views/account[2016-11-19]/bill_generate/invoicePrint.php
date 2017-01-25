<?php
	$datamon=array(
		'1'  => 'January',
		'2'  => 'February',
		'3'  => 'March',
		'4'  => 'April',
		'5'  => 'May',
		'6'  => 'June',
		'7'  => 'July',
		'8'  => 'August',
		'9'  => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
	);
?>

<!-- script section start -->
<script type="text/javascript">
	// get class by shift id
function getClassPrint( shift ){
	$.ajax({
		url:"account_billgenerate/getClass",
		type:"POST",
		data:{shf:shift},
		success:function( data ){
			var cls = data.split("+");
			if((cls[0].length > 0) && (cls[1].length > 0)){
				var className = cls[0].split(",");
				var classId = cls[1].split(",");

				// reset class
				document.getElementById("classInvPrint").innerHTML = '';
				document.getElementById("classInvPrint").innerHTML = '<option value="">Select</option>';

				// set new class
				for(var j = 0;j < className.length;j++){
					document.getElementById("classInvPrint").innerHTML += '<option value="'+classId[j]+'">'+className[j]+'</option>';
				}

			}else{
				// reset class
				document.getElementById("classInvPrint").innerHTML = '';
				document.getElementById("classInvPrint").innerHTML = '<option value="">Select</option>';				
			}
		}
	});
}	

$("document").ready(function(){
	
	$("#lastDate").datepicker({format: 'yyyy-mm-dd'
	});
});
</script>

<!-- script section end -->


<form class="form-inline" role="form" action="index.php/account_billgenerate/billPrint" method="GET" target="_blank">
	<div class="form-group col-sm-12">
		
		<!-- <div class="col-sm-1"></div> -->

		<div class="col-sm-2">
			<label class="control-label">Shift :</label>
			<select class="form-control" name="shift" id="shift" onchange="getClassPrint(this.value)">
				<option value="">Select</option>
				
				<?php
					$sft = $this->db->get("shift_catg")->result();
					foreach($sft as $s):
				?>
				<option value="<?php echo $s->shiftid ?>"><?php echo $s->shift_N ?></option>
			<?php endforeach; ?>
			</select>
		</div>

		  
		<div class="col-sm-2">
			<label class="control-label">Class:</label>
			<select class="form-control" name="classid" id="classInvPrint" required >
				<option value="">Select</option>
				
			</select>
		</div>


		  
			<div class="col-sm-3">
				<label class="control-label">Month :</label>
				<select class="form-control" name="monthfdate" id="monthfdate" onchange="var searchval=monthcek();if(searchval==false){return false};">
				<option value="">Select Month</option>
				<?php 
						for($i=1;$i<=12;$i++){
				?>
					<option value="<?php echo $i?>"><?php echo $datamon[$i]?></option>
					<?php }?>
			</select>
			</div>
		  
		  
			<div class="col-sm-2">
				<label class="control-label">Year :</label>
				<select class="form-control" name="year" id="year">

					<option value="">Select Year</option>
					<?php 
						for($i = date("Y");$i >= 2015;$i--){
					?>
						<option value="<?php echo $i ?>"><?php echo $i ?></option>
						
					<?php } ?>
				
				</select>
			</div>
			
			<div class="col-sm-2">
				<label class="control-label">Date :</label>
				<input type="text" name="lastDate" id="lastDate" placeholder="Last Payment Date" class="form-control" required/>
			</div>


			<div class="col-sm-1">          
				<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
			</div>

	  </div>
	</form>