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
<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success filterable">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-columns"></i> Item List
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <span>Item ID:</span>
                                    <input type="text" name="name" placeholder="Account ID..." class="form-control input-sm">
                                </div>
                                <div class="col-xs-6">
                                    <span>Item Name:</span>
                                    <input type="text" name="position" placeholder="Account Name..." class="form-control input-sm">
                                </div>
                            </div>
							<input type="hidden" name="num" id="num" value="<?php echo e($num); ?>">
                            <div class="table-responsive m-t-10">
                                <table class="table horizontal_table table-striped" id="table5">
                                    <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Unit</th>
                                        <th>Cost Avg.</th>
										<th>Sales Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($items as $item): ?>
                                    <tr>
                                        <td><a href="" class="itms" data-id="<?php echo e($item->id); ?>" data-code="<?php echo e($item->item_code); ?>" data-name="<?php echo e($item->description); ?>" data-unit="<?php echo e($item->unit_name); ?>" data-dismiss="modal"><?php echo e($item->item_code); ?></a></td>
                                        <td><a href="" class="itms" data-id="<?php echo e($item->id); ?>" data-code="<?php echo e($item->item_code); ?>" data-name="<?php echo e($item->description); ?>" data-unit="<?php echo e($item->unit_name); ?>" data-dismiss="modal"><?php echo e($item->description); ?></a></td>
                                        <td><?php echo e($item->unit_name); ?></td>
                                        <td></td>
										<td></td>
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
		var code = window.opener.document.getElementById("itmcod_"+no);
		code.value = $(e).data('code');
		
		var id = window.opener.document.getElementById("itmid_"+no);
		id.value = $(e).data('id');
		
		var name = window.opener.document.getElementById("itmdes_"+no);
		name.value = $(e).data('name');
		
		var vat = window.opener.document.getElementById("vat_"+no);
		vat.value = $(e).data('vat');
		
		var vatdiv = window.opener.document.getElementById("vatdiv_"+no);
		vatdiv.value = $(e).data('vat')+"%";
		
		var myNode = window.opener.document.getElementById("itmunt_"+no);
		myNode.innerHTML = '';

		var itm_id = $(e).data('id');
		$.get("<?php echo e(url('purchase_order/getunit/')); ?>/" + itm_id, function(data) { //alert(data);
			$.each(data, function(key, value) {   
				var option = document.createElement("option");
				option.text = value;
				option.value = key;
				var select = window.opener.document.getElementById("itmunt_"+no);
				select.add(option);
			});
			window.close();
		});
	
	}
	//window.close();
}
</script>