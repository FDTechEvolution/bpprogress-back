<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\GoodsTransaction $goodsTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $goodsTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $goodsTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Goods Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Goods Lines'), ['controller' => 'GoodsLines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Goods Line'), ['controller' => 'GoodsLines', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="goodsTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($goodsTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Goods Transaction') ?></legend>
        <?php
            echo $this->Form->control('docdate');
            echo $this->Form->control('docno');
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('warehouse_id', ['options' => $warehouses]);
            echo $this->Form->control('type');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
