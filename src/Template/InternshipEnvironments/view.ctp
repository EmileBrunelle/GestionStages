<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InternshipEnvironment $internshipEnvironment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Internship Environment'), ['action' => 'edit', $internshipEnvironment->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Internship Environment'), ['action' => 'delete', $internshipEnvironment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internshipEnvironment->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employers'), ['controller' => 'Employers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employer'), ['controller' => 'Employers', 'action' => 'add']) ?> </li>
    </ul>
</nav>


    <div class="internshipEnvironments view large-9 medium-8 columns content">
        <h3><?= h($internshipEnvironment->name) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('Name') ?></th>
                <td><?= h($internshipEnvironment->name) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Address') ?></th>
                <td><?= h($internshipEnvironment->address) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('City') ?></th>
                <td><?= h($internshipEnvironment->city) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Province') ?></th>
                <td><?= h($internshipEnvironment->province) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Postal Code') ?></th>
                <td><?= h($internshipEnvironment->postal_code) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Region') ?></th>
                <td><?= h($internshipEnvironment->region) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Employer') ?></th>
                <td><?= $internshipEnvironment->has('employer') ? $this->Html->link($internshipEnvironment->employer->title, ['controller' => 'Employers', 'action' => 'view', $internshipEnvironment->employer->id]) : '' ?></td>
            </tr>

            <?php if ($roleuser === 'admin' || $roleuser === 'coordinator') {?>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($internshipEnvironment->id) ?></td>
            </tr>

            <tr>
                <th scope="row"><?= __('Active') ?></th>
                <td><?= $this->Number->format($internshipEnvironment->active) ?></td>
            </tr>

            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($internshipEnvironment->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($internshipEnvironment->modified) ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>


