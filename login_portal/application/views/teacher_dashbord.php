<?php
					// first get teacher id
					$tid = $this->session->userdata("lidcheck");
					// week all days name array
					$week=array("Saturday","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday");
					// time function
					function chngTime($tm){
						$expTm=explode(":",$tm);
						if($expTm[0]>=12):
							$ampm=" PM";
						else:
							$ampm=" AM";
						endif;
						return $gtm=$expTm[0].":".$expTm[1].$ampm;
					}


					$sft=$this->db->get("shift_catg")->result();
					foreach($sft as $st):

					
					$sNm=$this->db->select("*")->from("shift_catg")->where("shiftid",$st->shiftid)->get()->row();
					// initialize
					$d=date("Y");
					$day=date("D")."day";
					?>
			<div class="row">
            <div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading" style="text-align: center !important;"><?php echo ucfirst(strtolower($sNm->shift_N)) ?> Shift  <br/>  Class Routine</b></div>
							<div class="panel-body">
								<table class="table">
									<tbody>

										<?php
										for($i=0;$i<count($week);$i++):
											// get saturday class routine
											$sat=array(
												"teacherid"=>$tid,
												"day"=>$week[$i],
												"shiftid"=>$st->shiftid,
												"year"=>$d
												);

											$satR=$this->db->select("*")->from("routine")->where($sat)->get()->result();
										?>

										<tr>
											<th style="width: 150px;" class="active"><?php echo $week[$i] ?></th>
											<td>
											<?php 
												foreach($satR as $s):
													// get class name
													$satC=$this->db->select("*")->from("class_catg")->where("classid",$s->classid)->get()->row();
													// get subject name
													$satSb=$this->db->select("*")->from("subject_class")->where("subjid",$s->subjid)->get()->row();
											?>
												
												<button class="btn btn-default" style="background: #303641 !important;color:#ffffff;border-radius:5px;float:left;font-size: 10px;width:33%;text-align: center;padding:0px;"><p>Class - <?php echo $satC->class_name ?><br/>
												<?php echo $satSb->sub_name ?><br/>
												<?php echo chngTime($s->stime)."-".chngTime($s->etime) ?>
												</p></button>

											<?php endforeach;endfor; ?>
											
											</td>
										</tr>
									</tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php
                endforeach;
            ?>
			</div><!-- /.row -->