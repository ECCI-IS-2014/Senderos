<div class="actions" >
	<ul>
		<li><?php echo $this->Html->link(__('List Permissions', true), array('action' => 'index'));?></li>
        <!-- <li><?php echo $this->Html->link(__('List Clients', true), array('action' => 'index'));?></li>
        <li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li> -->
	</ul>
</div>

<div class="infohelp">
    <a href="#" class="tooltip">
        <?php
            echo $this->Html->image('infoicon.png', array('alt' => "Informacion", 'style'=> "width:17px;height:17px;float:right;"));
        ?>
        <span>
            To grant permissions to a client, you have to select the client and check the station's trails she/he will manage.
        </span>
    </a>
</div>

<div class="clients form">
<?php echo $this->Form->create('Restriction');?>

    <fieldset>
        <legend><?php __('Add Permission'); ?></legend>
        <table>
            <tr>
                <th>Client</th>
                <th>Station</th>
                <th>Trails</th>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('client_id');?></td>
                <td><?php echo $this->Form->input('station_id');?></td>
                <td><?php echo $this->Form->input('trail_id',array('type'=>'select','multiple'=>'checkbox'));?></td>
            </tr>
        </table>
    </fieldset>

<?php echo $this->Form->end(__('Done', true));?>
</div>

<script>
$( document ).ready(function() {
   /*  $('#RestrictionTrailId').prop('disabled', 'disabled');
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

    });*/

    $("#RestrictionStationId").change(function()
    {
        $.ajax({
                    url: '/senderos/trails/getByStation/'+$("#RestrictionStationId").val(),
                        cache: false,
                        type: 'GET',
                        dataType: 'HTML',
                    success: function (data){
                       $(".checkbox").remove();
                       $("[name='data[Restriction][trail_id]']").after(data);
                    }
        });
    });
});



</script>




