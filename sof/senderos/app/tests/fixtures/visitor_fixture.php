<?php
/* Visitor Fixture generated on: 2015-04-22 12:28:08 : 1429705688 */
class VisitorFixture extends CakeTestFixture {
	var $name = 'Visitor';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'role' => array('type' => 'string', 'length' => '100'),
		'document_id' => array('type' => 'integer', 'length' => '22'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'role' => 'Lorem ipsum dolor sit amet',
			'document_id' => 1
		),
	);
}
