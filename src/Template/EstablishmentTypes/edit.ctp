<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EstablishmentType $establishmentType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $establishmentType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $establishmentType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Establishment Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="establishmentTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($establishmentType) ?>
    <fieldset>
        <legend><?= __('Edit Establishment Type') ?></legend>
        <?php
            echo $this->Form->control('type');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
