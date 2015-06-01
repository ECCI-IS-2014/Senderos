<?php
/* DocumentsPoint Fixture generated on: 2015-04-22 12:40:55 : 1429706455 */
class DocumentsPointFixture extends CakeTestFixture {
	var $name = 'DocumentsPoint';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'document_id' => array('type' => 'integer', 'length' => '22'),
		'point_id' => array('type' => 'integer', 'length' => '22'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'document_id' => 1,
			'point_id' => 1
		),
	);
}
