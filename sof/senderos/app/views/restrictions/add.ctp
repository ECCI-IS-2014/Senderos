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
            <strong>How to grant a permission over a station?</strong><br>
            You have to select the restricted user and the name of the station, then check the 'Station Permissions' option.
            In this way, the user can do all the actions related to that station.<br><br>
            <strong>How to grant a permission over a given trail?</strong><br>
            You have to select the restricted user and the name of the station, then check all the trails you want the user to have access to.
            In this way, the user can only do the actions related to those trails.<br><br>
            <strong>How to remove a permission?</strong><br>
            Go to the 'List Permissions' option and then click on the 'Delete' button.
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

<?php echo $this->Form->end(__('Submit', true));
      echo "<input type='button' id='hiddencancel' value='Cancel' onclick=\"window.location.href = window.history.back(1);\" style='font-size:small;color:white;background-color:#7BC143;border-radius:3px;border: 0px solid #2D6324;margin-left:3px;padding: 4px 8px;width:auto;display:inline;float:left;'/>";
?>
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
    /*var list = $("input[id^='RestrictionTrailId']").map(function(){return $(this).attr("value");}).get();
    var concat_list = list.toString();*/


            $.ajax({
                        url: '/senderos/trails/getByStation/'+$("#RestrictionClientId").val()+'/'+$("#RestrictionStationId").val(),
                            cache: false,
                            type: 'GET',
                            dataType: 'HTML',
                        success: function (data){
                           $(".checkbox").remove();
                           $("[name='data[Restriction][trail_id]']").after(data);
                        }
            });





    $("#RestrictionStationId").change(function()
    {
            /*var list = $("input[id^='RestrictionTrailId']").map(function(){return $(this).attr("value");}).get();
            var concat_list = list.toString();

                    alert(concat_list);*/
                    $.ajax({
                                url: '/senderos/trails/getByStation/'+$("#RestrictionClientId").val()+'/'+$("#RestrictionStationId").val(),
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


