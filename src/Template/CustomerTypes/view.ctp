<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerType $customerType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Customer Type'), ['action' => 'edit', $customerType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer Type'), ['action' => 'delete', $customerType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customerType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customer Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="customerTypes view large-9 medium-8 columns content">
    <h3><?= h($customerType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Types') ?></th>
            <td><?= h($customerType->types) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($customerType->id) ?></td>
        </tr>
    </table>
</div>
