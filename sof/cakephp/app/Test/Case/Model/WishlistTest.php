<?php 
App::uses('Wishlist', 'Model');

class WishlistTest extends CakeTestCase {
    public $fixtures = array('app.wishlist');

	public function setUp() {
        parent::setUp();
        $this->Wishlist = ClassRegistry::init('Wishlist');
    }
	
	public function testRemoveRegister() {
		$result = $this->Wishlist->removeRegister();
        $expected = array();
        $this->assertEquals($expected, $result);
    }

  }
?>