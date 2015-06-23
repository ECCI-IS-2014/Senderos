<?php foreach ($seltrails as $key => $value): ?>
<div class="checkbox">
<input type="checkbox" name="data[Restriction][trail_id][]" value="<?php echo $key;?>" id="RestrictionTrailId<?php echo $key;?>">
<label for="RestrictionTrailId<?php echo $key;?>">  <?php echo $value; ?>  </label>
</div>
<?php endforeach; ?>