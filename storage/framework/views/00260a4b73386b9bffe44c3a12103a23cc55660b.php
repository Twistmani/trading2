

   
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
                PDC Report
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="glyphicon glyphicon-folder-close"></i> Reports
                    </a>
                </li>
                <li>
                    <a href="#">PDC Report</a>
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
							<form class="form-horizontal" role="form" method="POST" name="frmPDCReport" id="frmPDCReport" action="<?php echo e(url('pdc_report/search')); ?>" target="_blank">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" data-language='en' autocomplete="off" id="date_from" value="<?php echo $fromdate; ?>" class="form-control">
										<span>Date To:</span>
										<input type="text" name="date_to" data-language='en' autocomplete="off" id="date_to" value="<?php echo $todate; ?>" class="form-control">
										<span>Status:</span>
										<select id="status" class="form-control select2" style="width:100%" name="status">
											<option value="">Both</option>
											<option value="1">Cleared</option>
											<option value="0">Uncleared</option>
										</select>
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<!--<option value="both" <?php //if($type=='both') echo 'selected';?>>Both</option>-->
											<option value="received" <?php if($type=='received') echo 'selected';?>>PDC Received</option>
											<option value="issued" <?php if($type=='issued') echo 'selected';?>>PDC Issued</option>
										</select>
										
										<span>Customer/Supplier</span>
										<select id="account_id" class="form-control select2" style="width:100%" name="account_id">
											<option value="">Customer/Supplier</option>
											<?php foreach($custsup as $row): ?>
												<option value="<?php echo e($row->id); ?>"><?php echo e($row->master_name); ?></option>
											<?php endforeach; ?>
										</select>
										
										<span></span><br/>
										<input type="checkbox" class="onacnt_icheck" name="ob_only" value="1"> PDC Opening Balance Only
										&nbsp;  <div class="col-xs-12" align="right"> <button type="submit" class="btn btn-primary">Search</button></div>

									</div>
								</div>
						<?php if($reports!=null) { ?>
								
								<div class="table-responsive m-t-10">
								<?php //if($voucherhead=='Vat Report Summary') { ?>
									<table class="table horizontal_table table-striped" id="tableAcmaster">
										<thead>
											<tr>
												<th>Type</th>
												<th>Inv.#</th>
												<th>Bank</th>
												<th>Tr.Date</th>
												<th>Cheque Dt.</th>
												<th class="text-right">Amount</th>
												<th>Party Name</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										
											<?php foreach($reports as $key => $report): ?>
											<?php 
												$total = 0;
												foreach($report as $row) {
												$total += $row->amount;
												$date = $row->voucher_date;
												?>
											<tr>
												<td><?php echo e($row->type); ?></td>
												<td><?php echo e($row->voucher_no); ?></td>
												<td><?php echo e($row->code); ?></td>
												<td><?php echo e(date('d-m-Y', strtotime($row->voucher_date))); ?></td>
												<td><?php echo e(date('d-m-Y', strtotime($row->cheque_date))); ?></td>
												<td class="text-right"><?php echo e(number_format($row->amount,2)); ?></td>
												<td><?php echo e($row->customer); ?></td>
												<td></td>
											</tr>
											<?php } ?>
											
											<tr>
												<td></td><td></td><td></td><td></td>
												<td><b>Total in <?php echo date('M', strtotime($date));?>: </b></td>
												<td class="text-right"><b><?php echo e(number_format($total,2)); ?></b></td>
												<td></td><td></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
									
									<?php //} ?>
						
									<!--<button type="button" class="btn btn-primary outstanding" onclick="getDetail()">Print</button>-->
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
	  
	$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
    $('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
	
function getDetail() {	
	document.frmPDCReport.action = "<?php echo e(url('vat_report/print')); ?>";
	document.frmPDCReport.submit();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>