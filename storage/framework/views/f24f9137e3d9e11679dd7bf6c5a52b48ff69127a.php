

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
                Account Master
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="fa fa-fw fa-briefcase"></i> Accounts
                    </a>
                </li>
                <li>
                    <a href="#">Account Master</a>
                </li>
                <li class="active">
                    View
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-book"></i> View Account Master
                            </h3>
                        </div>
                        <div class="panel-body">
                               
                            <table id="user" class="table table-bordered table-striped m-t-10">
                                <tbody>
                                <tr>
                                    <td class="table_simple">Account Type</td>  <td class="table_superuser"> <?php echo e($masterrow->type_name); ?></td>
                                </tr>
                                <tr>
                                    <td>Account Category</td> <td> <?php echo e($masterrow->category_name); ?></td>
                                </tr>
                                <tr>
                                    <td>Account Group</td> <td><?php echo e($masterrow->group_name); ?> </td>
                                </tr>
                                <tr>
                                    <td>Account ID</td> <td><?php echo e($masterrow->account_id); ?></td>
                                </tr>
                                <tr>
                                    <td>Account Master</td> <td><?php echo e($masterrow->master_name); ?> </td>
                                </tr>
								<tr>
                                    <td>Address</td> <td><?php echo e($masterrow->address); ?> </td>
                                </tr>
								<tr>
                                    <td>City</td> <td><?php echo e($masterrow->city); ?> </td>
                                </tr>
								<tr>
                                    <td>State</td> <td><?php echo e($masterrow->state); ?> </td>
                                </tr>
								<tr>
                                    <td>Area</td> <td> <?php echo e($masterrow->area); ?> </td>
                                </tr>
								<tr>
                                    <td>Country</td> <td><?php echo e($masterrow->country); ?> </td>
                                </tr>
								<tr>
                                    <td>Pin</td> <td><?php echo e($masterrow->pin); ?> </td>
                                </tr>
								<tr>
                                    <td>Phone</td> <td><?php echo e($masterrow->phone); ?> </td>
                                </tr>
								<tr>
                                    <td>Fax</td> <td><?php echo e($masterrow->fax); ?> </td>
                                </tr>
								<tr>
                                    <td>Email</td> <td><?php echo e($masterrow->email); ?> </td>
                                </tr>
								<tr>
                                    <td>TRN No</td> <td><?php echo e($masterrow->vat_no); ?> </td>
                                </tr>
                                <tr>
                                    <td>Open Balanace</td> <td> <?php echo e(number_format($masterrow->op_balance,2,'.',',')); ?> </td>
                                </tr>
                                <tr>
                                    <td>Closing Balance</td> <td> <?php echo e(number_format($masterrow->cl_balance,2,'.',',')); ?></td>
                                </tr>
                                <tr>
                                    <td>Foreign Currency</td> <td> <?php echo e($masterrow->currency); ?></td>
                                </tr>
								<tr>
                                    <td>FC Open Balance</td> <td><?php echo e($masterrow->fcop_balance); ?> </td>
                                </tr>
                                <tr>
                                    <td>Department</td> <td> <?php echo e($masterrow->department); ?> </td>
                                </tr>
								<tr>
                                    <td>Salesman</td> <td><?php echo e($masterrow->salesman); ?> </td>
                                </tr>
                                <tr>
                                    <td>Credit Limit</td> <td> <?php echo e($masterrow->credit_limit); ?> </td>
                                </tr>
								<tr>
                                    <td>Due Days</td> <td><?php echo e($masterrow->duedays); ?> </td>
                                </tr>
                                <tr>
                                    <td>Terms</td> <td> <?php echo e($masterrow->terms); ?> </td>
                                </tr>
								
								<tr>
								<?php if($masterrow->job_assign==0): ?>
									<?php /**/ $chk = "No";
											
									/**/ ?>
									<?php else: ?>
									<?php /**/ $chk = "Yes";
											
									/**/ ?>	
								<?php endif; ?>
                                    <td>Job Assignable?</td> <td><?php echo e($chk); ?> </td>
                                </tr>
                                <tr>
								<?php if($masterrow->job_compulsary==0): ?>
									<?php /**/ $chk = "No";
											
									/**/ ?>
									<?php else: ?>
									<?php /**/ $chk = "Yes";
											
									/**/ ?>	
								<?php endif; ?>
                                    <td>Job Compulsary?</td> <td> <?php echo e($chk); ?> </td>
                                </tr>
								<tr>
								<?php if($masterrow->is_hide==0): ?>
									<?php /**/ $chk = "No";
											
									/**/ ?>
									<?php else: ?>
									<?php /**/ $chk = "Yes";
											
									/**/ ?>	
								<?php endif; ?>
                                    <td>Hide</td> <td><?php echo e($chk); ?> </td>
                                </tr>
								<!--- check permission code here --->
									<!--<tr>
										<td>Created At</td> <td> <?php echo e(date('d-M-Y H:i a', strtotime($masterrow->created_at))); ?> </td>
									</tr>
									<tr>
										<td>Created By</td> <td><?php echo e($masterrow->created_by); ?> </td>
									</tr>
									
									<tr>
									<?php if($masterrow->modified_at!='0000-00-00 00:00:00'): ?>
										<?php /**/ $date = date('d-M-Y H:i a', strtotime($masterrow->modified_at)); /**/ ?>
									<?php else: ?>
									<?php /**/ $date = '--'; /**/ ?>
									<?php endif; ?>
										<td>Modified At</td> <td> <?php echo e($date); ?> </td>
									</tr>
									<tr>
										<td>Modified By</td> <td><?php echo e($masterrow->modify_by); ?> </td>
									</tr>-->
                                <!--- check permission code end --->
								
                                </tbody>
                            </table>
							<div class="col-sm-10">
                               <a href="<?php echo e(url('account_master')); ?>" class="btn btn-danger">Back</a>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/custom_js/form_elements.js')); ?>"></script>
        <!-- end of page level js -->

