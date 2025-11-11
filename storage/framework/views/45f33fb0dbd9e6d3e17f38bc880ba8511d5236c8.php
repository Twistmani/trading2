<div class="col-xs-10">
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Item Code</th>
			<th>Description</th>
			<th>Wastage Qty.</th>
			<th style="width:45%">Cost/Unit</th>
            <th style="width:45%">Total</th>
		</tr>
		</thead>
		<tbody>
         <?php  $i=0;  ?>   
		<?php foreach($info as $row): ?>
        <?php  $i++;  ?>
		<tr>
			<td><?php echo e($row->item_code); ?> <input type="hidden" name="weitem[]" value="<?php echo e($row->subitem_id); ?>"></td>
			<td><?php echo e($row->description); ?></td>
			<td><input type="text" name="wqty[]" id="wqty_<?php echo e($i); ?>" class="we-qty"></td>
			<td><?php echo e(number_format($row->unit_price,2)); ?><input type="hidden" name="uprice[]" id="uprice_<?php echo e($i); ?>" value="<?php echo e(number_format($row->unit_price,2)); ?>"></td>
            <td><input type="text" name="weqtytot[]" id="wqtytot_<?php echo e($i); ?>"></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<script>
$(document).on('keyup', '.we-qty', function(e) {
	var res = this.id.split('_');
	var curNum = res[1]; //console.log(curNum);
    var qty = parseFloat( ($('#wqty_'+curNum).val()=='')?0:$('#wqty_'+curNum).val() );
    var prc = parseFloat( ($('#uprice_'+curNum).val()=='')?0:$('#uprice_'+curNum).val() );
    var cst = qty * prc;
    $('#wqtytot_'+curNum).val(cst.toFixed(2));
});
</script>