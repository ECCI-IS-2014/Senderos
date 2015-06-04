<div class="visitors view">
<h2><?php  __('Visitor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Role'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $visitor['Visitor']['role']; ?>
			&nbsp;
        </dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
            <dd<?php if ($i++ % 2 == 0) echo $class;?>>
                <?php echo $visitor['Visitor']['description']; ?>
            &nbsp;
        </dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Visitor', true), array('action' => 'edit', $visitor['Visitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Visitor', true), array('action' => 'delete', $visitor['Visitor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $visitor['Visitor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Visitors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Visitor', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
