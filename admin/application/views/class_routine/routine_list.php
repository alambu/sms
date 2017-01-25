<style>
.panel-heading a:after {
    font-family:'Glyphicons Halflings';
    content:"\e114";
    float: right;
    color: black;
}
.panel-heading a.collapsed:after {
    content:"\e080";
}
table tr:hover{
	background:lightblue;
}
table tr:hover {
	background:lightblue !important;
}
</style>

</br>
<script>
var newwindow;
function routine_view(url)
{
newwindow=window.open(url,'name','height=600,width=1300,left=20,scrollbars=yes,top=20');
if (window.focus) {newwindow.focus()}
} 
</script>
<div class="panel-group" id="accordion">
	<?php
		extract($_GET);
		foreach($class as $val) {
	?>
	<div class="panel panel-info">
	  <div class="panel-heading">
		<h4 class="panel-title">
		  <a data-toggle="collapse" style="display:block;" data-parent="#accordion" href="#collapse<?php echo $val->classid; ?>">  <span class="glyphicon glyphicon-hand-right"></span>  Class <?php echo $val->class_name; ?></a>
		</h4>
	  </div>
	  <div id="collapse<?php echo $val->classid; ?>" class="panel-collapse collapse">
		<div class="panel-body">
			<table class="table table-condensed table-hover">
					<tr class="active">
						<th>SL.NO</th>
						<th>Section</th>
						<th>Routine</th>
					</tr>
					<?php 
						$ex=$this->bsetting->section_info($val->classid);
						$i=1;
						foreach($ex as $sec){	
					?>
					<tr>
						
						<td><?php echo $i++; ?></td>
						<td><span class='badge badge-success'><?php echo $this->bsetting->ge_section($sec->sectionid)->section_name; ?></span></td>
						
						<td>
						<button class="btn btn-info btn-sm"onclick="routine_view('class_routine/view_class_routine?sft=<?php echo  $sid; ?>&cls=<?php echo $val->classid; ?>&sec=<?php echo $sec->sectionid; ?>&year=<?php echo $year; ?>');"><span class="glyphicon glyphicon-list-alt"></span>  View Routine</button>
						</td>
						
					</tr>
					<?php } ?>
			</table>
		</div>
	  </div>
	</div>
		<?php  } ?>
</div>