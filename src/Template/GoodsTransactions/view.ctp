<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoodsTransaction $goodsTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Goods Transaction'), ['action' => 'edit', $goodsTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Goods Transaction'), ['action' => 'delete', $goodsTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodsTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Goods Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Goods Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Goods Lines'), ['controller' => 'GoodsLines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Goods Line'), ['controller' => 'GoodsLines', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="goodsTransactions view large-9 medium-8 columns content">
    <h3><?= h($goodsTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($goodsTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Docno') ?></th>
            <td><?= h($goodsTransaction->docno) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $goodsTransaction->has('user') ? $this->Html->link($goodsTransaction->user->id, ['controller' => 'Users', 'action' => 'view', $goodsTransaction->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Warehouse') ?></th>
            <td><?= $goodsTransaction->has('warehouse') ? $this->Html->link($goodsTransaction->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $goodsTransaction->warehouse->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($goodsTransaction->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($goodsTransaction->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Docdate') ?></th>
            <td><?= h($goodsTransaction->docdate) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($goodsTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($goodsTransaction->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Goods Lines') ?></h4>
        <?php if (!empty($goodsTransaction->goods_lines)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Goods Transaction Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($goodsTransaction->goods_lines as $goodsLines): ?>
            <tr>
                <td><?= h($goodsLines->id) ?></td>
                <td><?= h($goodsLines->goods_transaction_id) ?></td>
                <td><?= h($goodsLines->product_id) ?></td>
                <td><?= h($goodsLines->qty) ?></td>
                <td><?= h($goodsLines->created) ?></td>
                <td><?= h($goodsLines->modified) ?></td>
                <td><?= h($goodsLines->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'GoodsLines', 'action' => 'view', $goodsLines->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'GoodsLines', 'action' => 'edit', $goodsLines->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'GoodsLines', 'action' => 'delete', $goodsLines->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodsLines->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
