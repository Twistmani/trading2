<table class="table horizontal_table" id="batchTable">
    <thead>
    <tr>
        <th>Batch No</th>
        <th>Mfg. Date</th>
        <th>Exp. Date</th>
        <th>Qty. <input type="hidden" id="row_no" value="<?php echo e($no); ?>"> <input type="hidden" id="bth_count" value="<?php echo e(count($batch)); ?>"></th>
        <th><button class="btn btn-success btn-xs funAddBacthRow" data-id="1" data-no="1"><i class="fa fa-fw fa-plus-circle"></i></button><?php if($act=='edit'): ?><input type="hidden" size="2" id="remId" value="<?php echo e($rem); ?>"><?php endif; ?></th>
    </tr>
    </thead>
    <tbody><?php  $i=0;  ?>
    <?php foreach($batch as $key => $val): ?>
    <?php  $i++;  ?>
    <tr>
        <td class="btno"><input type="text" size="10" id="bthno_<?php echo e($i); ?>" class="bno" name="batch_no" value="<?php echo e($val); ?>" autocomplete="off"><?php if($act=='edit'): ?><input type="hidden" size="2" id="bthid_<?php echo e($i); ?>" class="bid" name="batch_id" value="<?php echo e(isset($ids[$key])?$ids[$key]:''); ?>"><?php endif; ?></td>
        <td class="mfdt"><input type="text" size="12" id="bthmfg_<?php echo e($i); ?>" name="mfg_date" data-language='en' class="mfg-date" value="<?php echo e($mdate[$key]); ?>" readonly autocomplete="off"></td>
        <td class="exdt"><input type="text" size="12" id="bthexp_<?php echo e($i); ?>" name="exp_date" data-language='en' class="exp-date" value="<?php echo e($edate[$key]); ?>" readonly autocomplete="off"></td>
        <td class="bqty"><input type="text" size="8" id="bthqty_<?php echo e($i); ?>" name="qty" class="bth-qty" value="<?php echo e($qty[$key]); ?>" autocomplete="off"></td>
        <td class="del"><?php if($i > 1): ?><button class="btn btn-danger btn-xs funRemove" data-id="<?php echo e($i); ?>" data-no="<?php echo e($i); ?>"><i class="fa fa-fw fa-times-circle"></i></button><?php endif; ?></td> 
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
<?php if($act=='edit'): ?>
   $('.mfg-date').datepicker( { autoClose: true,dateFormat: 'dd-mm-yyyy'} );
   $('.exp-date').datepicker( { autoClose: true,dateFormat: 'dd-mm-yyyy'} );
<?php endif; ?>
</script>