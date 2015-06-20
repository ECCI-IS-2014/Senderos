<?php
/* DocumentsPoints Test cases generated on: 2015-04-22 12:41:21 : 1429706481*/
App::import('Controller', 'DocumentsPoints');

class TestDocumentsPointsController extends DocumentsPointsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DocumentsPointsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.documents_point', 'app.document', 'app.point', 'app.trail', 'app.station');

	function startTest() {
		$this->DocumentsPoints =& new TestDocumentsPointsController();
		$this->DocumentsPoints->constructClasses();
	}

	function endTest() {
		unset($this->DocumentsPoints);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
