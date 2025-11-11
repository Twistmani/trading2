

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
                Receipt Voucher
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
                    <a href="#">Receipt Voucher</a>
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
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-crosshairs"></i>  Edit Receipt Voucher
                            </h3>
                           <div class="pull-right">
								<?php if (\Entrust::can(('rv-print'))) : ?>
								 <a href="<?php echo e(url('customer_receipt/print2/'.$crrow->id.'/'.$prints[0]->id)); ?>" target="_blank" class="btn btn-info btn-sm">
									<span class="btn-label">
										<i class="fa fa-fw fa-print"></i>
									</span>
								 </a>
								<?php endif; // Entrust::can ?>
							</div>
                        </div>
                        <div class="panel-body">
							<div class="controls"> 
							<?php  $ispdc = false;  ?>
                            <form class="form-horizontal" role="form" method="POST" name="frmJournal" id="frmJournal" action="<?php echo e(url('customer_receipt/update/'.$crrow->id)); ?>">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="from_jv" value="1">
								<input type="hidden" name="from_rv" value="1">
								<input type="hidden" name="rv_id" id="rv_id" value="<?php echo e($crrow->id); ?>">
								<?php if($formdata['send_email']==1): ?>
								<input type="hidden" name="send_email" value="1">
								<?php else: ?>
								<input type="hidden" name="send_email" value="0">
								<?php endif; ?>
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Voucher Type</label>
                                    <div class="col-sm-10">
                                        <select id="voucher_type" class="form-control select2" style="width:100%" name="voucher_type">
											<option value="<?php echo e($crrow->voucher_type); ?>">RV - Receipt Voucher</option>
										</select>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Voucher</label>
                                    <div class="col-sm-10">
                                        <select id="voucher" class="form-control select2" style="width:100%" name="voucher">
										<?php foreach($vouchertype as $row): ?>
											<option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
										<?php endforeach; ?>
										</select>
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">RV. No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="voucher_no" value="<?php echo e($crrow->voucher_no); ?>" readonly name="voucher_no">
                                    </div>
                                </div>
                                
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">RV. Date</label>
                                    <div class="col-sm-10">
										<input type="text" class="form-control pull-right" name="voucher_date" value="<?php echo e(date('d-m-Y', strtotime($crrow->voucher_date))); ?>" data-language='en'  id="voucher_date" placeholder="Voucher Date" autocomplete="off"/>
                                    </div>
                                </div>
								
								<br/>
								<fieldset>
								<legend><h5>Transactions</h5></legend>
										<?php /**/ $i = 0; $num = count($invoicerow); /**/ ?>
										<input type="hidden" id="rowNum" value="<?php echo e($num); ?>">
										<input type="hidden" id="remitem" name="remove_item">
										<div class="itemdivPrnt">
										<?php foreach($invoicerow as $item): ?>
										<?php /**/ $i++; /**/ ?>
										
											<div class="itemdivChld">							
												<div class="form-group classtrn" style="margin-bottom:1px;" id="trns_<?php echo e($i); ?>">
												<?php if($item->category=='PDCR'): ?>
													<?php  $ispdc = true;  ?>
													<?php if($isdept): ?>
													<div class="col-xs-1 nopdc" style="width:11%;"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="text" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>"> 
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-2" style="width:11%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2" style="width:9%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1" style="width:6%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
														</select>
													</div>
													<div class="col-xs-1" style="width:10%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													<div class="col-xs-1" style="width:8%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Bank</span> 
														<select id="bankid_<?php echo e($i); ?>" class="form-control select2 line-bank" style="width:100%" name="bank_id[]">
														<option value="">Select Bank...</option>
															<?php foreach($banks as $bank): ?>
															<option value="<?php echo e($bank['id']); ?>" <?php if($item->bank_id==$bank['id']) echo 'selected';?>><?php echo e($bank['code']); ?></option>
															<?php endforeach; ?>
														</select>
													</div>

													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="cheque_no[]" class="form-control" >
														<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
													</div>
													
													
													
													<div class="col-xs-1 pdcfm" style="width:8%;">
														<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($i); ?>" value="<?php echo e($item->party_id); ?>">
														<span class="small">Pty. Name</span> <input type="text" id="party_<?php echo e($i); ?>" autocomplete="off" name="party_name[]" value="<?php echo e($item->party_name); ?>" class="form-control" data-toggle="modal" data-target="#paccount_modal">
													</div>
													
													<div class="col-xs-1" style="width:8%;">
														<span class="small">Department</span> 
														<select id="dept_<?php echo e($i); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
														<option value="">Department...</option>
														<?php foreach($departments as $department): ?>
														<option value="<?php echo e($department->id); ?>" <?php if($item->department_id==$department->id) echo 'selected';?>><?php echo e($department->name); ?></option>
														<?php endforeach; ?>
														</select>
													</div>
													
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<?php else: ?> <!-- PDC W/O DEPARTMENT -->
													<div class="col-xs-1 nopdc1" style="width:12%;"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="hidden" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>">
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-2 nopdc2" style="width:12%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2 nopdc3" style="width:10%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1 nopdc4" style="width:7%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
														</select>
													</div>
													<div class="col-xs-1 nopdc5" style="width:10%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													

													<div class="col-xs-1 pdcfm" style="width:9%;">
														<span class="small">Bank</span> 
														<select id="bankid_<?php echo e($i); ?>" class="form-control select2 line-bank" style="width:100%" name="bank_id[]">
														<option value="">Select Bank...</option>
															<?php foreach($banks as $bank): ?>
															<option value="<?php echo e($bank['id']); ?>" <?php if($item->bank_id==$bank['id']) echo 'selected';?>><?php echo e($bank['code']); ?></option>
															<?php endforeach; ?>
														</select>
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="cheque_no[]" class="form-control" >
														<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:9%;">
														<span class="small">Chq. Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
													</div>
													
													
													
													<div class="col-xs-1 pdcfm" style="width:9%;">
														<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($i); ?>" value="<?php echo e($item->party_id); ?>">
														<span class="small">Pty. Name</span> <input type="text" id="party_<?php echo e($i); ?>" autocomplete="off" name="party_name[]" value="<?php echo e($item->party_name); ?>" class="form-control" data-toggle="modal" data-target="#paccount_modal">
													</div>
													<div class="col-xs-1 nopdc6" style="width:9%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>
													
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<?php endif; ?>  <!--PDC W/O DEPARTMENT ENDIF-->
													
												<?php elseif($item->category=='BANK'): ?> <!--BANK W/O DEPARTMENT ENDIF-->
													<?php if($isdept): ?>
													<div class="col-xs-1 nopdc" style="width:18%;"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="text" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>"> 
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-2" style="width:13%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2" style="width:12%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1" style="width:6%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
														</select>
													</div>
													<div class="col-xs-1" style="width:10%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													<div class="col-xs-1" style="width:8%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>

													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="cheque_no[]" class="form-control" >
														<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
													</div>


													<div class="col-xs-1" style="width:8%;">
														<span class="small">Department</span> 
														<select id="dept_<?php echo e($i); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
														<option value="">Department...</option>
														<?php foreach($departments as $department): ?>
														<option value="<?php echo e($department->id); ?>" <?php if($item->department_id==$department->id) echo 'selected';?>><?php echo e($department->name); ?></option>
														<?php endforeach; ?>
														</select>
													</div>
													
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<?php else: ?> <!-- BANK W/O DEPARTMENT -->
													<div class="col-xs-1 nopdc1" style="width:18%;"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="hidden" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>">
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-2 nopdc2" style="width:18%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2 nopdc3" style="width:12%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1 nopdc4" style="width:7%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
														</select>
													</div>
													<div class="col-xs-1 nopdc5" style="width:10%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													

													<div class="col-xs-1 pdcfm" style="width:8%;">
														<span class="small">Chq. No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="cheque_no[]" class="form-control" >
														<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
													</div>
													
													<div class="col-xs-1 pdcfm" style="width:9%;">
														<span class="small">Chq. Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" autocomplete="off" class="form-control chqdate" data-language='en'>
													</div>
													
												
													<div class="col-xs-1 nopdc6" style="width:14%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>
													
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<?php endif; ?>  <!--BANK W/O DEPARTMENT ENDIF-->	
													
													
												<?php else: ?>  <!--PDC ELSE (CASH)-->
													<?php if($isdept): ?> <!-- CASH DEPARTMENT -->
													<div class="col-sm-2"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="hidden" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>"> 
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-3" style="width:20%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2" style="width:12%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1" style="width:7%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
															<option value="<?php echo e(($item->entry_type=='Cr')?'Dr':'Cr'); ?>"><?php echo e(($item->entry_type=='Cr')?'Dr':'Cr'); ?></option>
														</select>
													</div>
													<div class="col-xs-2" style="width:12%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													<div class="col-sm-2" style="width:15%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>
													
													<div class="col-xs-3" style="width:13%;">
														<span class="small">Department</span> 
														<select id="dept_<?php echo e($i); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
														<option value="">Department...</option>
														<?php foreach($departments as $department): ?>
														<option value="<?php echo e($department->id); ?>" <?php if($item->department_id==$department->id) echo 'selected';?>><?php echo e($department->name); ?></option>
														<?php endforeach; ?>
														</select>
													</div>
															
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<?php else: ?>  <!-- CASH DEPARTMENT ELSE -->
													<div class="col-sm-2"> <span class="small">Account Name</span>
														<input type="text" id="draccount_<?php echo e($i); ?>" value="<?php echo e($item->master_name); ?>" name="account_name[]" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
														<input type="hidden" name="account_id[]" value="<?php echo e($item->account_id); ?>" id="draccountid_<?php echo e($i); ?>">
														<input type="hidden" name="group_id[]" value="<?php echo e($item->category); ?>" id="groupid_<?php echo e($i); ?>">
														<input type="hidden" name="je_id[]" id="jeid_<?php echo e($i); ?>" value="<?php echo e($item->id); ?>">
														
														<input type="hidden" id="invoiceid_<?php echo e($i); ?>" name="sales_invoice_id[]" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($i); ?>" value="<?php echo e($item->bill_type); ?>"> 
														<input type="hidden" id="trid_<?php echo e($i); ?>" name="tr_id[]" value="<?php echo e($item->tr_entry_id); ?>">
													</div>
													
													<div class="col-xs-3" style="width:20%;">
														<span class="small">Description</span> <input type="text" id="descr_<?php echo e($i); ?>" value="<?php echo e($item->description); ?>" name="description[]" class="form-control">
													</div>
													<div class="col-xs-2" style="width:14%;">
														<span class="small">Reference</span> 
														<div id="refdata_<?php echo e($i); ?>" class="refdata">
														<input type="text" id="ref_<?php echo e($i); ?>" name="reference[]" value="<?php echo e($item->reference); ?>" class="form-control <?php if($item->entry_type=='Cr') echo 'ref-invoice'; ?>" <?php if($item->entry_type=='Cr') { ?>data-toggle="modal" data-target="#reference_modal" <?php } ?>>
														</div>
														<input type="hidden" name="inv_id[]" id="invid_<?php echo e($i); ?>" value="<?php echo e($item->sales_invoice_id); ?>">
														<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>">
													</div>
													<div class="col-xs-1" style="width:8%;">
														<span class="small">Type</span> 
														<select id="acnttype_<?php echo e($i); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
															<option value="<?php echo e($item->entry_type); ?>"><?php echo e($item->entry_type); ?></option>
															<option value="<?php echo e(($item->entry_type=='Cr')?'Dr':'Cr'); ?>"><?php echo e(($item->entry_type=='Cr')?'Dr':'Cr'); ?></option>
														</select>
													</div>
													<div class="col-xs-2" style="width:12%;">
														<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($i); ?>" value="<?php echo e($item->amount); ?>" step="any" name="line_amount[]" class="form-control jvline-amount">
													</div>
													<div class="col-sm-2" style="width:13%;"> 
														<span class="small">Job</span> 
														<input type="hidden" name="job_id[]" id="jobid_<?php echo e($i); ?>" value="<?php echo e($item->job_id); ?>">
														<input type="text" id="jobcod_<?php echo e($i); ?>" autocomplete="off" name="jobcod[]" class="form-control" value="<?php echo e($item->code); ?>" autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
													</div>
													<?php if($item->category=='CUSTOMER'): ?>
													<div id="salem_1"class="col-sm-2 salem" style="width:11%;"> 
															<span class="small">Salesman</span> 
														<input type="hidden" name="salesman_idd[]" id="salesmanid_<?php echo e($i); ?>" value="<?php echo e($item->salesman_id); ?>" >
														<input type="text" id="salesman_<?php echo e($i); ?>" autocomplete="off" name="salesman[]" class="form-control"  value="<?php echo e($item->salesman); ?>" autocomplete="off" data-toggle="modal" data-target="#salesman_modal" placeholder="Salesman">
														
														</div>
														<?php else: ?>
														<input type="hidden" name="salesman_idd[]" id="salesmanid_<?php echo e($i); ?>" >
													<?php endif; ?>
													<div class="col-xs-1 abc" style="width:3%;"><br/>
														<button type="button" data-id="rem_<?php echo e($i); ?>" class="btn-danger btn-remove-item" >
															<i class="fa fa-fw fa-minus-square"></i>
														 </button>
														<button type="button" class="btn-success btn-add-item" >
															<i class="fa fa-fw fa-plus-square"></i>
														 </button>
													</div>
													<input type="hidden" name="department[]" id="dept_<?php echo e($i); ?>">
													<?php endif; ?>
														<div id="chqdtl_<?php echo e($i); ?>" class="divchq" style="display: none;">
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
																<span class="small">Cheque No</span><input type="text" id="chkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="cheque_no[]" class="form-control" >
																<input type="hidden" id="oldchkno_<?php echo e($i); ?>" value="<?php echo e($item->cheque_no); ?>" name="oldcheque_no[]">
															</div>
															
															<div class="col-xs-2">
																<span class="small">Cheque Date</span> <input type="text" id="chkdate_<?php echo e($i); ?>" value="<?php echo ($item->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($item->cheque_date));?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
															</div>
															
															<div class="col-xs-2">
																<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($i); ?>" value="<?php echo e($item->party_id); ?>">
																<span class="small">Party Name</span> <input type="text" id="party_<?php echo e($i); ?>" name="party_name[]" value="<?php echo e($item->party_name); ?>" class="form-control" data-toggle="modal" data-target="#paccount_modal">
															</div>
														</div>
												<?php endif; ?>		
												</div>
												
											</div>
										<?php endforeach; ?>
										</div>
								</fieldset>
								
								<hr/>
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Total Debit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="debit" name="debit" readonly value="<?php echo e($crrow->debit); ?>" placeholder="0.00">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Total Credit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="credit" name="credit" readonly placeholder="0.00" value="<?php echo e($crrow->credit); ?>">
                                    </div>
                                </div>
								
								<div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"> Difference</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="difference" name="difference" readonly placeholder="0.00" value="<?php echo e(number_format($crrow->difference)); ?>">
                                    </div>
                                </div>
								
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                        <a href="<?php echo e(url('journal')); ?>" class="btn btn-danger">Cancel</a>
										<a href="<?php echo e(url('journal')); ?>" class="btn btn-warning">Clear</a>
                                    </div>
                                </div>
								
                            </form>
							
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
                            
                            <div id="salesman_modal" class="modal fade animated" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Select Salesman</h4>
                                        </div>
                                        <div class="modal-body" id="salesmanData">
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
								

								<div id="paccount_modal" class="modal fade animated" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Select Account</h4>
											</div>
											<div class="modal-body" id="paccount_data">
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div> 
								
							<div id="reference_modal" class="modal fade animated" role="dialog">
								<div class="modal-dialog" style="width:60%;">
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
	
    $('#frmJournal').bootstrapValidator({
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
			/*"description[]": {
                validators: {
                    notEmpty: {
                        message: 'The description is required and cannot be empty!'
                    }
                }
            },*/
			"line_amount[]": {
                validators: {
                    notEmpty: {
                        message: 'The amount is required and cannot be empty!'
                    }
                }
            },

			<?php if($ispdc==true): ?>

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
			<?php endif; ?>
			
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
        $('#frmJournal').data('bootstrapValidator').resetForm();
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

var joburl = "<?php echo e(url('jobmaster/job_data/')); ?>";
	$(document).on('click', 'input[name="jobcod[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
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
var supurl = "<?php echo e(url('sales_invoice/salesman_data/')); ?>";
	$(document).on('click', 'input[name="salesman[]"]', function(e) {
	    var res = this.id.split('_');
		var curNum = res[1];
		$('#salesmanData').load(supurl+'/'+curNum, function(result) {
			$('#myModal').modal({show:true});
		});
	});
	
	$(document).on('click', '#salesman_modal .salesmanRow', function(e) {
		 var num =$('#num').val();
		$('#salesman_'+num).val($(this).attr("data-name"));
		$('#salesmanid_'+num).val($(this).attr("data-id"));
		e.preventDefault();
	});
	
$(function(){
	var rowNum = $('#rowNum').val();
  $(':input[type=number]').on('mousewheel',function(e){ $(this).blur(); });
  //$('#chqdtl_1').toggle();
  
//ED12 
 $(document).on('click', '.btn-add-item', function(e)  { 
        rowNum++; 
		$('#rowNum').val(rowNum);
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
			newEntry.find($('input[name="sales_invoice_id[]"]')).attr('id', 'invoiceid_' + rowNum);
			newEntry.find($('input[name="tr_id[]"]')).attr('id', 'trid_' + rowNum);
			newEntry.find($('input[name="bill_type[]"]')).attr('id', 'biltyp_' + rowNum);
			newEntry.find($('input[name="oldcheque_no[]"]')).attr('id', 'oldchkno_' + rowNum);

			newEntry.find($('input[name="department[]"]')).attr('id', 'dept_' + rowNum);
			newEntry.find($('input[name="partyac_id[]"]')).attr('id', 'partyac_' + rowNum);
			newEntry.find($('input[name="party_name[]"]')).attr('id', 'party_' + rowNum);
			newEntry.find($('.btn-remove-item')).attr('data-id','rem_'+rowNum);
			
			newEntry.find($('input[name="salesman_idd[]"]')).attr('id', 'salesmanid_' + rowNum);
			newEntry.find($('input[name="salesman[]"]')).attr('id', 'salesman_' + rowNum);
            newEntry.find($('.salem')).attr('id', 'salem_' + rowNum);
			
			var des = $('input[name="description[]"]').val();
			newEntry.find($('.classtrn')).attr('id', 'trns_' + rowNum);
			$('#ref_'+rowNum).val(''); $('#amount_'+rowNum).val(''); 
			$('#jeid_'+rowNum).val('');

			$('#draccount_'+rowNum).val('');
			$('#draccountid_'+rowNum).val('');
			  $('#salesman_'+rowNum).val('');
			$('#salesmanid_'+rowNum).val('');
			//newEntry.find('input').val('');  cheque_date[]
			newEntry.find($('input[name="description[]"]')).val(des);
			if( $('#infodivPrntItm_'+rowNum).is(":visible") ) 
				$('#infodivPrntItm_'+rowNum).toggle();
             if( $('#salem_'+rowNum).is(":visible") ) 
                 $('#salem_'+rowNum).toggle();
			
			controlForm.find('.btn-add-item:not(:last)').hide();
			controlForm.find('.btn-remove-item').show()
			
			newEntry.find( $('.chqdate').datepicker({
				language: 'en',
				autoClose:true,
				dateFormat: 'dd-mm-yyyy'
			}) );
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
		autoClose:true,
		dateFormat: 'dd-mm-yyyy'
	});
	
	$(document).on('click','.datepicker--cell-day',function() {
		$('#frmJournal').bootstrapValidator('revalidateField', 'cheque_date[]');
	})
	
	////ED12
	$(document).on('keyup', '.jvline-amount', function(e) {
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
			$('#myModal').modal({show:true});
		});
	});
	
	//new change.................
	$(document).on('click', '#account_modal .custRow', function(e) { //.accountRow
		var num = $('#num').val();
		$('#draccount_'+num).val( $(this).attr("data-name") );
		$('#draccountid_'+num).val( $(this).attr("data-id") );
		$('#groupid_'+num).val( $(this).attr("data-group") );
		
		if($(this).attr("data-group")=='PDCR') { 
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Dr">Dr</option>');
			var trnurl = "<?php echo e(url('journal/set_transactions/')); ?>";
			if($('#jeid_'+num).val()!='')
				$('#trns_'+num).load( trnurl+'/PDC/'+$(this).attr("data-id")+'/'+num+'/'+$('#jeid_'+num).val() );
			else
				$('#trns_'+num).load( trnurl+'/PDC/'+$(this).attr("data-id")+'/'+num );
			
			/* if( $('#chqdtl_'+num).is(":hidden") )
				$('#chqdtl_'+num).toggle(); */
				
		} else if($(this).attr("data-group")=='PDCI') { 
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Cr">Cr</option>');
			var trnurl = "<?php echo e(url('journal/set_transactions/')); ?>";
			if($('#jeid_'+num).val()!='')
			    $('#trns_'+num).load( trnurl+'/PDC/'+$(this).attr("data-id")+'/'+num+'/'+$('#jeid_'+num).val() );
			else
			    $('#trns_'+num).load( trnurl+'/PDC/'+$(this).attr("data-id")+'/'+num );
			
			/* if( $('#chqdtl_'+num).is(":hidden") )
				$('#chqdtl_'+num).toggle(); */
		} else if($(this).attr("data-group")=='BANK') { 
		    
			$('#chktype').val('BANK');
			//$('#acnttype_'+num).find('option').remove().end().append('<option value="Dr">Dr</option>');
			var trnurl = "<?php echo e(url('journal/set_transactions/')); ?>";
			if($('#jeid_'+num).val()!='')
			    $('#trns_'+num).load( trnurl+'/BANK/'+$(this).attr("data-id")+'/'+num+'/'+$('#jeid_'+num).val() );
			else
			    $('#trns_'+num).load( trnurl+'/BANK/'+$(this).attr("data-id")+'/'+num );
			
		} else {
		    
		    if($(this).attr("data-group")=='CUSTOMER'){
		        if( $('#salem_'+num).is(":hidden") )
				$('#salem_'+num).toggle();
				
		    	$('#salesmanid_'+num).val( $(this).attr("data-salesmanid") );
	        	$('#salesman_'+num).val( $(this).attr("data-salesman") );
		    }
			$('#acnttype_'+num).find('option').remove().end().append('<option value="Dr">Dr</option><option value="Cr">Cr</option>');
			//$('#trns_'+num+' .nopdc').removeAttr("style"); 
			//$('#trns_'+num+' .col-xs-2').removeAttr("style"); 
			//console.log('dd '+num);
			$('#trns_'+num+' .pdcfm').hide();
			$('#trns_'+num+' .nopdc1').attr("style", "width:17%;");
			$('#trns_'+num+' .nopdc2').attr("style", "width:25%;");
			$('#trns_'+num+' .nopdc3').attr("style", "width:15%;");
			$('#trns_'+num+' .nopdc4').attr("style", "width:8%;");
			$('#trns_'+num+' .nopdc5').attr("style", "width:13%;");
			$('#trns_'+num+' .nopdc6').attr("style", "width:17%;");
			
			getNetTotal();
			
			 //$('#trns_'+num+' .nopdc').toggleClass('nopdc col-xs-2');
			 //$('#trns_'+num+' .nopdc').toggleClass('nopdc col-xs-3');
			 
			/* if( $('#chqdtl_'+num).is(":visible") )
				$('#chqdtl_'+num).toggle(); */
		}
		
		if( $(this).attr("data-group")=='SUPPLIER' || $(this).attr("data-group")=='CUSTOMER') {// group.id
			$('#refdata_'+num).html('<input type="text" id="ref_'+num+'" name="reference[]" class="form-control ref-invoice" autocomplete="off" data-toggle="modal" data-target="#reference_modal">');
		} else {// group.id
			$('#refdata_'+num).html('<input type="text" id="ref_'+num+'" name="reference[]" class="form-control">');
		}
	});
	
	$(document).on('blur', '#voucher_date', function(e) { 
        // Revalidate the date when user change it
        $('#frmJournal').bootstrapValidator('revalidateField', 'voucher_date');
		$('#frmJournal').bootstrapValidator('revalidateField', 'voucher_no');
	});
	
	$(document).on('blur', '.jvline-amount', function(e) { 
        // Revalidate the date when user change it
        $('#frmJournal').bootstrapValidator('revalidateField', 'debit');
		$('#frmJournal').bootstrapValidator('revalidateField', 'credit');
	});
	
	$(document).on('blur', '.acname', function(e) { 
        // Revalidate the date when user change it
        $('#frmJournal').bootstrapValidator('revalidateField', 'account_name[]');
	});
	
	$(document).on('change', '.submit', function(e) { 
		$('#frmJournal').bootstrapValidator('revalidateField', 'debit');
		$('#frmJournal').bootstrapValidator('revalidateField', 'credit');
	});

	$(document).on('blur', 'input[name="cheque_no[]"]', function(e) {
		//var chqno = this.value;
		var res = this.id.split('_');
		var curNum = res[1];
		checkChequeNo(curNum);
	});
	
	//ED12
	$(document).on('click', '.ref-invoice', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		
		if( $('#groupid_'+curNum).val()=='CUSTOMER') { //customer type.............
		
			   var rvid = $('#rv_id').val();
			   var url = "<?php echo e(url('account_enquiry/os_bills/')); ?>/"+$('#draccountid_'+curNum).val();
			   $('#invoiceData').load(url+'/'+curNum+'/RV/'+rvid, function(result){ 
					$('#myModal').modal({show:true});
			   });
			
		} else if( $('#groupid_'+curNum).val()=='SUPPLIER' ) { //supplier type.........
			var url = "<?php echo e(url('purchase_invoice/get_invoice/')); ?>/"+$('#draccountid_'+curNum).val();
			var reid = $('#jeid_'+curNum).val();
			if((reid!='') && (this.value!='')) {
				$('#invoiceData').load(url+'/'+curNum+'/'+this.value+'/'+reid, function(result){
					$('#myModal').modal({show:true});
				});
			} else {
				var rvid = $('#rv_id').val();
				$('#invoiceData').load(url+'/'+curNum+'/'+rvid, function(result){ 
					$('#myModal').modal({show:true});
				});
			}
		}
	});
	
	//ED12
	$(document).on('click', '.add-invoice', function(e)  { 
	
		var refs = []; var amounts = []; var type = []; var ids = []; var actamt = []; var btype = []; var nwar = []; var inv = [];
		$("input[name='tag[]']:checked").each(function() { 
			if(this.className=='tag-line-nw') {
				nwar.push( $('#refid_'+curNum).val() );
				//console.log('hh'+nwar);
			}
			var res = this.id.split('_');
			var curNum = res[1];
			ids.push($(this).val());
			refs.push( $('#refid_'+curNum).val() );
			amounts.push( $('#lineamnt_'+curNum).val() );
			type.push( $('#trtype_'+curNum).val() );
			actamt.push( $('#hidamt_'+curNum).val() );
			btype.push( $('#billtype_'+curNum).val() );
			inv.push($('#sinvoiceid_'+curNum).val());
		});
		
		var no = $('#bnum').val(); //var rowNum;
		rowNum = parseInt(no);
		var rnum = $('#rowNum').val();
		var j = 0;//rowNum-1; 
		
		$.each(refs,function(i) { //console.log(i);
			if(j>0) {  //console.log('j'+j);
				var controlForm = $('.controls .itemdivPrnt'),
					currentEntry = $('.btn-add-item').parents('.itemdivChld:last'),
					newEntry = $(currentEntry.clone()).appendTo(controlForm);
					rowNum++; 
					rnum++; 
					newEntry.find($('input[name="account_name[]"]')).attr('id', 'draccount_' + rnum);
					newEntry.find($('input[name="account_id[]"]')).attr('id', 'draccountid_' + rnum);
					newEntry.find($('input[name="description[]"]')).attr('id', 'descr_' + rnum);
					newEntry.find($('input[name="reference[]"]')).attr('id', 'ref_' + rnum);
					newEntry.find($('input[name="group_id[]"]')).attr('id', 'groupid_' + rnum);
					newEntry.find($('input[name="inv_id[]"]')).attr('id', 'invid_' + rnum);
					newEntry.find($('.line-type')).attr('id', 'acnttype_' + rnum);
					newEntry.find($('input[name="line_amount[]"]')).attr('id', 'amount_' + rnum);
					newEntry.find($('input[name="actual_amount[]"]')).attr('id', 'actamt_' + rnum);
					//newEntry.find($('.line-job')).attr('id', 'jobid_' + rnum);
					 newEntry.find($('input[name="job_id[]"]')).attr('id', 'jobid_' + rnum);
			        newEntry.find($('input[name="jobcod[]"]')).attr('id', 'jobcod_' + rnum);
					newEntry.find($('.line-dept')).attr('id', 'dept_' + rnum);
					newEntry.find($('input[name="cheque_no[]"]')).attr('id', 'chkno_' + rnum);
					newEntry.find($('input[name="cheque_date[]"]')).attr('id', 'chkdate_' + rnum); 
					newEntry.find($('.line-bank')).attr('id', 'bankid_' + rnum);
					newEntry.find($('.divchq')).attr('id', 'chqdtl_' + rnum);
					newEntry.find($('.refdata')).attr('id', 'refdata_' + rnum);
					newEntry.find($('input[name="je_id[]"]')).attr('id', 'jeid_' + rnum);
					newEntry.find($('input[name="sales_invoice_id[]"]')).attr('id', 'invoiceid_' + rnum);
					newEntry.find($('input[name="bill_type[]"]')).attr('id', 'biltyp_' + rnum);
					newEntry.find($('input[name="tr_id[]"]')).attr('id', 'trid_' + rnum);

					newEntry.find($('input[name="department[]"]')).attr('id', 'dept_' + rnum);
					newEntry.find($('input[name="partyac_id[]"]')).attr('id', 'partyac_' + rnum);
					newEntry.find($('input[name="party_name[]"]')).attr('id', 'party_' + rnum);
					newEntry.find($('.btn-remove-item')).attr('data-id','rem_'+rnum);
					newEntry.find($('input[name="salesman_idd[]"]')).attr('id', 'salesmanid_' + rowNum);
			         newEntry.find($('input[name="salesman[]"]')).attr('id', 'salesman_' + rowNum);
			         newEntry.find($('.salem')).attr('id', 'salem_' + rowNum);

					$('#jeid_'+rowNum).val('');
					
					
			} //console.log(no+' ab '+ids[i]);

			if(no < $('#rowNum').val()) {
				$('#ref_'+rowNum).val( refs[i] );
				$('#amount_'+rowNum).val(amounts[i]);
				$('#invid_'+rowNum).val( inv[i] );
				$('#acnttype_'+rowNum).find('option').remove().end().append('<option value="'+type[i]+'">'+type[i]+'</option>');
				$('#biltyp_'+rowNum).val( btype[i] );
				//$('#jeid_'+rnum).val('');//$('#jeid_'+rowNum).val('');
				$('#invoiceid_'+rowNum).val(inv[i]);
				$('#actamt_'+rowNum).val('');
				$('#trid_'+rowNum).val('');
				$('#draccount_'+rowNum).val( $('#draccount_'+no).val() );
				$('#draccountid_'+rowNum).val( $('#draccountid_'+no).val() );
				
				
			} else { 
				$('#ref_'+rnum).val( refs[i] );
				$('#amount_'+rnum).val(amounts[i]);
				$('#invid_'+rnum).val( inv[i] );
				$('#acnttype_'+rnum).find('option').remove().end().append('<option value="'+type[i]+'">'+type[i]+'</option>');
				$('#biltyp_'+rnum).val( btype[i] );
				//$('#jeid_'+rnum).val('');
				$('#invoiceid_'+rnum).val(inv[i]);
				$('#actamt_'+rnum).val('');
				$('#trid_'+rnum).val('');
				$('#draccount_'+rnum).val( $('#draccount_'+no).val() );
				$('#draccountid_'+rnum).val( $('#draccountid_'+no).val() );

				
			}

			j++;
		});
		getNetTotal();
	
	});

    
    $(document).on('change', '.line-bank', function(e) { 
	    var res = this.id.split('_');
		var curNum = res[1];

		checkChequeNo(curNum);
	});
	
	var acurlall = "<?php echo e(url('account_master/get_account_all/')); ?>";
	$(document).on('click', 'input[name="party_name[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#paccount_data').load(acurlall+'/'+curNum, function(result){ //.modal-body item
			$('#myModal').modal({show:true});
		});
	});
	
	$(document).on('click', '#paccount_data .custRow', function(e) { 
		var num = $('#anum').val();
		$('#party_'+num).val( $(this).attr("data-name") );
		$('#partyac_'+num).val( $(this).attr("data-id") );
		checkChequeNo(num);
		$('#frmJournal').bootstrapValidator('revalidateField', 'party_name[]');
	});
});


