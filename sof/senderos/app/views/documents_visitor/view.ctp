<div class="documentsVisitors view">
<h2><?php  __('Association between multimedia file and goal visitor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsVisitors['Document']['name'], array('controller' => 'documents', 'action' => 'view', $documentsVisitors['Document']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Visitor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsVisitors['Visitor']['role'], array('controller' => 'visitors', 'action' => 'view', $documentsVisitors['Visitor']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Association', true), array('action' => 'edit', $documentsVisitors['DocumentsVisitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Association', true), array('action' => 'delete', $documentsVisitors['DocumentsVisitor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsVisitors['DocumentsVisitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Associations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Association', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Visitors', true), array('controller' => 'visitors', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Visitor', true), array('controller' => 'visitors', 'action' => 'add')); ?> </li>
	</ul>
</div>
