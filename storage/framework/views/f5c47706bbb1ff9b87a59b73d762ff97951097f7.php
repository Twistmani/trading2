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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom_css/skins/skin-coreplus.css')); ?>" type="text/css" id="skin"/>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/bootstrap.css')); ?>">
<?php echo $__env->yieldContent('header_styles'); ?>

<style>
#invoicing {
	font-size:9pt;
}

.tblstyle td,
  .tblstyle th {
    height:15px;
	padding:2px;
	border:1px solid #000 !important;
  }


</style>
<style type="text/css" media="print">


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
												
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><br/><b><u><?php echo e($voucherhead); ?></u></b></b></td>
									</tr>
									<tr><td><br/></td></tr>
									<tr>
										<td colspan="2" align="left" valign="top" style="padding-left:0px;">
											<p>Date From: <b><?php echo ($fromdate=='')?date('d-m-Y',strtotime($settings->from_date)):$fromdate;?></b> &nbsp; To: <b><?php echo ($todate=='')?date('d-m-Y'):$todate;?></b></p>
										</td>
									</tr>
									
								</thead>
								<tbody id="bod">
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
											<?php if($voucherhead == 'Opening Trial Balance - Summary' || $voucherhead == 'Opening Trial Balance - Summary as on Date') { ?>
												<table class="table table">
													<thead>
													<tr class="bg-primary">
														<th>
															<strong>Account Group</strong>
														</th>
														<th class="text-right">
															<strong>Debit</strong>
														</th>
														
														<th class="text-right">
															<strong>Credit</strong>
														</th>
														
														<th class="text-right">
															<strong></strong>
														</th>
													</tr>
													</thead>
													<tbody>
													<?php $cr_total = $dr_total = $bl_total = 0; ?>
													<?php foreach($results as $transaction): ?>
													<tr> <?php  $camt = ($transaction['cr_amount'] < 0)?$transaction['cr_amount']*-1:$transaction['cr_amount'];
																$cr_total += $camt;
																$dr_total += $transaction['dr_amount'];
														?>
														<td><?php echo e($transaction['name']); ?></td>
														<td class="emptyrow text-right"><?php echo $damount = ($transaction['dr_amount']!=0)?number_format($transaction['dr_amount'],2):'';?></td>
														<td class="emptyrow text-right"><?php echo $camount = ($camt!=0)?number_format($camt,2):'';?></td>
														<td class="emptyrow"></td>
													</tr>
													<?php endforeach; ?>
													<tr>
														<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
														<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
														<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
														
														<td class="emptyrow text-right"></td>
													</tr>
													</tbody>
												</table>
											<?php } else if($voucherhead == 'Opening Trial Balance - Groupwise' || $voucherhead == 'Trial Balance - Groupwise As on Date' || $voucherhead == 'Opening Trial Balance - Detail by Account Taged' || $voucherhead == 'Opening Trial Balance - Detail by Account Taged as on Date') { ?>
													<table class="table table">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group/Head</strong>
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong></strong>
															</th>
														</tr>
														</thead>
														<tbody>
														<?php $cr_total = $dr_total = $bl_total = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr>
															<td><b><?php echo e($transaction[0]['group_name']); ?></b></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
															<?php $grp_ctotal = $grp_dtotal = 0; ?>
															<?php foreach($transaction as $row): ?>
															<tr> <?php 
																		if($row['transaction_type']=='Dr') { 
																			$dr_amount = $row['op_balance'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['op_balance'];
																			$dr_amount = 0;
																		}
																		$cr_amount = ($cr_amount < 0)?$cr_amount*-1:$cr_amount;
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																		$grp_ctotal += $cr_amount;
																		$grp_dtotal += $dr_amount;
																		
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"><?php echo $damount = ($dr_amount!=0)?number_format($dr_amount,2):'';?></td>
																<td class="emptyrow text-right"><?php echo $camount = ($cr_amount!=0)?number_format($cr_amount,2):'';?></td>
																<td class="emptyrow"></td>
															</tr>
															<?php endforeach; ?>
															<tr>
																<td></td>
																<td class="emptyrow text-right"><b>Group Total: &nbsp; <?php echo e(number_format($grp_dtotal,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal,2)); ?></b></td>
																<td></td>
															</tr>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
															<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
															<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
															<td class="emptyrow"></td>
														</tr>
														</tbody>
													</table>
											<?php } else if($voucherhead == 'Trial Balance - Detail by Group Taged' || $voucherhead == 'Trial Balance - Detail by Group Taged as on Date') { ?>
													<table class="table table">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Name</strong>
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong></strong>
															</th>
														</tr>
														</thead>
														<tbody>
															<?php foreach($results as $transaction): ?>
															<tr>
																<td><b><?php echo e($transaction[0]['group_name']); ?></b></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<?php $cr_total = $dr_total = $bl_total = 0; ?>
															<?php foreach($transaction as $row): ?>
															<tr> <?php 
																		/* if($row['transaction_type']=='Dr') { 
																			$dr_amount = $row['op_balance'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['op_balance'];
																			$dr_amount = 0;
																		} */
																		if($row['op_balance'] > 0) {
																			$dr_amount = $row['op_balance'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['op_balance'];
																			$dr_amount = 0;
																		}
																			
																		$cr_amount = ($cr_amount < 0)?$cr_amount*-1:$cr_amount;
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"><?php echo $damount = ($dr_amount!=0)?number_format($dr_amount,2):'';?></td>
																<td class="emptyrow text-right"><?php echo $camount = ($cr_amount!=0)?number_format($cr_amount,2):'';?></td>
																<td class="emptyrow"></td>
															</tr>
															<?php endforeach; ?>
															
															<tr>
																<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
																<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
																<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
																<td class="emptyrow"></td>
															</tr>
														<?php endforeach; ?>
														</tbody>
													</table>
											<?php } else if($voucherhead == 'Closing Trial Balance - Groupwise') { ?>
													<table class="table table" border="0">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group/Head</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong></strong>
															</th>
														</tr>
														</thead>
														<tbody>
														<?php $cr_total = $dr_total = $bl_total = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr>
															<td><b><?php echo e($transaction['group_name']); ?></b></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
															<?php $grp_ctotal = $grp_dtotal = 0; ?>
															<?php foreach($transaction['accounts'] as $row): ?>
															<tr> <?php 
																		if($row['type']=='Dr') { 
																			$dr_amount = $row['amount'];
																			//$dr_amount += ($dr_amount==$row['obamount'])?0:(($row['obamount']!=0)?$row['obamount']:0);
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['amount'];
																			//$cr_amount += ($cr_amount==$row['obamount'])?0:(($row['obamount']!=0)?$row['obamount']:0);
																			$dr_amount = 0;
																		}
																		
																		
																		$obamountdr = $obamountcr = '';
																		//if($damount!='') {
																			//$obamountdr = ($dr_amount==$row['obamount'])?'':(($row['obamount']!=0)?'OB. '.number_format($row['obamount'],2).' Dr':'');
																			
																		//} 
																		
																		//if($camount!='') {
																			//$obamountcr = ($cr_amount==$row['obamount'])?'':(($row['obamount']!=0)?'OB. '.number_format($row['obamount'],2).' Cr':'');
																			
																		//}
																		
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																		$grp_ctotal += $cr_amount;
																		$grp_dtotal += $dr_amount;
																		
																	
																		$damount = ($dr_amount!=0)?number_format($dr_amount,2):'';
																		$camount = ($cr_amount!=0)?number_format($cr_amount,2):'';
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"></td>
																<td class="emptyrow text-right"><?php echo e($damount); ?></td>
																<td class="emptyrow text-right"></td>
																<td class="emptyrow text-right"><?php echo e($camount); ?></td>
																<td class="emptyrow"></td>
															</tr>
															<?php endforeach; ?>
															<tr>
																<td></td>
																<td></td>
																<td class="emptyrow text-right"><b>Group Total: &nbsp; <?php echo e(number_format($grp_dtotal,2)); ?></b></td>
																<td></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal,2)); ?></b></td>
																<td class="emptyrow text-right"></td>
															</tr>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
															<td></td>
															<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
															<td></td>
															<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
															<td class="emptyrow text-right"></td>
														</tr>
														</tbody>
													</table>
											<?php } else if($voucherhead == 'Closing Trial Balance - with Balance') { ?>
													<table class="table table">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group/Head</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong>Balance</strong>
															</th>
														</tr>
														</thead>
														<tbody>
														<?php $cr_total = $dr_total = $bl_total = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr>
															<td><b><?php echo e($transaction['group_name']); ?></b></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
															<?php $grp_ctotal = $grp_dtotal = 0; ?>
															<?php foreach($transaction['accounts'] as $row): ?>
															<tr> <?php 
																		if($row['type']=='Dr') { 
																			$dr_amount = $row['amount'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['amount'];
																			$dr_amount = 0;
																		}
																		
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																		$grp_ctotal += $cr_amount;
																		$grp_dtotal += $dr_amount;
																		
																		$damount = ($dr_amount!=0)?number_format($dr_amount,2):'';
																		$camount = ($cr_amount!=0)?number_format($cr_amount,2):'';
																		
																		$obamountdr = $obamountcr = '';
																		if($damount!='') {
																			$obamountdr = ($dr_amount==$row['obamount']?'':$row['obamount']!=0)?'OB. '.number_format($row['obamount'],2).' Dr':'';
																		} 
																		
																		if($camount!='') {
																			$obamountcr = ($cr_amount==$row['obamount']?'':$row['obamount']!=0)?'OB. '.number_format($row['obamount'],2).' Cr':'';
																		}
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"></td>
																<td class="emptyrow text-right"><?php echo e($damount); ?></td>
																<td class="emptyrow text-right"></td>
																<td class="emptyrow text-right"><?php echo e($camount); ?></td>
																<td class="emptyrow"></td>
															</tr>
															<?php endforeach; ?>
															<tr>
																<td></td>
																<td></td>
																<td class="emptyrow text-right"><b>Group Total: &nbsp; <?php echo e(number_format($grp_dtotal,2)); ?></b></td>
																<td></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal,2)); ?></b></td>
																<?php $balance = $grp_dtotal - $grp_ctotal; ?>
																<td class="emptyrow text-right"><b>
																	<?php
																		echo ($balance > 0)?number_format($balance,2):'('.number_format(($balance*-1),2).')';
																	?></b>
																</td>
															</tr>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
															<td></td>
															<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
															<td></td>
															<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
															<td class="emptyrow text-right">
																
															</td>
														</tr>
														</tbody>
													</table>
													
											<?php } else if($voucherhead == 'Trial Balance YTD') { ?>
													<table class="table table" border="1">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group/Head</strong>
															</th>
															<th class="text-right">
																<strong>OB. Dr.</strong>
															</th>
															<th class="text-right">
																<strong>OB. Cr.</strong>
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong>Balance</strong>
															</th>
															
														</tr>
														</thead>
														<tbody>
														<?php $gnd_dtotal_ob = $gnd_ctotal_ob = $cr_total = $dr_total = $gnd_balance = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr>
															<td><b><?php echo e($transaction['group_name']); ?></b></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															
														</tr>
															<?php $grp_dtotal_ob = $grp_ctotal_ob = $grp_ctotal = $grp_dtotal = $grp_balance = 0; ?>
															<?php foreach($transaction['accounts'] as $row): ?>
															<tr> <?php 
																		if($row['type']=='Dr') { 
																			$dr_amount = $row['amount'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['amount'];
																			$dr_amount = 0;
																		}
																		
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																		$grp_ctotal += $cr_amount;
																		$grp_dtotal += $dr_amount; $clbalance = '';
																		
																		$damount = ($dr_amount!=0)?number_format($dr_amount,2):'';
																		$camount = ($cr_amount!=0)?number_format($cr_amount,2):'';
																		
																		$obamountdr = $obamountcr = '';
																		if($row['type_ob']=='Dr') { 
																			$obamountdr = number_format($row['obamount'],2);
																			$obamountcr = '';
																			$grp_dtotal_ob += $row['obamount'];
																		} else {
																			$obamountcr = number_format($row['obamount'],2);
																			$obamountdr = '';
																			$grp_ctotal_ob += $row['obamount'];
																		}
																		if($row['balance'] > 0)
																			$clbalance = number_format($row['balance'],2);
																		else
																			$clbalance = '('.number_format($row['balance']*-1,2).')';

																		$grp_balance += $row['balance'];
																		
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"><?php echo e($obamountdr); ?></td>
																<td class="emptyrow text-right"><?php echo e($obamountcr); ?></td>
																<td class="emptyrow text-right"><?php echo e($damount); ?></td>
																<td class="emptyrow text-right"><?php echo e($camount); ?></td>
																<td class="emptyrow text-right"><?php echo e($clbalance); ?></td>
																
															</tr>
															<?php endforeach; ?>
															<tr>
																<td class="emptyrow text-right"><b>Total:</b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_dtotal_ob,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal_ob,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_dtotal,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(($grp_balance > 0)?number_format($grp_balance,2):'('.number_format($grp_balance*-1,2).')'); ?></b></td>
																
															</tr>
															<?php 
																  $gnd_dtotal_ob += $grp_dtotal_ob;
																  $gnd_ctotal_ob += $grp_ctotal_ob;
																  $gnd_balance += $grp_balance;
															?>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><b>Grand Total:</b></td>
															<td class="highrow text-right"><b><?php echo e(number_format($gnd_dtotal_ob,2)); ?></b></td>
															<td class="highrow text-right"><b><?php echo e(number_format($gnd_ctotal_ob,2)); ?></b></td>
															<td class="highrow text-right"><b><?php echo e(number_format($dr_total,2)); ?></b></td>
															<td class="highrow text-right"><b><?php echo e(number_format($cr_total,2)); ?></b></td>
															<td class="emptyrow text-right"><b><?php echo e(($gnd_balance > 0)?number_format($gnd_balance,2):'('.number_format($gnd_balance*-1,2).')'); ?></b></td>
															
														</tr>
														</tbody>
													</table>
													
											<?php } else if($voucherhead == 'Closing Trial Balance - Summary') { ?>
													<table class="table table" border="0">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															<th class="text-right">
															</th>
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															
															<th class="text-right">
																<strong></strong>
															</th>
														</tr>
														</thead>
														<tbody>
														<?php $cr_total = $dr_total = $bl_total = $btotal = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr> <?php  $camt = ($transaction['cr_amount'] < 0)?$transaction['cr_amount']*-1:$transaction['cr_amount'];
																	$cr_total += $camt;
																	$dr_total += $transaction['dr_amount'];
																	$obamoundr = $obamouncr = '';
																	if($transaction['obamount'] > 0)
																		$obamoundr = ($transaction['obamount']!=0)?'OB. '.$transaction['obamount'].' Dr':'';
																	else
																		$obamouncr = ($transaction['obamount']!=0)?'OB. '.$transaction['obamount'].' Cr':'';
															?>
															<td><?php echo e($transaction['group_name']); ?></td>
															<td class="emptyrow text-right"></td>
															<td class="emptyrow text-right"><?php echo $damount = ($transaction['dr_amount']!=0)?number_format($transaction['dr_amount'],2):'';?></td>
															<td class="emptyrow text-right"></td>
															<td class="emptyrow text-right"><?php echo $camount = ($camt!=0)?number_format($camt,2):'';?></td>
															<td class="emptyrow text-right"></td>
														</tr>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
															<td></td>
															<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
															<td></td>
															<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
															<td class="emptyrow text-right"></td>
														</tr>
														</tbody>
													</table>
											<?php } else if($voucherhead == 'Opening Trial Balance - with Balance') { ?>
													<table class="table table">
														<thead>
														<tr class="bg-primary">
															<th>
																<strong>Account Group/Head</strong>
															</th>
															<th class="text-right">
																<strong>Debit</strong>
															</th>
															
															<th class="text-right">
																<strong>Credit</strong>
															</th>
															<th class="text-right">
																<strong>Balance</strong>
															</th>
														</tr>
														</thead>
														<tbody>
														<?php $cr_total = $dr_total = $bl_total = 0; ?>
														<?php foreach($results as $transaction): ?>
														<tr>
															<td><b><?php echo e($transaction[0]['group_name']); ?></b></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>
															<?php $grp_ctotal = $grp_dtotal = 0; ?>
															<?php foreach($transaction as $row): ?>
															<tr> <?php 
																		if($row['transaction_type']=='Dr') { 
																			$dr_amount = $row['op_balance'];
																			$cr_amount = 0;
																		} else {
																			$cr_amount = $row['op_balance'];
																			$dr_amount = 0;
																		}
																		$cr_amount = ($cr_amount < 0)?$cr_amount*-1:$cr_amount;
																		$cr_total += $cr_amount;
																		$dr_total += $dr_amount;
																		$grp_ctotal += $cr_amount;
																		$grp_dtotal += $dr_amount;
																		
																?>
																<td style="padding-left:100px;"><?php echo e($row['master_name']); ?></td>
																<td class="emptyrow text-right"><?php echo $damount = ($dr_amount!=0)?number_format($dr_amount,2):'';?></td>
																<td class="emptyrow text-right"><?php echo $camount = ($cr_amount!=0)?number_format($cr_amount,2):'';?></td>
																<td class="emptyrow"></td>
															</tr>
															<?php endforeach; ?>
															<tr>
																<td></td>
																<td class="emptyrow text-right"><b>Group Total: &nbsp; <?php echo e(number_format($grp_dtotal,2)); ?></b></td>
																<td class="emptyrow text-right"><b><?php echo e(number_format($grp_ctotal,2)); ?></b></td>
																<?php $balance = $grp_dtotal - $grp_ctotal; ?>
																<td class="emptyrow text-right"><?php
																		echo ($balance > 0)?number_format($balance,2):'('.number_format(($balance*-1),2).')';
																	?></td>
															</tr>
														<?php endforeach; ?>
														<tr>
															<td class="highrow text-right"><strong>Total: <?php echo e($currency); ?></strong></td>
															<td class="highrow text-right"><strong><?php echo e(number_format($dr_total,2)); ?></strong></td>
															<td class="emptyrow text-right"><strong><?php echo e(number_format($cr_total,2)); ?></strong></td>
															<td class="emptyrow"></td>
														</tr>
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
						
						
						</div>
                    </div>
                    <div class="btn-section">
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
								<button type="button" onclick="getExport()"
											 class="btn btn-responsive button-alignment btn-primary"
											 data-toggle="button">
										<span style="color:#fff;">
											<i class="fa fa-fw fa-upload"></i>
										Export Excel
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
					<form class="form-horizontal" role="form" method="POST" name="frmExport" id="frmExport" action="<?php echo e(url('trial_balance/export')); ?>">
						<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
						<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
						<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
						<input type="hidden" name="search_type" value="<?php echo e($type); ?>" >
						
						
						<input type="hidden" name="group_id" value="<?php echo e($grpid); ?>" >
						<div style="display:none;">
							<input type="checkbox" name="trim_zero" value="1" <?php echo e(($trimzero)?'checked':''); ?>>
							<input type="checkbox" name="exclude" value="1" <?php echo e(($exl)?'checked':''); ?>>
						</div>
						<input type="hidden" name="accounts_arr" value="<?php echo e($accounts); ?>" >
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
<script>
function getExport() { document.frmExport.submit(); }

$(document).ready(function () {
	$('html').attr({style: 'min-height: inherit'});
	$('body').attr({style: 'min-height: inherit'});
	
});
</script>
</html>
