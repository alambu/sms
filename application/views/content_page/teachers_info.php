 <!-- all query  -->
<?php
	$where=array("emptypeid"=>1,"status"=>1);
	$allThr=$this->db->select("*")->from("empee")->where($where)->get()->result();
?>
<!-- all query -->

<!-- all style -->
<style type="text/css">
	#leftSide{
		/*width: 49%;*/
		/*height: 10%;*/
		/*border: 1px solid gray;*/
		float: left;
		margin-bottom: 10px;
	}

	#rightSide{
		/*width: 50%;*/
		float: right;
		margin-bottom: 10px;
	}

	#leftSideIn{
		/*width: 100%;*/
		float: left;
		/*height: 220px;*/
		margin-bottom: 20px;
	}

	button{margin: 5px !important;}

</style>
<!-- all style -->


<!---this is main dynamic content start--> 
<div class="main_con"><!--Content Start-->
	<div class="row">
		<div class="col-md-9 left_con"><!-- left Content Start--><div class="row">
			<div class="col-md-12"><!-- Welcome Massage Start-->
				<div class="panel panel-primary">
					<div class="panel-heading" style="font-weight: bold; font-size: 15px;background:#004884;"> Teacher Information </div>
			<div class="panel-body" style="min-height:770px;margin-left:10%;margin-top:2%;">
				<?php $rid=0;for($i=0;$i<count($allThr);$i++):$rid++; ?>
					<div id="<?php if($rid%2==1):echo "leftSide";else:echo "rightSide";endif; ?>" class="col-md-6">
						<div id="leftSideIn" class="col-md-12">
							<img src="admin/img/employee_image/<?php echo $allThr[$i]->picture?>"  height="140" width="50%" class="img-thumbnail" >
						
							<p style="width:70%;margin-left:10px;color:#626262;font-weight:bold;">
								ID : <?php echo $allThr[$i]->empid ?><br/>
								Name : <?php echo $allThr[$i]->name; ?><br/>
								Qualification : <?php echo $allThr[$i]->edu_q; ?><br/>
								<?php 										
									echo "Subject : ".$this->db->select("sub_name")->from("subject_setup")->where("subsetid",$allThr[$i]->subject)->get()->row()->sub_name; echo "<br/>";
									//endif;
									$dpt=$this->db->select("*")->from("employee_catg")->where("ecatgid",$allThr[$i]->deginition)->get()->row();
									//echo $this->db->last_query();exit;
									echo "Designation : ".$dpt->emp_type;
								 ?><br/>
							</p>
						</div>
					</div>
				<?php endfor; ?>
				
			</div>
			<div>
				<?php echo $links; ?>
			</div>
		</div>
	</div><!-- Welcome Massage End-->
</div>
</div><!-- left Content End-->