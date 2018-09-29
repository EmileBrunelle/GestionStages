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

            //echo $this->Form->control('customer_types._ids', ['options' => $Customer_types]);

            echo $this->Form->control('customer_types._ids', [
                'type' => 'select',
                'multiple' => 'checkbox',
                'options' => $Customer_types,
            ])


        /*
        $options = [];


        foreach($Customer_types as $Customer_type_id => $customer_type){
            $options += [$Customer_type_id => $customer_type];
        }


        echo $this->Form->select('Customer_types', $options, ['multiple' => 'checkbox']);
        */


            /*
            echo $this->Form->create('GroupType');
            foreach ($Customer_types as $Customer_type_id => $customer_type) {
                echo '<div class="checkbox">';
                    echo $this->Form->checkbox('Customer_type_id.', array('value'=> $Customer_type_id));
                    echo $customer_type;
                echo '</div>';
            }
            */


            /*
            debug($Customer_types);
            die();
            $iCpt = 1;
            foreach ($Customer_types as $Customer_type){

                echo '<input type="checkbox" name="customer_type_ck[]" value="" id="customer_type_ck'.$iCpt.'">';
                echo '<label for="customer_type_ck'.$iCpt.'">'.$Customer_type.'</label>';

                if ($iCpt % 2 == 0) {
                    echo '</br>';
                }
                $iCpt++;
            }
            echo $this->Form->control('environment_missions._ids', ['options' => $Environment_missions]);
            */
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
