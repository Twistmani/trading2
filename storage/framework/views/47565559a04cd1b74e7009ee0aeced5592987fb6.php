<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
<!--page level css -->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
<div class="row">
<div class="col-xs-12">
<?php if(count($info)) { ?>
	<table class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Inv.No.</th>
			<th>Date</th>
			<th>Name</th>
			<th>Unit</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
		</thead>
		<tbody>
		
		<?php foreach($info as $row): ?>
		<tr>
			<td><?php echo e($row->voucher_no); ?></td>
			<td><?php echo e(date('d-m-Y', strtotime($row->voucher_date))); ?></td>
			<td><?php echo e($row->master_name); ?></td>
			<td><?php echo e($row->unit_name); ?></td>
			<td><?php echo e($row->quantity); ?></td>
			<td><?php echo e(number_format($row->unit_price,2)); ?></td>
		</tr>
		<?php endforeach; ?>
		
		</tbody>
	</table>
<?php } else { ?>
	No records were found.
<?php } ?>
</div>
</div>
<script src="<?php echo e(asset('assets/js/app.js')); ?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/jquery.dataTables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.bootstrap.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.colReorder.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.responsive.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.rowReorder.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.colVis.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.html5.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.bootstrap.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.print.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.scroller.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendors/mark.js/jquery.mark.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/js/custom_js/responsive_datatables.js')); ?>" type="text/javascript"></script>