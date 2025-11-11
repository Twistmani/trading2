

    <?php /* Page title */ ?>
    <?php $__env->startSection('title'); ?>
         
        @parent
    <?php $__env->stopSection(); ?>

<?php /* page level styles */ ?>
<?php $__env->startSection('header_styles'); ?>
        <!--end of page level css-->
		
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
	<link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                 Manual Journal
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
				<li class="active">
                    Manual Journal
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
                            <i class="fa fa-fw fa-list-alt"></i> Manual Journal Entry List
                        </h3>
                        <div class="pull-right">
							
                             <a href="<?php echo e(url('manual_journal/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
						
                        </div>
                    </div>
                    <div class="panel-body">
						<div class="row">
                                <div class="col-xs-6">
                                </div>
                            </div>
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableMJVlist" border="0">
                                    <thead>
                                    <tr>

                                        <th>JV. No</th>
                                       <!-- <th>Type</th>-->
										<th>Date</th>
										<th>Description</th>
										<th>Reference</th>
										<th>Amount</th>										
										<th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($journals as $journal): ?>
									
                                    <tr>
                                        <td><?php echo e($journal->voucher_no); ?></td>
                                        <?php /* <td><?php echo e($journal->voucher_type); ?></td> */ ?>
										
										<td><?php echo e(date('d-m-Y',strtotime($journal->voucher_date))); ?></td>
										<td><?php echo e($journal->description); ?></td>
										<td><?php echo e($journal->reference); ?></td>
										<td><?php echo e(number_format($journal->credit,2)); ?></td>
										<td>
											<?php if (\Entrust::can(('mjv-edit'))) : ?><p><button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('manual_journal/edit/'.$journal->id)); ?>'"><span class="glyphicon glyphicon-pencil"></span></button></p><?php endif; // Entrust::can ?>
										</td>
									 	<td>
											<?php if (\Entrust::can(('mjv-delete'))) : ?><p><button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($journal->id); ?>')"><span class="glyphicon glyphicon-trash"></span></button></p><?php endif; // Entrust::can ?>
										</td>
										<td>
										<p>
											
											<a href="<?php echo e(url('manual_journal/print/'.$journal->id.'/'.$prints[0]->id)); ?>" target='_blank'  role='menuitem' class="btn btn-primary btn-xs"><span class="fa fa-fw fa-print"></span></a>
											
										</p>
										</td>
                                    </tr>
									<?php endforeach; ?>
                                   <!-- <?php if(count($journals) == 0): ?>
									</tbody>
									<tbody><tr class="odd danger"><td valign="top" colspan="7" class="dataTables_empty">No matching records found</td></tr></tbody>
									<?php endif; ?>
                                    </tbody>
									-->
                                </table>
                            </div>
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


<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendors/mark.js/jquery.mark.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')); ?>" charset="UTF-8"></script>
<script src="<?php echo e(asset('assets/js/custom_js/responsive_datatables.js')); ?>" type="text/javascript"></script>

<!-- end of page level js -->
<script>
    $(function() {
	/*	
		var dtInstance = $("#tableMJVlist").DataTable({
			"processing": true,
			"serverSide": true,
			"searching": true,
            "order": [[ 0, 'desc' ]],
			"ajax":{
					 "url": "<?php echo e(url('manual_journal/paging/')); ?>",
					 "dataType": "json",
					 "type": "POST",
					 "data":{ _token: "<?php echo e(csrf_token()); ?>"}
				   },
			"columns": [
			    { "data": "voucher_no" },
			    { "data": "voucher_type" },
			    { "data": "voucher_date" },
			    { "data": "description" },
			    { "data": "amount" },
			    <?php if (\Entrust::can(('mjv-edit'))) : ?>{ "data": "edit","bSortable": false },<?php endif; // Entrust::can ?>
			    <?php if (\Entrust::can(('mjv-print'))) : ?>{ "data": "print","bSortable": false },<?php endif; // Entrust::can ?>
			    <?php if (\Entrust::can(('mjv-delete'))) : ?>{ "data": "delete","bSortable": false }<?php endif; // Entrust::can ?>
		    ]	
		  
		});*/
 });
 

function funDelete(id) {
	var con = confirm('Are you sure delete this journal?');
	if(con==true) {
		var url = "<?php echo e(url('manual_journal/delete/')); ?>";
		location.href = url+'/'+id+'/JV';
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>