<table class="table table-bordered table-hover">
	<thead>
	<tr>
		<th>Voucher No</th>
		<th>Voucher Date</th>
		<th>Item Name</th>
		<th>Unit</th>
		<th>Quantity</th>
		<th>Sell Price</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($items as $item): ?>
	<tr>
		<td><?php echo e($item->voucher_no); ?></td>
		<td><?php echo e(date('d-m-Y',strtotime($item->voucher_date))); ?></td>
		<td><?php echo e($item->item_name); ?></td>
		<td><?php echo e($item->unit_name); ?></td>
		<td><?php echo e($item->quantity); ?></td>
		<td><?php echo e($item->unit_price); ?></td>
	</tr>
	<?php endforeach; ?>
	<?php if(count($items) === 0): ?>
	</tbody>
	<tbody><tr class="odd danger"><td valign="top" colspan="6" class="dataTables_empty">No matching records found</td></tr></tbody>
	<?php endif; ?>
	</tbody>
</table>