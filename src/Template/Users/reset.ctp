<div class="users form">
    <?php echo $this->Form->create($user) ?>
    <fieldset>
        <legend><?php echo __('Reset Password') ?>
            <?= $this->Form->input('password', ['required' => true, 'autofocus' => true]); ?>
            <?= $this->Form->input('confirm_password', ['type' => 'password', 'required' => true]); ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end(); ?>
</div>