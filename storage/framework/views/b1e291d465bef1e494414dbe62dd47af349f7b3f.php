

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/iCheck/css/all.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/formelements.css')); ?>">
        <!--end of page level css-->
		<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>" media="all" />
    
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
	
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
	<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		  -webkit-appearance: none; 
		  margin: 0; 
		}

	</style>
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Customer Enquiry
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="fa fa-fw fa-briefcase"></i> Inventory
                    </a>
                </li>
                <li>
                    <a href="#">Customer Enquiry</a>
                </li>
                <li class="active">
                    Add
                </li>
            </ol>
        </section>
        <!--section ends-->
		
		<?php if(count($errors) > 0): ?>
			<div class="alert alert-danger">
				<ul>
					<?php foreach($errors->all() as $error): ?>
						<li><?php echo e($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-crosshairs"></i> View Docment
                            </h3>
							
							<div class="pull-right">
						
							</div>
                        </div>
                        <div class="panel-body">
							<div class="controls"> 
                            <form class="form-horizontal" role="form" method="POST" name="frmPurorder" id="frmPurorder" action="<?php echo e(url('customer_enquiry/update/'.$orderrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="quotation_order_id" id="quotation_order_id" value="<?php echo e($orderrow->id); ?>">
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">QS. No.</label>
                                    <div class="col-sm-10">
										<?php if($orderrow->prefix!='') { ?>
										<div class="input-group">
											<span class="input-group-addon"><?php echo e($orderrow->prefix); ?></span>
											<input type="text" class="form-control" id="voucher_no" readonly name="voucher_no" value="<?php echo e($orderrow->voucher_no); ?>">
											<input type="hidden" value="<?php echo e($orderrow->prefix); ?>" name="prefix">
										</div>
										<?php } else { ?>
											<input type="text" class="form-control" id="voucher_no" readonly name="voucher_no" value="<?php echo e($orderrow->voucher_no); ?>">
											<input type="hidden" value="<?php echo e($orderrow->prefix); ?>" name="prefix">
										<?php } ?>
                                    </div>
                                </div>
								
								<?php if($formdata['reference_no']==1) { ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label  <?php if($errors->has('reference_no')) echo 'form-error';?>">Reference No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control <?php if($errors->has('reference_no')) echo 'form-error';?>" id="reference_no" readonly  name="reference_no" value="<?php echo (old('reference_no'))?old('reference_no'):$orderrow->reference_no; ?>" placeholder="Reference No.">
                                    </div>
                                </div>
								<?php } else { ?>
									<input type="hidden" name="reference_no" id="reference_no">
								<?php } ?>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">QS. Date</label>
                                    <div class="col-sm-10">
										<input type="text" class="form-control pull-right" name="voucher_date" data-language='en' readonly value="<?php echo e(date('d-m-Y',strtotime($orderrow->voucher_date))); ?>" id="voucher_date" placeholder="QS. Date"/>
                                    </div>
                                </div>
								
								<div class="form-group">
                                     <font color="#16A085"><label for="input-text" class="col-sm-2 control-label <?php if($errors->has('customer_name')) echo 'form-error';?>"><b>Customer</b></label></font>
                                    <div class="col-sm-10">
                                        <input type="text" name="customer_name" id="customer_name" value="<?php echo (old('customer_name'))?old('customer_name'):$orderrow->customer; ?>" class="form-control <?php if($errors->has('customer_name')) echo 'form-error';?>" autocomplete="off" data-toggle="modal" data-target="#customer_modal" readonly>
										<input type="hidden" name="customer_id" id="customer_id" value="<?php echo (old('customer_id'))?old('customer_id'):$orderrow->customer_id; ?>">
									</div>
                                </div>
								
								
							
								
								
								
								
								
								
								
								
							
									
								<div class="form-group">
									<label for="input-text" class="col-sm-2 control-label">Document</label>
									<div class="col-sm-9">
									<?php if($photos!='') { $arrp = explode(',',$photos); $i=1; ?>
										<?php foreach($arrp as $prow): ?>
										<div class="file-preview">
											
											<div class="file-drop-disabled">
												<div class="file-preview-thumbnails">
													<div class="file-live-thumbs">
														<a href="<?php echo e(asset('uploads/joborder/'.$prow)); ?>" target="_blank">View Image <?php echo e($i); ?></a>
													</div>
												</div>
												<div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
												<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
											</div>
										</div>
										<?php $i++; ?>
										<?php endforeach; ?>
									<?php } ?>
											</div>
								</div>
						
								
								<br/>
								<fieldset>
							
                   
							
					
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        
										<a href="<?php echo e(url('customer_enquiry')); ?>" class="btn btn-danger">Back</a>
									
										
                                    </div>
                                </div>
                        
							
						
							
						
							
					
							
						

							
                            </form>
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

<script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.fileupload.js')); ?>"></script>
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
<script>
"use strict";


$(function() {	

$('#input-23').fileupload({
   dataType: 'json',
   add: function (e, data) {
       $('#loading').text('Uploading...');
       data.submit();
   },
   done: function (e, data) {
       var pn = $('#photo_name').val();
       $('#photo_name').val( (pn=='')?data.result.file_name:pn+','+data.result.file_name );
       $('#loading').text('Completed.');
   }
});


$(document).on('click', '.removeP', function(e) {  
   var con = confirm('Are you sure to remove this image?');
   if(con) {
       var fnames = $('#photo_name').val().replace($(this).attr("data-val"),'');
       $('#photo_name').val(fnames);
       
       var rp = $('#rem_photo_name').val();
       $('#rem_photo_name').val( (rp=='')?$(this).attr("data-val"):rp+','+$(this).attr("data-val") );
       
       $(this).parents('.file-preview').remove();
   }
});
   
});


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>