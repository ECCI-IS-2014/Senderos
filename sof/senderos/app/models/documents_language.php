<?php
class DocumentsLanguage extends AppModel {
	var $name = 'DocumentsLanguage';
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
		'language_id' => array(
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
    'Language' => array(
        'className' => 'Language',
        'foreignKey' => 'language_id',
        'conditions' => '',
        'fields' => '',
        'order' => ''
    )
);
}
