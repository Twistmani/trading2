

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
        Invoice
    @parent
<?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
   <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/invoice.css')); ?>">-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/bootstrap.css')); ?>">
    <!--end of page level css-->
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                 Customer Receipt
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
                    <a href="">Customer Receipt</a>
                </li>
                <li class="active">
                   Print
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content p-l-r-15" id="cost-job">
            <div class="panel">
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
							<table border="0" style="width:100%;">
								<tr><td align="center" colspan="3">
										<!--<img src="<?php echo e(asset('assets/'.Session::get('logo').'')); ?>" width="100%" /><br/>-->
									<!--	<b style="font-size:15px;">Ph: <?php echo e(Session::get('phone')); ?>, <?php echo e(Session::get('address')); ?></b><br/>
										<b style="font-size:15px;">TRN No: <?php echo e(Session::get('vatno')); ?></b>-->
										<b style="font-size:15px;"><?php echo $__env->make('main.print_head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></b><br/>
									</td>
								</tr>
								<tr>
									<td width="40%">
									</td><td align="center"><h5><u><b><?php echo e($voucherhead); ?></b></u></h5></td>
									<td width="40%" align="left"></td>
								</tr>
								<tr>
									<td width="40%" align="center"></h6>
									</td><td align="center"></td>
									<td width="40%" align="right"><p>RV. No: <?php echo e($details->voucher_no); ?></p><p>Date: <?php echo e(date('d-m-Y',strtotime($details->voucher_date))); ?></p></td>
								</tr>
							</table><br/>
                        </div>
						<?php
							$name = '';
							if(sizeof($invoicerow) > 1) {
								$name = $invoicerow[1]->master_name;
								
								foreach($invoicerow as $invrow) {
									$refnos = '';
									if($invrow->entry_type=='Dr') {
										$refnos = $invrow->reference;
										break;
									}
								}
							}
						?>
                        <div class="col-md-12">
						<!--	<div style="text-align:center;"><h5><p>Received with thanks from Ms./Mr. <b><?php echo e($name); ?></b> the sum of <b>Dhs. <?php echo e($amtwords); ?></b> against invoice nos: <?php echo e($refnos); ?>.</p></h5></div>
							<br/><b>Mode of Receipt:</b>-->
							<table class="table" border="1">
								<thead>
									<th>Account Name</th>
									<th >Description</th>
									<th >Reference</th>
									<th class="text-right">Debit</th>
									<th class="text-right">Credit</th>
								</thead>
								<body>
								<?php  $dramount = $cramount = 0;  ?>
								<?php foreach($invoicerow as $row): ?>
									<tr>
										<td><?php echo e($row->master_name); ?></td>
										<td ><?php echo e($row->description); ?></td>
										<td><?php echo e($row->reference); ?></td>
										<td class="text-right"><?php if($row->entry_type=='Dr'): ?><?php echo e(number_format($row->amount,2)); ?> <?php  $dramount += $row->amount;  ?> <?php endif; ?></td>
										<td class="text-right"><?php if($row->entry_type=='Cr'): ?><?php echo e(number_format($row->amount,2)); ?> <?php  $cramount += $row->amount;  ?> <?php endif; ?></td>
									</tr>
								<?php endforeach; ?>
									<tr>
										<td colspan="3"><b>Total:</b></td>
										<td class="text-right"><b><?php echo e(number_format($dramount,2)); ?></b></td>
										<td class="text-right"><b><?php echo e(number_format($cramount,2)); ?></b></td>
									</tr>
								</body>
							</table>
							
							<!--<table class="table" border="1">
								<thead>
									<th>Debit Account</th>
									<th class="text-right">Amount</th>
									<th class="text-right">Cheque No.</th>
									<th class="text-right">Cheque Date</th>
									<th class="text-right">Drawn on</th>
								</thead>
								<body>
									<tr>
										<td><?php echo e($invoicerow[0]->master_name); ?></td>
										<td class="text-right"><?php echo e(number_format($invoicerow[0]->amount,2)); ?></td>
										<td class="text-right"><?php echo e($invoicerow[0]->cheque_no); ?></td>
										<td class="text-right">
										<?php if($invoicerow[0]->cheque_no!='')
												echo date('d-m-Y',strtotime($invoicerow[0]->cheque_date)); ?></td>
										<td class="text-right"><?php echo e($invoicerow[0]->name); ?></td>
									</tr>
								</body>
							</table>-->
							<br/>
							<br/><br/><br/>
							
							
                        </div>
						
						
							
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right">
                                           
                                             <button type="button" onclick="javascript:window.print();"
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;">
                                                    <i class="fa fa-fw fa-print"></i>
                                                Print
                                            </span>
                                </button>
								
								<button type="button" onclick="javascript:window.close();"
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;">
                                                    <i class="fa fa-fw fa-times"></i>
                                                Close 
                                            </span>
                                </button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        <?php echo $__env->make('layouts.right_sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- right side bar end -->
        </section>
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>
    <!-- begining of page level js -->
<script type="text/javascript" src="<?php echo e(asset('assets/js/custom_js/invoice.js')); ?>"></script>
    <!-- end of page level js -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>