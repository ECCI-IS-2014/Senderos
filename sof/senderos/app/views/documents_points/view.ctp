<div class="documentsPoints view">
<h2><?php  __('Documents Point');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $documentsPoint['DocumentsPoint']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsPoint['Document']['name'], array('controller' => 'documents', 'action' => 'view', $documentsPoint['Document']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Point'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsPoint['Point']['name'], array('controller' => 'points', 'action' => 'view', $documentsPoint['Point']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Documents Point', true), array('action' => 'edit', $documentsPoint['DocumentsPoint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Documents Point', true), array('action' => 'delete', $documentsPoint['DocumentsPoint']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsPoint['DocumentsPoint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents Points', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Documents Point', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Points', true), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point', true), array('controller' => 'points', 'action' => 'add')); ?> </li>
	</ul>
</div>
