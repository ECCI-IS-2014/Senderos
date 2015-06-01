<?php
/* Country Fixture generated on: 2015-04-22 11:30:28 : 1429702228 */
class CountryFixture extends CakeTestFixture {
	var $name = 'Country';

	var $fields = array(
		'id' => array('type' => 'integer', 'length' => '22', 'key' => 'primary'),
		'code' => array('type' => 'string', 'length' => '2'),
		'name' => array('type' => 'string', 'length' => '100'),
		'indexes' => array('PRIMARY' => array('column' => array('id', 'country_id'), 'unique' => 1)),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'code' => '',
			'name' => 'Lorem ipsum dolor sit amet'
		),
	);
}
