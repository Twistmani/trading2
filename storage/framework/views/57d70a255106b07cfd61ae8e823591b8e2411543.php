<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Item Code</th>
			<th>Description</th>
			<th>Qty.</th>
			<th style="width:45%">Cost/Unit(inc. OC)</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($info as $row): ?>
		<tr>
			<td><?php echo e($row->item_code); ?></td>
			<td><?php echo e($row->description); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td><?php echo e(number_format($row->unit_price,2)); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>