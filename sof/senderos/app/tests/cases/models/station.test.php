<?php
/* Station Test cases generated on: 2015-04-22 11:54:18 : 1429703658*/
App::import('Model', 'Station');

class StationTestCase extends CakeTestCase {
	var $fixtures = array('app.station');

	function startTest() {
		$this->Station =& ClassRegistry::init('Station');
	}

	function endTest() {
		unset($this->Station);
		ClassRegistry::flush();
	}

}
