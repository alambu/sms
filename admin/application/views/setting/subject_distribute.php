<script type="text/javascript">
$(document).ready(function(){
	  $('#subject_dis_form').submit(function() {
		    document.getElementById('sub_dis').innerHTML = 'Saveing----';
		    document.getElementById('sub_dis').disabled = 'disabled';
		  $.post(
				"index.php/setting_submit/subject_distribute",
				$("#subject_dis_form").serialize(),
				function(data){
				 //alert(data);	
				 if(data==1)
				 {
					alert('Data Save Successfully');					
					window.location="index.php/basic_setting/setting";
					 
				 }
				 else 
				 {
					 alert(data);
					 document.getElementById('sub_dis').disabled = false;
				 }
				 document.getElementById('sub_dis').innerHTML = 'Save';
			 });
		 return false;
		 }); 
  });
  
function selected_class(sftid)
	{
		$.ajax({
		url: "index.php/basic_setting/selected_class",
		type: 'POST',	
		data:{sft_id:sftid},	
		success: function(data)
		{	
			if(data.length!=0) {
			var data1=data.split("#");	
			var d=data1[0].split(",");
			var d1=data1[1].split(",");
			var sec="Select Section";
			document.getElementById("class_name").innerHTML='';
			document.getElementById("class_name").innerHTML="<option value=''>"+sec+"</option>";
			
			for(var i=0;i<d.length;i++){
				
				document.getElementById("class_name").innerHTML+="<option value='"+d1[i]+"'>"+d[i]+"</option>";
			}
		}
		else {
			document.getElementById("class_name").innerHTML='';
			document.getElementById("class_name").innerHTML="<option value=''>Select Class</option>";
		}
		
		}
		
		});
	}
	
function class_wise_subject(cid,sid)
{
	window.location="index.php/basic_setting/setting?cid="+cid+"&sid="+sid;
}


