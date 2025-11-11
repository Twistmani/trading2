

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
                Salesman
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Salesman</a>
                </li>
                <li class="active">
                    Add New
                </li>
            </ol>
        </section>
        <?php if(Session::has('message')): ?>
        <div class="alert alert-success">
            <p><?php echo e(Session::get('message')); ?></p>
        </div>
        <?php endif; ?>
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-crosshairs"></i> New Salesman 
                            </h3>
                           
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmSalesman" id="frmSalesman" action="<?php echo e(url('salesman/save')); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Salesman ID</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="salesman_id" name="salesman_id" placeholder="Salesman ID">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Salesman Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Salesman Name">
                                    </div>
                                </div>
                                
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Address1</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Address1">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Address2</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Address2">
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Contact No</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Contact No">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="<?php echo e(url('salesman')); ?>" class="btn btn-danger">Cancel</a>
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
	var urlcode = "<?php echo e(url('salesman/checkid/')); ?>";
	var urlname = "<?php echo e(url('salesman/checkname/')); ?>";
    $('#frmSalesman').bootstrapValidator({
        fields: {
            salesman_id: {
                validators: {
                    notEmpty: {
                        message: 'The salesman id is required and cannot be empty!'
                    },
					remote: {
                        url: urlcode,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('salesman_id').val()
                            };
                        },
                        message: 'The salesman id is not available'
                    }
                }
            },
			name: {
                validators: {
                    notEmpty: {
                        message: 'The salesman name is required and cannot be empty!'
                    },
					/* remote: {
                        url: urlname,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('name').val()
                            };
                        },
                        message: 'The salesman name is not available'
                    } */
                }
            }
          
        }
        
    }).on('reset', function (event) {
        $('#frmSalesman').data('bootstrapValidator').resetForm();
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>