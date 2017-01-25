<?php error_reporting(0); ?>

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
			height:200px;
			width:200px;
			border:0px solid;
			background-color:#EEEDE9;
			border-radius:5px;
			margin:20px;
			float:left;
		  }
		  
		  #first_category:hover{
			height:200px;
			width:200px;
			background-color:#C3BAA9;
			border-radius:5px;
			margin:20px;
			float:left;
		  }
		  
	</style>
	
	
	
</head>
 <?php
	 
$select=$this->db->select("*")
                      ->from("image_catagory")
					  ->get()
					  ->result();
	 
					?>	
 <body>
  <div id="data_content">
    <h1 style="align:left; text-indent:30px; color:darkblue; font-weight:bold; text-decoration:underline;">Image Gallery</h1>
     <div id="row1">
	 <?php foreach($select as $test){
		$value=$test->image_catagory; 
		$sql=$this->db->query("SELECT catagory,image from gallery where catagory='$value' ORDER BY id DESC");
		$fetch=$this->db->affected_rows();
		if($fetch>0){
			$querys=$sql->row();
			 $ch_images=$querys->image;
			 $ch_title=$querys->catagory;
		}
		else{
			$ch_images='no images';
			$ch_title='No Images';
		}
		?>
		 <div id="first_category"><a href="index.php/home/gallery_details?catagory=<?php echo $value; ?>">
		    <img src="../school_admin/galleryImage/<?php echo $ch_images?>" title="<?php echo $ch_title?>" style="width:200px;height:180px"></img></a></br>
			<p style="text-align:center; font-weight:bold;"><?php echo $value?></p>
		 </div>
	           
				<?php	  }
		?>
		
	 </div>
	 
	 
	 
	
	 
  </div>
 
 </body>

</html>