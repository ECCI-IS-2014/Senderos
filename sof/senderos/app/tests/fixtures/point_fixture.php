<?php
/* Point Fixture generated on: 2015-04-22 12:13:32 : 1429704812 */
class PointFixture extends CakeTestFixture {
	var $name = 'Point';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'name' => array('type' => 'string', 'length' => '100'),
		'cordx' => array('type' => 'integer', 'length' => '22'),
		'cordy' => array('type' => 'integer', 'length' => '22'),
		'description' => array('type' => 'string', 'length' => '100'),
		'trail_id' => array('type' => 'integer', 'length' => '22'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'cordx' => 1,
			'cordy' => 1,
			'description' => 'Lorem ipsum dolor sit amet',
			'trail_id' => 1
		),
	);
}
