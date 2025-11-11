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
                Location
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Location</a>
                </li>
                <li class="active">
                    Edit
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
                                <i class="fa fa-fw fa-crosshairs"></i> Edit Location 
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                    <i class="fa fa-fw fa-times removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmLocation" id="frmLocation" action="<?php echo e(url('location/update/'.$locationrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="location_id" value="<?php echo $locationrow->id; ?>">
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Location Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" name="code" value="<?php echo e($locationrow->code); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Location Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($locationrow->name); ?>">
                                    </div>
                                </div>
                                
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Default</label>
											<?php if($locationrow->is_default==0): ?>
											<?php /**/ $chk1 = "checked";
													$chk2 = "";
											/**/ ?>
											<?php else: ?>
											<?php /**/ $chk2 = "checked";
													$chk1 = "";
											/**/ ?>	
											<?php endif; ?>
									<div class="col-sm-10">
                                        <label class="radio-inline iradio">
                                            <input type="radio" id="inlineradio1" name="default" value="0" <?php echo e($chk1); ?>>
                                            No
                                        </label>
                                        <label class="radio-inline iradio">
                                            <input type="radio" id="inlineradio2" name="default" value="1" <?php echo e($chk2); ?>>
                                            Yes
                                        </label>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Consignment Location</label>
											<?php if($locationrow->is_conloc==0): ?>
											<?php /**/ $chk1 = "checked";
													$chk2 = "";
											/**/ ?>
											<?php else: ?>
											<?php /**/ $chk2 = "checked";
													$chk1 = "";
											/**/ ?>	
											<?php endif; ?>
									<div class="col-sm-10">
                                        <label class="radio-inline iradio">
                                            <input type="radio" id="inlineradio1" name="is_conloc" value="0" <?php echo e($chk1); ?>>
                                            No
                                        </label>
                                        <label class="radio-inline iradio">
                                            <input type="radio" id="inlineradio2" name="is_conloc" value="1" <?php echo e($chk2); ?>>
                                            Yes
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Customer Name</label>
                                    <div class="col-sm-10">
                                        <select name="customer_id" class="form-control">
                                            <option value="">Select Customer for Consignment Location</option>
                                            <?php foreach($customers as $row): ?>
                                            <option value="<?php echo e($row->id); ?>" <?php echo e(($locationrow->customer_id==$row->id)?'selected':''); ?>><?php echo e($row->master_name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                         <a href="<?php echo e(url('location')); ?>" class="btn btn-danger">Cancel</a>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/custom_js/form_elements.js')); ?>"></script>
        <!-- end of page level js -->

<script>
"use strict";

$(document).ready(function () {
	var urlcode = "<?php echo e(url('location/checkcode/')); ?>";
	var urlname = "<?php echo e(url('location/checkname/')); ?>";
    $('#frmLocation').bootstrapValidator({
        fields: {
            code: {
                validators: {
                    notEmpty: {
                        message: 'The location code is required and cannot be empty!'
                    },
					remote: {
                        url: urlcode,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('code').val(),
								id: validator.getFieldElements('location_id').val()
                            };
                        },
                        message: 'The location code is not available'
                    }
                }
            },
			name: {
                validators: {
                    notEmpty: {
                        message: 'The location name is required and cannot be empty!'
                    },
					remote: {
                        url: urlname,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('name').val(),
								id: validator.getFieldElements('location_id').val(),
                            };
                        },
                        message: 'The location name is not available'
                    }
                }
            }
          
        }
        
    }).on('reset', function (event) {
        $('#frmLocation').data('bootstrapValidator').resetForm();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>