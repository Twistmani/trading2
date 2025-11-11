

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
                Account Group
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="fa fa-fw fa-briefcase"></i> Accounts
                    </a>
                </li>
                <li>
                    <a href="#">Account Group</a>
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
                                <i class="fa fa-fw fa-crosshairs"></i> Edit Group 
                            </h3>
                           
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmCategory" id="frmCategory" action="<?php echo e(url('acgroup/update/'.$catrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="group_id" value="<?php echo $catrow->id; ?>">
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Account Category</label>
                                    <div class="col-sm-10">
                                        <select id="category_id" class="form-control select2" style="width:100%" name="category_id">
											<?php foreach($category as $cat): ?>
											<?php if($catrow->category_id==$cat['id']): ?>
											<?php /**/ $sel = "selected" /**/ ?>
											<?php else: ?>
											<?php /**/ $sel = "" /**/ ?>	
											<?php endif; ?>
											<option value="<?php echo e($cat['id']); ?>" <?php echo e($sel); ?>><?php echo e($cat['name']); ?></option>
											<?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Group Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Group Name" value="<?php echo e($catrow->name); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10">
                                        <select id="category" class="form-control select2" style="width:100%" name="category">
                                            <option value="">Select Category...</option>
											<?php if($typeid==1) { ?>
												<option value="CUSTOMER" <?php if($catrow->category=="CUSTOMER") echo 'selected';?>>Customer</option>
												<option value="PDCR" <?php if($catrow->category=="PDCR") echo 'selected';?>>PDCR</option>
												<option value="CASH" <?php if($catrow->category=="CASH") echo 'selected';?>>Cash</option>
												<option value="BANK" <?php if($catrow->category=="BANK") echo 'selected';?>>Bank</option>
												<option value="FASSET" <?php if($catrow->category=="FASSET") echo 'selected';?>>Fixed Asset</option>
											<?php } else if($typeid==2) { ?>
												<option value="SUPPLIER" <?php if($catrow->category=="SUPPLIER") echo 'selected';?>>Supplier</option>
												<option value="PDCI" <?php if($catrow->category=="PDCI") echo 'selected';?>>PDCI</option>
											<?php } else { ?>
												<option value="">Select Category...</option>
											<?php } ?>
                                        </select>
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
										<a href="<?php echo e(url('acgroup')); ?>" class="btn btn-danger">Cancel</a>
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
	var url = "<?php echo e(url('acgroup/checkname/')); ?>";
    $('#frmCategory').bootstrapValidator({
        fields: {
			actype_id: { validators: { notEmpty: { message: 'The account type is required and cannot be empty!' } }},
			category_id: { validators: { notEmpty: { message: 'The category is required and cannot be empty!' } }},
            name: {
                validators: {
                    notEmpty: {
                        message: 'The group name is required and cannot be empty!'
                    },
					remote: {
                        url: url,
                        data: function(validator) {
                            return {
                                name: validator.getFieldElements('name').val(),
								category_id: validator.getFieldElements('category_id').val(),
								id: validator.getFieldElements('group_id').val()
                            };
                        },
                        message: 'The group name is not available'
                    }
                }
            }
          
        }
     
    }).on('reset', function (event) {
        $('#frmCategory').data('bootstrapValidator').resetForm();
    });
});

$('#category_id').on('change', function(e){
	
	var type_id = e.target.value;

	$.get("<?php echo e(url('accategory/getparent/')); ?>/" + type_id, function(data) {
		console.log(data);
		
		if(data.parent_id==1)
			$('#category').find('option').remove().end().append('<option value="">Select Category...</option><option value="CUSTOMER">Customer</option><option value="PDCR">PDCR</option><option value="CASH">Cash</option><option value="BANK">Bank</option><option value="FASSET">FIXED ASSET</option>');
		else if(data.parent_id==2)
			$('#category').find('option').remove().end().append('<option value="">Select Category...</option><option value="SUPPLIER">Supplier</option><option value="PDCI">PDCI</option>');
		else if(data.parent_id==3)
			$('#category').find('option').remove().end().append('<option value="">Select Category...</option><option value="PROFIT">PROFIT</option>');
		else
			$('#category').find('option').remove().end().append('<option value="">Select Category...</option>');
	
	});
	
	
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>