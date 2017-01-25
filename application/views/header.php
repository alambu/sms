<!---this is header content Start-->
<!DOCTYPE html>
<!--Head Start-->
<html lang="en">

<head>
	<base href="<?php echo base_url();?>"></base>
	<title><?php echo $title;?></title>
	<meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" rel="stylesheet" href="all/assets/css/leapis_font.css">
	<link href="all/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="all/assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="all/assets/css/font-awesome.min.css">
<!-- all script file -->
	<script src="all/assets/js/bootstrap.js"></script>
	<script src="all/assets/js/jquery-1.10.2.js"></script>
	<script src="all/assets/js/bootstrap-hover-dropdown.js"></script>
	<script src="all/assets/js/bootstrap.min.js"></script>
	<script src="all/assets/js/jquery.min.js"></script>
<!-- end all script -->
<!-- data table -->
	<script src="all/assets/js/datatable.min.js"></script>
	<link rel="stylesheet" href="all/assets/css/datatable.min.css">

<style>
body{color:font-family: "Times New Roman", Times, serif !important;
		color:black !important;}
    .pwebfblikebox.slidebox, .pwebfblikebox.sidebar, .pwebfblikebox.tab {
        position: fixed;
        top: 150px;
        z-index: 100;
    }
    .pwebfblikebox.sidebar {
        top: 0;
    }
    .pwebfblikebox.slidebox, .pwebfblikebox.sidebar {
        background-color: #3B5998;
        background-color: rgba(59, 89, 152, 0.5);
        padding: 10px;
        border: 0 solid #133783;
    }
    .pwebfblikebox.pwebfblikebox-shadow.slidebox, .pwebfblikebox.pwebfblikebox-shadow.sidebar {
        -moz-box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        -webkit-box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
    }


    .pwebfblikebox.slidebox.pwebfblikebox-left, .pwebfblikebox.sidebar.pwebfblikebox-left {
        left: -999px;
        padding-left: 40px;
    }
    .pwebfblikebox.tab.pwebfblikebox-left {
        left: 0;
    }
    .pwebfblikebox.slidebox.pwebfblikebox-right, .pwebfblikebox.sidebar.pwebfblikebox-right {
        right: -999px;
        padding-right: 40px;
    }
    .pwebfblikebox.tab.pwebfblikebox-right {
        right: 0;
    }
    .pwebfblikebox.slidebox.pwebfblikebox-left {
        border-width: 1px;
        border-left: 0;
    }
    .pwebfblikebox.slidebox.pwebfblikebox-right {
        border-width: 1px;
        border-right: 0;
    }
    .pwebfblikebox.slidebox.pwebfblikebox-radius.pwebfblikebox-left {
        -webkit-border-radius: 0 0 10px 0;
        -moz-border-radius: 0 0 10px 0;
        border-radius: 0 0 10px 0;
    }
    .pwebfblikebox.slidebox.pwebfblikebox-radius.pwebfblikebox-right {
        -webkit-border-radius: 0 0 0 10px;
        -moz-border-radius: 0 0 0 10px;
        border-radius: 0 0 0 10px;
    }
    .pwebfblikebox.sidebar.pwebfblikebox-left {
        border-right-width: 1px;
    }
    .pwebfblikebox.sidebar.pwebfblikebox-right {
        border-left-width: 1px;
    }


    .pwebfblikebox_tab {
        position: absolute;
        width: 40px;
        height: 120px;
        background: #133783 center center no-repeat;
        cursor: pointer;
    }
    .pwebfblikebox.slidebox .pwebfblikebox_tab {
        top: -1px;
    }
    .pwebfblikebox.sidebar .pwebfblikebox_tab {
        top: 150px;
    }
    .pwebfblikebox.tab a.pwebfblikebox_tab {
        top: 0;
        display: block;
        text-decoration: none;
    }


    .pwebfblikebox.pwebfblikebox-left .pwebfblikebox_tab {
        right: -40px;
    }
    .pwebfblikebox.pwebfblikebox-right .pwebfblikebox_tab {
        left: -40px;
    }
    .pwebfblikebox.pwebfblikebox-radius.pwebfblikebox-left .pwebfblikebox_tab {
        -webkit-border-radius: 0 10px 10px 0;
        -moz-border-radius: 0 10px 10px 0;
        border-radius: 0 10px 10px 0;
    }
    .pwebfblikebox.pwebfblikebox-radius.pwebfblikebox-right .pwebfblikebox_tab {
        -webkit-border-radius: 10px 0 0 10px;
        -moz-border-radius: 10px 0 0 10px;
        border-radius: 10px 0 0 10px;
    }
    .pwebfblikebox.pwebfblikebox-shadow.pwebfblikebox-left .pwebfblikebox_tab {
        -moz-box-shadow: 2px 0 2px rgba(0, 0, 0, 0.5);
        -webkit-box-shadow: 2px 0 2px rgba(0, 0, 0, 0.5);
        box-shadow: 2px 0 2px rgba(0, 0, 0, 0.5);
    }
    .pwebfblikebox.pwebfblikebox-shadow.pwebfblikebox-right .pwebfblikebox_tab {
        -moz-box-shadow: -2px 0 2px rgba(0, 0, 0, 0.5);
        -webkit-box-shadow: -2px 0 2px rgba(0, 0, 0, 0.5);
        box-shadow: -2px 0 2px rgba(0, 0, 0, 0.5);
    }


    .pwebfblikebox.slidebox .pwebfblikebox_pretext, .pwebfblikebox.sidebar .pwebfblikebox_pretext {
        color: #333;
        background-color: #fff;
        padding: 5px;
        margin: 0 0 10px;
    }
    .pwebfblikebox.slidebox .pwebfblikebox_container, .pwebfblikebox.sidebar .pwebfblikebox_container {
        min-height: 62px;
        background-color: #fff;
    }
	*{
		margin:0px;
		padding:0px;
	}
	input[type="text"],input[type="email"],input[type="password"],select,textarea{
		font-family: "Times New Roman", Times, serif !important;
		color:black !important;
	}
