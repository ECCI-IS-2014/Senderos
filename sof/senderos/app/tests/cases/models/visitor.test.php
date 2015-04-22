<?php
/* Visitor Test cases generated on: 2015-04-22 12:28:08 : 1429705688*/
App::import('Model', 'Visitor');

class VisitorTestCase extends CakeTestCase {
	var $fixtures = array('app.visitor', 'app.document');

	function startTest() {
		$this->Visitor =& ClassRegistry::init('Visitor');
	}

	function endTest() {
		unset($this->Visitor);
		ClassRegistry::flush();
	}

}
