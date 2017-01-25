				<?php extract($_GET);?>
				
				<br></br>
				<div class="form-group">
						 <label class="col-sm-3" >Student ID:</label>
						 <label class="col-sm-3" >Student Name:</label>
						 <label class="col-sm-2" >Roll No:</label>
						 <label class="col-sm-3" >Total Amount:</label>				  
				</div>
				<input type="hidden" name="classid" id="classid" value="<?php echo $classid?>"/>
				<input type="hidden" name="section" id="section" value="<?php echo $sections?>"/>
				<input type="hidden" name="billctg" id="billctg" value="<?php echo $billctgs?>"/>
				<input type="hidden" name="month" id="month" value="<?php echo $month?>"/>
				
				<?php 
				
				 $date=date('Y');
					$stdsql=$this->db->query("SELECT * FROM re_admission WHERE classid='$classid' AND section='$sections' AND syear='$date'")->result();
					if(count($stdsql)>0){
					foreach($stdsql as $row){
						$stuname=$this->accmodone->studentname($row->stu_id);
						$readid=$row->readid;
						$stuid=$row->stu_id;
					$sch=$this->db->query("SELECT sshipid,readid FROM schship WHERE readid='$readid' AND stu_id='$stuid' limit 1");
					if($this->db->affected_rows()>0){
						$sshipidrow=$sch->row();
						$sshipids=$sshipidrow->sshipid;						
						$stdfeesql=$this->db->query("SELECT amount,feectgid FROM class_fee_sett WHERE classid='$classid' AND year='$date'")->result();
						$balance=0;
						foreach($stdfeesql as $feec){								
							$fectgid=$feec->feectgid;							
							$feectg=$this->db->query("SELECT catg_type FROM fee_catg WHERE feectgid='$fectgid'")->row();
							$catgtype=$feectg->catg_type;
								$disfee=$this->db->query("SELECT amount,calculates FROM stu_sship_amount WHERE sshipid='$sshipids' AND stu_id='$stuid' AND feectgid='$fectgid'")->row();
								$disamount=$disfee->amount;
								$discal=$disfee->calculates;							
							if($catgtype=='Monthly Fee'){								
								if($discal==1){									
								$feeamount=$feec->amount*$month;
								$calamount=($feeamount*$disamount)/100;
								$feenetamount=$feeamount-$calamount;	
								$balance=$balance+$feenetamount;
								}
								else{
								$feeamount=$feec->amount*$month;
								$feenetamount=$feeamount-$disamount;	
								$balance=$balance+$feenetamount;
								}
							}
							else{
								if($discal==1){									
								$feeamount=$feec->amount;
								$calamount=($feeamount*$disamount)/100;
								$feenetamount=$feeamount-$calamount;	
								$balance=$balance+$feenetamount;
								}
								else{
								$feeamount=$feec->amount;
								$feenetamount=$feeamount-$disamount;	
								$balance=$balance+$feenetamount;
								}
							}
						}
						}
						else{
						$stdfeesql=$this->db->query("SELECT amount,feectgid FROM class_fee_sett WHERE classid='$classid' AND year='$date'")->result();
						$balance=0;
						foreach($stdfeesql as $feec){								
							$fectgid=$feec->feectgid;
							$feectg=$this->db->query("SELECT catg_type FROM fee_catg WHERE feectgid='$fectgid'")->row();
							$catgtype=$feectg->catg_type;
							if($catgtype=='Monthly Fee'){
								$feeamount=$feec->amount*$month;
								$balance=$balance+$feeamount;
							}
							else{
								$feeamount=$feec->amount;
								$balance=$balance+$feeamount;
							}
						}
						}
				?>
				<div class="form-group">						  
						  <div class="col-sm-3">          
							<input type="text" name="studentid"  class="form-control" id="studentid" required placeholder="" value="<?php echo $row->stu_id?>" readonly/>
						  </div>
						  <div class="col-sm-3">          
							<input type="text" name="studentN"  class="form-control" id="studentN" required placeholder="" value="<?php echo $stuname->name?>" readonly/>
						  </div>
						  <div class="col-sm-2">          
							<input type="text" name="RollN"  class="form-control" id="RollN" required placeholder="" value="<?php echo $row->roll_no?>" readonly/>
						  </div>
						  <div class="col-sm-3">          
							<input type="text" name="amount"  class="form-control" id="amount" required placeholder="" readonly value="<?php echo $balance;?>"/>
						  </div>						 						  
				</div>
				
					<?php }?>
					<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Bill Generate</button>
							&nbsp;&nbsp;
							
						  </div>
					</div>
					<?php } else{?>
					<div class="form-group">						  
					<div class="col-md-11">
						<div class="alert alert-danger" style="margin-top:10px;margin-bottom:5px;">
						<strong> Sorry ! </strong> No Record found.
						</div>
				   </div>
					<?php }?>
	