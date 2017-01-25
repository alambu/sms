<?php 
$this->load->view('header');
$this->load->view('leftbar');
?>
<script type="text/javascript">

// deactive function

    function deactive(values,rowid,nr){
        var con=confirm('Are You Sure to Inactive this Category Type?'); 
    if(con==true){
        $.ajax({
                url:"index.php/account_edit/edit_classfee_catg_status",
                data:{tvalue:values,feectgid:rowid},
                type:"POST",
                beforSend:function(){
                    document.getElementById("btnId"+nr).innerHTML="processing...";
                },
                success:function(data){
                    // alert(data);
                    var btnId=data.split("+");					
                    //alert(btnId[1]);
					
                document.getElementById("rowid"+nr).value='1';
                document.getElementById("btnId"+nr).className="btn btn-danger";
                document.getElementById("btnId"+nr).innerHTML="Inactive";
               document.getElementById("btnId"+nr).setAttribute('onclick','actives(1,'+btnId[1]+','+nr+')');
                document.getElementById("edit"+nr).disabled=true;
                }
            });
    }
    }
// deactive function


// activate function
    function actives(values,rowid,nr){
        var con=confirm('Are You Sure to Active this exam ?'); 
    if(con==true){
        $.ajax({
                url:"index.php/account_edit/edit_classfee_catg_status",
                data:{tvalue:values,feectgid:rowid},
                type:"POST",
                beforSend:function(){
                    document.getElementById("btnId"+nr).innerHTML="processing...";
                },
                success:function(data){
                    // alert(data);
                    var btnId=data.split("+");
                    // alert(btnId[1]);

                document.getElementById("btnId"+nr).className="btn btn-success";
                document.getElementById("btnId"+nr).innerHTML="Active";
                document.getElementById("btnId"+nr).setAttribute('onclick','deactive(0,'+btnId[1]+','+nr+')');
                document.getElementById("edit"+nr).disabled=false;
                }
            });
    }
    }
// activate function


// editing function
    function edit(sid){
        document.getElementById("catgtyp"+sid).style.display="none";
        document.getElementById("catgtype"+sid).type="text";
        document.getElementById("catgtype"+sid).focus();
    }
// editing function

// edit action
    function edittitle(tvalue,rowid,nr){
        $.ajax({
                url:"index.php/account_edit/edit_classfee_catg",
                data:{tvalue:tvalue,feectgid:rowid},
                type:"POST",
                success:function(data){
					if(data==1){
						document.getElementById("catgtyp"+nr).style.display="block";
						document.getElementById("catgtyp"+nr).innerHTML=tvalue;
						document.getElementById("catgtype"+nr).type="hidden";
					}
					else{
						alert(data);
					}
                }
            });
    }
// edit action


    </script>
<aside class="right-side">      <!---rightbar start here --->
              <!-- Content Header (Page header) -->

                <section class="content-header">
                    <h1>
                        All Class Fee Category
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
							<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Nr</th>
									<th>Category Name</th>									
									<th>Action</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php $nr=1; foreach($query as $row){?>
								<tr>
									<td><?php echo $nr++ ?></td>
									<td>
										<input type="hidden" name="rowid[]" value="<?php echo $row->feectgid;?>" id="rowid<?php echo $nr?>"/>
									<span id="catgtyp<?php echo $nr; ?>"><?php echo $row->catg_type;?></span>
                                <input type="hidden" name="title[]" id="catgtype<?php echo $nr; ?>" value="<?php echo $row->catg_type;?>" onchange="edittitle(this.value,rowid<?php echo $nr; ?>.value,<?php echo $nr; ?>)" class="form-control" />
									</td>
									<td><button type="reset" id="edit<?php echo $nr; ?>" value="" class="btn btn-info" id="reset" onclick="edit(<?php echo $nr;?>)" <?php if($row->status==0){echo "disabled";} ?>><span class="glyphicon glyphicon-edit"></span> Edit</button></td>
							
							<td>
							<input type="hidden" name="nrowid[]" value="<?php echo $nr;?>" id="nrowid<?php echo $nr?>"/>
                                <?php 
                                    if($row->status==1){
                                ?>
                                <button class="btn btn-success" id="btnId<?php echo $nr; ?>" onclick="deactive('0',rowid<?php echo $nr;?>.value,nrowid<?php echo $nr; ?>.value);">Active</button>
                                <!-- <img src="" id="load" height="40px" width="40px"  /> -->
                                <?php
                                    }else{
                                ?>
                                <button class="btn btn-danger" id="btnId<?php echo $nr; ?>" onclick="actives('1',rowid<?php echo $nr;?>.value,nrowid<?php echo $nr?>.value);">Inactive</button>
                                <!-- <img src="" id="load" height="40px" width="40px"  /> -->
                                <?php
                                    }
                                ?>
                            </td>									
								</tr>
								<?php }?>
							</tbody>
							</table>
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->
		<?php $this->load->view('footer');?>