<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Unit</th>
			<th>Qty. in Hand</th>
			<th>Width</th>
			<th>Length</th>
		<!--	<th>MP Qty.</th>-->
		</tr>
		</thead>
		<tbody>
		<?php foreach($info as $row): ?>
		<?php if($row->is_baseqty==1): ?>
		<tr>
			<td><?php echo e($row->unit_name); ?></td>
			<td><?php echo e($row->cur_quantity); ?></td>
			<td><?php echo e($row->itmWd); ?></td>
			<td><?php echo e($row->itmLt); ?></td>
			<!--<td><?php echo e((($row->itmWd*$row->itmLt) > 0)?$row->cur_quantity/($row->itmWd*$row->itmLt):''); ?></td>-->
		</tr>
		<?php endif; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>