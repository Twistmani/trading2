

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
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Voucher Numbers
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Administration
                </li>
				<li>
                    <a href="#">Voucher Numbers</a>
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
                <div class="col-md-12">
                    <div class="panel panel-primary">
                         <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-crosshairs"></i>Voucher Numbers Settings
                            </h3>
                        </div>
                        <div class="panel-body">
								<form class="form-horizontal" role="form" method="POST" name="frmVoucherNo" id="frmVoucherNo" action="<?php echo e(url('voucher_numbers/update/')); ?>">
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<?php $i=0;?>
									<?php foreach($vouchers as $row): ?>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label"><?php echo e($row->name); ?></label>
										<div class="col-sm-3">
											<div class="input-group">
											<span class="input-group-addon">Prefix</span><input type="text" name="prefix[]" value="<?php echo e($row->prefix); ?>" class="form-control" autocomplete="off">
											</div>
										</div>
										<div class="col-sm-3">
											<input type="text" name="no[]" value="<?php echo e($row->no); ?>" class="form-control" autocomplete="off">
											<input type="hidden" name="id[]" value="<?php echo e($row->id); ?>">
										</div>
										<div class="col-sm-3">
											<input type="checkbox" name="autoincrement[<?php echo e($i); ?>]" <?php if($row->autoincrement==1) echo 'checked'; ?> value="1">
											<label class="radio-inline iradio">Auto Increment</label>
										</div>
									</div>
									<?php $i++; ?>
									<?php endforeach; ?>
									 <div class="form-group">
										<label for="input-text" class="col-sm-5 control-label"></label>
										<div class="col-sm-4">
											<button type="submit" class="btn btn-primary">Submit</button>
											 <a href="<?php echo e(url('voucher_numbers')); ?>" class="btn btn-danger">Cancel</a>
										</div>
									</div>
									
									<div id="account_modal" class="modal fade animated" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Select Account</h4>
											</div>
											<div class="modal-body" id="account_data">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div> 
								
								</form>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/custom_js/form_elements.js')); ?>"></script>
        <!-- end of page level js -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>