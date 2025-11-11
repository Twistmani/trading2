

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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Purchase Voucher
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-retweet"></i> Transaction
                    </a>
                </li>
                <li>
                    <a href="">Vouchers Entry</a>
                </li>
				<li>
                    <a href="#">Purchase Voucher</a>
                </li>
                <li class="active">
                   Edit
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
                        <div class="panel-heading clearfix ">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-crosshairs"></i> Edit Purchase Voucher 
                            </h3>
                           <div class="pull-right">
							
								 <a href="<?php echo e(url('purchase_voucher/print/'.$jrow->id.'/'.$prints[0]->id)); ?>" target="_blank" class="btn btn-info btn-sm">
									<span class="btn-label">
										<i class="fa fa-fw fa-print"></i>
									</span>
								 </a>
								
							</div>
                        </div>
                        <div class="panel-body">
							<div class="controls"> 
                            <form class="form-horizontal" role="form" method="POST" name="frmPurchase Voucher" id="frmPurchase Voucher" action="<?php echo e(url('journal/update/'.$jrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="journal_id" id="journal_id" value="<?php echo e($jrow->id); ?>">
                                <?php if($isdept): ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"><b>Department</b></label>
                                    <div class="col-sm-10">
                                       <select id="department_id" class="form-control select2" style="width:100% ;background-color:#85d3ef;" name="department_id">
											<?php foreach($departments as $drow): ?>
												<option value="<?php echo e($drow->id); ?>" <?php echo e(($jrow->department_id==$drow->id)?'selected':''); ?> ><?php echo e($drow->name); ?></option>
											<?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
								
								<div class="form-group">
									<label for="input-text" class="col-sm-2 control-label">Voucher</label>
									 <div class="col-sm-10">
									   <select id="voucher_id" class="form-control select2" style="width:100%" name="voucher_id">
										   <?php foreach($vouchers as $voucher): ?>
											<option value="<?php echo e($voucher['id']); ?>" <?php echo ($jrow->voucher_id==$voucher['id'])?'selected':'';?>><?php echo e($voucher['voucher_name']); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<?php else: ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Voucher Type</label>
                                    <div class="col-sm-10">
                                        <select id="voucher" class="form-control select2" style="width:100%" name="voucher">
										<?php foreach($vouchertype as $row): ?>
											<option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
										<?php endforeach; ?>
										</select>
										<input type="hidden" name="voucher_type" value="<?php echo e($row['voucher_type_id']); ?>">
                                    </div>
                                </div>
								<?php endif; ?>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">PIN. No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="voucher_no" value="<?php echo e($jrow->voucher_no); ?>" readonly name="voucher_no">
                                    </div>
                                </div>
                                
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">PIN. Date</label>
                                    <div class="col-sm-10">
									<input type="text" class="form-control" name="voucher_date" autocomplete="off" value="<?php echo e(date('d-m-Y', strtotime($jrow->voucher_date))); ?>" data-language='en' id="voucher_date" >
                                    </div>
                                </div>
								
								<br/>
								<fieldset>
								<legend><h5>Transactions</h5></legend>
										<?php /**/ $i = 0; $num = count($jerow); /**/ ?>
										<input type="hidden" id="rowNum" value="<?php echo e($num); ?>">
										<input type="hidden" id="remitem" name="remove_item">
										<div class="itemdivPrnt">
										<?php foreach($jerow as $item): ?>
										<?php /**/ $i++; /**/ ?>
											<div class="itemdivChld">							
												<div class="form-group" style="margin-bottom: 1px;">
													<div class="col-sm-2"> <span class="small">Account Name<!-- acntname_1 --></span>
													<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
													<input type="hidden" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>"><!-- acntid_1 -->
													<input type="hidden" name="group_id[]" value="" id="groupid_<?php echo e($i); ?>">
													<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
													</div>
													<div class="col-xs-15">
														<div class="col-xs-3">
															<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" autocomplete="off" name="description[]" class="form-control">
														</div>
														<div class="col-xs-2" style="width:10%;">
															<span class="small">Reference</span> 
															<div id="refdata_1" class="refdata">
															<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" autocomplete="off" class="form-control">
															</div>
															<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="">
															<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="">
														</div>
														<div class="col-xs-1">
															<span class="small">Type</span> 
															<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
																<option value="Dr" <?php if($item->entry_type=='Dr') echo 'selected'; ?>>Dr</option>
																<option value="Cr" <?php if($item->entry_type=='Cr') echo 'selected'; ?>>Cr</option>
															</select>
														</div>
														<div class="col-xs-2" style="width:15%;">
															<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" autocomplete="off" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control line-amount">
														</div>
														
														<div class="col-sm-2"> 
															<span class="small">Job</span> 
																<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">

														</div>
													
														<div class="col-xs-1"><br/>
															 <button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
																<i class="fa fa-fw fa-minus-square"></i>
															 </button>
															 <?php //if($jrow->group_id!=1) { ?> 
																<button type="button" class="btn-success btn-add-item" >
																	<i class="fa fa-fw fa-plus-square"></i>
																</button>
															<?php //} ?>
														</div>
													</div>	
												</div>
												
												<div class="form-group">
													
													<div class="col-xs-15">
													<input type="hidden" name="department[]" id="dept_1">
														
														<div id="chqdtl_<?php echo e($i); ?>" class="divchq" <?php if($item->category!='PDCR' || $item->category!='PDCI') echo 'style="display: none;"'; ?>>
														
														<div class="col-xs-2">
															<span class="small">Bank</span> 
															<select id="bankid_<?php echo e($i); ?>" class="form-control select2 line-bank" style="width:100%" name="bank_id[]">
															<option value="">Select Bank...</option>
																<?php foreach($banks as $bank): ?>
																<option value="<?php echo e($bank['id']); ?>" <?php if($item->bank_id==$bank['id']) echo 'selected';?>><?php echo e($bank['code'].' - '.$bank['name']); ?></option>
																<?php endforeach; ?>
															</select>
														</div>
														
														<div class="col-sm-2"> 
															<span class="small">Cheque No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" autocomplete="off" name="cheque_no[]" class="form-control" >
															<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
														</div>
														
														<div class="col-xs-2">
															<span class="small">Cheque Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" autocomplete="off" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
														</div>
														
														</div>
													</div>	
												</div>
												
											</div>
										<?php endforeach; ?>
										</div>
								</fieldset>
								
								<hr/>
								<?php if($jrow->group_id==1) { ?>
								<div class="form-group" id="trndtl_1" class="divTrn">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                        <div class="col-sm-5"> 
											<span class="small"><b>Supplier Name</b></span><input type="text" id="supname_1" autocomplete="off" value="<?php echo e($jrow->supplier_name); ?>" name="supplier_name" class="form-control" >
										</div>
										<div class="col-xs-5">
											<span class="small"><b>TRN No</b></span> <input type="text" id="trnno_1" autocomplete="off" name="trn_no" value="<?php echo e($jrow->trn_no); ?>" class="form-control">
										</div>
                                </div>
								<?php } ?>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Total Debit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="debit" name="debit" readonly value="<?php echo e($jrow->debit); ?>" placeholder="0.00">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Total Credit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="credit" name="credit" readonly placeholder="0.00" value="<?php echo e($jrow->credit); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"> Difference</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="difference" name="difference" readonly placeholder="0.00" value="<?php echo e(number_format($jrow->difference)); ?>">
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                        <a href="<?php echo e(url('journal')); ?>" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                               
							   <div id="account_modal" class="modal fade animated" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Select Account</h4>
											</div>
											<div class="modal-body" id="account_data">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div> 
								
									<div id="job_modal" class="modal fade animated" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Job Master</h4>
                                        </div>
                                        <div class="modal-body" id="jobData">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
								
								<div id="reference_modal" class="modal fade animated" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Select Invoice</h4>
											</div>
											<div class="modal-body" id="invoiceData">
												
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
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

