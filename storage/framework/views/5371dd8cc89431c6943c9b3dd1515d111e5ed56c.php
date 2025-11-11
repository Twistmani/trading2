

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
	
	<link href="<?php echo e(asset('assets/vendors/daterangepicker/css/daterangepicker.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datedropper/datedropper.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/jquerydaterangepicker/css/daterangepicker.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/clockpicker/css/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Form Settings
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Administration
                </li>
				<li>
                    <a href="#">Form Settings</a>
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
					
					<div class="tab-content m-t-10">
                        <div id="tab1" class="tab-pane fade active in">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><i class="fa fa-fw fa-crosshairs"></i><?php echo e($forms[0]->name); ?></h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" role="form" method="POST" name="frmDesign" id="frmDesign" action="<?php echo e(url('forms/update/')); ?>">
											<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
											<input type="hidden" name="form_id" value="<?php echo e($forms[0]->form_id); ?>">
										   <table id="user" class="table table-bordered table-striped m-t-8">
											<thead>
												<th>Field Name</th>
												<th>Display Name</th>
												<th>Display Order</th>
												<th>Show/Hide</th>
											</thead>
												<tbody>
												<?php foreach($forms as $row): ?>
												<?php if($row->active==1): ?>
													<?php /**/ $chk = "checked";
													/**/ ?>
													<?php else: ?>
													<?php /**/ $chk = "";
													/**/ ?>	
												<?php endif; ?>
												<tr>
													<td class="table_simple"><?php echo e($row->field_name); ?></td>
													<td class="table_simple"><input type="text" class="form-control" id="field_name" value="<?php echo e($row->field_name); ?>" name="field_name[<?php echo e($row->id); ?>]" autocomplete="off"></td>
													<td class="table_simple"><input type="number" class="form-control" style="width:50px;" id="list_ord" value="<?php echo e($row->list_ord); ?>" name="list_ord[<?php echo e($row->id); ?>]" autocomplete="off"></td>
													<td class="table_superuser">
														<label class="radio-inline iradio">
														<input type="checkbox" class="custom_icheck" id="para_name" name="para_name[<?php echo e($row->id); ?>]" <?php echo e($chk); ?>> 
													</label>
													</td>
												</tr>
												<?php endforeach; ?>
												</tbody>
											</table>
											<div class="form-group">
												<label for="input-text" class="col-sm-2 control-label"></label>
												<div class="col-sm-10">
													<button type="submit" class="btn btn-primary" tabindex="13">Submit</button>
													<a href="<?php echo e(url('forms')); ?>" class="btn btn-danger">Cancel</a>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
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

<!-- date-range-picker -->
<script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/jquery.inputmask.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.date.extensions.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.extensions.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/vendors/daterangepicker/js/daterangepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datedropper/datedropper.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/timedropper/js/timedropper.js')); ?>" type="text/javascript"></script>
<!--<script src="<?php echo e(asset('assets/js/custom_js/datepickers.js')); ?>" type="text/javascript"></script>-->

<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/jquery.dataTables.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.bootstrap.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.colReorder.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.responsive.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.rowReorder.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.colVis.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.html5.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.bootstrap.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/buttons.print.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.scroller.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendors/mark.js/jquery.mark.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/js/custom_js/responsive_datatables.js')); ?>" type="text/javascript"></script>
<!-- bootstrap time picker -->


<script>
"use strict";

$(document).ready(function () {
	
});
	

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>