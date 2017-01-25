<?php
	$id=$_GET['id'];
	
	$edit=$this->db->select("*")
					->from("infrastructure")
					->order_by('id','DESC')
					->limit(1)
					->get()
					->row();
?>

<script type="text/javascript">
	
function readURL(input) {
	if (input.files && input.files[0]) {//Check if input has files.
	var reader = new FileReader(); //Initialize FileReader.

	reader.onload = function (e) {
	$('#preImg').attr('src', e.target.result);
	$("#preImg").resizable({ aspectRatio: true, maxHeight: 300 });
	};
	reader.readAsDataURL(input.files[0]);
	} 
	else {
	$('#preImg').attr('src', "#");
	}
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
                       Edit  Infrustructure
                         <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Infrustructure</li>
                    </ol>
                </section>

                <!-- Main content -->
<section class="content">
	<form role="form" action="index.php/website/updateInfrastructure" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-4"></div>

					<div class="col-md-2">
						<input type="hidden" name="msgid" id="msgid" value="<?php echo $id; ?>" />
					<img src="img/document/infrustructure/<?php echo $edit->image; ?>" class="img-thumbnail" height="120" width="155" name="preImg" id="preImg"/>
					<input type="file" class="form-control" name="priImg" onchange="readURL(this)" />
					</div>
					
					<div class="col-md-2">
					</div>
					
					<div class="col-md-4">
					</div>
				</div>
				<div class="row">
				<div class="col-md-10">
				 <div class="form-group">
						<label for="email">Title</label>
						<input type="text" class="form-control" value="<?php echo 	$edit->title;?>" id="title" name="title">
					  </div>
					  
					  <div class="form-group">
						<label for="pwd">Details</label>
						<textarea class="form-control" rows="8" id="details" name="details">
						<?php echo 	trim($edit->details); ?>
						</textarea>
					  </div>
					  
					  <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span> Update</button>
				</form>
				</div>
				<div class="col-md-2"></div>
		</div>
	</section>
	<!-- /.content -->
</aside>
