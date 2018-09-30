<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InternshipEnvironment[]|\Cake\Collection\CollectionInterface $internshipEnvironments
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employers'), ['controller' => 'Employers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employer'), ['controller' => 'Employers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="internshipEnvironments index large-9 medium-8 columns content">
    <h3><?= __('Internship Environments') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postal_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('region') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employer_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($internshipEnvironments as $internshipEnvironment): ?>
            <tr>
                <td><?= h($internshipEnvironment->name) ?></td>
                <td><?= h($internshipEnvironment->address) ?></td>
                <td><?= h($internshipEnvironment->city) ?></td>
                <td><?= h($internshipEnvironment->province) ?></td>
                <td><?= h($internshipEnvironment->postal_code) ?></td>
                <td><?= h($internshipEnvironment->region) ?></td>
                <td><?= $this->Number->format($internshipEnvironment->active) ?></td>
                <td><?= $internshipEnvironment->has('employer') ? $this->Html->link($internshipEnvironment->employer->title, ['controller' => 'Employers', 'action' => 'view', $internshipEnvironment->employer->id]) : '' ?></td>
                <td><?= h($internshipEnvironment->created) ?></td>
                <td><?= h($internshipEnvironment->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $internshipEnvironment->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $internshipEnvironment->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $internshipEnvironment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internshipEnvironment->id)]) ?>
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
