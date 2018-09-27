<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnvironmentMission $environmentMission
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $environmentMission->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $environmentMission->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Environment Missions'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="environmentMissions form large-9 medium-8 columns content">
    <?= $this->Form->create($environmentMission) ?>
    <fieldset>
        <legend><?= __('Edit Environment Mission') ?></legend>
        <?php
            echo $this->Form->control('missions');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
