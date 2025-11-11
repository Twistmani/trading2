

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
                Customer Enquiry
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Inventory
                </li>
				<li>
                    <a href="#">Customer Enquiry</a>
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
                            <i class="fa fa-fw fa-list-alt"></i> Customer Enquiry
                        </h3>
                        <div class="pull-right">
							<?php if (\Entrust::can(('ce-create'))) : ?>
                             <a href="<?php echo e(url('customer_enquiry/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
							<?php endif; // Entrust::can ?>
                        </div>
                    </div>
                    <div class="panel-body">
						 <div class="row">
                               
                            </div>
                        <div class="table-responsive m-t-10">
                                <table class="table horizontal_table table-striped" id="tablePordersList">
                                    <thead>
                                    <tr>
										<th>CE. No</th>
										<th>Customer</th>
										<th>CE. Date</th>
										<th>Amount</th>
										<?php if($settings->doc_approve==1) { ?><th>Status</th><?php } ?>
										<th></th><th></th><th></th><th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
										
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
		</section>
		
		<section class="content">
			<form class="form-horizontal" role="form" method="POST" name="frmQReport" id="frmQReport" action="<?php echo e(url('customer_enquiry/search')); ?>" target="_blank">
			 <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
			 <div class="row">
			 <div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel-heading clearfix">
							<h3 class="panel-title pull-left m-t-6">
								<i class="fa fa-fw fa-list-alt"></i> Customer Enquiry Report
							</h3>
						</div>
						<div class="panel-body">
								<div class="row">
									<div class="col-xs-6">
										<span>Date From:</span>
										<input type="text" name="date_from" data-language='en' autocomplete="off" id="date_from" class="form-control input-sm">
										<span>Date To:</span>
										<input type="text" name="date_to" data-language='en' autocomplete="off" id="date_to" class="form-control input-sm">
										<span>Job No:</span>
										<select id="select21" class="form-control select2" multiple style="width:100%" name="job_id[]">
											<option value="">Select Job No...</option>
											<?php foreach($jobs as $job): ?>
												<option value="<?php echo e($job['id']); ?>"><?php echo e($job['code']); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="col-xs-6">
										<span>Search By:</span>
										<select id="search_type" class="form-control select2" style="width:100%" name="search_type">
											<option value="summary">Summary</option>
											<option value="detail">Detail</option>
										<!--	<option value="summary_pending">Summary(Pending Quotation)</option>
											<option value="detail_pending">Detail(Pending Quotation)</option>-->
										</select>
										<span>Salesman</span>
										<select id="select22" class="form-control select2" style="width:100%" name="salesman">
											<option value="">--Select Salesman--</option>
											<?php foreach($salesman as $row): ?>
											<option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
											<?php endforeach; ?>
										</select>
										
										<span>Customer</span>
										<select id="select23" class="form-control select2" multiple style="width:100%" name="customer_id">
											<option value="">Select customer...</option>
											<?php foreach($cus as $row): ?>
												<option value="<?php echo e($row->id); ?>"><?php echo e($row->master_name); ?></option>
											<?php endforeach; ?>
										</select>
										<br/>
										<input type="checkbox" name="pending" value="1"> Pending
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
<script src="<?php echo e(asset('assets/js/custom_js/custom_elements.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>
<script>

$('#date_from').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy'} );
$('#date_to').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

$(document).ready(function () {
	$("#select21").select2({
        theme: "bootstrap",
        placeholder: "Job No"
    });
	$("#select22").select2({
        theme: "bootstrap",
        placeholder: "Salesman"
    });
$("#select23").select2({
        theme: "bootstrap",
        placeholder: "Customer"
    });

});
function funDelete(id,no) {
	if(no=='0') {
		var con = confirm('Are you sure delete this customer enquiry?');
		if(con==true) {
			var url = "<?php echo e(url('customer_enquiry/delete/')); ?>";
			location.href = url+'/'+id;
		}
	} else 
		alert('This customer enquiry is processed, you cannot edit or delete');
}

$(function() {
		
		var dtInstance = $("#tablePordersList").DataTable({
			"processing": true,
			"serverSide": true,
			"searching": true,
			"ajax":{
					 "url": "<?php echo e(url('customer_enquiry/paging/')); ?>",
					 "dataType": "json",
					 "type": "POST",
					 "data":{ _token: "<?php echo e(csrf_token()); ?>"}
				   },
			"columns": [
			{ "data": "voucher_no" },
			{ "data": "customer" },
			{ "data": "voucher_date" },
			{ "data": "net_total" },
			<?php if($settings->doc_approve==1) { ?>{ "data": "status" },<?php } ?>
			<?php if (\Entrust::can(('ce-edit'))) : ?>{ "data": "edit","bSortable": false },<?php endif; // Entrust::can ?>
			<?php if (\Entrust::can(('ce-print'))) : ?>{ "data": "print","bSortable": false },<?php endif; // Entrust::can ?>
			{ "data": "open","bSortable": false },
			<?php if (\Entrust::can(('ce-delete'))) : ?>{ "data": "delete","bSortable": false },<?php endif; // Entrust::can ?>
		]	
		  
		});
		
		$('#select23').on('change', function(e){
			    var cust_id = $('#select23').val();
			    console.log(cust_id);
			     if(cust_id !=''){
			    $.get("<?php echo e(url('customer_enquiry/getjob/')); ?>/" + cust_id, function(data) {
				$('#select21').find('option').remove().end();
				$.each(data, function(key, value) {   
				$('#select21').find('option').end()
				 .append($("<option></option>")
							.attr("value",value.id)
							.text(value.code)); 
				});
			});
			    }
		});
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>