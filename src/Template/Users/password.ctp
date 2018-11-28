<div class="users form">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Forgot Password'); ?></legend>
        <?= $this->Form->input('email', ['autofocus' => true, 'label' => 'Email address', 'required' => true]); ?>
    </fieldset>
    <?= $this->Form->button('Request reset email'); ?>
    <?= $this->Form->end(); ?>
</div>