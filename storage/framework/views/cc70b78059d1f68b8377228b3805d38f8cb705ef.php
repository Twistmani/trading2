

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
                Terms
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Terms</a>
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
                                <i class="fa fa-fw fa-crosshairs"></i> New Terms 
                            </h3>
                           
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmTerms" id="frmTerms" enctype="multipart/form-data" action="<?php echo e(url('terms/save')); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Terms Code</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" name="code" placeholder="Terms Code">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label ">Description</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="description" name="description" placeholder="Description">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label filelbl">File Upload</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="userfile" name="userfile" data-show-preview="true">
                                        
                                </div>
                                </div>
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="<?php echo e(url('terms')); ?>" class="btn btn-danger">Cancel</a>
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
	var urlcode = "<?php echo e(url('terms/checkcode/')); ?>";
	var urlname = "<?php echo e(url('terms/checkname/')); ?>";
    $('#frmTerms').bootstrapValidator({
        fields: {
            code: {
                validators: {
                    notEmpty: {
                        message: 'The terms code is required and cannot be empty!'
                    },
					remote: {
                        url: urlcode,
                        data: function(validator) {
                            return {
                                code: validator.getFieldElements('code').val()
                            };
                        },
                        message: 'The terms code is not available'
                    }
                }
            },
			description: {
                validators: {
                    notEmpty: {
                        message: 'The description is required and cannot be empty!'
                    }
                }
            }
          
        }
        
    }).on('reset', function (event) {
        $('#frmTerms').data('bootstrapValidator').resetForm();
    });

  
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>