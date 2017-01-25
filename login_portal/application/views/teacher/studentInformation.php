<?php
    $tid=$this->session->userdata("lidcheck");  // employee id
    $y = date("Y");
?>

<script type="text/javascript">
    // to get section
    function markClsSec(str,sht){
        var d = sht+"+"+str+"+"+<?php echo $tid ?>+"+"+<?php echo $y ?>;
        $.ajax({
            type:"POST",
            url:"teacher/markClassSection",
            data:{search:d},
            success:function(data){
                if(data.length > 0){
                    var s = data.split(",");

                    // clear option data
                    document.getElementById("markSec").innerHTML = '';
                    document.getElementById("markSec").innerHTML = '<option value="">Select</option>';
                    for(var i = 0;i<s.length;i++){
                        document.getElementById("markSec").innerHTML += '<option value="'+s[i]+'">'+s[i]+'</option>';
                    }    
                }
            }
        });
    }

  </script>

<style type="text/css">
    table,tr,th,td{border:none !important;}
</style>

<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Student Information
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
<!-- Main content -->
    <section class="content">
    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-11">
                
<?php
    if(isset($_POST['search'])):
        extract($_POST);
    endif;
?>

<div class="col-md-11">
    <form class="form-inline" role="form" method="post" action="">
        <table class="table">
            <tr>
                <th style="line-height: 30px;">Search : </th>
                <td>
                <?php 
                    $shft = $this->db->get("shift_catg")->result();
                ?>
                    <select class="form-control" name="shift" id="shift" required>
                        <option value=""> Shift </option>
                        <?php foreach($shft as $st): ?>
                            <option value="<?php echo $st->shiftid ?>" <?php if(isset($_POST['search'])):if($shift == $st->shiftid):echo "selected";endif;endif; ?>><?php echo $st->shift_N ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                                
<?php
    $data = array(
                "teacherid" => $tid,
                "year"      => $y
            );

    $teacherClass = $this->db->select("*")->from("routine")->where($data)->group_by("classid")->get()->result();
?>

                <td>
                    <select class="form-control" id="class" name="class" onchange="markClsSec(this.value,shift.value)" required>
                        <option value=""> Class </option>
                    <?php 
                        foreach($teacherClass as $tc): 
                            $clsNm = $this->db->select("class_name")->from("class_catg")->where("classid",$tc->classid)->get()->row();
                    ?>
                        <option value="<?php echo $tc->classid ?>" <?php if(isset($_POST['search'])):if($class == $tc->classid):echo "selected";endif;endif; ?>><?php echo $clsNm->class_name ?></option>
                    <?php endforeach; ?>
                    </select>
                </td>
                
                <td>
                    <select name="section" id="markSec" class="form-control" required >
                        <option value=""> Section </option>
                        <?php if(isset($_POST['search'])): ?>
                            <option value="<?php echo $section; ?>" selected ><?php echo $section; ?></option>
                        <?php endif; ?>
                    </select>
                </td>
                
                <td>
                <input name="roll" class="form-control" type="text" onkeypress="is_Number(event)" placeholder="Roll" required  pattern="[0-9]{1,3}" title="Number value only.Max 3 digit." value="<?php if(isset($_POST['search'])):echo $roll;endif; ?>" />
                </td>
                
                <td>
                    <button type="submit" name="search" class="btn btn-primary">
                        <span class="glyphicon glyphicon-search"></span> Search
                    </button>
                </td>
            </tr>
        </table>
    </form>
</div>
<?php 
    if(isset($_POST['search'])):
        $y = date("Y");
        // data array
        $data = array(
                "shiftid" => $shift,
                "classid" => $class,
                "section" => $section,
                "roll_no" => $roll,
                "syear"   => $y,
            );
        // get student sid
        $stdid = $this->db->select("stu_id")->from("re_admission")->where($data)->limit(1)->get()->row();
        // get student information
        $stdInfo = $this->db->select("*")->from("regis_tbl")->where("stu_id",$stdid->stu_id)->limit(1)->get()->row();
        // shift name
        $shftNm = $this->db->select("shift_N")->from("shift_catg")->where("shiftid",$shift)->get()->row();
        // class
        $clsNm = $this->db->select("class_name")->from("class_catg")->where("classid",$class)->get()->row();
        // if any data found
        if(count($stdid)):
?>
<div class="col-md-11">
<span class="label label-primary" style="font-size: 18px;text-align: center;margin-left: 40%;">
    Student Information
</span>
<div class="col-md-offset-1 col-md-10" style="background:white;margin-top:20px;border:1px solid #d0d0d0;">
    <div class="col-md-12">
        <div class="col-md-8">
            <table style="margin-top:25px;">
                <tr>
                    <td>SID : </td>
                    <td><?php echo $stdInfo->stu_id ?></td>
                </tr>
                <tr>
                    <td>Name : </td>
                    <td><?php echo $stdInfo->name ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-4">
            <img src="../school_admin/img/student_section/registration_form/<?php echo $stdInfo->picture ?>" class="img-thumbnail" style="height:80px;width:90px;margin-top:5px;" />
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="well well-sm" style="margin-top:10px;">Academic Information</div>
        <table class="table">
            <tr>
                <th>Shift : </th>
                <td><?php echo $shftNm->shift_N ?></td>
                <th>Class : </th>
                <td><?php echo $clsNm->class_name ?></td>
            </tr>
            <tr>
                <th>Section : </th>
                <td><?php echo $section ?></td>
                <th>Roll : </th>
                <td><?php echo $roll ?></td>
            </tr>
        </table>
        <div class="well well-sm" style="margin-top:10px;">Personal Information</div>
        <table class="table">
            <tr>
                <th>Gender : </th>
                <td><?php echo $stdInfo->gender ?></td>
                <th>Religion : </th>
                <td><?php echo $stdInfo->religion ?></td>
            </tr>
            <tr>
                <th>Birthdate : </th>
                <td><?php echo $stdInfo->dob ?></td>
                <th>Blood Group : </th>
                <td><?php echo $stdInfo->blood_grou ?></td>
            </tr>
            <tr>
                <th>Father Name : </th>
                <td><?php echo $stdInfo->fName ?></td>
                <th>Father Mobile :</th>
                <td><?php echo $stdInfo->Phone_n ?></td>
            </tr>

            <tr>
                <th>Father Occupation : </th>
                <td><?php echo $stdInfo->foccupation ?></td>
                <th></th>
                <td></td>
            </tr>

            <tr>
                <th>Mother Name : </th>
                <td><?php echo $stdInfo->mName ?></td>
                <th>Mother Mobile :</th>
                <td><?php echo $stdInfo->personal_phone ?></td>
            </tr>

            <tr>
                <th>Mother Occupation : </th>
                <td><?php echo $stdInfo->moccupation ?></td>
                <th></th>
                <td></td>
            </tr>
        </table>
        <div class="well well-sm" style="margin-top:10px;">Address Information</div>
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">Present</th>
                    <th colspan="2">Parmanent</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><?php echo $stdInfo->pre_address ?></td>
                    <td colspan="2"><?php echo $stdInfo->par_address ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php endif;endif; ?>
            
            </div>
        </div>
    </section>
</aside>