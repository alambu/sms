<?php
    $pro = $this->db->get("sprofile")->row();
?>

<style type="text/css">
    .dashboard-heading{
        font-size: 30px;
    }
    .dashboard-text{
        font-size: 20px;
        font-weight: bold;
    }
</style>

<!-- getting information -->
<?php
    $y = date("Y");
    $today = date("Y-m-d");
    $regSql = $this->db->select("sum(status) as totalstu")->from("re_admission")->where("syear",$y)->get()->row();

    $preSql = $this->db->select("stu_id")->from("attendance")->where('date',$today)->get()->result();
    $tprecount=0;
    
    foreach($preSql as $prerow){
        $tpre=explode(',',$prerow->stu_id);
        $totalpre=count($tpre);
        $tprecount=$tprecount+$totalpre;
    }

    $cash = $this->accmodone->cashBalance();   
    $bank = $this->accmodone->bankBalance();

    // todays income
    $tIncome = $this->accmodone->todayIncome();
    //echo $tIncome;exit;
    $tIncome = $tIncome?$tIncome:0.00;
    
    // todays expanse
    $tExpanse = $this->accmodone->todayExpanse();
    $tExpanse = $tExpanse?$tExpanse:0.00;

    $totalParentsCount = $this->accmodone->totalParentsCount();
    $totalTeacherCount = $this->accmodone->totalTeacherCount();

?>
<!-- php information end -->

<aside class="right-side">      <!---rightbar start here -->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>

                    <!---<h3 style="position: relative;margin-top: -20px;padding-left: 350px;"><?php //echo $pro->schoolN ?></h3>--->

                </section>

                <!-- Main content -->
                <section class="content">

<div class="row">
    <div class="col-lg-12">
        
        <!-- total student section -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-group fa-5x" style="color: #8cd9b3;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($regSql->totalstu); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Total Students</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<!-- attendent student section -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-male fa-5x" style="color: #9999ff;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($tprecount); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Attendent Students</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<!-- parent section -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-user fa-5x" style="color: #bdc3c7;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($totalParentsCount); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Total Parents</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<!-- Total teacher section -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-graduation-cap fa-5x" style="color: #e67e22;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($totalTeacherCount); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Total Teacher</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



    </div>
</div>

<!-- secoden dashboard section -->
<div class="row">
    <div class="col-lg-12">
        
<!-- Total income todays -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-usd fa-5x" style="color: #cc7a00;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($tIncome); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Today Income</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<!-- total expanse -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-book fa-5x" style="color: #804200;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($tExpanse); ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Today Expanse</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



<!-- Cash account balance -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-hourglass-end fa-5x" style="color: #16a085;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($cash) ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Cash Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

<!-- total bank -->
        <div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-bank fa-5x" style="color: green;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($bank) ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Bank Amount</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
<!-- total balance -->
<div class="col-lg-3 col-md-6">
            <a href="javascript:void(0);">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <i class="fa fa-cubes fa-5x" style="color: #7099A3;"></i>
                            </div>
                            <div class="col-xs-6 text-center">
                                <p class="dashboard-heading"><?php echo number_format($cash+$bank) ?></p>
                            </div>
                            <div class="col-xs-12">
                                <p class="dashboard-text text-center">Total Balance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
</div>


                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                        <section class="col-lg-6 connectedSortable">
                            <!-- Map box -->
                            <!-- /.box -->

                        </section><!-- right col -->
                    </div><!-- /.row (main row) -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->     <!---rightbar close here ---->