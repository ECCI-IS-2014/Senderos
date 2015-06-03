<div class="documentsPoints view">
<h2><?php  __('Association between multimedia file and point');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
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
	<ul>
		<li><?php echo $this->Html->link(__('Edit Association', true), array('action' => 'edit', $documentsPoint['DocumentsPoint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Association', true), array('action' => 'delete', $documentsPoint['DocumentsPoint']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsPoint['DocumentsPoint']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Association', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Association', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Points', true), array('controller' => 'points', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Point', true), array('controller' => 'points', 'action' => 'add')); ?> </li>
	</ul>
</div>
