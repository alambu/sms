<html>
<head>
	
	<style>
	
		#data_content{
			height:930px;
			width:760px;
			margin-top:10px;
			margin-left:12px;
			float:left;
			border:0px solid;
			border-radius:5px;
			background-color:#f1f1f1;
	      }
		  
		
		  
		   #content2{
			height:480px;
			width:720px;
			margin-left:10px;
			float:left;
			border:0px solid;
			background-color:#f9f9f9;
			border-radius:5px;
			padding-left:10px;
			padding-right:10px;
			margin-top:20px;
	      }
		  
	</style>
</head>

 <body>
  <div id="data_content">
 
     					 			<?php

$select=$this->db->select("*")
					->from("rules")
					->get()
					->row();

					?>	  
	  
	  <div id="content2">
	  <table align="center" height="30px" width="566px" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3" style="text-align:center; font-weight:bold; font-size:22px; text-decoration:underline;"><?php echo $select->title; ?></td>
			</tr>
	  </table>
	  <p> <?php echo $select->details; ?><!---- Distinguished Visitors, welcome! It is indeed my great pleasure to invite you to visit the Official Website of National Defence College (NDC), Bangladesh. Please take a virtual tour to the most prestigious institution of its kind in Bangladesh. NDC is the  prestigious institution of its kind in Bangladesh. NDC is the premiermost prestigious institution of its kind in Official WebsiteDistinguished Visitors, welcome! It is indeed my great pleasure to invite you to visit the Official Website of National Defence College (NDC), Bangladesh. Please take a virtual tour to the most prestigious institution of its kind in Bangladesh. NDC is the  prestigious institution of its kind in Bangladesh. NDC is the premiermost prestigious institution of its kind in Official Website
	  Distinguished Visitors, welcome! It is indeed my great pleasure to invite you to visit the Official Website of National Defence College (NDC), Bangladesh. Please take a virtual tour to the most prestigious institution of its kind in Bangladesh. NDC is the  prestigious institution of its kind in Bangladesh. NDC is the premiermost prestigious institution of its kind in Official WebsiteDistinguished Visitors, welcome! It is indeed my great pleasure to invite you to visit the Official Website of National Defence College (NDC), Bangladesh. Please take a virtual tour to the most prestigious institution of its kind in Bangladesh. NDC is the  prestigious institution of its kind in Bangladesh. NDC is the premiermost prestigious institution of its kind in Official WebsiteDistinguished Visitors, welcome! It is indeed my great pleasure to invite you to visit the Official Website of National Defence College (NDC), Bangladesh. Please take a virtual tour to the most prestigious institution of its kind in Bangladesh. --->
	  
	  </p>
	  </div>
	 
  
  </div>
 
 </body>

</html>