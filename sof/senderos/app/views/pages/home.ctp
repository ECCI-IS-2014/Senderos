<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php if($this->Session->read('Auth.Client.id') == null)
    {
    ?>
	<div id="welcome">
	<h3>Welcome!</h3>
	<br>
	<p>Select the language in which you want to see the information:</p>
	<?php  //ESTA ES LA FORMA CREANDO LA CONEXION CON LA BD DESDE AQUI MISMO
		$conn = oci_connect("mana", "coco", "localhost:1521/XE"); // LOGIN, PASSWORD Y DATABASE DE DATABASE.PHP
		$query = 'select code, name from languages';
		$stid = oci_parse($conn, $query);
		oci_define_by_name($stid, 'CODE', $code);
		oci_define_by_name($stid, 'NAME', $name);
		$r = oci_execute($stid);

		echo "<select id='languages' onchange=\"selectLanguage()\">";
		echo "<option disabled selected>Select language</option>";
		while ($row = oci_fetch($stid))
		{
			print '<option value='.$code.'>'.$name.'</option>';
		}
			
		oci_free_statement($stid);
		oci_close($conn);
		print '</select>';
        ?>
    <br>
    <br>
    <p>Select the type of visitor:</p>
        <select id='roles' class="visitor" onchange="selectVisitor()">
            <option disabled selected>Select visitor</option>
            <option value="Student">Student</option>
            <option value="Professor">Professor</option>
            <option value="Researcher">Researcher</option>
            <option value="Natural">Natural</option>
        </select>
    <br>
    <br>
    <br>
        <h3><?php
        if(isset($_SESSION['language'])&&isset($_SESSION['role']))
        {
            echo "<div class=\"button special\">".$this->Html->link(__('Enter', true), array('controller'=>'stations', 'action'=>'index'))."</div>";
            //echo $this->Html->link(__('Enter', true), array('controller'=>'stations', 'action'=>'index'));
        }
        ?></h3>
    <script>
    function selectVisitor()
    {
        var e = document.getElementById("roles");
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
    </div>
    <?php
    }
    ?>
</body>
</html>
