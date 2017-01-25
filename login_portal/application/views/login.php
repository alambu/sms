<?php
    $sp=$this->db->select("*")->from("sprofile")->order_by("id","desc")->limit(1)->get()->row();
   $type=$_GET['t'];
?>


<html>
<head id="Head1"><title>

  Sign in
</title>
<base href="<?php echo base_url()?>"/>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link type="text/css" rel="stylesheet" href="css/leapis_font.css">
<link href="css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
<link href="css/login/login_body.css" rel="stylesheet" type="text/css"/></head>
<script src="../js/bootstrap.min.js" type="text/javascript"></script>
<body>
    <form name="form1" method="post" action="login/login_action" id="form1">


<div>
</div>
        <div id="wrapper">
            <div id="header">
                <table cellpadding="0" cellspacing="0" width="100%">
                    <tr style="height:80px;">
                        <td align="center">
                            <span id="Label4" style="font-size:36pt;font-weight:normal;font-family: Arial, Helvetica, sans-serif;font-style:italic;"><?php echo $sp->schoolN ?></span>
                        </td>
                        
                    </tr>
                </table>
            </div>
            <div> <?php $type_array=array('1'=>'Student','2'=>'Parents','3'=>'Teacher'); ?>
                <table style="width: 100%; height: 380px;">
                    <tr style="height: 20px;">
                        <td align="right" valign="middle" style="width: 100%;">
                            Welcome to <?php echo $type_array[$type]; ?> Management System </td>
                    </tr>
                    <tr style="height: 360px;">
                        <td valign="middle">
                            <table width="100%">
                                <tr>
                                    <td style="width: 49%;padding-left:85px;" valign="middle" align="center">
                                        <img src="../admin/img/document/school_logo/<?php echo $sp->logo ?>" width="100px" height="100px" /></td>
                                    <td style="width:2%;" valign="middle">
                                        <table style="background-color: Gray;height:180px; width:1px;" cellpadding="0" cellspacing="0">
                                            <tr style="width:1px;">
                                                <td>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width: 49%;" valign="middle">
                                        <table width="100%">
                                            <tr style="height: 20px;">
                                                <td colspan="3">
                                                    <span id="Label3" class="PageHeading">Sign in</span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 29%;">
                                                    <span id="Label1" class="v11nb"><?php echo $type_array[$type]; ?> ID</span></td>
                                                <td style="width: 2%;">
                                                    :</td>
                                                <td style="width: 69%;">
                                                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                                                    <input name="username" type="text" id="username" class="v13nb" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 29%; height: 18px;">
                                                </td>
                                                <td style="width: 2%; height: 18px;">
                                                </td>
                                                <td style="width: 69%; height: 18px;">
                                                    <span id="UserNameRequired" title="User name is required." class="error" style="color:Red;visibility:hidden;"><img src="Images/icon_err.gif" width="16" height="16" align="top"> Please type your user name</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 29%;">
                                                    <span id="Label2" class="v11nb">Password</span></td>
                                                <td style="width: 2%;">
                                                    :</td>
                                                <td style="width: 69%;">
                                                    <input name="password" type="password" maxlength="15" id="password" class="v13nb" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 29%;">
                                                </td>
                                                <td style="width: 2%;">
                                                </td>
                                                <td style="width: 69%;">
                                                    <span id="RequiredFieldValidator1" title="Password is required." class="error" style="color:Red;visibility:hidden;"><img src="Images/icon_err.gif" width="16" height="16" align="top"> Please type your password</span>
                                                </td>
                                            </tr>
                                            <tr style="height: 4px;">
                                                <td colspan="3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 29%;">
                                                </td>
                                                <td style="width: 2%;">
                                                </td>
                                                <td style="width: 69%;">
                                                    <input type="submit" name="login" value="Sign in" class="button" style="color:White;background-color:#0C2D5D;border-style:None;height:30px;width:100px;" /></td>
                                            </tr>
                                            <tr style="height:30px;">
                                                <td colspan="3" align="left" valign="middle">
                                                    </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                </table>
            </div>
            <div id="footer">
                Copyright &copy; <?php echo date("Y") ?> <?php echo $sp->schoolN ?>. All Rights Reserved</div>
        </div>


</form>
</body>
</html>