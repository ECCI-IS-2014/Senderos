<?php
/**
 * Created by PhpStorm.
 * User: Erick
 * Date: 09/10/14
 * Time: 12:40 AM
 */

class Product extends AppModel
{
/*The $validate array tells CakePHP how to validate your data when the save() method is called.*/
	public $belongsTo = array('Platform');//, 'Stock');
	public $hasOne = array('Stock');//, 'Stock');
	public $hasAndBelongsToMany = array(
        //todo producto puede estar asociado a varias wishlist (solo una vez)
		'Wishlist' =>
			array(
				'className' => 'Wishlist',
				'joinTable' => 'product_wishlists',
				'foreignKey' => 'product_id',
				'associationForeignKey' => 'wishlist_id',
				'unique' => true /*,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'finderQuery' => '',
				'with' => '' */
			),
		'Category' =>
            array(
                'className' => 'Category',
                'joinTable' => 'category_products',
                'foreignKey' => 'product_id',
                'associationForeignKey' => 'category_id',
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
            'message' => 'The name is already used'
        ),
		'platform_id' => array(
            'rule' => 'notEmpty'
        ),
		'release_year' => array(
            'rule' => 'notEmpty'
        ),
		'price' => array(
            'rule' => 'notEmpty'
        ),
		'description' => array(
            'rule' => 'notEmpty'
        )
    );
	
	public function bringAllRegisters() {
        return $this->find('all');
    }
	
	public function editField() {
        $data = array('id' => 1, 'name' => 'RE5');
		// This will update Recipe with id 10
		$this->save($data);
		return $this->bringAllRegisters();
    }
	
	public function removeRegister() {
		$this->delete(1,false);
		return $this->bringAllRegisters();
    }
}

?>