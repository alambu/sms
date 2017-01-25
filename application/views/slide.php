<div class="slid_show"><!-- Slide Show Start-->
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<?php 
				$img = $this->db->select("*")->from("slide_setting")->order_by("sequence","ASC")->get()->result();
				$si = 0;
				foreach( $img as $ig ):
					$si++;
					if( $si == 1 ):$class = "item active";
					else:$class = "item";
					endif;
			?>
			<div class="<?php echo $class; ?>">
				<img src="all/slide/<?php echo $ig->image_name ?>" class="img-responsive" height="400" width="1500" style="height:400px;width:1500px;" />
					<div class="carousel-caption"></div>
			</div>
			<?php endforeach; ?>
			
		</div>
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
	</div>
</div><!-- Slide Show End-->