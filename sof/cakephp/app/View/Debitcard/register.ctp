<?php echo $this->Form->create('Debitcard'); ?>
    <fieldset>
            <legend><?php echo __('Registrar tarjeta'); ?></legend>
            <?php
                echo $this->Form->input('card_number',array('title' => 'Número de tarjeta', 'label' => 'Número de tarjeta '));
                echo "<br><br>";
                echo $this->Form->input('csc',array('title' => 'Código de seguridad', 'label' => 'Código de seguridad '));
                echo "<br><br>";
            ?>
    </fieldset>
<?php echo $this->Form->end(__('Registrar')); ?>