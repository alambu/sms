<!---Photo Gallery js File-->
	
	<!-- Add jQuery library -->
	
	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="all/image_gallery/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="all/image_gallery/source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="all/image_gallery/source/jquery.fancybox.css" media="screen" />
	
	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="all/image_gallery/source/helpers/jquery.fancybox-buttons.css" />
	<script type="text/javascript" src="all/image_gallery/source/helpers/jquery.fancybox-buttons.js"></script>
	
	<!---photo gallary end-->

	
	<script type="text/javascript">
		$(document).ready(function() {

			$('.fancybox').fancybox();

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});

		});
	</script>
	
	
	<!---End Photo Gallery File-->
<style type="text/css">
	.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
</style>

<?php 
	if(isset($_GET['album'])){
		$al=base64_decode($_GET['album']);
		// get album name
		$alNm=$this->db->select("*")->from("image_catagory")->where("id",$al)->get()->row();
		// if album not found return previous page
		if(count($alNm)<=0):
			redirect("home/photo_gallery","location");
		endif;
		// get all image from this album
		$allImg=$this->db->select("*")->from("gallery")->where("catagory",$al)->get()->result();
	}
?>

<div class="row">
	<div class="col-md-9 left_con"><!-- left Content Start-->
		<!-- <div class="row"> -->
		<div class="col-md-12"> <!--Welcome Massage Start-->
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"><?php echo $alNm->image_catagory ?> Photo Gallery</div>
				
				<div class="panel-body" style="min-height:200px;">
					<p>
					<?php foreach($allImg as $ag): ?>
						<a class="fancybox-buttons" data-fancybox-group="button" href="admin/galleryImage/img/<?php echo $ag->image ?>"><img src="admin/galleryImage/img/<?php echo $ag->image ?>" style="height:150px;width:150px;" alt="" /></a>
					<?php endforeach; ?>
					</p>
				</div>
		</div>
	</div>
</div>
