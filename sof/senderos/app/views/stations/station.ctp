<?php
	if(!isset($_SESSION['lanview']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/en.php';
	}
	else
	{
		$language = $_SESSION['lanview'];
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
	}
?>


<?php echo $html->css('stations'); ?>

<?php $result = ''; 

$stationcreate = 'no';
$stationread = 'yes';
$stationupdate = 'no';
$stationdelete = 'no';

?>

<center>


<div class='stationsindex'><!--  class="stations index"> -->
	<h2><?php __($str_stations);?></h2>
	<!-- <table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('location');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr> -->
	
	
	
	<table id='liststations'>
	
	<?php $conter=0; ?>
	
	<?php
	
	foreach ($stations as $station):
		
		$stationcreate = 'no';
		$stationread = 'yes';
		$stationupdate = 'no';
		$stationdelete = 'no';
		
		if($_SESSION['role'] === 'restricted')
		{
			foreach ($restrictions as $restriction):
                if($restriction['Restriction']['station_id'] == $station['Station']['id'] && $restriction['Restriction']['allt'] == 1)
                {

                    $stationcreate = 'no';
                    $stationread = 'yes';
                    $stationupdate = 'yes';
                    $stationdelete = 'yes';

                    $result .= "<br>Found a restriction on ".$station['Station']['id'].": C=".$stationcreate.", R=".$stationread.", U=".$stationupdate.", D=".$stationdelete."";
               }
			endforeach;
		}
		else if($_SESSION['role'] === 'administrator')
		{
			$stationcreate = 'yes';
			$stationread = 'yes';
			$stationupdate = 'yes';
			$stationdelete = 'yes';
		}
		else
		{
			$stationcreate = 'no';
			$stationread = 'yes';
			$stationupdate = 'no';
			$stationdelete = 'no';
		}
		
		if($stationread == 'yes')
		{
			
			if($conter == 0)
			{
				echo "<tr>";
			}
			
			echo "<td>";
			
			echo "<br>";
			
			echo "<div class='stationitem'>";
			
			echo "<div class='stationheader'>".$station['Station']['name']."</div><br>";
			
			echo "<a href='/senderos/trails/stationtrails/".$station['Station']['id']."'>";
			
			//echo "ID: ".$station['Station']['id']."<br>";
			
			echo "".$str_location."<br>".$station['Station']['location']."<br><br>";
			echo "".$str_description."<br>".$station['Station']['description']."<br>";
			
			echo "</a>";
			
			echo "</div>";//'stationitem'>"
			
			echo "<br>";

			echo "<br>";
			
			echo "</td>";
			
			$conter++;
			
			if($conter==3)
			{
				echo "</tr>";
				$conter=0;
			}
			
		}
			
	endforeach; 
		
	?>
	
	</table>
	
	
	
</div>


<div >

	<?php
	
	//echo $result;
	
	?>

</div>

</center>
