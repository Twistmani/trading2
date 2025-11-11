<table class="table horizontal_table" id="batchTable">
    <thead>
    <tr>
        <th>Batch No</th>
        <th>Mfg. Date</th>
        <th>Exp. Date</th>
        <th>Qty.</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($batches as $key => $item): ?>
    <tr>
        <td class="btno"><?php echo e($item->batch_no); ?></td>
        <td class="mfdt"><?php echo e(date('d-m-Y',strtotime($item->mfg_date))); ?></td>
        <td class="exdt"><?php echo e(date('d-m-Y',strtotime($item->exp_date))); ?></td>
        <td class="bqty"><?php echo e($item->quantity); ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
