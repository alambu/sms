<script type="text/javascript">
	function chkDept(str){
		$.ajax({
			url:"index.php/website/chkDept",
			type:"POST",
			data:{d:str},
			success:function(data){
				if(parseInt(data)>0){
					alert("This Department already inserted.");
					document.getElementById("dept").value="";
					document.getElementById("dept").focus();
				}
			}
		});
	}

	var LoadFile=function(event){
		var output=document.getElementById("out");
		output.src=URL.createObjectURL(event.target.files[0]);
	}
</script>
<aside class="right-side">      <!---rightbar start here -->
        <!-- Content Header (Page header) -->
           <section class="content-header">
                <h1>Create Department<small>Control panel</small></h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0)"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
        <div class="row">
			<div class="col-md-11">
                <div class="box">
				<div class="box-body table-responsive">
<form  action="index.php/website/submitDept" method="post" enctype="multipart/form-data">
				 
<!-- success massasge -->
		<?php $this->load->view("website/success"); ?>
<!-- success massasge -->

				 <div class="form-group">
						<label>Department Image</label>
						<input type="file" name="deptImg" class="form-control" id="deptImg" onchange="LoadFile(event)" required accept="image/*" >
						<img src="" height="70" width="80" class="img-thumbnail" id="out" />
				 </div>
				 <div class="form-group">
						<label>Department Name</label>
						<input type="text" name="dept_name" class="form-control" id="dept" onchange="chkDept(this.value)" required >
				 </div>
					  
					  <div class="form-group">
						<label>Description</label>
						<textarea class="form-control" name="details" rows="8">
						
						</textarea>
					  </div>
					  
					  <button type="submit" name="send" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Send </button>
					  &nbsp;&nbsp;
					  <button type="reset" class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span> Reset </button>
				
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>
				</form>
				</section>
                                                            

                <!-- /.content -->
            </aside><!-- /.right-side -->
	