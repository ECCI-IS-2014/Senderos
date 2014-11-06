<!DOCTYPE html>
<html>

<head>
    <style>

        #container
        {
            width:100%;
            font-family: Helvetica, Geneva, sans-serif;
            color: gray;
        }

        .usersform
        {
            width:50%;
            margin:0 auto;
            margin-top:2%;
            background-color: #fff;
            color: black;
            border:solid 1px #dcdcdc;
            padding:10px;
        }

        #registro input
        {
            float:right;
        }
    </style>
</head>

<body>

<div id="container">

    <div class="usersform">
    <?php echo $this->Form->create('Category'); ?>
        <fieldset id="registro">
            <legend><?php echo __('Editar Categoría'); ?></legend>
            <?php
                echo $this->Form->input('name',array('label' => 'Nombre nuevo:'));
                echo '<br><br>';
                echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $categories, 'empty' => 'None', 'label' => 'Categoría Padre:'));
                ?>
        </fieldset>
        <?php echo $this->Form->end(__('Guardar cambios')); ?>
    </div>
</div>

</body>
</html>