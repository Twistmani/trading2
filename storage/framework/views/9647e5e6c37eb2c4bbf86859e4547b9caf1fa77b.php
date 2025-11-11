

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')); ?>" rel="stylesheet" type="text/css">
	
	<link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" type="text/css">
	
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
                Timesheet Report
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="fa fa-fw fa-money"></i> Timesheet
                    </a>
                </li>
                <li>
                    <a href="#">Timesheet Report</a>
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
                                <i class="fa fa-fw fa-columns"></i> Timesheet Employeewise Report
                            </h3>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" name="frmPayrollReport" id="frmPayrollReport" action="<?php echo e(url('timesheet_report/search')); ?>" target="_blank">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="row">
									<div class="col-xs-6">
									<div class="months">
										<span>Month:</span>
										<select id="month" class="form-control select2 " style="width:100%" name="month">
										   <option value="">Select Month</option>
											<option value="1">January</option>
											<option value="2">February</option>
											<option value="3">March</option>
											<option value="4">April</option>
											<option value="5">May</option>
											<option value="6">June</option>
											<option value="7">July</option>
											<option value="8">Auguest</option>
											<option value="9">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
										</div>
										<div class="dates">
										<span>Date:</span>
										
									<input type="text" class="form-control pull-right" name="date" data-language='en' id="date" autocomplete="off" value="<?php echo e(date('d-m-Y')); ?>" placeholder="Date"/>
								
										
								</div>		
									
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2 search-type" style="width:100%" name="search_type">
											<option value="daily">Daily</option>
											<option value="monthly">Monthly</option>
											
										</select>
										
										<span>Employee:</span>
										<select id="employee_id" class="form-control select2" style="width:100%" name="employee_id">
	
											<?php foreach($employees as $emp) { ?>
											<option value="<?php echo e($emp['id']); ?>"><?php echo e($emp['name']); ?></option>
											<?php } ?>
											</select><br/>
										<button type="submit" class="btn btn-primary">Search</button>
									</div>
								</div>
								
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

<script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')); ?>" type="text/javascript"></script>



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
$(document).ready(function () {
 $('#date').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
$('.months').toggle();

	$("#employee_id").select2({
        theme: "bootstrap",
        placeholder: "Select Employee"
    });

	});
$(function() {	


$(document).on('change', '.search-type', function(e) {
		
		var type = this.value; 
	if(type=='monthly')	{
	
	if( $('.months').is(":hidden") )
				$('.months').toggle();
	else if( $('.months').is(":visible") )
			$('.months').toggle();
	if( $('.dates').is(":visible") )
			$('.dates').toggle();		
	}
	else{
	if( $('.months').is(":visible") )
			$('.months').toggle();
	if( $('.dates').is(":hidden") )
			$('.dates').toggle();		
	
	}

		});
   
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>