function checkChequeNo(curNum) { 
	var chqno = $('#chkno_'+curNum).val();
	var oldcqno = $('#oldchkno_'+curNum).val();
	var bank = $('#bankid_'+curNum+' option:selected').val();
	var ac = $('#partyac_'+curNum).val();
	if(oldcqno != chqno) {
		$.ajax({
			url: "<?php echo e(url('account_master/check_chequeno/')); ?>",
			type: 'get',
			data: 'chqno='+chqno+'&bank_id='+bank+'&ac_id='+ac,
			success: function(data) { 
				if(data=='') {
					alert('Cheque no is duplicate!');
					$('#chkno_'+curNum).val('');
				}
			}
		})
	}
}

function getNetTotal() {
	var drLineTotal = 0; var crLineTotal = 0;
	$( '.itemdivPrnt .jvline-amount' ).each(function() {
		var res = this.id.split('_');
		var curNum = res[1];
		if(this.value!='') {
			if( $('#acnttype_'+curNum+' option:selected').val()=='Dr' )
				drLineTotal = drLineTotal + parseFloat( (this.value=='')?0:this.value );
			else if( $('#acnttype_'+curNum+' option:selected').val()=='Cr' )
				crLineTotal = crLineTotal + parseFloat( (this.value=='')?0:this.value );
			
		}
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

function getTag(e) {
	var res = e.id.split('_');
	var curNum = res[1];
	if( $("#tag_"+curNum).is(':checked') ) {
		var curamount = $("#hidamt_"+curNum).val();
		$("#lineamnt_"+curNum).val(curamount);	
		//getNetTotal();
	} else {
		$("#lineamnt_"+curNum).val('');
		//getNetTotal();
	}
	
}

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>