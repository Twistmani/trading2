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
                    <div class="print" id="invoicing">
						<div class="col-md-12">
						<?php //if(count($transactions) > 0) { ?>
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
									<?php if($fc) { ?>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="5%"><b>Type</b></td>
											<td width="5%"><b>No</b></td>
											<td width="14%" ><b>Date</b></td>
											<td width="41%" ><b>Description</b></td>
											<td width="5%" ><b>Ref.No</b></td>
											<td width="9%" class="text-right"><b>Debit</b></td>
											<td width="9%" class="text-right"><b>Credit</b></td>
											<td width="10%" class="text-right"><b>Balance</b></td>
										</tr>
										
										<?php 
											$cr_total = 0; $dr_total = 0; $balance = 0;$balance_prnt='';
											if($openbalance) { ?>
											<tr>
												<td><?php echo e($openbalance['type']); ?></td>
												<td></td>
												<td><?php echo e($fromdate); ?></td>
												<td></td>
												<td></td>
												<td class="emptyrow text-right">
													<?php  if($openbalance['transaction_type']=='Dr') { 
													$balance = isset($openbalance['fc_amount'])?$openbalance['fc_amount']:0;
													$dr_total = ($balance < 0)?($balance*-1):$balance;
													
													echo number_format( $dr_total, 2); } ?>
												</td>
												<td class="emptyrow text-right">
												<?php if($openbalance['transaction_type']=='Cr') { 
												$balance = isset($openbalance['fc_amount'])?$openbalance['fc_amount']:0;
												$cr_total = ($balance < 0)?($balance*-1):$balance;
												echo number_format( $cr_total, 2); } ?>
												</td>
												<td class="emptyrow text-right">
												<?php
													if($balance < 0) {
														$arr = explode('-', $balance);
														$balance_prnt = '('.number_format($arr[1],2).')';
													} else 
														$balance_prnt = number_format($balance,2);
													
													echo $balance_prnt;
												?>
												</td>
											</tr>
											<?php } ?>
									
										<?php foreach($transactions as $transaction): ?>
										<?php
											$cr_amount = ''; $dr_amount = '';
											if($transaction->transaction_type=='Cr') {
												//$cr_amount = number_format($transaction->amount,2);
													$cr_amount = number_format($transaction->fc_amount,2);
												if($transaction->fc_amount >= 0) {
													$cr_total += $transaction->fc_amount;
													$balance = bcsub($balance, $transaction->fc_amount, 2);
												} else {
													$cr_total -= $transaction->fc_amount;
													$balance += $transaction->fc_amount;
												}
											} else if($transaction->transaction_type=='Dr') {
												//$dr_amount = number_format($transaction->amount,2);
													$dr_amount = number_format($transaction->fc_amount,2);
												$dr_total += $transaction->fc_amount;
												$balance += $transaction->fc_amount;
											}
											
											if($balance < 0) {
												if($balance != 0)
													$balance = $balance;
											
												$arr = explode('-', $balance);
												$balance_prnt = '('.number_format($arr[1],2).')';
											} else {
												if($balance > 0)
													$balance = $balance;
												$balance_prnt = number_format($balance,2);
											}
										?>
									
										<tr>
											<td><?php echo e($transaction->voucher_type); ?></td>
											<td><?php  echo $transaction->reference; ?></td>
											<td><?php echo ($transaction->invoice_date=='0000-00-00' || $transaction->invoice_date=='01-01-1970')?date('d-m-Y', strtotime($settings->from_date)):date('d-m-Y', strtotime($transaction->invoice_date)); ?></td>
											<td><?php echo ($transaction->voucher_type=="OB")?'Opening Balance':$transaction->description;?></td>
											<td><?php echo e(($transaction->reference_from=="")?$transaction->reference:$transaction->reference_from); ?></td>
											<td class="emptyrow text-right"><?php echo $dr_amount;?></td>
											<td class="emptyrow text-right"><?php echo e($cr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
										</tr>
										<?php endforeach; ?>	
										
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td class="highrow text-right"><strong><?php echo ($ispdc && count($pdcs) > 0)?'Total with PDC':'Total';?>:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e($balance_prnt); ?></strong></td>
										</tr>
									</table>
									
									<?php } else { ?>
									<?php  $Sbalance_prnt = $Sdr_total = $Scr_total = 0;  ?>
									<?php foreach($transactions as $head => $transactionarr): ?>
									<?php if($iscustom==1): ?><div><h5>
										<b><?php if(isset($headarr[$head])): ?>
											<?php echo e($headarr[$head]->heading); ?>

										<?php endif; ?>
										</b></h5></div>
									<?php endif; ?>
									
									<?php if($iscustom==1 && $saleman!=''): ?>
										
									<?php endif; ?>

									<?php  $Gbalance_prnt = $Gdr_total = $Gcr_total = 0;  ?>
									<?php foreach($transactionarr as $key => $transaction): ?>
									<?php if(isset($resultrow[$key])): ?>
									
									<table border="0" style="width:100%;" >
										<tr>
											<td align="left" style="padding-left:0px;">
												<p><b><?php echo e($resultrow[$key]->master_name.' ('.$resultrow[$key]->account_id.')'); ?>

												<br/><?php echo e($resultrow[$key]->address); ?><?php echo e(($resultrow[$key]->phone!='')?' Ph:'.$resultrow[$key]->phone:''); ?> TRN No: <?php echo e($resultrow[$key]->vat_no); ?></b>
												<?php if($saleman): ?>
													<br/><b>Salesman: <?php echo e($saleman); ?></b>
												<?php endif; ?>
												</p>
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
											<td width="41%" ><b>Description</b></td>
											<td width="5%" ><b>Ref.No</b></td>
											<?php if($jobid): ?><td width="10%" ><b>Job No</b></td><?php endif; ?>
											<td width="9%" class="text-right"><b>Debit</b></td>
											<td width="9%" class="text-right"><b>Credit</b></td>
											<td width="10%" class="text-right"><b>Balance</b></td>
										</tr>
										
										<?php 
											$cr_total = 0; $dr_total = 0; $balance = 0;
											if(isset($openbalance[$key])) { ?>
											<tr>
												<td><?php echo e($openbalance[$key]['type']); ?></td>
												<td></td>
												<td><?php echo e($fromdate); ?></td>
												<td></td>
												<td></td> <?php if($jobid): ?><td></td><?php endif; ?>
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
														$arr = explode('-', $balance);
														$balance_prnt = '('.number_format($arr[1],2).')';
													} else 
														$balance_prnt = number_format($balance,2);
													
													echo $balance_prnt;
												?>
												</td>
											</tr>
											<?php } ?>
									
										<?php foreach($transaction as $trans): ?>
										<?php
											$cr_amount = ''; $dr_amount = '';
											if($trans->transaction_type=='Cr') {
												
													$cr_amount = number_format($trans->amount,2);
												if($trans->amount >= 0) {
													$cr_total += $trans->amount;
													$balance = bcsub($balance, $trans->amount, 2);
												} else {
													$cr_total -= $trans->amount;
													$balance += $trans->amount;
												}
											} else if($trans->transaction_type=='Dr') {
												
													$dr_amount = number_format($trans->amount,2);
												$dr_total += $trans->amount;
												$balance += $trans->amount;
											}
											
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

											if($trans->voucher_type=="JV" || $trans->voucher_type=="RV" || $trans->voucher_type=="PV")
												$reference_from = $trans->reference_from;
											else
												$reference_from = ($trans->reference_from=="")?$trans->reference:$trans->reference_from;
										?>
										<tr>
											<td><?php echo e($trans->voucher_type); ?></td>
											<td><?php  echo $trans->reference; ?></td>
											<td><?php echo ($trans->invoice_date=='0000-00-00' || $trans->invoice_date=='01-01-1970')?date('d-m-Y', strtotime($settings->from_date)):date('d-m-Y', strtotime($trans->invoice_date)); ?></td>
											<td><?php echo ($trans->voucher_type=="OB")?'Opening Balance':$trans->description;?></td>
											<td style="word-break: break-all;"><?php echo e($reference_from); ?></td>	
											<?php if($jobid): ?><td><?php echo e($trans->jobno); ?></td><?php endif; ?>
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
											<td></td> <?php if($jobid): ?><td></td><?php endif; ?>
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
									<?php if($iscustom==1): ?>
										<?php
										$Gbalance_prnt = $Gdr_total-$Gcr_total;
										if($Gbalance_prnt < 0) {
											if($Sbalance_prnt != 0)
												$Gbalance_prnt = $Gbalance_prnt;
										
											$arr = explode('-', $Gbalance_prnt);
											$Gbalance_prnt = '('.number_format($arr[1],2).')';
										} else {
											if($Gbalance_prnt > 0)
												$Gbalance_prnt = $Gbalance_prnt;
											$Gbalance_prnt = number_format($Gbalance_prnt,2);
										}
										?>
									<table style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td class="highrow text-right" width="45%"></td>
											<td class="emptyrow text-right"><strong>Debit</strong></td>
											<td class="emptyrow text-right"><strong>Credit</strong></td>
											<td class="emptyrow text-right"><strong>Balance</strong></td>
										</tr>
										<tr>
											<td class="highrow text-right" width="45%">
												<?php if(isset($headarr[$head])): ?>
												<strong><?php echo e($headarr[$head]->heading); ?> <?php echo ($ispdc && count($pdcs) > 0)?'Total with PDC':' Total';?>:</strong>
												<?php endif; ?>
											</td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($Gdr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($Gcr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e($Gbalance_prnt); ?></strong></td>
										</tr>
									</table><br/>
									<?php endif; ?>
									<?php endforeach; ?>
								<?php } // ?>
								
									<?php if($iscustom==1): ?>
									<?php 
									$Sdr_total='';$Scr_total='';
										$Sbalance_prnt = (int)$Sdr_total-(int)$Scr_total;
									 ?>
									
									<?php
									if($Sbalance_prnt < 0) {
										if($Sbalance_prnt != 0)
											$Sbalance_prnt = $Sbalance_prnt;
									
										$arr = explode('-', $Sbalance_prnt);
										$Sbalance_prnt = '('.number_format($arr[1],2).')';
									} else {
										if($Sbalance_prnt > 0)
											$Sbalance_prnt = $Sbalance_prnt;
										$Sbalance_prnt = number_format($Sbalance_prnt,2);
									}
									?>
									<table style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td class="highrow text-right" width="45%"></td>
											<td class="emptyrow text-right"><strong>Debit</strong></td>
											<td class="emptyrow text-right"><strong>Credit</strong></td>
											<td class="emptyrow text-right"><strong>Balance</strong></td>
										</tr>
										<tr>
											<td class="highrow text-right" width="45%"><strong><?php echo ($ispdc && count($pdcs) > 0)?'Total with PDC':'Grand Total';?>:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format((int)$Sdr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format((int)$Scr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e($Sbalance_prnt); ?></strong></td>
										</tr>
									</table>
									<?php endif; ?>
									
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center">
									<?php
										if($ispdc) {
											if(count($pdcs) > 0) { ?><br/>
											
										<h5><b>Statement with PDC Details</b></h5>
										<table class="tblstyle table-bordered" border="0" width="100%">
										<tr>
											<td width="5%"><strong>Type</strong></td>
											<td width="8%"><strong>No</strong></td>
											<td><strong>Date</strong></td>
											<td><strong>Cheque No</strong></td>
											<td><strong>Cheque Date</strong></td>
											<td width="14%">
												<strong>Description</strong>
											</td>
											<td width="10%">
												<strong>Reference</strong>
											</td>
											<td width="15%" class="text-right">
												<strong>PDC Issued</strong>
											</td>
											<td width="15%" class="text-right">
												<strong>PDC Received</strong>
											</td>
											
											<td width="15%" class="text-right">
												<strong>Balance</strong>
											</td>
										</tr>
										<tbody>
											
											<?php $cr_total = 0; $dr_total = 0; $balance = 0;?>
											<?php foreach($pdcs as $transaction): ?>
											<?php
												$received = ''; $issued = '';
												if($transaction->voucher_type=='PDCR') {
													$received = number_format($transaction->amount,2);
													if($transaction->amount >= 0) {
														$cr_total += $transaction->amount;
														$balance = bcsub($balance, $transaction->amount, 2);
													} else {
														$cr_total -= $transaction->amount;
														$balance += $transaction->amount;
													}
												} else if($transaction->voucher_type=='PDCI') {
													$issued = number_format($transaction->amount,2);
													$dr_total += $transaction->amount;
													$balance += $transaction->amount;
												}
												
												if($balance < 0) {
													$arr = explode('-', $balance);
													$balance_prnt = '('.number_format($arr[1],2).')';
												} else 
													$balance_prnt = number_format($balance,2);
											?>
											<tr>
												<td><?php echo e(($transaction->voucher_type=='PDCR')?'RV':'PV'); ?></td>
												<td><?php echo e($transaction->voucher_no); ?></td>
												<td><?php echo ($transaction->voucher_date=='0000-00-00' || $transaction->voucher_date=='01-01-1970')?date('d-m-Y', strtotime($settings->from_date)):date('d-m-Y', strtotime($transaction->voucher_date)); ?></td>
												<td><?php echo e($transaction->cheque_no); ?></td>
												<td><?php echo ($transaction->cheque_date=='0000-00-00' || $transaction->cheque_date=='01-01-1970')?'':date('d-m-Y', strtotime($transaction->cheque_date)); ?></td>
												<td><?php echo $transaction->description.' '.$transaction->master_name;?></td>
												<td><?php echo e($transaction->reference); ?></td>
												<td class="emptyrow text-right"><?php echo e($issued); ?></td>
												<td class="emptyrow text-right"><?php echo e($received); ?></td>
												<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
											</tr>
											<?php endforeach; ?>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td class="highrow text-right"><strong>Total:</strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e($balance_prnt); ?></strong></td>
											</tr>
											</tbody>
										</table>
											<?php } } ?>
									</td>
								</tr>
							</tbody>
							<tfoot id="inv">
								<tr>
									<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
							</tfoot>
						</table>
						<?php elseif($type=='outstanding'): ?>
						
						<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:16px;"><br/><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>
							</thead>
							<tbody id="bod">
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<?php  $grandTotal = 0;   ?>
									<?php foreach($transactions as $key => $transaction): ?>
									<?php $cr_total = 0; $dr_total = 0; $balance = $balance1 = 0;//$resultrow->op_balance; 
										  $amtdate1 = $amtdate2 = $amtdate3 = $amtdate4 = $amtdate5 = 0;
									?>
									<?php if(is_array($pdclist) > 0): ?>
										<?php if(isset($pdclist[$key])) { ?>
										<table border="0" style="width:100%;" >
											<tr>
												<td align="left" style="padding-left:0px;">
													<p><b><?php echo e($resultrow[$key]->master_name.' ('.$resultrow[$key]->account_id.')'); ?>

													<br/><?php echo e($resultrow[$key]->address); ?><?php echo e(($resultrow[$key]->phone!='')?' Ph:'.$resultrow[$key]->phone:''); ?> TRN No: <?php echo e($resultrow[$key]->vat_no); ?></b>
													<?php if($saleman): ?>
													<br/><b>Salesman: <?php echo e($saleman); ?></b>
													<?php endif; ?>
													</p>
												</td>
												<td align="right" style="padding-left:0px;">
													<p><b>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></b></p>
												</td>
											</tr>
										</table>
										
											<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<tr>
												<td width="15%"><b>Invoice Date</b></td>
												<td width="10%"><b>Cheque No</b></td>
												<td width="10%"><b>Cheque Date</b></td>
												<td width="10%"><b>Bank Code</b></td>
												<td width="10%"><b>Description</b></td>
												<td width="10%" class="text-right"><b>Debit</b></td>
												<td width="10%" class="text-right"><b>Credit</b></td>
												<td width="10%" class="text-right"><b>Balance</b></td>
											</tr> <?php  $pdcamt = 0; $ptype='';  ?>
											
											<?php foreach($pdclist[$key] as $pdc): ?>
											<?php  $pdcamt += $pdc->amount; $ptype=$pdc->type;  ?>
											<tr>
												<td><?php echo e(date('d-m-Y', strtotime($pdc->voucher_date))); ?></td>
												<td ><?php echo e($pdc->cheque_no); ?></td>
												<td ><?php echo e(date('d-m-Y', strtotime($pdc->cheque_date))); ?></td>
												<td ><?php echo e($pdc->code); ?></td>
												<td ><?php echo e($pdc->description); ?></td>
												<td class="emptyrow text-right"><?php echo e(($pdc->type=='Dr')?$pdc->amount:''); ?></td>
												<td class="emptyrow text-right"><?php echo e(($pdc->type=='Cr')?$pdc->amount:''); ?></td>
												<td class="emptyrow text-right"></td>
											</tr>
											<?php endforeach; ?>
											<tr>
												<td></td>
												<td></td> 
												<td></td> 
												<td></td> 
												<td class="highrow text-right"><strong>Total:</strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(($ptype=='Dr')?number_format($pdcamt,2):''); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(($ptype=='Cr')?number_format($pdcamt,2):''); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(number_format($pdcamt,2)); ?></strong></td>
											</tr>
											</table>
										<?php } ?>
									<?php else: ?>
									<?php
										foreach($transaction as $trans) {
											$balance_prnt1 = bcsub($trans['dr_amount'], $trans['cr_amount'], 2);
												if($resultrow[$key]->category=='CUSTOMER' && $balance_prnt1 !=0)
													$balance1 += $balance_prnt1;
												else if($resultrow[$key]->category=='SUPPLIER' && $balance_prnt1 !=0)
													$balance1 += $balance_prnt1;
										}       
									?>
									
									<?php if($balance1 != 0): ?>
									<table border="0" style="width:100%;" >
										<tr>
											<td align="left" style="padding-left:0px;">
												<p><b><?php echo e($resultrow[$key]->master_name.' ('.$resultrow[$key]->account_id.')'); ?>

												<br/><?php echo e($resultrow[$key]->address); ?><?php echo e(($resultrow[$key]->phone!='')?' Ph:'.$resultrow[$key]->phone:''); ?> TRN No: <?php echo e($resultrow[$key]->vat_no); ?></b>
													<?php if($saleman): ?>
													<br/><b>Salesman: <?php echo e($saleman); ?></b>
													<?php endif; ?>
												</p>
											</td>
											<td align="right" style="padding-left:0px;">
												<p><b>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></b></p>
											</td>
										</tr>
									</table>
									
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="15%"><b>Invoice Date</b></td>
											<td width="10%"><b>Reference</b></td>
											<td width="45%"><b>Description</b></td>
											<?php if($jobid): ?><td width="15%"><b>Job No</b></td><?php endif; ?>
											<td width="10%" class="text-right"><b>Debit</b></td>
											<td width="10%" class="text-right"><b>Credit</b></td>
											<td width="10%" class="text-right"><b>Balance</b></td>
										</tr>
										
									<?php foreach($transaction as $trans): ?>
									<?php
										//$balance_prnt = $amtdate = $transaction['dr_amount'] - $transaction['cr_amount'];
										$balance_prnt = $amtdate = bcsub($trans['dr_amount'], $trans['cr_amount'], 2); //$transaction['dr_amount'] - $transaction['cr_amount'];
										//if($resultrow->category=='CUSTOMER' && $transaction['dr_amount'] > 0 && $transaction['cr_amount'] < $transaction['dr_amount'] && ($transaction['dr_amount'] > 0 && $transaction['cr_amount'] > $transaction['dr_amount']) ) {
										// on DEC 4... if($resultrow->category=='CUSTOMER' && $transaction['dr_amount'] > 0 && $transaction['cr_amount'] < $transaction['dr_amount']) {	
										
										if(($resultrow[$key]->category=='CUSTOMER' && $balance_prnt !=0) || ($resultrow[$key]->category=='VATIN' && $balance_prnt !=0)) {
											$dr_total += $trans['dr_amount'];
											$cr_total += $trans['cr_amount'];
											
											$balance += $balance_prnt;
											
											if($trans['dr_amount'] > 0)
												$dr_amount = number_format($trans['dr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$dr_amount = '('.number_format($trans['dr_amount']*-1,2).')';
											else $dr_amount = '';
											
											if($trans['cr_amount'] > 0)
												$cr_amount = number_format($trans['cr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$cr_amount = '('.number_format($trans['cr_amount']*-1,2).')';
											else $cr_amount = '';
											
											if($balance_prnt > 0)
												$balance_prnt = number_format($balance_prnt,2);
											else if($balance_prnt < 0)
												$balance_prnt = '('.number_format(($balance_prnt*-1),2).')';
											else $balance_prnt = '';
											
											$nodays = date_diff(date_create($trans['invoice_date']), date_create(date('Y-m-d')));
											
											if($nodays->format("%a%") <= 30)
												$amtdate1 += $amtdate;
											else if($nodays->format("%a%") > 30 && $nodays->format("%a%") <= 60)
												$amtdate2 += $amtdate;
											else if($nodays->format("%a%") > 60 && $nodays->format("%a%") <= 90)
												$amtdate3 += $amtdate;
											else if($nodays->format("%a%") > 90 && $nodays->format("%a%") <= 120)
												$amtdate4 += $amtdate;
											else if($nodays->format("%a%") > 120)
												$amtdate5 += $amtdate; 
											
											//if($balance_prnt!=0) {
												
											if($trans['dr_amount'] > 0)
												$dr_amount = number_format($trans['dr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$dr_amount = '('.number_format($trans['dr_amount']*-1,2).')';
											else $dr_amount = '';
											
											if($trans['cr_amount'] > 0)
												$cr_amount = number_format($trans['cr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$cr_amount = '('.number_format($trans['cr_amount']*-1,2).')';
											else $cr_amount = '';
											
											
									?>
										
									
										<tr>
											<td><?php echo date('d-m-Y', strtotime($trans['invoice_date'])); ?></td>
											<td><?php echo e($trans['reference_from']); ?></td>
											<td><?php echo e($trans['description']); ?><?php //echo date('d-m-Y', strtotime($transaction['invoice_date'])); ?></td>	
											<?php if($jobid): ?><td><?php echo e($trans['jobno']); ?></td><?php endif; ?>
											<td class="emptyrow text-right"><?php echo e($dr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($cr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
										</tr>
										
										<?php  //} else if($resultrow->category=='SUPPLIER' && $transaction['cr_amount'] > 0 && $transaction['dr_amount'] < $transaction['cr_amount'] && ($transaction['cr_amount'] != 0 && $transaction['cr_amount'] > $transaction['dr_amount'])) { 
											  } else if(($resultrow[$key]->category=='SUPPLIER' && $balance_prnt !=0) || ($resultrow[$key]->category=='VATOUT' && $balance_prnt !=0)){
												  
												$dr_total += $trans['dr_amount'];
												$cr_total += $trans['cr_amount'];
												
												$balance += $balance_prnt;
												
												if($trans['dr_amount'] > 0)
													$dr_amount = number_format($trans['dr_amount'],2);
												else if($trans['dr_amount'] < 0)
													$dr_amount = '('.number_format($trans['dr_amount']*-1,2).')';
												else $dr_amount = '';
												
												if($trans['cr_amount'] > 0)
													$cr_amount = number_format($trans['cr_amount'],2);
												else if($trans['dr_amount'] < 0)
													$cr_amount = '('.number_format($trans['cr_amount']*-1,2).')';
												else $cr_amount = '';
												
												if($balance_prnt > 0)
													$balance_prnt = number_format($balance_prnt,2);
												else if($balance_prnt < 0)
													$balance_prnt = '('.number_format(($balance_prnt*-1),2).')';
												else $balance_prnt = '';
												
												$nodays = date_diff(date_create($trans['invoice_date']), date_create(date('Y-m-d')));
											
											if($nodays->format("%a%") <= 30)
												$amtdate1 += $amtdate;
											else if($nodays->format("%a%") > 30 && $nodays->format("%a%") <= 60)
												$amtdate2 += $amtdate;
											else if($nodays->format("%a%") > 60 && $nodays->format("%a%") <= 90)
												$amtdate3 += $amtdate;
											else if($nodays->format("%a%") > 90 && $nodays->format("%a%") <= 120)
												$amtdate4 += $amtdate;
											else if($nodays->format("%a%") > 120)
												$amtdate5 += $amtdate; 
											
											//if($balance_prnt!=0) {
												
											if($trans['dr_amount'] > 0)
												$dr_amount = number_format($trans['dr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$dr_amount = '('.number_format($trans['dr_amount']*-1,2).')';
											else $dr_amount = '';
											
											if($trans['cr_amount'] > 0)
												$cr_amount = number_format($trans['cr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$cr_amount = '('.number_format($trans['cr_amount']*-1,2).')';
											else $cr_amount = '';
											
											/* if($balance_prnt > 0)
												$balance_prnt = number_format($balance_prnt,2);
											else if($balance_prnt < 0)
												$balance_prnt = '('.number_format(($balance_prnt*-1),2).')';
											else $balance_prnt = ''; */
											
											
									?>
                                    <tr>
										<td><?php echo date('d-m-Y', strtotime($trans['invoice_date'])); ?></td>
										<td><?php echo e($trans['reference_from']); ?></td>
										<td><?php echo e($trans['description']); ?><?php //echo date('d-m-Y', strtotime($transaction['invoice_date'])); ?></td>
                                       <?php if($jobid): ?><td><?php echo e($trans['jobno']); ?></td><?php endif; ?>
									   <td class="emptyrow text-right"><?php echo e($dr_amount); ?></td>
                                        <td class="emptyrow text-right"><?php echo e($cr_amount); ?></td>
                                        <td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
                                    </tr>
									<?php } else if($resultrow[$key]->category=='PDCR' && $balance_prnt !=0) {
											
											$dr_total += $trans['dr_amount'];
											$cr_total += $trans['cr_amount'];
											
											$balance += $balance_prnt;
											
											if($trans['dr_amount'] > 0)
												$dr_amount = number_format($trans['dr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$dr_amount = '('.number_format($trans['dr_amount']*-1,2).')';
											else $dr_amount = '';
											
											if($trans['cr_amount'] > 0)
												$cr_amount = number_format($trans['cr_amount'],2);
											else if($trans['dr_amount'] < 0)
												$cr_amount = '('.number_format($trans['cr_amount']*-1,2).')';
											else $cr_amount = '';
											
											if($balance_prnt > 0)
												$balance_prnt = number_format($balance_prnt,2);
											else if($balance_prnt < 0)
												$balance_prnt = '('.number_format(($balance_prnt*-1),2).')';
											else $balance_prnt = '';
											
											/* if($balance > 0)
												$balance = number_format($balance,2);
											else if($balance < 0)
												$balance = '('.number_format(($balance*-1),2).')';
											else $balance = ''; */ //} 
									?>
									
										<tr>
											<td><?php echo date('d-m-Y', strtotime($trans['invoice_date'])); ?></td>
											<td><?php echo e($trans['reference_from']); ?></td>
											<td><?php echo e($trans['description']); ?><?php //echo date('d-m-Y', strtotime($transaction['invoice_date'])); ?></td>
											<?php if($jobid): ?><td><?php echo e($trans['jobno']); ?></td><?php endif; ?>
											<td class="emptyrow text-right"><?php echo e($dr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($cr_amount); ?></td>
											<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
										</tr>
										
									<?php } ?>
									
										<?php endforeach; ?>	
										<tr>
											<td></td>
											<td></td> <?php if($jobid): ?><td></td><?php endif; ?>
											<td class="highrow text-right"><strong>Total:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(($balance > 0)?number_format($balance,2):'('.number_format(($balance*-1),2).')'); ?></strong></td>
										</tr>
									</table>
									<?php  $grandTotal += $balance;  ?>
									<hr/>
									<?php endif; ?>
									<?php endif; ?>
									<?php endforeach; ?>
									</td>
								</tr>
								<tr>
									<td>
										<?php if($iscustom==1): ?>
										<table border="1" width="100%" class="tblstyle table-bordered">
										<tr>
										<td class="highrow text-right"><strong>Grand Total:</strong></td>
										<td class="emptyrow text-right"><strong><?php echo e(($grandTotal > 0)?number_format($grandTotal,2):'('.number_format(($grandTotal*-1),2).')'); ?></strong></td>
										</tr>
										</table>
										<?php endif; ?>
									</td>
								</tr>
								
								<?php if($iscustom==0): ?>
								<tr>
									<td colspan="2"><br/>
										<table border="0" width="100%" class="tblstyle table-bordered">
										<thead>
										<tr>
											<td align="center"><strong>0-30</strong></td>
											<td align="center">
												<strong>31-60</strong>
											</td>
											<td align="center">
												<strong>61-90</strong>
											</td>
											<td align="center">
												<strong>91-120</strong>
											</td>
											<td align="center">
												<strong>Above 121</strong>
											</td>
											<td align="center">
												<strong>Total</strong>
											</td>
										</tr>
										</thead>
											<?php
											$amtdate1="";$amtdate2="";$amtdate3="";$amtdate4="";$amtdate5="";$balance="";
											if($amtdate1 > 0)
												$amtdate1 = number_format($amtdate1,2);
											else if($amtdate1 < 0)
												$amtdate1 = '('.number_format(($amtdate1*-1),2).')';
											else $amtdate1 = '';
											
											if($amtdate2 > 0)
												$amtdate2= number_format($amtdate2,2);
											else if($amtdate2 < 0)
												$amtdate2 = '('.number_format(($amtdate2*-1),2).')';
											else $amtdate2 = '';
											
											if($amtdate3 > 0)
												$amtdate3= number_format($amtdate3,2);
											else if($amtdate3 < 0)
												$amtdate3 = '('.number_format(($amtdate3*-1),2).')';
											else $amtdate3 = '';
											
											if($amtdate4 > 0)
												$amtdate4= number_format($amtdate4,2);
											else if($amtdate4 < 0)
												$amtdate4 = '('.number_format(($amtdate4*-1),2).')';
											else $amtdate4 = '';
											
											if($amtdate5 > 0)
												$amtdate5= number_format($amtdate5,2);
											else if($amtdate5 < 0)
												$amtdate5 = '('.number_format(($amtdate5*-1),2).')';
											else $amtdate5 = '';
											?>
										<tbody>
											<td align="center"><?php echo e($amtdate1); ?></td>
											<td align="center"><?php echo e($amtdate2); ?></td>
											<td align="center"><?php echo e($amtdate3); ?></td>
											<td align="center"><?php echo e($amtdate4); ?></td>
											<td align="center"><?php echo e($amtdate5); ?></td>
											<td align="center"><?php echo e(((int)$balance > 0)?number_format((int)$balance,2):'('.number_format(((int)$balance*-1),2).')'); ?></td>
										</tbody>
									</table>
									</td>
								</tr>
								<?php endif; ?>
								<tr>
									<td colspan="2" align="center">
										<?php
										if($ispdc) {
											if(count($pdcs) > 0) { ?><br/>
											
										<h5><b>Outstanding with PDC Details</b></h5>
										<table class="tblstyle table-bordered" border="0" width="100%">
										<tr>
											<td width="15%"><b>Invoice Date</b></td>
											<td width="15%"><b>Reference</b></td>
											<td width="15%"><b>Cheque No</b></td>
											<td width="15%"><b>Cheque Date</b></td>
											<td width="18%" class="text-right"><b>Debit</b></td>
											<td width="18%" class="text-right"><b>Credit</b></td>
											<td width="19%" class="text-right"><b>Balance</b></td>
										</tr>
										<tbody>
											
											<?php $cr_total = 0; $dr_total = 0; $balance = 0;?>
											<?php foreach($pdcs as $transaction): ?>
											<?php
												$received = ''; $issued = '';
												if($transaction->voucher_type=='PDCR') {
													$received = number_format($transaction->amount,2);
													if($transaction->amount >= 0) {
														$cr_total += $transaction->amount;
														$balance = bcsub($balance, $transaction->amount, 2);
													} else {
														$cr_total -= $transaction->amount;
														$balance += $transaction->amount;
													}
												} else if($transaction->voucher_type=='PDCI') {
													$issued = number_format($transaction->amount,2);
													$dr_total += $transaction->amount;
													$balance += $transaction->amount;
												}
												
												if($balance < 0) {
													$arr = explode('-', $balance);
													$balance_prnt = '('.number_format($arr[1],2).')';
												} else 
													$balance_prnt = number_format($balance,2);
											?>
											<tr>
												<td><?php echo ($transaction->voucher_date=='0000-00-00' || $transaction->voucher_date=='01-01-1970')?date('d-m-Y', strtotime($settings->from_date)):date('d-m-Y', strtotime($transaction->voucher_date)); ?></td>
												<td><?php echo e($transaction->reference); ?></td>
												<td><?php echo e($transaction->cheque_no); ?></td>
												<td><?php echo ($transaction->cheque_date=='0000-00-00' || $transaction->cheque_date=='01-01-1970')?'':date('d-m-Y', strtotime($transaction->cheque_date)); ?></td>
												<td class="emptyrow text-right"><?php echo e($issued); ?></td>
												<td class="emptyrow text-right"><?php echo e($received); ?></td>
												<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
											</tr>
											<?php endforeach; ?>
											<tr>
												<td></td>
												<td></td>
												<td></td>
												<td class="highrow text-right"><strong>Total:</strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
												<td class="emptyrow text-right"><strong><?php echo e($balance_prnt); ?></strong></td>
											</tr>
											</tbody>
										</table>
										<?php } } ?>
									</td>
								</tr>
							</tbody>
							<tfoot id="inv">
								<tr>
									<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
							</tfoot>
						</table>
						<?php elseif($type=='osmonthly'): ?>
							<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:16px;"><br/><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>

								<tr>
									<td align="left" style="padding-left:0px;">
										<p><?php echo e($resultrow->master_name.' ('.$resultrow->account_id.')'); ?>

										<br/><?php echo e($resultrow->address); ?><?php echo e(($resultrow->phone!='')?' Ph:'.$resultrow->phone:''); ?>, TRN No: <?php echo e($resultrow->vat_no); ?></p>
									</td>
									<td align="right" style="padding-left:0px;">
										<br/>
									</td>
								</tr>
								
							</thead>
							<tbody id="bod">
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<?php if($fc) { ?>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<thead>
											<tr>
												<th >Inv.Date</th>
												<th>
													<strong>Reference</strong>
												</th>
												<th>
													<strong>Due Date</strong>
												</th>
												<th class="text-right">
													<strong>Debit</strong>
												</th>
												<th class="text-right">
													<strong>Credit</strong>
												</th>
											   <th class="text-right">
													Balance
												</th>
												
											</tr>
											</thead>
											<tbody>
											<?php 
												function date_compare($a, $b)
												{
													$t1 = strtotime($a['invoice_date']);
													$t2 = strtotime($b['invoice_date']);
													return $t1 - $t2;
												}
												foreach($transactions as $key => $trans) {
												  $cr_total = 0; $dr_total = 0; $balance = 0; $osbaltot = 0;
												  usort($trans, 'date_compare');
											?>
											<tr>
												<td colspan="6"><b>
												<?php //echo $key;  amount
												$dateObj   = DateTime::createFromFormat('!m', $key);
												echo $monthName = $dateObj->format('F'); 
												?></b></td>
											</tr>
											<?php foreach($trans as $transaction): ?>
											<tr>
												<td><?php echo date('d-m-Y', strtotime($transaction['invoice_date'])); 
														$dr_total += $transaction['dr_amount'];
														$cr_total += $transaction['cr_amount'];
														$balance += $transaction['balance'];
														$osbalance = $transaction['dr_amount'] - $transaction['cr_amount'];
														$osbaltot += $osbalance;
														
														if($osbalance > 0)
															$osbalance = number_format($osbalance,2);
														else if($osbalance < 0)
															$osbalance = '('.number_format(($osbalance*-1),2).')';
														
												?></td>
												<td><?php echo e($transaction['reference_from']); ?></td>
												<td><?php echo date('d-m-Y', strtotime($transaction['due_date'])); ?></td>
												<td class="emptyrow text-right"><?php echo e(($transaction['dr_amount']!=0)?$transaction['dr_amount']:''); ?></td>
												<td class="emptyrow text-right"><?php echo e(($transaction['cr_amount']!=0)?$transaction['cr_amount']:''); ?></td>
											   <td class="emptyrow text-right"><?php echo e($osbalance); ?></td>
												
											</tr>
												
											<?php endforeach; ?>
											<?php
												if($dr_total > 0)
													$dr_total = number_format($dr_total,2);
												else if($dr_total < 0)
													$dr_total = '('.number_format(($dr_total*-1),2).')';
													
												if($cr_total > 0)
													$cr_total = number_format($cr_total,2);
												else if($cr_total < 0)
													$cr_total = '('.number_format(($cr_total*-1),2).')';
												
												if($balance > 0)
													$balance = number_format($balance,2);
												else if($balance < 0)
													$balance = '('.number_format(($balance*-1),2).')';
												
												if($osbaltot > 0)
													$osbaltot = number_format($osbaltot,2);
												else if($osbaltot < 0)
													$osbaltot = '('.number_format(($osbaltot*-1),2).')';
												
											?>
											<tr>
												<td></td>
												<td></td>
												<td class="highrow text-right"><strong></strong></td>
												<td class="emptyrow text-right"><strong></strong></td>
												<td class="emptyrow text-right"><strong>Total:</strong></td>
												<td class="emptyrow text-right"><strong><?php echo e($osbaltot); ?></strong></td>
												
											</tr>
												<?php } ?>
											</tbody>
										</table>
										
									<?php } else { 
									?>
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<thead>
											<tr>
												<th >Inv.Date</th>
												<th>
													<strong>Reference</strong>
												</th>
												<th>
													<strong>Due Date</strong>
												</th>
												<th class="text-right">
													<strong>Debit</strong>
												</th>
												<th class="text-right">
													<strong>Credit</strong>
												</th>
											   <th class="text-right">
													Balance
												</th>
												
											</tr>
											</thead>
											<tbody>
											<?php 
												function date_compare($a, $b)
												{
													$t1 = strtotime($a['invoice_date']);
													$t2 = strtotime($b['invoice_date']);
													return $t1 - $t2;
												}
												foreach($transactions as $key => $trans) {
												  $cr_total = 0; $dr_total = 0; $balance = 0; $osbaltot = 0;
												  usort($trans, 'date_compare');
											?>
											<tr>
												<td colspan="6"><b>
												<?php //echo $key; 
												$dateObj   = DateTime::createFromFormat('!m', $key);
												echo $monthName = $dateObj->format('F'); 
												?></b></td>
											</tr>
											<?php foreach($trans as $transaction): ?>
											<?php 
														$dr_total += $transaction['dr_amount'];
														$cr_total += $transaction['cr_amount'];
														$balance += $transaction['balance'];
														$osbalance = $transaction['dr_amount'] - $transaction['cr_amount'];
														$osbaltot += $osbalance;
														
														if($osbalance > 0)
															$osbalance = number_format($osbalance,2);
														else if($osbalance < 0)
															$osbalance = '('.number_format(($osbalance*-1),2).')';
														
														if($osbalance!=0) {
												?>
											<tr>
												<td><?php echo date('d-m-Y', strtotime($transaction['invoice_date'])); ?></td>
												<td><?php echo e($transaction['reference_from']); ?></td>
												<td><?php echo date('d-m-Y', strtotime($transaction['due_date'])); ?></td>
												<td class="emptyrow text-right"><?php echo e(($transaction['dr_amount']!=0)?$transaction['dr_amount']:''); ?></td>
												<td class="emptyrow text-right"><?php echo e(($transaction['cr_amount']!=0)?$transaction['cr_amount']:''); ?></td>
											   <td class="emptyrow text-right"><?php echo e($osbalance); ?></td>
												
											</tr>
											<?php } ?>
											<?php endforeach; ?>
											<?php
												if($dr_total > 0)
													$dr_total = number_format($dr_total,2);
												else if($dr_total < 0)
													$dr_total = '('.number_format(($dr_total*-1),2).')';
													
												if($cr_total > 0)
													$cr_total = number_format($cr_total,2);
												else if($cr_total < 0)
													$cr_total = '('.number_format(($cr_total*-1),2).')';
												
												if($balance > 0)
													$balance = number_format($balance,2);
												else if($balance < 0)
													$balance = '('.number_format(($balance*-1),2).')';
												
												if($osbaltot > 0)
													$osbaltot = number_format($osbaltot,2);
												else if($osbaltot < 0)
													$osbaltot = '('.number_format(($osbaltot*-1),2).')';
												
											?>
											<tr>
												<td></td>
												<td></td>
												<td class="highrow text-right"><strong></strong></td>
												<td class="emptyrow text-right"><strong></strong></td>
												<td class="emptyrow text-right"><strong>Total:</strong></td>
												<td class="emptyrow text-right"><strong><?php echo e($osbaltot); ?></strong></td>
												
											</tr>
												<?php } ?>
											</tbody>
										</table>
									<?php } ?>
									</td>
								</tr>
							</tbody>
							<tfoot id="inv">
								<tr>
									<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
							</tfoot>
						</table>
						<?php else: ?>
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><br/><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
								</thead>
								<tbody id="bod">
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<?php  $grandTotal = 0;  ?>
										<?php if($type=='ageing_summary'): ?>
											<?php foreach($transactions as $agecat => $transactions2): ?>
											<table border="0" style="width:100%;" >
												<tr>
													<td align="left" style="padding-left:0px;">
														<p><b>Category: <?php echo e($agecat); ?></b></p>
													</td>
													<td align="right" style="padding-left:0px;">
														<p><b>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></b></p>
													</td>
												</tr>
											</table>
											<table class="tblstyle table-bordered" border="0" width="100%">
												<thead>
												<tr>
													<th><strong>Account ID</strong></th>
													<th>
														<strong>Account Name</strong>
													</th>
													<th class="text-right">
														<strong>0-30</strong>
													</th>
													<th class="text-right">
														<strong>31-60</strong>
													</th>
													<th class="text-right">
														<strong>61-90</strong>
													</th>
													<th class="text-right">
														<strong>91-120</strong>
													</th>
													<th class="text-right">
														<strong>Above 121</strong>
													</th>
													<th class="text-right">
														<strong>Total</strong>
													</th>
												</tr>
												</thead>
												<tbody>
												<?php $cr_total = 0; $dr_total = 0; $balance = 0; 
														$amt1T = $amt2T = $amt3T = $amt4T = $amt5T = 0;
												//$resultrow->op_balance;?>
												<?php foreach($transactions2 as $results): ?>
													<?php 
														if(count($results) > 0) { 
														$amt1 = $amt2 = $amt3 = $amt4 = $amt5 = $lntotal = 0; $balance_prnt = 0; ?>
													<?php foreach($results as $transaction): ?>
													<?php
															$cr_amount = ''; $dr_amount = '';
															$balance_prnt = $transaction['dr_amount'] - $transaction['cr_amount'];	
															$balance += $balance_prnt;
														
															$nodays = date_diff(date_create($transaction['invoice_date']),date_create(date('Y-m-d')));
															
															if($nodays->format("%a%") <= 30) {
																$amt1 += $balance_prnt;
																$amt1T += $balance_prnt;
															} else if($nodays->format("%a%") > 30 && $nodays->format("%a%") <= 60) {
																$amt2 += $balance_prnt;
																$amt2T += $balance_prnt;
															} else if($nodays->format("%a%") > 60 && $nodays->format("%a%") <= 90) {
																$amt3 += $balance_prnt;
																$amt3T += $balance_prnt;
															} else if($nodays->format("%a%") > 90 && $nodays->format("%a%") <= 120) {
																$amt4 += $balance_prnt;
																$amt4T += $balance_prnt;
															} else if($nodays->format("%a%") > 120) {
																$amt5 += $balance_prnt;
																$amt5T += $balance_prnt;
															}
															$lntotal = $amt1+$amt2+$amt3+$amt4+$amt5;
														?>
												<?php endforeach; ?>
												<?php
													if($balance != 0) { 
														
															
															
															if($amt1 > 0)
																$amt1 = number_format($amt1,2);
															else if($amt1 < 0)
																$amt1 = '('.number_format(($amt1*-1),2).')';
															else $amt1 = '';
															
															if($amt2 > 0)
																$amt2= number_format($amt2,2);
															else if($amt2 < 0)
																$amt2 = '('.number_format(($amt2*-1),2).')';
															else $amt2 = '';
															
															if($amt3 > 0)
																$amt3= number_format($amt3,2);
															else if($amt3 < 0)
																$amt3 = '('.number_format(($amt3*-1),2).')';
															else $amt3 = '';
															
															if($amt4 > 0)
																$amt4= number_format($amt4,2);
															else if($amt4 < 0)
																$amt4 = '('.number_format(($amt4*-1),2).')';
															else $amt4 = '';
															
															if($amt5 > 0)
																$amt5= number_format($amt5,2);
															else if($amt5 < 0)
																$amt5 = '('.number_format(($amt5*-1),2).')';
															else $amt5 = '';
															
															if($lntotal > 0)
																$lntotal= number_format($lntotal,2);
															else if($lntotal < 0)
																$lntotal = '('.number_format(($lntotal*-1),2).')';
															else $lntotal = '';
														 } 
													 if($lntotal!='') {
														 ?>
												<tr>
													<td><?php echo e($transaction['acid']); ?></td>
													<td><?php echo e($transaction['acname']); ?></td>
													<td class="emptyrow text-right"><?php echo e($amt1); ?></td>
													<td class="emptyrow text-right"><?php echo e($amt2); ?></td>
													<td class="emptyrow text-right"><?php echo e($amt3); ?></td>
													<td class="emptyrow text-right"><?php echo e($amt4); ?></td>
													<td class="emptyrow text-right"><?php echo e($amt5); ?></td>
													<td class="emptyrow text-right"><?php echo e($lntotal); ?></td>
												</tr>
													<?php } } ?>
												<?php endforeach; ?>	
												<?php
													if($balance > 0)
														$balance = number_format($balance,2);
													else if($balance < 0)
														$balance = '('.number_format(($balance*-1),2).')';
													else $balance = '';
													
													if($amt1T > 0)
														$amt1T = number_format($amt1T,2);
													else if($amt1T < 0)
														$amt1T = '('.number_format(($amt1T*-1),2).')';
													
													if($amt2T > 0)
														$amt2T = number_format($amt2T,2);
													else if($amt2T < 0)
														$amt2T = '('.number_format(($amt2T*-1),2).')';
													else $amt2T = '';
													
													if($amt3T > 0)
														$amt3T = number_format($amt3T,2);
													else if($amt3T < 0)
														$amt3T = '('.number_format(($amt3T*-1),2).')';
													else $amt3T = '';
													
													if($amt4T > 0)
														$amt4T = number_format($amt4T,2);
													else if($amt4T < 0)
														$amt4T = '('.number_format(($amt4T*-1),2).')';
													else $amt4T = '';
													
													if($amt5T > 0)
														$amt5T = number_format($amt5T,2);
													else if($amt5T < 0)
														$amt5T = '('.number_format(($amt5T*-1),2).')';
													else $amt5T = '';
													
												?>
												<tr>
													<td><?php echo e($lntotal); ?></td>
													<td><strong>Total:</strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt1T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt2T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt3T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt4T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt5T); ?></strong></td>
													<td class="highrow text-right"><strong><?php echo e($balance); ?></strong></td>
												</tr>
												</tbody>
											</table><hr/><p></p>
											<?php endforeach; ?>
										<?php else: ?>
											<?php foreach($transactions as $key => $transaction): ?>
											<?php $balance1 = 0;
											foreach($transaction as $trans) {
												$balance_prnt1 = bcsub($trans['dr_amount'], $trans['cr_amount'], 2);
												if($resultrow[$key]->category=='CUSTOMER' && $balance_prnt1 !=0)
													$balance1 += $balance_prnt1;
												else if($resultrow[$key]->category=='SUPPLIER' && $balance_prnt1 !=0)
													$balance1 += $balance_prnt1;
											} //echo 'fff'.$balance1;
											?>
											<?php if($balance1 != 0): ?>
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
											<?php if($pdclist): ?>
												
													<table border="0" style="width:100%;" class="tblstyle table-bordered">
													<tr>
														<td width="15%"><b>Invoice Date</b></td>
														<td width="10%"><b>Cheque No</b></td>
														<td width="10%"><b>Cheque Date</b></td>
														<td width="10%"><b>Bank Code</b></td>
														<td width="10%" class="text-right"><b>Debit</b></td>
														<td width="10%" class="text-right"><b>Credit</b></td>
														<td width="10%" class="text-right"><b>Balance</b></td>
													</tr> <?php  $pdcamt = 0;  ?>
													<?php foreach($pdclist[$key] as $pdc): ?>
													<?php  $pdcamt += $pdc->amount;  ?>
													<tr>
														<td><?php echo e(date('d-m-Y', strtotime($pdc->voucher_date))); ?></td>
														<td ><?php echo e($pdc->cheque_no); ?></td>
														<td ><?php echo e(date('d-m-Y', strtotime($pdc->cheque_date))); ?></td>
														<td ><?php echo e($pdc->code); ?></td>
														<td class="emptyrow text-right"><?php echo e(($pdc->type=='Dr')?$pdc->amount:''); ?></td>
														<td class="emptyrow text-right"><?php echo e(($pdc->type=='Cr')?$pdc->amount:''); ?></td>
														<td class="emptyrow text-right"></td>
													</tr>
													<?php endforeach; ?>
													<tr>
														<td></td>
														<td></td> 
														<td></td> 
														<td class="highrow text-right"><strong>Total:</strong></td>
														<td class="emptyrow text-right"><strong><?php echo e(($pdc->type=='Dr')?number_format($pdcamt,2):''); ?></strong></td>
														<td class="emptyrow text-right"><strong><?php echo e(($pdc->type=='Cr')?number_format($pdcamt,2):''); ?></strong></td>
														<td class="emptyrow text-right"><strong><?php echo e(number_format($pdcamt,2)); ?></strong></td>
													</tr>
													</table>
											<?php else: ?>
											<table class="tblstyle table-bordered" border="0" width="100%">
												<thead>
												<tr>
													<th >Inv.Date</th>
													<th >
														<strong>Ref.No</strong>
													</th>
													<th >
														<strong>Description</strong>
													</th>
													<?php if($jobid): ?>
													<th >
														<strong>Job No</strong>
													</th>
													<?php endif; ?>
													<th class="text-right">
														<strong>Due Amt.</strong>
													</th>
													<th class="text-right">
														<strong>0-30</strong>
													</th>
													<th class="text-right">
														<strong>31-60</strong>
													</th>
													<th class="text-right">
														<strong>61-90</strong>
													</th>
													<th class="text-right">
														<strong>91-120</strong>
													</th>
													<th class="text-right">
														<strong>Above 121</strong>
													</th>
												</tr>
												</thead>
												<tbody>
												<?php $cr_total = 0; $dr_total = 0; $balance = 0; $balance_prnt = 0;
														$amt1T = $amt2T = $amt3T = $amt4T = $amt5T = 0;
												//$resultrow->op_balance;?>
												<?php foreach($transaction as $trans): ?>
												<?php
												//if($transaction->voucher_type == 'OBD') {
														$cr_amount = ''; $dr_amount = '';
														$balance_prnt = $trans['dr_amount'] - $trans['cr_amount'];	
														$balance += $balance_prnt;
													
														$nodays = date_diff(date_create($trans['invoice_date']),date_create(date('Y-m-d')));
														$amt1 = $amt2 = $amt3 = $amt4 = $amt5 = '';
														if($nodays->format("%a%") <= 30) {
															$amt1 = $balance_prnt;
															$amt1T += $amt1;
														} else if($nodays->format("%a%") > 30 && $nodays->format("%a%") <= 60) {
															$amt2 = $balance_prnt;
															$amt2T += $amt2;
														} else if($nodays->format("%a%") > 60 && $nodays->format("%a%") <= 90) {
															$amt3 = $balance_prnt;
															$amt3T += $amt3;
														} else if($nodays->format("%a%") > 91 && $nodays->format("%a%") <= 120) {
															$amt4 = $balance_prnt;
															$amt4T += $amt4;
														} else if($nodays->format("%a%") > 120) {
															$amt5 = $balance_prnt;
															$amt5T += $amt5;
														}
														
														if($balance_prnt != 0) { 
														
														if($balance_prnt > 0)
															$balance_prnt = number_format($balance_prnt,2);
														else if($balance_prnt < 0)
															$balance_prnt = '('.number_format(($balance_prnt*-1),2).')';
														else $balance_prnt = '';
														
													if($amt1 > 0)
														$amt1 = number_format($amt1,2);
													else if($amt1 < 0)
														$amt1 = '('.number_format(($amt1*-1),2).')';
													else $amt1 = '';
													
													if($amt2 > 0)
														$amt2= number_format($amt2,2);
													else if($amt2 < 0)
														$amt2 = '('.number_format(($amt2*-1),2).')';
													else $amt2 = '';
													
													if($amt3 > 0)
														$amt3= number_format($amt3,2);
													else if($amt3 < 0)
														$amt3 = '('.number_format(($amt3*-1),2).')';
													else $amt3 = '';
													
													if($amt4 > 0)
														$amt4= number_format($amt4,2);
													else if($amt4 < 0)
														$amt4 = '('.number_format(($amt4*-1),2).')';
													else $amt4 = '';
													
													if($amt5 > 0)
														$amt5= number_format($amt5,2);
													else if($amt5 < 0)
														$amt5 = '('.number_format(($amt5*-1),2).')';
													else $amt5 = '';
												?>
													<tr>
														<td><?php echo date('d-m-Y', strtotime($trans['invoice_date'])); ?></td>
														<td><?php echo e($trans['reference_from']); ?></td>
														<td><?php echo e($trans['description']); ?><?php //echo date('d-m-Y', strtotime($transaction['invoice_date'])); ?></td>
														<?php if($jobid): ?><td><?php echo e($trans['jobno']); ?></td><?php endif; ?>
														<td class="emptyrow text-right"><?php echo e($balance_prnt); ?></td>
														<td class="emptyrow text-right"><?php echo e($amt1); ?></td>
														<td class="emptyrow text-right"><?php echo e($amt2); ?></td>
														<td class="emptyrow text-right"><?php echo e($amt3); ?></td>
														<td class="emptyrow text-right"><?php echo e($amt4); ?></td>
														<td class="emptyrow text-right"><?php echo e($amt5); ?></td>
													</tr>
												<?php } ?>
												<?php endforeach; ?>
												<?php
													 $grandTotal += $balance;
													if($balance > 0)
														$balance = number_format($balance,2);
													else if($balance < 0)
														$balance = '('.number_format(($balance*-1),2).')';
													
													if($amt1T > 0)
														$amt1T = number_format($amt1T,2);
													else if($amt1T < 0)
														$amt1T = '('.number_format(($amt1T*-1),2).')';
													
													if($amt2T > 0)
														$amt2T = number_format($amt2T,2);
													else if($amt2T < 0)
														$amt2T = '('.number_format(($amt2T*-1),2).')';
													else $amt2T = '';
													
													if($amt3T > 0)
														$amt3T = number_format($amt3T,2);
													else if($amt3T < 0)
														$amt3T = '('.number_format(($amt3T*-1),2).')';
													else $amt3T = '';
													
													if($amt4T > 0)
														$amt4T = number_format($amt4T,2);
													else if($amt4T < 0)
														$amt4T = '('.number_format(($amt4T*-1),2).')';
													else $amt4T = '';
													
													if($amt5T > 0)
														$amt5T = number_format($amt5T,2);
													else if($amt5T < 0)
														$amt5T = '('.number_format(($amt5T*-1),2).')';
													else $amt5T = '';
													
													
												?>
												<tr>
													<td></td>
													<td></td> <?php if($jobid): ?><td></td><?php endif; ?>
													<td><strong>Total:</strong></td>
													<td class="highrow text-right"><strong><?php echo e($balance); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt1T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt2T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt3T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt4T); ?></strong></td>
													<td class="emptyrow text-right"><strong><?php echo e($amt5T); ?></strong></td>
												</tr>
												</tbody>
											</table>
											<?php endif; ?>
											<hr/>
											<?php endif; ?>
											<?php endforeach; ?>
										<?php endif; ?>
										</td>
									</tr>
									<tr>
									    <td>
									        <?php if($iscustom==1): ?>
									        <table border="1" width="100%" class="tblstyle table-bordered">
									        <tr>
											<td class="highrow text-right"><strong>Grand Total:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(($grandTotal > 0)?number_format($grandTotal,2):'('.number_format(($grandTotal*-1),2).')'); ?></strong></td>
											</tr>
											</table>
											<?php endif; ?>
									    </td>
									</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						<?php endif; ?>
						<?php //} ?>
						</div>
                    </div>
                    <div class="btn-section">
						
						<div class="pull-left">
								<select id="send_id" class="form-control select" style="width:100%" name="send_id">
									<option value="" selected>Select </option>
									<option value="email">Send through Email</option>
									<option value="whatsapp">Send through Whatsapp</option>
								</select>
						</div>	
								
						<div class="details-continer" >
						<form class="form-horizontal" role="form" method="POST" name="frmSend" id="frmSend" target="_blank" enctype="multipart/form-data" action="<?php echo e(url('account_enquiry/send')); ?>">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
								<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
								<input type="hidden" name="type" value="<?php echo e($type); ?>" >
								<input type="hidden" name="is_pdc" value="<?php echo e($ispdc); ?>" >
								<input type="hidden" name="is_con" value="<?php echo e($iscon); ?>" >
								<input type="hidden" name="is_custom" value="<?php echo e($iscustom); ?>" >
								<input type="hidden" name="account_id" value="<?php echo e($id); ?>" >
								<input type="hidden" name="category_id" value="<?php echo e($catid); ?>" >
								<input type="hidden" name="group_id" value="<?php echo e($groupid); ?>" >
								<input type="hidden" name="type_id" value="<?php echo e($typeid); ?>" >
							
							 <div class="email details">
								<div class="container" >
									
									<div class="col-md-10 col-sm-10 col-xs-10">
										<div class="col-sm-7">
										<input type="text" name="mailid" id="mailid"class="form-control"  value="<?php echo e((isset($key) && isset($resultrow[$key]))?$resultrow[$key]->email:''); ?>" style="width:100%" > 
										</div>
										<div class="col-sm-2">
										<input type="submit" name="submite" id="submit" class="btn btn-success" value="Send" style="Background:#3276B1">
										</div>
									
									</div>		
								</div>	
								</div>	
							
								<div class="whatsapp details">
								<div class="container" >
													
								<div class="col-md-10 col-sm-10 col-xs-10">
									<div class="col-sm-7">
								 <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" class="form-control" style="width:100%">
								</div>
								<div class="col-sm-2">
										<input type="submit" name="submitw" id="submit" class="btn btn-success" value="Send" style="Background:#3276B1"> 
										<label id="submitw">
								</div>
											
								</div>	
								</div>	
							
						</form>	
						</div>
									
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right">
									 <button type="button" onclick="javascript:window.print();" 
											 class="btn btn-responsive button-alignment btn-primary"
											 data-toggle="button">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-print"></i>
										Print
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
								
								<button type="button" onclick="getExport()"
											 class="btn btn-responsive button-alignment btn-primary"
											 data-toggle="button">
										<span style="color:#fff;">
											<i class="fa fa-fw fa-upload"></i>
										Export Excel
									</span>
									</button>
									
                                </span>
                        </div>
						<form class="form-horizontal" role="form" method="POST" name="frmExport" id="frmExport" action="<?php echo e(url('account_enquiry/export')); ?>">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
						<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
						<input type="hidden" name="type" value="<?php echo e($type); ?>" >
						<input type="hidden" name="is_pdc" value="<?php echo e($ispdc); ?>" >
						<input type="hidden" name="is_con" value="<?php echo e($iscon); ?>" >
						<input type="hidden" name="is_custom" value="<?php echo e($iscustom); ?>" >
						<input type="hidden" name="account_id" value="<?php echo e($id); ?>" >
						<input type="hidden" name="category_id" value="<?php echo e($catid); ?>" >
						<input type="hidden" name="group_id" value="<?php echo e($groupid); ?>" >
						<input type="hidden" name="type_id" value="<?php echo e($typeid); ?>" >
						</form>
					
                    </div>
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
<script>
function getExport() { document.frmExport.submit(); }

$(document).ready(function () {
	$('html').attr({style: 'min-height: inherit'});
	$('body').attr({style: 'min-height: inherit'});
	$(".details").hide();
	$("#send_id").change(function(){
       var name=$("#send_id").val();
	  
	  
	  $(".details").hide();
	  $("."+name).show();

	  $(mailid).show();
	 })
	
});
</script>
</html>

