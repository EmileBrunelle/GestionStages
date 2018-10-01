<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer[]|\Cake\Collection\CollectionInterface $employers
 */
?>

<?php if ($isAdmin) { ?>
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('New Employer'), ['action' => 'add']) ?></li>
            <li><?= $this->Html->link(__('List Internship Environments'), ['controller' => 'InternshipEnvironments', 'action' => 'index']) ?></li>
            <li><?= $this->Html->link(__('New Internship Environment'), ['controller' => 'InternshipEnvironments', 'action' => 'add']) ?></li>
        </ul>
    </nav>
    <div class="employers index large-9 medium-8 columns content">
        <h3><?= __('Employers') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('id_user') ?></th>
                <th scope="col"><?= $this->Paginator->sort('prefix') ?></th>
                <th scope="col"><?= $this->Paginator->sort('last_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('first_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('location') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('province') ?></th>
                <th scope="col"><?= $this->Paginator->sort('postal_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('extension') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cellphone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fax') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($employers as $employer): ?>
                <tr>
                    <td><?= $this->Number->format($employer->id) ?></td>
                    <td><?= $this->Number->format($employer->id_user) ?></td>
                    <td><?= h($employer->prefix) ?></td>
                    <td><?= h($employer->last_name) ?></td>
                    <td><?= h($employer->first_name) ?></td>
                    <td><?= h($employer->title) ?></td>
                    <td><?= h($employer->location) ?></td>
                    <td><?= h($employer->address) ?></td>
                    <td><?= h($employer->city) ?></td>
                    <td><?= h($employer->province) ?></td>
                    <td><?= h($employer->postal_code) ?></td>
                    <td><?= h($employer->email) ?></td>
                    <td><?= h($employer->phone) ?></td>
                    <td><?= h($employer->extension) ?></td>
                    <td><?= h($employer->cellphone) ?></td>
                    <td><?= h($employer->fax) ?></td>
                    <td><?= h($employer->created) ?></td>
                    <td><?= h($employer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $employer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employer->id)]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
<?php } ?>



<?php if ($requiresProfile) { ?>
    <div class="row">
        <h3>No employer profile</h3>
    </div>

    <div class="row">
        <?= $this->Html->link(__('Please create a new employer profile'), ['controller' => 'Employers', 'action' => 'add']); ?>
    </div>
<?php } ?>


