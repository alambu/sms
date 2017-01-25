						
						<?php 
							$id=$this->session->userdata('lidcheck'); 
						?>
						<ul class="sidebar-menu">
							<li><a href="student/student_attendance?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Your Attendance</a></li>
							<li><a href="student/exam_result?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Exam Result</a></li>
							<li><a href="student/exam_routine?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Exam Routine</a></li>
							<li><a href="student/student_bill?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Bill History</a></li>
							<li><a href="student/student_notice?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Notice</a></li>
							<li><a href="student/sylabas?stu_id=<?php echo $id; ?>"><i class="fa fa-angle-double-right"></i>Sylabus</a></li>
							<li><a href="admin/changePass"><i class="fa fa-angle-double-right"></i>Change Password</a></li>
						</ul>