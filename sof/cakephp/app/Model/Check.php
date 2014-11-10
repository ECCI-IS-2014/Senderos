<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:41 PM
 */

class Check extends AppModel{
    public $hasOne = 'Debitcard';
    public $hasAndBelongsToMany = array(
        'Product' =>
            array(
                'className' => 'Product',
                'joinTable' => 'check_products',
                'foreignKey' => 'check_id',
                'associationForeignKey' => 'product_id',
                'unique' => true /*,
                'conditions' => '',
                'fields' => '',
                'order' => '',
                'limit' => '',
                'offset' => '',
                'finderQuery' => '',
                'with' => '' */
            )
    );
}
?>