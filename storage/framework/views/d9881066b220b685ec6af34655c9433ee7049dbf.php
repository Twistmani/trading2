<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Unit</th>
			<th>Qty. in Hand</th>
			<th>Sell Price</th>
			<th>Avg. Cost</th>
			<!--<th>Resvd. Qty.</th>-->
		</tr>
		</thead>
		<tbody>
		<?php foreach($info as $row): ?>
		<tr>
			<td><?php echo e($row->unit_name); ?></td>
			<td><?php echo e(($row->is_baseqty==0)?($row->cur_quantity * $row->pkno) / $row->packing:$row->cur_quantity); ?></td>
			<td><?php echo e($row->sell_price); ?></td>
			<td><?php echo e(($row->is_baseqty==1)?$row->cost_avg:''); ?></td>
		<!--	<td><?php echo e($row->reorder_level); ?></td>-->
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>