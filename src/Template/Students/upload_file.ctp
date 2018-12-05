<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $student->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $student->id)]
            )
            ?></li>
        <li><?= $this->Html->link(__('List Students'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="students form large-9 medium-8 columns content">
    <?= $this->Form->create($student, ['type' => 'file']) ?>
    <fieldset>
        <legend><?= __('Upload file') ?></legend>
        <?php
        echo $this->Form->control('file', ['type' => 'file']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
