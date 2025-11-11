<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        <?php $__env->startSection('title'); ?>
            Profit ACC 365 | ERP Software
        <?php echo $__env->yieldSection(); ?>
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
   <!-- <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/invoice.css')); ?>">-->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/bootstrap.css')); ?>">
<?php echo $__env->yieldContent('header_styles'); ?>

<style>
#invoicing {
	font-size:8pt;
}

.tblstyle td,
  .tblstyle th {
    height:15px;
	padding:2px;
	border:1px solid #000 !important;
  }

/* @media  print {
	html, body {
		
		height: 530px !important;        
	}
	.page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
} */
</style>
<style type="text/css" media="print">

/*body{ page-break-after: always !important; overflow: hidden !important; }*/

thead
{
	display: table-header-group;
}

#inv
{
	 display: table-footer-group;
	 /*position: fixed;*/
     bottom: 0;
	 margin: 0 auto 0 auto;
	 width:100%;
}

.t {
	 height:250px;
}

</style>
<!-- end of global css -->
</head>
<body >


<!-- For horizontal menu -->
<?php echo $__env->yieldContent('horizontal_header'); ?>
<!-- horizontal menu ends -->
<div>
    <!-- Left side column. contains the logo and sidebar -->
    
    <aside class="right">
        <section class="content p-l-r-15" id="invoice-stmt">
            <div class="panel">
                
                <div class="panel-body" style="width:100%; !important; border:0px solid red;">
                    <div class="print" id="invoicing">
						<div class="col-md-12">
					
						<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>
								<tr>
									<td align="left" valign="top" style="padding-left:0px;">
									<?php if($fromdate!='' && $todate!=''): ?>
										<h6><b>Date: <b><?php echo e(date('d-m-Y', strtotime($fromdate))); ?> 
											   - <b><?php echo e(date('d-m-Y', strtotime($todate))); ?></b></h6>
									<?php endif; ?>
									</td>
									<td align="right" style="padding-left:0px;"><br/>
									</td>
								</tr>
							</thead>
							<?php if($type=='Movement_Summary'): ?>
							<tbody id="bod">
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="8%"><b>SI.No.</b></td>
											<td width="10%"><b>Item Code</b></td>
											<td width="25%"><b>Description</b></td>
											<td width="7%" class="text-right"><b>Opn Qty</b></td>
											<td width="7%" class="text-right"><b>Opn Cost</b></td>
												<td width="7%" class="text-right"><b>Total Cost</b></td>
											<td width="8%" class="text-right"><b>Cost Avg</b></td>
											<td width="7%" class="text-right"><b>Qty In</b></td>
												<td width="7%" class="text-right"><b>Total Cost(In)</b></td>
											<td width="7%" class="text-right"><b>Qty Out</b></td>
												<td width="7%" class="text-right"><b>Total Cost(Out)</b></td>
											<td width="10%" class="text-right"><b>Total Balance Qty</b></td>
											
											<td width="8%" class="text-right"><b>Total Value</b></td>
										</tr>
										<?php  $i=$total_balance=$total_value=$total_in=$total_out=0;$total_opnqty=$total_unitcost=$total_purcost=$total_salecost=0;  ?>
										<?php foreach($results as $row): ?>
										<?php  $i++; $total_balance += $row->qty_bal; $total_value += $row->net_value; $total_in += $row->qty_in; $total_out += $row->qty_out;$total_opnqty += $row->opn_qty;$total_unitcost +=$row->unit_cost;$total_purcost +=$row->pur_cost;$total_salecost +=$row->sale_cost;  ?>
										<tr>
											<td><?php echo e($i); ?></td>
											<td><?php echo e($row->item_code); ?></td>
											<td><?php echo e($row->description); ?></td>
											<td class="text-right"><?php echo e($row->opn_qty); ?></td>
											<td class="text-right"><?php echo e($row->opn_cost); ?></td>
											<td class="text-right"><?php echo e($row->unit_cost); ?></td>
											<td class="text-right"><?php echo e(number_format($row->cost_avg,2)); ?></td>
											<td class="text-right"><?php echo e($row->qty_in); ?></td>
											<td class="text-right"><?php echo e($row->pur_cost); ?></td>
											<td class="text-right"><?php echo e($row->qty_out); ?></td>
											<td class="text-right"><?php echo e($row->sale_cost); ?></td>
											<td class="text-right"><?php echo e($row->qty_bal); ?></td>
										
											<td class="text-right"><?php echo e(number_format($row->net_value,2)); ?></td>
										</tr>
										<?php endforeach; ?>
										<tr>
											<td colspan="3" class="text-right"><b>Total: </b></td>
											<td class="text-right"><b><?php echo e($total_opnqty); ?></b></td>
											<td class="text-right"><b></b></td>
											<td class="text-right"><b><?php echo e($total_unitcost); ?></b></td>
											<td class="text-right"><b></b></td>
											<td class="text-right"><b><?php echo e($total_in); ?></b></td>
											<td class="text-right"><b><?php echo e($total_purcost); ?></b></td>
											<td class="text-right"><b><?php echo e($total_out); ?></b></td>
											<td class="text-right"><b><?php echo e($total_salecost); ?></b></td>
											<td class="text-right"><b><?php echo e($total_balance); ?></b></td>
											
											<td class="text-right"><b><?php echo e(number_format($total_value,2)); ?></b></td>
										</tr>
									</table>
									</td>
								</tr>
							</tbody>	
							<?php else: ?>
							<tbody id="bod">
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="8%"><b>Ref.No.</b></td>
											<td width="10%"><b>Item Code</b></td>
											<td width="25%"><b>Description</b></td>
											<td width="8%"><b>Tr.Date</b></td>
											<td width="25%"><b>Party Name</b></td>
											<td width="7%" class="text-right"><b>Qty</b></td>
											<td width="8%" class="text-right"><b>Unit Cost</b></td>
											<td width="10%" class="text-right"><b>Balance Qty</b></td>
										</tr>
										
										<?php foreach($results as $key => $result): ?>
										<?php if($result): ?> <?php  $ctotal = 0;  ?>
										<tr>
											<td colspan="8"><b><?php echo e($key); ?></b></td>
										</tr>
										<?php foreach($result as $row): ?>
										<?php  $ctotal += $row->sale_reference;  ?>
										<tr>
											<td><?php echo e($row->voucher_no); ?></td>
											<td><?php echo e($row->item_code); ?></td>
											<td><?php echo e($row->description); ?></td>
											<td><?php echo e(date('d-m-Y',strtotime($row->voucher_date))); ?></td>
											<td><?php echo e($row->master_name); ?></td>
											<td class="text-right"><?php echo e($row->quantity); ?></td>
											<td class="text-right"><?php echo e($row->unit_cost); ?></td>
											<td class="text-right"><?php echo e($row->sale_reference); ?></td>
										</tr>
										<?php endforeach; ?>
										<tr>
											<td colspan="5" class="text-right"><b>Total: </b></td>
											<td class="text-right"><b></b></td>
											<td class="text-right"><b></b></td>
											<td class="text-right"><b><?php echo e($ctotal); ?></b></td>
										</tr>
										<?php endif; ?>
										<?php endforeach; ?>
									</table>
									</td>
								</tr>
							</tbody>
							<?php endif; ?>
							<tfoot id="inv">
								<tr>
									<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
							</tfoot>
						</table>
						
						</div>
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right">
                                             <button type="button" onclick="javascript:window.print();" 
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;" >
                                                    <i class="fa fa-fw fa-print"></i>
                                                Print
                                            </span>
                                </button>
								
								<button type="button" onclick="getExport()"
											 class="btn btn-responsive button-alignment btn-primary"
											 data-toggle="button">
										<span style="color:#fff;">
											<i class="fa fa-fw fa-upload"></i>
										Export Excel
									</span>
									</button>
								<button type="button" onclick="javascript:window.close();"
                                                     class="btn btn-responsive button-alignment btn-primary"
                                                     data-toggle="button">
                                                <span style="color:#fff;" >
                                                    <i class="fa fa-fw fa-times"></i>
                                                Close 
                                            </span>
                                </button>
                                </span>
                        </div>
						
					<form class="form-horizontal" role="form" method="POST" name="frmExport" id="frmExport" action="<?php echo e(url('stock_movement/export')); ?>">
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
					<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
					<input type="hidden" name="search_type" value="<?php echo e($type); ?>" >
					</form>
					
                    </div>
                </div>
            </div>
            <!-- row -->
        
        <!-- right side bar end -->
        </section>

    </aside>
    <!-- page wrapper-->
</div>
<!-- wrapper-->
<!-- global js -->
<script src="<?php echo e(asset('assets/js/app.js')); ?>" type="text/javascript"></script>
<!-- end of global js -->
<?php echo $__env->yieldContent('footer_scripts'); ?>
<!-- end page level js -->
</body>
<script>
function getExport() {
	document.frmExport.submit();
}

$(document).ready(function () {
	$('html').attr({style: 'min-height: inherit'});
	$('body').attr({style: 'min-height: inherit'});
});
</script>
</html>
