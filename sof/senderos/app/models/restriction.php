<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 13/05/15
 * Time: 09:55 AM
 */

class Restriction extends AppModel {
    var $name = 'Restriction';
    var $displayField = 'name';

    var $belongsTo = array(
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'client_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Station' => array(
            'className' => 'Station',
            'foreignKey' => 'station_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Trail' => array(
            'className' => 'Trail',
            'foreignKey' => 'trail_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

}