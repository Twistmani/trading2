	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<!--page level css -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/buttons.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/colReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/dataTables.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/rowReorder.bootstrap.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatables/css/scroller.bootstrap.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/vendors/datatablesmark.js/css/datatables.mark.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/responsive_datatables.css')); ?>">
    <!--end of page level css-->
<style>
body .table-responsive m-t-10,th,td {
   font-size:12px !important;
}
</style>
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success filterable">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-columns"></i> Account Master List
                            </h3>
                        </div>
                        <div class="panel-body">
                            
							<input type="hidden" name="num" id="num" value="<?php echo e($num); ?>">
                            <div class="table-responsive m-t-10">
								
                                <table class="table horizontal_table table-striped" id="tableAcnts">
                                    <thead>
                                    <tr>
                                        <th>Account ID</th>
                                        <th>Account Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($accounts as $account): ?>
                                    <tr>
										<?php if($num=='account'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectAcnt(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectAcnt(this)"><?php echo e($account->master_name); ?></a></td>
										<?php elseif($num=='sales'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectSlAcnt(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectSlAcnt(this)"><?php echo e($account->master_name); ?></a></td>
										<?php elseif($num=='PR'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectPRAcnt(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectPRAcnt(this)"><?php echo e($account->master_name); ?></a></td>
										<?php elseif($num=='SR'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectSRAcnt(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectSRAcnt(this)"><?php echo e($account->master_name); ?></a></td>
										<?php elseif($num=='debit'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectDebit(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectDebit(this)"><?php echo e($account->master_name); ?></a></td>
                                       <?php elseif($num=='credit'): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectCredit(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectCredit(this)"><?php echo e($account->master_name); ?></a></td>

										
								           <?php else: ?>
											<?php if($cr): ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectItemCr(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectItemCr(this)"><?php echo e($account->master_name); ?></a></td>
											<?php else: ?>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectItem(this)"><?php echo e($account->account_id); ?></a></td>
											<td><a href="" class="acnts" data-id="<?php echo e($account->id); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" onclick="selectItem(this)"><?php echo e($account->master_name); ?></a></td>
											<?php endif; ?>
										<?php endif; ?>
									</tr>
                                   <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="<?php echo e(asset('assets/js/app.js')); ?>" type="text/javascript"></script>
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
<!-- end of page level js -->
<script>
function selectItem(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var no = window.opener.document.getElementById("num").value;
		var acid = window.opener.document.getElementById("dracntid_"+no);
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("dracnt_"+no);
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectItemCr(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var no = window.opener.document.getElementById("num").value;
		var acid = window.opener.document.getElementById("cracntid_"+no);
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("cracnt_"+no);
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectAcnt(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("account_master_id");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("purchase_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectSlAcnt(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("cr_account_id");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("sales_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectDebit(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("account_dr");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("debit_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectCredit(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("account_cr");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("credit_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectPRAcnt(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("account_master_id");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("stock_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

function selectSRAcnt(e) { 
	
	if (window.opener != null && !window.opener.closed) { 
		var acid = window.opener.document.getElementById("dr_account_id");
		acid.value = $(e).data('id');
		var acname = window.opener.document.getElementById("sales_ret_account");
		acname.value = $(e).data('code')+' - '+$(e).data('name');

	}
	window.close();
}

</script>