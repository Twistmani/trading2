

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
                Role
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                       <i class="fa fa-fw fa-key"></i> Role Management
                    </a>
                </li>
                <li>
                    <a href="#">Role</a>
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
                            <i class="fa fa-fw fa-list-alt"></i> Role List
                        </h3>
                        <div class="pull-right">
                            <!--<a href="<?php echo e(url('user/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>-->
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableJobmaster">
                                    <thead>
                                    <tr>
                                        <th>No</th>
										<th>Name</th>
										<th>Description</th>
										<th>View Permission</th>
										<th></th>
										<th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($roles as $role): ?>
                                    <tr>
                                        <td><?php echo e(++$i); ?></td>
										<td><?php echo e($role->display_name); ?></td>
										<td><?php echo e($role->description); ?></td>
										<td>
												<a class="btn btn-warning btn-labeled" role="button" href="<?php echo e(url('permission/edit/'.$role->id)); ?>">
                                                <span class="btn-label">
                                                <i class="fa fa-fw fa-wrench"></i>
                                            </span> Permission
                                        </a>
											
										</td>
										<td>
											<!--<p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('user/edit/'.$role->id)); ?>'">
												<span class="glyphicon glyphicon-pencil"></span></button>
											</p>-->
										</td>
										<td>
											<!--<p>
												<button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($role->id); ?>')"><span
															class="glyphicon glyphicon-trash"></span></button>
											</p>-->
										</td>
                                    </tr>
									<?php endforeach; ?>
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
	var con = confirm('Are you sure delete this user?');
	if(con==true) {
		var url = "<?php echo e(url('user/delete/')); ?>";
	 location.href = url+'/'+id;
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>