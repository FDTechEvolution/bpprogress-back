<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Products'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Brands'), ['controller' => 'Brands', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Brand'), ['controller' => 'Brands', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product Categories'), ['controller' => 'ProductCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Category'), ['controller' => 'ProductCategories', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Goods Lines'), ['controller' => 'GoodsLines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Goods Line'), ['controller' => 'GoodsLines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product Images'), ['controller' => 'ProductImages', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Image'), ['controller' => 'ProductImages', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Wholesale Rates'), ['controller' => 'WholesaleRates', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Wholesale Rate'), ['controller' => 'WholesaleRates', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="products view large-9 medium-8 columns content">
    <h3><?= h($product->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= h($product->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Brand') ?></th>
            <td><?= $product->has('brand') ? $this->Html->link($product->brand->name, ['controller' => 'Brands', 'action' => 'view', $product->brand->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($product->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isretail') ?></th>
            <td><?= h($product->isretail) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Iswholesale') ?></th>
            <td><?= h($product->iswholesale) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isstock') ?></th>
            <td><?= h($product->isstock) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Isactive') ?></th>
            <td><?= h($product->isactive) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Product Category') ?></th>
            <td><?= $product->has('product_category') ? $this->Html->link($product->product_category->name, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Note') ?></th>
            <td><?= h($product->note) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Special Price') ?></th>
            <td><?= $this->Number->format($product->special_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qty') ?></th>
            <td><?= $this->Number->format($product->qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($product->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($product->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Short Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->short_description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($product->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Goods Lines') ?></h4>
        <?php if (!empty($product->goods_lines)): ?>
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
            <?php foreach ($product->goods_lines as $goodsLines): ?>
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
    <div class="related">
        <h4><?= __('Related Product Images') ?></h4>
        <?php if (!empty($product->product_images)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Image Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->product_images as $productImages): ?>
            <tr>
                <td><?= h($productImages->id) ?></td>
                <td><?= h($productImages->product_id) ?></td>
                <td><?= h($productImages->image_id) ?></td>
                <td><?= h($productImages->type) ?></td>
                <td><?= h($productImages->seq) ?></td>
                <td><?= h($productImages->created) ?></td>
                <td><?= h($productImages->modified) ?></td>
                <td><?= h($productImages->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'ProductImages', 'action' => 'view', $productImages->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductImages', 'action' => 'edit', $productImages->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductImages', 'action' => 'delete', $productImages->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productImages->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Wholesale Rates') ?></h4>
        <?php if (!empty($product->wholesale_rates)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Seq') ?></th>
                <th scope="col"><?= __('Startqty') ?></th>
                <th scope="col"><?= __('Endqty') ?></th>
                <th scope="col"><?= __('Price') ?></th>
                <th scope="col"><?= __('Product Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($product->wholesale_rates as $wholesaleRates): ?>
            <tr>
                <td><?= h($wholesaleRates->id) ?></td>
                <td><?= h($wholesaleRates->seq) ?></td>
                <td><?= h($wholesaleRates->startqty) ?></td>
                <td><?= h($wholesaleRates->endqty) ?></td>
                <td><?= h($wholesaleRates->price) ?></td>
                <td><?= h($wholesaleRates->product_id) ?></td>
                <td><?= h($wholesaleRates->created) ?></td>
                <td><?= h($wholesaleRates->modified) ?></td>
                <td><?= h($wholesaleRates->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'WholesaleRates', 'action' => 'view', $wholesaleRates->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'WholesaleRates', 'action' => 'edit', $wholesaleRates->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'WholesaleRates', 'action' => 'delete', $wholesaleRates->id], ['confirm' => __('Are you sure you want to delete # {0}?', $wholesaleRates->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
