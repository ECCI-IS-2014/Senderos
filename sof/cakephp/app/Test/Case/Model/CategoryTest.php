<?php 
App::uses('Category', 'Model');

class CategoryTest extends CakeTestCase {
    public $fixtures = array('app.category');
	public $autoFixtures = false;
	
	public function setUp() {
        parent::setUp();
        $this->Category = ClassRegistry::init('Category');
    }
	
	public function testBringOneRegister() {
		$this->loadFixtures('Category');
		$result = $this->Category->bringOneRegister(1);
        $expected = array(
            array('categories' => array('id' => 1, 'name' => 'AVENTURA', 'parent_id' => NULL, 'lft' => 1, 'rght' => 2))
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testBringAllRegisters() {
		$this->loadFixtures('Category');
		$result = $this->Category->bringAllRegisters();
        $expected = array(
            array('categories' => array('id' => 1, 'name' => 'AVENTURA', 'parent_id' => NULL, 'lft' => 1, 'rght' => 2)),
			array('categories' => array('id' => 2, 'name' => 'SUB-AVENTURA', 'parent_id' => 1, 'lft' => 2, 'rght' => 3)),
            array('categories' => array('id' => 3, 'name' => 'HORROR', 'parent_id' => NULL, 'lft' => 5, 'rght' => 6))
        );
        $this->assertEquals($expected, $result);
    }
	
	public function testBringParent() {
		$this->loadFixtures('Category');
		$result = $this->Category->bringParent(2);
		$expected = array(
            array('categories' => array('parent_id' => 1))
		);
		$this->assertEquals($expected, $result);
	}
}
?>