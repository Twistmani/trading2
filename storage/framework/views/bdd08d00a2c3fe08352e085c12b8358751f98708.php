

   
<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
	
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
        <!--end of page level css-->
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Vat Report
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="glyphicon glyphicon-folder-close"></i> Reports
                    </a>
                </li>
                <li>
                    <a href="#">Vat Report</a>
                </li>
            </ol>
			
        </section>
		
        <!--section ends-->
		<?php if(Session::has('message')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('message')); ?></p>
		</div>
		<?php endif; ?>
		
        <section class="content">
            <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-info">
						
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-columns"></i> <?php echo e($voucherhead); ?>

                            </h3>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" name="frmVatReport" target="_blank" id="frmVatReport" action="<?php echo e(url('vat_report/search')); ?>">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" data-language='en' id="date_from" value="<?php echo $fromdate; ?>" class="form-control" set autocomplete="off">
										<span>Date To:</span>
										<input type="text" name="date_to" data-language='en' id="date_to" value="<?php echo $todate; ?>" class="form-control" set autocomplete="off">
									    <br/>
										<select id="code_type" class="form-control select2" style="width:100%" name="code_type">
											<option value="" default>Select Tax Code...</option>
											<option value="SR">SR</option>
											<option value="RC">RC</option>
											<option value="ZR">ZR</option>
											<option value="EX">EX</option>
										</select>

									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<option value="summary" <?php if($type=='summary') echo 'selected';?>>Summary</option>
											<!--<option value="summary_taxcode" <?php if($type=='summary_taxcode') echo 'selected';?>>Tax Code Summary</option>-->
											<option value="detail" <?php if($type=='detail') echo 'selected';?>>Detail</option>
											<!--<option value="partywise" <?php if($type=='partywise') echo 'selected';?>>Partywise</option>
											<option value="areawise" <?php if($type=='areawise') echo 'selected';?>>Areawise</option>
											<option value="tax_code" <?php if($type=='tax_code') echo 'selected';?>>Tax Code</option>-->
										<!--	<option value="categorywise" <?php //if($type=='categorywise') echo 'selected';?>>Categorywise</option>-->
										</select>
										
										<span>Department:</span>
										<select id="department_id" class="form-control select2" style="width:100%" name="department_id">
											<option value="">Select Department...</option>
											<?php foreach($departments as $dept): ?>
											<option value="<?php echo e($dept->id); ?>"><?php echo e($dept->name); ?></option>
											<?php endforeach; ?>
										</select>
										
										<span></span><br/>
										<div class="col-xs-12" align="right"> <button type="submit" class="btn btn-primary">Search</button></div>
									</div>
								</div>
								<?php if($reports!=null) { ?>
								
								<div class="table-responsive m-t-10">
								<?php if($voucherhead=='Vat Report Summary') { ?>
									<table class="table horizontal_table table-striped" id="tableAcmaster">
										<thead>
											<tr>
												<th>SI.No</th>
												<th>Group Name</th>
												<th>Account ID</th>
												<th>Account Name</th>
												<th class="text-right">Vat Amount</th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php $i=0;  ?>
											<?php foreach($reports as $report): ?>
											<?php $i++; $in=0;
												if($report->master_name=='VAT OUTPUT')
													$out = $report->cl_balance;
												else
													$in += $report->cl_balance;
											?>
											<tr>
												<td><?php echo e($i); ?></td>
												<td><?php echo e($report->group_name); ?></td>
												<td><?php echo e($report->account_id); ?></td>
												<td><?php echo e($report->master_name); ?></td>
												<td class="text-right">
												<?php if($report->cl_balance < 0)
														echo number_format($report->cl_balance*-1,2);
													else
														echo number_format($report->cl_balance,2);
												?></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<?php endforeach; ?>
											<?php
												$out = ($out < 0)?$out*-1:$out;
												$vat = $out - $in;
											?>
											<tr>
												<td></td><td></td><td></td><td><b>Total Vat Payable:</b></td>
												<td class="text-right"><b><?php echo e(number_format($vat,2)); ?></b></td>
												<td></td>
												<td></td><td></td>
											</tr>
										</tbody>
									</table>
									
									<?php } else if($voucherhead=='Vat Report Detail'){ ?>
								<div class="col-md-12">
					
								<div class="table-responsive">
									<table class="table table-striped table-condensed">
										<thead>
										<tr class="bg-primary">
											<th style="width:70px;">
												<strong>Invoice No</strong>
											</th>
											<th>
												<strong>Date</strong>
											</th>
											<th>
												<strong>Supplier</strong>
											</th>
											<th class="text-right">
												<strong>Amount</strong>
											</th>
											<th class="text-right">
												<strong>TRN No</strong>
											</th>
											<th class="text-right">
												<strong>Vat</strong>
											</th>
											<th class="text-right">
												<strong>Net Amount</strong>
											</th>
											
											<th class="emptyrow" style="width:20px;"></th>
										</tr>
										</thead>
										<tbody>
										<tr><td colspan="9"><strong>Journal Vouchers</strong></td></tr>
										<?php $purvat = 0;?>
										<?php foreach($reports['inputexp'] as $row): ?>
										<tr> 
											<td><?php echo e($row->voucher_no); ?></td>
											<td><?php echo e($row->voucher_date); ?></td>
											<td><?php echo e($row->master_name); ?></td>
											<td class="emptyrow text-right"><?php echo number_format(($row->total-$row->vat_amount),2);?></td>
											<td class="emptyrow text-right"><?php echo e($row->vat_no); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->net_amount,2)); ?></td>
											<td class="emptyrow"></td>
											<?php $purvat += $row->vat_amount; ?>
										</tr>
										<?php endforeach; ?>
										<tr>
											<td></td>
											<td class="highrow text-right"></td>
											<td class="highrow text-right"><strong></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow text-right"><strong>Vat Input Expense:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($purvat,2)); ?></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow"></td>
										</tr>
										
										<tr><td colspan="9"><strong>Purchase</strong></td></tr>
										<?php $purvat = 0;?>
										<?php foreach($reports['purchase'] as $row): ?>
										<tr> 
											<td><?php echo e($row->voucher_no); ?></td>
											<td><?php echo e($row->voucher_date); ?></td>
											<td><?php echo e($row->master_name); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->total,2)); ?></td>
											<td class="emptyrow text-right"><?php echo e($row->vat_no); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->net_amount,2)); ?></td>
											<td class="emptyrow"></td>
											<?php $purvat += $row->vat_amount; ?>
										</tr>
										<?php endforeach; ?>
										<tr>
											<td></td>
											<td class="highrow text-right"></td>
											<td class="highrow text-right"><strong></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow text-right"><strong>Vat Input:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($purvat,2)); ?></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow"></td>
										</tr>
										
										<tr><td colspan="9"><strong>Sales</strong></td></tr>
										<?php $salevat = 0;?>
										<?php foreach($reports['sales'] as $row): ?>
										<tr> 
											<td><?php echo e($row->voucher_no); ?></td>
											<td><?php echo e($row->voucher_date); ?></td>
											<td><?php echo e($row->master_name); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->total,2)); ?></td>
											<td class="emptyrow text-right"><?php echo e($row->vat_no); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
											<td class="emptyrow text-right"><?php echo e(number_format($row->net_total,2)); ?></td>
											<td class="emptyrow"></td>
											<?php $salevat += $row->vat_amount; ?>
										</tr>
										<?php endforeach; ?>
										<tr>
											<td></td>
											<td class="highrow text-right"></td>
											<td class="highrow text-right"><strong></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow text-right"><strong>Vat Output:</strong></td>
											<td class="emptyrow text-right"><strong><?php echo e(number_format($salevat,2)); ?></strong></td>
											<td class="emptyrow text-right"></td>
											<td class="emptyrow"></td>
										</tr>
										</tbody>
									</table>
								</div>
                        </div>
						<?php } ?>
									<button type="button" class="btn btn-primary outstanding" onclick="getDetail()">Print</button>
								</div>
								<?php } ?>
								
							</form>
							
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

<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>
<!-- end of page level js -->


<script>

	$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy'}); 
    $('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy'});

	function getDetail() {	
	document.frmVatReport.action = "<?php echo e(url('vat_report/print')); ?>";
	document.frmVatReport.submit();
}
$(document).ready(function () {
$('#code_type').hide();
});
$(function() {
$('#search_type').on('change', function(e) { 
var vchr = e.target.value; 
console.log(vchr);
		if(vchr=='tax_code') {
		$('#code_type').show();
	}	
	else{
	$('#code_type').hide();
	}		
});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>