// subject mark calculation start
function sub_setup_mark_calculation(theo_mrk,ex_mark,prac_mark,dyid) {
	var t,o,p;
	t=parseInt(theo_mrk);
	o=parseInt(ex_mark);
	p=parseInt(prac_mark);
	
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
  if(total=='') { alert('Total Mark is Empty'); return false; }
  document.getElementById("total_mark_"+dyid).value=total;
}
//subject mark calculation end
</script>
<style>
.test_center
{
	text-align:center;
}
</style>
<h3>Subject Distribute</h3>
<script>
function test(acv,did)
{   var theo,obj,prac,total,group,optional,sequence;
    theo=document.getElementById("theo_mark_"+did);
    obj=document.getElementById("obj_mark_"+did);
    prac=document.getElementById("prac_mark_"+did);
    total=document.getElementById("total_mark_"+did);
    group=document.getElementById("group_"+did);
    optional=document.getElementById("optional_"+did);
    sequence=document.getElementById("sequence_"+did);

	if(acv>0)
	{
		theo.disabled=false;
		obj.disabled=false;
		prac.disabled=false;
		total.disabled=false;
		group.disabled=false;
		optional.disabled=false;
		sequence.disabled=false;
	}
	else 
	{
		theo.disabled=true;
		obj.disabled=true;
		prac.disabled=true;
		total.disabled=true;
		group.disabled=true;
		optional.disabled=true;
		sequence.disabled=true;
	}
}
</script>
<?php 
if(isset($_GET['cid']))
{
	extract($_GET);
	$class1=$this->db->select("*")->from("class_catg")->where("shiftid",$sid)->get()->result();
}	
?>
<div class="row">
	<div class="col-md-12">
		<form class="form-horizontal" role="form" action="student_submit/subject_setting" method="post" id="subject_dis_form">
			<table  class="table table-hover">
				<tr>
					<th>
						<div class="form-group">
							<label class="control-label col-sm-2" for="pwd">Shift Name:</label>
							<div class="col-sm-3" id="shak_id_1">          
								<select name="sft_name"  class="form-control" onchange="selected_class(this.value);"  id="sft_name_sub" required>
									<option value="">SELECT Shift</option>
								<?php 
									foreach ($sft as $value) {
										?>
										<option <?php if(isset($_GET['sid'])){ extract($_GET);  if($sid==$value->shiftid){ echo"selected"; }} ?> value="<?php echo $value->shiftid; ?>"><?php echo $value->shift_N; ?></option>
									<?php 	
									}
								?>
								</select>
							</div>
					  
							<label class="control-label col-sm-2" for="pwd">Class Name:</label>
							<div class="col-sm-3">          
								<select name="class_name" class="form-control" onchange="class_wise_subject(this.value,sft_name_sub.value)"  id="class_name" required>
									<?php if(isset($_GET['cid'])) { 
									foreach($class1 as $value){
									?>
									<option <?php if($cid==$value->classid)  { echo "selected"; } ?> value="<?php echo $value->classid; ?>"><?php echo $value->class_name; ?></option>
									<?php }  } else {?>
									<option value="">SELECT CLASS</option>
									<?php } ?>
								</select>
							</div>
						</div>
					</th>
				</tr>
				
			</table>
			<?php 
			if(isset($_GET['cid'])) {
				
			extract($_GET);
			$selected_class=$this->db->select("*")->from("class_catg")->where("classid",$cid)->get()->row();
			$group_set=$selected_class->groupid;
			$terget_subject=$this->db->select("*")->from("subject_setup")->order_by("subsetid","desc")->get()->result();
			?>
			<table class="table table-condensed table-striped">
				<tr>
					<td colspan="10"><center style="font-size:20px;">Subject List</center></td>
				</tr>
				<tr>
					<th class="test_center">NR</th>
					<th class="test_center">Choose</th>
					<th class="test_center">Subject</th>
					<th class="test_center">Theory</th>
					<th class="test_center">Objective</th>
					<th class="test_center">Practical</th>
					<th class="test_center">Total</th>
					<th class="test_center">Sequence</th>
					<th class="test_center">Group</th>
					<th class="test_center">Optional</th>
				</tr>
				<?php $i=1; foreach($terget_subject as $value) { ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td>
						<select name="sub_chk[]" class="form-control" style="width:70px;" onchange="test(this.value,<?php echo $i; ?>);" id="sub_chk_<?php echo $i; ?>">
							<option value="0">No</option>
							<option value="<?php echo $value->subsetid; ?>">Yes</option>
						</select>
					</td>
					<td>
						<input type="text" name="subject[]" style="width:200px;" disabled id="subject_<?php echo $i; ?>" class="form-control" readonly value="<?php echo $value->sub_name; ?>">
					</td>
					<td>
						<input type="number" min="0" name="theo_mark[]" onchange="sub_setup_mark_calculation(this.value,obj_mark_<?php echo $i; ?>.value,prac_mark_<?php echo $i; ?>.value,<?php echo $i; ?>);" required disabled id="theo_mark_<?php echo $i; ?>" class="form-control"  value="0">
					</td>
					<td>
						<input type="number" min="0" name="obj_mark[]" onchange="sub_setup_mark_calculation(theo_mark_<?php echo $i; ?>.value,this.value,prac_mark_<?php echo $i; ?>.value,<?php echo $i; ?>);" disabled id="obj_mark_<?php echo $i; ?>" class="form-control"  value="0">
					</td>
					<td>
						<input type="number" min="0" name="prac_mark[]" disabled id="prac_mark_<?php echo $i; ?>" class="form-control" onchange="sub_setup_mark_calculation(theo_mark_<?php echo $i; ?>.value,obj_mark_<?php echo $i; ?>.value,this.value,<?php echo $i; ?>);"  value="0">
					</td>
					<td>
						<input type="number" min="0" name="total_mark[]" readonly disabled required id="total_mark_<?php echo $i; ?>" class="form-control"  value="0">
					</td>
					<td>
						<input type="number" min="0" name="sequence[]" disabled required id="sequence_<?php echo $i; ?>" class="form-control"  value="">
					</td>
					
					<td>
						<select name="group[]" class="form-control" disabled id="group_<?php echo $i; ?>">
							<option value='0'>No</option>
							<?php foreach($all_group as $value){  ?>
							<option value="<?php echo $value->groupid; ?>"><?php echo $value->group_name; ?></option>
							<?php } ?>
						</select>
					</td>
					
					<td>
						<select name="optional[]" disabled class="form-control" style="width:70px;" id="optional_<?php echo $i; ?>">
							<option value='0'>No</option>
							<option value='1'>Yes</option>
						</select>
					</td>
				</tr>
			    <?php $i++; } ?>
				
				<tr>
					<td colspan="9"><center style="font-size:20px;"><button type="submit" name="sub_dis" id="sub_dis" class="btn btn-primary">Save</button></center></td>
				</tr>
							  
			</table>
			<?php } ?>
		</form>
	</div>
	 
</div>
