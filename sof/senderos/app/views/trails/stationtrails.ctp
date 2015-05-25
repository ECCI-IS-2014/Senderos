<?php
	if(!isset($_SESSION['language']))
	{
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/en.php';
	}
	else
	{
		$language = $_SESSION['language'];
		include $_SERVER['DOCUMENT_ROOT'].'/senderos/app/views/layouts/'.$language.'.php';
	}
?>

<?php echo $html->css('stations'); ?>

<?php $result = ''; 

$trailcreate = 'no';
$trailread = 'yes';
$trailupdate = 'no';
$traildelete = 'no';

?>

<center>


<div><!--  class="trails index"> -->
	<h2><?php __($str_trails);?></h2>
	
	<table>
	
	<?php $conter=0; ?>
	
	<?php
	
	foreach ($trails as $trail):
		
		$trailcreate = 'no';
		$trailread = 'yes';
		$trailupdate = 'no';
		$traildelete = 'no';
		
		if($_SESSION['role'] === 'restricted')
		{
			foreach ($restrictions as $restriction):
			if($restriction['Restriction']['model'] == 'Trail' && $restriction['Restriction']['recordid'] == $trail['Trail']['id'])
			{
				if($restriction['Restriction']['creating'] === '1')
					$trailcreate = 'yes';
				if($restriction['Restriction']['reading'] === '0')
					$trailread = 'no';
				if($restriction['Restriction']['updating'] === '1')
					$trailupdate = 'yes';
				if($restriction['Restriction']['deleting'] === '1')
					$traildelete = 'yes';
					
				$result .= "<br>Found a restriction on ".$trail['Trail']['id'].": C=".$trailcreate.", R=".$trailread.", U=".$trailupdate.", D=".$traildelete."";
			}
			endforeach;
		}
		else if($_SESSION['role'] === 'administrator')
		{
			$trailcreate = 'yes';
			$trailread = 'yes';
			$trailupdate = 'yes';
			$traildelete = 'yes';
		}
		else
		{
			$trailcreate = 'no';
			$trailread = 'yes';
			$trailupdate = 'no';
			$traildelete = 'no';
		}
		
		if($trailread == 'yes')
		{
			
			if($conter == 0)
			{
				echo "<tr>";
			}
			
			echo "<td>";
			
			//echo "<a href='/senderos/trails/view/".$trail['Trail']['id']."'>";
			echo "<div class='trailitem'>";
			
			echo "<div class='trailheader'>".$trail['Trail']['name']."</div><br>";
			
			echo "<a href='/senderos/trails/view/".$trail['Trail']['id']."'>";
			
			//echo "ID: ".$trail['Trail']['id']."<br>";
			//echo "NAME: ".$trail['Trail']['name']."<br>";
			echo "<br>".$str_description."<br>".$trail['Trail']['description']."<br><br>";
			
			//echo "<img src='/senderos/app/webroot/img/".$trail['Trail']['image']."'/>";
			echo "</a>";
			
			echo "</div>";//'trailitem'>"
			
			
			if($trailupdate === 'yes')
				//echo $this->Html->link(__('Edit', true), array('action' => 'edit', $trail['Trail']['id']));
				echo "<div class='editbutton' title='edit this item'>".$this->Html->link(__('', true), array('action' => 'edit', $trail['Trail']['id']))."</div>";
			
			if($traildelete === 'yes')
				//echo $this->Html->link(__('Delete', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id']));
				echo "<div class='deletebutton' title='delete this item'>".$this->Html->link(__('', true), array('action' => 'delete', $trail['Trail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $trail['Trail']['id']))."</div>";
				
				
			
					
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
	
	echo $result;
	
	?>

</div>

<?php 

if($_SESSION['role'] === 'administrator')
	$trailcreate = 'yes';


if($trailcreate === 'yes')
{?>

<?php echo "<div class='newitem'><div class='addbutton' title='add a new item'>".$this->Html->link(__('', true), array('action' => 'add'))."</div>New Trail</div>"; ?>

<!-- <div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php 
		//if($trailcreate === 'yes')
			echo $this->Html->link(__('New Trail', true), array('action' => 'add')); 
		//else 
			//echo "---";
		?></li>
	</ul>
</div> -->
<?php 
}
?>

</center>
