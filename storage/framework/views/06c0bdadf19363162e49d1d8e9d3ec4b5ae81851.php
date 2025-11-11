<br/>
<div class="col-xs-4">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Location</th>
			<th>Stock</th>
			<th>Bin</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($info as $row): ?>
		<tr>
			<td><?php echo e($row->name); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td><?php echo e($row->code); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>