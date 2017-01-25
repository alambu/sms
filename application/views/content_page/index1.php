
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
		<div id="wrapper1">
		
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
				<ul><li><a href="index1.php?page=about">About</a></li>
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
					<li> <a href="index1.php?page=application_form"> Application Form</a> </li>
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
		</ul>
		</nav>
	<!------menu div close here ---->
				
				
			</div>
			
		<!----heading div close here---->	
			
			
	      <div id="content1">
								
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
			
			<!---- content div close here ---->
		
		</div>
		<!---- wrapper1 div close here ---->
		
		
		<!-----footer div start here----->
		
		<div id="footers">
		   <div id="footer1s">
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
								<tr>
									<td colspan="5" style="text-align:center;"><font style="text-align:center; font-size:13px;">&copy; copyright 2015, All right reserved.</font></td>
								</tr>
				</table>				
		   </div>
			
		
		</div>
		
		
		<!------footer div close here----->
		
		
	</body>
</html>