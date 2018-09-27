<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InternshipEnvironment $internshipEnvironment
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employers'), ['controller' => 'Employers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employer'), ['controller' => 'Employers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="internshipEnvironments form large-9 medium-8 columns content">
    <?= $this->Form->create($internshipEnvironment) ?>
    <fieldset>
        <legend><?= __('Add Internship Environment') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('address');
            echo $this->Form->control('city');
            echo $this->Form->control('province');
            echo $this->Form->control('postal_code');
            echo $this->Form->control('region');
            echo $this->Form->control('active');
            echo $this->Form->control('employer_id', ['options' => $employers]);
            echo $this->Form->control('type_id', ['options' => $Establishment_types]);
            echo $this->Form->control('customer_types._ids', ['options' => $Customer_types]);
            echo $this->Form->control('environment_missions._ids', ['options' => $Environment_missions]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
