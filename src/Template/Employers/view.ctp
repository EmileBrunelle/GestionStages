<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer $employer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employer'), ['action' => 'edit', $employer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employer'), ['action' => 'delete', $employer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['controller' => 'InternshipEnvironments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['controller' => 'InternshipEnvironments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employers view large-9 medium-8 columns content">
    <h3><?= h($employer->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Prefix') ?></th>
            <td><?= h($employer->prefix) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Last Name') ?></th>
            <td><?= h($employer->last_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('First Name') ?></th>
            <td><?= h($employer->first_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($employer->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Location') ?></th>
            <td><?= h($employer->location) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($employer->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($employer->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Province') ?></th>
            <td><?= h($employer->province) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Postal Code') ?></th>
            <td><?= h($employer->postal_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($employer->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($employer->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Extension') ?></th>
            <td><?= h($employer->extension) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cellphone') ?></th>
            <td><?= h($employer->cellphone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fax') ?></th>
            <td><?= h($employer->fax) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employer->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employer->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employer->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Internship Environments') ?></h4>
        <?php if (!empty($employer->internship_environments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Address') ?></th>
                <th scope="col"><?= __('City') ?></th>
                <th scope="col"><?= __('Province') ?></th>
                <th scope="col"><?= __('Postal Code') ?></th>
                <th scope="col"><?= __('Region') ?></th>
                <th scope="col"><?= __('Active') ?></th>
                <th scope="col"><?= __('Employer Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employer->internship_environments as $internshipEnvironments): ?>
            <tr>
                <td><?= h($internshipEnvironments->id) ?></td>
                <td><?= h($internshipEnvironments->name) ?></td>
                <td><?= h($internshipEnvironments->address) ?></td>
                <td><?= h($internshipEnvironments->city) ?></td>
                <td><?= h($internshipEnvironments->province) ?></td>
                <td><?= h($internshipEnvironments->postal_code) ?></td>
                <td><?= h($internshipEnvironments->region) ?></td>
                <td><?= h($internshipEnvironments->active) ?></td>
                <td><?= h($internshipEnvironments->employer_id) ?></td>
                <td><?= h($internshipEnvironments->created) ?></td>
                <td><?= h($internshipEnvironments->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'InternshipEnvironments', 'action' => 'view', $internshipEnvironments->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'InternshipEnvironments', 'action' => 'edit', $internshipEnvironments->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'InternshipEnvironments', 'action' => 'delete', $internshipEnvironments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internshipEnvironments->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
