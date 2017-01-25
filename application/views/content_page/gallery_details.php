
<html>
<head>
	
	<style>
	
			#data_content{
			height:auto;
			width:760px;
			margin-top:10px;
			margin-left:12px;
			float:left;
			border:0px solid;
			border-radius:5px;
			background-color:#f9f9f9;
			overflow:hidden;
	      }
		  
		  #row1{
			height:auto;
			width:750px;
			float:left;
		  }
		   
		  
		  #first_category{
			height:120px;
			width:120px;
			border:0px solid;
			border-radius:5px;
			margin:20px;
			float:left;
		  }
		  
		    
		  	.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

		body {
			max-width: 1900px;
			margin: 0 auto;
		}
		  
		  
	</style>
	
	 <script type="text/javascript" src="gallery/jquery-1.10.1.min.js"></script>
	  <script type="text/javascript" src="gallery/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="gallery/jquery.fancybox.css?v=2.1.5" media="screen" />
	
	
	
		<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

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


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	
	
	
</head>
<body>
  <div id="data_content">
   <h1 style="align:left; text-indent:30px; color:darkblue; font-weight:bold; text-decoration:underline;">
   
   <?php 
    if(isset($_GET['catagory'])){
		$catagory=$_GET['catagory'];
		echo $catagory;
	}

   ?></h1>
     <div id="row1">
	 <?php 
	/*  
	 $select=$this->db->select("*")
                      ->from("image_catagory")
					  ->get()
					  ->result();
					  
					    foreach($select as $test){
		$value=$test->image_catagory; 
					   } */
	 ?>
	 
<?php 
if(isset($_GET['catagory'])){
	 $cat=$_GET['catagory'];
	
	
	$sql=mysql_query("SELECT image from gallery where catagory='$cat' order by id DESC");	
	while($fetch=mysql_fetch_array($sql)){?>
	
	 <div id="first_category">
	 
	<!--   <a //class="fancybox" href="../school_admin/libraryImage/<?php //echo $test->image; ?>" data-fancybox-group="gallery" ><img src="../school_admin/libraryImage/<?php //echo $test->image;?>" style="height:120px; width:120px;"  /></a> -->
	 
	 
	<!--   <a class="fancybox" href="../school_admin/galleryImage/<?php //echo $image=$fetch['image']; ?>" data-fancybox-group="gallery" <img src="../school_admin/galleryImage/<?php //echo $image=$fetch['image']; ?>"  style="width:120px;height:120px"></a> -->
	   
	    
		
		<a class="fancybox" href="../school_admin/galleryImage/<?php echo $image=$fetch['image']; ?>" data-fancybox-group="gallery" ><img src="../school_admin/galleryImage/<?php echo $image=$fetch['image'];?>" style="height:120px; width:120px;"  /></a>
	   </div>
	<?php }	
	
}

?>
 
	 
	  <!--  <img src="../school_admin/galleryImage/<?php //echo $image=$fetch['image']; ?>"  style="width:200px; height:200px"></img> -->
	   
	   
	 </div>
	 
	 
	 
	
	 
  </div>
 
 </body>

</html>

