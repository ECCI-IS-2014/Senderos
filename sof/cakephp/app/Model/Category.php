<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:41 PM
 */

class Category extends AppModel{
    //public $belongsTo = 'Category';
    //public $hasMany = 'Category';
    public $actsAs = array('Tree');

    public $belongsTo = array(
        'Parent' => array(
            'className' => 'Category',
            'foreignKey' => 'parent_id'
        )
    );
    public $hasMany = array(
        'Children' => array(
            'className' => 'Category',
            'foreignKey' => 'parent_id'
        )
    );
    public $hasAndBelongsToMany = array(
        'Product' =>
            array(
                'className' => 'Product',
                'joinTable' => 'category_products',
                'foreignKey' => 'category_id',
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
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique',
            'message' => 'Esta categoría ya existe.'
        )
    );
}
?>