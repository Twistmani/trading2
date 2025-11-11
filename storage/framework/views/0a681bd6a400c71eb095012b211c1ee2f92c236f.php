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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<!-- ==================== BASE LIBRARIES ==================== -->

<!-- ==================== DATATABLES CORE FIRST ==================== -->
<script src="<?php echo e(asset('assets/vendors/datatables/js/jquery.dataTables.js')); ?>"></script>

<!-- ==================== DATATABLES EXTENSIONS ==================== -->
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.buttons.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.colReorder.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.responsive.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.rowReorder.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/buttons.colVis.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/buttons.html5.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/buttons.bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/buttons.print.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendors/datatables/js/dataTables.scroller.js')); ?>"></script>

<!-- ==================== JQUERY VALIDATION ==================== -->

<!-- ==================== PAGE SCRIPT ==================== -->
<script>
"use strict";

var IS_PDC = <?php echo e($ispdc ? 'true' : 'false'); ?>;

// ==========================
// === VALIDATION SETUP ====
// ==========================
(function setupValidation() {

    // Debit = Credit validation rule
    jQuery.validator.addMethod("balanced", function(value, element) {
        var dr = parseFloat($('#debit').val() || 0);
        var cr = parseFloat($('#credit').val() || 0);
        return Math.abs(dr - cr) < 0.00001;
    }, "Debit and Credit must be equal.");

    // Required only for PDC rows
    jQuery.validator.addMethod("requiredIfPDC", function(value, element) {
        const id = element.id || "";
        const rowNum = id.split('_').pop();
        const groupVal = $('#groupid_' + rowNum).val();
        const isPdc = (groupVal === 'PDCR' || groupVal === 'PDCI');
        if (!isPdc) return true;
        return $.trim(value).length > 0;
    }, "This field is required for PDC rows.");

    $('#frmJournal').validate({
        ignore: [],
        errorClass: 'text-danger',
        errorElement: 'span',
        focusInvalid: false,
        rules: {
            voucher_type: { required: true },
            voucher_no:   { required: true },
            voucher_date: { required: true },
            'account_name[]': { required: true },
            'reference[]': { required: true },
            'line_amount[]':  { required: true, number: true, min: 0.01 },
            'bank_id[]':   { requiredIfPDC: true },
            'cheque_no[]': { requiredIfPDC: true },
            'cheque_date[]': { requiredIfPDC: true },
            'party_name[]':  { requiredIfPDC: true },
            debit:  { balanced: true },
            credit: { balanced: true }
        },
        messages: {
            voucher_type: "Voucher type is required.",
            voucher_no:   "Voucher no is required.",
            voucher_date: "Voucher date is required.",
            'account_name[]': "Account name is required.",
            'reference[]':  "Reference is required.",
            'line_amount[]': "Amount is required.",
            'bank_id[]':   "Bank is required for PDC.",
            'cheque_no[]': "Cheque no is required for PDC.",
            'cheque_date[]': "Cheque date is required for PDC.",
            'party_name[]':  "Party name is required for PDC."
        },
        errorPlacement: function(error, element) {
            if (element.hasClass('select2') || element.next('.select2').length) {
                error.insertAfter(element.closest('.select2'));
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) { $(element).addClass('has-error'); },
        unhighlight: function(element) { $(element).removeClass('has-error'); },

        invalidHandler: function() {
            $('#debit, #credit').valid();
        },

        submitHandler: function(form) {
            // validate full form again
            if (!$('#frmJournal').valid()) return false;

            // stop submission if empty rows exist
            var invalidRow = false;
            $('.itemdivPrnt .itemdivChld').each(function(){
                const acc = $(this).find('input[name="account_name[]"]').val().trim();
                const ref = $(this).find('input[name="reference[]"]').val().trim();
                const amt = $(this).find('input[name="line_amount[]"]').val().trim();
                if(acc === '' && ref === '' && amt === ''){
                    invalidRow = true;
                    $(this).addClass('has-error-row');
                } else {
                    $(this).removeClass('has-error-row');
                }
            });
            if (invalidRow) {
                alert('Empty rows detected. Please fill or remove them before submitting.');
                return false;
            }

            // check DR/CR equality again
            var dr = parseFloat($('#debit').val() || 0);
            var cr = parseFloat($('#credit').val() || 0);
            if (Math.abs(dr - cr) >= 0.00001) {
                $('#debit').valid();
                $('#credit').valid();
                return false;
            }

            form.submit();
        }
    });

    // add validation rules to all existing rows
    function addRulesForExistingRows() {
        $('.itemdivPrnt .itemdivChld').each(function() {
            $(this).find('input[name="account_name[]"]').rules('add', { required:true });
            $(this).find('input[name="line_amount[]"]').rules('add', { required:true, number:true });
            const groupVal = $(this).find('[id^=groupid_]').val();
            const isPdc = (groupVal === 'PDCR' || groupVal === 'PDCI');
            if (isPdc) {
                $(this).find('select[name="bank_id[]"]').rules('add',   { required:true });
                $(this).find('input[name="cheque_no[]"]').rules('add',  { required:true });
                $(this).find('input[name="cheque_date[]"]').rules('add',{ required:true });
                $(this).find('input[name="party_name[]"]').rules('add', { required:true });
            }
        });
    }
    addRulesForExistingRows();

    // helper for new dynamically added rows
    window.addRulesForRow = function(rowNum) {
        $('#draccount_'+rowNum).rules('add', { required:true });
        $('#ref_'+rowNum).rules('add', { required:true });
        $('#amount_'+rowNum).rules('add', { required:true, number:true, min:0.01 });

        const groupVal = $('#groupid_'+rowNum).val();
        const isPdc = (groupVal === 'PDCR' || groupVal === 'PDCI');
        if (isPdc) {
            $('#bankid_'+rowNum).rules('add',  { required:true });
            $('#chkno_'+rowNum).rules('add',   { required:true });
            $('#chkdate_'+rowNum).rules('add', { required:true });
            $('#party_'+rowNum).rules('add',   { required:true });
        }
    };

})(); // END validation setup


// ==========================
// === ORIGINAL FUNCTIONS ===
// ==========================
$(document).ready(function () {
    $('.itemdivPrnt').find('.btn-add-item:not(:last)').hide();
    if ( $('.itemdivPrnt').children().length == 1 ) {
        $('.itemdivPrnt').find('.btn-remove-item').hide();
    }

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
        $('#amount_fc').val('');
        $("#currency_rate").val('');
    });

    $('#voucher_type').on('change', function(e){
        $('#voucher_no').val('');
        var vchr_id = e.target.value; 
        $.get("<?php echo e(url('journal/getvouchertype/')); ?>/" + vchr_id, function(data) { 
            $('#voucher').empty();
            $('#voucher').append('<option value="">Select Voucher.</option>');
            $.each(data, function(value, display){
                 $('#voucher').append('<option value="'+value+'">'+display+'</option>');
            });
        });
    });

    // === Existing blur handlers ===
    $(document).on('blur', '#voucher_date', function(e) { 
        $('#voucher_date').valid();
        $('#voucher_no').valid();
    });

    $(document).on('blur', '.jvline-amount', function(e) { 
        $('#debit').valid();
        $('#credit').valid();
    });

    $(document).on('blur', '.acname', function(e) { 
        $('input[name="account_name[]"]').each(function(){ $(this).valid(); });
    });

    $(document).on('change', '.submit', function(e) { 
        $('#debit').valid();
        $('#credit').valid();
    });

    // === cheque number duplicate check ===
    $(document).on('blur', 'input[name="cheque_no[]"]', function(e) {
        var res = this.id.split('_');
        var curNum = res[1];
        checkChequeNo(curNum);
    });

    // === invoice modal reference handling ===
    $(document).on('click', '.ref-invoice', function(e) {
        var res = this.id.split('_');
        var curNum = res[1]; 
        if( $('#groupid_'+curNum).val()=='CUSTOMER') { 
            var rvid = $('#rv_id').val();
            var url = "<?php echo e(url('account_enquiry/os_bills/')); ?>/"+$('#draccountid_'+curNum).val();
            $('#invoiceData').load(url+'/'+curNum+'/RV/'+rvid, function(result){ 
                $('#myModal').modal({show:true});
            });
        } else if( $('#groupid_'+curNum).val()=='SUPPLIER' ) {
            var url = "<?php echo e(url('purchase_invoice/get_invoice/')); ?>/"+$('#draccountid_'+curNum).val();
            var reid = $('#jeid_'+curNum).val();
            if((reid!='') && (this.value!='')) {
                $('#invoiceData').load(url+'/'+curNum+'/'+this.value+'/'+reid, function(result){ 
                    $('#myModal').modal({show:true});
                });
            }
        }
    });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>