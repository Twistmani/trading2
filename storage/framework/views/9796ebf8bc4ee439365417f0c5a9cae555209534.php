<?php /* Page title */ ?>
<?php $__env->startSection('title'); ?>
    Edit Customer Receipt Voucher
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
        <h1>Customer Receipt</h1>
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

    <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

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

    <!--section ends-->
    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-crosshairs"></i> Edit Receipt Voucher
                        </h3>

                        <div class="pull-right">
                            <?php if (\Entrust::can(('rv-print'))) : ?>
                                <a href="<?php echo e(url('customer_receipt/print2/'.$crrow->id.'/'.$prints[0]->id)); ?>" target="_blank" class="btn btn-info btn-sm">
                                    <span class="btn-label"><i class="fa fa-fw fa-print"></i></span>
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
                                <?php if(isset($formdata) && isset($formdata['send_email']) && $formdata['send_email']==1): ?>
                                    <input type="hidden" name="send_email" value="1">
                                <?php else: ?>
                                    <input type="hidden" name="send_email" value="0">
                                <?php endif; ?>
                                <input type="hidden" id="remitem" name="remove_item">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Voucher Type</label>
                                    <div class="col-sm-10">
                                        <select id="voucher_type" class="form-control select2" style="width:100%" name="voucher_type">
                                            <option value="<?php echo e($crrow->voucher_type); ?>">RV - Receipt Voucher</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Voucher</label>
                                    <div class="col-sm-10">
                                        <select id="voucher" class="form-control select2" style="width:100%" name="voucher">
                                            <?php foreach($vouchertype as $row): ?>
                                                <option value="<?php echo e($row->id); ?>" <?php echo e($row->id == $crrow->voucher ? 'selected' : ''); ?>><?php echo e($row->name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">RV. No.</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="voucher_no" value="<?php echo e($crrow->voucher_no); ?>" readonly name="voucher_no">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">RV. Date</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control pull-right" name="voucher_date" value="<?php echo e(date('d-m-Y', strtotime($crrow->voucher_date))); ?>" data-language='en' id="voucher_date" placeholder="Voucher Date" autocomplete="off"/>
                                    </div>
                                </div>

                                <br/>

                                <fieldset>
                                    <legend><h5>Transactions</h5></legend>

                                    <?php  $i = 0;  ?>
                                    <input type="hidden" id="rowNum" value="<?php echo e(count($invoicerow) > 0 ? count($invoicerow) : 1); ?>">

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
                                    <label class="col-sm-2 control-label">Total Debit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="debit" name="debit" readonly value="<?php echo e(number_format((float)$crrow->debit, 2, '.', '')); ?>" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Total Credit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="credit" name="credit" readonly value="<?php echo e(number_format((float)$crrow->credit, 2, '.', '')); ?>" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Difference</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="difference" name="difference" readonly value="<?php echo e(number_format((float)$crrow->difference, 2, '.', '')); ?>" placeholder="0.00">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary submit">Submit</button>
                                        <a href="<?php echo e(url('journal')); ?>" class="btn btn-danger">Cancel</a>
                                        <a href="<?php echo e(url('journal')); ?>" class="btn btn-warning">Clear</a>
                                    </div>
                                </div>
                            </form>

                            <?php /* Modals */ ?>
                            <div id="account_modal" class="modal fade animated" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Select Account</h4>
                                        </div>
                                        <div class="modal-body" id="account_data"></div>
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
                                        <div class="modal-body" id="invoiceData"></div>
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
                                        <div class="modal-body" id="jobData"></div>
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
                                        <div class="modal-body" id="salesmanData"></div>
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
                                        <div class="modal-body" id="paccount_data"></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- /.controls -->
                    </div> <!-- /.panel-body -->
                </div> <!-- /.panel -->

            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>


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
/* =========================================================
   Profit ACC 365 — Receipt Voucher (Edit)
   Mirrors Add form behavior with edit-only fields retained
   - Dynamic Add/Remove rows
   - jQuery Validate for all rows (including new ones)
   - PDC/BANK handling
   - No VAT auto-add logic
========================================================= */
"use strict";

/* ---------- URLs (server endpoints) ---------- */
var joburl   = "<?php echo e(url('jobmaster/job_data/')); ?>";
var acurl    = "<?php echo e(url('account_master/get_accounts/')); ?>";
var acurlAll = "<?php echo e(url('account_master/get_account_all/')); ?>";
var supurl   = "<?php echo e(url('sales_invoice/salesman_data/')); ?>";
var trnurl   = "<?php echo e(url('journal/set_transactions/')); ?>";

/* ---------- Datepickers ---------- */
$('#voucher_date').attr('readonly', true);
$('#voucher_date').datepicker({ autoClose: true, dateFormat: 'dd-mm-yyyy' });
if ($('#voucher_date').data('datepicker')) {
  $('#voucher_date').data('datepicker').selectDate(new Date());
}
$('.chqdate').datepicker({ language: 'en', autoClose: true, dateFormat: 'dd-mm-yyyy' });

/* ---------- Select2 (if present) ---------- */
if ($.fn.select2) {
  $('.select2').each(function() {
    if ($(this).data('select2')) $(this).select2('destroy');
    $(this).select2();
  });
}

/* ---------- Helpers ---------- */
function isPdcRow(idx){
  var g = $('#groupid_' + idx).val();
  return (g === 'PDCR' || g === 'PDCI');
}
function customErrorPlacement(error, element){
  var id = element.attr('id') || '';
  if (element.hasClass('select2-hidden-accessible') && element.next('.select2').length) {
    error.insertAfter(element.next('.select2'));
  } else if (id.indexOf('draccountid_') === 0) {
    var idx = id.split('_').pop();
    error.insertAfter($('#draccount_' + idx));
  } else {
    error.insertAfter(element);
  }
}
function ensureVisibleError($el){
  if (typeof validator !== 'undefined') {
    validator.element($el);
    var $firstErr = $('.text-danger:visible').first();
    if ($firstErr.length) $('html, body').animate({ scrollTop: $firstErr.offset().top - 120 }, 200);
  }
}
function safeResetValidator(){
  var v = $('#frmJournal').data('validator');
  if (v && typeof v.resetForm === 'function') v.resetForm();
}

/* ---------- Balanced rule ---------- */
jQuery.validator.addMethod('balanced', function(_, __){
  var dr = parseFloat($('#debit').val()  || 0);
  var cr = parseFloat($('#credit').val() || 0);
  return Math.abs(dr - cr) < 0.00001;
}, 'Debit and Credit must be equal.');

/* ---------- Validator ---------- */
var validator = $('#frmJournal').validate({
  ignore: [],
  errorClass: 'text-danger',
  errorElement: 'span',
  focusInvalid: false,
  errorPlacement: customErrorPlacement,
  highlight: function(el){ $(el).addClass('has-error'); },
  unhighlight: function(el){ $(el).removeClass('has-error'); },
  rules: {
    voucher_type: { required: true },
    voucher_no:   { required: true },
    voucher_date: { required: true },
    debit:  { balanced: true },
    credit: { balanced: true }
  },
  messages: {
    voucher_type: "Voucher type is required.",
    voucher_no:   "Voucher number is required.",
    voucher_date: "Voucher date is required."
  },
  invalidHandler: function(form, v){
    if (v.errorList.length) $(v.errorList[0].element).focus();
    $('#debit').valid(); $('#credit').valid();
  },
  submitHandler: function(form) {
    var formValid = $('#frmJournal').valid(); // recheck top-level rules
    var allRowsOK = validateAllRows();

    // account_id[] presence
    $('input[name="account_id[]"]').each(function(){
      if (!$(this).val() || $(this).val().trim() === '') {
        var idx = (this.id || '').split('_')[1];
        ensureVisibleError($('#draccountid_' + idx));
        allRowsOK = false;
      }
    });

    // check totals
    if (!$('#debit').valid() || !$('#credit').valid()) allRowsOK = false;

    if (!formValid || !allRowsOK) {
      alert('⚠️ Some required fields are missing or invalid.\nPlease check highlighted fields and correct them before submitting.');
      var $firstErr = $('.text-danger:visible').first();
      if ($firstErr.length) $('html, body').animate({ scrollTop: $firstErr.offset().top - 120 }, 400);
      return false;
    }
    // 🚫 Prevent submit if duplicate cheque no exists
if (!checkDuplicateChequeNo()) {
    alert("Duplicate Cheque No detected for same Bank and Party. Please correct it before submitting.");
    return false;
}


    // ✅ Everything OK
    form.submit();
  }
});

/* Safety: if anyone bypasses submitHandler somehow */
$('#frmJournal').on('submit', function(e){
  var validForm = $(this).valid();
  var validRows = validateAllRows();
  if (!validForm || !validRows) {
    e.preventDefault();
    console.warn('Form blocked — incomplete or invalid data.');
    return false;
  }
});

/* ---------- Per-row rules ---------- */
function addRulesForRow(idx){
  function addRule(selector, ruleObj){
    var $el = $(selector);
    if ($el.length) { $el.rules('remove'); $el.rules('add', ruleObj); }
  }
  var pdcDepends = function(){ return isPdcRow(idx); };

  addRule('#draccountid_' + idx, { required: true, messages: { required: 'Account is required.' } });
  addRule('#ref_'        + idx,  { required: true, messages: { required: 'Reference is required.' } });
  addRule('#amount_'     + idx,  { required: true, number: true, min: 0.01,
                                   messages: { required: 'Amount is required.', number: 'Enter a valid number.', min: 'Amount must be greater than zero.' } });
  addRule('#bankid_'     + idx,  { required: { depends: pdcDepends }, messages: { required: 'Bank is required for PDC.' } });
  addRule('#chkno_'      + idx,  { required: { depends: pdcDepends }, messages: { required: 'Cheque no is required for PDC.' } });
  addRule('#chkdate_'    + idx,  { required: { depends: pdcDepends }, messages: { required: 'Cheque date is required for PDC.' } });
  addRule('#party_'      + idx,  { required: { depends: pdcDepends }, messages: { required: 'Party name is required for PDC.' } });
}

function validateRow(idx){
  addRulesForRow(idx);
  var ok = true;

  var basic = ['#draccountid_','#ref_','#amount_'];
  for (var i = 0; i < basic.length; i++){
    var $el = $(basic[i] + idx);
    if ($el.length) ok = validator.element($el) && ok;
  }

  if (isPdcRow(idx)){
    var pdc = ['#bankid_','#chkno_','#chkdate_','#party_'];
    for (var j = 0; j < pdc.length; j++){
      var $el2 = $(pdc[j] + idx);
      if ($el2.length) ok = validator.element($el2) && ok;
    }
  }
  return ok;
}

function validateAllRows(){
  var allOk = true;
  $('.itemdivPrnt .classtrn').each(function(){
    var id = $(this).attr('id'); if (!id) return;
    var idx = parseInt(id.split('_')[1], 10);
    if (!validateRow(idx)) allOk = false;
  });
  return allOk;
}

/* ---------- Totals ---------- */
function getNetTotal(){
  var dr = 0, cr = 0;
  $('.jvline-amount').each(function(){
    var v   = parseFloat(this.value || 0);
    var idx = (this.id || '').split('_').pop();
    var t   = $('#acnttype_' + idx).val();
    if (t === 'Dr') dr += (isNaN(v) ? 0 : v);
    if (t === 'Cr') cr += (isNaN(v) ? 0 : v);
  });
  $('#debit').val(dr.toFixed(2));
  $('#credit').val(cr.toFixed(2));
  $('#difference').val((dr - cr).toFixed(2));
  $('#debit').valid(); $('#credit').valid();
}

/* ---------- Cheque duplicate check ---------- */
function checkChequeNo(curNum){
  var chqno  = $('#chkno_' + curNum).val();
  var oldNo  = $('#oldchkno_' + curNum).val();
  var bank   = $('#bankid_' + curNum + ' option:selected').val();
  var party  = $('#partyac_' + curNum).val();
  if (oldNo != chqno && chqno){
    $.ajax({
      url: "<?php echo e(url('account_master/check_chequeno/')); ?>",
      type: 'get',
      data: 'chqno=' + encodeURIComponent(chqno) + '&bank_id=' + encodeURIComponent(bank) + '&ac_id=' + encodeURIComponent(party),
      success: function(data){
        if (data === ''){
          alert('Cheque no is duplicate!');
          $('#chkno_' + curNum).val('').valid();
        }
      }
    });
  }
}
$(document).on('blur', 'input[name="cheque_no[]"]', function(){
  var idx = (this.id || '').split('_').pop();
  checkChequeNo(idx);
});
$(document).on('change', '.line-bank', function(){
  var idx = (this.id || '').split('_').pop();
  checkChequeNo(idx);
});
/* ---------- Duplicate Cheque Validation (same bank + party) ---------- */
function checkDuplicateChequeNo() {
    var duplicates = [];
    var seen = {};

    $('.itemdivPrnt .classtrn').each(function() {
        var id = this.id.split('_')[1];
        var bank  = $('#bankid_' + id).val();
        var chq   = ($('#chkno_' + id).val() || '').trim();
        var party = $('#partyac_' + id).val();

        if (bank && chq && party) {
            var key = bank + '|' + chq + '|' + party;
            if (seen[key]) {
                duplicates.push(id);
                duplicates.push(seen[key]); // highlight both rows
            } else {
                seen[key] = id;
            }
        }
        
    });

    // Remove duplicate indexes
    duplicates = [...new Set(duplicates)];

    // Clear old errors
    $('input[name="cheque_no[]"]').each(function() {
        var id = this.id.split('_')[1];
        $('#chkno_' + id).removeClass('is-invalid');
        $('#chkno_' + id + '-dup-error').remove();
    });

    // Add new error labels
    duplicates.forEach(function(id) {
        var $chq = $('#chkno_' + id);
        if ($chq.length) {
            $chq.addClass('is-invalid');
            if (!$('#chkno_' + id + '-dup-error').length) {
                $('<label id="chkno_' + id + '-dup-error" class="text-danger">Duplicate cheque no for same bank & party.</label>')
                    .insertAfter($chq);
            }
        }
    });

    return duplicates.length === 0;
}
// 🔹 Recheck duplicates whenever cheque, bank, or party changes
$(document).on('keyup blur change', 'input[name="cheque_no[]"], select[name="bank_id[]"], input[name="party_name[]"]', function() {
    checkDuplicateChequeNo();
});

/* ---------- Open Account modal (choose ledger) ---------- */
$(document).on('click', 'input[name="account_name[]"]', function(){
  var idx = (this.id || '').split('_').pop();
  $('#account_data').load(acurl + '/' + idx, function(){
    $('#account_modal').modal('show');
  });
});

/* ---------- Choose Account from modal (handles PDC/BANK/NORMAL) ---------- */
$(document).on('click', '#account_modal .custRow', function(){
  var num   = $('#num').val();
  var name  = $(this).attr('data-name');
  var id    = $(this).attr('data-id');
  var group = $(this).attr('data-group');

  $('#draccount_'   + num).val(name);
  $('#draccountid_' + num).val(id);
  $('#groupid_'     + num).val(group);

  if (group === 'PDCR' || group === 'PDCI'){
	if(group === 'PDCI')
		alert('Are you sure the PDCI gets settled through the Receipt Voucher?');
    var typeOpt = (group === 'PDCR') ? 'Dr' : 'Cr';
    $('#acnttype_' + num).html('<option value="' + typeOpt + '">' + typeOpt + '</option>');
    var pdcUrl = trnurl + '/PDC/' + id + '/' + num;
    if ($('#jeid_' + num).val() !== '') pdcUrl += '/' + $('#jeid_' + num).val();

    $('#trns_' + num).load(pdcUrl, function(){
      addRulesForRow(num);
      $('#bankid_' + num).rules('add', { required: true, messages: { required: 'Bank is required.' } });
      $('#chkno_'  + num).rules('add', { required: true, messages: { required: 'Cheque no is required.' } });
      $('#chkdate_'+ num).rules('add', { required: true, messages: { required: 'Cheque date is required.' } });
      $('#party_'  + num).rules('add', { required: true, messages: { required: 'Party name is required.' } });
      $('#chqdtl_' + num).show();
      safeResetValidator();
    });
  } else if (group === 'BANK'){
    var bankUrl = trnurl + '/BANK/' + id + '/' + num;
    if ($('#jeid_' + num).val() !== '') bankUrl += '/' + $('#jeid_' + num).val();
    $('#trns_' + num).load(bankUrl, function(){
      addRulesForRow(num);
      $('#chqdtl_' + num).hide();
      safeResetValidator();
    });
  } else {
    // Customer extras
    if (group === 'CUSTOMER'){
      if ($('#salem_' + num).is(':hidden')) $('#salem_' + num).toggle();
      $('#salesmanid_' + num).val($(this).attr('data-salesmanid'));
      $('#salesman_'   + num).val($(this).attr('data-salesman'));
    } else {
      $('#salem_' + num).hide();
      $('#salesmanid_' + num).val('');
      $('#salesman_'   + num).val('');
    }
    $('#acnttype_' + num).html('<option value="Dr">Dr</option><option value="Cr">Cr</option>');
	$('#trns_'+num+' .pdcfm').hide();
		$('#trns_'+num+' .nopdc1').attr("style", "width:17%;");
		$('#trns_'+num+' .nopdc2').attr("style", "width:25%;");
		$('#trns_'+num+' .nopdc3').attr("style", "width:15%;");
		$('#trns_'+num+' .nopdc4').attr("style", "width:8%;");
		$('#trns_'+num+' .nopdc5').attr("style", "width:13%;");
		$('#trns_'+num+' .nopdc6').attr("style", "width:17%;");

   // $('#trns_' + num + ' .pdcfm').hide();
   // $('#chqdtl_' + num).hide();
  }

  // Reference field type
  if (group === 'SUPPLIER' || group === 'CUSTOMER' || group === 'VATIN' || group === 'VATOUT'){
    $('#refdata_' + num).html('<input type="text" id="ref_' + num + '" name="reference[]" class="form-control ref-invoice" autocomplete="off" data-toggle="modal" data-target="#reference_modal">');
  } else {
    $('#refdata_' + num).html('<input type="text" id="ref_' + num + '" name="reference[]" class="form-control" autocomplete="off">');
  }

  ensureVisibleError($('#draccountid_' + num));
  addRulesForRow(num);
  getNetTotal();
});

/* ---------- Party modal (open + choose) ---------- */
$(document).on('click', 'input[name="party_name[]"]', function(){
  var idx = this.id.split('_')[1];
  $('#paccount_data').load(acurlAll + '/' + idx, function(){
    $('#paccount_modal').modal('show');
  });
});
$(document).on('click', '#paccount_data .custRow', function(){
  var num = $('#anum').val();
  $('#party_'   + num).val($(this).attr('data-name'));
  $('#partyac_' + num).val($(this).attr('data-id'));
  checkChequeNo(num);
  $('#party_' + num).valid();
});

/* ---------- Salesman modal (open + choose) ---------- */
$(document).on('click', 'input[name="salesman[]"]', function(){
  var idx = (this.id || '').split('_').pop();
  $('#salesmanData').load(supurl + '/' + idx, function(){
    $('#salesman_modal').modal('show');
  });
});
$(document).on('click', '#salesman_modal .custRow', function(){
  var num = $('#snum').val();
  $('#salesman_'   + num).val($(this).attr('data-name'));
  $('#salesmanid_' + num).val($(this).attr('data-id'));
});

/* ---------- Job modal (open + choose) ---------- */
$(document).on('click', 'input[name="jobcod[]"]', function(){
  var idx = (this.id || '').split('_').pop();
  $('#jobData').load(joburl + '/' + idx, function(){
    $('#job_modal').modal('show');
  });
});
$(document).on('click', '#job_modal .jobRow', function(){
  var num = $('#jnum').val();
  $('#jobcod_' + num).val($(this).attr('data-code'));
  $('#jobid_'  + num).val($(this).attr('data-id'));
});

/* ---------- Reference modal (open) ---------- */
$(document).on('click', '.ref-invoice', function(e){
  e.preventDefault();
  var num = this.id.split('_')[1];
  var grp = $('#groupid_' + num).val();
  if (grp === 'CUSTOMER' || grp === 'SUPPLIER' || grp === 'VATIN' || grp === 'VATOUT'){
    var url = "<?php echo e(url('account_enquiry/os_bills/')); ?>/" + $('#draccountid_' + num).val();
    $('#invoiceData').load(url + '/' + num, function(){
      $('#reference_modal').modal('show');
    });
  }
});
$('#reference_modal').on('hidden.bs.modal', safeResetValidator);

/* ---------- Add Selected Invoices → clone rows ---------- */
$(document).on('click', '.add-invoice', function(e){
  e.preventDefault();

  var refs = [], amounts = [], types = [], invIds = [], billTypes = [], actAmts = [];
  $("input[name='tag[]']:checked").each(function(){
    var idx = this.id.split('_')[1];
    refs.push($('#refid_' + idx).val());
    amounts.push($('#lineamnt_' + idx).val());
    types.push($('#trtype_' + idx).val());
    invIds.push($('#sinvoiceid_' + idx).val());
    billTypes.push($('#billtype_' + idx).val());
    actAmts.push($('#hidamt_' + idx).val());
  });

  
  if (!refs.length){ alert('Please select at least one reference invoice.'); return; }

  var baseRow    = parseInt($('#bnum').val(), 10);
  var curRowNum  = parseInt($('#rowNum').val(), 10);
  var $container = $('.controls .itemdivPrnt');

  var drac = $('#draccount_'+baseRow).val();
  var dracid = $('#draccountid_'+baseRow).val();

  for (var i = 0; i < refs.length; i++){
    if (i > 0){
      var $current = $('.itemdivChld:last', $container);
      var $new     = $($current.clone()).appendTo($container);
      curRowNum++;
      $('#rowNum').val(curRowNum);

      $new.find('label.error').remove();
      $new.find('.has-error,.is-invalid,.is-valid').removeClass('has-error is-invalid is-valid');

      $new.find('[id]').each(function(){
        var nid = $(this).attr('id');
        if (nid) $(this).attr('id', nid.replace(/\d+$/, curRowNum));
      });
      $new.find('.classtrn').attr('id', 'trns_' + curRowNum);
      $new.find('.btn-remove-item').attr('data-id', 'rem_' + curRowNum);
      $new.find('.divchq').attr('id','chqdtl_' + curRowNum).hide();
      $new.find('.refdata').attr('id','refdata_' + curRowNum);
      $new.find('.salem').attr('id','salem_' + curRowNum);
    }

    $('#ref_' + curRowNum).val(refs[i]);

    var invAmt = parseFloat(amounts[i]) || 0;
    if (!invAmt || invAmt <= 0) invAmt = parseFloat(actAmts[i]) || 0;
    $('#amount_' + curRowNum).val(invAmt ? invAmt.toFixed(2) : '');

    $('#invoiceid_' + curRowNum).val(invIds[i]);
    $('#biltyp_'   + curRowNum).val(billTypes[i]);
    $('#acnttype_' + curRowNum).html('<option value="' + types[i] + '">' + types[i] + '</option>');

    // copy account info from base row
    $('#draccount_'   + curRowNum).val($('#draccount_'   + baseRow).val());
    $('#draccountid_' + curRowNum).val($('#draccountid_' + baseRow).val());
    $('#groupid_'     + curRowNum).val($('#groupid_'     + baseRow).val());

    addRulesForRow(curRowNum);
  }

  getNetTotal();
  $('#reference_modal').modal('hide');
});

/* ---------- Add / Remove Row Buttons ---------- */
var rowNum = parseInt($('#rowNum').val() || 1, 10);

function refreshButtons(){
  var $rows = $('.itemdivPrnt .itemdivChld');
  $rows.find('.btn-add-item').hide();
  $rows.find('.btn-remove-item').show();
  if ($rows.length === 1) $rows.find('.btn-remove-item').hide();
  $rows.last().find('.btn-add-item').show();
}
refreshButtons();

$(document).on('click', '.btn-add-item', function(e){
		e.preventDefault();
		var $last   = $('.itemdivPrnt .itemdivChld').last();
		var lastIdx = parseInt(($last.find('.classtrn').attr('id') || 'trns_0').split('_')[1], 10);

		if (!validateRow(lastIdx)){
			ensureVisibleError($('#draccountid_' + lastIdx));
			ensureVisibleError($('#ref_'        + lastIdx));
			ensureVisibleError($('#amount_'     + lastIdx));
			return false;
		}

		rowNum++; $('#rowNum').val(rowNum);
		var $new = $last.clone(true, true).appendTo('.itemdivPrnt');

		$new.find('label.error').remove();
		$new.find('.has-error,.is-invalid,.is-valid').removeClass('has-error is-invalid is-valid');
		$new.find('input[type="text"], input[type="number"], textarea').val('');
		$new.find('select').val('').trigger('change');

		$new.find('[id]').each(function(){
			var id = $(this).attr('id');
			if (id && id.indexOf('_') > -1) $(this).attr('id', id.split('_')[0] + '_' + rowNum);
		});

		$new.find('.classtrn').attr('id', 'trns_' + rowNum);
		$new.find('.btn-remove-item').attr('data-id', 'rem_' + rowNum);
		$new.find('.divchq').attr('id', 'chqdtl_' + rowNum).hide();
		$new.find('.refdata').attr('id', 'refdata_' + rowNum);
		$new.find('.salem').attr('id', 'salem_' + rowNum).hide();

		// clear IDs used in edit so the new row is “new”
		$('#groupid_'   + rowNum).val('');
		$('#jeid_'      + rowNum).val('');
		$('#draccountid_'+ rowNum).val('');
		$('#jobid_'     + rowNum).val('');
		$('#invid_'     + rowNum).val('');
		$('#partyac_'   + rowNum).val('');
		$('#salesmanid_'+ rowNum).val('');
		$('#biltyp_'    + rowNum).val('');
		$('#trid_'      + rowNum).val('');
		$('#invoiceid_'      + rowNum).val('');

		if ($.fn.select2) {
			$new.find('.select2').each(function(){
			if ($(this).data('select2')) $(this).select2('destroy');
			$(this).select2();
			});
		}
		$new.find('.chqdate').removeData('datepicker').datepicker({ language: 'en', autoClose: true, dateFormat: 'dd-mm-yyyy' });

		addRulesForRow(rowNum);
		getNetTotal();
		refreshButtons();
});

$(document).on('click', '.btn-remove-item', function(e){
  e.preventDefault();

  var $btn = $(this);
  var curId = $btn.attr('data-id');
  var curNum = '';

  // Fallback: try to get number from parent row ID if missing
  if (curId && curId.indexOf('_') > -1) {
    curNum = curId.split('_')[1];
  } else {
    var $row = $btn.closest('.classtrn');
    if ($row.length) {
      var rid = $row.attr('id') || '';
      if (rid.indexOf('_') > -1) curNum = rid.split('_')[1];
    }
  }

  if (!curNum) {
    console.warn('⚠️ btn-remove-item clicked without valid data-id or row id');
    return;
  }

  // Track deleted row IDs
  var remitem = $('#remitem').val();
  var toAdd   = $('#jeid_' + curNum).val();
  if (toAdd) $('#remitem').val(remitem ? remitem + ',' + toAdd : toAdd);

  // Remove row
  $btn.closest('.itemdivChld').remove();

  // Renumber rows and fix data-id attributes
  $('.itemdivPrnt .itemdivChld').each(function(i){
    var idx = i + 1;
    $(this).find('[id]').each(function(){
      var id = $(this).attr('id');
      if (id && id.indexOf('_') > -1) {
        $(this).attr('id', id.split('_')[0] + '_' + idx);
      }
    });
    $(this).find('.btn-remove-item').attr('data-id', 'rem_' + idx);
  });

  $('#rowNum').val($('.itemdivChld').length);
  getNetTotal();
  refreshButtons();
});


/* ---------- Field hooks ---------- */
$(document).on('keyup change', '.jvline-amount, .line-type', getNetTotal);
$(document).on('blur', '#voucher_date', function(){ $('#voucher_date').valid(); });
$(document).on('blur', '.acname', function(){
  $('.acname').each(function(){
    var idx = (this.id || '').split('_').pop();
    $('#draccountid_' + idx).valid();
  });
});

/* ---------- Invoice tag helper (optional) ---------- */
function getTag(e){
  var res = e.id.split('_');
  var i   = res[1];
  if ($("#tag_" + i).is(':checked')) {
    $("#lineamnt_" + i).val($("#hidamt_" + i).val());
  } else {
    $("#lineamnt_" + i).val('');
  }
}
window.getTag = getTag;

/* ---------- First-load: attach rules to existing rows + totals ---------- */
function initRowsSetup(){
  $('.itemdivPrnt .classtrn').each(function(){
    var id  = $(this).attr('id'); if (!id) return;
    var idx = parseInt(id.split('_')[1], 10);
    addRulesForRow(idx);

    // If existing row is PDC in edit mode, ensure its PDC blocks are visible
    if (isPdcRow(idx)){
      $('#trns_' + idx + ' .pdcfm').show();
      $('#chqdtl_' + idx).show();
    }
  });
  getNetTotal();
  refreshButtons();
}
initRowsSetup();

/* ---------- Expose (if needed elsewhere inline) ---------- */
window.getNetTotal     = getNetTotal;
window.addRulesForRow  = addRulesForRow;
window.validateRow     = validateRow;
window.validateAllRows = validateAllRows;
window.refreshButtons  = refreshButtons;
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>