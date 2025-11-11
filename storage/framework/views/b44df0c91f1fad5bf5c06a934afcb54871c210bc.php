

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
    <!--page level css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/iCheck/css/all.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/bootstrap-fileinput/css/fileinput.min.css')); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/formelements.css')); ?>">
        <!--end of page level css-->
		
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
	
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
<?php $__env->stopSection(); ?>
 
<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Job Master
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Job Master</a>
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
                            <i class="fa fa-fw fa-list-alt"></i> Job List
                        </h3>
                        <div class="pull-right">
                             <a href="<?php echo e(url('jobmaster/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableJobmaster">
                                    <thead>
                                    <tr>
                                        <th>Job Code</th>
										<th>Job Name</th>
										<th>Customer</th>
                                        <th>Date</th>
										<th></th>
										<th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
		
		<section class="content">
            <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-info">
                        <div class="panel-heading clearfix">
                            <h3 class="panel-title pull-left m-t-6">
                                <i class="fa fa-fw fa-columns"></i> Job Report
                            </h3>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" target="_blank" name="frmJobReport" id="frmJobReport" target="_blank" action="<?php echo e(url('job_report/search')); ?>">
								<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" data-language='en' id="date_from" class="form-control" autocomplete="off">
										<span>Date To:</span>
										<input type="text" name="date_to" data-language='en' id="date_to" class="form-control" autocomplete="off">
										
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<option value="summary">Summary</option>
											<option value="detail">Detail Account Wise</option>
										</select>
										<span>Job</span>
										<select id="job_id" class="form-control select2" style="width:100%" name="job_id">
                                            <option value="">Select Job...</option>
											<?php foreach($jobs as $row) { ?>
											<option value="<?php echo e($row['id']); ?>"><?php echo e($row['code'].' - '.$row['name']); ?></option>
											<?php } ?>
                                        </select>
										<br/> <input type="checkbox" name="is_jobsplit" value="1"> Job Cargo
										 &nbsp; <div class="col-xs-12" align="right"> <button type="submit" class="btn btn-primary">Search</button></div>
									</div>
								</div>
								
							</form>
							
                        </div>
                    </div>
            </div>
        </div>
        </section>
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>

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

    <!-- begining of page level js -->
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<!-- end of page level js -->

<script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>

<script>

$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
$('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

function funDelete(id) {
	var con = confirm('Are you sure delete this jobmaster?');
	if(con==true) {
		var url = "<?php echo e(url('jobmaster/delete/')); ?>";
	 location.href = url+'/'+id;
	}
}

$(function() {
		
		var dtInstance = $("#tableJobmaster").DataTable({
			"processing": true,
			"serverSide": true,
			"searching": true,
			"ajax":{
					 "url": "<?php echo e(url('jobmaster/paging/')); ?>",
					 "dataType": "json",
					 "type": "POST",
					 "data":{ _token: "<?php echo e(csrf_token()); ?>"}
				   },
			"columns": [
			{ "data": "code" },
			{ "data": "name" },
			{ "data": "customer" },
            { "data": "date" },
			{ "data": "edit","bSortable": false },
			{ "data": "delete","bSortable": false },
            { "data": "history","bSortable": false },
		]	
		  
		});
});

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>