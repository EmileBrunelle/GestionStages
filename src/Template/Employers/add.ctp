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
            if ($role_user === 'employer') {
                echo $this->Form->hidden('id_user', ['default' => $id_user]);
            } else {
                echo $this->Form->hidden('id_user', ['default' => null]);
            }

            echo $this->Form->control('prefix', ['type' => 'text']);
            echo $this->Form->control('last_name', ['type' => 'text']);
            echo $this->Form->control('first_name', ['type' => 'text']);
            echo $this->Form->control('title', ['type' => 'text']);
            echo $this->Form->control('location', ['type' => 'text']);
            echo $this->Form->control('address', ['type' => 'text']);
            echo $this->Form->control('city', ['type' => 'text']);
            echo $this->Form->control('province', ['type' => 'text']);
            echo $this->Form->control('postal_code', ['type' => 'text']);
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('extension', ['type' => 'text']);
            echo $this->Form->control('cellphone', ['type' => 'text']);
            echo $this->Form->control('fax', ['type' => 'text']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
