<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship $internship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Internship'), ['action' => 'edit', $internship->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Internship'), ['action' => 'delete', $internship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internship->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Internships'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['controller' => 'InternshipEnvironments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['controller' => 'InternshipEnvironments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="internships view large-9 medium-8 columns content">
    <h3><?= h($internship->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Internship Environment') ?></th>
            <td><?= $internship->has('internship_environment') ? $this->Html->link($internship->internship_environment->name, ['controller' => 'InternshipEnvironments', 'action' => 'view', $internship->internship_environment->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($internship->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CREATED') ?></th>
            <td><?= h($internship->CREATED) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('MODIFIED') ?></th>
            <td><?= h($internship->MODIFIED) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Position') ?></h4>
        <?= $this->Text->autoParagraph(h($internship->position)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($internship->description)); ?>
    </div>
</div>
