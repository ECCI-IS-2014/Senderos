<?php
App::uses('Check', 'Model');

class CheckTest extends CakeTestCase {
    public $fixtures = array('app.check','app.debitcard','app.checkproduct','app.product');


public function setUp() {
        parent::setUp();
        $this->Check = ClassRegistry::init('Check', 'app.ShippingAddress');
    }

    public function testRemoveRegister() {
        $this->loadFixtures('Check');
        $result = $this->Check->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }
	
	public function testEnviado() {
        $this->loadFixtures('Check', 'ShippingAddress');
        $result = $this->Check->setDstatus(0)['Check']['dstatus'];
        $expected = 0;
        $this->assertEquals($expected, $result);
    }
    public function testEnProceso() {
        $this->loadFixtures('Check', 'ShippingAddress');
        $result = $this->Check->setDstatus(1)['Check']['dstatus'];
        $expected = 1;
        $this->assertEquals($expected, $result);
    }
    public function testEnCasillero() {
        $this->loadFixtures('Check', 'ShippingAddress');
        $result = $this->Check->setDstatus(3)['Check']['dstatus'];
        $expected = 3;
        $this->assertEquals($expected, $result);
    }
    public function testEntregado() {
        $this->loadFixtures('Check', 'ShippingAddress');
        $result = $this->Check->setDstatus(2)['Check']['dstatus'];
        $expected = 2;
        $this->assertEquals($expected, $result);
    }
}


?>