

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
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>"/>
        <!--end of page level css-->
	<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datetime/css/jquery.datetimepicker.css')); ?>">
    <link href="<?php echo e(asset('assets/vendors/airdatepicker/css/datepicker.min.css')); ?>" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datepicker.css')); ?>">
<?php $__env->stopSection(); ?>

<?php /* Page content */ ?>
<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                 PDC Issued
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="">
                        <i class="fa fa-fw fa-retweet"></i> Transaction
                    </a>
                </li>
                <li>
                    <a href="">Post Dated Cheque</a>
                </li>
				<li class="active">
                    PDC Issued
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
                            <i class="fa fa-fw fa-list-alt"></i> PDC Issued List
                        </h3>
                        <div class="pull-right">
                             
                        </div>
                    </div>
                    <div class="panel-body">
						<form method="POST" name="frmPdcIssued" id="frmPdcIssued" action="<?php echo e(url('pdc_issued/save')); ?>">
							<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
							<input type="hidden" name="id" id="pdcid">
							<input type="hidden" name="voucher_type" id="vtype">
							<input type="hidden" name="reference" id="ref">
							<input type="hidden" name="dr_account_id" id="drac">
							<input type="hidden" name="cr_account_id" id="crac">
							<input type="hidden" name="customer_id" id="cid">
							<input type="hidden" name="amount" id="amt">
							<input type="hidden" name="vdate" id="vdate">
							<input type="hidden" name="cname" id="cname">
						</form>
						
						<?php if(!$baccount): ?>
						<div class="alert alert-warning">
            			    <p>PDC issued credit account is not set in PDC voucher! For set this account, go to Account Settings in Administration menu and create a PDCI voucher with your credit account.</p>
            		    </div>
						<?php endif; ?>
						
                        <div class="table-responsive">
                                <table class="table horizontal_table table-striped" id="tablePDCI" border="0">
                                    <thead>
                                    <tr>
										<th></th>
										<th>Chq.Date</th>
										<th>Chq.No</th>
										<th>Amount</th>
										<th>Bank</th>
										<th>Vchr.No</th>
										<th>Type</th>
										<th>Reference</th>
										<th>Bank A/c.Cr.</th>
										<th class="no_wrap">PDC A/c.Dr.</th>
										<th>Supplier</th>
										<th>Vchr.Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php /**/ $i = 0; /**/ ?>
									<?php foreach($pdcs as $pdc): ?>
									<?php  $i++;  ?>
                                    <tr>
                                        <td>
											<input type="checkbox" name="tag[]" class="tag-line" value="<?php echo e($i); ?>">
											<input type="hidden" name="ids[]" id="id_<?php echo e($i); ?>" value="<?php echo e($pdc->id); ?>">
											<input type="hidden" name="voucher_type[]" id="vtype_<?php echo e($i); ?>" value="<?php echo e($pdc->voucher_type); ?>">
										</td>
										<td class="no_wrap"><?php echo e(($pdc->cheque_date=='0000-00-00')?'':date('d-m-Y',strtotime($pdc->cheque_date))); ?></td>
										<td><?php echo e($pdc->cheque_no); ?></td>
										<?php //$amount = ($pdc->amount < 0)?$pdc->amount*-1:$pdc->amount;?>
										<td><?php echo e(number_format($pdc->amount,2)); ?> <input type="hidden" name="amount[]" id="amt_<?php echo e($i); ?>" value="<?php echo e($pdc->amount); ?>"></td>
										<td><?php echo e($pdc->code); ?></td>
										<td><?php echo e($pdc->voucher_no); ?></td>
										<td><?php echo e($pdc->entry_type); ?></td>
										<td><input type="text" name="reference[]" id="ref_<?php echo e($i); ?>" autocomplete="off" class="form-control" style="width:8em;"></td>
										<td><input type="text" name="cr_account[]" id="draccount_<?php echo e($i); ?>" class="form-control" value="<?php echo e(isset($baccount)?$baccount->master_name:''); ?>" data-toggle="modal" data-target="#account_modal" style="width:8em;">
										<input type="hidden" name="cr_account_id[]" id="craccountid_<?php echo e($i); ?>" value="<?php echo e(isset($baccount)?$baccount->cr_account_master_id:''); ?>">
										</td>
										<td class="no_wrap"><?php echo e($pdc->creditor); ?></td>
										<td class="no_wrap"><?php echo e($pdc->supplier); ?>

										<input type="hidden" name="supplier_id[]" id="supplierid_<?php echo e($i); ?>" value="<?php echo e($pdc->supplier_id); ?>">
										<input type="hidden" name="supplier[]" id="supplier_<?php echo e($i); ?>" value="<?php echo e($pdc->supplier); ?>"></td>
										<td class="no_wrap"><?php echo e(date('d-m-Y',strtotime($pdc->voucher_date))); ?> 
										<input type="hidden" name="dr_account_id[]" id="draccountid_<?php echo e($i); ?>" value="<?php echo e($pdc->dr_account_id); ?>" ></td>
                                    </tr>
									<?php endforeach; ?>
									<div class="col-sm-3">
										<input type="text" class="form-control pull-right" name="voucher_date" data-language='en' readonly id="voucher_date" placeholder="Cheque Transfer Date" autocomplete="off"/>
                                    </div>
									<button type="button" class="btn btn-primary" id="btnsubmit" onClick="setSubmit()" <?php if(!$baccount): ?> disabled <?php endif; ?>>Submit</button> &nbsp; 
									<a href="<?php echo e(url('pdc_issued/undo_list')); ?>" class="btn btn-primary">View PDC Submitted List</a>
									&nbsp; <button type="button" class="btn btn-primary outstanding" onclick="getDetail()">Print PDC Report</button>
                                    </tbody>
                                </table>
								
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cdata" id="customerData"></div>

        </section>
		
		<div id="account_modal" class="modal fade animated" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Select Account</h4>
					</div>
					<div class="modal-body" id="account_data">
					</div>
				</div>
			</div>
		</div> 
