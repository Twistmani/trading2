					<div class="panel panel-success filterable" id="newCustomerList">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-columns"></i> Account List
                            </h3>
                        </div>
						
                        <div class="panel-body">
                            
                                <table class="table horizontal_table table-striped" id="tableCustList">
                                    <thead>
                                    <tr>
                                        <th>Account ID</th>
                                        <th>Account Name</th>
                                        <th>Balance</th>
                                        <th>Open Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($account as $customer): ?>
                                    <tr>
                                        <td><a href="" class="custRow" data-id="<?php echo e($customer->id); ?>" data-name="<?php echo e($customer->master_name); ?>" data-clbalance="<?php echo e(number_format($customer->cl_balance,2)); ?>" data-pdc="<?php echo e(number_format($customer->pdc_amount,2)); ?>" data-crlimit="<?php echo e(number_format($customer->credit_limit,2)); ?>" data-groupid="<?php echo e($customer->account_group_id); ?>" data-trnno="<?php echo e($customer->vat_no); ?>" data-group="<?php echo e($customer->category); ?>" data-term="<?php echo e($customer->terms_id); ?>" data-dismiss="modal"><?php echo e($customer->account_id); ?></a></td>
                                        <td><a href="" class="custRow" data-id="<?php echo e($customer->id); ?>" data-name="<?php echo e($customer->master_name); ?>" data-clbalance="<?php echo e(number_format($customer->cl_balance,2)); ?>" data-pdc="<?php echo e(number_format($customer->pdc_amount,2)); ?>" data-crlimit="<?php echo e(number_format($customer->credit_limit,2)); ?>" data-groupid="<?php echo e($customer->account_group_id); ?>" data-trnno="<?php echo e($customer->vat_no); ?>" data-group="<?php echo e($customer->category); ?>" data-term="<?php echo e($customer->terms_id); ?>" data-dismiss="modal"><?php echo e($customer->master_name); ?></a></td>
                                        <td><?php echo e(number_format($customer->cl_balance, 2, '.', ',')); ?></td>
                                        <td><?php echo e(number_format($customer->op_balance, 2, '.', ',')); ?></td>
                                    </tr>
                                   <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
							
                        </div>
                    </div>
					
<script>

$(function() {
            
		

$(function() {
	
		
	var inputMapper = {
		"name": 1,
		"position": 2,
		"office": 3,
		"age": 4
	};
	var dtInstance = $("#tableCustList").DataTable({
		"lengthMenu": [10, 25, 50, "ALL"],
		bLengthChange: false,
		mark: true
	});
	/*$("input").on("input", function() {
		var $this = $(this);
		var val = $this.val();
		var key = $this.attr("name");
		dtInstance.columns(inputMapper[key] - 1).search(val).draw();
	});*/
});
</script>