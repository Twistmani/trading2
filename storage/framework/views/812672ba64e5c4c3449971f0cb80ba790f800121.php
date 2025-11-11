

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
                Employee
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index">
                        <i class="glyphicon glyphicon-tower"></i>  HR Management
                    </a>
                </li>
                <li>
                    <a href="#">Employee</a>
                </li>
                <li class="active">
                   View
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
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-book"></i> Employee Details
                            </h3>
                        </div>
                        <div class="panel-body">
						
							<ul class="nav  nav-tabs ">
								<li class="active">
									<a href="#tab1" data-toggle="tab">Personal Details</a>
								</li>
								<li>
									<a href="#tab2" data-toggle="tab">Employment Details</a>
								</li>
								<li>
									<a href="#tab3" data-toggle="tab">Salary Details</a>
								</li>
							   <li>
									<a href="#tab4" data-toggle="tab">Other Details</a>
								</li>
							</ul>
							
							<div class="tab-content m-t-10">
							<div id="tab1" class="tab-pane fade active in">
                            <table class="table table-bordered table-striped m-t-10">
                                <tbody>
								<?php  $department=$division=''; ?>
                                <?php foreach($departments as $drow): ?>
                                	<?php if (($drow->id)==($masterrow->department_id)) 
                                	$department=$drow->name;
                                	 ?>
                                 <?php endforeach; ?>
                                <tr>
                                    <td width="30%">Department</td>  <td > <?php echo e($department); ?></td>
                                </tr>
                                <tr>
                                    <td width="30%">Employee ID</td>  <td > <?php echo e($masterrow->code); ?></td>
                                </tr>
                                <tr>
                                    <td>Employee Name</td> <td> <?php echo e($masterrow->name); ?></td>
                                </tr>
                                <tr>
                                    <td>Designation</td> <td><?php echo e($masterrow->designation); ?> </td>
                                </tr>

                                <?php foreach($divisions as $drow): ?>
                                	<?php if (($drow->id)==($masterrow->division_id)) 
                                	$division=$drow->div_name;
                                	 ?>
                                 <?php endforeach; ?>

                                <tr>
                                    <td>Division</td> <td><?php echo e($division); ?></td>
                                </tr>
                                <tr>
                                    <td>Nationality</td> <td><?php echo e($masterrow->nationality); ?> </td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td> <td> <?php echo e(($masterrow->dob=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->dob))); ?> </td>
                                </tr>
                                <tr>
                                    <td>Gender</td> <td> <?php echo e(($masterrow->gender==1)?'Male':'Female'); ?></td>
                                </tr>
                                <tr>
                                    <td>Residance Address</td> <td> <?php echo e($masterrow->address1); ?></td>
                                </tr>
								<tr>
                                    <td>Residance Phone No</td> <td><?php echo e($masterrow->phone); ?> </td>
                                </tr>
                                <tr>
                                    <td>Home Address</td> <td> <?php echo e($masterrow->address2); ?> </td>
                                </tr>
								<tr>
                                    <td>Home Phone No</td> <td><?php echo e($masterrow->phone2); ?> </td>
                                </tr>
                                <tr>
                                    <td>Email</td> <td> <?php echo e($masterrow->email); ?> </td>
                                </tr>
								<tr>
                                    <td>Join Date</td> <td><?php echo e(($masterrow->join_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->join_date))); ?> </td>
                                </tr>
								<tr>
                                    <td>Rejoin Date</td> <td><?php echo e(($masterrow->rejoin_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->rejoin_date))); ?> </td>
                                </tr>
								<tr>
                                    <td>Duty Status</td> <td><?php if($masterrow->duty_status==0) echo 'on Leave'; 
									else if($masterrow->duty_status==1) echo 'on Duty'; else echo 'Resigned/Terminated'; ?></td>
                                </tr>
								<tr>
                                    <td>Photo</td> <td> 
									<?php if(isset($photos['PF']) && count($photos['PF'])>0) { $i=1; ?>View
									<?php foreach($photos['PF'] as $prow): ?>
									<a href="<?php echo e(asset('uploads/employee/'.$prow->photo)); ?>" target="_blank">Photo <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<!--<img src="<?php echo e(asset('uploads/employee/'.$masterrow->photo)); ?>" style="max-height:150px;"/>-->
									<?php } ?>
									</td>
                                </tr>
                            </table>
							</div>
							
							<div id="tab2" class="tab-pane fade">
								<table class="table table-bordered table-striped m-t-10">
								<tr>
                                    <td width="30%">Passport ID</td> <td><?php echo e($masterrow->pp_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->pp_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->pp_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->pp_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->pp_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Issued Place</td> <td><?php echo e($masterrow->pp_issue_place); ?></td>
                                </tr>
								<tr>
                                    <td>Passport Image</td> <td> 
									<?php if(isset($photos['PSP']) && count($photos['PSP'])>0) { $i=1; ?>View
									<?php foreach($photos['PSP'] as $psrow): ?>
									<a href="<?php echo e(asset('uploads/passport/'.$psrow->photo)); ?>" target="_blank">Passport Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
								
								<tr>
                                    <td>Visa Designation</td> <td><?php echo e($masterrow->v_designation); ?></td>
                                </tr>
								<tr>
                                    <td>Visa ID</td> <td><?php echo e($masterrow->v_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->v_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->v_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->v_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->v_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Visa Image</td> <td> 
									<?php if(isset($photos['VS']) && count($photos['VS'])>0) { $i=1; ?>View
									<?php foreach($photos['VS'] as $vrow): ?>
									<a href="<?php echo e(asset('uploads/visa/'.$vrow->photo)); ?>" target="_blank">Visa Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
								
								<tr>
                                    <td>Labour Card ID</td> <td><?php echo e($masterrow->lc_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->lc_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->lc_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->lc_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->lc_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Labour Card Image</td> <td> 
									<?php if(isset($photos['LB']) && count($photos['LB'])>0) { $i=1; ?>View
									<?php foreach($photos['LB'] as $lrow): ?>
									<a href="<?php echo e(asset('uploads/labour/'.$lrow->photo)); ?>" target="_blank">Labour Card Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
								
								<tr>
                                    <td>Health Card ID</td> <td><?php echo e($masterrow->hc_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->hc_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->hc_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->hc_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->hc_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Health Card Info</td> <td><?php echo e($masterrow->hc_info); ?></td>
                                </tr>
								<tr>
                                    <td>Health Card Image</td> <td> 
									<?php if(isset($photos['HL']) && count($photos['HL'])>0) { $i=1; ?>View
									<?php foreach($photos['HL'] as $hrow): ?>
									<a href="<?php echo e(asset('uploads/health/'.$hrow->photo)); ?>" target="_blank">Health Card Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
								
								<tr>
                                    <td>ID Card</td> <td><?php echo e($masterrow->ic_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->ic_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->ic_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->ic_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->ic_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>ID Card Image</td> <td> 
									<?php if(isset($photos['IDC']) && count($photos['IDC'])>0) { $i=1; ?>View
									<?php foreach($photos['IDC'] as $hrow): ?>
									<a href="<?php echo e(asset('uploads/idcard/'.$hrow->photo)); ?>" target="_blank">ID Card Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
								
								<tr>
                                    <td>Medical Exam ID</td> <td><?php echo e($masterrow->me_id); ?></td>
                                </tr>
								<tr>
                                    <td>Issue Date</td> <td><?php echo e(($masterrow->me_issue_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->me_issue_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Expiry Date</td> <td><?php echo e(($masterrow->me_expiry_date=='0000-00-00')?'':date('d-m-Y', strtotime($masterrow->me_expiry_date))); ?></td>
                                </tr>
								<tr>
                                    <td>Image</td> <td> 
									<?php if(isset($photos['MD']) && count($photos['MD'])>0) { $i=1; ?>View
									<?php foreach($photos['MD'] as $hrow): ?>
									<a href="<?php echo e(asset('uploads/medical/'.$hrow->photo)); ?>" target="_blank">Medical Exam Image <?php echo e($i); ?></a> | <?php $i++; ?>
									<?php endforeach; ?>
									<?php } ?>
									</td>
                                </tr>
                                </tbody>
							 </table>
							
							</div>
							
							<div id="tab3" class="tab-pane fade">
								<table class="table table-bordered table-striped m-t-10">
								<tr>
                                    <td width="30%">Contract Status</td> <td><?php echo ($masterrow->contract_status==1)?'Limited':'Unlimited';?></td>
                                </tr>
								<tr>
                                    <td>Basic Pay</td> <td><?php echo e(number_format($masterrow->basic_pay,2)); ?></td>
                                </tr>
								<tr>
                                    <td>HRA</td> <td><?php echo e(number_format($masterrow->hra,2)); ?></td>
                                </tr>
								<tr>
                                    <td>Transport</td> <td><?php echo e(number_format($masterrow->transport,2)); ?></td>
                                </tr>
								
								<tr>
                                    <td>Allowance1</td> <td><?php echo e(number_format($masterrow->allowance,2)); ?></td>
                                </tr>
								<tr>
                                    <td>Allowance2</td> <td><?php echo e(number_format($masterrow->allowance2,2)); ?></td>
                                </tr>
								<tr>
                                    <td>Net Salary</td> <td><?php echo e(number_format($masterrow->net_salary,2)); ?></td>
                                </tr>
								<tr>
                                    <td>Normal Workign Hr.</td> <td><?php echo e($masterrow->nwh); ?></td>
                                </tr>
								
								<tr>
                                    <td>Normal Wage by</td> <td><?php if($masterrow->nwage==30) echo '30 Days'; elseif($masterrow->nwage==365) echo '365 Days'; else 'Monthly'; ?></td>
                                </tr>
								<tr>
                                    <td>OT Wage by</td> <td><?php if($masterrow->otwage==30) echo '30 Days'; elseif($masterrow->otwage==365) echo '365 Days'; else 'Monthly'; ?></td>
                                </tr>
								<tr>
                                    <td>Leave/Month for AL</td> <td><?php echo e($masterrow->lev_per_mth); ?></td>
                                </tr>
								<tr>
                                    <td>Alloted Anual ML</td> <td><?php echo e($masterrow->anual_ml); ?></td>
                                </tr>
								<tr>
                                    <td>Air Ticket Allotment after</td> <td><?php echo e(($masterrow->air_tkt > 0)?$masterrow->air_tkt:''); ?></td>
                                </tr>
								<tr>
                                    <td>Alloted Anual CL</td> <td><?php echo e($masterrow->anual_cl); ?></td>
                                </tr>
							 </table>
							</div>
							
							<div id="tab4" class="tab-pane fade">
								<table class="table table-bordered table-striped m-t-10">
									<tr>
										<td width="30%">Remarks</td> <td><?php echo e($masterrow->remarks); ?></td>
									</tr>
									<tr>
										<td>Other Info</td> <td><?php echo e($masterrow->other_info); ?></td>
									</tr>
								</table>
							</div>
						</div>
							
							<div class="btn-section">
							<div class="col-md-12 col-sm-12 col-xs-12">
									<span class="pull-left">
									    <a href="<?php echo e(url('employee/payrise/'.$masterrow->id)); ?>" class="btn btn-responsive btn-primary">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-eject"></i>
										Pay Rise
									 </a>
									<?php if (\Entrust::can(('leave'))) : ?>
									 <a href="<?php echo e(url('employee/leave/'.$masterrow->id)); ?>" class="btn btn-responsive btn-primary">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-eject"></i>
										Leave Process
									 </a>
									 <?php endif; // Entrust::can ?>
									</span>
									
									<?php if (\Entrust::can(('rejoin'))) : ?>
									<a href="<?php echo e(url('employee/rejoin/'.$masterrow->id)); ?>" style="margin-left:10px;" class="btn btn-responsive button-alignment btn-primary">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-repeat"></i>
										Rejoin 
										</span>
									</a>
									 <?php endif; // Entrust::can ?>
									
									<?php if (\Entrust::can(('undo-rejoin'))) : ?>
									<a href="<?php echo e(url('employee/rejoin-undo/'.$masterrow->id)); ?>" style="margin-left:10px;" class="btn btn-responsive button-alignment btn-primary">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-chain-broken"></i>
										Undo Rejoin 
										</span>
									</a>
									 <?php endif; // Entrust::can ?>
									
									<?php if (\Entrust::can(('termn-resign'))) : ?>
									<a href="<?php echo e(url('employee/resign/'.$masterrow->id)); ?>" style="margin-left:10px;" class="btn btn-responsive button-alignment btn-primary">
										<span style="color:#fff;" >
											<i class="fa fa-fw fa-caret-square-o-up"></i>
										Termination/Resignation 
										</span>
									</a>
									 <?php endif; // Entrust::can ?>
									
									</span>
									<span class="pull-right">
									<a href="<?php echo e(url('employee')); ?>" class="btn btn-danger">Back</a>
									</span>
							</div>
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
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/custom_js/form_elements.js')); ?>"></script>
        <!-- end of page level js -->

<script>
"use strict";

$(document).ready(function () {
	var urlcode = "<?php echo e(url('itemmaster/checkcode/')); ?>";
	var urldesc = "<?php echo e(url('itemmaster/checkdesc/')); ?>";
    $('#frmMaster').bootstrapValidator({
        fields: {
			actype_id: { validators: { notEmpty: { message: 'The account type is required and cannot be empty!' } } },
			category_id: { validators: { notEmpty: { message: 'The category name is required and cannot be empty!' } } },
			group_id: { validators: { notEmpty: { message: 'The group name is required and cannot be empty!' } } },
			account_id: { validators: { notEmpty: { message: 'The account id is required and cannot be empty!' } } },
            master_name: { validators: { 
					notEmpty: { message: 'The account master is required and cannot be empty!' },
					/* remote: { url: urlcode,
							  data: function(validator) {
								return { item_code: validator.getFieldElements('item_code').val() };
							  },
							  message: 'The item code is not available'
                    } */
                }
            },
			op_balance: { validators: { notEmpty: { message: 'The open balance is required and cannot be empty!' } } },
          
        }
        
    }).on('reset', function (event) {
        $('#frmMaster').data('bootstrapValidator').resetForm();
    });
});

$('#actype_id').on('change', function(e){
	var type_id = e.target.value;

	$.get("<?php echo e(url('accategory/getcategory/')); ?>/" + type_id, function(data) {
		$('#category_id').empty();
		 $('#category_id').append('<option value="">Select Account Category...</option>');
		$.each(data, function(value, display){
			 $('#category_id').append('<option value="' + display.id + '">' + display.name + '</option>');
		});
	});
});

$('#category_id').on('change', function(e){
	var cat_id = e.target.value;

	$.get("<?php echo e(url('acgroup/getgroup/')); ?>/" + cat_id, function(data) {
		$('#group_id').empty();
		 $('#group_id').append('<option value="">Select Account Group...</option>');
		$.each(data, function(value, display){
			 $('#group_id').append('<option value="' + display.id + '">' + display.name + '</option>');
		});
	});
});

$('#group_id').on('change', function(e){
	var group_id = e.target.value;
	$.get("<?php echo e(url('account_master/getcode/')); ?>/" + group_id, function(data) {
		$('#account_id').val(data);
		//console.log(data);
	});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>