

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
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Vat Master
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-wrench"></i> Maintenance
                    </a>
                </li>
                <li>
                    <a href="#">Vat Master</a>
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
                            <i class="fa fa-fw fa-list-alt"></i> Vat Master List
                        </h3>
                        <div class="pull-right">
						<?php if (\Entrust::can(('vat-create'))) : ?>
                             <a href="<?php echo e(url('vat_master/add')); ?>" class="btn btn-primary btn-sm">
									<span class="btn-label">
									<i class="glyphicon glyphicon-plus"></i>
								</span> Add New
							</a>
						<?php endif; // Entrust::can ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                                <table class="table table-striped" id="tableVat Master">
                                    <thead>
                                    <tr>
                                        <th>Vat Code</th>
										<th>Vat Name</th>
										<th>Vat %</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($vatmasters as $vatmaster): ?>
                                    <tr>
                                        <td><?php echo e($vatmaster->code); ?></td>
										<td><?php echo e($vatmaster->name); ?></td>
										<td><?php echo e($vatmaster->percentage); ?></td>
										<td>
											<p>
												<button class="btn btn-primary btn-xs" onClick="location.href='<?php echo e(url('vat_master/edit/'.$vatmaster->id)); ?>'">
												<span class="glyphicon glyphicon-pencil"></span></button>
											</p>
										</td>
										<td><?php if (\Entrust::can(('vat-delete'))) : ?>
											<p>
												<button class="btn btn-danger btn-xs delete" onClick="funDelete('<?php echo e($vatmaster->id); ?>')"><span
															class="glyphicon glyphicon-trash"></span></button>
											</p>
											<?php endif; // Entrust::can ?>
										</td>
                                    </tr>
									<?php endforeach; ?>
                                    <?php if(count($vatmasters) === 0): ?>
									</tbody>
									<tbody><tr class="odd danger"><td valign="top" colspan="5" class="dataTables_empty">No matching records found</td></tr></tbody>
									<?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title custom_align" id="Heading5">Delete Group</h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure delete this group?
                        </div>
                    </div>
                    <div class="modal-footer ">
						<button class="btn btn-danger" value="Yes" id="btndelete">
                            <span class="glyphicon glyphicon-ok-sign"></span> Yes
                        </button>
						
                        <button type="button" class="btn btn-success" data-dismiss="modal" value="No">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<!-- end of page level js -->
<script>

function funDelete(id) {
	var con = confirm('Are you sure delete this vatmaster?');
	if(con==true) {
		var url = "<?php echo e(url('vat_master/delete/')); ?>";
	 location.href = url+'/'+id;
	}
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>