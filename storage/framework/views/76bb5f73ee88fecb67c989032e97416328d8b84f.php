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
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/app.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/custom_css/skins/skin-coreplus.css')); ?>" type="text/css" id="skin"/>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/custom_css/bootstrap.css')); ?>">
<?php echo $__env->yieldContent('header_styles'); ?>

<style>
#invoicing {
	font-size:9pt;
}

.tblstyle td,
  .tblstyle th {
    height:15px;
	padding:2px;
	border:1px solid #000 !important;
  }


</style>
<style type="text/css" media="print">


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
										<td colspan="2" align="center"><?php echo $__env->make('main.print_head_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><br/><b><u><?php echo e($voucherhead); ?></u></b></b></td>
									</tr>
									<tr><td><br/></td></tr>
									<tr>
										<td colspan="2" align="left" valign="top" style="padding-left:0px;">
											<p>Date From: <b><?php echo ($from=='')?date('d-m-Y',strtotime($settings->from_date)):date('d-m-Y',strtotime($from));?></b> &nbsp; To: <b><?php echo ($to=='')?date('d-m-Y'):date('d-m-Y',strtotime($to));?></b></p>
										</td>
									</tr>
									
								</thead>
								<tbody id="bod">
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
                                            <table border="1" cellpadding="5" cellspacing="0" class="table table">
                                                <thead>
                                                    <tr>
                                                        <th>Group Name</th>
                                                        <th>Debit</th>
                                                        <th>Credit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $grandDr = 0;
                                                        $grandCr = 0;
                                                     ?>
                                                    <?php foreach($groupedSummary as $groupName => $summary): ?>
                                                        <tr>
                                                            <td><?php echo e($groupName); ?></td>
                                                            <td style="text-align:right"><?php echo e(number_format($summary['debit'], 2)); ?></td>
                                                            <td style="text-align:right"><?php echo e(number_format($summary['credit'], 2)); ?></td>
                                                        </tr>
                                                        <?php 
                                                            $grandDr += $summary['debit'];
                                                            $grandCr += $summary['credit'];
                                                         ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr style="font-weight: bold; background-color: #d0f0d0;">
                                                        <td style="text-align:right">Grand Total</td>
                                                        <td style="text-align:right"><?php echo e(number_format($grandDr, 2)); ?></td>
                                                        <td style="text-align:right"><?php echo e(number_format($grandCr, 2)); ?></td>
                                                    </tr>
                                                </tfoot>
                                            </table>

                                            
										</td>
									</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot_stmt', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						
						
						</div>
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <span class="pull-right" style="display: flex; gap: 10px; flex-wrap: wrap;">
                                        <button type="button" onclick="javascript:window.print();" 
                                                class="btn btn-responsive button-alignment btn-primary"
                                                data-toggle="button">
                                            <span style="color:#fff;" >
                                                <i class="fa fa-fw fa-print"></i>
                                            Print
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

                                    <form method="GET" action="<?php echo e(url('trial_balance2/search')); ?>">
                                        <input type="hidden" name="from_date" value="<?php echo e($from); ?>">
                                        <input type="hidden" name="to_date" value="<?php echo e($to); ?>">
                                        <input type="hidden" name="search_type" value="<?php echo e($search_type); ?>">
                                        <input type="hidden" name="trim_zero" value="<?php echo e($trimzero); ?>">
                                        <button type="submit" name="export" value="1" class="btn btn-responsive button-alignment btn-primary">Export to Excel</button>
                                    </form>
								
                                </span>
                        </div>

                        
                    </div>
					
                </div>
            </div>

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

$(document).ready(function () {
	$('html').attr({style: 'min-height: inherit'});
	$('body').attr({style: 'min-height: inherit'});
	
});
</script>
</html>
