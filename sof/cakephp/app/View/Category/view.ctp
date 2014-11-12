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

        .categoryform
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

<?php include("header.ctp");?>

<div id="container">
    <div class="categoryform">

    <br>
    <?php echo $this->Html->link('Volver',array('action'=>'index')); ?>

    <fieldset id="registro">
        <h3><?php echo "Información de la Categoría" ?></h3>

        <h1><?php echo "Nombre: ".h($category['Category']['name'])." "; ?></h1>
        <h1><?php
                if($category['Category']['parent_id'] != '')
                {
                    echo "Categoría Padre: ".h($parent['Category']['name'])." ";
                }
            ?>
        </h1>
            <h1><?php
                if($child != null)
                {
                    echo "Subcategorías: ";
                    foreach ($child as $children):
                        echo '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$children;
                    endforeach;
                }

            ?></h1>
        <?php unset($child); ?>
    </fieldset>
    </div>
</div>

</body>
</html>