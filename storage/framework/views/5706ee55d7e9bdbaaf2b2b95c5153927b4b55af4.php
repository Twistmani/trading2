

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
                Currency
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Currency</a>
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
                                <i class="fa fa-fw fa-crosshairs"></i> Edit Currency 
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw fa-chevron-up clickable"></i>
                                    <i class="fa fa-fw fa-times removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmCurrency" id="frmCurrency" action="<?php echo e(url('currency/update/'.$currencyrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="currency_id" value="<?php echo $currencyrow->id; ?>">
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Currency Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" name="code" value="<?php echo e($currencyrow->code); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Currency Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($currencyrow->name); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Currency Rate</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="rate" name="rate" placeholder="Currency Rate" value="<?php echo e($currencyrow->rate); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Decimal Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="decimal_name" name="decimal_name" value="<?php echo e($currencyrow->decimal_name); ?>" placeholder="Decimal Name">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Fra Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="fracode" name="fracode" placeholder="Fra Code" value="<?php echo e($currencyrow->fracode); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Decimal Place</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="decimal_place" name="decimal_place" placeholder="Decimal Place" value="<?php echo e($currencyrow->decimal_place); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                         <a href="<?php echo e(url('currency')); ?>" class="btn btn-danger">Cancel</a>
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
	var urlcode = "<?php echo e(url('currency/checkcode/')); ?>";
	var urlname = "<?php echo e(url('currency/checkname/')); ?>";
    $('#frmCurrency').bootstrapValidator({
        fields: {
            code: {
                validators: {
                    notEmpty: {
                        message: 'The currency code is required and cannot be empty!'
                    },
					remote: {
                        url: urlcode,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('code').val(),
								id: validator.getFieldElements('currency_id').val()
                            };
                        },
                        message: 'The currency code is not available'
                    }
                }
            },
			name: {
                validators: {
                    notEmpty: {
                        message: 'The currency name is required and cannot be empty!'
                    },
					remote: {
                        url: urlname,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('name').val(),
								id: validator.getFieldElements('currency_id').val(),
                            };
                        },
                        message: 'The currency name is not available'
                    }
                }
            }
          
        }
        
    }).on('reset', function (event) {
        $('#frmCurrency').data('bootstrapValidator').resetForm();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>