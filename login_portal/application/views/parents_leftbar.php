						<?php
							$id=$this->session->userdata('lidcheck'); 
							$child=$this->stu_parensts->get_chield($id);//print_r($child);
						?>
						<ul class="sidebar-menu">
                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Class Routine</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/class_routine?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Attendance</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/student_attendance?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						
						 <li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Result</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/exam_result?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						
						<li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Exam Routine</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/exam_routine?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						<li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Bill History</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/student_bill?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						
						<li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Notice</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/student_notice?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						<li class="treeview">
                            <a href="javascript:void(0);">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span>Sylabas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            
                            <?php foreach($child as $value){ ?>
                                <li><a href="student/sylabas?stu_id=<?php echo $value->stu_id; ?>"><i class="fa fa-angle-double-right"></i><?php echo ucfirst(strtolower($value->name)); ?></a></li>
                            <?php } ?>
                            
                            </ul>
                        </li>
						
						<li><a href="javascript:void(0);"><i class="fa fa-angle-double-right"></i>Teacher Information</a></li>
						
						<li><a href="admin/changePass"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
						</ul>