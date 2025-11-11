

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
		<link href="<?php echo e(asset('assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/vendors/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo e(asset('assets/vendors/select2/css/select2-bootstrap.css')); ?>" rel="stylesheet" type="text/css">
	
	<link href="<?php echo e(asset('assets/vendors/daterangepicker/css/daterangepicker.css')); ?>" rel="stylesheet" type="text/css"/>
	<link href="<?php echo e(asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css')); ?>" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datedropper/datedropper.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/jquerydaterangepicker/css/daterangepicker.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/clockpicker/css/bootstrap-clockpicker.min.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                System Parameters
            </h1>
            <ol class="breadcrumb">
                <li>
                      <i class="fa fa-fw fa-shield"></i> Administration
                </li>
				<li>
                    <a href="#">System Parameters</a>
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
					<ul class="nav  nav-tabs ">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab">Parameter1</a>
                        </li>
                        <li>
                            <a href="#tab2" data-toggle="tab">Parameter2</a>
                        </li>
                        <li>
                            <a href="#tab3" data-toggle="tab">Parameter3</a>
                        </li>
                       <li>
                            <a href="#tab4" data-toggle="tab">Parameter4</a>
                        </li>
						<!--<li>
                            <a href="#tab5" data-toggle="tab">Parameter5</a>
                        </li>-->
				</ul>
					
					<div class="tab-content m-t-10">
                        <div id="tab1" class="tab-pane fade active in">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><i class="fa fa-fw fa-crosshairs"></i>Parameter1</h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" role="form" method="POST" name="frmParameter1" id="frmParameter1" action="<?php echo e(url('sysparameter/para1_update/'.$parameter1->id)); ?>">
											<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
											<input type="hidden" name="id" value="<?php echo e($parameter1->id); ?>">
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Accounting Period</label>
												<div class="col-sm-8">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-fw fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" id="acc_period" name="acc_period" value="<?php echo e(date('d-m-Y', strtotime($parameter1->from_date)).' to '.date('d-m-Y', strtotime($parameter1->to_date))); ?>" placeholder="DD-MM-YYYY to DD-MM-YYYY"/>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Item Class</label>
												<div class="col-sm-8">
													<select id="item_class" class="form-control select2" style="width:100%" name="item_class">
														<?php if($parameter1->item_class==1): ?>
														<?php /**/ $sel1 = "selected";
																$sel2="";
														/**/ ?>
														<?php else: ?>
														<?php /**/ $sel2 = "selected";
															$sel1="";
														/**/ ?>	
														<?php endif; ?>
														<option value="1" <?php echo e($sel1); ?>>Stock</option>
														<option value="2" <?php echo e($sel2); ?>>Service</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Basic Currency</label>
												<div class="col-sm-8">
													<select id="bcurrency_id" class="form-control select2" style="width:100%" name="bcurrency_id">
														<?php foreach($currency as $curr): ?>
														<?php if($parameter1->bcurrency_id==$curr['id']): ?>
														<?php /**/ $sel = "selected" /**/ ?>
														<?php else: ?>
														<?php /**/ $sel = "" /**/ ?>	
														<?php endif; ?>
														<option value="<?php echo e($curr['id']); ?>" <?php echo e($sel); ?>><?php echo e($curr['name']); ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">No. of Decimal Places</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="bdecimal_place" name="bdecimal_place" placeholder="No. of Decimal Places" value="<?php echo e($parameter1->bdecimal_place); ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Foregin Currency(FC)</label>
												<div class="col-sm-8">
													<select id="fcurrency_id" class="form-control select2" style="width:100%" name="fcurrency_id">
														<option value="">Select Currency...</option>
														<?php foreach($currency as $curr): ?>
														<?php if($parameter1->fcurrency_id==$curr['id']): ?>
														<?php /**/ $sel = "selected" /**/ ?>
														<?php else: ?>
														<?php /**/ $sel = "" /**/ ?>	
														<?php endif; ?>
														<option value="<?php echo e($curr['id']); ?>" <?php echo e($sel); ?>><?php echo e($curr['name']); ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">No. of FC Decimal Places</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="fdecimal_place" name="fdecimal_place" placeholder="No. of FC Decimal Places" value="<?php echo e($parameter1->fdecimal_place); ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Warns Days Before(Doc)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="doc_warndays" name="doc_warndays" placeholder="Warns Days Before(Doc)" value="<?php echo e($parameter1->doc_warndays); ?>">
												</div>
											</div>
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Warns Days Before(PDC)</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="pdc_warndays" name="pdc_warndays" placeholder="Warns Days Before(PDC)" value="<?php echo e($parameter1->pdc_warndays); ?>">
												</div>
											</div>

											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Special Password</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" id="special_pswd" name="special_pswd" value="<?php echo e($parameter1->special_pswd); ?>">
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Costing Method</label>
												<div class="col-sm-8">
													<?php if($parameter1->cost_method==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = ""; $chk3 = "";
													/**/ ?>
													<?php elseif($parameter1->cost_method==2): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = ""; $chk3 = "";
													/**/ ?>	
													<?php elseif($parameter1->cost_method==3): ?>
													<?php /**/ $chk3 = "checked";
														   $chk2 = ""; $chk1 = "";
													/**/ ?>
													<?php endif; ?>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio1" name="cost_method" value="1" <?php echo e($chk1); ?>>
														FIFO
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio2" name="cost_method" value="2" <?php echo e($chk2); ?>>
														Weighted Avg.
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio3" name="cost_method" value="3" <?php echo e($chk3); ?>>
														LIFO
													</label>
													<label class="radio-inline iradio">
														<?php if($parameter1->is_refresh==1): ?>
														<?php /**/ $chk = "checked";
														/**/ ?>
														<?php else: ?>
														<?php /**/ $chk = "";
														/**/ ?>
														<?php endif; ?>
														&nbsp;&nbsp; <input type="checkbox" class="custom_icheck" id="terms" name="is_refresh" value="1" <?php echo e($chk); ?>>
														Refresh after Purchase/Sale
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">VAT Entry</label>
												<div class="col-sm-8">
													<?php if($parameter1->vat_entry==0): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = ""; $chk3 = "";
													/**/ ?>
													<?php elseif($parameter1->vat_entry==1): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = ""; $chk3 = "";
													/**/ ?>	
													<?php elseif($parameter1->vat_entry==2): ?>
													<?php /**/ $chk3 = "checked";
														   $chk2 = ""; $chk1 = "";
													/**/ ?>
													<?php endif; ?>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio1" name="vat_entry" value="0" <?php echo e($chk1); ?>>
														None
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio2" name="vat_entry" value="1" <?php echo e($chk2); ?>>
														Item wise
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio3" name="vat_entry" value="2" <?php echo e($chk3); ?>>
														Total Amount
													</label>
													
													<label class="radio-inline iradio">
														&nbsp;&nbsp; <input type="number" step="any"  id="vat_value" name="vat_value" value="<?php echo e($parameter1->vat_value); ?>"> %
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Credit Limit</label>
												<?php if($parameter1->credit_limit==0): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = ""; $chk3 = "";
													/**/ ?>
													<?php elseif($parameter1->credit_limit==1): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = ""; $chk3 = "";
													/**/ ?>	
													<?php elseif($parameter1->credit_limit==2): ?>
													<?php /**/ $chk3 = "checked";
														   $chk2 = ""; $chk1 = "";
													/**/ ?>
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio1" name="credit_limit" value="0" <?php echo e($chk1); ?>>
														None
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio2" name="credit_limit" value="1" <?php echo e($chk2); ?>>
														With PDC
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio3" name="credit_limit" value="2" <?php echo e($chk3); ?>>
														Without PDC
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Item Profit</label>
												<div class="col-sm-8">
													<?php if($parameter1->item_profit==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = ""; 
													/**/ ?>
													<?php elseif($parameter1->item_profit==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
													
													<?php endif; ?>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio1" name="item_profit" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio2" name="item_profit" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
													
													<label class="radio-inline iradio">
														&nbsp; Profit%:<input type="number" step="any"  id="profit_per" name="profit_per" value="<?php echo e($parameter1->profit_per); ?>">
													</label>
													<label class="radio-inline iradio">
														&nbsp; Cost Type:<select name="cost_type" id="cost_type"><option value="costavg" <?php echo ($parameter1->cost_type=='costavg')?'selected':'';?>>Cost Avg.</option><option value="purcost" <?php echo ($parameter1->cost_type=='purcost')?'selected':'';?>>Purchase Cost</option></select>
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Item Quantity Check</label>
												<?php if($parameter1->item_quantity==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->item_quantity==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio1" name="item_quantity" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradio2" name="item_quantity" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Document Approval</label>
												<?php if($parameter1->doc_approve==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->doc_approve==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="doc_approve" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="doc_approve" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Daily Entry</label>
												<?php if($parameter1->trip_entry==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->trip_entry==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="trip_entry" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="trip_entry" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											


											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Vehicle Details Dashboard</label>
												<?php if($parameter1->vehicle_dashboard==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->vehicle_dashboard==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="vehicle_dashboard" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="vehicle_dashboard" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>



											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Advanced Dashboard</label>
												<?php if($parameter1->adcd_dashboard==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->adcd_dashboard==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="adcd_dashboard" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="adcd_dashboard" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>

											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">PDC Alert</label>
												<?php if($parameter1->pdc_alert==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->pdc_alert==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="pdc_alert" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioDc" name="pdc_alert" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">Advanced Workshop</label>
												<?php if($parameter1->advanced_workshop==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->advanced_workshop==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="advanced_workshop" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="advanced_workshop" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">PI VAT Inclusive</label>
												<?php if($parameter1->pi_vat_inc==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->pi_vat_inc==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="pi_vat_inc" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="pi_vat_inc" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">SI VAT Inclusive</label>
												<?php if($parameter1->si_vat_inc==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->si_vat_inc==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="si_vat_inc" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="si_vat_inc" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>

											<div class="form-group">
												<label for="input-text" class="col-sm-3 control-label">PV Approval System</label>
												<?php if($parameter1->pv_approval==1): ?>
													<?php /**/ $chk1 = "checked";
														   $chk2 = "";
													/**/ ?>
													<?php elseif($parameter1->pv_approval==0): ?>
													<?php /**/ $chk2 = "checked";
														   $chk1 = "";
													/**/ ?>	
												<?php endif; ?>
												<div class="col-sm-8">
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="pv_approval" value="1" <?php echo e($chk1); ?>>
														Enable
													</label>
													<label class="radio-inline iradio">
														<input type="radio" id="inlineradioWs" name="pv_approval" value="0" <?php echo e($chk2); ?>>
														Disable
													</label>
												</div>
											</div>
											
											 <div class="form-group">
												<label for="input-text" class="col-sm-3 control-label"></label>
												<div class="col-sm-8">
													<button type="submit" class="btn btn-primary">Submit</button>
													 <a href="<?php echo e(url('sysparameter')); ?>" class="btn btn-danger">Cancel</a>
												</div>
											</div>
										   
										</form>
									</div>
								</div>
							</div>
						</div>
						</div>
						<div id="tab2" class="tab-pane fade">
							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title"><i class="fa fa-fw fa-crosshairs"></i>Parameter2</h3>
									</div>
									<div class="panel-body">
										<form class="form-horizontal" role="form" method="POST" name="frmParameter2" id="frmParameter2" action="<?php echo e(url('sysparameter/para2_update/')); ?>">
											<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
											<?php foreach($parameter2 as $para): ?>
											<?php if($para->is_active==1): ?>
													<?php /**/ $chk = "checked";
													/**/ ?>
													<?php else: ?>
													<?php /**/ $chk = "";
													/**/ ?>	
											<?php endif; ?>
											<div class="form-group">
												<label for="input-text" class="col-sm-6 control-label"><?php echo e($para->name); ?></label>
												<div class="col-sm-3">
													<label class="radio-inline iradio">
														<input type="checkbox" class="custom_icheck" id="para_name" name="para_name[<?php echo e($para->id); ?>]" <?php echo e($chk); ?>> 
													</label>
												</div>
											</div>
											<?php endforeach; ?>
											 <div class="form-group">
												<label for="input-text" class="col-sm-5 control-label"></label>
												<div class="col-sm-4">
													<button type="submit" class="btn btn-primary">Submit</button>
													 <a href="<?php echo e(url('sysparameter')); ?>" class="btn btn-danger">Cancel</a>
												</div>
											</div>
										   
										</form>
									</div>
								</div>
							</div>
						</div>
						</div>
						
						<div id="tab3" class="tab-pane fade">
							<div class="panel-body">
								<form class="form-horizontal" role="form" method="POST" name="frmParameter3" id="frmParameter3" action="<?php echo e(url('sysparameter/para3_update')); ?>">
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<h4>Location Account Master</h4>
									<?php foreach($locations as $loc): ?>
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label"><?php echo e($loc->code.'-'.$loc->name); ?></label>
										<input type="hidden" name="location[]" value="<?php echo e($loc->id); ?>">
										<div class="col-sm-8">
											<select class="form-control select2" style="width:100%" name="account[]">
												<option value="">Select Location Account...</option>
												<?php foreach($accounts as $acc): ?>
												<?php 
													$chkd = ($parameter4[$loc->id] == $acc['id'])?'selected':'';
												?>
												<option value="<?php echo e($acc['id']); ?>" <?php echo e($chkd); ?>><?php echo e($acc['master_name']); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
									<?php endforeach; ?>
									<hr/>

									<h4>Default Location</h4>
									<input type="hidden" name="dftlocid" value="<?php echo e($dftloc->id); ?>">
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Purchase</label>
										<div class="col-sm-8">
											<select class="form-control select2" style="width:100%" name="loc_purchase">
												<option value="">Select Location</option>
												<?php foreach($alllocations as $locall): ?>
												<?php 
													$chkd = ($dftloc->pur_loc == $locall->id)?'selected':'';
												?>
												<option value="<?php echo e($locall->id); ?>" <?php echo e($chkd); ?>><?php echo e($locall->name); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Sales</label>
										<div class="col-sm-8">
											<select class="form-control select2" style="width:100%" name="loc_sales">
												<option value="">Select Location</option>
												<?php foreach($alllocations as $locall): ?>
												<?php 
													$chkd = ($dftloc->sales_loc == $locall->id)?'selected':'';
												?>
												<option value="<?php echo e($locall->id); ?>" <?php echo e($chkd); ?>><?php echo e($locall->name); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Manufacture</label>
										<div class="col-sm-8">
											<select class="form-control select2" style="width:100%" name="loc_mfg">
												<option value="">Select Location</option>
												<?php foreach($alllocations as $locall): ?>
												<?php 
													$chkd = ($dftloc->mfg_loc == $locall->id)?'selected':'';
												?>
												<option value="<?php echo e($locall->id); ?>" <?php echo e($chkd); ?>><?php echo e($locall->name); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>

									<br/>

									<div class="form-group">
										<label for="input-text" class="col-sm-5 control-label"></label>
										<div class="col-sm-4">
											<button type="submit" class="btn btn-primary">Submit</button>
											 <a href="<?php echo e(url('sysparameter')); ?>" class="btn btn-danger">Cancel</a>
										</div>
									</div>
								</form>
							</div>
						</div>
						
						<div id="tab4" class="tab-pane fade">
							<div class="panel-body">
										<form class="form-horizontal" role="form" method="POST" name="frmParameter4" id="frmParameter4" action="<?php echo e(url('sysparameter/para4_update/'.$parameter4->id)); ?>">
											<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
											<input type="hidden" name="id" value="<?php echo e($parameter4->id); ?>">
											<div class="form-group">
												<div class="form-group">
														<label for="input-text" class="col-sm-3 control-label">Payroll by: </label>
														<?php if($parameter4->payroll_by==1): ?>
																<?php /**/ $chk = "checked";
																/**/ ?>
																<?php else: ?>
																<?php /**/ $chk2 = "checked";
																/**/ ?>	
														<?php endif; ?>
														<div class="col-sm-8">
															<label class="radio-inline iradio">
																<input type="radio" id="inlineradio2" name="payroll_by" value="1" <?php echo e($chk1); ?>>
																Monthly
															</label>
															<label class="radio-inline iradio">
																<input type="radio" id="inlineradio3" name="payroll_by" value="30" <?php echo e($chk2); ?>>
																30 Days
															</label>
														</div>
													</div>
													<div class="form-group">
									<label for="input-text" class="col-sm-3 control-label">Holiday</label>
										<?php
															$para = explode(',',$parameter4->holiday);
														?>
									<div class="col-sm-8">
										<select class="form-control select2" name="holiday[]" multiple id="select21" />
										<?php
															$para = explode(',',$parameter4->holiday);
															
														foreach($para as $row)
														{
														?>
														
											
										<option value="">Select Holiday</option>
								             	       <option value="Sun" <?php if($row =='Sun'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?> >Sunday</option>
														<option value="Mon" <?php if($row=='Mon'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?> >Monday</option>
														<option value="Tue" <?php if($row=='Tue'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?>  >Tuesday</option>
														<option value="Wed" <?php if($row=='Wed'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?> >Wednesday</option>
														<option value="Thu" <?php if($row=='Thu'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?>  >Thursday</option>
														<option value="Fri" <?php if($row=='Fri'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?> >Friday</option>
														<option value="Sat" <?php if($row=='Sat'): ?> <?php echo e('selected'); ?> <?php else: ?> <?php echo e(''); ?> <?php endif; ?> >Satarday</option>
														
														
														
															<?php
															}
															
															?>
										</select>
									</div>
									
								</div>
													<div class="form-group">
														<label for="input-text" class="col-sm-3 control-label">Normal Working Hrs.</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="nwh" name="nwh" placeholder="Normal Working Hrs." value="<?php echo e($parameter4->nwh); ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label for="input-text" class="col-sm-3 control-label">OT Rate(General)(%)</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="ot_general" name="ot_general" placeholder="OT Rate(General)" value="<?php echo e($parameter4->ot_general); ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label for="input-text" class="col-sm-3 control-label">OT Rate(Holiday)(%)</label>
														<div class="col-sm-8">
															<input type="text" class="form-control" id="ot_holiday" name="ot_holiday" placeholder="OT Rate(Holiday)" value="<?php echo e($parameter4->ot_holiday); ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label for="input-text" class="col-sm-3 control-label">OT Calculation </label>
														<?php
															$para = explode(',',$parameter4->ot_calculation);
														?>
														<div class="col-sm-8">
															<label class="radio-inline iradio">
																<input type="checkbox" class="custom_icheck" id="ot_calculation" name="ot_calculation[]" value="1" <?php if(in_array(1,$para)) echo 'checked';?>> 
																Basic
															</label>
															<label class="radio-inline iradio">
																<input type="checkbox" class="custom_icheck" id="ot_calculation" name="ot_calculation[]" value="2" <?php if(in_array(2,$para)) echo 'checked';?>> 
																HRA
															</label>
														</div>
													</div>
													
													<div class="form-group">
												<label for="input-text" class="col-sm-5 control-label"></label>
												<div class="col-sm-4">
													<button type="submit" class="btn btn-primary">Submit</button>
													 <a href="<?php echo e(url('sysparameter')); ?>" class="btn btn-danger">Cancel</a>
												</div>
											</div>
											</div>
										</form>
							</div>
						</div>
						
												
						
						<div id="tab4" class="tab-pane fade">
							Parameter4
						</div>
					</div>
				</div>
			</div>
			
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

<!-- date-range-picker -->
<script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/jquery.inputmask.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.date.extensions.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/inputmask/inputmask/inputmask.extensions.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(asset('assets/vendors/daterangepicker/js/daterangepicker.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/jquerydaterangepicker/js/jquery.daterangepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datedropper/datedropper.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/timedropper/js/timedropper.js')); ?>" type="text/javascript"></script>
<!--<script src="<?php echo e(asset('assets/js/custom_js/datepickers.js')); ?>" type="text/javascript"></script>-->
<script src="<?php echo e(asset('assets/vendors/select2/js/select2.js')); ?>" type="text/javascript"></script>

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
<!-- bootstrap time picker -->


<script>
"use strict";

$(document).ready(function () {
	$("#select21").select2({
        theme: "bootstrap",
        placeholder: "Holiday"
    });

});

$(document).ready(function () {
	
    $('#frmParameter1').bootstrapValidator({
        fields: {
            acc_period: {
                validators: {
                    notEmpty: {
                        message: 'The accounting periode is required and cannot be empty!'
                    }
                }
            },
			bcurrency_id: {
                validators: {
                    notEmpty: {
                        message: 'The basic currency is required and cannot be empty!'
                    }
                }
            },
			bdecimal_place: {
                validators: {
                    notEmpty: {
                        message: 'The no. of decimal places is required and cannot be empty!'
                    }
                }
            }
          
        }
       
    }).on('reset', function (event) {
        $('#frmParameter1').data('bootstrapValidator').resetForm();
    });
	
});
	

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>