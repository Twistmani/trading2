

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
                Year Ending Wizard
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-shield"></i> Administration
                    </a>
                </li>
                <li>
                    <a href="#">Year Ending Wizard</a>
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
					
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        <i class="fa fa-fw fa-folder"></i> Backup Created
                                    </h3>
                                    <span class="pull-right">
										<i class="fa fa-fw fa-chevron-up clickable"></i>
										<i class="fa fa-fw fa-times removepanel clickable"></i>

									</span>
                                </div>
							<div class="panel-body">
								<form role="form" class="form-horizontal" method="POST" name="frmBackup" id="frmBackup" action="<?php echo e(url('year_ending/backup')); ?>">
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								
									<div class="alert alert-success">
											<p>Database clone has been generaed successfully. Click 'Next' to proceed.</p>
										</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-2 control-label"></label>
										<div class="col-sm-10">
											<a href="<?php echo e(url('year_ending/step2')); ?>" class="btn btn-danger">Next</a>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<!-- end of page level js -->
<script>

function downloadDB() {
	document.frmBackup.action="<?php echo e(url('backup/submit')); ?>";
	document.frmBackup.submit();
}



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>