

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/iCheck/css/all.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/formelements.css')); ?>">
        <!--end of page level css-->
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Location Transfer
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-briefcase"></i> Inventory
                    </a>
                </li>
                <li>
                    <a href="#">Location to Location</a>
                </li>
                
            </ol>
			
        </section>
		
        <!--section ends-->
		<?php if(Session::has('message')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('message')); ?></p>
		</div>
		<?php endif; ?>
		
        <section class="content">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-list-alt"></i> Location Transfer List
                        </h3>
                        <div class="pull-right">
							<?php if (\Entrust::can(('loc-tran-create'))) : ?>
                             <a href="<?php echo e(url('location_transfer/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
							<?php endif; // Entrust::can ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableLocation">
                                    <thead>
                                    <tr>
										<th>LT. No</th>
										<th>Date</th>
                                        <th>Location From</th>
										<th>Location To</th>
										<th></th>
										<th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($locationtrans as $location): ?>
                                    <tr>
                                        <td><?php echo e($location->voucher_no); ?></td>
										<td><?php echo e(date('d-m-Y',strtotime($location->voucher_date))); ?></td>
										<td><?php echo e($location->locfrom); ?></td>
										<td><?php echo e($location->locto); ?></td>
										<td>
											<?php if (\Entrust::can(('loc-tran-edit'))) : ?><p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('location_transfer/edit/'.$location->id)); ?>'">
												<span class="glyphicon glyphicon-pencil"></span></button>
											</p><?php endif; // Entrust::can ?>
										</td>
										<td>
											<?php if (\Entrust::can(('loc-tran-delete'))) : ?><p>
												<button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($location->id); ?>')"><span
															class="glyphicon glyphicon-trash"></span></button>
											</p>
											<?php endif; // Entrust::can ?>
										</td>
										<td>
											<p><a href="<?php echo e(url('location_transfer/print/'.$location->id)); ?>" class="btn btn-primary btn-xs" target="_blank"><span class="fa fa-fw fa-print"></span></a></p>
										</td>
                                    </tr>
									<?php endforeach; ?>
                                    <?php if(count($locationtrans) === 0): ?>
									</tbody>
									<tbody><tr class="odd danger"><td valign="top" colspan="6" class="dataTables_empty">No matching records found</td></tr></tbody>
									<?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
              
            <!--main content-->
            <!-- row -->
        <?php echo $__env->make('layouts.right_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- right side bar end -->
        </section>
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>
    <!-- begining of page level js -->
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<!-- end of page level js -->
<script>

function funDelete(id) {
	var con = confirm('Are you sure delete this location transfer?');
	if(con==true) {
		var url = "<?php echo e(url('location_transfer/delete/')); ?>";
	 location.href = url+'/'+id;
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>