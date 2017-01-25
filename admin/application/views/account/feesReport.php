<form class="form-horizontal" role="form" action="index.php/account_edit/search_class_fee_seting" method="post">
	<div class="form-group">
		<div class="col-sm-3" > </div>
		<div class="col-sm-2">          
				<select class="form-control" name="classname" id="classname">
					<option value="">--Select Class--</option>
						<?php 
							$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();										
							foreach($sqlacc as $accidshow){
						?>
					<option value="<?php echo $accidshow->classid?>" <?php if($classid==$accidshow->classid){echo "SELECTED";}?>><?php echo $accidshow->class_name?></option>
					
					<?php }?>
				</select>
			</div>
						 
			<div class="col-sm-2">          
				<select class="form-control" name="year" id="year">
					<option value="">All</option>
						<?php $yearss=date('Y')+1;
						$b='2010';
						for($a=$yearss;$a>=$b;$a--){
						?>
							<option value="<?php echo $a ?>" <?php if($years1==$a){echo "SELECTED";}?>><?php echo $a?></option>
						<?php }?>
				</select>
			</div>								
			
			<div class="col-sm-2">
				<input type="submit" class="btn btn-primary" name="submitsearch"  class="form-control" value="Search"/>
			</div>
		</div>
	</form><br/>

<label class="control-label col-sm-12" style="text-align:center;font-size:20px;background:#F3F4F5;height:35px;">List of Class Fee</label>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Nr</th>
					<th>Class Name</th>									
					<th>Fee Category</th>
					<th>Amount</th>
					<th>Year</th>
					<th>Action</th>
				</tr>								
			</thead>
			
			<tbody>							
				<?php
					$nr=1;
					$a=0;
					$b=1;

					foreach($query as $row){
						$classid=$this->accmodone->classname($row->classid);
						$feecata=$this->accmodone->classfeecatg($row->feectgid);
				?>
				
				<tr>
					<input type="hidden" name="rowid[]" value="<?php echo $row->feeid;?>" id="rowid<?php echo $nr?>"/>
					<input type="hidden" name="year[]" value="<?php echo $row->year?>" id="yearid<?php echo $nr?>"/>
					
					<td><?php echo $nr?></td>
					
					<td>
						<span id="classN<?php echo $nr; ?>"><?php echo $classid->class_name;?></span>
						<select class="form-control" name="classname[]" id="classname<?php echo $nr?>" style="display:none;">
							<option value="">--Select--</option>
								
								<?php 
									$sqlacc=$this->db->select('*')->from('class_catg')->get()->result();
									foreach($sqlacc as $accidshow){
								?>
							
							<option value="<?php echo $accidshow->classid?>" <?php if($accidshow->classid==$row->classid){echo "SELECTED";}?>>
								<?php echo $accidshow->class_name?></option>
								
								<?php }?>
									
						</select>
					</td>
					
					<td>
						<span id="feectgspan<?php echo $nr; ?>"><?php echo $feecata->catg_type;?></span>
							<select class="form-control" name="feectg[]" id="feectg<?php echo $nr?>" style="display:none;">
								<option value="">--Select--</option>
									<?php 
										$sqlaccs=$this->db->select('*')->from('fee_catg')->get()->result();
										foreach($sqlaccs as $accidshows){
									?>
								<option value="<?php echo $accidshows->feectgid?>" <?php if($accidshows->feectgid==$row->feectgid){echo "SELECTED";}?>><?php echo $accidshows->catg_type?></option>
											<?php }?>
							</select>
					</td>
					
					<td>
						<span name="amountspan" id="amountspan<?php echo $nr;?>"><?php echo $row->amount;?></span>
						<input type="hidden" name="amount[]" id="amount<?php echo $nr; ?>" value="<?php echo $row->amount;?>" class="form-control" />
					</td>
					
					<td><?php echo $row->year?></td>
									
					<td>
						<button type="button" id="edit<?php echo $nr; ?>" value="" class="btn btn-info" onclick="edit(<?php echo $nr;?>)"?><span class="glyphicon glyphicon-edit"></span> Edit</button>
									
						<button type="button" id="subedit<?php echo $nr; ?>" class="btn btn-success" style="display:none;" onclick="edittitle(classname<?php echo $nr?>.value,feectg<?php echo $nr?>.value,amount<?php echo $nr?>.value,rowid<?php echo $nr?>.value,<?php echo $nr?>,yearid<?php echo $nr?>.value)"><span class="glyphicon glyphicon-ok"></span></button>
									
					</td>	
				</tr>

			<?php $nr++;}?>
			</tbody>
		</table>