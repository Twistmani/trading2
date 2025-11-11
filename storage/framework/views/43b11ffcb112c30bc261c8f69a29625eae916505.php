<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?php $__env->startSection('title'); ?>
            Profit ACC 365 | ERP Software
        <?php echo $__env->yieldSection(); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
   <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/invoice.css')); ?>">-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/bootstrap.css')); ?>">
	
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
	
<?php echo $__env->yieldContent('header_styles'); ?>

<style>
#invoicing {
	font-size:8pt;
}

.tblstyle td,
  .tblstyle th {
    height:15px;
	padding:2px;
	border:1px solid #000 !important;
  }

/* @media  print {
	html, body {
		
		height: 530px !important;        
	}
	.page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
} */
</style>
<style type="text/css" media="print">

/*body{ page-break-after: always !important; overflow: hidden !important; }*/

thead
{
	display: table-header-group;
}

#inv
{
	 display: table-footer-group;
	 /*position: fixed;*/
     bottom: 0;
	 margin: 0 auto 0 auto;
	 width:100%;
}

.t {
	 height:250px;
}

</style>
<!-- end of global css -->
</head>
<body >


<!-- For horizontal menu -->
<?php echo $__env->yieldContent('horizontal_header'); ?>
<!-- horizontal menu ends -->
<div>
    <!-- Left side column. contains the logo and sidebar -->

    <aside class="right">
        <section class="content p-l-r-15" id="invoice-stmt">
            <div class="panel">
                
                <div class="panel-body" style="width:100%; !important; border:0px solid red;">
					<form class="form-horizontal" role="form" method="POST" name="frmSave" action="<?php echo e(url('account_enquiry/save_reconciliation')); ?>">
					<input type="hidden" value="<?php echo e($id); ?>" name="account_id">
					
					<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
					<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
					<input type="hidden" name="type" value="<?php echo e($type); ?>" >
					<input type="hidden" name="is_con" value="<?php echo e($iscon); ?>" >
					<input type="hidden" name="is_custom" value="<?php echo e($iscustom); ?>" >
					
                    <div class="print" id="invoicing">
						<div class="col-md-12">
						
						<?php if($type=='statement'): ?>  
						<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:15px;"><br/><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>
							</thead>
							<tbody id="bod">
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<?php  $Sbalance_prnt = $Sdr_total = $Scr_total = $balance_prnt_cb = $balance_prnt_ucb = 0;  ?>
									<?php foreach($transactions as $head => $transactionarr): ?>
									<?php if($iscustom==1): ?><div><h5><b><?php echo e($headarr[$head]->heading); ?></b></h5></div><?php endif; ?>
									<?php  $Gbalance_prnt = $Gdr_total = $Gcr_total = 0;  ?>
									<?php foreach($transactionarr as $key => $transaction): ?>
									<?php if(isset($resultrow[$key])): ?>
									<table border="0" style="width:100%;" >
										<tr>
											<td align="left" style="padding-left:0px;">
												<p><b><?php echo e($resultrow[$key]->master_name.' ('.$resultrow[$key]->account_id.')'); ?>

												<br/><?php echo e($resultrow[$key]->address); ?><?php echo e(($resultrow[$key]->phone!='')?' Ph:'.$resultrow[$key]->phone:''); ?> TRN No: <?php echo e($resultrow[$key]->vat_no); ?></b></p>
											</td>
											<td align="right" style="padding-left:0px;">
												<p><b>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></b></p>
											</td>
										</tr>
									</table>
									
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="5%"><b>Type</b></td>
											<td width="5%"><b>No</b></td>
											<td width="14%" ><b>Date</b></td>
											<td width="20%" ><b>Description</b></td>
											<td width="5%" ><b>Ref.No</b></td>
											<td width="10%" ><b>Bank Date</b></td>
											<td width="9%" class="text-right"><b>Debit</b></td>
											<td width="9%" class="text-right"><b>Credit</b></td>
											<td width="10%" class="text-right"><b>Balance</b></td>
										</tr>
										
										<?php 
											$ob_balance = $cr_total_cb = $cr_total = 0; $dr_total_cb = $dr_total = 0; $balance = $balance_cb = $balance_prnt_cb = 0;
											if(isset($openbalance[$key])) { ?>
											<tr>
												<td><?php echo e($openbalance[$key]['type']); ?></td>
												<td></td>
												<td><?php echo e($fromdate); ?></td>
												<td></td>
												<td></td> <td></td>
												<td class="emptyrow text-right">
													<?php  if($openbalance[$key]['transaction_type']=='Dr') { 
													$balance = $openbalance[$key]['amount'];
													$dr_total = ($balance < 0)?($balance*-1):$balance;
													
													echo number_format( $dr_total, 2); } ?>
												</td>
												<td class="emptyrow text-right">
												<?php if($openbalance[$key]['transaction_type']=='Cr') { 
												$balance = $openbalance[$key]['amount'];
												$cr_total = ($balance < 0)?($balance*-1):$balance;
												echo number_format( $cr_total, 2); } ?>
												</td>
												<td class="emptyrow text-right">
												<?php
													if($balance < 0) {
														$balance_cb = $balance;
														$arr = explode('-', $balance);
														$balance_prnt = '('.number_format($arr[1],2).')';
													} else {
														$balance_cb = $balance;
														$balance_prnt = number_format($balance,2);
													}
													echo $balance_prnt;
												?>
												</td>
											</tr>
											<?php } ?>
										
										<?php if($uncleared): ?>
											<?php foreach($uncleared[$key] as $urow): ?>
											<?php
												$ucr_amount = ''; $udr_amount = '';
												$trdate = $fdate = $tdate = '';
												if(isset($actrndata[$urow->id])) {
													$trdate = strtotime($actrndata[$urow->id]);
													$fdate = strtotime($fromdate);
													$tdate = strtotime($todate);
												}
											
												if($urow->transaction_type=='Cr') {
													
													$ucr_amount = number_format($urow->amount,2);
													if($urow->amount >= 0) {
														$cr_total += $urow->amount;
														$balance = bcsub($balance, $urow->amount, 2);
														
														if(isset($actrndata[$urow->id])) {
															$cr_total_cb += $urow->amount;
															$balance_cb = bcsub($balance_cb, $urow->amount, 2);
														}
													
													} else {
														$cr_total -= $urow->amount;
														$balance += $urow->amount;
														
														if(isset($actrndata[$urow->id])) {
															$cr_total_cb += $urow->amount;
															$balance_cb += $urow->amount;
														}
													}
													
													
												} else if($urow->transaction_type=='Dr') {
													
													$udr_amount = number_format($urow->amount,2);
													$dr_total += $urow->amount;
													$balance += $urow->amount;
													
													if($trdate >= $fdate && $trdate <= $tdate) { //if(isset($actrndata[$urow->id])) {
														$dr_amount_cb = number_format($urow->amount,2);
														$dr_total_cb += $urow->amount;
														$balance_cb += $urow->amount;
													}
												}
												
												$nbalance = $balance;
												if($balance < 0) {
													if($balance != 0)
														$balance = $balance;
													
													$arr = explode('-', $balance);
													if(is_numeric($arr[1])) {
														$balance_prnt = '('.number_format($arr[1],2).')';
													} else
														$balance_prnt = number_format(0,2);
												} else {
													if($balance > 0)
														$balance = $balance;
													$balance_prnt = number_format($balance,2);
												}
												
												if($balance_cb < 0) {
													if($balance_cb != 0)
														$balance_cb = $balance_cb;
													
													$arr = explode('-', $balance_cb);
													if(is_numeric($arr[1])) {
														$balance_prnt_cb = '('.number_format($arr[1],2).')';
														
													} else
														$balance_prnt_cb = number_format(0,2);
												} else {
													if($balance_cb > 0)
														$balance_cb = $balance_cb;
													$balance_prnt_cb = number_format($balance_cb,2);
												}
												
												$balance_prnt_ucb = ($nbalance - $balance_cb);
											?>
											<tr>
												<td><?php echo e($urow->voucher_type); ?></td>
												<td><?php  echo $urow->reference; ?></td>
												<td><?php echo date('d-m-Y', strtotime($urow->invoice_date)); ?></td>
												<td><?php echo $urow->description;?></td>
												<td><?php echo e($urow->reference_from); ?></td>	
												<td>
													<?php if($trdate >= $fdate && $trdate <= $tdate): ?>
													<input type="text" autocomplete="off" name="bank_date[<?php echo e($urow->id); ?>]" value="<?php echo e(isset($actrndata[$urow->id])?date('d-m-Y',strtotime($actrndata[$urow->id])):''); ?>" class="chqdate" data-language='en'>
													<input type="hidden" autocomplete="off" name="hd_bank_date[<?php echo e($urow->id); ?>]" value="<?php echo e(isset($actrndata[$urow->id])?date('d-m-Y',strtotime($actrndata[$urow->id])):''); ?>" class="chqdate" data-language='en'>
													<?php else: ?>
													<input type="text" autocomplete="off" name="bank_date[<?php echo e($urow->id); ?>]" value="" class="chqdate" data-language='en'>
													<input type="hidden" autocomplete="off" name="hd_bank_date[<?php echo e($urow->id); ?>]" value="<?php echo e(isset($actrndata[$urow->id])?date('d-m-Y',strtotime($actrndata[$urow->id])):''); ?>" class="chqdate" data-language='en'>	
													<?php endif; ?>
												</td>
												<td class="emptyrow text-right"><?php echo e($udr_amount); ?></td>
												<td class="emptyrow text-right"><?php echo e($ucr_amount); ?></td>
												<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
											</tr>
											<?php endforeach; ?>
										<?php endif; ?>
										
										<?php foreach($transaction as $trans): ?>
										<?php
											$cr_amount = ''; $dr_amount = '';
											
											$trdate = $fdate = $tdate = '';
											if(isset($actrndata[$trans->id])) {
												$trdate = strtotime($actrndata[$trans->id]);
												$fdate = strtotime($fromdate);
												$tdate = strtotime($todate);
											}
											
											if($trans->transaction_type=='Cr') {
												
												$cr_amount = number_format($trans->amount,2);
												if($trans->amount >= 0) {
													$cr_total += $trans->amount;
													$balance = bcsub($balance, $trans->amount, 2);
													
													if($trans->voucher_type=='OB') {
														$cr_total_cb = $trans->amount;
														$balance_cb = $cr_total_cb;
													}
													
													if(isset($actrndata[$trans->id]) && ($trdate >= $fdate && $trdate <= $tdate)) {
														$cr_total_cb += $trans->amount;
														$balance_cb = bcsub($balance_cb, $trans->amount, 2);
													}
												
												} else {
													$cr_total -= $trans->amount;
													$balance += $trans->amount;
													
													if($trans->voucher_type=='OB') {
														$cr_total_cb = $trans->amount;
														$balance_cb = $cr_total_cb;
													}
													
													if(isset($actrndata[$trans->id]) && ($trdate >= $fdate && $trdate <= $tdate)) {
														$cr_total_cb += $trans->amount;
														$balance_cb += $trans->amount;
													}
												}
												
												
											} else if($trans->transaction_type=='Dr') {
												
												$dr_amount = number_format($trans->amount,2);
												$dr_total += $trans->amount;
												$balance += $trans->amount;
												
												if($trans->voucher_type=='OB') {
														//$dr_total_cb = $trans->amount;
														$balance_cb = $trans->amount;
														//$ob_balance = $dr_total_cb;
												}
													
												if(isset($actrndata[$trans->id]) && ($trdate >= $fdate && $trdate <= $tdate)) {
													$dr_amount_cb = number_format($trans->amount,2);
													$dr_total_cb += $trans->amount;
													$balance_cb += $trans->amount;
												}
											}
											
											
											$nbalance = $balance;
											if($balance < 0) {
												if($balance != 0)
													$balance = $balance;
												
												$arr = explode('-', $balance);
												if(is_numeric($arr[1])) {
													$balance_prnt = '('.number_format($arr[1],2).')';
													//$balance_prnt = $arr[1];
												} else
													$balance_prnt = number_format(0,2);
													
												/* $arr = explode('-', $balance);
												$balance_prnt = '('.number_format($arr[1],2).')'; */
												//$balance_prnt = $arr[1];
											} else {
												if($balance > 0)
													$balance = $balance;
												$balance_prnt = number_format($balance,2);
											}
											
											if($balance_cb < 0) {
												if($balance_cb != 0)
													$balance_cb = $balance_cb;
												
												$arr = explode('-', $balance_cb);
												if(is_numeric($arr[1])) {
													$balance_prnt_cb = '('.number_format($arr[1],2).')';
													
												} else
													$balance_prnt_cb = number_format(0,2);
											} else {
												if($balance_cb > 0)
													$balance_cb = $balance_cb;
												$balance_prnt_cb = number_format($balance_cb,2);
											}
											
											$balance_prnt_ucb = ($nbalance - $balance_cb);
											
										?>
										<tr>
											<td><?php echo e($trans->voucher_type); ?></td>
											<td><?php  echo $trans->reference; ?></td>
											<td><?php echo ($trans->invoice_date=='0000-00-00' || $trans->invoice_date=='01-01-1970')?date('d-m-Y', strtotime($settings->from_date)):date('d-m-Y', strtotime($trans->invoice_date)); ?></td>
											<td><?php echo ($trans->voucher_type=="OB")?'Opening Balance':$trans->description;?></td>
											<td><?php echo e(($trans->reference_from=="")?$trans->reference:$trans->reference_from); ?></td>	
											<td><?php if($trans->voucher_type!='OB'): ?>
													<?php if($trdate >= $fdate && $trdate <= $tdate): ?>
													<input type="text" autocomplete="off" name="bank_date[<?php echo e($trans->id); ?>]" value="<?php echo e(isset($actrndata[$trans->id])?date('d-m-Y',strtotime($actrndata[$trans->id])):''); ?>" class="chqdate" data-language='en'>
													<input type="hidden" autocomplete="off" name="hd_bank_date[<?php echo e($trans->id); ?>]" value="<?php echo e(isset($actrndata[$trans->id])?date('d-m-Y',strtotime($actrndata[$trans->id])):''); ?>" class="chqdate" data-language='en'>
													<?php else: ?>
													<input type="text" autocomplete="off" name="bank_date[<?php echo e($trans->id); ?>]" value="" class="chqdate" data-language='en'>
													<input type="hidden" autocomplete="off" name="hd_bank_date[<?php echo e($trans->id); ?>]" value="<?php echo e(isset($actrndata[$trans->id])?date('d-m-Y',strtotime($actrndata[$trans->id])):''); ?>" class="chqdate" data-language='en'>	
													<?php endif; ?>
												<?php endif; ?>
											</td>
											<td class="emptyrow text-right"><?php echo $dr_amount;?></td>
											<td class="emptyrow text-right"><?php echo e($cr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
										</tr>
										
										<?php endforeach; ?>	
										<?php  $Gdr_total += $dr_total; $Gcr_total += $cr_total;  ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td> <td></td>
											<td class="highrow text-right"><strong><?php echo ($ispdc && count($pdcs) > 0)?'Total with PDC':'Total';?>:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e($balance_prnt); ?></strong></td>
										</tr>
									</table>
									<?php endif; ?>
									<hr/>
									<?php endforeach; ?>
									<?php  $Sdr_total += $Gdr_total; $Scr_total += $Gcr_total;  ?>
									
									<?php endforeach; ?>
								
									</td>
								</tr>
								
							</tbody>
						</table>
						<table border="0" width="100%">
							<tr><td align="right">
								<p><b>Cleared Balance: <?php echo e($balance_prnt_cb); ?></b></p>
								<p><b>Uncleared Balance: <?php echo e($balance_prnt_ucb); ?></b></p>
								</td>
							</tr>
						</table>
						<?php endif; ?>
						
						</div>
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right">
									 <button type="submit" class="btn btn-responsive button-alignment btn-primary">
										<span style="color:#fff;" >
										Submit
									</span>
                                </button>
								
								<button type="button" onclick="javascript:window.close();"
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;" >
                                                    <i class="fa fa-fw fa-times"></i>
                                                Close 
                                            </span>
                                </button>
								
                                </span>
                        </div>
                    </div>
					</form>
                </div>
            </div>
            <!-- row -->
        
        <!-- right side bar end -->
        </section>

    </aside>
    <!-- page wrapper-->
</div>
<!-- wrapper-->
<!-- global js -->
<script src="<?php echo e(asset('assets/js/app.js')); ?>" type="text/javascript"></script>
<!-- end of global js -->
<?php echo $__env->yieldContent('footer_scripts'); ?>
<!-- end page level js -->
</body>

<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>

<script>
function getExport() { document.frmExport.submit(); }

$(document).ready(function () {
	$('html').attr({style: 'min-height: inherit'});
	$('body').attr({style: 'min-height: inherit'});
	
	$('.chqdate').datepicker({
		language: 'en',
		dateFormat: 'dd-mm-yyyy',
		minDate: new Date('<?php echo e($settings->from_date); ?>'),
		maxDate: new Date('<?php echo e($settings->to_date); ?>'),
		autoClose: 1
	});
	
});
</script>
</html>

