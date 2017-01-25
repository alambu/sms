<html>
<head>
<style>
		/*midbar1 start here */
#midbar{
height:945px;
width:79.7%;
border:0px solid;
float:left;
background-color:#f1f1f1;
}




/*midbar1 start here */
.mid_content1{
height:250px;
width:762px;
border:0px solid;
background-color:#f9f9f9;
float:left;
margin-top:10px;
margin-left:10px;
border-radius:5px;

} 

.mid_content1_head{
height:25px;
width:762px;
border:0px solid;
background-color:#5E035C;
float:left;
border-radius:5px 5px 0px 0px;
color:white;
text-align:center;
font-weight:bold;
font-size:16px;
} 


.mid_content1_pic_text{
height:205px;
width:746px;
border:0px solid;
float:left;
margin-top:10px;
margin-left:8px;
border-radius:5px;
border-radius:0px 0px 5px 5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} 

.mid_content1_pic{
height:130px;
width:170px;
border:0px solid;
float:left;
margin-right:5px;
border-radius:5px;

} 

/*
.mid_content1_text{
height:130px;
width:566px;
border:0px solid;
float:left;
border-radius:5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} */

/*.mid_content1_text1{
height:75px;
width:746px;
border:0px solid;
float:left;
margin-top:5px;
margin-left:5px;
border-radius:5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} */

/* mibar1 close here */

 
/* midbar2 start here */ 
.mid_content2{
height:250px;
width:762px;
border:0px solid;
background-color:#f9f9f9;
float:left;
margin-top:10px;
margin-left:10px;
border-radius:5px;
} 

.mid_content2_head{
height:25px;
width:762px;
border:0px solid;
background-color:#5E035C;
float:left;
border-radius:5px 5px 0px 0px;
color:white;
text-align:center;
font-weight:bold;
font-size:16px
} 


.mid_content2_pic_text{
height:205px;
width:746px;
border:0px solid;
float:left;
margin-top:10px;
margin-left:8px;
border-radius:5px;
border-radius:0px 0px 5px 5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} 

.mid_content2_pic{
height:130px;
width:112px;
border:0px solid;
float:left;
margin-right:5px;
border-radius:5px;
} 

/*.mid_content2_text{
height:130px;
width:624px;
border:px solid;
float:left;
border-radius:5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} */

/*.mid_content2_text1{
height:70px;
width:746px;
border:0px solid;
float:left;
margin-top:5px;
margin-left:5px;
border-radius:5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} */

/* midbar2 close here */

/*midbar3 start here */

.mid_content3{
height:250px;
width:762px;
border:0px solid;
background-color:#f9f9f9;
float:left;
margin-top:10px;
margin-left:10px;
border-radius:5px;
} 

.mid_content3_head{
height:25px;
width:762px;
border:0px solid;
background-color:#5E035C;
float:left;
border-radius:5px 5px 0px 0px;
color:white;
text-align:center;
font-weight:bold;
font-size:16px
} 


.mid_content3_pic_text{
height:205px;
width:746px;
border:0px solid;
float:left;
margin-top:10px;
margin-left:8px;
border-radius:5px;
border-radius:0px 0px 5px 5px;
font-family:Arial;
word-spacing:1;
font-size:18px;
} 

.mid_content3_pic{
height:130px;
width:112px;
border:0px solid;
float:left;
margin-right:5px;
border-radius:5px;
} 


		 
		  
		  
</style>
</head>

 <body>
 
  <div id="home">
    

     <div class="mid_content1">
	 
	 <?php

$select=$this->db->select("*")
					->from("welcome_message")
					->get()
					->row();

					?>	  
						<div class="mid_content1_head"><?php echo strtoupper("$select->title"); ?></div>
					    <div class="mid_content1_pic_text">
							<div class="mid_content1_pic"><img src="../school_admin/welcomeImage/<?php echo $select->image; ?>" style="height:130px; width:170px;"/></div>
							<p><?php echo $select->details; ?> </p>  </div>
					</div>
				
				
					<div class="mid_content2">
					 <?php

$se=$this->db->select("*")
					->from("principal_message")
					->get()
					->row();

					?>
					
						<div class="mid_content2_head"><?php echo strtoupper("$se->title"); ?></div>
						<div class="mid_content2_pic_text">
							<div class="mid_content2_pic"><img src="../school_admin/principalImage/<?php echo $se->image; ?>" style="height:130px; width:112px;"/></div>
							<p><?php echo $se->details; ?> </p>

						</div>
						
						
					</div>
					
					<div class="mid_content3">
					<?php

$sel=$this->db->select("*")
					->from("vice_principal_message")
					->get()
					->row();

					?>
					<div class="mid_content3_head"><?php echo strtoupper("$sel->title"); ?></div>
						<div class="mid_content3_pic_text">
							<div class="mid_content3_pic"><img src="../school_admin/vice_principalImage/<?php echo $sel->image; ?>" style="height:130px; width:112px"/></div>
							<p><?php echo $sel->details; ?></p>
							</div>
						
						</div>
						
					
					
					 <!--- location contact start here --->
					<div class="location_contact">
						<div class="location">
							<div class="location_head">LOCATION MAP</div>
							<div class="location_text"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.202561335086!2d90.431668!3d23.811395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c6355e7513d3%3A0x32f944b446c7da56!2sInternational+School+Dhaka!5e0!3m2!1sen!2sbd!4v1430563214799" width="762" height="150" frameborder="0" style="border:0"></iframe></div>
						</div>
						<!------
						---->
					</div>
					
					<!---- location contact close here ---->
     
  </div>
 
 </body>

</html>