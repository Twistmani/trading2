<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success filterable">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw fa-columns"></i> Account List
                            </h3>
                        </div>
                        <div class="panel-body">
							<?php if(count($accounts) === 0): ?>
								<div class="row">&nbsp; Invalid Voucher type! Please select a Voucher type.</div>
							<?php else: ?>
                            <div class="table-responsive m-t-10">
                                <table class="table horizontal_table table-striped" id="table5">
                                    <thead>
                                    <tr>
                                        <th>Account ID</th>
                                        <th>Account Name</th>
                                        <th>Category</th>
                                        <th>Balance</th>
                                        <th>Open Balance</th>
                                    </tr>
                                    </thead>
									<input type="hidden" name="num" id="num" value="<?php echo e($num); ?>">
                                    <tbody>
									<?php foreach($accounts as $account): ?>
                                    <tr>
                                        <td><a href="" class="accountRow" data-id="<?php echo e($account->id); ?>" data-group="<?php echo e($account->category); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" data-vatassign="<?php echo e($account->vat_assign); ?>" data-dismiss="modal" <?php if($num!=null) { ?>onclick="selectAccount(this)"<?php } ?>><?php echo e($account->account_id); ?></a></td>
                                        <td><a href="" class="accountRow" data-id="<?php echo e($account->id); ?>" data-group="<?php echo e($account->category); ?>" data-code="<?php echo e($account->account_id); ?>" data-name="<?php echo e($account->master_name); ?>" data-vatassign="<?php echo e($account->vat_assign); ?>" data-dismiss="modal" <?php if($num!=null) { ?>onclick="selectAccount(this)"<?php } ?>><?php echo e($account->master_name); ?></a></td>
                                        <td><?php echo e($account->category); ?></td>
                                        <td><?php echo e(number_format($account->cl_balance, 2, '.', ',')); ?></td>
                                        <td><?php echo e(number_format($account->op_balance, 2, '.', ',')); ?></td>
                                    </tr>
                                   <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

<script>
<?php if($num!=null) { ?>
function selectAccount(e) { 
	
	 if (window.opener != null && !window.opener.closed) { 
	 
		var no = window.opener.document.getElementById("num").value;
		var account = window.opener.document.getElementById("draccount_"+no);
		account.value = $(e).data('name');
		
		var id = window.opener.document.getElementById("draccountid_"+no);
		id.value = $(e).data('id');
		window.close();
	}
	
}
<?php } ?>
</script>