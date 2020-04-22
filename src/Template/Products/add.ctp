<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product Categories'), ['controller' => 'ProductCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product Category'), ['controller' => 'ProductCategories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Goods Lines'), ['controller' => 'GoodsLines', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Goods Line'), ['controller' => 'GoodsLines', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product Images'), ['controller' => 'ProductImages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product Image'), ['controller' => 'ProductImages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Wholesale Rates'), ['controller' => 'WholesaleRates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Wholesale Rate'), ['controller' => 'WholesaleRates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="products form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Add Product') ?></legend>
        <?php
            echo $this->Form->control('brand_id', ['options' => $brands]);
            echo $this->Form->control('name');
            echo $this->Form->control('isretail');
            echo $this->Form->control('iswholesale');
            echo $this->Form->control('isstock');
            echo $this->Form->control('isactive');
            echo $this->Form->control('product_category_id', ['options' => $productCategories]);
            echo $this->Form->control('price');
            echo $this->Form->control('special_price');
            echo $this->Form->control('short_description');
            echo $this->Form->control('description');
            echo $this->Form->control('note');
            echo $this->Form->control('qty');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
