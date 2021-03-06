<?php echo $html->css('map'); ?>
<?php echo $html->css("slider"); ?>
<?php echo $html->script("draggable"); ?>
<?php echo $html->script("map"); ?>
<?php echo $html->script("slider"); ?>

<div id="bodycontent">

	<div id="leftdiv">
		<div id="selectlans"><?php
		        echo "<p>Change current language</p>";
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
		<div id="accordeon">
			<!-- para lo del filtro del menu de la derecha -->
			<?php

			$existlan = false;
			$lan_availability = '';
			foreach($languagesavailable as $lanav):
				if($existlan) $lan_availability .= ', ';
				$existlan = true;
				$lan_availability .= $lanav['Language']['name'];
				//debug($lanav);
			endforeach;

			/*if($existinfo)
				echo "There is information available in ".$availability."<br>";*/

			$existvis = false;
			$vis_availability = '';
			foreach($visitorsavailable as $visav):
				if($existvis) $vis_availability .= ', ';
				$existvis = true;
				$vis_availability .= $visav['Visitor']['role'];
			endforeach;

			/*if($existinfo)
				echo "There is information available for ".$availability."<br>";*/



            //debug($myquery);

			$existoptions = false;

			foreach($stations as $station):

				$found = false;

				foreach($myquery as $rec):
					if($rec['Trail']['station_id'] == $station['Station']['id'])
					{
							$existoptions = true;
							$found = true;
							break;
					}
				endforeach;


				if($found && $existlan && $existvis)
				{
				    echo "<p>Select a station and a trail</p>";
				?>
					<div id="station_<?php echo $station['Station']['id']?>" class="stationitem" onclick="hideothers(this); document.getElementById('station_<?php echo $station['Station']['id']?>_trails').style.display = !document.getElementById('station_<?php echo $station['Station']['id']?>_trails').style.display? 'none': '';">
					<!--<div style="float:left;">-->
					<!--<?php echo $this->Html->link($station['Station']['name'], array('controller' => 'stations', 'action' => 'view', $station['Station']['id'])); ?>-->
					<?php echo $station['Station']['name']; ?>

							<div id="station_<?php echo $station['Station']['id']?>_arrow" class="menuarrow" onclick="this.innerHTML = (this.innerHTML=='&#x25B2;')? '&#x25BC;': '&#x25B2;';">
							&#x25BC;</div>

						</div> <!-- station_{}-->

						<div id="station_<?php echo $station['Station']['id']?>_trails" style="display:none;">
							<?php

							foreach($station['Trail'] as $stationtrail):
								$found2 = false;
								foreach($myquery as $rec2):
									if($rec2['Trail']['name'] === $stationtrail['name'])
									{
											$found2 = true;
											break;
									}
								endforeach;

								if($found2)
								{ ?>
									<div class="trailitem">
									<?php echo $this->Html->link($stationtrail['name'], array('controller' => 'trails', 'action' => 'trail', $stationtrail['id'])); ?>
									</div>
								<?php }
							endforeach ?>
						</div> <!-- station_{}_trails-->
				<?php }

			endforeach;

            if(($_SESSION['language'] == null) && ($_SESSION['client_id'] == null))
            {
            ?>
                <div class="infohelpv">
                    <a href="#" class="tooltipv">
                    <?php
                        echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:left;"));
                    ?>
                    <span>
                        Select a language and a visitor type, then you will be able to select a station.
                    </span>
                    </a>
                </div>
            <?php
            }

            if((($_SESSION['language'] != null) || ($_SESSION['client_id'] != null)) && (!$existlan && !$existvis))
            {
            ?>
                <div class="infohelpv">
                    <?php
                        if($_SESSION['language'] != null)
                        {
                    ?>
                        <a href="#" class="tooltipv">
                            <?php
                                echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:left;"));
                                echo "<span>There is not information available in ".$lan_name.".</span>";
                            ?>
                        </a>
                    <?php
                        }
                        if($_SESSION['client_id'] != null)
                        {
                    ?>
                        <a href="#" class="tooltipv">
                            <?php
                                echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:left;"));
                                echo "<span>There is not information available for ".$vis_role.".</span>";
                            ?>
                        </a>
                    <?php
                        }
                    ?>
                </div>
            <?php
            }

            if($existlan || $existvis)
            {
            ?>
                <div class="infohelpv">
                    <?php
                        if($existlan && (!$existvis))
                        {
                    ?>
                        <a href="#" class="tooltipv">
                            <?php
                                echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:left;"));
                                echo "<span>There is information available for ".$vis_role." in ".$lan_availability.".</span>";
                            ?>
                        </a>
                    <?php
                        }
                        if($existvis && (!$existlan))
                        {
                    ?>
                        <a href="#" class="tooltipv">
                            <?php
                                echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:left;"));
                                echo "<span>There is information available in ".$lan_name." for ".$vis_availability.".</span>";
                            ?>
                        </a>
                    <?php
                        }
                    ?>
                </div>
            <?php
            }
			?>

			<!-- fin para lo del filtro del menu de la derecha -->
		</div><!-- accordeon container -->
	</div> <!-- leftdiv container -->

	<div id="centraldiv" style="width: 50%">

		<!--<div id="mapcontainer" class="draggablecontainer" >-->
		<div id="mapcontainer" style="position:relative;border:1px solid white;width:800px;height:700px;overflow:hidden;">

			<!--<div id="maplayer" class="draggablediv" style="background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>');" >
			</div> <!-- maplayer div -->
			<div id="maplayer" style="width:800px;height:700px;top:0px;left:0px;position:absolute;cursor: default; background-image: url('/senderos/app/webroot/img/<?php echo $trail['Trail']['image']; ?>'); background-size: 800px 700px;" ></div>
			
			<!--<div id="pointslayer" class="draggablediv2">-->
			<div id="pointslayer" style="position: absolute;height: 700px;width: 800px; background-size: 100% 700px;pointer-events: none;">
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

		<!--<select id='zooming' onchange="zoomings (this);" style="height:20px; font-size: 15px; color: white; background-color:rgb(80,80,80);">
			<option value="100%" selected>100%</option>
			<option value="150%">150%</option>
			<option value="200%">200%</option>
			<option value="250%">250%</option>
			<option value="300%">300%</option>
		</select>-->


		<div id="popupdiv" class="ontop">
			<div id="popup" style="overflow-y: hidden;">
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

	<div id="rightdiv" style="width: 15%;">
	<?php if($trail != null)
	{
	?>
        <div id="trailmapinfo">
		    <p><h1><?php echo $trail['Station']['name']; ?></h1></p>
		    <p><h2><?php echo $trail['Trail']['name']; ?></h2></p>
		    <p><?php echo $trail['Trail']['description']; ?></p>
        </div>
    <?php
    }
    ?>
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


    <script>

	function hideothers(div)
	{
		var x = document.getElementsByClassName("stationitem");
		for(var i=0; i < x.length; i++)
		{
			if(x[i].id !== div.id)
			{
				document.getElementById(''+x[i].id+'_trails').style.display = 'none';
			}
		}
	}

    </script>

</div> <!-- bodycontent container -->
