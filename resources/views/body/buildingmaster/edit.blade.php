@extends('layouts/default')

    {{-- Page title --}}
    @section('title')
         
        @parent
    @stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css -->
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/bootstrap-fileinput/css/fileinput.min.css')}}" media="all" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/formelements.css')}}">
        <!--end of page level css-->
	
	<link rel="stylesheet" href="{{asset('assets/vendors/datetime/css/jquery.datetimepicker.css')}}">
    <link href="{{asset('assets/vendors/airdatepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datepicker.css')}}">
	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/buttons.bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/colReorder.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatables/css/scroller.bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/css/custom_css/responsive_datatables.css')}}">
	<style>
		input[type=number]::-webkit-inner-spin-button, 
		input[type=number]::-webkit-outer-spin-button { 
		  -webkit-appearance: none; 
		  margin: 0; 
		}
	</style>
@stop

{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
              Building Master
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                       <i class="fa fa-fw fa-building-o"></i> RealEstate
                    </a>
                </li>
                <li>
                    <a href="#">Building Master</a>
                </li>
                <li class="active">
                    Edit
                </li>
            </ol>
        </section>
		
		@if(Session::has('messages'))
		<div class="alert alert-success">
			<p>{{ Session::get('messages') }}</p>
		</div>
		@endif
		
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-crosshairs"></i> Edit Building 
                            </h3>
                        </div>
                        <div class="panel-body">
							<form class="form-horizontal" role="form" method="POST" name="frmSalesOrder" id="frmSalesOrder" action="{{ url('buildingmaster/update/'.$brow->id) }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Building Code</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="buildingcode" name="buildingcode" value="{{$brow->buildingcode}}" autocomplete="off" placeholder="Building Code">
										</div>
									</div>
									
									<!--<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Building Type</label>
										<div class="col-sm-9">
											<select class="form-control" name="type" id="type" />
											<option value="Flat" {{($brow->type=='Flat')?'selected':''}}>Flat</option>
											<option value="Villas" {{($brow->type=='Flat')?'selected':''}}>Villas</option>
											<option value="Shops" {{($brow->type=='Flat')?'selected':''}}>Shops</option>
											</select>
										</div>
									</div>-->
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Prefix</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="prefix" name="prefix" autocomplete="off" value="{{$brow->prefix}}" placeholder="Prefix">
										</div>
									</div>
											
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Building Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="buildingname" name="buildingname" value="{{$brow->buildingname}}" autocomplete="off" placeholder="Building Name">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Description</label>
										<div class="col-sm-9">
											<textarea class="form-control" id="description" name="description" >{{$brow->description}}</textarea>
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Owner Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="ownername" name="ownername" value="{{$brow->ownername}}" autocomplete="off" placeholder="Owner Name">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Location </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="location" name="location" value="{{$brow->location}}" autocomplete="off" placeholder="Location">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Area</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="area" name="area" autocomplete="off" value="{{$brow->area}}" placeholder="Area">
										</div>
									</div>
									
                                    <div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Contact No. </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="mobno" name="mobno" autocomplete="off" value="{{$brow->mobno}}" placeholder="Contact No.">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Security Deposit </label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="security_deposit" step="any" name="security_deposit" value="{{$brow->security_deposit}}" autocomplete="off" placeholder="Security Deposit">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Connection Charge </label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="connection_charge" step="any" name="connection_charge" value="{{$brow->connection_charge}}" autocomplete="off" placeholder="Connection Charge">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Other Charges(Connection)</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="other_charge_con" step="any" name="other_charge_con" value="{{$brow->other_charge_con}}" autocomplete="off" placeholder="Other Charges(Connection)">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Unit Price </label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="unit_price" step="any" name="unit_price" autocomplete="off" value="{{$brow->unit_price}}" placeholder="Unit Price">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Other Charges(Reading)</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="other_charge" step="any" name="other_charge" value="{{$brow->other_charge}}" autocomplete="off" placeholder="Other Charges">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Disconnection Charge </label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="disconnection_charge" step="any" name="disconnection_charge" value="{{$brow->disconnection_charge}}" autocomplete="off" placeholder="Disconnection Charge">
										</div>
									</div>
									
									<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label">Other Charges(Disconnection)</label>
										<div class="col-sm-9">
											<input type="number" class="form-control" id="other_charge_dis" step="any" name="other_charge_dis" value="{{$brow->other_charge_dis}}" autocomplete="off" placeholder="Other Charges(Disconnection)">
										</div>
									</div>
								
							
								<div class="form-group">
									<label for="input-text" class="col-sm-3 control-label">Document</label>
									<div class="col-sm-9">
									<?php if($photos!='') { $arrp = explode(',',$photos); $i=1; ?>
										@foreach($arrp as $prow)
										<div class="file-preview">
											<div class="close fileinput-remove removeP" data-val="{{$prow}}">×</div>
											<div class="file-drop-disabled">
												<div class="file-preview-thumbnails">
													<div class="file-live-thumbs">
														<a href="{{asset('uploads/joborder/'.$prow)}}" target="_blank">View Image {{$i}}</a>
													</div>
												</div>
												<div class="clearfix"></div>    <div class="file-preview-status text-center text-success"></div>
												<div class="kv-fileinput-error file-error-message" style="display: none;"></div>
											</div>
										</div>
										<?php $i++; ?>
										@endforeach
									<?php } ?>
										<input type="file" id="input-23" name="photos" class="file-loading" data-show-preview="true" data-url="{{url('job_order/upload/')}}" multiple="">
										<div id="files_list"></div>
										<p id="loading"></p>
										<input type="hidden" name="photo_name" id="photo_name" value="{{$photos}}">
										<input type="hidden" name="old_photo_name" id="old_photo_name" value="{{$photos}}">
										<input type="hidden" name="rem_photo_name" id="rem_photo_name">
									</div>
								</div>
											
							
								
							
								
								
								
								
								
							
                       
					
							
                           
								<div class="form-group">
										<label for="input-text" class="col-sm-3 control-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Submit</button>
											 <a href="{{ url('buildingmaster') }}" class="btn btn-danger">Cancel</a>
										</div>
									</div>
							
						
							
						
							
					 
							
                            </form>
							</div>
                        </div>
                    </div>
                </div>
            </div>
       
            <!--main content-->
            <!-- row -->
        @include('layouts.right_sidebar')
        <!-- right side bar end -->
        </section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- begining of page level js -->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/iCheck/js/icheck.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/custom_js/form_elements.js')}}"></script>

        <!-- end of page level js -->
<script src="{{asset('assets/vendors/moment/js/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/vendors/airdatepicker/js/datepicker.en.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/custom_js/advanceddate_pickers.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.rowReorder.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.colVis.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.html5.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/buttons.print.js') }}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/datatables/js/dataTables.scroller.js')}}"></script>
<script src="{{asset('assets/vendors/mark.js/jquery.mark.js')}}" charset="UTF-8"></script>
<script src="{{asset('assets/vendors/datatablesmark.js/js/datatables.mark.min.js')}}" charset="UTF-8"></script>
<script src="{{asset('assets/js/custom_js/responsive_datatables.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.fileupload.js')}}"></script>


<script>
"use strict";

 $(document).ready(function () {
 	//var urlcode = "{{ url('buildingmaster/checkcode/') }}";
     $('#frmSalesOrder').bootstrapValidator({
         fields: {
 			buildingcode: {
                 validators: {
                     notEmpty: {
                         message: 'Building code is required and cannot be empty!'
                     },
					 /* remote: { url: urlcode,
							   data: function(validator) {
								return { buildingcode: validator.getFieldElements('buildingcode').val() };
							  },
							  message: 'Building code is not available'
                    } */
                 }
             },
 			type: {
                 validators: {
                     notEmpty: {
                         message: 'Type is required and cannot be empty!'
                     }
                 }
             },
 			buildingname: {
                 validators: {
                     notEmpty: {
                        message: 'Building name is required and cannot be empty!'
                     }
                 }
             }
         }
        
     }).on('reset', function (event) {
         $('#frmSalesOrder').data('bootstrapValidator').resetForm();
     });
});

$(function() {	

	 $('#input-23').fileupload({
		dataType: 'json',
		add: function (e, data) {
			$('#loading').text('Uploading...');
			data.submit();
		},
		done: function (e, data) {
			var pn = $('#photo_name').val();
			$('#photo_name').val( (pn=='')?data.result.file_name:pn+','+data.result.file_name );
			$('#loading').text('Completed.');
		}
	});
	

	$(document).on('click', '.removeP', function(e) {  
		var con = confirm('Are you sure to remove this image?');
		if(con) {
			var fnames = $('#photo_name').val().replace($(this).attr("data-val"),'');
			$('#photo_name').val(fnames);
			
			var rp = $('#rem_photo_name').val();
			$('#rem_photo_name').val( (rp=='')?$(this).attr("data-val"):rp+','+$(this).attr("data-val") );
			
			$(this).parents('.file-preview').remove();
		}
	});
		
});

		
	

</script>
@stop