<script>

//$('#voucher_date').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

"use strict";

$(document).ready(function () {
	
	$('.itemdivPrnt').find('.btn-add-item:not(:last)').hide();
	if ( $('.itemdivPrnt').children().length == 1 ) {
		$('.itemdivPrnt').find('.btn-remove-item').hide();
	}
	
    $('#frmPurchase Voucher').bootstrapValidator({
        fields: {
            voucher_type: {
                validators: {
                    notEmpty: {
                        message: 'The voucher type is required and cannot be empty!'
                    }
                }
            },
			voucher_no: {
                validators: {
                    notEmpty: {
                        message: 'The voucher no is required and cannot be empty!'
                    }
                }
            },
			voucher_date: {
                validators: {
                    notEmpty: {
                        message: 'The voucher date is required and cannot be empty!'
                    }
                }
            },
			"account_name[]": {
                validators: {
                    notEmpty: {
                        message: 'The account name is required and cannot be empty!'
                    }
                }
            },
			"description[]": {
                validators: {
                    notEmpty: {
                        message: 'The description is required and cannot be empty!'
                    }
                }
            },
			"line_amount[]": {
                validators: {
                    notEmpty: {
                        message: 'The amount is required and cannot be empty!'
                    }
                }
            },
			"cheque_no[]": {
                validators: {
                    notEmpty: {
                        message: 'The cheque no is required and cannot be empty!'
                    }
                }
            },
			"cheque_date[]": {
                validators: {
                    notEmpty: {
                        message: 'The cheque date is required and cannot be empty!'
                    }
                }
            },
			"bank_id[]": {
                validators: {
                    notEmpty: {
                        message: 'The bank is required and cannot be empty!'
                    }
                }
            },
			debit: {
                validators: {
                    identical: {
                        field: 'credit',
                        message: 'The Debit and Credit amount should be equal!'
                    }
                }
            },
            credit: {
                validators: {
                    identical: {
                        field: 'debit',
                        message: 'The Debit and Credit amount should be equal!'
                    }
                }
            }
			
        }
        
    }).on('reset', function (event) {
        $('#frmPurchase Voucher').data('bootstrapValidator').resetForm();
    });
	
	$("#chequeInput").toggle();
	$("#currency_rate").prop('disabled', true);
	$("#currency_id").prop('disabled', true);
	
	$('.custom_icheck').on('ifChecked', function(event){ 
		$("#currency_id").prop('disabled', false);
		$("#currency_rate").prop('disabled', false);
		
	});
	
	$('.custom_icheck').on('ifUnchecked', function(event){ 
		$("#currency_id").prop('disabled', true);
		$("#currency_rate").prop('disabled', true);
		$('#amount_fc').val('');$("#currency_rate").val('');
	});
	
	
	$('#voucher_type').on('change', function(e){
		$('#voucher_no').val('');
		var vchr_id = e.target.value; 
		$.get("<?php echo e(url('journal/getvouchertype/')); ?>/" + vchr_id, function(data) { 
			$('#voucher').empty();
			$('#voucher').append('<option value="">Select Voucher...</option>');
			$.each(data, function(value, display){
				 $('#voucher').append('<option value="' + display.id + '">' + display.name + '</option>');
			});
		});
		
	});
	
	$('#voucher').on('change', function(e){
		var vchr_id = e.target.value; 
		$.get("<?php echo e(url('journal/getvoucher/')); ?>/" + vchr_id, function(data) { //console.log(data);
			$('#voucher_no').val(data);
		});
		
	});
	
});

