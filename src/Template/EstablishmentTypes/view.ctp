<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EstablishmentType $establishmentType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Establishment Type'), ['action' => 'edit', $establishmentType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Establishment Type'), ['action' => 'delete', $establishmentType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $establishmentType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Establishment Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Establishment Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="establishmentTypes view large-9 medium-8 columns content">
    <h3><?= h($establishmentType->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= h($establishmentType->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($establishmentType->id) ?></td>
        </tr>
    </table>
</div>
