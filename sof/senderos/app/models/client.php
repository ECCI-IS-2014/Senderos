<?php
class Client extends AppModel {
	var $name = 'Client';
	var $displayField = 'username';
	var $validate = array(
        'username' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Username expected'
            ),
            'rule2' => array
            (
                'rule' => array('isUnique'),
                'message' => 'The username is already used'
            ),
            'rule3' => array
            (
                'rule' => array('between', 6, 100),
                'message' => 'Minimum 6 characters long'
            ),
            'noSpecial' => array(
                'rule'    => array('noSpecial'),
                'message' => 'Username can only be letters, numbers and underscores'
            )
        ),
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Name expected'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lastname' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Lastname expected',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'role' => array
        (
            'rule' => array('inList', array('admin', 'cust')),
            'message' => 'Please enter a valid role',
            'allowEmpty' => false
        ),
        'password' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Password expected'
            ),
            'rule2' => array
            (
                'rule' => array('between', 8, 100),
                'message' => 'Minimum 8 characters long'
            )
        ),
        'password_confirm' => array
        (
            'required' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            )/*,
            'equals' => array
            (
                'rule' => array('equals','password'),
                'message' => 'Both passwords must match.'
            )*/
        ),
        'new_password' => array
        (
            'rule1' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Password expected'
            ),
            'rule2' => array
            (
                'rule' => array('between', 8, 100),
                'message' => 'Minimum 8 characters long'
            )
        ),
        'new_password_confirm' => array
        (
            'required' => array
            (
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
            'equals' => array
            (
                'rule' => array('equals','new_password'),
                'message' => 'Both passwords must match.'
            )
        )
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

    public function noSpecial($check)
    {
        $value = array_values($check);
        $value = $value[0];
        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equals($check,$otherfield)
    {
        $fname = '';
        foreach ($check as $key => $value)
        {
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    /*
    var $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'country_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    ); */

    var $hasMany = array(
        'Restriction' => array(
            'className' => 'Restriction',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
