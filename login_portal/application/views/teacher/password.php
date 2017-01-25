<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Teacher Class Routine
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

<script type="text/javascript">
    function matchPass(np,cp){
        if(np == cp){
            document.getElementById("message").innerHTML = 'password matched';
            document.getElementById("message").style.color = "green";
            document.getElementById("sbBtn").type = "submit";
            document.getElementById("sbBtn").setAttribute("onclick","fail()");
        }else{
            document.getElementById("message").innerHTML = 'password not match';
            document.getElementById("message").style.color = "red";
            document.getElementById("sbBtn").type = "button";
            document.getElementById("sbBtn").setAttribute("onclick","errorMsg()");
        }
    }

    function errorMsg(){
        alert("Password not matched !");
    }

</script>

<?php
    if(isset($_GET['error'])){
        $e = $_GET['error'];
    }
?>

<!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-11">

            <?php $this->load->view("teacher/success"); ?>
            <?php 
                if( $e ):
            ?>

            <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Old Password!</strong> is not matched .
            </div>
            
            <?php
                endif;
            ?>

                <div class="panel panel-default">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form action="teacher/newPassChng" method="post" role="form"  class="form-horizontal">
                                
                                <div class="form-group">
                                    <label for="newpass" class="col-sm-2">Old Password : </label>
                                    <div class="input-group col-sm-4">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        <input type="text" name="opass" id="oldpass" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="newpass" class="col-sm-2">New Password : </label>
                                    <div class="input-group col-sm-4">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        <input type="text" name="npass" id="newpass" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="conpass" class="col-sm-2">Confirm Password : </label>
                                    <div class="input-group col-sm-4">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                                        <input type="text" name="cpass" id="conpass" class="form-control" onkeyup = "matchPass(newpass.value,this.value)" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-4">
                                        <span id="message" class="col-sm-offset-4 col-sm-8" style="float:right;text-align: right;"></span>
                                    </div>    
                                </div>
                                

                                <div class="form-group">
                                    <div class="input-group col-sm-offset-2 col-sm-4">
                                        <button type="submit" id="sbBtn" class="btn btn-primary" name="changebtn" style="float:right;">
                                         <span class="glyphicon glyphicon-ok"></span> Change   
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>