<script type="text/javascript">
	function changeStatus( status,dataid,id ){
		//alert(status);
		//alert(dataid);
		//alert(id);
	}

	// on change class change the section
	function classChangeSection( cls ){
		$.ajax({
			url:"index.php/account/changeClassSection",
			type:"POST",
			data:{clsid:cls},
			success:function(data){
				var sec = data.split(",");
				document.getElementById("rsections_rep").innerHTML = '';
				document.getElementById("rsections_rep").innerHTML = '<option value = "">Section</option>';
				for(var i = 0;i<sec.length;i++){
					if( sec[i] != '' ){
						document.getElementById("rsections_rep").innerHTML += '<option value = "'+sec[i]+'">'+sec[i]+'</option>';
					}
				}
			}
		});
	}

</script>
<?php

$data = array();

	if(isset($_POST['submitsearch'])):
		extract($_POST);

		// shift
		if($rshift):
			$data['shiftid'] = $rshift;
		endif;

		// class
		if($rclassname):
			$data['classid'] = $rclassname;
		endif;

		// section
		if($rsections):
			$data['section'] = $rsections;
		endif;

		// year
		if($ryear):
			$data['year'] = $ryear;
		endif;

		// roll
		if($roll):
			$data['roll'] = $roll;
		endif;

		// if none of selected
		if(count($data) <=0 ):
			$data['year'] = date("Y");
		endif;

	else:
		$data['year'] = date("Y");
	endif;

?>


<form class="form-horizontal" role="form" action="" method="post">
	<div class="form-group">									
		<div class="col-sm-2">          
			<select class="form-control" name="rshift" id="rshift">
				<option value=""> Shift </option>
					<?php 
						$rexsqlacc = $this->db->select('*')->from('shift_catg')->get()->result();										
						foreach($rexsqlacc as $rexaccidshow){
					?>
						<option value="<?php echo $rexaccidshow->shiftid?>" <?php if($rshift == $rexaccidshow->shiftid){echo "SELECTED";}?>><?php echo $rexaccidshow->shift_N?></option>
						<?php }?>
				</select>
		  	</div>

			<div class="col-sm-2">          
				<select class="form-control" name="rclassname" id="rclassnames" onchange="classChangeSection(this.value)">
					<option value=""> Class </option>
						<?php 
							$rsqlacc = $this->db->select('*')->from('class_catg')->get()->result();										
							foreach($rsqlacc as $raccidshow){
						?>
					<option value="<?php echo $raccidshow->classid?>" <?php if($rclassname == $raccidshow->classid){echo "SELECTED";}?>><?php echo $raccidshow->class_name?></option>
						<?php }?>

				</select>
			</div>
						   
		  <div class="col-sm-2">          
			<select class="form-control" name="rsections" id="rsections_rep">
				<option value=""> Section </option>
			</select>
		  </div>

						  
		  <div class="col-sm-2">          
			<select class="form-control" name="ryear" id="ryear">
				<option value="">Year</option>
					<?php

					for($i = date("Y")+1; $i >= 2015;$i--){
					?>
						<option value="<?php echo $i?>" <?php if($ryear == $i):echo "selected";endif; ?> ><?php echo $i ?></option>
					<?php }?>
			</select>
		  </div>								
		
		  <div class="col-sm-2">
		  	<input type="text" name="roll" id="roll" class="form-control" onkeypress="return isNumber(event)" value="<?php if($roll):echo $roll;endif; ?>" />
		  </div>

		<div class="col-sm-2">
			<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
		</div>
	</div>
</form>

<?php

	$schoolerInfo = $this->accmodone->schoolerShip( $data );

?>					

<table id="example3" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>SI</th>
			<th>Student Name</th>
			<th>Shift</th>
			<th>Class</th>
			<th>Section</th>										
			<th>Roll</th>
			<th>Waver (%)</th>										
			<th>Year</th>
			<th>Status</th>
			<th>Action</th>												
		</tr>
	</thead>
	
	<tbody>
	
	<?php
		$si = 0;
		foreach($schoolerInfo as $schInf):
			$si++;
	?>

		<tr>
			<td><?php echo $si ?></td>
			<td><?php echo $this->accmodone->stdName( $schInf->shiftid,$schInf->classid,$schInf->roll,$schInf->year )->name; ?></td>
			<td><?php echo $this->accmodone->getShift($schInf->shiftid)->shift_N; ?></td>
			<td><?php echo $this->accmodone->getClass($schInf->classid)->class_name; ?></td>
			<td><?php echo $schInf->section ?></td>
			<td><?php echo $schInf->roll ?></td>
			<td><?php echo $schInf->discount ?></td>
			<td><?php echo $schInf->year ?></td>	
			<td>
				<?php
					if( $schInf->status ):
						$cls = "btn-success";
						$innerText = "Active";
						$function = 'onclick = "changeStatus( 0,'.$schInf->schid.',this.id )"';
					else:
						$cls = "btn-danger";
						$innerText = "Inactive";
						$function = 'onclick = "changeStatus( 1,'.$schInf->schid.',this.id )"';
					endif; 
				?>
				<button class="btn btn-sm <?php echo $cls ?>" <?php echo $function ?> id="chgBtn<?php echo $si ?>" ><?php echo $innerText ?></button>
			</td>
			<td>
				<button class="btn btn-sm btn-primary">Edit</button>
			</td>
		</tr>

<?php endforeach; ?>

	</tbody>
</table>