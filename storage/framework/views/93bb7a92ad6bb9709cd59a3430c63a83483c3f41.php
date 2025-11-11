<?php if($type=='PDC'): ?>
		<?php if($isdept): ?>
			<div class="col-xs-1" style="width:11%;"> <span class="small">Account Name</span>
			<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="<?php echo e($acdata->master_name); ?>" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
			<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="<?php echo e($acdata->id); ?>">
			<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="<?php echo e(($acdata->vat_assign==0)?$acdata->category:$acdata->vat_assign); ?>">
			<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="<?php echo e($acdata->vat_percentage); ?>">
			<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
			<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
			</div>
			
				<div class="col-xs-2" style="width:11%;">
					<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
				</div>
				<div class="col-xs-2" style="width:9%;">
					<span class="small">Reference</span> 
					<div id="refdata_<?php echo e($num); ?>" class="refdata">
					<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
					</div>
					<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
					<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
				</div>
				<div class="col-sm-1" style="width:6%;">
					<span class="small">Type</span> 
					<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
						<?php if($acdata->category=='PDCR'): ?>
						<option value="Dr">Dr</option>
						<?php else: ?>
						<option value="Cr">Cr</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-xs-1" style="width:10%;">
					<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" class="form-control jvline-amount">
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Bank</span> 
						<select id="bankid_<?php echo e($num); ?>" class="form-control select2 line-bank" style="width:100%" required name="bank_id[]">
						<option value="">Bank...</option>
						<?php foreach($banks as $bank): ?>
						<option value="<?php echo e($bank['id']); ?>"><?php echo e($bank['code']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Chq. No</span><input type="text" autocomplete="off" id="chkno_<?php echo e($num); ?>" required name="cheque_no[]" class="form-control" >
				</div>
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Chq. Date</span> <input type="text" autocomplete="off" id="chkdate_<?php echo e($num); ?>" required name="cheque_date[]" class="form-control chqdate" data-language='en'>
				</div>
				
				
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($num); ?>">
						<span class="small">Pty. Name</span> <input type="text" id="party_<?php echo e($num); ?>" name="party_name[]" autocomplete="off" class="form-control" required data-toggle="modal" data-target="#paccount_modal">
				</div>
				
				<div class="col-xs-1" style="width:8%;">
					<span class="small">Job</span> 
				
						<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
														
				</div>
				
				<div class="col-sm-1" style="width:8%;">
					<span class="small">Dept.</span> 
					<select id="dept_<?php echo e($num); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
						<option value="">Department...</option>
						<?php foreach($departments as $department): ?>
						<option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xm-1 abc" style="width:5%;">
					<button type="button" class="btn-danger btn-remove-item" >
						<i class="fa fa-fw fa-minus-square"></i>
					 </button><br/>
					 <button type="button" class="btn-success btn-add-item" >
						<i class="fa fa-fw fa-plus-square"></i>
					 </button>
				</div>
		<?php else: ?> <!-- PDC DEPARTMENT NOT -->
			<div class="col-xs-1 nopdc1" style="width:12%;"> <span class="small">Account Name</span>
			<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="<?php echo e($acdata->master_name); ?>" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
			<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="<?php echo e($acdata->id); ?>">
			<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="<?php echo e(($acdata->vat_assign==0)?$acdata->category:$acdata->vat_assign); ?>">
			<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="<?php echo e($acdata->vat_percentage); ?>">
			<?php if($acdata->category=='PDCR'): ?>
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
			<?php else: ?>
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="purchase_invoice_id[]">
			<?php endif; ?>
			<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
			<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
			</div>
			
				<div class="col-xs-2 nopdc2" style="width:12%;">
					<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
				</div>
				<div class="col-xs-2 nopdc3" style="width:10%;">
					<span class="small">Reference</span> 
					<div id="refdata_<?php echo e($num); ?>" class="refdata">
					<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
					</div>
					<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
					<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
				</div>
				<div class="col-sm-1 nopdc4" style="width:7%;">
					<span class="small">Type</span> 
					<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
						<?php if($acdata->category=='PDCR'): ?>
						<option value="Dr">Dr</option>
						<?php else: ?>
						<option value="Cr">Cr</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-xs-1 nopdc5" style="width:10%;">
					<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" class="form-control jvline-amount">
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:9%;">
					<span class="small">Bank</span> 
						<select id="bankid_<?php echo e($num); ?>" class="form-control select2 line-bank" style="width:100%" required name="bank_id[]">
						<option value="">Bank...</option>
						<?php foreach($banks as $bank): ?>
						<option value="<?php echo e($bank['id']); ?>"><?php echo e($bank['code']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Chq. No</span><input type="text" autocomplete="off" id="chkno_<?php echo e($num); ?>" name="cheque_no[]" required class="form-control" >
				</div>
				<div class="col-xs-1 pdcfm" style="width:9%;">
					<span class="small">Chq. Date</span> <input type="text" autocomplete="off" id="chkdate_<?php echo e($num); ?>" name="cheque_date[]" required class="form-control chqdate" data-language='en'>
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:9%;">
					<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($num); ?>">
						<span class="small">Pty. Name</span> <input type="text" id="party_<?php echo e($num); ?>" autocomplete="off" required name="party_name[]" class="form-control" data-toggle="modal" data-target="#paccount_modal">
				</div>
				
				<div class="col-xs-1 nopdc6" style="width:9%;">
					<span class="small">Job</span> 
				<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
								
				</div>
				
				<div class="col-sm-1 abc" style="width:5%;">
					<button type="button" class="btn-danger btn-remove-item" >
						<i class="fa fa-fw fa-minus-square"></i>
					 </button><br/>
					 <button type="button" class="btn-success btn-add-item" >
						<i class="fa fa-fw fa-plus-square"></i>
					 </button>
				</div>
		<?php endif; ?>
		
<?php elseif($type=='BANK' || $type=='BANKS' || $type=='BANKJ'): ?>
    <?php if($isdept): ?>
			<div class="col-xs-1" style="width:11%;"> <span class="small">Account Name</span>
			<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="<?php echo e($acdata->master_name); ?>" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
			<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="<?php echo e($acdata->id); ?>">
			<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="<?php echo e(($acdata->vat_assign==0)?$acdata->category:$acdata->vat_assign); ?>">
			<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="<?php echo e($acdata->vat_percentage); ?>">
			<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
			<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
			</div>
			
				<div class="col-xs-2" style="width:11%;">
					<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
				</div>
				<div class="col-xs-2" style="width:9%;">
					<span class="small">Reference</span> 
					<div id="refdata_<?php echo e($num); ?>" class="refdata">
					<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
					</div>
					<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
					<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
				</div>
				<div class="col-sm-1" style="width:6%;">
					<span class="small">Type</span> 
					<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
					    <?php if($type=='BANK'): ?>
						<option value="Dr">Dr</option>
						<?php elseif($type=='BANKS'): ?>
						<option value="Cr">Cr</option>
						<?php elseif($type=='BANKJ'): ?>
						<option value="Dr">Dr</option><option value="Cr">Cr</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-xs-1" style="width:10%;">
					<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" class="form-control jvline-amount">
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Chq. No</span><input type="text" autocomplete="off" id="chkno_<?php echo e($num); ?>" required name="cheque_no[]" class="form-control" >
				</div>
				<div class="col-xs-1 pdcfm" style="width:8%;">
					<span class="small">Chq. Date</span> <input type="text" autocomplete="off" id="chkdate_<?php echo e($num); ?>" required name="cheque_date[]" class="form-control chqdate" data-language='en'>
				</div>
				
				<div class="col-xs-1" style="width:8%;">
					<span class="small">Job</span> 
				
						<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
														
				</div>
				
				<div class="col-sm-1" style="width:8%;">
					<span class="small">Dept.</span> 
					<select id="dept_<?php echo e($num); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
						<option value="">Department...</option>
						<?php foreach($departments as $department): ?>
						<option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-xm-1 abc" style="width:5%;">
					<button type="button" class="btn-danger btn-remove-item" >
						<i class="fa fa-fw fa-minus-square"></i>
					 </button><br/>
					 <button type="button" class="btn-success btn-add-item" >
						<i class="fa fa-fw fa-plus-square"></i>
					 </button>
				</div>
		<?php else: ?> <!-- PDC DEPARTMENT NOT -->
			<div class="col-xs-1 nopdc1" style="width:18%;"> <span class="small">Account Name</span>
			<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="<?php echo e($acdata->master_name); ?>" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
			<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="<?php echo e($acdata->id); ?>">
			<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="<?php echo e(($acdata->vat_assign==0)?$acdata->category:$acdata->vat_assign); ?>">
			<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="<?php echo e($acdata->vat_percentage); ?>">
			<?php if($acdata->category=='BANK'): ?>
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
			<?php else: ?>
			<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="purchase_invoice_id[]">
			<?php endif; ?>
			<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
			<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
			</div>
			
				<div class="col-xs-2 nopdc2" style="width:17%;">
					<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
				</div>
				<div class="col-xs-2 nopdc3" style="width:12%;">
					<span class="small">Reference</span> 
					<div id="refdata_<?php echo e($num); ?>" class="refdata">
					<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
					</div>
					<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
					<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
				</div>
				<div class="col-sm-1 nopdc4" style="width:7%;">
					<span class="small">Type</span> 
					<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
						<?php if($type=='BANK'): ?>
						<option value="Dr">Dr</option>
						<?php elseif($type=='BANKS'): ?>
						<option value="Cr">Cr</option>
						<?php elseif($type=='BANKJ'): ?>
						<option value="Dr">Dr</option><option value="Cr">Cr</option>
						<?php endif; ?>
					</select>
				</div>
				<div class="col-xs-1 nopdc5" style="width:10%;">
					<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" class="form-control jvline-amount">
				</div>
				
				<div class="col-xs-1 pdcfm" style="width:10%;">
					<span class="small">Chq. No</span><input type="text" autocomplete="off" id="chkno_<?php echo e($num); ?>" name="cheque_no[]" required class="form-control" >
				</div>
				<div class="col-xs-1 pdcfm" style="width:9%;">
					<span class="small">Chq. Date</span> <input type="text" autocomplete="off" id="chkdate_<?php echo e($num); ?>" name="cheque_date[]" required class="form-control chqdate" data-language='en'>
				</div>
				
				<div class="col-xs-1 nopdc6" style="width:12%;">
					<span class="small">Job</span> 
				<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
								
				</div>
				
				<div class="col-sm-1 abc" style="width:5%;">
					<button type="button" class="btn-danger btn-remove-item" >
						<i class="fa fa-fw fa-minus-square"></i>
					 </button><br/>
					 <button type="button" class="btn-success btn-add-item" >
						<i class="fa fa-fw fa-plus-square"></i>
					 </button>
				</div>
		<?php endif; ?>
<?php else: ?> 
	<?php if($isdept): ?>
	<div class="col-sm-2"> <span class="small">Account Name</span>
		<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="<?php echo e($acdata->master_name); ?>" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
		<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="<?php echo e($acdata->id); ?>">
		<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="<?php echo e(($acdata->vat_assign==0)?$acdata->category:$acdata->vat_assign); ?>">
		<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="<?php echo e($acdata->vat_percentage); ?>">
		<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
		<?php if($acdata->category=='PDCR'): ?>
		<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
		<?php else: ?>
		<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="purchase_invoice_id[]">
		<?php endif; ?>
		<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
		</div>
			<div class="col-xs-3" style="width:20%;">
				<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
			</div>
			<div class="col-xs-2" style="width:12%;">
				<span class="small">Reference</span> 
				<div id="refdata_<?php echo e($num); ?>" class="refdata">
				<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
				</div>
				<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
				<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
			</div>
			<div class="col-sm-1" style="width:7%;">
				<span class="small">Type</span> 
				<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
					<option value="Dr">Dr</option>
					<option value="Cr">Cr</option>
				</select>
			</div>
			<div class="col-xs-2" style="width:12%;">
				<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" required class="form-control jvline-amount">
			</div>
			
			<div class="col-xs-3" style="width:13%;">
				<span class="small">Department</span> 
				<select id="dept_<?php echo e($num); ?>" class="form-control select2 line-dept" style="width:100%" name="department[]">
					<option value="">Department...</option>
					<?php foreach($departments as $department): ?>
					<option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="col-sm-1 abc" style="width:3%;"><br/>
				<button type="button" class="btn-danger btn-remove-item" >
					<i class="fa fa-fw fa-minus-square"></i>
				 </button>
				 <button type="button" class="btn-success btn-add-item" >
					<i class="fa fa-fw fa-plus-square"></i>
				 </button>
			</div>
			
			<div id="chqdtl_<?php echo e($num); ?>" class="divchq" style="display:none;">

				<div class="col-xs-2 pdcfm">
					<span class="small">Bank</span> 
					<select id="bankid_<?php echo e($num); ?>" class="form-control select2 line-bank" style="width:100%" name="bank_id[]">
						<option value="">Select Bank...</option>
						<?php foreach($banks as $bank): ?>
						<option value="<?php echo e($bank['id']); ?>"><?php echo e($bank['code'].' - '.$bank['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-sm-2 pdcfm"> 
					<span class="small">Cheque No</span><input type="text" autocomplete="off" id="chkno_<?php echo e($num); ?>" name="cheque_no[]" class="form-control" >
				</div>
				
				<div class="col-xs-2 pdcfm">
					<span class="small">Cheque Date</span> <input type="text" autocomplete="off" id="chkdate_<?php echo e($num); ?>" name="cheque_date[]" class="form-control chqdate" data-language='en'>
				</div>
				
				
				
				<div class="col-xs-2 pdcfm">
					<input type="hidden" name="partyac_id[]" id="partyac_<?php echo e($num); ?>">
					<span class="small">Party Name</span> <input type="text" id="party_1" name="party_name[]" required autocomplete="off" class="form-control" data-toggle="modal" data-target="#paccount_modal">
				</div>
				
	</div>
	
		<div class="col-xs-2" style="width:15%;"> 
				<span class="small">Job</span> 
				<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
								
			</div>
			
	<?php else: ?>
	<div class="col-sm-2"> <span class="small">Account Name</span>
		<input type="text" id="draccount_<?php echo e($num); ?>" name="account_name[]" value="" class="form-control acname" autocomplete="off" data-toggle="modal" data-target="#account_modal">
		<input type="hidden" name="account_id[]" id="draccountid_<?php echo e($num); ?>" value="">
		<input type="hidden" name="group_id[]" id="groupid_<?php echo e($num); ?>" value="">
		<input type="hidden" name="vatamt[]" id="vatamt_<?php echo e($num); ?>" value="">
		<input type="hidden" name="je_id[]" id="jeid_<?php echo e($num); ?>" value="<?php echo e($jeid); ?>">
		<?php if($acdata->category=='PDCR'): ?>
		<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="sales_invoice_id[]">
		<?php else: ?>
		<input type="hidden" id="invoiceid_<?php echo e($num); ?>" name="purchase_invoice_id[]">
		<?php endif; ?>
		<input type="hidden" name="bill_type[]" id="biltyp_<?php echo e($num); ?>">
		</div>
			<div class="col-xs-3" style="width:25%;">
				<span class="small">Description</span> <input type="text" id="descr_<?php echo e($num); ?>" autocomplete="off" name="description[]" class="form-control">
			</div>
			<div class="col-xs-2" style="width:15%;">
				<span class="small">Reference</span> 
				<div id="refdata_<?php echo e($num); ?>" class="refdata">
				<input type="text" id="ref_<?php echo e($num); ?>" name="reference[]" autocomplete="off" class="form-control">
				</div>
				<input type="hidden" name="inv_id[]" id="invid_<?php echo e($num); ?>">
				<input type="hidden" name="actual_amount[]" id="actamt_<?php echo e($num); ?>">
			</div>
			<div class="col-sm-1" style="width:8%;">
				<span class="small">Type</span> 
				<select id="acnttype_<?php echo e($num); ?>" class="form-control select2 line-type" style="width:100%;padding-left:5px;" name="account_type[]">
					<option value="Dr">Dr</option>
					<option value="Cr">Cr</option>
				</select>
			</div>
			<div class="col-xs-2" style="width:13%;">
				<span class="small">Amount</span> <input type="number" id="amount_<?php echo e($num); ?>" autocomplete="off" step="any" name="line_amount[]" required class="form-control jvline-amount">
			</div>
			
			
			
			<div id="chqdtl_<?php echo e($num); ?>" class="divchq" style="display:none;">
				
				<div class="col-xs-2 pdcfm">
					<span class="small">Bank</span> 
					<select id="bankid_1" class="form-control select2 line-bank" style="width:100%" name="bank_id[]">
						<option value="">Select Bank...</option>
						<?php foreach($banks as $bank): ?>
						<option value="<?php echo e($bank['id']); ?>"><?php echo e($bank['code'].' - '.$bank['name']); ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="col-sm-2 pdcfm"> 
					<span class="small">Cheque No</span><input type="text" autocomplete="off" id="chkno_1" name="cheque_no[]" class="form-control" >
				</div>
				
				<div class="col-xs-2 pdcfm">
					<span class="small">Cheque Date</span> <input type="text" autocomplete="off" id="chkdate_1" name="cheque_date[]" class="form-control chqdate" data-language='en'>
				</div>
				
				<div class="col-xs-2 pdcfm">
					<input type="hidden" name="partyac_id[]" id="partyac_1">
					<span class="small">Party Name</span> <input type="text" id="party_1" autocomplete="off" name="party_name[]" required class="form-control" data-toggle="modal" data-target="#paccount_modal">
				</div>
				
		</div>
		
		<div class="col-sm-2" style="width:17%;"> 
				<span class="small">Job</span> 
			<input type="hidden" name="job_id[]" id="jobid_<?php echo e($num); ?>" >
					<input type="text" id="jobcod_<?php echo e($num); ?>" autocomplete="off" name="jobcod[]" class="form-control"  autocomplete="off" data-toggle="modal" data-target="#job_modal" placeholder="Jobcode">
								
			</div>
					
			<div class="col-sm-1 abc" style="width:3%;"><br/>
				<button type="button" class="btn-danger btn-remove-item" >
					<i class="fa fa-fw fa-minus-square"></i>
				 </button>
				 <button type="button" class="btn-success btn-add-item" >
					<i class="fa fa-fw fa-plus-square"></i>
				 </button>
			</div>
	<?php endif; ?>

<?php endif; ?>
<script>
$(document).ready(function () {

	//$('#frmJournal').bootstrapValidator('addField',"line_amount[]");
	<?php if($type=='PDC'): ?>
    	/*$('#frmJournal').bootstrapValidator('addField',"bank_id[]");
    	$('#frmJournal').bootstrapValidator('addField',"cheque_no[]"); 
    	$('#frmJournal').bootstrapValidator('addField',"cheque_date[]");
    	$('#frmJournal').bootstrapValidator('addField',"party_name[]");*/
	<?php endif; ?>
	
	$('.chqdate').datepicker({
		language: 'en',
		dateFormat: 'dd-mm-yyyy',
		autoClose: 1
	});

});

</script>