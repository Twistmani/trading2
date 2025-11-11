<table class="table table-striped" id="tableBank">
	<thead>
		<tr>
			<th>Customer</th>
			<th>Amount</th>
			<th>Cheque No</th>
			<th>Cheque Date</th>
			<th>Bank</th>
			<th>Days</th>
		</tr>
	</thead>
		<tbody>
		<?php foreach($pdcr as $pd): ?>
		<?php if($pd->cheque_no!='' && $pd->code!='') {  ?>
		<tr>
			<td><?php echo e($pd->customer); ?></td>
			<td><?php echo e(number_format($pd->amount,2)); ?></td>
			<td><?php echo e($pd->cheque_no); ?></td>
			<td><?php echo e(($pd->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($pd->cheque_date))); ?></td>
			<td><?php echo e($pd->code); ?></td>
			<?php 
				$now = time();
				$your_date = strtotime($pd->cheque_date);
				$datediff = $your_date - $now;
				$datedif = round($datediff / (60 * 60 * 24));
			?>
			<td><?php echo e(($datedif<0)?'Over':$datedif); ?></td>
		</tr>
		<?php } ?>
		<?php endforeach; ?>
		</tbody>
	</tbody>
</table>