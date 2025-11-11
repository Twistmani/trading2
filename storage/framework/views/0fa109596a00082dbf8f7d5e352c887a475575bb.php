<div class="col-xs-15">
	<table class="table table-bordered table-hover" id="tableRV">
		<thead>
		<button type="button" class="btn btn-primary add-invoice" data-dismiss="modal" style="margin-bottom:15px;">Add</button>
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
		<?php foreach($osbills as $row): ?>
		<?php /**/ $i++; /**/ ?>
		<?php  $read = $dis = ''; $txt = $isadv = '';  ?>
		<?php if(strtolower($row->reference_no)=='adv.' || strtolower($row->reference_no)=='adv'): ?>
		    <?php 
		        $read = 'readonly'; $dis = 'disabled';
		        $txt = 'Advance set off.'; $isadv = 1;
		     ?>
		<?php endif; ?>
		<tr>
		    <td><?php echo e($row->voucher_type); ?></td>
		    <td><?php echo e($row->voucher_no); ?></td>
			<td><?php echo e(date('d-m-Y', strtotime($row->tr_date))); ?></td>
			<td><?php echo e($row->reference_no); ?><input type="hidden" name="refno[]" id="refid_<?php echo e($i); ?>" value="<?php echo e($row->reference_no); ?>"></td>
			<td><?php if($row->is_edit=='E'): ?>
				<input type="checkbox" id="tag_<?php echo e($i); ?>" name="tag[]" class="tag-line" value="<?php echo e($i-1); ?>" data-adv="<?php echo e($isadv); ?>" onclick="getTag(this)">
				<?php else: ?>
				<input type="checkbox" id="tag_<?php echo e($i); ?>" name="tag[]" class="tag-line-nw" value="<?php echo e($i-1); ?>" data-adv="<?php echo e($isadv); ?>" onclick="getTag(this)">
				<?php endif; ?>
			</td>
			<td><?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?><input type="hidden" id="actype_<?php echo e($i); ?>" name="acnttype[]" value="<?php echo e($row->tr_type); ?>"/>
			<input type="hidden" id="trtype_<?php echo e($i); ?>" value="<?php echo e(($row->tr_type=='Dr')?'Cr':'Dr'); ?>"/></td>
			<td><input type="text" id="lineamnt_<?php echo e($i); ?>" step="any" name="line_amount[]" placeholder="<?php echo e($txt); ?>" max="100" value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:''); ?>" class="form-control line-amount" <?php echo e($read); ?> style="width:8em;">
			<input type="hidden" id="hidamt_<?php echo e($i); ?>" name="actual_amount[]" value="<?php echo e(($row->is_edit=='E')?$row->asgn_amount:$row->balance_amount); ?>">
			<?php if($type=='CUSTOMER'): ?>
			<input type="hidden" id="sinvoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($row->voucher_type_id); ?>">
			<?php else: ?>
			<input type="hidden" id="sinvoiceid_<?php echo e($i); ?>" name="purchase_invoice_id[]" value="<?php echo e($row->voucher_type_id); ?>">
			<?php endif; ?>
			<input type="hidden" name="bill_type[]" id="billtype_<?php echo e($i); ?>" value="<?php echo e($row->voucher_type); ?>"> 
			</td>
			<td><?php echo e(number_format($row->balance_amount,2)); ?></td>
			
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<input type="hidden" name="num" id="bnum" value="<?php echo e($no); ?>">
</div>

<script>
$(document).ready(function () {
	$(function() {
		var dtInstance = $("#tableRV0").DataTable({
			"lengthMenu": [10, 25, 50, "ALL"],
			bLengthChange: false,
			mark: true,
			"aoColumns": [null,null,null,null,null,null,null,null],
			"aaSorting": [],
			//"scrollX": true,
			"scrollY":        500,
			"deferRender":    true,
			"scroller":       true,
		});
	
	});
});
</script>