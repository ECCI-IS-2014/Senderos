<?php
/**
 * Created by PhpStorm.
 * User: Iva
 * Date: 18/10/14
 * Time: 11:41 PM
 */

class Debitcard extends AppModel{
	public $belongsTo = 'Check';
    public $hasAndBelongsToMany = array(
        'User' =>
            array(
                'className' => 'User',
                'joinTable' => 'debitcards_user',
                'foreignKey' => 'debitcard_id',
                'associationForeignKey' => 'user_id',
                'unique' => true
            )
    );
    public $validate = array(
        'id' => array(
        'rule' => 'notEmpty',
        'rule' => 'isUnique'
        ),
        'card_number' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'nip' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'csc' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'expiration_date' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        ),
        'balance' => array(
            'rule' => 'notEmpty',
            'rule' => 'isUnique'
        )
    );
}
?>