$(function(){
	var rowNum = $('#rowNum').val();
  $(':input[type=number]').on('mousewheel',function(e){ $(this).blur(); });
  //$('#chqdtl_1').toggle();
  
  $('#department_id').on('change', function(e){ 
		var dept_id = e.target.value; 
		
		$.get("<?php echo e(url('purchase_voucher/getdeptvoucher/')); ?>/" + dept_id, function(data) { 
			$('#voucher_no').val(data[0].voucher_no);
			$('#voucher').find('option').remove().end();
			$.each(data, function(key, value) {  
				$('#voucher').find('option').end()
						.append($("<option></option>")
						.attr("value",value.voucher_id)
						.text(value.voucher_name)); 
			});
			
		});
	});
	
  $(document).on('click', '.btn-add-item', function(e)  { 
        rowNum++; 
		e.preventDefault();
        var controlForm = $('.controls .itemdivPrnt'),
            currentEntry = $(this).parents('.itemdivChld:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);
			newEntry.find($('input[name="account_name[]"]')).attr('id', 'draccount_' + rowNum);
			newEntry.find($('input[name="account_id[]"]')).attr('id', 'draccountid_' + rowNum);
			newEntry.find($('input[name="description[]"]')).attr('id', 'descr_' + rowNum);
			newEntry.find($('input[name="reference[]"]')).attr('id', 'ref_' + rowNum);
			newEntry.find($('input[name="group_id[]"]')).attr('id', 'groupid_' + rowNum);
			newEntry.find($('input[name="inv_id[]"]')).attr('id', 'invid_' + rowNum);
			newEntry.find($('input[name="je_id[]"]')).attr('id', 'jeid_' + rowNum);
			newEntry.find($('.line-type')).attr('id', 'acnttype_' + rowNum);
			newEntry.find($('input[name="line_amount[]"]')).attr('id', 'amount_' + rowNum);
			//newEntry.find($('.line-job')).attr('id', 'jobid_' + rowNum);
			 newEntry.find($('input[name="job_id[]"]')).attr('id', 'jobid_' + rowNum);
			newEntry.find($('input[name="jobcod[]"]')).attr('id', 'jobcod_' + rowNum);
			newEntry.find($('.line-dept')).attr('id', 'dept_' + rowNum);
			newEntry.find($('input[name="cheque_no[]"]')).attr('id', 'chkno_' + rowNum);
			newEntry.find($('input[name="cheque_date[]"]')).attr('id', 'chkdate_' + rowNum); 
			newEntry.find($('input[name="actual_amount[]"]')).attr('id', 'actamt_' + rowNum);
			newEntry.find($('.line-bank')).attr('id', 'bankid_' + rowNum);
			newEntry.find($('.divchq')).attr('id', 'chqdtl_' + rowNum);
			newEntry.find($('.refdata')).attr('id', 'refdata_' + rowNum);
			newEntry.find($('input[name="oldcheque_no[]"]')).attr('id', 'oldchkno_' + rowNum);
			
			var des = $('input[name="description[]"]').val();
			newEntry.find('input').val(''); 
			newEntry.find($('input[name="description[]"]')).val(des);
			if( $('#infodivPrntItm_'+rowNum).is(":visible") ) 
				$('#infodivPrntItm_'+rowNum).toggle();
			
			controlForm.find('.btn-add-item:not(:last)').hide();
			controlForm.find('.btn-remove-item').show()
			
			$('.chqdate').datepicker({
				language: 'en',
				dateFormat: 'dd-mm-yyyy'
			});
    }).on('click', '.btn-remove-item', function(e)
    { 
		//new change..
		var res = $(this).attr('data-id').split('_');
		var curNum = res[1]; var ids;
		
		var remitem = $('#remitem').val();
		ids = (remitem=='')?$('#jeid_'+curNum).val():remitem+','+$('#jeid_'+curNum).val();
		$('#remitem').val(ids);
		
		$(this).parents('.itemdivChld:first').remove();
		
		getNetTotal();
		
		$('.itemdivPrnt').find('.itemdivChld:last').find('.btn-add-item').show();
		if ( $('.itemdivPrnt').children().length == 1 ) {
			$('.itemdivPrnt').find('.btn-remove-item').hide();
		}
		
		e.preventDefault();
		return false;
	});
	
	$('.chqdate').datepicker({
		language: 'en',
		dateFormat: 'dd-mm-yyyy'
	});
	
	$(document).on('blur', '.line-amount', function(e) {
		getNetTotal();
	});
	
	$(document).on('change', '.line-type', function(e) {
		getNetTotal();
	});
	
	//new change............
	var acurl = "<?php echo e(url('account_master/get_accounts/')); ?>";
	$(document).on('click', 'input[name="account_name[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#account_data').load(acurl+'/'+curNum, function(result){ //.modal-body item
			$('#myModal').modal({show:true}); $('.input-sm').focus();
		});
	});
	
	//new change.................
	$(document).on('click', '.custRow', function(e) { 
		var num = $('#num').val(); var vatasgn = $(this).attr("data-vatassign");
		$('#draccount_'+num).val( $(this).attr("data-name") );
		$('#draccountid_'+num).val( $(this).attr("data-id") );
		$('#groupid_'+num).val( (vatasgn==0)?$(this).attr("data-group"):$(this).attr("data-vatassign") );
		
		if($(this).attr("data-group")=='PDCR') {
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Dr">Dr</option>');
			if( $('#chqdtl_'+num).is(":hidden") )
				$('#chqdtl_'+num).toggle();
				
		} else if($(this).attr("data-group")=='PDCI') { 
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Cr">Cr</option>');
			if( $('#chqdtl_'+num).is(":hidden") )
				$('#chqdtl_'+num).toggle();
		} else {
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Dr">Dr</option><option value="Cr">Cr</option>');
			if( $('#chqdtl_'+num).is(":visible") )
				$('#chqdtl_'+num).toggle();
		}
		
		/* if( $(this).attr("data-group")=='SUPPLIER' || $(this).attr("data-group")=='CUSTOMER') {// group.id
			$('#refdata_'+num).html('<input type="text" id="ref_'+num+'" name="reference[]" class="form-control ref-invoice" autocomplete="off" data-toggle="modal" data-target="#reference_modal">');
		} else {// group.id
			$('#refdata_'+num).html('<input type="text" id="ref_'+num+'" name="reference[]" class="form-control">');
		} */
	});
	
	$(document).on('blur', '#voucher_date', function(e) { 
        // Revalidate the date when user change it
        //$('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'voucher_date');
		$('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'voucher_no');
	});
	
	$(document).on('blur', '.line-amount', function(e) { 
        // Revalidate the date when user change it
        $('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'debit');
		$('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'credit');
	});
	
	$(document).on('blur', '.acname', function(e) { 
        // Revalidate the date when user change it
        $('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'account_name[]');
	});
	
	$(document).on('change', '.submit', function(e) { 
		$('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'debit');
		$('#frmPurchase Voucher').bootstrapValidator('revalidateField', 'credit');
	});

	$(document).on('blur', 'input[name="cheque_no[]"]', function(e) {
		var chqno = this.value;
		var res = this.id.split('_');
		var curNum = res[1];
		var oldcqno = $('#oldchkno_'+curNum).val();
		var bank = $('#bankid_'+curNum+' option:selected').val();
		if(oldcqno != chqno) {
			$.ajax({
				url: "<?php echo e(url('account_master/check_chequeno/')); ?>",
				type: 'get',
				data: 'chqno='+chqno+'&bank_id='+bank,
				success: function(data) { 
					if(data=='') {
						alert('Cheque no is duplicate!');
						$('#chkno_'+curNum).val('');
					}
				}
			})
		}
	});
	
	
	var joburl = "<?php echo e(url('jobmaster/job_data/')); ?>";
	$(document).on('click', 'input[name="jobcod[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		console.log(curNum);
		$('#jobData').load(joburl+'/'+curNum, function(result) {
			$('#myModal').modal({show:true}); $('.input-sm').focus();
		});
	});
	
	$(document).on('click', '#job_modal .jobRow', function(e) {
		var num =$('#num').val();
		$('#jobcod_'+num).val($(this).attr("data-cod"));
		$('#jobid_'+num).val($(this).attr("data-id"));
		e.preventDefault();
	});
	
	$(document).on('click', '.ref-invoice', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		
		if( $('#groupid_'+curNum).val()=='CUSTOMER') { //customer type.............
			var url = "<?php echo e(url('sales_invoice/get_invoice/')); ?>/"+$('#draccountid_'+curNum).val();
			$('#invoiceData').load(url+'/'+curNum, function(result){ //.modal-body item
				$('#myModal').modal({show:true});
			});
		} else if( $('#groupid_'+curNum).val()=='SUPPLIER' ) { //supplier type.........
			var url = "<?php echo e(url('purchase_invoice/get_invoice/')); ?>/"+$('#draccountid_'+curNum).val();
			$('#invoiceData').load(url+'/'+curNum, function(result){ //.modal-body item
				$('#myModal').modal({show:true});
			});
		}
	});
	
	$(document).on('click', '.add-invoice', function(e)  { 
	
		var refs = []; var amounts = []; var type = []; var ids = []; var actamt = [];
		$("input[name='tag[]']:checked").each(function() { 
			var res = this.id.split('_');
			var curNum = res[1];
			ids.push($(this).val());
			refs.push( $('#refid_'+curNum).val() );
			amounts.push( $('#lineamnt_'+curNum).val() );
			type.push( $('#actype_'+curNum).val() );
			actamt.push( $('#hidamt_'+curNum).val() );
		});
		
		var no = $('#num').val(); //var rowNum;
		var j = 0; rowNum = parseInt(no);
		
		$.each(refs,function(i) {
			if(j>0) {
				var controlForm = $('.controls .itemdivPrnt'),
				currentEntry = $('.btn-add-item').parents('.itemdivChld:first'),
				newEntry = $(currentEntry.clone()).appendTo(controlForm);
				rowNum++;
				newEntry.find($('input[name="account_name[]"]')).attr('id', 'draccount_' + rowNum);
				newEntry.find($('input[name="account_id[]"]')).attr('id', 'draccountid_' + rowNum);
				newEntry.find($('input[name="description[]"]')).attr('id', 'descr_' + rowNum);
				newEntry.find($('input[name="reference[]"]')).attr('id', 'ref_' + rowNum);
				newEntry.find($('input[name="group_id[]"]')).attr('id', 'groupid_' + rowNum);
				newEntry.find($('input[name="inv_id[]"]')).attr('id', 'invid_' + rowNum);
				newEntry.find($('.line-type')).attr('id', 'acnttype_' + rowNum);
				newEntry.find($('input[name="line_amount[]"]')).attr('id', 'amount_' + rowNum);
				newEntry.find($('input[name="actual_amount[]"]')).attr('id', 'actamt_' + rowNum);
				newEntry.find($('.line-job')).attr('id', 'jobid_' + rowNum);
				 newEntry.find($('input[name="job_id[]"]')).attr('id', 'jobid_' + rowNum);
			newEntry.find($('input[name="jobcod[]"]')).attr('id', 'jobcod_' + rowNum);
				newEntry.find($('.line-dept')).attr('id', 'dept_' + rowNum);
				newEntry.find($('input[name="cheque_no[]"]')).attr('id', 'chkno_' + rowNum);
				newEntry.find($('input[name="cheque_date[]"]')).attr('id', 'chkdate_' + rowNum); 
				newEntry.find($('.line-bank')).attr('id', 'bankid_' + rowNum);
				newEntry.find($('.divchq')).attr('id', 'chqdtl_' + rowNum);
				newEntry.find($('.refdata')).attr('id', 'refdata_' + rowNum);
				
			}
			$('#ref_'+no).val( refs[i] );
			$('#amount_'+no).val(amounts[i])
			$('#invid_'+no).val( ids[i] );
			$('#acnttype_'+no).find('option').remove().end().append('<option value="'+type[i]+'">'+type[i]+'</option>');
			$('#actamt_'+no).val( actamt[i] );
			j++;
		});
		getNetTotal();
	
	});
	
	$('input,select').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });
});

