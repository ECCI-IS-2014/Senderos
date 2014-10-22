<?php 
App::uses('Product', 'Model');

class ProductTest extends CakeTestCase {
    public $fixtures = array('app.product');
	public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->Product = ClassRegistry::init('Product');
    }
	
	public function testBringAllRegisters() {
		$this->loadFixtures('Product');
		$result = $this->Product->bringAllRegisters();	
        $expected = array(
            array('Product' => array(
									  'id' => 1,
									  'name' => 'RE4',
									  'genre' => 'Horror',
									  'console' => 'PS3',
									  'release_year' => '2004', 
									  'price' => 5,
									  'description' => 'a really nice game',
									  'amount' => 5,
									  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
									  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
									)
			),
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testEditField() {
		$this->loadFixtures('Product');
		$result = $this->Product->editField();	
        $expected = array(
            array('Product' => array(
									  'id' => 1,
									  'name' => 'RE5',
									  'genre' => 'Horror',
									  'console' => 'PS3',
									  'release_year' => '2004', 
									  'price' => 5,
									  'description' => 'a really nice game',
									  'amount' => 5,
									  'image' => 'http://frikarte.com/wp-content/uploads/2013/03/Resident-Evil-4-Wii-Frikarte.jpg',
									  'video' => 'www.youtube.com/embed/PHQFgS44lMA'
									)
			),
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testRemoveRegister() {
		$this->loadFixtures('Product');
		$result = $this->Product->removeRegister();	
        $expected = array();
        $this->assertEquals($expected, $result);
    }
}
?>