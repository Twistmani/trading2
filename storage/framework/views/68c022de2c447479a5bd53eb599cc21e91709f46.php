

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    
	<!--page level css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
    <!--end of page level css-->
		
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Account Settings
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Administration
                </li>
				<li>
                    <a href="#">Account Settings</a>
                </li>
            </ol>
        </section>
        <!--section ends-->
		<?php if(Session::has('message')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('message')); ?></p>
		</div>
		<?php endif; ?>
        
		<?php if(Session::has('error')): ?>
		<div class="alert alert-danger">
			<p><?php echo e(Session::get('error')); ?></p>
		</div>
		<?php endif; ?>
		
		<section class="content">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-list-alt"></i> Account Setting
                        </h3>
                        <div class="pull-right">
                             <a href="<?php echo e(url('account_setting/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
                        </div>
                    </div>
                    <div class="panel-body">
						
                        <div class="table-responsive m-t-10">
                                <table class="table horizontal_table table-striped" id="tableAcsettings">
                                    <thead>
                                    <tr>
										<th>Voucher Type</th>
										<th>Voucher Name</th>
										<th>Department</th>
										<th>Dr A/c. Name</th>
										<th>Cr A/c. Name</th>
										<th></th><th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
										<?php foreach($accsettings as $setting): ?>
										<tr>
											<td><?php echo e($setting->type_name); ?></td>
											<td><?php echo e($setting->voucher_name); ?></td>
											<td><?php echo e($setting->department); ?></td>
											<td><?php echo e($setting->dr_master_name); ?></td>
											<td><?php echo e($setting->cr_master_name); ?></td>
											<td>
												<p><button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('account_setting/edit/'.$setting->id)); ?>'"><span class="glyphicon glyphicon-pencil"></span></button></p>
											</td>
											<td>
												<p><button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($setting->id); ?>','<?php echo e($setting->voucher_type_id); ?>')"><span class="glyphicon glyphicon-trash"></span></button></p>
											</td>
										</tr>
										<?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
		</section>
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>

    <!-- begining of page level js -->

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
<!-- end of page level js -->

<script>

function funDelete(id,type) {
	var con = confirm('Are you sure delete this account voucher?');
	if(con==true) {
		var url = "<?php echo e(url('account_setting/delete/')); ?>";
	 location.href = url+'/'+id+'/'+type;
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>