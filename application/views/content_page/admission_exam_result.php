<!------this is main dynamic content start-------------------------------> 
	
		<div class="main_con"><!--Content Start-->
			<div class="row">
				<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
	<div class="col-md-12"><!-- Welcome Massage Start-->
		<div class="panel panel-primary">
			<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Academic Exam Result</div>
			<div class="panel-body" style="min-height:770px;">
				<div class="table-responsive"> 
                            <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr class="alert-default">
                                                <th>SL NO.</th>
                                                <th>File Title</th>
                                                <th>Date</th>
                                                <th>Download</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                    <tbody>
									<?php 
									$nr=1;
									$qy=$this->db->get("admission_result")->result();
									foreach($qy as $row):
									?>
                                        <tr>
                                            <td><?php echo $nr++?></td>
                                            <td> <?php echo $row->title?></td>
                                            <td><?php echo date('d M Y',strtotime($row->notice_date))?></td>
                                            <td><a href="main/download_notice/<?php echo $row->file_name?>"><span class="label label-danger">Download</span></a></td>
                                            <td><a href="main/details/<?php echo $row->id?>"><span class="label label-danger">View</span></a></td>
                                        </tr>
										<?php endforeach;?>
                                </tbody>
                            </table>
                            </div>  
			</div>
		</div>
	</div><!-- Welcome Massage End-->
</div>
					



				
				
				
				
		
					
		</div><!-- left Content End-->
		
		<!--------------------This is Main Dynamic Content End------------------------------->