</style>

<?php
	// get school information
	$spro=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();
?>

<body>
<div class="main">
	<!-- Main Start-->
		<!-- Header Start-->
<div class="header">
			<div class="row" style="min-height:140px;background:#04477E;width:100%;margin:0px auto;">
			   
					<div class="col-md-12">
						<div class="col-md-3">
							<img src="admin/img/document/school_logo/<?php echo $spro->logo ?>" class="img-responsive" style="width:100%;height:180px;margin-top:10px;" />
						</div>
						<div class="col-md-9">
							<h2 style="color:white;margin-top:35px;font-size:50px;"><?php echo $spro->schoolN ?></h2><b style="color:white;"></b>
						</div>
					</div>
					
				
			</div>
		<!-- Header End-->
		<script type="text/javascript">

		</script>
		<div class="menu" > <!-- Menu Start-->
			<div class="navbar navbar-default navbar-static-top" role="navigation">
				<div class="container" style="background-color:#003A6A;width:100%;">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					
					<div class="navbar-collapse collapse" id="menubar">
						<ul class="nav navbar-nav nav" >
							<li><a href="index.php/home/index"><i class="fa fa-home fa-lg" style="font-size:15px;"> Home </i> &nbsp; </a></li>
							

							<!--<li class="dropdown">
								<a href="index.php/home/index" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Home<b class="caret"></b></a>
							
							</li>-->
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Academic
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<li><a href="index.php/home/about">About</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/history">History</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/students_info">Students Info</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/teachers_info">Teachers Info</a></li>
									
									<li class="divider"></li>
									<li><a href="index.php/home/stuff_info">Stuff Info</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/academicCal">Academic Calender</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/rules_regulation">Rules & Regulation</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/infrastructure">Infrastructure</a></li>
									<li class="divider"></li>
									
									<li><a href="index.php/home/vacancy">Vacancy</a></li>
									<li class="divider"></li>
									
								</ul>
							</li>
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Department
									<b class="caret"></b>
								</a>
								<ul class="dropdown-menu">
									<?php $query=$this->db->query("SELECT * from department")->result();
										foreach($query as $dept){ ?>
					  
										<li><a href="index.php/home/science?id=<?php echo $dept->id; ?>"><?php echo $dept->department_name; ?></a> </li>
										<li class="divider"></li>
									<?php  
									}
									?>
								</ul>
							</li>
							
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Result<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php/home/indStdRslt">Academic Exam Result</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/admission_exam_result">Admission Exam Result</a></li>
								</ul>
							</li>
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Admission<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php/home/admission_info">Admission Information</a></li>
									<li class="divider"></li>
					                <li><a href="index.php/home/application_form">Application Form</a> </li>
					                <li class="divider"></li>
					                <li><a href="index.php/home/re_application_form">Re-Print Application Form</a> </li>
									<li class="divider"></li>
					                <li><a href="index.php/home/contact_to_admission">Contact to admission</a></li>
									
								</ul>
							</li>
							
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Routine<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php/home/class_routine">Class Routine</a></li>
									<li class="divider"></li>
									<li><a href="index.php/home/exam_routine">Exam Routine</a></li>
									
								</ul>
							</li>
							
							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Library<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php/home/library_info">Library info</a></li>
									<li class="divider"></li>
					                <li><a href="index.php/home/book_list">Book list</a></li>
									<li class="divider"></li>
					                
								</ul>
							</li>
							
							
							<li><a href="index.php/home/photo_gallery">Photo Gallery</a></li>
							<li><a href="index.php/home/notice">Notice</a></li>
							<li><a href="index.php/home/syllabus">Syllabus</a></li>

							<li class="dropdown ">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="100" data-close-others="false">Login<b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="login_portal?t=1&error=''" target="_blank">Student Login</a></li>
									<li class="divider"></li>
									<li><a href="login_portal?t=2&error=''" target="_blank">Parents Login</a></li>
									<li class="divider"></li>
					                <li><a href="login_portal?t=3&error=''" target="_blank">Teacher Login</a></li>
									<li class="divider"></li>
								</ul>
							</li>
							
						</ul>
					</div>
				</div>
			</div>
			

		</div>
		
	
<script type="text/javascript">
	function isNumber(evt){
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

	<!--this is header content End -->	
	