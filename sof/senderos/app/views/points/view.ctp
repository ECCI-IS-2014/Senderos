<?php /*?>
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

<div class="points view">
<h2><?php  __('Point');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $point['Point']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cordx'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $point['Point']['cordx']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cordy'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $point['Point']['cordy']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $point['Point']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Trail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($point['Trail']['name'], array('controller' => 'trails', 'action' => 'view', $point['Trail']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
<li title = "Edit the information for this point"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Edit Point', true), array('action' => 'edit', $point['Point']['id']));} ?></li>
		<li title = "Delete this point"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Delete Point', true), array('action' => 'delete', $point['Point']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $point['Point']['id']));} ?></li>
		<li title = "Index for points"><?php echo $this->Html->link(__('List Points', true), array('action' => 'index')); ?></li>
		<li title = "Create a new point"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('New Point', true), array('action' => 'add'));} ?></li>
		<li title = "Index for trails"><?php echo $this->Html->link(__('List Trails', true), array('controller' => 'trails', 'action' => 'index')); ?> </li>
		<li title = "Create a new trail"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('New Trail', true), array('controller' => 'trails', 'action' => 'add'));} ?></li>
	</ul>
</div>
<?php */?>