<script>
"use strict";

$(document).ready(function () {
	var urlcode = "<?php echo e(url('itemmaster/checkcode/')); ?>";
	var urldesc = "<?php echo e(url('itemmaster/checkdesc/')); ?>";
    $('#frmMaster').bootstrapValidator({
        fields: {
			actype_id: { validators: { notEmpty: { message: 'The account type is required and cannot be empty!' } } },
			category_id: { validators: { notEmpty: { message: 'The category name is required and cannot be empty!' } } },
			group_id: { validators: { notEmpty: { message: 'The group name is required and cannot be empty!' } } },
			account_id: { validators: { notEmpty: { message: 'The account id is required and cannot be empty!' } } },
            master_name: { validators: { 
					notEmpty: { message: 'The account master is required and cannot be empty!' },
					/* remote: { url: urlcode,
							  data: function(validator) {
								return { item_code: validator.getFieldElements('item_code').val() };
							  },
							  message: 'The item code is not available'
                    } */
                }
            },
			op_balance: { validators: { notEmpty: { message: 'The open balance is required and cannot be empty!' } } },
          
        }
        
    }).on('reset', function (event) {
        $('#frmMaster').data('bootstrapValidator').resetForm();
    });
});

$('#actype_id').on('change', function(e){
	var type_id = e.target.value;

	$.get("<?php echo e(url('accategory/getcategory/')); ?>/" + type_id, function(data) {
		$('#category_id').empty();
		 $('#category_id').append('<option value="">Select Account Category...</option>');
		$.each(data, function(value, display){
			 $('#category_id').append('<option value="' + display.id + '">' + display.name + '</option>');
		});
	});
});

$('#category_id').on('change', function(e){
	var cat_id = e.target.value;

	$.get("<?php echo e(url('acgroup/getgroup/')); ?>/" + cat_id, function(data) {
		$('#group_id').empty();
		 $('#group_id').append('<option value="">Select Account Group...</option>');
		$.each(data, function(value, display){
			 $('#group_id').append('<option value="' + display.id + '">' + display.name + '</option>');
		});
	});
});

$('#group_id').on('change', function(e){
	var group_id = e.target.value;
	$.get("<?php echo e(url('account_master/getcode/')); ?>/" + group_id, function(data) {
		$('#account_id').val(data);
		//console.log(data);
	});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>