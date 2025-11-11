<br/>
<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Code</th>
			<th>Location Name</th>
			<th>Quantity</th>
			<th>Bin</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($items as $row): ?>
		<tr>
			<td><?php echo e($row->code); ?></td>
			<td><?php echo e($row->name); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td><?php echo e($row->bin); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>