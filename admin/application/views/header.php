<!DOCTYPE html>
<html>
	    <head>
		<base href="<?php echo base_url();?>"></base>
	<script type="text/javascript" language="javascript" src="js/update_jquery.min.js"></script>
	<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
	<script type="text/javascript" language="javascript" src="js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/ajax_req.js"></script>
	<script type="text/javascript" language="javascript" src="js/callfunction.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.ptTimeSelect.js"></script>
	<script type="text/javascript" language="javascript" src="js/multipleSelectValue.js"></script>
	  <script type="text/javascript" language="javascript" src="tinymce/js/tinymce/tinymce.min.js"></script>
	  
      <meta charset="UTF-8">
	  <link rel="shortcut icon" type="image/ico" href="">
        <title>School Admin</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
        <link href="css/custom_style.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.ptTimeSelect.css" rel="stylesheet" type="text/css" />
        <link href="css/time-jquery-ui.css" rel="stylesheet" type="text/css" />
       
		
		 <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
	<style>
		input[type="checkbox"] {
			opacity:1 !important;
		}
		

		.modal {
		  text-align: center;
		  padding: 0!important;
		}

		.modal:before {
		  content: '';
		  display: inline-block;
		  height: 100%;
		  vertical-align: middle;
		  margin-right: -4px; /* Adjusts for spacing */
		}

		.modal-dialog {
		  display: inline-block;
		  text-align: left;
		  vertical-align: middle;
		}
		.modal-backdrop.in {
			opacity:0.2;
		}
	
	</style>	
</head>
	
    <body class="skin-blue" id="maincontentdiv">
        <!-- header logo: style can be found in header.less -->
		
		
		
        <header class="header"> <!----header div start here----->
            <a href="javascript:void(0);" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Your School
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="javascript:void(0);" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                   
                        <li class="dropdown user user-menu">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $this->session->userdata('userN'); ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/default/default1.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $this->session->userdata('userN');?>
                                        
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index.php/userpanel/change_password" class="btn btn-default btn-flat">Change Password</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="index.php/logout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>  <!-----header div close here---->