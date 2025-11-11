

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
                <li class="active">
                    Edit User
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-crosshairs"></i> Edit User 
                            </h3>
                           
                        </div>
                        <div class="panel-body">
							<?php echo Form::model(['method' => 'PATCH','route' => ['users.update', $user->id]]); ?>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Name:</strong>
										<?php echo Form::text('name', $user->name, array('placeholder' => 'Name','class' => 'form-control')); ?>

									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Email:</strong>
										<?php echo Form::text('email',  $user->email, array('placeholder' => 'Email','class' => 'form-control')); ?>

									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Password:</strong>
										<?php echo Form::password('password', array('placeholder' => 'Password','class' => 'form-control')); ?>

									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Confirm Password:</strong>
										<?php echo Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')); ?>

									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Role:</strong>
										<?php echo Form::select('roles[]', $roles,$userRole, array('class' => 'form-control')); ?>

									</div>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Department:</strong>
										<select id="roles" class="form-control select2" style="width:100%" name="department_id">
                                            <option value="">Department None</option>
											<?php foreach($depts as $row): ?>
											<option value="<?php echo e($row->id); ?>" <?php echo ($user->department_id==$row->id)?'selected':'';?>><?php echo e($row->name); ?></option>
											<?php endforeach; ?>
                                        </select>
									</div>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">
										<strong>Location:</strong>
										<select id="roles" class="form-control select2" style="width:100%" name="location_id">
                                            <option value="">All Location</option>
											<?php foreach($loc as $row): ?>
											<option value="<?php echo e($row->id); ?>" <?php echo ($user->location_id==$row->id)?'selected':'';?>><?php echo e($row->name); ?></option>
											<?php endforeach; ?>
                                        </select>
									</div>
								</div>
								
								<div class="col-xs-12 col-sm-12 col-md-12 text-center">
										<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
							<?php echo Form::close(); ?>

							<!--</form>-->
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/custom_js/form_elements.js')); ?>"></script>
        <!-- end of page level js -->

<script>
"use strict";

$(document).ready(function () {
	var url = "<?php echo e(url('unit/checkname/')); ?>";
    $('#frmUnit').bootstrapValidator({
        fields: {
            unit_name: {
                validators: {
                    notEmpty: {
                        message: 'The unit name is required and cannot be empty!'
                    },
					remote: {
                        url: url,
                        data: function(validator) {
                            return {
                                unit_name: validator.getFieldElements('unit_name').val()
                            };
                        },
                        message: 'The unit name is not available'
                    }
                }
            }
          
        }
        
    }).on('reset', function (event) {
        $('#frmUnit').data('bootstrapValidator').resetForm();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>