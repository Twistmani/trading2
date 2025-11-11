<table class="table horizontal_table" id="batchTable">
    <thead>
    <tr>
        <th>
            <input type="hidden" id="bthSel" value="<?php echo e($batch); ?>">
	        <input type="hidden" id="qtySel" value="<?php echo e($bqty); ?>">
	   </th>
        <th>Batch No</th>
        <th>Mfg. Date</th>
        <th>Exp. Date</th>
        <th>Qty. <input type="hidden" id="row_no" value="<?php echo e($no); ?>"></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($items as $key => $item): ?>
    <tr>
        <td><input type="checkbox" name="batchid[]" id="chk_<?php echo e($item->id); ?>" class="chk-batch" value="<?php echo e($item->id); ?>" <?php echo e(isset($batchdat[$item->id])?'checked':''); ?>/></td>
        <td class="btno"><?php echo e($item->batch_no); ?></td>
        <td class="mfdt"><?php echo e(date('d-m-Y',strtotime($item->mfg_date))); ?></td>
        <td class="exdt"><?php echo e(date('d-m-Y',strtotime($item->exp_date))); ?></td>
        <td class="bqty"><?php echo e($item->quantity); ?></td>
        <td class="del"><input type="text" size="4" id="bthqty_<?php echo e($item->id); ?>" class='req-bqty' autocomplete="off" name="bth-qty" <?php echo e(isset($batchdat[$item->id])?'':'disabled'); ?> data-qty="<?php echo e($item->quantity); ?>" data-id="<?php echo e($item->id); ?>" value="<?php echo e(isset($batchdat[$item->id])?$batchdat[$item->id]:''); ?>">
            <?php if($act=='edit'): ?><input type="hidden" value="<?php echo e(isset($batchdat[$item->id])?$batchdat[$item->id]:''); ?>"><?php endif; ?>
        </td> 
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script>
/*
$(document).on('change', '.chk-batch', function(e) {  
    
    if( $(this).is(":checked") ) { 
    	
    	$('#bthqty_'+$(this).val().toString()).prop("disabled", false);
    } else {
        
    	$('#bthqty_'+$(this).val().toString()).prop("disabled", true);
    }

});*/

$(document).on('blur', '.req-bqty', function(e) { 
    e.preventDefault();
    
    if( parseFloat(this.value) > parseFloat($(this).data('qty')) ) {
        alert('Quantity outof stock!');
        $('#bthqty_'+$(this).data('id')).val('');
        return false;
        
    } 
 });
 
/*var bids = []; var rqty = [];

<?php foreach($batchdat as $bdat => $bqty): ?>
    bids.push(<?php echo e($bdat); ?>);
    rqty.push(<?php echo e($bqty); ?>);
<?php endforeach; ?>


var flag1 = false; var flag2 = false;
$(document).on('change', '.chk-batch', function(e) {  
    
    console.log('1bid ar '+ bids)
    console.log('1rqty ar '+ bids)
    if( $(this).is(":checked") ) { 
		
		$('#bthqty_'+$(this).val().toString()).prop("disabled", false);
	} else {
	    
		$('#bthqty_'+$(this).val().toString()).prop("disabled", true);
		var a = bids.indexOf($(this).val());  console.log('val1 '+$(this).val()); 
		//removeA(bids, $(this).val()); 
		bids.splice(a,1);
		rqty.splice(a,1);
		$('#bthqty_'+$(this).val()).val('');
	}
	
	$('#bthSel').val(bids);
    $('#qtySel').val(rqty);
	//console.log('2bid is '+ bids)
 });

$(document).on('blur', '.req-bqty', function(e) { 
    e.preventDefault();
    
    if( parseFloat(this.value) > parseFloat($(this).data('qty')) ) {
        alert('Quantity outof stock!');
        $('#bthqty_'+$(this).data('id')).val('');
        return false;
        
    } else {
    
    	var res = this.id.split('_');
    	var cn = res[1];
    	if($('#chk_'+cn).is(":checked")) {
    	    
    	    if(!bids.includes($('#chk_'+cn).val())) {
              bids.push($('#chk_'+cn).val());
              rqty.push( $('#bthqty_'+cn).val() );
    		  flag2 = true;
            }

    	} else {
    		var a = bids.indexOf($(this).val()); 
    		removeA(bids, $(this).val());
    		rqty.splice(a,1);
    	} 
    	$('#bthSel').val(bids);
    	$('#qtySel').val(rqty);
    }
 });
	 
 function removeA(arr) {
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
}*/
</script>