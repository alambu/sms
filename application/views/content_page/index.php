<html>
	<head>
		<title>index page</title>
		<link rel="stylesheet" href="index.css" type="text/css"/>
		 
		
		
		<!---- ////Calender javascript code start here ////---->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jsDatePick Javascript example</title>

<link rel="stylesheet" type="text/css" media="all" href="clender_js/jsDatePick_ltr.min.css" />

<script type="text/javascript" src="clender_js/jquery.1.4.2.js"></script>
<script type="text/javascript" src="clender_js/jsDatePick.jquery.min.1.3.js"></script>

<script type="text/javascript">
	window.onload = function(){		
		var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
      '&signed_in=true&callback=initialize';
  document.body.appendChild(script);
		
		g_globalObject = new JsDatePick({
			useMode:1,
			isStripped:true,
			target:"div3_example"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		g_globalObject.setOnSelectedDelegate(function(){
			var obj = g_globalObject.getSelectedDay();
			alert("a date was just selected and the date is : " + obj.day + "/" + obj.month + "/" + obj.year);
			document.getElementById("div3_example_result").innerHTML = obj.day + "/" + obj.month + "/" + obj.year;
		});
		
		
		
		g_globalObject2 = new JsDatePick({
			useMode:1,
			isStripped:false,
			target:"div4_example",
			cellColorScheme:"beige"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
		
		g_globalObject2.setOnSelectedDelegate(function(){
			var obj = g_globalObject2.getSelectedDay();
			alert("a date was just selected and the date is : " + obj.day + "/" + obj.month + "/" + obj.year);
			document.getElementById("div3_example_result").innerHTML = obj.day + "/" + obj.month + "/" + obj.year;
		});	
		
		 var script = document.createElement('script');
  script.type = 'text/javascript';
  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp' +
      '&signed_in=true&callback=initialize';
  document.body.appendChild(script);
		
		 loadScript;
	};
</script>

<!----/////calender javascript code end here/////---> 

<script>
var newwindow;
 function security(url) {
 newwindow=window.open(url,'name','height=700,width=980,left=200,top=60,scrollbars=yes,resizeable=0,menubar=0,statusbar=0,toolbar=0');
 if (window.focus) {newwindow.focus()}
 }
 
 
 var newwindow;
 function login1(url) {
 newwindow=window.open(url,'name','height=700,width=600,left=300,top=600,scrollbars=yes,resizeable=0,menubar=0,statusbar=0,toolbar=0');
 if (window.focus) {newwindow.focus()}
 }
</script>

		
		  <meta charset="utf-8">
		   <title>SlidesJS Standard Code Example</title>
  <meta name="description" content="SlidesJS is a simple slideshow plugin for jQuery. Packed with a useful set of features to help novice and advanced developers alike create elegant and user-friendly slideshows.">
  <meta name="author" content="Nathan Searles">
  <!-- SlidesJS Required (if responsive): Sets the page width to the device width. -->
  <meta name="viewport" content="width=device-width">
  <!-- End SlidesJS Required -->

  <!-- CSS for slidesjs.com example -->
  <link rel="stylesheet" href="css/example.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- End CSS for slidesjs.com example -->

  <!-- SlidesJS Optional: If you'd like to use this design -->
  <style>
    body {
      -webkit-font-smoothing: antialiased;
      font: normal 15px/1.5 "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #232525;
      padding-top:00px;
    }
	

    #slides {
      display: none
    }

    #slides .slidesjs-navigation {
      margin-top:5px;
    }
	
	

    a.slidesjs-next,
    a.slidesjs-previous,
    a.slidesjs-play,
    a.slidesjs-stop {
     /* background-image: url(img/btns-next-prev.png);*/
      display:block;
      width:12px;
      height:18px;
      overflow: hidden;
      text-indent: -9999px;
      float: left;
      margin-right:5px;
    }
   
    a.slidesjs-next {
      background-position: -12px 0;
      margin-right:10px;
    }
  
    a:hover.slidesjs-next {
      background-position: -12px -18px;
    }

    a.slidesjs-previous {
      background-position: 0 0;
    }

    a:hover.slidesjs-previous {
      background-position: 0 -18px;
    }

    a.slidesjs-play {
      width:15px;
      background-position: -25px 0;
    }

    a:hover.slidesjs-play {
      background-position: -25px -18px;
    }

    a.slidesjs-stop {
      width:18px;
      background-position: -41px 0;
    }

    a:hover.slidesjs-stop {
      background-position: -41px -18px;
    }

    .slidesjs-pagination  {
      margin: 7px 0 0;
      float: right;
      list-style: none;
    }
	
	

    .slidesjs-pagination li {
      float: left;
      margin: 0 1px;
    }
	

    .slidesjs-pagination li a {
      display: block;
      width: 13px;
      height: 0;
      padding-top: 13px;
     /* background-image: url(img/pagination.png);*/
      background-position: 0 0;
      float: left;
      overflow: hidden;
    }

    .slidesjs-pagination li a.active,
    .slidesjs-pagination li a:hover.active {
      background-position: 0 -13px
    }

    .slidesjs-pagination li a:hover {
      background-position: 0 -26px
    }

    #slides a:link,
    #slides a:visited {
      color: #333
    }

    #slides a:hover,
    #slides a:active {
      color: #9e2020
    }

    .navbar {
      overflow: visible
    }
	
	
  </style>
  <!-- End SlidesJS Optional-->

  <!-- SlidesJS Required: These styles are required if you'd like a responsive slideshow -->
  <style>
    #slides {
      display: none
    }

    .container {
      margin: 0 auto
    }

    /* For tablets & smart phones */
    @media (max-width: 767px) {
      body {
        padding-left: 20px;
        padding-right: 20px;
      }
      .container {
        width: auto
      }
    }

    /* For smartphones */
    @media (max-width: 480px) {
      .container {
        width: auto
      }
    }

    /* For smaller displays like laptops */
    @media (min-width: 768px) and (max-width: 979px) {
      .container {
        width: 724px
      }
    }

    /* For larger displays */
    @media (min-width: 980px) {
      .container {
        width: 980px
      }
    }
  </style>
  <!-- SlidesJS Required: -->
	</head>
	
	<body>
		<div id="wrapper">
		
		<!----heading div start here------>
			<div id="heading">
			
				<div id="header">
					<div id="banner"><img src="image/bnr_bg.gif.gif"  height="130px" width="980px"/></div>
				</div>
				
		<!-----menu div start here---->		
				<nav id="menu-wrap">
		<ul id="menu">
			<li><a href="index.php?page=home">Home</a></li>
			<li><a href="#">Academic</a>
				<ul><li><a href="indexs.php?page=about">About</a></li>
					<li><a href="index.php?page=history">History</a></li>
					<li><a href="index1.php?page=teachers_info">Teachers Info</a></li>
					<li><a href="index1.php?page=students_info">Students Info</a></li>
					<li><a href="index1.php?page=stuff_info">Stuff Info</a></li>
					<li><a href="index.php?page=rules_regulation">Rules & Regulation</a></li>
					<li><a href="index.php?page=facility">Facility</a></li>
					<li><a href="index.php?page=infrastructure">Infrastructure</a></li>
					<li><a href="index.php?page=vacancy">Vacancy</a></li>
					<li><a href="index.php?page=academic_calender">Academic Calender</a></li>
					
				</ul>
			</li>
			
				
			<li><a href="#">Department</a>
				<ul> 
					<li><a href="index.php?page=science">Science</a> </li>
					<li> <a href="index.php?page=humanities">Humanities</a></li>
					<li><a href="index.php?page=business_studies">Business Studies</a> </li>
				</ul>
			</li>
			<li><a href="index.php?page=gallery">Gallery</a></li>
			<li><a href="#">Result</a>
				<ul>
					<li><a href="index.php?page=academic_exam_result">Academic Exam Result</a></li>
					<li><a href="index.php?page=admission_exam_result">Admission Exam Result</a></li>
				</ul>
			</li>
			<li><a href="#">Library</a>
				<ul>
					<li><a href="index.php?page=library_info">Library info</a></li>
					<li><a href="index.php?page=book_list">Book list</a></li>
					<li><a href="index.php?page=photo_gallery">Photo Gallery</a></li>
				</ul>
			</li>
			
			
			<li><a href="#">Admission</a>
				<ul>
					<li><a href="index.php?page=admission_info">Admission Information</a></li>
					<li>  <a href="index1.php?page=application_form"> Application Form</a> </li>
					<li><a href="index.php?page=contact_to_admission">Contact to admission</a></li>
				</ul>
			</li>	
			<li><a href="#"> Routine</a>
				<ul>
					<li><a href="index.php?page=class_routine">Class Routine</a></li>
					<li><a href="index.php?page=exam_routine">Exam Routine</a></li>
				</ul>
			</li>
			
			<li><a href="index.php?page=contact_us">Log in</a>
				<ul>
					<li><a onclick="login1('login.php'); ">Student's Login</a></li>
					<li><a href="index.php?page=exam_routine">Teacher's Login</a></li>
					<li><a href="index.php?page=exam_routine">Parent's Login</a></li>
				</ul>
			</li>
			
			<li><a href="index.php?page=contact_us">Sign Up</a>
				<ul>
					<li><a href="index.php?page=class_routine">Student's Sign up</a></li>
					<li><a href="index.php?page=exam_routine">Teacher's Sign up</a></li>
					<li><a href="index.php?page=exam_routine">Parent's Sign up</a></li>
				</ul>
			</li>
			<li><a href="index.php?page=notice">Notice</a></li>
			<li><a href="index.php?page=notice">Syllabus</a></li>
		</ul>
		</nav>
	<!------menu div close here ---->
				
				
			</div>
			
		<!----heading div close here---->	
			
			
			
		<!---- slidebar div start here ---->	
			<div id="slide_bar">
				
  <!-- SlidesJS Required: Start Slides -->
  <!-- The container is used to define the width of the slideshow -->
  <div class="container">
    <div id="slides">
     
	  
	  
	<!----  <img src="slide_image/bp35.gif" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
	  
      <img src="slide_image/bp29.gif" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
	  
      <img src="slide_image/bp17.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/"> --->
	  
	  <img src="slide_image/bp16.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	    
	  <img src="slide_image/bp36.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	 <!--- <img src="slide_image/bp32.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">--->
	  
	  <img src="slide_image/bp4.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	  <img src="slide_image/bp10.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	  <img src="slide_image/bp25.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	  <img src="slide_image/bp28.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	  <img src="slide_image/bp37.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	  <img src="slide_image/bp6.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	  
	   <img src="slide_image/bp8.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	   
	   
	   <img src="slide_image/bp2.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
	   
	   <img src="slide_image/bp27.gif" alt="Photo by: Stuart SeegerLink: http://www.flickr.com/photos/stuseeger/97577796/">
    </div>
  </div>
  <!-- End SlidesJS Required: Start Slides -->

  <!-- SlidesJS Required: Link to jQuery -->
  <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Link to jquery.slides.js -->
  <script src="js/jquery.slides.min.js"></script>
  <!-- End SlidesJS Required -->

  <!-- SlidesJS Required: Initialize SlidesJS with a jQuery doc ready -->
  <script>
    $(function() {
      $('#slides').slidesjs({
        width: 980,
        height: 380,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
    });
  </script>
  <!-- End SlidesJS Required -->
			
			</div>
			
			<!---- slidebar div close here --->
			
			<!---- headline div start here --->
			
			<div id="headline">
				<div id="head_news1">Headline :</div> 
				<div id="head_news2">
				<marquee behavior="scroll" direction="left" scrollamount="4">Create scrolling text with this HTML marquee code. Text scrolls left or right. Zooms in from left. Zooms in from right.</marquee></div> 
			
			</div>
			<!---- headline div close here --->
			
			
			<!---- content div start here ----->
			<div id="content">
			
			
				
				
				
				<!----mid bar start here--->
				<div id="midbar">
				
<?php
	if(isset($_GET['page'])){
		$page=$_GET['page'];
		$show=$page.".php";

  include $show;
 }
 else{
	 
	include('home.php'); 
 }
?>
				    
					
				</div>
				
				<!----midbar close here--->
				
				
				
				
				
				<!---rightbar start here--->
				<div id="rightbar">
				
				
				
				
					
					<!-----rightbar2 start here----->
					
					<div class="rightbar2">
						<div class="headline">NOTICE</div>
						<div class="dis_2">
						  
						   
							<ul style=" list-style-image: url('image/icon2.png');">
								<li><a href="index.php?page=admission_notice">Admission notice</a></li>
								<li><a href="index.php?page=exam_fee_notice">Exam fee notice</a></li>
								<li><a href="index.php?page=registration_notice">Registration Notic</a></li>
								<li> <a href="index.php?page=vacation_notice">Vacation Notice</a></li>
								<li><a href="index.php?page=school_rules_notice">School Rules Notice</a></li>
							</ul>
							
						</div>
					</div>
					
					<!-------rightbar2 close here----->
					
					
					<!----rightbar3 start here---->
					
					
					<div class="rightbar3">
						<div class="headline3">IMPORTANT LINK</div>
						<div class="dis_3">
						
							<ul style=" list-style-image: url('image/icon5.png');">
								<li><a href="http://www.dhakaeducationboard.gov.bd/" target="_blink;">Dhaka Board</a></li>
								<li><a href="http://www.nu.edu.bd/" target="_blink;">National University</a></li>
								<li><a href="http://www.educationboard.gov.bd/" target="_blink;">Ministry of Education</a></li>
								<li> <a href="http://www.dhakaeducationboard.gov.bd/" target="_blink;">Directorate of Secondary & Higher Education.</a></li>
								<li><a href="http://www.bteb.gov.bd/" target="_blink;">Technical Education Board</a></li>
								<li><a href="http://www.dpe.gov.bd/" target="_blink;">Directorate of Primary Education</a></li>
							</ul>
							<!---<img src="image/syl_bg.png" />-->
							
						</div>
					</div>
					
					<!----rightbar3 close here---->
					
					
					<!----rightbar5 start here---->
					
					 <div class="rightbar5">
						<div class="headline5">Complain</div>
						<div class="dis_5">
							<table height="200px" cellpadding="1" cellspacing="0" border="0" width="190px" align="center" style="margin-top:5px; ">
							   
							   <tr>
								   <td style="font-weight:bold;">Name</td>
								   <td>: <input type="text" name="name" style="width:105px; border-radius:5px; background-color:#f8f8f8; border:none;" /></td>
							   </tr>
							   
							   <tr>
								   <td style="font-weight:bold;">Subject</td>
								   <td>: <input type="text" name="subject" style="width:105px; border-radius:5px; background-color:#f8f8f8; border:none;" /></td>
							   </tr>
							   
							   <tr>
								   <td style="vertical-align:top;font-weight:bold; ">Message</td>
								   <td style="vertical-align:top">: <textarea cols="11" rows="5" style="border-radius:5px; background-color:#f8f8f8; border:none;"></textarea></td>
							   </tr>
							   
							   <tr>
								   <td colspan="2" style="text-align:center;"><input type="submit" name="Send" value="Send" style="border:none; border-radius:5px; background-color:darkgreen; color: white; font-weight:bold;" /> <input type="reset" name="cancel" value="Cancel" style="border:none; border-radius:5px; background-color:darkgreen; color: white; font-weight:bold;" /></td>
							   </tr>
							 
							</table>
							
							</div>
					</div> 
					
					<!------rightbar5 close here------>
					
					
					<!-----rightbar4 start here------>
					
					<div class="rightbar4">
						<div class="headline4">CALENDER</div>
						<div class="dis_4"><div id="div3_example" style="width:196px; height:200px; border:0px dashed blue;"></div></div>
					</div>
					
					<!-----rightbar4 close here---->
					<!---<div class="contact">
							<div class="contact_head">CONTACT</div>
							<div class="contact_text">
								<table cellspacing="0" cellpadding="0" border="0" height="110px" width="168px" style="margin-top:10px; margin-left:10px; margin-bottom:10px;">
								
								
								
								<tr>
									<td style="text-align:center;"><font style="color:gray; text-align:center; font-weight:bold; font-size:11px;">Mirpur Road, P.O.: New Market, Dhanmondi, Dhaka-1205</font></td>
									
								</tr>
								
								<tr style="text-align:center;">
									<td><font style="color:gray; text-align:center; font-weight:bold;
									font-size:11px;"> Email: info@dhakacollege.edu.bd <br> Web: www.dhakacollege.edu.bd</font></td>
									
								</tr>
								
							
							</table>
							</div>
						</div>-->
					
				</div>
				
				<!----rightbar close here--->
				
				
			</div>
			
			<!---- content div close here ---->
		
		</div>
		<!---- wrapper div close here ---->
		
		
		<!-----footer div start here----->
		
		<div id="footer">
		   <div id="footer1">
				<table cellspacing="0"  cellpadding="0" border="0" height="70px" width="680px" style="margin-top:5px; margin-left:120px; text-align:center;">
								
								<tr style="height:15px;">
									<td colspan="5" style="text-align:center;"></td>
								</tr>
								<tr style="padding-top:15px;">
									<td><a href="index.php?page=home"><font style="color:gray;">| &nbsp; Home &nbsp;  |</font></a></td>
									
									<td><a href="index.php?page=about"><font style="color:gray;"> |  &nbsp;  About &nbsp;  |</font></a></td>
									
									<td><a href="index.php?page=contact_us"><font style="color:gray;">|  &nbsp;  Contact &nbsp;   |</font></a></td>
									
									<td><a href="index.php?page=gallery"><font style="color:gray;">| &nbsp;  Gallery &nbsp;   |</font></a></td>
									
									<td><a href="index.php?page=notice"><font style="color:gray;">| &nbsp;  Notice &nbsp;   |</font></a></td>
									
								</tr>
								
								<tr height="15px">
									<td colspan="5" style="text-align:center;"></td>
								</tr>
								
								<tr>
									<td colspan="5" style="text-align:center;"></td>
								</tr>
								
								<tr>
									<td colspan="5" style="text-align:center;"><a href="#"><font style="color:gray; font-size:14px;">email: info@dhakacitycollge.com<br>phone:+65466466<br>Mobile:+8801755553269</font></a></td>
									
									
									
								</tr>
				</table>				
		   </div>
			<font style="text-align:center;">&copy; copyright 2015, All right reserved.</font>
		
		</div>
		
		
		<!------footer div close here----->
		
		
	</body>
</html>