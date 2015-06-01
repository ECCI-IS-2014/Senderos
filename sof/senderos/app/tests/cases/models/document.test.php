<?php
/* Document Test cases generated on: 2015-04-22 12:20:10 : 1429705210*/
App::import('Model', 'Document');

class DocumentTestCase extends CakeTestCase {
	var $fixtures = array('app.document');

	function startTest() {
		$this->Document =& ClassRegistry::init('Document');
	}

	function endTest() {
		unset($this->Document);
		ClassRegistry::flush();
	}

}
