<style type="text/css">
    table td {
    border-top: none !important;
}
table tr th{
    text-align: center;
}
table tr td{
    text-align: right;
}

form table select{float:left;min-width: 180px;}

form table button{float: left;}
</style>

<?php
    $shfid = $this->uri->segment(3);
    $tid = $this->session->userdata('lidcheck');
    $y = date("Y");
?>

<script type="text/javascript">
    // to get section
    function markClsSec(str){
        var d = <?php echo $shfid ?>+"+"+str+"+"+<?php echo $tid ?>+"+"+<?php echo $y ?>;
        $.ajax({
            type:"POST",
            url:"teacher/markClassSection",
            data:{search:d},
            success:function(data){
                var s = data.split(",");

                // clear option data
                document.getElementById("markSec").innerHTML = '';
                document.getElementById("markSec").innerHTML = '<option value="">Select</option>';
                for(var i = 0;i<s.length;i++){
                    document.getElementById("markSec").innerHTML += '<option value="'+s[i]+'">'+s[i]+'</option>';
                }
            }
        });
    }

    // get subject name
    function getSubject(st){
        var clas = document.getElementById("cls").value;
        var gs = <?php echo $shfid ?>+"+"+clas+"+"+st+"+"+<?php echo $tid ?>+"+"+<?php echo $y ?>;
        $.ajax({
            type:"POST",
            url:"teacher/getTeacherSubject",
            data:{dd:gs},
            success:function(dA){
                var expSb = dA.split("+");

                var subjid = expSb[0];
                var subnm = expSb[1];

                var sbid = subjid.split(",");
                var sbname = subnm.split(",");

                document.getElementById("sub").innerHTML = '';
                document.getElementById("sub").innerHTML = '<option value="">Select</option>';

                for(var j = 0;j < sbid.length;j++){
                    document.getElementById("sub").innerHTML += '<option value="'+sbid[j]+'">'+sbname[j]+'</option>';
                }
            }
        });
    }
</script>

<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Student Mark Entry
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
                <div class="panel panel-default" style="margin-top:20px;">

            <!-- <div class="panel-heading"><p id="title">Examination Name Entry</p></div> -->
                    <div class="panel-body">
                        <form action="teacher/stdListMark" method="post" class="form-inline">
                            <table class="table">
                               <?php
                                    $exm=$this->db->select("*")->from("exm_catg")->where("status",'1')->get()->result();
                               ?>
                                <tr>
                                    <td>Examination Name :</td>
                                    <td>
                                        <select name="exam" id="exam" class="form-control" required >
                                            <option value="">Select Exam Name</option>
                                            <?php
                                                foreach($exm as $e){
                                                    $xmName=$this->db->select("*")->from("exm_namectg")->where("exmnid",$e->exmnid)->get()->row();

                                                    echo "<option value='$e->exm_ctgid'>$xmName->exm_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class : </td>
                                    <td>

                                    <?php
                                        $data = array(
                                                "shiftid"   => $shfid,
                                                "teacherid" => $tid,
                                                "year"      => $y
                                                );

                                        $teacherClass = $this->db->select("*")->from("routine")->where($data)->group_by("classid")->get()->result();
                                    ?>

                                        <select name="class" id="cls" onchange="markClsSec(this.value)" class="form-control" required>
                                            <option value="">Select Class</option>
                                            <?php
                                                foreach($teacherClass as $tc){
                                                    $cls=$this->db->select("class_name")->from("class_catg")->where("classid",$tc->classid)->get()->row();

                                                    echo "<option value='$tc->classid'>$cls->class_name</option>";
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Section :</td>
                                    <td>
                                        <select name="section" id="markSec" class="form-control" required onchange="getSubject(this.value)">
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                    <td>
                                        <select name="sub" id="sub" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                    <table class="table">
                        <tr>
                        <td style="width:25%;"></td>
                        <td style="width:17%;"></td>
                        
                            <td>
                                <button type="submit" name="stdList" class="btn btn-primary" >
                                    <span class="glyphicon glyphicon-send" aria-hidden="true"> Submit
                                    </span>
                                </button>
                                <button type="reset" name="ok" class="btn btn-warning" onclick="resetAll()" style="margin-left:2%;" >
                                    <span class="glyphicon glyphicon-refresh" aria-hidden="true"> Reset
                                    </span>
                                </button>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside>