<?php
class DocumentsVisitor extends AppModel {
	var $name = 'DocumentsVisitor';
	var $displayField = 'id';
	var $validate = array(
		'document_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'visitor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

var $belongsTo = array(
    'Document' => array(
        'className' => 'Document',
        'foreignKey' => 'document_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    ),
    'Visitor' => array(
        'className' => 'Visitor',
        'foreignKey' => 'visitor_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
);
}
