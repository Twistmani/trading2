

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

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
                Balance Sheet
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="glyphicon glyphicon-folder-close"></i> Reports
                    </a>
                </li>
                <li>
                    <a href="#">Balance Sheet</a>
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
                                <i class="fa fa-fw fa-columns"></i> Balance Sheet
                            </h3>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" name="frmTrialBalance" id="frmTrialBalance" target="_blank" action="<?php echo e(url('balance_sheet/search')); ?>">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" readonly class="form-control" placeholder="<?php echo e(date('d-m-Y',strtotime($settings->from_date))); ?>">
										<span>Date To:</span>
										<input type="text" name="date_to" id="date_to" data-language='en' autocomplete="off" class="form-control">
										
										<?php if($isdept): ?>
										<span>Department:</span>
										<select id="department_id" class="form-control select2" style="width:100%" name="department_id">
											<option value="">Select Department...</option>
											<?php foreach($departments as $dept): ?>
											<option value="<?php echo e($dept->id); ?>"><?php echo e($dept->name); ?></option>
											<?php endforeach; ?>
										</select>
										<?php endif; ?>
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<option value="summary">Summary</option>
											<option value="detail">Detail</option>
											<!--<option value="ason_date">Summary as on Date</option>-->
										</select>
                                        <br/>
                                        <span>Opening Balance:</span> <input type="checkbox" name="chkob" value="1"></input>
                                        <span></span><br/>
                                       
										<div class="col-xs-12" align="right"><button type="button" class="btn btn-primary" onClick="getSearch()">Search</button></div>
									</div>
								</div>
							</form>
                            <div class="table-responsive m-t-10" id="accounts">
                                <table class="table horizontal_table table-striped" id="tableAcmaster">
                                    <thead>
                                    <tr>
                                        <th></th>
										<th>Account ID</th>
                                        <th>Account Master</th>
										<th>Group</th>
										<th>Category</th>
                                        <th>Closing Balance</th>
                                        <th>Open Balance</th>
										<th></th><th></th><th></th>
                                    </tr>
                                    </thead>
                                   
                                </table>
                            </div>
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
<script src="<?php echo e(asset('assets/js/custom_js/responsive_datatables.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>
<!-- end of page level js -->

<script>

$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
$('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

$(function() {	
	$('#accounts').hide(); 
	
	$(document).on('change', '#search_type', function(e) { 
	   if($('#search_type option:selected').val()=='taged_summary')
			$('#accounts').show();
		else
			$('#accounts').hide();
    });
});

function getSearch()
{
	if( $('#search_type option:selected').val() == 'ason_date') {
		
		if( $('#date_from').val()=='' && $('#date_to').val()=='') {
			alert('Please selete date range!');
			return false;
			
		} else 
			document.frmTrialBalance.submit();
	} else 
		document.frmTrialBalance.submit();
	
	
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>