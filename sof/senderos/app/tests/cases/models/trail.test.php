<?php
/* Trail Test cases generated on: 2015-04-22 12:01:46 : 1429704106*/
App::import('Model', 'Trail');

class TrailTestCase extends CakeTestCase {
	var $fixtures = array('app.trail', 'app.station');

	function startTest() {
		$this->Trail =& ClassRegistry::init('Trail');
	}

	function endTest() {
		unset($this->Trail);
		ClassRegistry::flush();
	}

}
