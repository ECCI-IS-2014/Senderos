<?php echo $html->css('map'); ?>
<?php echo $html->css("slider"); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("map"); ?>
<?php echo $html->script("slider"); ?>

<div id="bodycontent">

	<div id="leftdiv">
		<p><h1><?php echo $trail['Station']['name']; ?></h1></p>
		<p><h2><?php echo $trail['Trail']['name']; ?></h2></p>
		<p><?php echo $trail['Trail']['description']; ?></p>
	</div> <!-- leftdiv container -->

	<div id="centraldiv">

		<!--<div id="mapcontainer" class="draggablecontainer" >-->
		<div id="mapcontainer" style="position:relative;border:1px solid black;width:95%;height:700px;overflow:hidden;">

			<!--<div id="maplayer" class="draggablediv" style="background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>');" >
			</div> <!-- maplayer div -->
			<div id="maplayer" style="width:1024px;height:1024px;top:0px;left:0px;position:absolute;cursor: default; background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>'); background-size: 1024px 1024px;" ></div>
			
			<!--<div id="pointslayer" class="draggablediv2">-->
			<div id="pointslayer" style="position: absolute;height: 1024px;width: 1024px; background-size: 1024px 1024px;pointer-events: none;">
				<?php foreach ($trail['Point'] as $point): ?>

					<!-- point_{point_id} -->
					<!--<div id="point_<?php echo $point['id']; ?>" class="marker" style="top: <?php echo $point['px_y']; ?>px; left: <?php echo $point['px_x']; ?>px;" onmouseover="InfoOptions(<?php echo $point['id']; ?>);">
					</div> <!-- point_{point_id} -->
					<div id="point_<?php echo $point['id']; ?>" class="point" style="position: absolute;top: <?php echo $point['px_y']; ?>px; left: <?php echo $point['px_x']; ?>px; pointer-events: all; cursor: pointer; <?php echo $point['style']; ?>" onmouseover="InfoOptions(<?php echo $point['id']; ?>);"><?php echo $point['pnumber']; ?></div><!-- /point_ -->

					<!-- label_{point_id} -->
					<!--<div id="label_<?php echo $point['id']; ?>" class="markerlabel" style="top: <?php echo ($point['px_y']-5); ?>px; left: <?php if(($point['pnumber'] * 1) < 10) echo ($point['px_x']-15); else echo ($point['px_x']-25); ?>px;">
					<?php echo $point['pnumber']; ?>
					</div> <!-- label_{point_id} -->
					<!-- labels -->
			<!--<div id="label_<?php echo $point['id']; ?>" class="pointlabel" style="position: absolute;top: <?php echo ($point['px_y']-5); ?>px; left: <?php if(($point['pnumber'] * 1) < 10) echo ($point['px_x']-15); else echo ($point['px_x']-25); ?>px; pointer-events: none;"><?php echo $point['pnumber']; ?></div><!-- /labels -->

					<?php
						echo "<script type='text/javascript'>";
						echo "var newmarker = document.getElementById('point_".$point['id']."');";
						echo "newmarker.addEventListener('contextmenu', function(evt) {evt.preventDefault();}, false);";
						echo "</script>";
					?>

				<?php endforeach; ?>

			</div> <!-- pointslayer div -->

		</div> <!-- mapcontainer div -->

		<div id="popupmenu" style="z-index:100; position:absolute; display: none;" onmouseleave="popupmenu.style.display = 'none';">
		</div> <!-- popupmenu div -->

		

		<div id="axis" style="display:none;">
			<table>
				<tr><td>img x</td><td>img y</td><td>abs x</td><td>abs y</td></tr>
				<tr>
					<td><span id="imgx"></span></td>
					<td><span id="imgy"></span></td>
					<td><span id="absx"></span></td>
					<td><span id="absy"></span></td>
				</tr>
			</table>
			<div id="left"></div>
			<div id="top"></div>
		</div> <!-- axis div -->

		<select id='zooming' onchange="zoomings (this);" style="height:20px; font-size: 15px; color: white; background-color:rgb(80,80,80);">
			<option value="100%" selected>100%</option>
			<option value="150%">150%</option>
			<option value="200%">200%</option>
			<option value="250%">250%</option>
			<option value="300%">300%</option>
		</select>


		<div id="popupdiv" class="ontop">
			<div id="popup">
				<a style="cursor: pointer;" onClick="hide('popupdiv')">Close</a>
				<div id="popupcontent" >
				</div> <!-- popupcontent -->
			</div> <!-- popup -->
		</div> <!-- popupinfo div -->


		<script type="text/javascript">
			draggablediv = document.getElementById("maplayer");
			draggablediv2 = document.getElementById("pointslayer");
			imgx = document.getElementById("imgx");
			imgy = document.getElementById("imgy");
			absx = document.getElementById("absx");
			absy = document.getElementById("absy");
			popupmenu = document.getElementById("popupmenu");
			popupdiv = document.getElementById("popupdiv");
			popupcontent = document.getElementById("popupcontent");

			draggablediv.addEventListener('contextmenu', function(evt) {evt.preventDefault();}, false);
			draggablediv.onmousedown = function(){moused = 1;};
			draggablediv.onmouseup= MapAction;
			draggablediv.onmousemove= SetPointer;

			leftEdge = draggablediv.parentNode.clientWidth - draggablediv.clientWidth;
        		topEdge = draggablediv.parentNode.clientHeight - draggablediv.clientHeight;
        		dragObj = new dragObject(draggablediv, null, new Position(leftEdge, topEdge), new Position(0, 0));
		</script>


	</div> <!-- centraldiv container -->

	<div id="rightdiv">
		<div id="accordeon">
			<?php foreach($stations as $station): ?>

				<div id="station_<?php echo $station['Station']['id']?>" class="stationitem" onclick="document.getElementById('station_<?php echo $station['Station']['id']?>_trails').style.display = !document.getElementById('station_<?php echo $station['Station']['id']?>_trails').style.display? 'none': '';">
					<!--<div style="float:left;">-->
					<?php echo $this->Html->link($station['Station']['name'], array('controller' => 'stations', 'action' => 'view', $station['Station']['id'])); ?>

					<div id="station_<?php echo $station['Station']['id']?>_arrow" class="menuarrow" onclick="this.innerHTML = (this.innerHTML=='&#x25B2;')? '&#x25BC;': '&#x25B2;';">
					&#x25BC;</div>

				</div> <!-- station_{}-->

				<div id="station_<?php echo $station['Station']['id']?>_trails" style="display:none;">
					<?php foreach($station['Trail'] as $stationtrail): ?>
						<div class="trailitem">
						<?php echo $this->Html->link($stationtrail['name'], array('controller' => 'trails', 'action' => 'trail', $stationtrail['id'])); ?>
						</div>
					<?php endforeach ?>
				</div> <!-- station_{}_trails-->

			<?php endforeach; ?>
		</div><!-- accordeon container -->
		<div id="selectlans"><?php
		        echo "<p>Change your current language</p>";
        		$languages = $this->requestAction('/languages/getlanguages');

        		echo "<select id='languages' onchange=\"selectLanguage()\">";
        		echo "<option disabled selected>Change language</option>";

        		foreach($languages as $language):
        			print '<option value="'.$language['Language']['id'].'">'.$language['Language']['name'].'</option>';
        		endforeach;

        		print '</select>';
        ?></div>
        <div id="selectlans"><?php
            echo "<p>Change visitor type</p>";
            $visitors = $this->requestAction('/visitors/getvisitors');

            echo "<select id='visitors' onchange=\"selectVisitor()\">";
            echo "<option disabled selected>Change visitor</option>";

            foreach($visitors as $visitor):
                print '<option value="'.$visitor['Visitor']['role'].'">'.$visitor['Visitor']['role'].'</option>';
            endforeach;

            print '</select>';
        ?></div>
	</div> <!-- rightdiv container -->

    <script>
        function selectLanguage()
        {
           var e = document.getElementById("languages").value;

           if(window.XMLHttpRequest)
              ajax = new XMLHttpRequest()
           else
              ajax = new ActiveXObject("Microsoft.XMLHTTP");

           ajax.open("GET","/senderos/languages/selectlanguage?language="+e+"",true);

           ajax.onreadystatechange=function(){
              if(ajax.readyState==4)
              {
                  var respuesta=ajax.responseText;
                  location.reload();
              }
           }
           ajax.send(null);
        }
    </script>

    <script>
    function selectVisitor()
    {
        var e = document.getElementById("visitors");
        var session_role = e.options[e.selectedIndex].value;

        if(window.XMLHttpRequest)
            ajax = new XMLHttpRequest()
        else
            ajax = new ActiveXObject("Microsoft.XMLHTTP");

        ajax.open("GET","/senderos/sessions/setsession?var=role&value="+session_role+"",true);

        ajax.onreadystatechange=function()
        {
            if(ajax.readyState==4)
            {
                var respuesta=ajax.responseText;
                location.reload();
            }
        }

        ajax.send(null);
    }
    </script>

</div> <!-- bodycontent container -->
