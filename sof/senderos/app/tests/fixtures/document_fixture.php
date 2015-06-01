<?php
/* Document Fixture generated on: 2015-04-22 12:20:10 : 1429705210 */
class DocumentFixture extends CakeTestFixture {
	var $name = 'Document';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => '100'),
		'description' => array('type' => 'string', 'length' => '500'),
		'type' => array('type' => 'string', 'length' => '100'),
		'route' => array('type' => 'string', 'length' => '100'),
		'language' => array('type' => 'string', 'length' => '100'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'route' => 'Lorem ipsum dolor sit amet',
			'language' => 'Lorem ipsum dolor sit amet'
		),
	);
}
