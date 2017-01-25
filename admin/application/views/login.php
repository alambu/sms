<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
		<base href="<?php echo base_url(); ?>"></base>
        <title> Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		 <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>  

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <form action="<?php echo base_url(); ?>" method="post">
                <div class="body bg-gray">
					<?php 
						if(isset($_GET['id'])){
							$id=$_GET['id'];
							if($id=='1'){
								?>
							<button type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-warning-sign"></span> Empty Username & Password</button>
							
							<?php 
							}
							else if($id=='2'){
								?>
								
							<button type="button" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-warning-sign"></span> Empty Username or Password</button>
							
							<?php 
							}
							
							else if($id=='3'){
								?>
								<button type="button" class="btn btn-success btn-block"><span class="glyphicon glyphicon-ok"></span>  You have Successfully logout</button>
							
							<?php 
							}
							else if($id=='4'){
								?>
								
								<button type="button" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-remove"></span> Invalid Username & Password</button>
								
							<?php 	
							}
						}
					?>					
                    <div class="form-group">
                        <div class="input-group input-group-md">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" name="userid" class="form-control" placeholder="User Name"/>
						</div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-md">
						<span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
					</div>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" name="submit" class="btn bg-olive btn-block">Sign In</button>  
                    
                </div>
            </form>

           
        </div>


            

    </body>
</html>
