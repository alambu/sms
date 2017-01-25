						<?php  
						$getid=$this->input->get('classid');
						$sections=$this->input->get('sections');
						$rollno=$this->input->get('rollno');
						$shifts=$this->input->get('shifts');
						 $pyear=date('Y');
						$sqlclass=$this->db->query("SELECT * FROM class_fee_sett WHERE classid='$getid' AND year='$pyear'")->result();
						if($this->db->affected_rows()<1){?>
							<div class="col-md-11" style="min-height:60px;">
								<div class="alert alert-warning">
								<strong> Sorry ! </strong> Please at first setting your class fee.
								</div>
							</div> 
						<?php } else{
						?>
						<div class="form-group">
							<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
							 </div>
							 <div class="col-sm-3">
								<label for="ex1">Category Name </label>
							 </div>
							<div class="col-sm-2">
								<label for="ex1">Amount</label>
							 </div>
							 <div class="col-sm-2">
								<label for="ex1">Discount or percentage</label>
							 </div>
							 <div class="col-sm-2">
								<label for="ex1">Calculation</label>
							 </div>
						</div>
						<?php $nr=1;
							foreach($sqlclass as $rowcfee){
								$feecid=$rowcfee->feectgid;
							$sqlacc=$this->db->select('*')->from('fee_catg')->where('feectgid',$feecid)->get()->row();										
							?>
						<div class="form-group">
							<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
							</div>
							<div class="col-sm-3">
									<input type="hidden" name="title[]" id="title<?php echo $nr?>" value="<?php echo $rowcfee->feectgid?>"/>
									<!--<select class="form-control col-sm-4" name="title[]" required>
											<option value="<?php// echo $rowcfee->feectgid?>"><?php //echo $sqlacc->catg_type?></option>											
									</select>-->									
									<input class="form-control" name="fecatgm" id="fecatg<?php echo $nr?>" value="<?php echo $sqlacc->catg_type?>" type="text" readonly />
							</div>
							  <div class="col-sm-2">
									<input class="form-control" name="setamount" id="setamount<?php echo $nr?>" value="<?php echo $rowcfee->amount?>" type="text" readonly />
							  </div>
							  <div class="col-sm-2">
									<input class="form-control" name="amount[]" id="amount<?php echo $nr?>" type="text" required placeholder="Enter Amount" onkeypress="return isamountonly(event)" onchange="return scholarshipcheck(setamount<?php echo $nr?>.value,amount<?php echo $nr?>.value,persent<?php echo $nr?>.value,<?php echo $nr?>)" required/>
							  </div>
							  <div class="col-sm-2">
									<select class="form-control" name="persentage[]" id="persent<?php echo $nr?>" required onchange="return scholarshipcheck(setamount<?php echo $nr?>.value,amount<?php echo $nr?>.value,persent<?php echo $nr?>.value,<?php echo $nr?>)">
											<option value="">--Select--</option>
											<option value="1">Percentage</option>
											<option value="2">Discount</option>	
									</select>
							  </div>
						</div>
							<?php $nr++;}?>
						<div class="form-group">
							<div class="col-sm-1">
								<label for="ex1">&nbsp </label>
							</div>
							<div class="col-sm-2">									
								<button type="submit" name="submit" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							  </div>
						</div>
						<?php }?>