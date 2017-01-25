					<?php
						$id=$this->session->userdata('lidcheck'); 
						$child=$this->stu_parensts->get_chield($id);
					?>
					<div class="row">
						<?php foreach($child as $value){ ?>
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
							
                                <div class="inner">
                                    <h3>
                                       Account
                                    </h3>
									
									<?php 
										echo ucfirst(strtolower($value->name));
										$studentid=$this->session->userdata('lidcheck');
										
										//$totalbill=$this->db->select("sum(amount) as amount")->from("stu_bill")->where('stu_id',$studentid)->get()->row();		
										//$paybill=$this->db->select("sum(amount) as amount")->from('stu_pay')->where('stu_id',$studentid)->get()->row();
									?>
                                    <p>Total Bill : <?php //echo number_format($totalbill->amount,2).'  Taka.';?></p>
									<p>Total Payment : <?php //echo number_format($paybill->amount,2).'  Taka.';?></p>
									<p>Total Due : <?php //echo $totalbill->amount-$paybill->amount.'  Taka.';?></p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="javascript:void(0);" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
						<?PHP } ?>
					</div>
				
					