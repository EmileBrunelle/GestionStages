<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\EnvironmentMission $environmentMission
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Environment Mission'), ['action' => 'edit', $environmentMission->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Environment Mission'), ['action' => 'delete', $environmentMission->id], ['confirm' => __('Are you sure you want to delete # {0}?', $environmentMission->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Environment Missions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Environment Mission'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="environmentMissions view large-9 medium-8 columns content">
    <h3><?= h($environmentMission->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Missions') ?></th>
            <td><?= h($environmentMission->missions) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($environmentMission->id) ?></td>
        </tr>
    </table>
</div>
