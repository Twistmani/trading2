<div class="col-xs-15">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
		    <th>Voucher Type</th>
		    <th>Voucher No</th>
			<th>Voucher Date</th>
			<th>Reference No</th>
			<th>Tag</th>
			<th>Type</th>
			<th>Assign Amount</th>
			<th>Balance</th>
		</tr>
		</thead>
		<tbody>
		<?php /**/ $i = 0; /**/ ?>
		<?php foreach($invoices as $row): ?>
		<?php /**/ $i++; /**/ ?>
		<tr>
		    <td><?php echo e($row->voucher_type); ?></td>
		    <td><?php echo e($row->voucher_no); ?></td>
			<td><?php echo e(date('d-m-Y', strtotime($row->tr_date))); ?></td>
			<td><?php echo e($row->reference_no); ?><input type="hidden" name="refno[]" value="<?php echo e($row->reference_no); ?>"></td>
			<td><input type="checkbox" id="tag_<?php echo e($i); ?>" name="tag[]" class="tag-line" value="<?php echo e($i-1); ?>" onclick="getTag(this)"></td>
			<td><?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?></td>
			<td><input type="number" id="lineamnt_<?php echo e($i); ?>" step="any" name="line_amount[]" value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:''); ?>" class="form-control line-amount" data-type="Dr" style="width:8em;"></td>
			<input type="hidden" name="tr_type[]"  value="<?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?>">
			<input type="hidden" id="hidamt_<?php echo e($i); ?>" name="actual_amount[]" value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:$row->balance_amount); ?>">
			
			<?php if($type=='CUSTOMER'): ?>
			<input type="hidden" id="sinvoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($row->voucher_type_id); ?>">
			<input type="hidden" name="bill_type[]" value="SI">
			<?php else: ?>
			<input type="hidden" id="sinvoiceid_<?php echo e($i); ?>" name="purchase_invoice_id[]" value="<?php echo e($row->voucher_type_id); ?>">
			<input type="hidden" name="bill_type[]" value="PI">
			<?php endif; ?>
            <td><?php echo e(number_format($row->balance_amount,2)); ?></td>
			<input type="hidden" name="type[]">
			<input type="hidden" name="doc_id[]" value="<?php echo e($row->voucher_type_id); ?>">
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	
	<h4>Opening Balance</h4>
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
		    <th>Voucher Type</th>
		    <th>Voucher No</th>
			<th>Voucher Date</th>
			<th>Reference No</th>
			<th>Tag</th>
			<th>Type</th>
			<th>Assign Amount</th>
			<th>Balance</th>
		</tr>
		</thead>
		<tbody>
        <?php /**/ $i = count($invoices); /**/ ?>
		<?php foreach($obbills as $row): ?>
		<?php /**/ $i++; /**/ ?>
		<tr>
		    <td><?php echo e($row->voucher_type); ?></td>
		    <td><?php echo e($row->voucher_no); ?></td>
			<td><?php echo e(date('d-m-Y', strtotime($row->tr_date))); ?></td>
			<td><?php echo e($row->reference_no); ?><input type="hidden" name="refno[]" value="<?php echo e($row->reference_no); ?>"></td>
			<td><input type="checkbox" id="tag_<?php echo e($i); ?>" name="tagadv[]" class="tag-line" value="<?php echo e($i-1); ?>" onclick="getTag(this)"></td>
			<td><?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?></td>
			<td><input type="number" id="lineamnt_<?php echo e($i); ?>" step="any" name="line_amount[]" readonly value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:''); ?>" class="form-control line-amount" data-type="Cr" style="width:8em;"></td>
			<input type="hidden" name="tr_type[]"  value="<?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?>">
			<input type="hidden" id="hidamt_<?php echo e($i); ?>" name="actual_amount[]" value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:$row->balance_amount); ?>">
			
			<input type="hidden" id="sinvoiceid_<?php echo e($i); ?>" name="receipt_voucher_entry_id[]" value="<?php echo e($row->voucher_type_id); ?>">
			<input type="hidden" name="bill_type[]" value="OB">
			
            <td><?php echo e(number_format($row->balance_amount,2)); ?></td>
			<input type="hidden" name="type[]" value="<?php echo e($row->voucher_type); ?>">
			<input type="hidden" name="doc_id[]" value="<?php echo e($row->voucher_type_id); ?>">
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
