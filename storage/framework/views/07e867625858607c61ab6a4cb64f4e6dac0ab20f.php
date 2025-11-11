<br/>
<?php $num = $num - 1; ?>
<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Item Code</th>
			<th>Description</th>
			<th>Quantity</th>
			<th>Unit</th>
			<th class="text-right">Cost Avg.</th>
			<th class="text-right">Seles Price</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($items as $row): ?>
		<tr>
			<td><?php echo e($row->item_code); ?></td>
			<td><?php echo e($row->description); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td><?php echo e($row->packing); ?></td>
			<td><?php echo e(number_format($row->cost_avg,2)); ?></td>
			<td><?php echo e(number_format($row->sell_price,2)); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>