<?php
    $tid=$this->session->userdata("lidcheck");  // employee id
    $eid=$this->session->userdata("ltype"); // type id
?>


 <div class="wrapper row-offcanvas row-offcanvas-left"> <!---wrapper div start here -->
            <!-- Left side column. contains the logo and sidebar -->
			
			
			
            <aside class="left-side sidebar-offcanvas">              <!---leftbar start here-->
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Jane</p>

                            <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="javascript:void(0);" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php/admin">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
<!-- teacher section start -->
<?php
    $sft=$this->db->get("shift_catg")->result();
    
?>
                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Class Routine</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($sft as $sf): ?>
                                <li><a href="teacher/classRoutine/<?php echo $sf->shiftid ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($sf->shift_N)) ?></a></li>
                            <?php endforeach; ?>
                            
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Student Attendance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($sft as $sf): ?>
                                <li><a href="teacher/studentAttend/<?php echo $sf->shiftid ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($sf->shift_N)) ?></a></li>
                            <?php endforeach; ?>
                            
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Mark Entry</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php 
                                foreach($sft as $sf):                            ?>
                                <li><a href="teacher/markEntry/<?php echo $sf->shiftid ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($sf->shift_N)) ?></a></li>
                            <?php endforeach; ?>
                            
                            </ul>
                        </li>

                        <li><a href="teacher/leaveRequest"><i class="fa fa-angle-double-right"></i>Leave Request</a></li>

                        <li><a href="teacher/studentInformation"><i class="fa fa-angle-double-right"></i>Student Information</a></li>
                        
                        <li><a href="teacher/teacherAttendance"><i class="fa fa-angle-double-right"></i>Teacher Attendance</a></li>

                        <li><a href="teacher/salaryState"><i class="fa fa-angle-double-right"></i>Salary Statement</a></li>

<!-- end teacher section -->

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>  
			