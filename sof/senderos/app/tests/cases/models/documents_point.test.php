<?php
/* DocumentsPoint Test cases generated on: 2015-04-22 12:40:55 : 1429706455*/
App::import('Model', 'DocumentsPoint');

class DocumentsPointTestCase extends CakeTestCase {
	var $fixtures = array('app.documents_point', 'app.document', 'app.point', 'app.trail', 'app.station');

	function startTest() {
		$this->DocumentsPoint =& ClassRegistry::init('DocumentsPoint');
	}

	function endTest() {
		unset($this->DocumentsPoint);
		ClassRegistry::flush();
	}

}
