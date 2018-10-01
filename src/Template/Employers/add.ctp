<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer $employer
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Employers'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['controller' => 'InternshipEnvironments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['controller' => 'InternshipEnvironments', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employers form large-9 medium-8 columns content">
    <?= $this->Form->create($employer) ?>
    <fieldset>
        <legend><?= __('Set a new employer profile') ?></legend>
        <?php
            echo $this->Form->hidden('id_user', ['default' => $id_user]);
            echo $this->Form->control('prefix');
            echo $this->Form->control('last_name');
            echo $this->Form->control('first_name');
            echo $this->Form->control('title');
            echo $this->Form->control('location');
            echo $this->Form->control('address');
            echo $this->Form->control('city');
            echo $this->Form->control('province');
            echo $this->Form->control('postal_code');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('extension');
            echo $this->Form->control('cellphone');
            echo $this->Form->control('fax');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
