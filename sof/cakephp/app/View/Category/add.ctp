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

<div id="container">
<body>
    <div class="usersform">
        <?php echo $this->Form->create('Cat'); ?>
        <fieldset>
            <legend><?php echo __('Añadir Categoría'); ?></legend>
            <?php
                echo $this->Form->create('Category');
                echo $this->Form->input('id', array('type' => 'hidden'));
                echo $this->Form->input('name', array('label' => 'Nombre:'));
                echo "<br>";
                echo "<br>";
                echo $this->Form->input('parent_id', array('type' => 'select', 'options' => $categories, 'empty' => 'Ninguna', 'label' => 'Categoría Padre:'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(__('Save')); ?>
    </div>
</body>
</html>