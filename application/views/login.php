<?php
 //if(isset($_POST['login'])):
    $sk=$_GET['sk'];
    $type=$_GET['t'];

    if($type == 1):
      $msg="Student";
    elseif($type == 2):
      $msg = "Parent";
    elseif($type == 3):
      $msg = "Teahcer";
    endif;
?>
<link href="all/assets/css/style-responsive.css" rel="stylesheet">
<link rel="stylesheet" media="screen,projection" type="text/css" href="all/assets/css/reset.css" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="all/assets/css/login.css" />

  <style type="text/css">
      body {
  background: #eee !important;  
}

.wrapper {  
  margin-top: 25px;
  /*margin-bottom: 80px;*/

}

.notice{margin:10px;width:315px;padding:5px;font-size:11px;padding-left:35px;}

.form-signin {
  max-width: 450px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color: #fff;
    border:1px solid #ccc; 

  .form-signin-heading,
  .checkbox {
    margin-bottom: 30px;
  }

  .checkbox {
    font-weight: normal;
  }

  .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    @include box-sizing(border-box);

    &:focus {
      z-index: 2;
    }
  }

  input[type="text"] {
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
  }

  input[type="password"] {
    margin-bottom: 20px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
  }
}

  </style>
<div class="main_con"><!--Content Start-->
  <div class="row">
    <div class="col-md-9 left_con"><!-- left Content Start-->
      <div class="row">
        <div class="col-md-12"><!-- Welcome Massage Start-->
          <div class="panel panel-primary">
            <div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"><?php echo $msg ?> Login </div>
              <div class="panel-body" style="min-height:750px;">
                <div class="wrapper">
  
                <form class="form-signin" action="index.php/login/login_action" method="POST">       
                 <h2 class="form-signin-heading"><?php echo ($msg) ?> Login</h2>

              <?php if ($sk=="empty") {?>
            <div class="col-lg-12 warn">Invalid username or password</div>
                
                <?php } else if($sk=='invalid') { ?>
            <div class="col-lg-12 error">Enter a valid username &amp; password</div>

            <?php } else if($sk=='username') { ?>
            <div class="col-lg-12 error">Username is empty</div>

            <?php } else if($sk=='pass') { ?>
            <div class="col-lg-12 error">Password is empty</div>
                
                <?php } else if($sk=='out') { ?>
            <div class="col-lg-12 done">You have successfully loged out</div>
                
                <?php } else {?>
            <div class="col-lg-12 info" style="margin-left:0px;">Please enter username &amp; password</div>
                
                <?php } ?>
                <input type="hidden" name="type" id="type" value="<?php echo $type?>" />
                
                <input type="text" class="form-control" name="username" style="margin-bottom:5px;" placeholder="Username"  autofocus="" />
                <input type="password" class="form-control" name="password" style="margin-bottom:5px;" placeholder="Password"/>      
                
                <button class="btn btn-lg btn-primary btn-block" type="submit" style="margin-top:30px;" name="login" value="Login">Login</button>   
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>