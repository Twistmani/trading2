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
                Users
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-group"></i> User Management
                    </a>
                </li>
                <li>
                    <a href="#">Users</a>
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
                            <i class="fa fa-fw fa-list-alt"></i> Users List
                        </h3>
                        <div class="pull-right">
                             <a href="<?php echo e(url('users/create')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableJobmaster">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th></th>
										<th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($users as $user): ?>
									<?php if(Auth::User()->id != $user->id) { ?>
                                    <tr>
                                        <td><?php echo e($user->name); ?></td>
										<td><?php echo e($user->email); ?></td>
										<td>
											<?php if(!empty($user->roles)): ?>
												<?php foreach($user->roles as $v): ?>
													<label class="label label-success"><?php echo e($v->display_name); ?></label>
												<?php endforeach; ?>
											<?php endif; ?>
										</td>
										<td>
											<p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('users/'.$user->id.'/edit')); ?>'">
												<span class="glyphicon glyphicon-pencil"></span></button>
											</p>
										</td>
										<td>
											<p>
												<button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($user->id); ?>')">
												<span class="glyphicon glyphicon-trash"></span></button>
											</p>
										</td>
                                    </tr>
									<?php } ?>
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
		var url = "<?php echo e(url('users')); ?>"; //url('users/'.$user->id.'/edit')
		location.href = url+'/'+id+'/delete';
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>