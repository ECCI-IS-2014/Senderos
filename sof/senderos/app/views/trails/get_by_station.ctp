

<?php

        foreach ($seltrails as $key => $value):
        if(in_array($key,$clients_per)){

?>
     <div class="checkbox">
     <input type="checkbox" name="data[Restriction][trail_id][]" value="<?php echo $key;?>" checked disabled id="RestrictionTrailId<?php echo $key;?>">
     <label for="RestrictionTrailId<?php echo $key;?>">  <?php echo $value; ?>  </label>
     </div>

<?php

        }else{
?>

        <div class="checkbox">
        <input type="checkbox" name="data[Restriction][trail_id][]" value="<?php echo $key;?>" id="RestrictionTrailId<?php echo $key;?>">
        <label for="RestrictionTrailId<?php echo $key;?>">  <?php echo $value; ?>  </label>
        </div>
<?php
        }
        endforeach;
?>

        <?php if(in_array(-1,$clients_per)){ ?>
         <div class="checkbox">
         <input type="checkbox" name="Station Permissions" value="-1" checked disabled id="RestrictionTrailId-1">
         <label for="RestrictionTrailId-1">  Station Permissions </label>
         </div>
         <?php } else{ ?>

         <div class="checkbox">
         <input type="checkbox" name="Station Permissions" value="-1" id="RestrictionTrailId-1">
         <label for="RestrictionTrailId-1">  Station Permissions </label>
         </div>
         <?php } ?>