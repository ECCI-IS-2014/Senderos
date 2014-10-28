<!DOCTYPE html>
<html>
<body>
    <div class="users form">
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <legend><?php echo __('Category Addition'); ?></legend>
            <?php
                echo $this->Form->create('Category');
                echo $this->Form->input('id', array('type' => 'hidden'));
                echo $this->Form->input('name', array('label' => 'Nombre de la categoría:'));
                echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $categories, 'empty' => '(Sin categoría padre)', 'label' => 'Subcategoría de:'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Save')); ?>
    </div>

</body>
</html>



