<?php /* ?>
<div class="actions">
	<ul>
		<li title = "Edit the information for this file"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Edit Document', true), array('action' => 'edit', $document['Document']['id']));} ?></li>
        		<li title = "Delete this file"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('Delete Document', true), array('action' => 'delete', $document['Document']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $document['Document']['id']));} ?></li>
        		<li title = "Index for files"><?php echo $this->Html->link(__('List Documents', true), array('action' => 'index')); ?> </li>
        		<li title = "Create a new file"><?php if($this->Session->read('Auth.Client.id') != null){echo $this->Html->link(__('New Document', true), array('action' => 'add'));} ?></li>
	</ul>
</div>
<div class="documents view">
<h2><?php  __('Document');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Route'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $document['Document']['route']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php */ ?>