<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CustomerType $customerType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Customer Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="customerTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($customerType) ?>
    <fieldset>
        <legend><?= __('Add Customer Type') ?></legend>
        <?php
            echo $this->Form->control('types');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
