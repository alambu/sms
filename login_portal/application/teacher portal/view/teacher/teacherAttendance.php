<?php
    $tid=$this->session->userdata("lidcheck");  // employee id
    $month = array("January","February","March","Appril","May","June","July","August","September","October","November","December");
?>

<aside class="right-side">      <!---rightbar start here -->
<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Teacher Attendance
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

<?php if(isset($_POST['sbt'])):extract($_POST);else:$y = date("Y");endif; ?>

                <div class="well well-sm">
                    <form action="" name="frm" class="form-inline" role="form" method="post" style="text-align: center;">
                        <select name="y" id="y" class="form-control">
                            <option value="">Select Year</option>
                            <?php for($i = date("Y");$i >= 2000;$i--): ?>
                                <option value="<?php echo $i ?>" <?php if(isset($_POST['sbt'])):if($y == $i):echo "selected";endif;endif; ?>><?php echo $i ?></option>
                            <?php endfor; ?>
                        </select>
                        <button type="submit" name="sbt" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> view</button>
                    </form> 
                </div>


                <div class="alert alert-info" style="text-align: center;">
                    <h3>Your Attendance - <?php echo $y; ?></h3>
                </div>
<?php $j = 1; for($i = 0;$i < count($month);$i++): ?>
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <!-- -->
                      <div class="panel-heading">
                        <h4 class="panel-title">

                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $j ?>" style="display:block;font-weight: bold;"><i class="entypo-rss"></i> 
                          <?php echo $month[$i] ?>
                          <i class="fa pull-right fa-angle-left"></i>
                          </a>
                        </h4>
                      </div>
                      <!-- </a> -->
                      <div id="collapse<?php echo $j ?>" class="panel-collapse collapse<?php echo $j ?> collapse" class="collapsed">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Total working day</th>
                                        <th>Present</th>
                                        <th>Absence</th>
                                        <th>satus</th>
                                    </tr>
                                </thead>
                                
                    <?php
                        $sd = $y."-".$j."-01";
                        $ed = $y."-".$j."-31";

                        $tattend = $this->db->select("*")->from("emp_attendance")->where("atendate>=",$sd)->where("atendate<=",$ed)->get()->result();

                        $wd = array();
                        foreach($tattend as $td):
                            $workday = explode(",",$td->empid);
                            $wd = array_merge($wd,$workday);
                        endforeach;
                        $duplicate = array_count_values($wd);
                        
                    ?>

                                <tbody>
                                    <tr>
                                        <td><?php echo $twd = count($tattend); ?></td>
                                        <td><?php if($duplicate[$tid] <= 0):echo "0";else:echo $duplicate[$tid];endif;  ?></td>
                                        <td><?php echo count($tattend)-$duplicate[$tid]; ?></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $persent = ceil(($duplicate[$tid]*100)/$twd) ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $persent ?>%">
                                                <b style="color:<?php if($persent > 0):echo "white";else:echo "#34495e";endif; ?> !important;"><?php echo $persent ?>%</b>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                  </div>
<?php $j++; endfor; ?>
            </div>
        </div>
    </section>
</aside>