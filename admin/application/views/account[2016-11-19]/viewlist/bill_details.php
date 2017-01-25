								<b>Invoice Number :<?php echo $invoice;?></b>	
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>Nr</th>
											<th>Description</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
									<?php $nr=1; foreach($details as $values){?>
										<tr>
											<td><?php echo $nr;?></td>
											<td><?php echo $values->catg_type;?></td>
											<td><?php echo $values->balance;?></td>
										</tr>
									<?php $nr++;}?>
									<tr>
										<td colspan="2" style="text-align:right;">Total Amount</td>										
										<td><?php echo $t_amount;?></td>
									</tr>
									</tbody>
								</table>
							