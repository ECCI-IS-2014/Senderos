<div class="documentsLanguages view">
<h2><?php  __('Association between multimedia file and language');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Document'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsLanguages['Document']['name'], array('controller' => 'documents', 'action' => 'view', $documentsLanguages['Document']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Language'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($documentsLanguages['Language']['name'], array('controller' => 'visitors', 'action' => 'view', $documentsLanguages['Language']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Association', true), array('action' => 'edit', $documentsLanguages['DocumentsLanguage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Association', true), array('action' => 'delete', $documentsLanguages['DocumentsLanguage']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $documentsLanguages['DocumentsLanguage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Associations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Association', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents', true), array('controller' => 'documents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document', true), array('controller' => 'documents', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Languages', true), array('controller' => 'languages', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Language', true), array('controller' => 'languages', 'action' => 'add')); ?> </li>
	</ul>
</div>
