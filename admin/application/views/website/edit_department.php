<?php
error_reporting(0);
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("department")
					->where("id",$id)
					->get()
					->row();
?>
<script type="text/javascript">

function LoadFile(event) {
	var output= document.getElementById("preImg");
	output.src=URL.createObjectURL(event.target.files[0]);
}

</script>
<!-- place in header of your html document -->
<script>
tinymce.init({
    selector: "textarea#details",
    theme: "modern",
    width: 910,
    height: 300,
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile save undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 
</script>

 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Update Department
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Department</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<form action="index.php/website/updateDept" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4"></div>

					<div class="col-md-2">
						<input type="hidden" value="<?php echo $id; ?>" name="msgid" id="msgid" />
						<img src="img/document/department/<?php echo $edit->image; ?>" class="image-bordered" id="preImg" height="100" width="100"/>
						<input type="file" name="welimg" id="welimg" style="margin-top:10px;" onchange="LoadFile(event)" />
					</div>
					
					<div class="col-md-2">
					</div>
					
					<div class="col-md-4">
					</div>
				</div>
				<div class="row">
				<div class="col-md-10">
				 
					  <div class="form-group">
						<label for="email">Department Name</label>
						<input type="text" class="form-control" value="<?php echo $edit->department_name;?>" id="title" name="title" />
					  </div>
					  
					  <div class="form-group">
						<label for="pwd">Details</label>
						<textarea class="form-control" rows="8" name="details" id="details">
							<?php echo 	trim($edit->details); ?>
						</textarea>
					  </div>
					  
					  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Update</button>
				
				</div>
				<div class="col-md-2">
				
				</div>
				
				</div>
</form>
				</section>
                                                            

                <!-- /.content -->
            </aside>
