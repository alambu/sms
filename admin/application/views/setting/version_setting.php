<form class="form-horizontal" role="form" action="student_submit/version_setting" method="post" >
			<div class="form-group">
				<div class="col-md-2">
					<b style="float:right;padding-top:5px;">Version Name</b>
				</div>
				<div class="col-md-8">
					<input type="text" name="version" id="version" class="form-control"  onkeypress="return only_chareter(this.value)" placeholder="Enter Version Name" required/>
				</div>
				<div class="col-md-2">
					<button type="submit"  name="submit" class="btn btn-primary" data-toggle="tooltip" title="Save"> <span class="glyphicon glyphicon-send"></span> Submit </button>
				</div>
			</div>
		</form>
	  
<hr/ style="color:gray;">
										
												
											
<!--Version Setting End-->



<!---version Edit Start-->
										
<?php if($t_vrow!=0){ ?>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-condensed">
				<tr class="active">
					<td><center><b style="font-size:18px;line-height:20px;color:dark-gray ;">Version List</b></center></td>
				</tr>
			
			</table>
			
		</div>
	</div>
	<br/>
											
	<div class="row">
		<div class="col-md-12">
		<table id="example3"  class="table table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th>Sl.No</th>
					<th>Version Name</th>
					<th>Edit</th	>
				</tr>
			</thead>
			<tbody>
				<?php $vid=1;
				foreach($vers as $value){
				?>
				<tr>
					<td><?php echo $vid++; ?></td>
					<td><?php echo $value->version_N ?></td>
					<td><a href="student_edit/version_setting?id=<?php echo $value->verid; ?>"><button type="button" class="btn btn-info" data-toggle="tooltip" title="Edit"><span class="glyphicon glyphicon-edit"></span></button></a></td>
				</tr>
				<?php } ?>
			</tbody>
		
		</table>
		</div>
	</div>					
<?php } ?>