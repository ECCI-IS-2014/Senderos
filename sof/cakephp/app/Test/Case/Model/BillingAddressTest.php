<?php 
App::uses('BillingAddress', 'Model');

class BillingAddressTest extends CakeTestCase
{
    public $fixtures = array('app.BillingAddress');
	public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->BillingAddress = ClassRegistry::init('BillingAddress');
    }
	
	/*public function testBringOneRegister()
    {
		$this->loadFixtures('BillingAddress');
		$result = $this->BillingAddress->bringOneRegister(1);
        $expected = array(array('id' => 1, 'country' => 52, 'address' =>'Flores, Heredia'));
        $this->assertEquals($expected, $result);
    }
	
	public function testBringAllRegisters()
    {
		$this->loadFixtures('BillingAddress');
		$result = $this->BillingAddress->bringAllRegisters();
        $expected = array(array('id' => 1, 'country' => 52, 'address' =>'Flores, Heredia'));
        $this->assertEquals($expected, $result);
    }*/

    public function testRemoveRegister()
    {
        $this->loadFixtures('BillingAddress');
        $result = $this->BillingAddress->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }

    public function testEditRegister()
    {
        $this->loadFixtures('BillingAddress');
        $result = $this->BillingAddress->editRegister()['BillingAddress']['address'];
        $expected = 'ACÁ';
        $this->assertEquals($expected, $result);
    }

    /*public function testAddRegister()
    {
        $this->loadFixtures('BillingAddress');
        $result = $this->BillingAddress->addRegister();
        $expected = array('id' => 1, 'country' => 52, 'address' =>'Santo Domingo, Heredia');
        $this->assertEquals($expected, $result);
    }*/
}
?>