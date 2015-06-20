<div class="clients form">
<?php echo $this->Form->create('Restriction');?>

    <fieldset>
        <legend><?php __('Edit Permission'); ?></legend>
        <table>
            <tr>
                <th>Client</th>
                <th>Station</th>
                <th>Trail id</th>
                <th>All trails</th>
            </tr>
            <tr>
				<td><?php echo $this->Form->input('id');?></td>
                <td><?php echo $this->Form->input('client_id');?></td>
                <td><?php echo $this->Form->input('station_id');?></td>
                <td><?php echo $this->Form->input('allt', array('label' => 'All trails?','default'=>'1','options' => array('false','true')));?></td>
                <td><?php echo $this->Form->input('trail_id');?></td>
            </tr>
        </table>
    </fieldset>

<?php echo $this->Form->end(__('Done', true));?>
</div>

<div class="actions" >
	<h3><?php __('Actions'); ?></h3>
	<ul>

        <!-- <li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>

<script>
$( document ).ready(function() {
     $('#RestrictionTrailId').prop('disabled', 'disabled');
    $("#RestrictionAllt").click(function()
    {
        if($("#RestrictionAllt").val()=="1")
        {
            $('#RestrictionTrailId').prop('disabled', 'disabled');

        }
        else
        {
            $('#RestrictionTrailId').prop('disabled', false);
        }

    });
});
</script>






<?php
$this->Js->get('#RestrictionStationId')->event('change',
$this->Js->request(array(
                    'controller'=>'trails',
                    'action'=>'getByStation'
                    ),
            array(
                'update'=>'#RestrictionTrailId',
                'async' => true,
                'method' => 'post',
                'dataExpression'=>true,
                'data'=> $this->Js->serializeForm(array('isForm' => true,'inline' => true))
                )));
?>

