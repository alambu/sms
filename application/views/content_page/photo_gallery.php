<!---this is main dynamic content start--> 
	
		
<style type="text/css">
		
.image {
    position:relative;
    float: left;
    margin-right: 8px;
    border:1px solid #1190A3;
}
.image .text {
    position:absolute;
    top:10px;
    left:10px;
    /*width:300px;*/
}

.text p{
	font-size:35px;
	font-weight: bold;
	color:#13815B;
	text-align: center;
	line-height: 120px;
	padding-left:10px;
}

.im:hover{opacity: 0.9;}

	</style>

</head>
<!--Head End-->


	
	
<div class="row">
	<div class="col-md-9 left_con"><!-- left Content Start-->
		<!-- <div class="row"> -->
		<div class="col-md-12"> <!--Welcome Massage Start-->
			<div class="panel panel-primary">
				<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Photo Gallery</div>
				
				<div class="panel-body" style="min-height:750px;">
				
							
						<p>
						<?php
							$album=$this->db->select("*")->from("gallery")->group_by("catagory")->get()->result();
							foreach($album as $al):
								$ctgN=$this->db->select("*")->from("image_catagory")->where("id",$al->catagory)->get()->row();
						?>
						<a href="index.php/home/albumDetails?album=<?php echo base64_encode($al->catagory); ?>">
						<div class="image">
						  <img src="admin/galleryImage/img/<?php echo $al->image ?>" style="height:150px;width:200px;position:relative;opacity:0.4;" class="img-thaumbnail" />
						  <div class="text">
						    <p><?php echo $ctgN->image_catagory ?></p>
						  </div>
						</div>
						</a>
						
						<?php
							endforeach;
						?>
						</p>
					</div>
		</div>
	</div>
</div>
