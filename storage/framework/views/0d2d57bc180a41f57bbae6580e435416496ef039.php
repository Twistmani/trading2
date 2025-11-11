

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
                Dashboard Settings
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-shield"></i> Settings
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard Settings</a>
                </li>
                
            </ol>
			
        </section>
		
        <section class="content">
            <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-info">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left m-t-6">
                            <i class="fa fa-fw fa-list-alt"></i> Dashboard Settings
                        </h3>
                        
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
							<div class="pull-right">
								<a href="<?php echo e(url('dashboard/get_advsettings')); ?>" class="btn btn-warning"><i class="fa fa-fw fa-refresh"></i> Refresh</a>
								
								<button type="button" class="btn btn-primary btn-add-row" >
									<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add more
								 </button>
							 </div>
								<input type="hidden" id="rid" name="rid" value=""/>
                                <table class="table table-striped" id="formTable">
                                    <thead>
                                    <tr>
										<th>Field Name</th>
									    <th>Save</th>
										<th>Delete</th>
										
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($dbdetails as $row): ?>
                                    <tr>
                                     
                                    <td>
											<select class="form-control select2 selview" style="width:100%" name="file_name">
												<option value="">Select Template...</option>
                                                <?php foreach($dashboard as $db): ?>
												<?php $chkd = ($row->code== $db->code)?'selected':'';	?>
												<option value="<?php echo e($db->code); ?>" <?php echo e($chkd); ?>><?php echo e($db->name); ?></option>
												<?php endforeach; ?>
												
											</select>
                                            
										</td>
										
									
										<td><button class="btn btn-primary btn-xs save"><i class="fa fa-fw fa-floppy-o"></i></button>
										</td>
										<td class="del"> <button class="btn btn-danger btn-xs delete">
											<span class="glyphicon glyphicon-trash"></span></button>
										</td>
                                        <td>
											<input type="hidden" class="id" name="id" value="<?php echo e($row->id); ?>"/>
										</td>
										
                                    </tr>
									<?php endforeach; ?>
                                   
                                    </tbody>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>
<!-- end of page level js -->
<script>

$(document).on('click', '.btn-add-row', function(e) 
{ 
   e.preventDefault();
   var table = $('#formTable');
   var clonedRow = $('tbody tr:first').clone();
   clonedRow.find('input').val('');
   clonedRow.find('.del').html('<button class="btn btn-danger btn-xs delete"><span class="glyphicon glyphicon-trash"></span></button>');
   //clonedRow.find('.opt').html('<input type="radio" id="dflt_" name="is_default"/>');
   //newEntry.find($('input[name="item_code[]"]')).attr('id', 'itmcod_' + rowNum);
   table.append(clonedRow);
       
});

$(document).on('click', '.save', function(e)  {
   
    var file = $(this).closest("tr").find(".selview option:selected").val(); console.log('nm '+file); 
    //var pos = $(this).closest("tr").find(".selposition option:selected").val();
     
	 var id = $(this).closest("tr").find(".id").val();
	console.log(id);
	$.ajax({
		url: "<?php echo e(url('dashboard/advsetting_update/')); ?>",
		type: 'get',
		data: 'file='+file+'&id='+id,
		success: function(data) {
			alert('Format has been updated successfully.')
			
			return true;
		}
	})
	
});

$(document).on('click', '.delete', function(e)  { 
  e.preventDefault();
  var con = confirm('Are you sure delete this ?');
	if(con==true) {
		var id = $(this).closest("tr").find(".id").val(); console.log('opt '+id); 
		$.ajax({
			url: "<?php echo e(url('dashboard/advsetting_delete/')); ?>/"+id,
			type: 'get',
			//data: 'id='+id,
			success: function(data) {
				alert('Format has been deleted successfully.')
				return true;
			}
		})
		$(this).closest('tr').remove();
	}
});



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>