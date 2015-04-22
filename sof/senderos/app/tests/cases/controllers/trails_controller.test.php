<?php
/* Trails Test cases generated on: 2015-04-22 12:02:22 : 1429704142*/
App::import('Controller', 'Trails');

class TestTrailsController extends TrailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class TrailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.trail', 'app.station');

	function startTest() {
		$this->Trails =& new TestTrailsController();
		$this->Trails->constructClasses();
	}

	function endTest() {
		unset($this->Trails);
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
