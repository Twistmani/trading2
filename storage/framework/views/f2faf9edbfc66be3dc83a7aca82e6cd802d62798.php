<?php if(Session::get('logo')=='') { ?>
	<b style="font-size:20px;"><?php echo e(Session::get('company')); ?></b><br/>
	<b style="font-size:15px;">Ph: <?php echo e(Session::get('phone')); ?>, <?php echo e(Session::get('address')); ?></b>
<?php } else { ?>
	<img src="<?php echo e(asset('assets/'.Session::get('logo').'')); ?>" width="20%" /><br/>
	<b style="font-size:20px;"><?php echo e(Session::get('company')); ?></b><br/>
	<b style="font-size:15px;">Ph: <?php echo e(Session::get('phone')); ?>, <?php echo e(Session::get('address')); ?></b><br/> 
	<!--<span style="font-size:14px;">Ph: <?php echo e(Session::get('phone')); ?>, <?php echo e(Session::get('address')); ?>, TRN No: <?php echo e(Session::get('vatno')); ?></span>-->
<?php } ?>