function getNetTotal() {
	var drLineTotal = 0; var crLineTotal = 0;
	$( '.line-amount' ).each(function() {
		var res = this.id.split('_');
		var curNum = res[1];
		if( $('#acnttype_'+curNum+' option:selected').val()=='Dr' )
			drLineTotal = drLineTotal + parseFloat( (this.value=='')?0:this.value );
		else if( $('#acnttype_'+curNum+' option:selected').val()=='Cr' )
			crLineTotal = crLineTotal + parseFloat( (this.value=='')?0:this.value );
		console.log('cr'+crLineTotal);
	});
	var difference = drLineTotal - crLineTotal;
	$("#debit").val(drLineTotal.toFixed(2));
	$("#credit").val(crLineTotal.toFixed(2));
	$("#difference").val(difference.toFixed(2));
	
	if($("#is_fc").prop('checked') == true && $('#currency_rate').val()!=''){
		var amount_fc = parseFloat($('#currency_rate').val()) * amount;
		$('#amount_fc').val(amount_fc.toFixed(2));
	}
	
}
	
var popup;
function getDrAccount(e) { 
	
	var ht = $(window).height();
	var wt = $(window).width();
	var res = e.id.split('_');
	var curNum = res[1]; 
	var itmurl = "<?php echo e(url('account_master/get_all_account/')); ?>/"+curNum;
	popup = window.open(itmurl, "Popup", "width=900,height=500,top=100,left=200");
	popup.focus();
	return false
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>