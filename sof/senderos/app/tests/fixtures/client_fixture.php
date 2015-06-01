<?php
/* Client Fixture generated on: 2015-04-22 13:03:08 : 1429707788 */
class ClientFixture extends CakeTestFixture {
	var $name = 'Client';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'username' => array('type' => 'string', 'length' => '100'),
		'name' => array('type' => 'string', 'length' => '100'),
		'lastname' => array('type' => 'string', 'length' => '100'),
		'role' => array('type' => 'string', 'length' => '100'),
		'password' => array('type' => 'string', 'length' => '100'),
		'country_id' => array('type' => 'integer', 'length' => '22'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'username' => 'Lorem ipsum dolor sit amet',
			'name' => 'Lorem ipsum dolor sit amet',
			'lastname' => 'Lorem ipsum dolor sit amet',
			'role' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'country_id' => 1
		),
	);
}
