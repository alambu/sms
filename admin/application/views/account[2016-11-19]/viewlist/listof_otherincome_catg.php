<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">
    function edittitle(tvalue,rowid,nr){	
        $.ajax({
                url:"index.php/account_edit/edit_billpay_catg",				
                data:{tvalue:tvalue.trim(),feectgid:rowid,uniqid:'id',tabname:'income_catg',cloname:'income_type'},
                type:"POST",
                success:function(data){
					if(data==1){
						document.getElementById("catgtyp"+nr).style.display="block";
						document.getElementById("catgtyp"+nr).innerHTML=tvalue.trim();
						document.getElementById("catgtype"+nr).value=tvalue.trim();
						document.getElementById("catgtype"+nr).type="hidden";
					}
					else{
						alert(data);
					}
                }
            });
    }
	// editing function
    function edit(sid){
        document.getElementById("catgtyp"+sid).style.display="none";
        document.getElementById("catgtype"+sid).type="text";
        document.getElementById("catgtype"+sid).focus();
    }
// editing function
// edit action
</script>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Income Category List
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
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Income Category</th>											
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){									
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td>
									<input type="hidden" name="rowid[]" value="<?php echo $row->id;?>" id="rowid<?php echo $nr?>"/>
									<span id="catgtyp<?php echo $nr; ?>"><?php echo $row->income_type;?></span>
                                <input type="hidden" name="title[]" id="catgtype<?php echo $nr; ?>" value="<?php echo $row->income_type;?>" onblur="edittitle(this.value,rowid<?php echo $nr; ?>.value,<?php echo $nr; ?>)" class="form-control" />
									</td>
									<td><button type="reset" id="edit<?php echo $nr; ?>" value="" class="btn btn-info" id="reset" onclick="edit(<?php echo $nr;?>)"?><span class="glyphicon glyphicon-edit"></span> Edit</button></td>	
								</tr>
								<?php }?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>