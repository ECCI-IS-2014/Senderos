<?php
/* Points Test cases generated on: 2015-04-22 12:13:57 : 1429704837*/
App::import('Controller', 'Points');

class TestPointsController extends PointsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PointsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.point', 'app.trail', 'app.station');

	function startTest() {
		$this->Points =& new TestPointsController();
		$this->Points->constructClasses();
	}

	function endTest() {
		unset($this->Points);
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
