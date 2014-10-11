<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'username' => array(
        'required' => array(
        'rule' => array('notEmpty'),
        'message' => 'A username is required'
        )
    ),
		'password' => array(
		'required' => array(
		'rule' => array('notEmpty'),
		'message' => 'A password is required'
		)
    ),
		'name' => array(
		'required' => array(
		'rule' => array('notEmpty'),
		'message' => 'A name is required'
		)
	),
		'lastname' => array(
		'required' => array(
		'rule' => array('notEmpty'),
		'message' => 'A lastname is required'
		)
    ),
		'country' => array(
		'required' => array(
		'rule' => array('notEmpty'),
		'message' => 'A country is required'
		)
    ),
		'role' => array(
		'valid' => array(
		'rule' => array('inList', array('admin', 'cust')),
		'message' => 'Please enter a valid role',
		'allowEmpty' => false
		)
    )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
}