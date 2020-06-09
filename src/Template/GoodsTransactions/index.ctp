<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoodsTransaction[]|\Cake\Collection\CollectionInterface $goodsTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Goods Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Goods Lines'), ['controller' => 'GoodsLines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Goods Line'), ['controller' => 'GoodsLines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="goodsTransactions index large-9 medium-8 columns content">
    <h3><?= __('Goods Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('docdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('docno') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('warehouse_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($goodsTransactions as $goodsTransaction): ?>
            <tr>
                <td><?= h($goodsTransaction->id) ?></td>
                <td><?= h($goodsTransaction->docdate) ?></td>
                <td><?= h($goodsTransaction->docno) ?></td>
                <td><?= $goodsTransaction->has('user') ? $this->Html->link($goodsTransaction->user->id, ['controller' => 'Users', 'action' => 'view', $goodsTransaction->user->id]) : '' ?></td>
                <td><?= $goodsTransaction->has('warehouse') ? $this->Html->link($goodsTransaction->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $goodsTransaction->warehouse->id]) : '' ?></td>
                <td><?= h($goodsTransaction->type) ?></td>
                <td><?= h($goodsTransaction->description) ?></td>
                <td><?= h($goodsTransaction->created) ?></td>
                <td><?= h($goodsTransaction->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $goodsTransaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $goodsTransaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $goodsTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $goodsTransaction->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
