				<?php 
					extract($_GET);
					if(trim($stuids)!=''){
					$sql_query=$this->db->query("SELECT * FROM re_admission WHERE stu_id='$stuids' order by stu_id DESC limit 1");
					}
					else{
						$sql_query=$this->db->query("SELECT * FROM re_admission WHERE classid='$classid' AND section='$sections' AND roll_no='$rollno' AND shiftid='$shifts'");
					}					
					 if($this->db->affected_rows()>0){
							$sql_row=$sql_query->row();
							$studentids=$sql_row->stu_id;							
							$stuclassid=$sql_row->classid;
							$stusection=$sql_row->section;
							$stushift=$sql_row->shiftid;
						$sql_stuname=$this->db->query("SELECT name,fName FROM regis_tbl WHERE stu_id='$studentids'")->row();
					$sql_stuclass=$this->db->query("SELECT class_name FROM class_catg WHERE classid='$stuclassid'")->row();
					$sql_stushift=$this->db->query("SELECT shift_N FROM shift_catg WHERE shiftid='$stushift'")->row();
					
					$sql_bill=$this->db->query("SELECT balance FROM stu_creacc WHERE stu_id='$studentids'")->row();
				?>
				<input type="hidden" name="studentid" value="<?php echo $studentids?>"/>
				<input type="hidden" name="sturollno" value="<?php echo $sql_row->roll_no?>"/>
				<div class="form-group">
						  <label class="control-label col-sm-2" >Student Name:</label>
						  <div class="col-sm-4">          
							<input type="text" name="stuName"  class="form-control" id="stuName" required value="<?php echo $sql_stuname->name?>" readonly//>
						  </div>
							<label class="control-label col-sm-2" >Father Name:</label>
						  <div class="col-sm-4">          
							<input type="text" name="fathername"  class="form-control" required value="<?php echo $sql_stuname->fName?>" readonly/>
						  </div>						  
				</div>
				<div class="form-group">
						
						  <label class="control-label col-sm-2">Student ID:</label>
						  <div class="col-sm-4">          
							<input type="text" name="studentid"  class="form-control" id="studentid"  value="<?php echo $studentids?>" readonly/>
						  </div>
						  <label class="control-label col-sm-2">Class Name:</label>
						  <div class="col-sm-4">          
							<input type="text" name="className"  class="form-control" id="className"  value="<?php echo $sql_stuclass->class_name?>" readonly/>
						  </div>						  
				</div>
				<div class="form-group">
						<label class="control-label col-sm-2" >Section:</label>
						  <div class="col-sm-4">          
							<input type="text" name="sectionname"  class="form-control" id="sectionname"  value="<?php echo $stusection?>" readonly/>
						  </div>
						  <label class="control-label col-sm-2">Shift</label>
						  <div class="col-sm-4">          
							<input type="text" name="shiftss"  class="form-control"  value="<?php echo $sql_stushift->shift_N?>" readonly/>
						  </div>
						 					  
				</div>
				<div class="form-group">
						  <label class="control-label col-sm-2">Total Bill:</label>
						  <div class="col-sm-4">          
							<input type="text" name="totalbill"  class="form-control" id="totalbill" required readonly value="<?php echo $sql_bill->balance?>"/>
						  </div>
						  <label class="control-label col-sm-2" >Payment Amount:</label>
						  <div class="col-sm-4">          
							<input type="text" name="payamount"  class="form-control" id="payamount" required placeholder="Enter Payment Amount" onkeypress="return isamountonly(event)"/>
						  </div>						  
				</div>
				<div class="form-group">
						  <label class="control-label col-sm-2">Fee Title:</label>
						  <div class="col-sm-4">          
							<select class="form-control" name="paytype" id="paytype" required>
									<option value="">--Select--</option>
									<?php 
										$exmsql=$this->db->select('*')->from('billpay_catg')->get()->result();
										foreach($exmsql as $exmsqlrow){
											//$exmrow=$this->accmodone->exmname($exmsqlrow->exmnid);
									?>
										<option value="<?php echo $exmsqlrow->billpay_type?>"><?php echo $exmsqlrow->billpay_type?></option>
										<?php }?>
							</select>
						  </div>
						  <label class="control-label col-sm-2">Account:</label>
						  <div class="col-sm-4">          
							<select class="form-control" name="accountid" id="accountid" required>
									<option value="">--Select--</option>
									<?php 
										$accsql=$this->db->select('*')->from('account_cre')->WHERE('bank_name','Cash')->get()->result();
										foreach($accsql as $accsqlrow){											
									?>
										<option value="<?php echo $accsqlrow->accountid?>"><?php echo $accsqlrow->acc_name.'('.$accsqlrow->accountid.')'?></option>
										<?php }?>
							</select>
						  </div>						  					  
				</div>
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" name="submit" id="submitbutton" class="btn btn-primary"><span class="glyphicon glyphicon-send"></span>  Submit</button>
							
						  </div>
						</div>
						
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							
						  </div>
						</div>
						
<!--------------------------------------------------------  Student Ledger history show ---------------------------------  -->
					
                    <div class="row">
						 <label class="control-label col-sm-12" style="text-align:center;font-size:20px;background:#F3F4F5;height:35px;">Last Five Transaction</b> </label>
						<div class="col-md-12">
						<div class="panel-body">
						 <div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Nr</th>																			
									<th>Tr. ID</th>
									<th>Student ID</th>	
									<th>Bill Invoice</th>	
									<th>Payment Invoice</th>	
									<th>Purpose</th>										
									<th>Credit</th>											
									<th>Debit</th>											
									<th>Balance</th>										
									<th>Entry Person</th>					
									<th>Entry Date</th>					
								</tr>
							</thead>
							<tbody>
								<?php 
									$led=$this->db->query("SELECT * FROM stu_ledger WHERE stu_id='$studentids' order by id DESC  limit 5")->result();									
									$nr=1; foreach($led as $ledger){										
									?>
								<tr>
									<td><?php echo $nr++ ?></td>									
									<td><?php echo $ledger->trans_id?></td>
									<td><?php echo $ledger->stu_id?></td>									
									<td><a href="javascript:void(0)" onclick="showAjaxModal1('index.php/account_edit/bill_description/<?php echo $ledger->bill_invoice;?>');"><?php $bill=$ledger->bill_invoice; if($bill>'0'){echo $bill;}?></a></td>
									<td><?php $pay=$ledger->pay_invoice; if($pay>'0'){echo $pay;}?></td>
									<td><?php echo $ledger->porpose?></td>
									<td><?php echo $ledger->credit?></td>
									<td><?php echo $ledger->debit?></td>
									<td><?php echo $ledger->balance?></td>
									<td><?php echo $ledger->e_user?></td>
									<td><?php  $cdate=$ledger->e_date;if($cdate>0){echo date('M-d-Y',strtotime($cdate));}?></td>									
								</tr>
								<?php }?>
							</tbody>
							</table>
							</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="modal_ajax1" role="dialog">
						<div class="modal-dialog">
						
						  <!-- Modal content-->
						  <div class="modal-content">
							<div class="modal-header">
							  <button type="button" class="close" data-dismiss="modal">×</button>
							  <h4 class="modal-title">Bill Generate Details</h4>
							</div>
							<div class="modal-body">
								
							</div>
							<div class="modal-footer">
							  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						  </div>						  
						</div>
					</div>
						
					<?php }else{?>
											  
						<div class="col-md-11">
							<div class="alert alert-danger" style="margin-top:10px;margin-bottom:5px;">
							<strong> Sorry ! </strong> No Record found.
							</div>
					   </div>
					<?php } ?>