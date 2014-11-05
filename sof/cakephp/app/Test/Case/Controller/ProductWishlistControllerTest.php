<?php 
class ProductWishlistControllerTest extends ControllerTestCase {
    public $fixtures = array('app.productwishlist');

    public function testIndex() {
        $result = $this->testAction('/productwishlist/index');
        debug($result);
    }
	public function testAdd() {
        $result = $this->testAction('/productwishlist/add');

        debug($result);
    }
}
?>