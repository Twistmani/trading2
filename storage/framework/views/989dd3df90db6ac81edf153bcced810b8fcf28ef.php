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
					<?php if(count($reports) > 0) { 
						if($type=='summary') { ?>
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="center"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
									
									<tr>
										<td align="left" valign="top" style="padding-left:0px;"><br/>
										</td>
										<td align="right" style="padding-left:0px;">
											<?php if($fromdate!='' && $todate!='') { ?><p>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></p><?php } ?>
										</td>
									</tr>
								</thead>
								
								<tbody id="bod">
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table class="tblstyle table-bordered" width="100%">
										<thead>
									 <th>SI.#</th>
									
									<th class="text-right">SI.No</th>
									<th class="text-right">SI.Date</th>
								
										<th class="text-right">Customer</th>
										<th class="text-right">Gross Amt.</th>
										<th class="text-right">Discount</th>
										<th class="text-right">Net Sale</th>
										<th class="text-right">VAT Amt.</th>
										<th class="text-right">Net Total</th>
								</thead>
											<tbody>
											<?php  $netdiscount=$netvat_amount=$net_amount_total=0;$i=0;$sale_total=$saletotal=$nettotal=0; ?>
								
										<?php  $total=$discount=$vat_amount=$amount_total=$netsale=0; ?>
										<?php foreach($reports as $row): ?>
										<?php
											
										//$netsale= (($row->disc > 0)?$row->total:$row->subtotal)-$row->disc;
										$netsale= $row->subtotal;
										
										//$total += $row->subtotal;
											  $discount += $row->disc;
											 // $vat_amount += $row->vat_total;
											  $sale_total += ($row->subtotal - $row->discount);
											 // $amount_total += $total + $discount + $vat_amount;
											 $amount_total += $row->net_total ;
											
										?>
										
										
										<tr>
										
										 <td ><?php echo e(++$i); ?></td>
										
										<td class="text-right"><?php echo e($row->voucher_no); ?></td>
										<td class="text-right"><?php echo e(date('d-m-Y',strtotime($row->voucher_date))); ?></td>
										
										 <td class="text-right"><b><?php echo e($row->customer); ?></b></td>
										
											<td class="text-right"><b><?php echo e(number_format((($row->disc > 0)?($netsale+$row->disc):$row->subtotal),2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($row->disc,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($netsale,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($row->vat_total,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($row->net_total,2)); ?></b></td>
										</tr>
										<?php if($row->disc > 0)
										            $nettotal += $netsale+$row->disc;
										      else
										            $nettotal += $row->subtotal;

										            
										            // $row->subtotal;
											  //$netdiscount += $discount;
											  $netdiscount += $row->disc;
											  $netvat_amount += $row->vat_total;
											  $net_amount_total += $row->net_total;
											  $saletotal+= $row->subtotal;
											  //$saletotal+= (($row->disc > 0)?$row->total:$row->subtotal)-$row->disc;// $row->subtotal-$row->disc;//$netsale;
										?>
										<?php endforeach; ?>
										
								
									<tr>
									<!-- <td class="text-right"></td> -->
									<td></td>
									<td></td><td></td>
											<td class="text-right"><b>Total:</b></td>
											<td class="text-right"><b><?php echo e(number_format($nettotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($netdiscount,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($saletotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($netvat_amount,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($net_amount_total,2)); ?></b></td>
										</tr>
											</tbody>
										</table>
										</td>
									</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						<?php } else if($type=='detail') { ?>
								<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($voucherhead); ?></u></b></b></td>
									</tr>
									
									<tr>
										<td align="left" valign="top" style="padding-left:0px;"><br/>
										</td>
										<td align="right" style="padding-left:0px;">
											<?php if($fromdate!='' && $todate!='') { ?><p>From: <?php echo e($fromdate); ?> - To: <?php echo e($todate); ?></p><?php } ?>
										</td>
									</tr>
								</thead>
								
								<tbody id="bod">
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table class="tblstyle table-bordered" width="100%">
											<body>
											<?php $qty_total = $net_total = $vat_total = $gross_total=$discount =$gtotal= $i = 0; ?>
											<?php foreach($reports as $report): ?>
											<?php  $i++;  ?>
											<tr>
												<td><b>SI.No:</b> <?php echo e($i); ?> &nbsp; <b>SI.#:</b> <?php echo e($report[0]->voucher_no); ?> &nbsp; <b>SI Date</b> <?php echo e(date('d-m-Y', strtotime($report[0]->voucher_date))); ?></td>
												<td><b>SI.#:</b> <?php echo e($report[0]->voucher_no); ?></td>
												
												<td><b>Salesman:</b> <?php echo e($report[0]->salesman); ?></td>
												<td colspan="5" class="text-right"><b>Customer:</b> <?php echo e($report[0]->master_name); ?></td>
											</tr>
											<tr>
												<td><b>Item Code</b></td>
												<td><b>Description</b></td>
												<td class="text-right"><b>SI.Qty.</b></td>
												<td class="text-right"><b>Rate</b></td>
												<td class="text-right"><b>Total Amt.</b></td>
												<td class="text-right"><b>VAT Amt.</b></td>
												<td class="text-right"><b>Net Amt.</b></td>
											</tr>
											<?php $line_total=$net_subtotal=$vat_subtotal=0;?>
												<?php foreach($report as $row): ?>
												<?php $qty_total += $row->quantity;
												$discount =$row->discount;
												           
												  if($row->tax_include==0){
												  $net_amount = ($row->vat_amount + $row->line_total)-$row->discount;
												  $gtotal=$row->line_total-$discount;
												  }else{
												  $net_amount = ( $row->line_total)-$row->discount;
												  $gtotal=$row->line_total-$discount-$row->vat_amount;
												  }
												  $line_total+=$gtotal;
												 $vat_subtotal+= $row->vat_amount;
												 $vat_total += $row->vat_amount;
												 $net_subtotal+= $net_amount; 
												 $net_total += $net_amount;
												?>
												<tr>
													<td><?php echo e($row->item_code); ?></td>
													<td><?php echo e($row->description); ?></td>
													<td class="text-right"><?php echo e($row->quantity); ?></td>
													<td class="text-right"><?php echo e(number_format($row->unit_price,2)); ?></td>
													<td class="text-right"><?php echo e(number_format($gtotal,2)); ?></td>
													<td class="text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
													<td class="text-right"><?php echo e(number_format($net_amount,2)); ?></td>
												</tr>
												<?php endforeach; ?>
												<?php $gross_total +=$report[0]->subtotal ; 
												//$net_total += $report[0]->net_total;
												?>
												<tr>
													<td></td>
													<td class="text-right"><b>Sub Total:</b></td>
													<td class="text-right"><b></b></td>
													<td class="text-right"></td>
													<td class="text-right"><b><?php echo e(number_format($line_total,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($vat_subtotal,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($net_subtotal,2)); ?></b></td>
												</tr>
												<tr><td colspan="9"><br/></td></tr>
											<?php endforeach; ?>	
											<tr>
													<td></td>
													<td class="text-right"><b>Total:</b></td>
													<td class="text-right"><b><?php echo e($qty_total); ?></b></td>
													<td class="text-right"></td>
													<td class="text-right"><b><?php echo e(number_format($gross_total,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($vat_total,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($net_total,2)); ?></b></td>
												</tr>
											</body>
										</table>
								</td>
									</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
							
						<?php }else if($type=='invoice') { ?>
						<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>
								
							</thead>
							
							<tbody id="bod">
								<?php 
								$nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0;
								foreach($reports as $report) { ?>
								<tr>
									<td align="left" valign="top" style="padding-left:0px;">
										<h6><b>Inv.#: <?php echo e($report[0]['voucher_no']); ?><br/>
										Cust.Name: <?php echo e($report[0]['customer']); ?></b></h6>
									</td>
									<td align="right" style="padding-left:0px;">
										<p>Date: <?php echo e(date('d-m-Y',strtotime($report[0]['voucher_date']))); ?></p>
									</td>
								</tr>
								
								<tr style="border:0px solid black;">
									<td colspan="2" align="center">
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
										<tr>
											<td width="7%"><b>SI.#</b></td>
											<td width="13%"><b>Item Code</b></td>
											<td width="20%"><b>Description</b></td>
											<td width="8%"><b>Qty.</b></td>
											<td width="12%" class="text-right"><b>Sale Price</b></td>
											<td width="8%" class="text-right"><b>Discount</b></td>
											<td width="10%" class="text-right"><b>Cost</b></td>
											<td width="12%" class="text-right"><b>Profit</b></td>
											<td width="10%" class="text-right"><b>Profit%</b></td>
										</tr>
										
										<?php 
											$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = $sqty = $tcst = 0; $i=1;
											foreach($report as $row) { 
												$sprice = $row['squantity'] * $row['sunit_price'];
												if($row['class_id']==1)
													$cost = $row['sale_cost'];
												else
													$cost = 0;
												$pprice = $row['squantity'] * $cost;
												$profit = $sprice - $pprice - $row['discount'];
												$percentage = ($profit > 0 && $sprice > 0)?($profit / $sprice * 100):0;
												$sptotal += $sprice;
												$dtotal += $row['discount'];
												$ctotal += $cost;
												$ptotal += $profit;
												$pertotal += $percentage; $n = $i;
												$sqty += $row['squantity'];
												$tcst += $pprice;
										?>
										
										<tr>
											<td><?php echo e($i++); ?></td>
											<td><?php echo e($row['item_code']); ?></td>
											<td ><?php echo e($row['description']); ?></td>
											<td><?php echo e($row['squantity']); ?></td>
											<td class="text-right"><?php echo e(number_format($sprice,2)); ?></td>
											<td class="text-right"><?php echo e(number_format($row['discount'],2)); ?></td>
											<td class="text-right"><?php echo e(number_format($pprice,2)); ?></td>
											<td class="text-right"><?php echo e(number_format($profit,2)); ?></td>
											<td class="text-right"><?php echo e(number_format($percentage,2)); ?></td>
										</tr>
									<?php } $peravg = $pertotal / $n; 
										$nsptotal += $sptotal;
										$ndtotal += $dtotal;
										$nctotal += $tcst;
										$nptotal += $ptotal;
										$nqty += $sqty;
									?>
									
									<tr>
										<td colspan="4" align="right"><b>Sub Total:</b></td>
										<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
										<td class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
										<td class="text-right"><b><?php echo e(number_format($tcst,2)); ?></b></td>
										<td class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
										<td class="text-right"><b><?php echo e(number_format($peravg,2)); ?></b></td>
									</tr>
									</table>
									</td>
								</tr>
							  <?php } ?>
								<tr style="border:0px solid black;">
									<td colspan="2" align="center"><br/>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
									
										<tr>
											<td width="48%" colspan="4" align="right"><b>Net Total:</b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
											<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
											<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
											<td width="10%" class="text-right"></td>
										</tr>
									</table>
									</td>
								</tr>
							</tbody>
							<tfoot id="inv">
								<tr>
									<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
								</tr>
							</tfoot>
						</table>

						<?php } else if($type=='customer') { ?>
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
									
								</thead>
								
								<tbody id="bod">
									<?php $nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0; foreach($reports as $report) { ?>
									<tr>
										<td align="left" valign="top" style="padding-left:0px;">
											<h6><b>Cust.#: <?php echo e($report[0]->account_id); ?><br/>
											Cus.Name: <?php echo e($report[0]->customer); ?></b></h6>
										</td> 
										<td align="right" style="padding-left:0px;">
											<p></p>
										</td>
									</tr>
									
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<tr>
												<td width="7%"><b>Inv.#</b></td>
												<td width="13%"><b>Inv. Date</b></td>
												<td width="12%" class="text-right"><b>Gross Amount</b></td>
												<td width="8%" class="text-right"><b>Discount</b></td>
												<td width="10%" class="text-right"><b>Vat.Amount</b></td>
												<td width="12%" class="text-right"><b>Net.Total</b></td>
												
											</tr>
											
											<?php 
												$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = 0; $i=1;
												foreach($report as $row) { 
													
												$sptotal +=$row->total;  
												$dtotal += $row->discount;  
												$ctotal +=  $row->vat_amount;
												$ptotal += $row->net_total; 
											
												$n = $i; $i++;
											?>
											
											<tr>
												<td ><?php echo e($row->voucher_no); ?></td>
												<td ><?php echo e(date('d-m-Y',strtotime($row->voucher_date))); ?></td>
												<td class="text-right"><?php echo e(number_format($row->total,2)); ?></td>
												<td class="text-right"><?php echo e(number_format($row->discount,2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row->net_total,2)); ?></td>
												
											</tr>
										<?php } $peravg = $pertotal / $n;
										
										$nsptotal += $sptotal;
										$ndtotal += $dtotal;
										$nctotal += $ctotal;
										$nptotal += $ptotal;
										//$nqty += $sqty;
									?>
										
										<tr>
											<td colspan="2" align="right"><b>Sub Total:</b></td>
											<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($ctotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
											
										</tr>
										
										</table>
										</td>
									</tr>
								  <?php } ?>
								  
								  	<tr style="border:0px solid black;">
									<td colspan="2" align="center"><br/>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
									
										<tr>
											<td width="20%" colspan="2" align="right"><b>Net Total:</b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
											<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
											<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
											
										</tr>
									</table>
									</td>
								</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
							<?php } else if($type=='salesman') { ?>
							
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
									
								</thead>
								
								<tbody id="bod">
									<?php 
									$nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0;
									foreach($reports as $report) { ?>
									<tr>
										<td align="left" valign="top" style="padding-left:0px;">
											<h6><b>Salesman: <?php echo e($report[0]['salesman']); ?></b></h6>
										</td>
										<td align="right" style="padding-left:0px;">
											<p>Date: <?php echo e(date('d-m-Y',strtotime($report[0]['voucher_date']))); ?></p>
										</td>
									</tr>
									
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<tr>
												<td width="7%"><b>SI.#</b></td>
												<td width="13%"><b>Item Code</b></td>
												<td width="20%"><b>Description</b></td>
												<td width="8%"><b>Qty.</b></td>
												<td width="12%" class="text-right"><b>Sale Price</b></td>
												<td width="8%" class="text-right"><b>Discount</b></td>
												<td width="10%" class="text-right"><b>Cost</b></td>
												<td width="12%" class="text-right"><b>Profit</b></td>
												<td width="10%" class="text-right"><b>Profit%</b></td>
											</tr>
											
											<?php 
												$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = $sqty = $tcst = 0; $i=1;
												foreach($report as $row) { 
													$sprice = $row['squantity'] * $row['sunit_price'];
													if($row['class_id']==1)
														$cost = $row['sale_cost'];
													else
														$cost = 0;
													$pprice = $row['squantity'] * $cost;
													$profit = $sprice - $pprice - $row['discount'];
													$percentage = ($profit > 0 && $sprice > 0)?($profit / $sprice * 100):0;
													$sptotal += $sprice;
													$dtotal += $row['discount'];
													$ctotal += $cost;
													$ptotal += $profit;
													$pertotal += $percentage; $n = $i;
													$sqty += $row['squantity'];
													$tcst += $pprice;
											?>
											
											<tr>
												<td><?php echo e($i++); ?></td>
												<td><?php echo e($row['item_code']); ?></td>
												<td ><?php echo e($row['description']); ?></td>
												<td><?php echo e($row['squantity']); ?></td>
												<td class="text-right"><?php echo e(number_format($sprice,2)); ?></td>
												<td class="text-right"><?php echo e(number_format($row['discount'],2)); ?></td>
												<td class="text-right"><?php echo e(number_format($pprice,2)); ?></td>
												<td class="text-right"><?php echo e(number_format($profit,2)); ?></td>
												<td class="text-right"><?php echo e(number_format($percentage,2)); ?></td>
											</tr>
										<?php } $peravg = $pertotal / $n; 
											$nsptotal += $sptotal;
											$ndtotal += $dtotal;
											$nctotal += $tcst;
											$nptotal += $ptotal;
											$nqty += $sqty;
										?>
										
										<tr>
											<td colspan="4" align="right"><b>Sub Total:</b></td>
											<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($tcst,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($peravg,2)); ?></b></td>
										</tr>
										</table>
										</td>
									</tr>
								  <?php } ?>
									<tr style="border:0px solid black;">
										<td colspan="2" align="center"><br/>
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
										
											<tr>
												<td width="48%" colspan="4" align="right"><b>Net Total:</b></td>
												<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
												<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
												<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
												<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
												<td width="10%" class="text-right"></td>
											</tr>
										</table>
										</td>
									</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						
							<?php } else if($type=='summarysalesman') { ?>
								<table border="0" style="width:100%;height:100%;">
									<thead>
										<tr>
											<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
										</tr>
										
									</thead>
									
									<tbody id="bod">
										<?php $nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0; foreach($reports as $report) { ?>
										<tr>
											<td align="left" valign="top" style="padding-left:0px;">
												<h6><b>Salesman: <?php echo e($report[0]['salesman']); ?></b></h6>
											</td>
											<td align="right" style="padding-left:0px;">
												<p></p>
											</td>
										</tr>
										
										<tr style="border:0px solid black;">
											<td colspan="2" align="center">
											<table border="0" style="width:100%;" class="tblstyle table-bordered">
												<tr>
													<td width="7%"><b>Inv.#</b></td>
													<td width="13%"><b>Inv. Date</b></td>
													<td width="12%" class="text-right"><b>Sale Price</b></td>
													<td width="8%" class="text-right"><b>Discount</b></td>
													<td width="10%" class="text-right"><b>Cost</b></td>
													<td width="12%" class="text-right"><b>Profit</b></td>
													<td width="10%" class="text-right"><b>Profit%</b></td>
												</tr>
												
												<?php 
													$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = 0; $i=1;
													foreach($report as $row) { 
													
													$sptotal += $row['sprice'];
													$dtotal += $row['discount'];
													$ctotal += $row['cost'];
													$ptotal += $row['profit'];
													$pertotal += $row['percentage'];
													$n = $i; $i++;
												?>
												
												<tr>
													<td ><?php echo e($row['voucher_no']); ?></td>
													<td ><?php echo e(date('d-m-Y',strtotime($row['voucher_date']))); ?></td>
													<td class="text-right"><?php echo e(number_format($row['sprice'],2)); ?></td>
													<td class="text-right"><?php echo e(number_format($row['discount'],2)); ?></td>
													<td  class="text-right"><?php echo e(number_format($row['cost'],2)); ?></td>
													<td  class="text-right"><?php echo e(number_format($row['profit'],2)); ?></td>
													<td  class="text-right"><?php echo e(number_format($row['percentage'],2)); ?></td>
												</tr>
											<?php } $peravg = $pertotal / $n;
											
											$nsptotal += $sptotal;
											$ndtotal += $dtotal;
											$nctotal += $ctotal;
											$nptotal += $ptotal;
											//$nqty += $sqty;
										?>
											
											<tr>
												<td colspan="2" align="right"><b>Sub Total:</b></td>
												<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
												<td  class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
												<td class="text-right"><b><?php echo e(number_format($ctotal,2)); ?></b></td>
												<td  class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
												<td  class="text-right"><!--<b><?php echo e(number_format($peravg,2)); ?></b>--></td>
											</tr>
											
											</table>
											</td>
										</tr>
									  <?php } ?>
									  
										<tr style="border:0px solid black;">
										<td colspan="2" align="center"><br/>
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
										
											<tr>
												<td width="20%" colspan="2" align="right"><b>Net Total:</b></td>
												<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
												<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
												<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
												<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
												<td width="10%" class="text-right"></td>
											</tr>
										</table>
										</td>
									</tr>
									</tbody>
									<tfoot id="inv">
										<tr>
											<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
										</tr>
									</tfoot>
								</table>
							<?php } else if($type=='area') { ?>
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
									
								</thead>
								
								<tbody id="bod">
									<?php $nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0; foreach($reports as $report) { ?>
									<tr>
										<td align="left" valign="top" style="padding-left:0px;">
											<h6><b>Cust.#: <?php echo e($report[0]['account_id']); ?><br/>
											Cust.Name: <?php echo e($report[0]['customer']); ?></b></h6>
										</td>
										<td align="right" style="padding-left:0px;">
											<p></p>
										</td>
									</tr>
									
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<tr>
												<td width="7%"><b>Inv.#</b></td>
												<td width="13%"><b>Inv. Date</b></td>
												<td width="12%" class="text-right"><b>Sale Price</b></td>
												<td width="8%" class="text-right"><b>Discount</b></td>
												<td width="10%" class="text-right"><b>Cost</b></td>
												<td width="12%" class="text-right"><b>Profit</b></td>
												<td width="10%" class="text-right"><b>Profit%</b></td>
											</tr>
											
											<?php 
												$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = 0; $i=1;
												foreach($report as $row) { 
												
												$sptotal += $row['sprice'];
												$dtotal += $row['discount'];
												$ctotal += $row['cost'];
												$ptotal += $row['profit'];
												$pertotal += $row['percentage'];
												$n = $i; $i++;
											?>
											
											<tr>
												<td ><?php echo e($row['voucher_no']); ?></td>
												<td ><?php echo e(date('d-m-Y',strtotime($row['voucher_date']))); ?></td>
												<td class="text-right"><?php echo e(number_format($row['sprice'],2)); ?></td>
												<td class="text-right"><?php echo e(number_format($row['discount'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['cost'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['profit'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['percentage'],2)); ?></td>
											</tr>
										<?php } $peravg = $pertotal / $n;
										
										$nsptotal += $sptotal;
										$ndtotal += $dtotal;
										$nctotal += $ctotal;
										$nptotal += $ptotal;
										//$nqty += $sqty;
									?>
										
										<tr>
											<td colspan="2" align="right"><b>Sub Total:</b></td>
											<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($ctotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
											<td  class="text-right"><!--<b><?php echo e(number_format($peravg,2)); ?></b>--></td>
										</tr>
										
										</table>
										</td>
									</tr>
								  <?php } ?>
								  
								  	<tr style="border:0px solid black;">
									<td colspan="2" align="center"><br/>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
									
										<tr>
											<td width="20%" colspan="2" align="right"><b>Net Total:</b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
											<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
											<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
											<td width="10%" class="text-right"></td>
										</tr>
									</table>
									</td>
								</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						<?php } else if($type=='group') { ?>
							<table border="0" style="width:100%;height:100%;">
								<thead>
									<tr>
										<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
									</tr>
									<tr>
										<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
									</tr>
									
								</thead>
								
								<tbody id="bod">
									<?php $nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0; foreach($reports as $report) { ?>
									<tr>
										<td align="left" valign="top" style="padding-left:0px;">
											<h6><b>Group.#: <br/>
											Group.Name: </b></h6>
										</td>
										<td align="right" style="padding-left:0px;">
											<p></p>
										</td>
									</tr>
									
									<tr style="border:0px solid black;">
										<td colspan="2" align="center">
										<table border="0" style="width:100%;" class="tblstyle table-bordered">
											<tr>
												<td width="7%"><b>Inv.#</b></td>
												<td width="13%"><b>Inv. Date</b></td>
												<td width="12%" class="text-right"><b>Sale Price</b></td>
												<td width="8%" class="text-right"><b>Discount</b></td>
												<td width="10%" class="text-right"><b>Cost</b></td>
												<td width="12%" class="text-right"><b>Profit</b></td>
												<td width="10%" class="text-right"><b>Profit%</b></td>
											</tr>
											
											<?php 
												$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = 0; $i=1;
												foreach($report as $row) { 
												
												$sptotal += $row['sprice'];
												$dtotal += $row['discount'];
												$ctotal += $row['cost'];
												$ptotal += $row['profit'];
												$pertotal += $row['percentage'];
												$n = $i; $i++;
											?>
											
											<tr>
												<td ><?php echo e($row['voucher_no']); ?></td>
												<td ><?php echo e(date('d-m-Y',strtotime($row['voucher_date']))); ?></td>
												<td class="text-right"><?php echo e(number_format($row['sprice'],2)); ?></td>
												<td class="text-right"><?php echo e(number_format($row['discount'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['cost'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['profit'],2)); ?></td>
												<td  class="text-right"><?php echo e(number_format($row['percentage'],2)); ?></td>
											</tr>
										<?php } $peravg = $pertotal / $n;
										
										$nsptotal += $sptotal;
										$ndtotal += $dtotal;
										$nctotal += $ctotal;
										$nptotal += $ptotal;
										//$nqty += $sqty;
									?>
										
										<tr>
											<td colspan="2" align="right"><b>Sub Total:</b></td>
											<td class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
											<td class="text-right"><b><?php echo e(number_format($ctotal,2)); ?></b></td>
											<td  class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td>
											<td  class="text-right"><!--<b><?php echo e(number_format($peravg,2)); ?></b>--></td>
										</tr>
										
										</table>
										</td>
									</tr>
								  <?php } ?>
								  
								  	<tr style="border:0px solid black;">
									<td colspan="2" align="center"><br/>
									<table border="0" style="width:100%;" class="tblstyle table-bordered">
									
										<tr>
											<td width="20%" colspan="2" align="right"><b>Net Total:</b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
											<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
											<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
											<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
											<td width="10%" class="text-right"></td>
										</tr>
									</table>
									</td>
								</tr>
								</tbody>
								<tfoot id="inv">
									<tr>
										<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
									</tr>
								</tfoot>
							</table>
						<?php } else if($type=="item") { ?>
								<table border="0" style="width:100%;height:100%;">
										<thead>
											<tr>
												<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
											</tr>
											<tr>
												<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
											</tr>
											
										</thead>
										
										<tbody id="bod">
											<?php $nsptotal = $ndtotal = $nctotal = $nptotal = $npertotal = $nqty = 0; foreach($reports as $report) { ?>
											<tr>
												<td align="left" valign="top" style="padding-left:0px;">
													<h6><b>
													Item Name: <?php echo e($report[0]->item_name); ?></b></h6>
												</td>
												<td align="right" style="padding-left:0px;">
													<p></p>
												</td>
											</tr>
											
											<tr style="border:0px solid black;">
												<td colspan="2" align="center">
												<table border="0" style="width:100%;" class="tblstyle table-bordered">
													<tr>
														<td width="7%"><b>Inv.#</b></td>
														<td width="10%"><b>Inv. Date</b></td>
														<td width="15%"><b>Sup Name</b></td>
														<th width="8%">Qty.</th>
														<td width="10%" class="text-right"><b>Price</b></td>
														<td width="8%" class="text-right"><b>Discount</b></td>
														<td width="10%" class="text-right"><b>Vat.Amount</b></td>
														<td width="12%" class="text-right"><b>Net.Total</b></td>
														
													</tr>
													
													<?php 
														$sptotal = $dtotal = $ctotal = $ptotal = $pertotal = $peravg = $tcst = 0; $i=1;
														foreach($report as $row) { 
														$sprice =  $row->unit_price;  
														
														$pprice = $row->vat_amount; 
														$profit = $row->line_total; 
														$percentage = ($profit > 0 && $sprice > 0)?($profit / $sprice * 100):0;
														$sptotal += $sprice;
														$dtotal += $row->discount;
														//$ctotal += $cost;
														$ptotal += $profit;
														$pertotal += $percentage; $n = $i;$i++;
														$tcst += $pprice;
													?>
													<tr>
														<td ><?php echo e($row->voucher_no); ?></td>
														<td ><?php echo e(date('d-m-Y',strtotime($row->voucher_date))); ?></td>
														<td ><?php echo e($row->customer); ?></td>
														<td ><?php echo e($row->quantity); ?></td>
														<td  class="text-right"><?php echo e(number_format($sprice,2)); ?></td>
														<td  class="text-right"><?php echo e(number_format($row->discount,2)); ?></td>
														<td  class="text-right"><?php echo e(number_format($pprice,2)); ?></td>
														<td class="text-right"><?php echo e(number_format($profit,2)); ?></td>
														
													</tr>
												<?php } $peravg = $pertotal / $n; 
												        $nsptotal += $sptotal;
                										$ndtotal += $dtotal;
                										$nctotal += $tcst;
                										$nptotal += $ptotal;
												?>
												
												<tr>
													<td colspan="4" align="right"><b>Sub Total:</b></td>
													<td  class="text-right"><b><?php echo e(number_format($sptotal,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($dtotal,2)); ?></b></td>
													<td class="text-right"><b><?php echo e(number_format($tcst,2)); ?></b></td>
												<td  class="text-right"><b><?php echo e(number_format($ptotal,2)); ?></b></td> 
												
												</tr>
												
												</table>
												</td>
											</tr>
										  <?php } ?>
    										  <tr style="border:0px solid black;">
            									<td colspan="2" align="center"><br/>
            									<table border="0" style="width:100%;" class="tblstyle table-bordered">
            									
            										<tr>
            											<td width="40%" colspan="2" align="right"><b>Net Total:</b></td>
            											<td width="10%" class="text-right"><b><?php echo e(number_format($nsptotal,2)); ?></b></td>
            											<td width="8%" class="text-right"><b><?php echo e(number_format($ndtotal,2)); ?></b></td>
            											<td width="10%" class="text-right"><b><?php echo e(number_format($nctotal,2)); ?></b></td>
            											<td width="12%" class="text-right"><b><?php echo e(number_format($nptotal,2)); ?></b></td>
            											
            										</tr>
            									</table>
            									</td>
            								</tr>
										</tbody>
										<tfoot id="inv">
											<tr>
												<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
											</tr>
										</tfoot>
									</table>
									
						<?php } else if($type=="summary_pmode") { ?>
								<table border="0" style="width:100%;height:100%;">
										<thead>
											<tr>
												<td colspan="2" align="left"><?php echo $__env->make('main.print_head_text', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?><br/></td>
											</tr>
											<tr>
												<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
											</tr>
										</thead>
										<tbody id="bod">
											<tr style="border:0px solid black;">
												<td colspan="2" align="center">
												<table border="0" style="width:100%;" class="tblstyle table-bordered">
													<thead>
														<th>SI.No</th>
														<th>SI#</th>
														<th>Vchr.Date</th>
														<th>Customer Name</th>
														<th>TRN No.</th>
														<th>Salesman</th>
														<th class="text-right">Gross Amt.</th>
														<th class="text-right">Discount</th>
														<th class="text-right">VAT Amt.</th>
														<th class="text-right">Net Total</th>
													</thead>
													<body>
													
													<?php foreach($reports as $key => $report): ?>
													<?php  $nettotal=$netdiscount=$netvat_amount=$net_amount_total=0;  ?>
														<tr><td colspan="9"><b><?php echo e($report[0]->voucher_name); ?></b></td></tr>
														<?php foreach($report as $row): ?>
														<tr>
															<td><?php echo e(++$i); ?></td>
															<td><?php echo e($row->voucher_no); ?></td>
															<td><?php echo e(date('d-m-Y',strtotime($row->voucher_date))); ?></td>
															<td><?php echo e($row->master_name); ?></td>
															<td><?php echo e($row->vat_no); ?></td>
															<td><?php echo e($row->salesman); ?></td>
															<td class="text-right"><?php echo e(number_format(($row->discount > 0)?($row->subtotal+$row->discount):$row->subtotal,2)); ?></td>
															<td class="text-right"><?php echo e(number_format($row->discount,2)); ?></td>
															<td class="text-right"><?php echo e(number_format($row->vat_amount,2)); ?></td>
															<td class="text-right"><?php echo e(number_format($row->net_total,2)); ?></td>
														</tr>
														<?php $nettotal += ($row->discount > 0)?($row->subtotal+$row->discount):$row->subtotal;
															  $netdiscount += $row->discount;
															  $netvat_amount += $row->vat_amount;
															  $net_amount_total += $row->net_total;
														?>
														<?php endforeach; ?>
														<tr>
															<td></td>
															<td></td>
															<td></td>
															<td></td><td></td>
															<td><b>Total: </b></td>
															<td class="text-right"><b><?php echo e(number_format($nettotal,2)); ?></b></td>
															<td class="text-right"><b><?php echo e(number_format($netdiscount,2)); ?></b></td>
															<td class="text-right"><b><?php echo e(number_format($netvat_amount,2)); ?></b></td>
															<td class="text-right"><b><?php echo e(number_format($net_amount_total,2)); ?></b></td>
														</tr>
													<?php endforeach; ?>
													</body>
												</table>
												</td>
											</tr>
										</tbody>
										<tfoot id="inv">
											<tr>
												<td colspan="2" class="footer"><br/><?php echo $__env->make('main.print_foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?></td>
											</tr>
										</tfoot>
									</table>
						<?php } //end if ?>
						<?php } else { ?>
						<table border="0" style="width:100%;height:100%;">
							<thead>
								<tr>
									<td colspan="2" align="center"><b style="font-size:20px;"><?php echo e(Session::get('company')); ?></b>
									<!--<img src="<?php echo e(asset('assets/'.Session::get('logo').'')); ?>" width="900px;" />-->
									</td>
								</tr>
								<tr>
									<td colspan="2" align="center"><b style="font-size:16px;"><b><u><?php echo e($titles['subhead']); ?></u></b></b></td>
								</tr>
							</thead>
						</table>
						<br/>
						<div class="alert alert-danger">
							<ul>No records were found!</ul>
						</div>
						<?php } ?>
						</div>
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                              
								<span class="pull-right">
                                           
									 <button type="button" onclick="javascript:window.print();"
											 class="btn btn-responsive button-alignment btn-primary"
											 data-toggle="button">
										<span style="color:#fff;">
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
                    </div>
                        </div>
                    </div>
					
					<form class="form-horizontal" role="form" method="POST" name="frmExport" id="frmExport" action="<?php echo e(url('sales_invoice/export')); ?>">
					<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
					<input type="hidden" name="date_from" value="<?php echo e($fromdate); ?>" >
					<input type="hidden" name="date_to" value="<?php echo e($todate); ?>" >
					<input type="hidden" name="search_type" value="<?php echo e($type); ?>" >
					<input type="hidden" name="customer_id" value="<?php echo e($customer); ?>" >
					<input type="hidden" name="item_id" value="<?php echo e($item); ?>" >
					<input type="hidden" name="salesman" value="<?php echo e($salesman); ?>" >
					</form>
					
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
	//window.print();
});
</script>
</html>
