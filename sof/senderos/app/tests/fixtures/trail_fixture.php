<?php
/* Trail Fixture generated on: 2015-04-22 12:01:46 : 1429704106 */
class TrailFixture extends CakeTestFixture {
	var $name = 'Trail';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => '100'),
		'description' => array('type' => 'string', 'length' => '100'),
		'image' => array('type' => 'string', 'length' => '100'),
		'station_id' => array('type' => 'integer', 'length' => '22'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet',
			'image' => 'Lorem ipsum dolor sit amet',
			'station_id' => 1
		),
	);
}