<?php $__env->stopSection(); ?>

<?php /* page level scripts */ ?>
<?php $__env->startSection('footer_scripts'); ?>
    <!-- begining of page level js -->
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/iCheck/js/icheck.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('assets/vendors/bootstrap-fileinput/js/fileinput.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/vendors/moment/js/moment.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/datetime/js/jquery.datetimepicker.full.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/vendors/airdatepicker/js/datepicker.en.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('assets/js/custom_js/advanceddate_pickers.js')); ?>"></script>

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

<script>

$('#voucher_date').datepicker( { autoClose:true ,dateFormat: 'dd-mm-yyyy' } );

$(document).ready(function() {
    var table = $('#tablePDCI').DataTable({
        "scrollX": true,
		'order': [[0, 'asc']]
    });
	
//	var acurl = "<?php echo e(url('account_master/get_account_list/BANK')); ?>";
    var acurl = "<?php echo e(url('account_master/get_accounts')); ?>";
	$(document).on('click', 'input[name="cr_account[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#account_data').load(acurl+'/'+curNum, function(result){ 
			$('#myModal').modal({show:true}); $('.input-sm').focus();
		});
	});
	
	$(document).on('click', '.custRow', function(e) { //accountRow
		var num = $('#num').val();
		$('#draccount_'+num).val( $(this).attr("data-name") );
		$('#craccountid_'+num).val( $(this).attr("data-id") );
	});
});

$(function(){
	$('.cdata').toggle();
	var itmurl = "<?php echo e(url('account_master/custom_account/')); ?>";
		$(document).on('click', 'input[name="cr_account[]"]', function(e) {
		var res = this.id.split('_');
		var curNum = res[1]; 
		$('#customerData').load(itmurl+'/'+curNum, function(result){
			$('#myModal').modal({show:true});
		});

	});
});
	
var popup;
function getAccount(e) { 
	
	var ht = $(window).height();
	var wt = $(window).width();
	var res = e.id.split('_');
	var curNum = res[1]; 
	var itmurl = "<?php echo e(url('account_master/custom_account/')); ?>/"+curNum;
	popup = window.open(itmurl, "Popup", "width=900,height=500,top=100,left=200");
	popup.focus();
	return false
}

function setSubmit2() {
	
	var checked=false;
	var elements = document.getElementsByName("tag[]");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		alert('Please select atleast one issued Cheque!');
		return checked;
	} else {
		document.frmPdcIssued.submit();
	}
}

function setSubmit() {
	
	var checked=false; var is_ac=false;
	var elements = document.getElementsByName("tag[]");
	for(var i=0; i < elements.length; i++){
	    
	    if(elements[i].checked) {
			checked = true;
			is_ac=true;
		}
		
	}
	
	$("input[type=checkbox]:checked").each(function() { 
          var curNum = this.value;
	      
	      if($('#craccountid_'+curNum).val()=='') { 
	        is_ac=false;
	      }
    });
	
	if(!checked) {
		alert('Please select atleast one received Cheque!');
		return checked;
	} else if($('#voucher_date').val()=='') {
		alert('Please enter transfer date!');
		return false;
	} else if(!is_ac) {
	    alert('Credit account is required!');
	} else {
		
		var id = []; var drac = []; var crac = []; var amt = []; var ref = []; var vtype = []; var cid = []; var cname = []; var i;
		$("input[name='tag[]']:checked").each(function(){ 
			i =  $(this).val(); console.log(i);
			id.push($('#id_'+i).val());
			drac.push($('#draccountid_'+i).val());
			crac.push($('#craccountid_'+i).val());
			amt.push($('#amt_'+i).val());
			ref.push($('#ref_'+i).val());
			cid.push($('#supplierid_'+i).val());
			cname.push($('#customer_'+i).val());
			vtype.push($('#vtype_'+i).val());
		}); 
		$('#pdcid').val(id);
		$('#drac').val(drac);
		$('#crac').val(crac);
		$('#amt').val(amt);
		$('#ref').val(ref);
		$('#vtype').val(vtype);
		$('#cid').val(cid);
		$('#cname').val(cname);
		$('#vdate').val($('#voucher_date').val());
		
		$("#frmPdcIssued").submit();	
		//document.frmPdcIssued.submit();
	}
}


function setUndo() {
	
	var checked=false;
	var elements = document.getElementsByName("tag[]");
	for(var i=0; i < elements.length; i++){
		if(elements[i].checked) {
			checked = true;
		}
	}
	if (!checked) {
		alert('Please select atleast one issued Cheque!');
		return checked;
	} else if($('#voucher_date').val()=='') {
		alert('Please enter transfer date!');
		return false;
	} else {
		document.frmPdcIssued.action="<?php echo e(url('pdc_issued/undo')); ?>";
		document.frmPdcIssued.submit();
	}
}

function getDetail() {	
	document.frmPdcIssued.action = "<?php echo e(url('pdc_issued/print')); ?>";
	document.frmPdcIssued.submit();
}

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>