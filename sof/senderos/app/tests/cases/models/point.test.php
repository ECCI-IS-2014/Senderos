<?php
/* Point Test cases generated on: 2015-04-22 12:13:35 : 1429704815*/
App::import('Model', 'Point');

class PointTestCase extends CakeTestCase {
	var $fixtures = array('app.point', 'app.trail', 'app.station');

	function startTest() {
		$this->Point =& ClassRegistry::init('Point');
	}

	function endTest() {
		unset($this->Point);
		ClassRegistry::flush();
	}

}
