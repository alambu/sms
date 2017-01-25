<!---this is footer part start-->
		
<style type="text/stylesheet">
.thumbnail {margin-bottom:6px;}
.carousel-control.left,.carousel-control.right{
	background-image:none;
}
#list-social{
		background:#fff;			
	}
#list-social li{
	float:left;
	list-style:none;
	background:#fff;
}
#list-social li a{
	float:left;
	list-style:none;
	background:gray;
}
#list-social li a:hover{
	float:left;
	list-style:none;
	background:gray;
	opacity:0.5;
}

#quickNav li{
	list-style:none;
	padding-top:7px;
}
#list-social1 li a{
	float:left;
	list-style:none;
	color:black;
}

</style>
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
			$('#modalCarousel').carousel({interval:false});

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

<!-- all query are here -->
<?php
	$spro=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();
	$map = $this->db->select("map_link")->from("google_map")->order_by("id","DESC")->limit(1)->get()->row();
?>
<!-- all query are here end -->

<div class="photo_gallery">
	<div class="row">
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading" style="background-color:#004884"><!---<i class="fa fa-map-marker"></i> -->&nbsp; Quick Navigation</div>
					<div class="panel-body">
						<div id="quickNav" class="col-lg-12 quick" style="min-height:155px;">
							<ul id="" >
								<li><a href="index.php/home/index">Home</a></li>
								<li><a href="index.php/home/about">About</a></li>
								<li><a href="index.php/home/index">Contact</a></li>
								<li><a href="index.php/home/photo_gallery">Photo Gallery</a></li>
								<li><a href="index.php/home/admission_info">Admission Info</a></li>
							</ul>
						</div>
					</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading" style="background-color:#004884"><!---<i class="fa fa-map-marker"></i> -->&nbsp; Find Us With Google Map</div>
				<div class="panel-body">
					<div id="googleMap" class="col-lg-12">
						<iframe src="<?php echo trim($map->map_link); ?>" width="300" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>
				
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading" style="background-color:#004884">
					<!---<i class="fa fa-map-marker"></i>--> &nbsp; Contact Us
				</div>
				<div class="panel-body">
					<div>
						<address style="text-align: center;padding-bottom:1px;">
							<h3><?php echo $spro->schoolN ?></h3>
							<p><?php echo $spro->address ?></p>
							<p>
								Email : <?php echo $spro->email ?><br/>
								website : <a href="<?= base_url() ?>">www.<?= str_replace("/","",str_replace("http://","",base_url())) ?></a>
							</p>
						</address>
					</div>
				</div>
			</div>
		</div>
</div>

		
<div class="footer" style="background-color:#004884;color: #fff;width:100%;margin:0px auto; "><!--Footer Start -->
	<div class="row content">
		<div class="col-md-8">
			<p>&copy; copyright 2015. <a href="#" style="color:#fff;"><?php echo $spro->schoolN ?>.</a> </p>
		</div>
		<div class="col-md-4">
			<div>
				<p>
				Design & Developed by : 
				<a href="http://www.innovationit.com.bd" target="_blank" style="color:#fff;">
					Innovation IT
				</a>
				</p >
			</div>
		</div>
	</div>
</div><!--Footer End -->
		
		
				</div>
			</div>
		</div><!-- Main Stop-->
	</body>
</html>