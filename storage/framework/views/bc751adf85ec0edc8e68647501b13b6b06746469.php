

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

	<link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" type="text/css">
    <!--end of page level css-->
		
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Manufacture Voucher
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Inventory
                </li>
				<li>
                    <a href="#">Manufacture Voucher</a>
                </li>
            </ol>
        </section>
        <!--section ends-->
		<?php if(Session::has('message')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('message')); ?></p>
		</div>
		<?php endif; ?>
        
		<?php if(Session::has('error')): ?>
		<div class="alert alert-danger">
			<p><?php echo e(Session::get('error')); ?></p>
		</div>
		<?php endif; ?>
		
		<section class="content">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-list-alt"></i> Manufacture Voucher
                        </h3>
                        <div class="pull-right">
							<?php if (\Entrust::can(('pi-create'))) : ?>
                             <a href="<?php echo e(url('manufacture/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
							<?php endif; // Entrust::can ?>
                        </div>
                    </div>
                    <div class="panel-body">
						 
                        <div class="table-responsive m-t-10">
                                <table class="table table-striped" id="tableLocation">
                                    <thead>
                                    <tr>
										<th>Voucher No</th>
										<th>Voucher Date</th>
										<th>Item Name</th>
										<th>Qty.</th>
										<th></th>
										<th></th>
										<th></th><th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($stocktrans as $stock): ?>
                                    <tr>
                                        <td><?php echo e($stock->voucher_no); ?></td>
										<td><?php echo e(date('d-m-Y',strtotime($stock->voucher_date))); ?></td>
										<td><?php echo e($stock->description); ?></td>
										<td><?php echo e($stock->qty); ?></td>
										<td>
											<p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('manufacture/edit/'.$stock->id)); ?>'">
												<span class="glyphicon glyphicon-pencil"></span></button>
											</p>
										</td>
											<td>
											<p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('manufacture/viewonly/'.$stock->id)); ?>'">
												<span class="glyphicon glyphicon-eye-open"></span></button>
											</p>
										</td>
										<td>
											<p>
												<button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($stock->id); ?>')"><span
															class="glyphicon glyphicon-trash"></span></button>
											</p>
										</td>
										<td>
											<p><a href="<?php echo e(url('manufacture/print/'.$stock->id)); ?>" target= "_blank" class="btn btn-primary btn-xs"><span class="fa fa-fw fa-print"></span></a></p>
										</td>
                                    </tr>
									<?php endforeach; ?>
                                    
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
		</section>
		<section class="content">
			<form class="form-horizontal" role="form" method="POST" name="frmReport" id="frmReport" target="_blank" action="<?php echo e(url('manufacture/search')); ?>">
			 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			 <div class="row">
			 <div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel-heading clearfix">
							<h3 class="panel-title pull-left m-t-6">
								<i class="fa fa-fw fa-list-alt"></i> Manufacture Voucher Report
							</h3>
						</div>
						<div class="panel-body">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" data-language='en' autocomplete="off" id="date_from" class="form-control">
										<span>Date To:</span>
										<input type="text" name="date_to" data-language='en' autocomplete="off" id="date_to" class="form-control">
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<option value="summary">Summary</option>
											<option value="detail" <?php if($type=='detail') echo 'selected';?>>Detail</option>
										</select>
										<span>Department:</span>
										<select id="select29" class="form-control select2" multiple style="width:100%" name="dept_id[]">
											<option value="">Select Department...</option>
											<?php foreach($departments as $row): ?>
												<option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
											<?php endforeach; ?>
										</select>
									
										<br/>
										<div class="col-xs-12" align="right"> <button type="submit" class="btn btn-primary">Search</button></div>
									</div>
								</div>
						</div>
					</div>
			</div>
			</div>
			</form>
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

<script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/vendors/mark.js/jquery.mark.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/js/custom_js/responsive_datatables.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>

<script>

$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
$('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );
$(document).ready(function () {
	$("#select29").select2({
        theme: "bootstrap",
        placeholder: "Department"
    });
    
});
function funDelete(id) {
	var con = confirm('Are you sure delete this Manufacture Voucher?');
	if(con==true) {
		var url = "<?php echo e(url('manufacture/delete/')); ?>";
		location.href = url+'/'+id;
	}
}


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>