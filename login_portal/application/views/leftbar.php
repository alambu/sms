<div class="wrapper row-offcanvas row-offcanvas-left"> <!---wrapper div start here -->
            <!-- Left side column. contains the logo and sidebar -->
			
<?php
		$id = $this->session->userdata('lidcheck');
        $eid = $this->session->userdata("ltype"); // type id
		$type_array=array('1'=>'Student','2'=>'Parents','3'=>'Teacher');
                                        
        if($eid == 1):
            $studentInfo = $this->db->select("*")->from("regis_tbl")->where("stu_id",$id)->get()->row();
			if($studentInfo->picture=='') { $src='../admin/img/default/default1.jpg'; }
			else {
            $src = "../admin/img/student_section/registration_form/".$studentInfo->picture;
			}
            // data
            $data = array(
                    "name" => $studentInfo->name,
                    "src" => $src
                );
        elseif($eid == 2):
			$pinfo = $this->db->select("*")->from("father_login")->where("parentid",$id)->get()->row();
			if($pinfo->picture=='') { $src='../admin/img/default/default1.jpg'; }
			else {
            $src =$pinfo->picture;
			}
            $data = array(
                    "name" => $pinfo->name,
                    "src" => $src
                );
        elseif($eid == 3):
            $empInfo = $this->db->select("*")->from("empee")->where("empid",$id)->get()->row();
			if($empInfo->picture=='') { $src='../admin/img/default/default1.jpg'; }
			else {
            $src = "../admin/img/employee_image/".$empInfo->picture;
            }
            // data
            $data = array(
                    "name" => $empInfo->name,
                    "src" => $src
                );

        endif;
		
?>
			
            <aside class="left-side sidebar-offcanvas">              <!---leftbar start here-->
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $data['src'];  ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php $ex=explode(" ",$data['name']); echo ucfirst($ex[0]); ?></p>
                            <a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="index.php/admin">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
					<!-- Left Bar start -->
		
						<?php 
						if($eid==1) 
						{
							
							$this->load->view("student_leftbar");
						}
						elseif($eid==2)
						{
							$this->load->view("parents_leftbar");
						}
						elseif($eid==3)
						{
							$this->load->view("teacher_leftbar");
						}
						?>

					<!-- Left Bar End -->

                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>  
			