<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
    function edittitle(classid,catgory,amount,rowid,nr,year){	
			
        $.ajax({
                url:"index.php/account_edit/edit_fee_setting_catg",				
                data:{classid:classid.trim(),catgory:catgory.trim(),amount:amount.trim(),rowid:rowid.trim(),year:year},
                type:"POST",
                success:function(data){
					if(data==1){
						var clasName=document.getElementById("classname"+nr).options[document.getElementById("classname"+nr).selectedIndex].text;
						var feeCatg=document.getElementById("feectg"+nr).options[document.getElementById("feectg"+nr).selectedIndex].text;
						document.getElementById("classN"+nr).style.display="block";						
						document.getElementById("feectgspan"+nr).style.display="block";
						document.getElementById("amountspan"+nr).style.display="block";
						document.getElementById("feectgspan"+nr).innerHTML=feeCatg;
						document.getElementById("classN"+nr).innerHTML=clasName;
						document.getElementById("amount"+nr).type="hidden";
						document.getElementById("amountspan"+nr).innerHTML=amount;
						document.getElementById("classname"+nr).style.display="none";
						document.getElementById("feectg"+nr).style.display="none";
						document.getElementById("subedit"+nr).style.display="none";
					}
					else{
						alert(data);
					}
                }
            });
    }
	
	
	// editing function
    function edit(sid){
		
        document.getElementById("classN"+sid).style.display="none";
        document.getElementById("feectgspan"+sid).style.display="none";
        document.getElementById("amountspan"+sid).style.display="none";
        document.getElementById("classname"+sid).style.display="inline";
        document.getElementById("feectg"+sid).style.display="inline";
        document.getElementById("subedit"+sid).style.display="inline";
        document.getElementById("amount"+sid).type="text";
        document.getElementById("classname"+sid).focus();
       
    }
// editing function
// edit action
</script>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Class Fee Category List
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
						<div class="row">
						<div class="col-sm-12">
						<form class="form-horizontal" role="form" action="index.php/account_edit/search_class_fee_seting" method="post">
						<div class="form-group">
							<div class="col-sm-3" ></div>   													
							<div class="col-sm-2">          
							<select class="form-control" name="classname" id="classname">
									<option value="">--Select Class--</option>
									<?php 
										$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
										foreach($sqlacc as $accidshow){
									?>
										<option value="<?php echo $accidshow->classid?>" <?php if($classid==$accidshow->classid){echo "SELECTED";}?>><?php echo $accidshow->class_name?></option>
										<?php }?>
							</select>
						  </div>
						 
						
						  <div class="col-sm-2">          
							<select class="form-control" name="year" id="year">
							<option value="">All</option>
								<?php $yearss=date('Y');
								$b='2010';
								for($a=$yearss;$a>=$b;$a--){
								?>
									<option value="<?php echo $a?>" <?php if($years==$a){echo "SELECTED";}?>><?php echo $a?></option>
								<?php }?>
							</select>
						  </div>								
								<div class="col-sm-2">
									<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
								</div>
						</div>
						</form>
						</div>
						
					</div>
                    <div class="row">
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Class Name</th>									
									<th>Fee Category</th>
									<th>Amount</th>
									<th>Year</th>
									<th>Action</th>
								</tr>								
							</thead>
							<tbody>							
								<?php $nr=1; $a=0; $b=1; foreach($query as $row){
									$classid=$this->accmodone->classname($row->classid);
									
									$feecata=$this->accmodone->classfeecatg($row->feectgid);
										/*$clscount=$this->accmodone->classcount($row->classid);
										$totalcl=$clscount->tclass;*/
									?>
								<tr>
								<input type="hidden" name="rowid[]" value="<?php echo $row->feeid;?>" id="rowid<?php echo $nr?>"/>
								<input type="hidden" name="year[]" value="<?php echo $row->year?>" id="yearid<?php echo $nr?>"/>
									<?php /*if($a<$b){*/ ?>
									<td><?php echo $nr?></td>
									<td>
									<?php //echo $classid->class_name?>
									<span id="classN<?php echo $nr; ?>"><?php echo $classid->class_name;?></span>
									<select class="form-control" name="classname[]" id="classname<?php echo $nr?>" style="display:none;">
										<option value="">--Select--</option>
										<?php 
											$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();
											foreach($sqlacc as $accidshow){
										?>
											<option value="<?php echo $accidshow->classid?>" <?php if($accidshow->classid==$row->classid){echo "SELECTED";}?>><?php echo $accidshow->class_name?></option>
											<?php }?>
									</select>
									</td>
									<?php /* $a=$totalcl; } */?>
									<td><?php //echo $feecata->catg_type?>
										<span id="feectgspan<?php echo $nr; ?>"><?php echo $feecata->catg_type;?></span>
									<select class="form-control" name="feectg[]" id="feectg<?php echo $nr?>" style="display:none;">
										<option value="">--Select--</option>
										<?php 
											$sqlaccs=$this->db->select('*')->from('fee_catg')->get()->result();
											foreach($sqlaccs as $accidshows){
										?>
											<option value="<?php echo $accidshows->feectgid?>" <?php if($accidshows->feectgid==$row->feectgid){echo "SELECTED";}?>><?php echo $accidshows->catg_type?></option>
											<?php }?>
									</select>
									
									</td>
									<td><?php //echo $row->amount?>
										<span name="amountspan" id="amountspan<?php echo $nr;?>"><?php echo $row->amount;?></span>
										<input type="hidden" name="amount[]" id="amount<?php echo $nr; ?>" value="<?php echo $row->amount;?>" class="form-control" />									
									</td>
									<td><?php echo $row->year?></td>
									
									<td>
									<button type="button" id="edit<?php echo $nr; ?>" value="" class="btn btn-info" onclick="edit(<?php echo $nr;?>)"?><span class="glyphicon glyphicon-edit"></span> Edit</button>
									
									<button type="button" id="subedit<?php echo $nr; ?>" class="btn btn-success" style="display:none;" onclick="edittitle(classname<?php echo $nr?>.value,feectg<?php echo $nr?>.value,amount<?php echo $nr?>.value,rowid<?php echo $nr?>.value,<?php echo $nr?>,yearid<?php echo $nr?>.value)"><span class="glyphicon glyphicon-ok"></span></button>
									
									</td>	
								</tr>
								<?php $nr++; /*$a--;*/}?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>