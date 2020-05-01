<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Shop'), ['action' => 'edit', $shop->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Shop'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Shops'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Shop'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Orders'), ['controller' => 'Orders', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order'), ['controller' => 'Orders', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Warehouses'), ['controller' => 'Warehouses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Warehouse'), ['controller' => 'Warehouses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="shops view large-9 medium-8 columns content">
    <h3><?= h($shop->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($shop->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($shop->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($shop->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Username') ?></th>
            <td><?= h($shop->username) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($shop->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($shop->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($shop->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Orders') ?></h4>
        <?php if (!empty($shop->orders)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Docdate') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Totalamt') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shop->orders as $orders): ?>
            <tr>
                <td><?= h($orders->id) ?></td>
                <td><?= h($orders->shop_id) ?></td>
                <td><?= h($orders->user_id) ?></td>
                <td><?= h($orders->docdate) ?></td>
                <td><?= h($orders->status) ?></td>
                <td><?= h($orders->totalamt) ?></td>
                <td><?= h($orders->description) ?></td>
                <td><?= h($orders->created) ?></td>
                <td><?= h($orders->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Orders', 'action' => 'view', $orders->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Orders', 'action' => 'edit', $orders->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Orders', 'action' => 'delete', $orders->id], ['confirm' => __('Are you sure you want to delete # {0}?', $orders->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($shop->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Fullname') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?= __('Mobile') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Isverify') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shop->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->fullname) ?></td>
                <td><?= h($users->email) ?></td>
                <td><?= h($users->mobile) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->image_id) ?></td>
                <td><?= h($users->isactive) ?></td>
                <td><?= h($users->isverify) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->description) ?></td>
                <td><?= h($users->type) ?></td>
                <td><?= h($users->shop_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Warehouses') ?></h4>
        <?php if (!empty($shop->warehouses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Isactive') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Shop Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($shop->warehouses as $warehouses): ?>
            <tr>
                <td><?= h($warehouses->id) ?></td>
                <td><?= h($warehouses->name) ?></td>
                <td><?= h($warehouses->created) ?></td>
                <td><?= h($warehouses->modified) ?></td>
                <td><?= h($warehouses->isactive) ?></td>
                <td><?= h($warehouses->description) ?></td>
                <td><?= h($warehouses->shop_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Warehouses', 'action' => 'view', $warehouses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Warehouses', 'action' => 'edit', $warehouses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Warehouses', 'action' => 'delete', $warehouses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
