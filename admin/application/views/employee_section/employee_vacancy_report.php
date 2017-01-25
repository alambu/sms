 <!--<aside class="right-side">      -rightbar start here --->
                <!-- Content Header (Page header) -->
		 <style>
		.error{
			border-color:red;
		}
	</style>            <!-- Content Header (Page header) -->

<script type="text/javascript">

  var newwindow;
  function details(url)
  {
  newwindow=window.open(url,'name','height=370,width=650,left=500,scrollbars=yes,top=105');
  if (window.focus) {newwindow.focus()}
  }

</script>

                <!--<section class="content-header">
                    <h1>
                      Employee Vacancy Report
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Employee</li>
						<li class="active">Employee Vacancy Report</li>
                    </ol>
                </section>-->
				
                <!-- Main content -->

                    <div class="row">
                      <div class="col-md-12">
					   
                                   <table id="example1" class="table table-condensed table-bordered table-hover">
								<thead>
									<tr>
									<th>Serial No</th>
									<th>Designation</th>
									<th>Total Post</th>
									<th>Present Employee</th>
									<th>Vacancy</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
								$select=$this->db->select("*")
									->from("employee_catg")
									->get()
									->result();
									$vid=1;
									foreach($select as $value){
									?>
									<tr>
									<td><?php  echo $vid++; ?></td>
									<td><?php echo $value->emp_type ; ?></td>
							        <td><?php  echo $value->need_emp; ?></td>
									<td><?php echo $pre=$this->db->query("select count(empid) as pre_emp from empee where deginition='$value->ecatgid'")->row()->pre_emp; ?></td>
									<td>
									
									<?php echo $value->need_emp-$pre; ?>
									</td>
									
									<?php } ?>
									</tr>
								</tbody>
								
							</table>
						
					  </div>
					  
					 
                    </div>
