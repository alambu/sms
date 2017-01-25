<?php 
extract($_GET);
$history=$this->accmodone->vahicaleRentHistory($stu_id);
?>

			<table class="table table-striped" id="example1">
  				<thead>
  					<tr>
  						<th>SI</th>
  						<th>Invoice</th>
  						<th>Tk</th>
  						<th>Date</th>
  					</tr>
  				</thead>
  				<tbody>

  				<?php
  					$si = 0;
  					foreach($history as $repo):
  						$si++;
  				?>

  					<tr>
  						<td><?php echo $si ?></td>
  						<td><?php echo $repo->invoice_no; ?></td>
  						<td><?php echo $repo->vahicle_rent; ?></td>
  						<td>
  							<?php echo date("Y-m-d",strtotime($repo->e_date)); ?>
  						</td>
  					</tr>
  					<?php
  						endforeach;
  					?>
  				</tbody>
  			</table>