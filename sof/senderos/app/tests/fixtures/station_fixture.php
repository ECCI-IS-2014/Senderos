<?php
/* Station Fixture generated on: 2015-04-22 11:54:18 : 1429703658 */
class StationFixture extends CakeTestFixture {
	var $name = 'Station';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => '100'),
		'location' => array('type' => 'string', 'length' => '100'),
		'description' => array('type' => 'string', 'length' => '100'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'location' => 'Lorem ipsum dolor sit amet',
			'description' => 'Lorem ipsum dolor sit amet'
		),
	);
}
