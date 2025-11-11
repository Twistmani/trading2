

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
                Data Import
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Data Import
                    </a>
                </li>
                <li>
                    <a href="#"><?php echo e(($type=="items")?'Items':'Accounts'); ?></a>
                </li>
                
            </ol>
        </section>
        <!--section ends-->
		<?php if(Session::has('message')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('message')); ?></p>
		</div>
		<?php endif; ?>
        
		<?php if(Session::has('error')): ?>
		<div class="alert alert-danger">
			<p><?php echo e(Session::get('error')); ?></p>
		</div>
		<?php endif; ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-crosshairs"></i> Import
                            </h3>
                           
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" name="frmImport" id="frmImport" enctype="multipart/form-data" action="<?php echo e(url('importdata/save')); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="type" value="<?php echo e($type); ?>">
								
                                <?php if($type=='accounts') { ?>
								 <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Account Type</label>
                                    <div class="col-sm-10">
                                         <select id="actype" class="form-control select2" required name="actype">
                                            <option value="">Select Account Type...</option>
											<option value="customer">Customer</option>
											<option value="supplier">Supplier</option>
                                        </select>
                                    </div>
                                </div>
                                <?php } else if($type=='accountmaster') { ?>
							<div class="form-group">
                                   <font color="#16A085"><label for="input-text" class="col-sm-2 control-label"><b>Account Type</b></label></font>
                                    <div class="col-sm-10">
                                        <select id="actype_id" class="form-control select2" style="width:100%" name="actype_id">
                                            <option value="">Select Account Type...</option>
											<?php foreach($acctype as $type): ?>
											<?php if($actypid==$type['id']): ?>
											<?php /**/ $sel = "selected" /**/ ?>
											<?php else: ?>
											<?php /**/ $sel = "" /**/ ?>	
											<?php endif; ?>
											<option value="<?php echo e($type['id']); ?>" <?php echo e($sel); ?>><?php echo e($type['name']); ?></option>
											<?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <font color="#16A085"> <label for="input-text" class="col-sm-2 control-label"><b>Account Category</b></label></font>
                                    <div class="col-sm-10">
                                        <select id="category_id" class="form-control select2" style="width:100%" name="category_id">
                                            <option value="">Select Account Category...</option>
											<?php foreach($category as $cat): ?>
											<?php if($catid==$cat['id']): ?>
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
                                    <font color="#16A085"> <label for="input-text" class="col-sm-2 control-label"><b>Account Group</b></label></font>
                                    <div class="col-sm-10">
                                        <select id="group_id" class="form-control select2" style="width:100%" name="group_id">
                                            <option value="">Select Account Group...</option>
											<?php if($catid!='') {?>
											<?php foreach($groups as $group): ?>
											<?php if($gpid==$group['id']): ?>
											<?php /**/ $sel = "selected" /**/ ?>
											<?php else: ?>
											<?php /**/ $sel = "" /**/ ?>	
											<?php endif; ?>
											<option value="<?php echo e($group['id']); ?>" <?php echo e($sel); ?>><?php echo e($group['name']); ?></option>
											<?php endforeach; ?>
											<?php } ?>
                                        </select>
                                    </div>
                                </div>
								<?php } else if($type=='opn-balance') { ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Customer</label>
                                    <div class="col-sm-10">
                                         <select id="account_id" class="form-control select2" required name="account_id">
                                            <option value="">Select Customer...</option>
											<?php if(isset($customers)): ?>
												<?php foreach($customers as $row): ?>
												<option value="<?php echo e($row->id); ?>"><?php echo e($row->master_name); ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } else if($type=='opn-balance-sup') { ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Customer</label>
                                    <div class="col-sm-10">
                                         <select id="account_id" class="form-control select2" required name="account_id">
                                            <option value="">Select Supplier...</option>
											<?php if(isset($suppliers)): ?>
												<?php foreach($suppliers as $row): ?>
												<option value="<?php echo e($row->id); ?>"><?php echo e($row->master_name); ?></option>
												<?php endforeach; ?>
											<?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                
								<?php } ?>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Import File</label>
                                    <div class="col-sm-10">
                                         <input id="input-23" name="import_file" type="file">
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="<?php echo e(url('importdata/items')); ?>" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                                                            
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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
    $('#frmImport').bootstrapValidator({
        fields: {
			import_file: { validators: {
						file: {
							  extension: 'csv,xls,xlsx',
							  //type: 'application/vnd.ms-excel',
							  maxSize: 5*1024*1024,   // 5 MB
							  message: 'The selected file is not valid, it should be (csv,xlsx,xlsx) and 5 MB at maximum.'
						}
					}
			}
        }
        
    }).on('reset', function (event) {
        $('#frmImport').data('bootstrapValidator').resetForm();
    });
});

$(function() {
    
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


});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>