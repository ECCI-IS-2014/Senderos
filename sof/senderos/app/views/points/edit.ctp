<?php if($edit_stat==1){ ?>
<?php echo $html->css('pointscss'); ?>
<?php echo $html->css('menu7'); ?>
<?php echo $html->css('documentscss'); ?>
<?php echo $html->css("slider"); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("points"); ?>
<?php echo $html->script("slider"); ?>


<script> var currdiam = 'none'; var currback = 'none'; var currfont = 'none'; </script>

<script>

function validateCoords(textinput)
{
	var newchar = textinput.value[textinput.value.length - 1];

	if(undefined != newchar)
	{
		if(isNaN(newchar))
			textinput.value = textinput.value.substring(0, textinput.value.length-1);

		if(newchar == '-' && textinput.value.length == 0)
		{
			textinput.value = '-' + textinput.value;
			//textinput.value = textinput.value.replace(/-/g,'');
		}
		if(newchar == '.')
		{
			if(textinput.value.split(newchar).length == 1 && textinput.value.length > 1)
				textinput.value = textinput.value + '.';
		}
	}
	
}

</script>


<div id="save_point" style="display:block;padding-left:25%;">
	<div class="points form" style="width: 50%;">
		<?php echo $this->Form->create('Point');?>
			<fieldset>
				<legend><?php __('Save Point'); ?></legend>
			<?php

				echo $this->Form->input('id');

				echo $this->Form->input('pnumber',  array("onkeyup" => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"));
				echo $this->Form->input('name');
				echo $this->Form->input('cordx', array("onkeyup" => "validateCoords(this)"));
				echo $this->Form->input('cordy', array("onkeyup" => "validateCoords(this)"));
				echo $this->Form->input('description');
				//echo $this->Form->input('trail_id');
				echo "<div style='display:none'>".$this->Form->input('trail_id',array('value' => 'hidden'))."</div>";
				/*echo "<div class='input text required'>\n
	    				
	    				<input id='PointTrailId' type='hidden' value='".$trail['Trail']['id']."' maxlength='100' name='data[Point][trail_id]'></input>\n
					</div>\n";*/
				echo $this->Form->input('px_x',array('type' => 'hidden'));
				echo $this->Form->input('px_y',array('type' => 'hidden'));

				echo $this->Form->input('style',array('type' => 'hidden'));

			?>


<script>

function setselects(select)
	{
		if(select == 1)
		{
			//document.getElementById('diameter').value = currdiam;
			//diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			currdiam = document.getElementById('diameter').value;
			background= "background-color: "+currback+";";
			font= "color: "+currfont+";";
		}
		if(select == 2)
		{
			//document.getElementById('background').value = currdiam;
			diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			currback = document.getElementById('background').value;
			font= "color: "+currfont+";";
		}
		if(select == 3)
		{
			//document.getElementById('font').value = currdiam;
			diameter = "width: "+currdiam+"px; height: "+currdiam+"px;";
			background= "background-color: "+currback+";";
			currfont = document.getElementById('font').value;
		}

		document.getElementById('PointStyle').value = diameter+background+font+centerit;
	}


</script>


			<div style="text-align:left;">Style:
			<div id="pointstyling" >
				<div id="thepoint" class="point" >#
				</div> <!-- the point -->
				<div id="stylechooser" >
					Diameter:<br>
					<select id='diameter' onchange="stylepoint(this, 'diameter'); setselects(1);">
						<option value='25' selected disabled>Choose diameter</option>
						<option value='10'>10</option>
						<option value='15'>15</option>
						<option value='20'>20</option>
						<option value='25'>25</option>
						<option value='30'>30</option>
						<option value='35'>35</option>
						<option value='40'>40</option>
						<option value='45'>45</option>
						<option value='50'>50</option>
					</select><br>


					Background color:<br>
					<select id='background' onchange="stylepoint(this, 'background'); setselects(2);">
						<option value='green' selected disabled>Choose background</option>
						<option value='green'>Green</option>
						<option value='blue'>Blue</option>
						<option value='violet'>Violet</option>
						<option value='red'>Red</option>
						<option value='pink'>Pink</option>
						<option value='white'>White</option>
						<option value='gray'>Gray</option>
						<option value='black'>Black</option>
						<option value='yellow'>Yellow</option>
						<option value='orange'>Orange</option>
						<option value='brown'>Brown</option>
					</select><br>
					Font color:<br>
					<select id='font' onchange="stylepoint(this, 'font'); setselects(3);">
						<option value='white' selected disabled>Choose font color</option>
						<option value='green'>Green</option>
						<option value='blue'>Blue</option>
						<option value='violet'>Violet</option>
						<option value='red'>Red</option>
						<option value='pink'>Pink</option>
						<option value='white'>White</option>
						<option value='gray'>Gray</option>
						<option value='black'>Black</option>
						<option value='yellow'>Yellow</option>
						<option value='orange'>Orange</option>
						<option value='brown'>Brown</option>
					</select>
				</div> <!-- stylechooser -->
			</div> <!-- point styling -->
			</div>

			<?php if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted'){ ?>
			<div class="submit">
			<input id="savePoint" type="submit" value="Submit" onclick="editThis(<?php echo $this->data['Point']['id']; ?>);" style="border: 0px solid #2D6324; padding: 4px 8px;"></input>
			<input type="submit" value="Cancel" onclick="window.location.href = window.history.back(1);" style="border: 0px solid #2D6324; padding: 4px 8px;"></input>
		    </div>
		    
		    <?php } ?>
		    

			</fieldset>
		<!--<?php 
				if($_SESSION['role'] === 'administrator' || $_SESSION['role'] === 'restricted')
					echo $this->Form->end(__('Submit', true));
				?>-->
		    

		</form>

	</div><!-- points form -->

</div> <!-- save_point -->



<script>

function editThis(point_id)
{
	if(window.XMLHttpRequest)
		ajax = new XMLHttpRequest()
	else
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	
	ajax.open("POST","/senderos/points/savepoint",true);

	ajax.onreadystatechange=function(){
		if(ajax.readyState==4)
		{
			alert(ajax.responseText);

			window.location = "/senderos/points";

			ret=false;
		}
	}
	
	ajax.send(new FormData(document.getElementById("PointEditForm")));
}


//setcurrent('PointStyle');

</script>



<?php


/*echo "<script>";

echo "prepareEditPoint('".$this->data['Point']['id']."')";

echo "</script>";*/


?>




<script>

window.onload = function() {

	//alert(document.getElementById('PointStyle').value);
	//setcurrent('PointStyle');

	document.getElementById('thepoint').style = document.getElementById('PointStyle').value;

	var point_style = document.getElementById('PointStyle').value.split(';');

		currdiam = point_style[1].split(':')[1];
		currdiam = currdiam.replace('px','');
		currdiam = currdiam.replace(' ','');
		currback = point_style[2].split(':')[1];
		currback = currback.replace(' ','');
		currfont = point_style[3].split(':')[1];
		currfont = currfont.replace(' ','');

	/*var point_style = document.getElementById('PointStyle').value.split(';');

		currdiam = point_style[1].split(':')[1];
		currdiam = currdiam.replace('px','');
		currdiam = currdiam.replace(' ','');
		currback = point_style[2].split(':')[1];
		currback = currback.replace(' ','');
		currfont = point_style[3].split(':')[1];
		currfont = currfont.replace(' ','');*/
};

</script>
<?php }?>