<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<aside class="right-side">
    <section class="content-header">
        <h1>Slide Preview<small>Control panel</small></h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Slide Preview</li>
        </ol>
    </section>
	
<style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }

  #preview{
  		height:100px;
  		width:100px;
  		float:left;
  		margin-left: 10px;
  		border:1px solid #d0d0d0;
  }

  .cancelBtn{
  	background: #b3d7ff !important;
  	color: black;
  	font-weight: bold;
  	border: 1px solid white !important;
  	margin-left: -26px;
  	margin-top: 3px;
  	border-radius: 20px;
  }

  .imgPrev{
  	float: left;
  }

  .imgPrev a button:hover{
  	background: white !important;
  	color: black;
  	font-weight: bold;
  }

  .addImg{
  	float: left;
  	height:100px;
	width:100px;
	margin-left: 10px;
	border:1px dashed #d0d0d0;
  }

  .addImg a button{
  	background: none !important;
  	height: 100%;
  	width: 100%;
  	border: none !important;
  	color: #b3d7ff;
  	font-size: 60px;
  }

  .addImg a button:hover{
  	color: #b3d7ff;
  }

  </style>

	<section class="content">

<div class="container"><!-- Slide Show Start-->
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php
				$img = $this->db->select("*")->from("slide_setting")->order_by("sequence","ASC")->get()->result();
				$id=0;foreach( $img as $ig ):if($id==0):$c="active";else:$c='';endif; ?>
		      <li data-target="#myCarousel" data-slide-to="<?php echo $id; ?>" class="<?php echo $c; ?>"></li>
		    <?php $id++;endforeach; ?>

    	</ol>

		<div class="carousel-inner" role="listbox">
			<?php 
				
				$si = 0;
				foreach( $img as $ig ):
					$si++;
					if( $si == 1 ):$class = "item active";
					else:$class = "item";
					endif;
			?>
			<div class="<?php echo $class; ?>">
				<img src="../all/slide/<?php echo $ig->image_name ?>" class="img-responsive" height="500" width="900" style="height:450px;width:900px;" />
					<div class="carousel-caption">
						<h3><?php echo $ig->title; ?></h3>
						<p><?php echo $ig->description; ?></p>
					</div>
			</div>

			<?php endforeach; ?>
			
			<!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
	</div>
</div>

	<div class="panel panel-info" style="margin-top: 10px;">
		<div class="panel-body">
			<?php foreach( $img as $ig ): ?>
				<div class="imgPrev">
					<img src="../all/slide/<?php echo $ig->image_name ?>" class="img-responsive" height="70" width="70" id="preview" />
					<a href="slide_settings/deleteSlide/<?php echo $ig->id; ?>" onclick="return confirm('Are You sure to delete this slide ?');"><button class="cancelBtn" class="btn btn-primary">X</button></a>
				</div>
			<?php endforeach; ?>
			<div class="addImg">
				<a href="slide_settings/settings/"><button class="btn btn-primary">+</button></a>
			</div>
		</div>
	</div>

</div>
</section>
</aside>

<script type="text/javascript">
			/* copy loaded thumbnails into carousel */
			$('.row .thumbnail').on('load', function() {

			}).each(function(i) {
				if(this.complete) {
					var item = $('<div class="item"></div>');
					var itemDiv = $(this).parents('div');
					var title = $(this).parent('a').attr("title");

					item.attr("title",title);
					$(itemDiv.html()).appendTo(item);
					item.appendTo('.carousel-inner');
					if (i==0){ // set first item active
						item.addClass('active');
					}
				}
			});

			/* activate the carousel */
			$('#modalCarousel').carousel({interval:true});

			/* change modal title when slide changes */
			$('#modalCarousel').on('slid.bs.carousel', function () {
				$('.modal-title').html($(this).find('.active').attr("title"));
			})

			/* when clicking a thumbnail */
			$('.row .thumbnail').click(function(){
				var idx = $(this).parents('div').index();
				var id = parseInt(idx);
				$('#myModal').modal('show'); // show the modal
				$('#modalCarousel').carousel(id); // slide carousel to selected

			});
</script>