<?php
/* Documents Test cases generated on: 2015-04-22 12:20:34 : 1429705234*/
App::import('Controller', 'Documents');

class TestDocumentsController extends DocumentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DocumentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.document');

	function startTest() {
		$this->Documents =& new TestDocumentsController();
		$this->Documents->constructClasses();
	}

	function endTest() {
		unset($this->Documents);
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
