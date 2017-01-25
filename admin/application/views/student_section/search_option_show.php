<script type="text/javascript">
function student_search_section(str)
{
	url='student_section/student_search_bysection?str='+str;
	$("#list_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#list_show").load(url);
}

function student_search_bysesion(str)
{
	url='student_section/student_search_bysesion?str='+str;
	$("#list_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#list_show").load(url);
}


function student_edit(sid,str)
{
	
	url='student_section/student_edit?sid='+sid+'&str='+str;
	$("#list_show").empty().append('<p align="center" style="margin-top:5%"><img src="img/line.gif"></p>');
	$("#list_show").load(url);
}
</script>
<div class="row">
						
								<div class="col-md-12">
									<nav class="navbar navbar-default" style="background:#F8F8F8;">
										<?php extract($_GET); $search_str="";?>
										<!-- Brand and toggle get grouped for better mobile display -->
										<div class="navbar-header">
											  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											  </button>
											  <a class="navbar-brand" href="javascript:void(0);"><?php foreach($all_shift as $value) { if($value->shiftid==$sid) { echo ucfirst($value->shift_N); } } ?> Shift  <span class="glyphicon glyphicon-hand-right"></span></a>
										</div>

										<!-- Collect the nav links, forms, and other content for toggling -->
										<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
											<?php foreach($class as $value_cls){ ?>
											<ul class="nav navbar-nav">
												<li class="dropdown">
												  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:gray;"><?php echo ucfirst($value_cls->class_name); ?><span class="caret"></span></a>
												  <ul class="dropdown-menu">
													<?php 
													$ex=$this->bsetting->section_info($value_cls->classid);
													foreach($ex as $value)
													{
													$search_str=$sid."/".date("Y")."/".$value_cls->classid."/".$value->sectionid;	
													?>
													<li onclick="student_search_section('<?php echo $search_str; ?>');"><a href="javascript:void(0);">Section <?php echo ucfirst($value->section_name); ?></a></li>
													<?php } 
													$search_str=$sid."/".date("Y")."/".$value_cls->classid."/"."all"; ?>
													<li role="separator" class="divider"></li>
													<li onclick="student_search_section('<?php echo $search_str; ?>');"><a href="javascript:void(0);">All Section</a></li>
												  </ul>
												</li>
											</ul>
											<?php } ?>
											
											
											<!------session search start----->
											<ul class="nav navbar-nav">
												<li class="dropdown">
												  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color:gray;">Session<span class="caret"></span></a>
												  <ul class="dropdown-menu">
													<?php $search_str=$sid."/".date("Y"); ?>
													
													<li onclick="student_search_bysesion('<?php echo $search_str; ?>');"><a href="javascript:void(0);"><?php $y=date("Y"); $j=$y-8; echo $y; ?></a></li>
													
													<li role="separator" class="divider"></li>
													
													<?php 
													$i=$y-1; for($i;$i>$j;$i--) { 
													$search_str=$sid."/".$i;
													?>
													<li onclick="student_search_bysesion('<?php echo $search_str; ?>');"><a href="javascript:void(0);"><?php echo $i; ?></a></li>
													<?php } ?>
												  </ul>
												</li>
											</ul>
											
											<!------session search End------->
											
										</div>
									  
									</nav>
								</div>
							
							</div>