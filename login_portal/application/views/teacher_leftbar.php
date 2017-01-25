						<?php
							$sft=$this->db->get("shift_catg")->result();
							
						?>
						<ul class="sidebar-menu">
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
						<li><a href="admin/changePass"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
						
						</ul>