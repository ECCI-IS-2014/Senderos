<?php
/* Stations Test cases generated on: 2015-04-22 11:54:43 : 1429703683*/
App::import('Controller', 'Stations');

class TestStationsController extends StationsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class StationsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.station');

	function startTest() {
		$this->Stations =& new TestStationsController();
		$this->Stations->constructClasses();
	}

	function endTest() {
		unset($this->Stations);
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
