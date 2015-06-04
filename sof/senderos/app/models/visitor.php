<?php
class Visitor extends AppModel {
	var $name = 'Visitor';
	var $displayField = 'role';
	var $validate = array(
		'role' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

    public $hasMany = array('DocumentsVisitor');
}
