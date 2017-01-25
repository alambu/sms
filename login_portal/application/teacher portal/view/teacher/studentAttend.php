<?php
    // first get teacher id
    $tid = $this->session->userdata("lidcheck");

    // shift
    $shift = $this->uri->segment(3);
    $sNm = $this->db->select("*")->from("shift_catg")->where("shiftid",$shift)->get()->row();
    // initialize
    $d=date("Y");
    $dt=date("Y-m-d");
    // get class teacher
    $gdTchr=array(
        "empid"   => $tid,
        "shiftid" => $shift,
        "years"   => $d
        );
    $classTeacher = $this->db->select("*")->from("class_tehsett")->where($gdTchr)->get()->row(); 
    // get class name
    $className = $this->db->select("class_name")->from("class_catg")->where("classid",$classTeacher->classid)->get()->row();
    // get attendance exitance
    $attend=array(
        "shiftid" => $shift,
        "classid" => $classTeacher->classid,
        "section" => $classTeacher->section,
        "date"    => $dt
        );

    $atd = $this->db->select("*")->from("attendance")->where($attend)->get();
    $att = $atd->num_rows();

    if($att > 0):
        // if attendance already taken
        $atdok = $atd->row();
        $attArray = explode(",",$atdok->stu_id);
        // attendance taken end
    endif;
    
?>

<!-- style -->
<style type="text/css">
    table tr th{text-align: center !important;}
    table tr td{text-align: center !important;}
</style>
<!-- style -->

<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Student Attendance
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

            <!-- success message  -->
            <?php $this->load->view('teacher/success'); ?>
            <!-- success message end -->

                <?php if($att>0): ?>
                    <div class="alert alert-info" role="alert">
                        <b>You already complete today's attendance.Now you can update this.</b>
                    </div>
                <?php endif; ?>

                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;">
                        <?php echo ucfirst(strtolower($sNm->shift_N)) ?> Shift<br/>
                        Class : <?php echo $className->class_name ?> | Section : <?php echo $classTeacher->section ?><br/>
                        Date : <?php echo date("d-m-Y") ?>
                    </div>
                    <div class="panel-body">
                        <?php 
                                $std = array(
                                        "shiftid" => $shift,
                                        "classid" => $classTeacher->classid,
                                        "section" => $classTeacher->section,
                                        "syear"   => $d
                                        );
                                $stdInfo = $this->db->select("*")->from("re_admission")->where($std)->get()->result();
                        ?>

                        <form action="teacher/attendanceSubmit" name="frm" class="form" role="form" method="post">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Roll</th>
                                            <th>Name</th>
                                            <th>Attendance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- hidden value -->
                                        <tr style="display:none;">
                                            <td>
                                                <input type="hidden" name="shift" id="shift" value="<?php echo $shift ?>" />

                                                <input type="hidden" name="class" id="class" value="<?php echo $classTeacher->classid ?>" />

                                                <input type="hidden" name="section" id="section" value="<?php echo $classTeacher->section ?>" />
                                                <input type="hidden" name="attRow" id="attRow" value="<?php if($att > 0):echo $atdok->id;endif; ?>" />

                                            </td>
                                        </tr>
                                        <!-- hidden value -->
                                    <?php 
                                        foreach($stdInfo as $sInfo): 
                                            $sName=$this->db->select("name")->from("regis_tbl")->where("stu_id",$sInfo->stu_id)->get()->row();
                                    ?>
                                        <tr>
                                            <td><?php echo $sInfo->stu_id ?></td>
                                            <td><?php echo $sInfo->roll_no ?></td>
                                            <td><?php echo $sName->name ?></td>
                                            <td>
                                            <?php if($att <= 0): ?>
                                                <input type="checkbox" name="attend[]" value="<?php echo $sInfo->stu_id.'+'.$sInfo->roll_no ?>" class="form-controler" checked />
                                            <?php else: ?>
                                                <input type="checkbox" name="attend[]" value="<?php echo $sInfo->stu_id.'+'.$sInfo->roll_no ?>" class="form-controler" <?php if(in_array($sInfo->stu_id, $attArray)):echo "checked";endif; ?> />
                                            <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <?php if($att <= 0): ?>
                                                    <button class="btn btn-primary" style="width:150px;" name="submit">
                                                    <span class="glyphicon glyphicon-search"></span> Submit</button>
                                                <?php else: ?>
                                                    <button class="btn btn-primary" style="width:150px;" name="update">
                                                    <span class="glyphicon glyphicon-search"></span> update</button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>

                        <?php //endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>