<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Internship $internship
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Internship'), ['action' => 'edit', $internship->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Internship'), ['action' => 'delete', $internship->id], ['confirm' => __('Are you sure you want to delete # {0}?', $internship->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Internships'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Internship Environments'), ['controller' => 'InternshipEnvironments', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Internship Environment'), ['controller' => 'InternshipEnvironments', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="internships view large-9 medium-8 columns content">
    <h3>Internship description</h3>

    <div class="row">
        <h4><?= __('Position') ?></h4>
        <?= $this->Text->autoParagraph(h($internship->position)); ?>
    </div>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($internship->description)); ?>
    </div>
    <div class="row">
        <h4><?= __('Internship Environment') ?></h4>
        <?= $internship->has('internship_environment') ? $this->Html->link($internship->internship_environment->name,
            ['controller' => 'InternshipEnvironments', 'action' => 'view', $internship->internship_environment->id]) : '' ?>
    </div>
    <div class="row">
        <h4><?= __('Contact name') ?></h4>
        <?= $this->Text->autoParagraph(h($employer->first_name . ' ' . $employer->last_name)); ?>
    </div>

    <div class="row">
        <h4><?= __('Phone number') ?></h4>
        <?= $this->Text->autoParagraph(h($employer->phone)); ?>
    </div>

    <div class="row">
        <h4><?= __('Email address') ?></h4>
        <?= $this->Text->autoParagraph(h($employer->email)); ?>
    </div>

    <?php
        $loguser = $this->request->getSession()->read('Auth.User');
        $roleuser = $loguser['role'];
    ?>
    
    <?php if ($roleuser === 'student') { ?>
    <div class="row">
        <?= $this->Form->create($internship, ['url' => ['action' => 'application']]) ?>
        <fieldset>
            <?php
            echo $this->Form->hidden('id');
            ?>
        </fieldset>
        <?= $this->Form->button(__('Submit your application')) ?>
        <?= $this->Form->end() ?>
    </div>
    <?php } ?>

    <?php if ($roleuser === 'employer') { ?>
        <div class="related">

            <h4><?= __('Students who applied') ?></h4>

            <?php foreach ($internship->students as $internship_student): ?>
                <?= h('• ' . $internship_student->first_name . ' '.  $internship_student->last_name) . ' - '?>
                <?= $this->Html->link(__('Send email to notify'), ['controller' => 'emails', 'action' => 'notifyStudent', '?' =>['sid' => $internship_student->id, 'eid' => $employer->id]]) ?>
                <br/>
            <?php endforeach; ?>

        </div>
    <?php } ?>

</div>
