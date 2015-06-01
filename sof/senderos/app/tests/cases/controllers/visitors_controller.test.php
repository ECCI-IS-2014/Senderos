<?php
/* Visitors Test cases generated on: 2015-04-22 12:28:53 : 1429705733*/
App::import('Controller', 'Visitors');

class TestVisitorsController extends VisitorsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class VisitorsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.visitor', 'app.document');

	function startTest() {
		$this->Visitors =& new TestVisitorsController();
		$this->Visitors->constructClasses();
	}

	function endTest() {
		unset($this->Visitors);
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
