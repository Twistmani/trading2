<br/>
<?php $num = $num - 1;?>
<div class="col-xs-4">
    <?php if(sizeof($itemunits) > 1 && isset($itemunits[1])): ?>
		<?php /**/ $packing = $itemunits[1]->packing;
			   $base = $itemunits[0]->packing;
			   $sub = $itemunits[1]->unit_name;
			   $sub = ' '.$sub.' =';
			   $pkno = $itemunits[1]->pkno;
		/**/ ?>
	<?php else: ?>
		<?php /**/ $pkno = $packing = $item_unit_id = $base = $sub = ''; /**/ ?>
	<?php endif; ?>
	
	<?php if(sizeof($itemunits) > 2): ?>
		<?php /**/ $packing2 = $itemunits[2]->packing;
			   $pkno2 = $itemunits[2]->pkno;
			   $sub2 = $itemunits[2]->unit_name;
		/**/ ?>
	<?php else: ?>
		<?php /**/ $packing2 = $sub2 = ''; /**/ ?>
	<?php endif; ?>

	<div>** <?php if($munits[0]->active==1): ?><?php echo e($pkno); ?> <?php echo e($sub); ?> <?php echo e($packing); ?> <?php echo e($base); ?>,<?php endif; ?> <?php if($munits[1]->active==1): ?><?php echo e($pkno2); ?> <?php echo e($sub2); ?> = <?php echo e($packing2); ?> <?php echo e($base); ?><?php endif; ?></div>									
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Location</th>
			<th>Stock</th>
			<th>Quantity</th>
			<th>Bin1</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach($info as $row): ?>
		<tr>
			<td><?php echo e($row->name); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td class="num"><input type="number" name="locqty[<?php echo e($num); ?>][]" class="loc-qty-<?php echo e($num+1); ?>" data-id="<?php echo e($num+1); ?>" data-qty="<?php echo e($row->quantity); ?>" value="<?php echo e(isset($row->qty_entry)?$row->qty_entry:''); ?>">
			<input type="hidden" class="loc-id" name="locid[<?php echo e($num); ?>][]" value="<?php echo e($row->id); ?>"/>
			<input type="hidden" class="loc-bin" name="locbn[<?php echo e($num); ?>][]" value="<?php echo e($row->bin); ?>"/>
			<input type="hidden" class="loc-nam" name="locnm[<?php echo e($num); ?>][]" value="<?php echo e($row->code); ?>"/>
			</td>
			<td><?php echo e($row->bin); ?></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>