<div class="visitors view">
<h2><?php  __('Association between multimedia file and goal visitor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $visitor['Visitor']['role']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($visitor['Document']['name'], array('controller' => 'documents', 'action' => 'view', $visitor['Document']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Visitor', true), array('action' => 'edit', $visitor['Visitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Visitor', true), array('action' => 'delete', $visitor['Visitor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $visitor['Visitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visitor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
	</ul>
</div>
